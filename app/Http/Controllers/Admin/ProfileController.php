<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first();

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            // Thông tin tiếng Việt
            'full_name' => 'required|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'field' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'short_bio' => 'nullable|string|max:2000',
            'about_me' => 'nullable|string',
            'career_goal' => 'nullable|string',

            // Thông tin tiếng Anh
            'job_title_en' => 'nullable|string|max:255',
            'field_en' => 'nullable|string|max:255',
            'short_bio_en' => 'nullable|string|max:2000',
            'about_me_en' => 'nullable|string',
            'career_goal_en' => 'nullable|string',

            // Thông tin liên hệ
            'contact_email' => 'nullable|email|max:255',
            'phone' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^\+?[0-9\s().-]{9,20}$/'
            ],
            'github_url' => 'nullable|url|max:2048',
            'facebook_url' => 'nullable|url|max:2048',
            'linkedin_url' => 'nullable|url|max:2048',

            // Ảnh đại diện
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240', // 10MB
        ]);

        $profile = Profile::first();
        $oldAvatar = $profile?->avatar;

        // Lưu ảnh mới
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request
                ->file('avatar')
                ->store('profiles', 'public');
        }

        try {
            if ($profile) {
                $profile->update($validated);
            } else {
                Profile::create($validated);
            }
        } catch (\Throwable $e) {
            // Xóa ảnh mới nếu cập nhật database thất bại
            if (isset($validated['avatar'])) {
                Storage::disk('public')
                    ->delete($validated['avatar']);
            }

            throw $e;
        }

        // Xóa ảnh cũ sau khi lưu thành công
        if (
            $request->hasFile('avatar') &&
            $oldAvatar &&
            $oldAvatar !== $validated['avatar']
        ) {
            Storage::disk('public')->delete($oldAvatar);
        }

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Cập nhật hồ sơ thành công!');
    }

    /**
     * Tự động dịch Profile từ tiếng Việt sang tiếng Anh.
     * Sử dụng TranslationService hiện có.
     */
    public function translate(
        Request $request,
        TranslationService $translator
    ) {
        $data = $request->validate([
            'job_title' => ['nullable', 'string', 'max:255'],
            'field' => ['nullable', 'string', 'max:255'],
            'short_bio' => ['nullable', 'string', 'max:2000'],
            'about_me' => ['nullable', 'string', 'max:10000'],
            'career_goal' => ['nullable', 'string', 'max:10000'],
        ]);

        $fields = [
            'job_title',
            'field',
            'short_bio',
            'about_me',
            'career_goal',
        ];

        $hasContent = false;

        foreach ($fields as $field) {
            if (trim((string) ($data[$field] ?? '')) !== '') {
                $hasContent = true;
                break;
            }
        }

        if (!$hasContent) {
            throw ValidationException::withMessages([
                'job_title' => 'Hãy nhập ít nhất một nội dung tiếng Việt để dịch.',
            ]);
        }

        $translations = [];

        try {
            foreach ($fields as $field) {
                $value = trim((string) ($data[$field] ?? ''));

                $translations[$field . '_en'] = $value === ''
                    ? ''
                    : $translator->translate($value);
            }
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'message' => 'Dịch tự động chưa thành công. Vui lòng thử lại sau.',
            ], 502);
        }

        return response()->json([
            'translations' => $translations,
        ]);
    }
}
