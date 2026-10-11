<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'full_name' => 'required|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'field' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'short_bio' => 'nullable|string|max:2000',
            'about_me' => 'nullable|string',
            'career_goal' => 'nullable|string',
            'contact_email' => 'nullable|email|max:255',
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^\+?[0-9\s().-]{9,20}$/'],
            'github_url' => 'nullable|url|max:2048',
            'facebook_url' => 'nullable|url|max:2048',
            'linkedin_url' => 'nullable|url|max:2048',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profile = Profile::first();
        $oldAvatar = $profile?->avatar;

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('profiles', 'public');
        }

        try {
            if ($profile) {
                $profile->update($validated);
            } else {
                Profile::create($validated);
            }
        } catch (\Throwable $e) {
            if (isset($validated['avatar'])) {
                Storage::disk('public')->delete($validated['avatar']);
            }
            throw $e;
        }

        if ($request->hasFile('avatar') && $oldAvatar && $oldAvatar !== $validated['avatar']) {
            Storage::disk('public')->delete($oldAvatar);
        }

        return redirect()->route('admin.profile.edit')->with('success', 'Cập nhật hồ sơ thành công!');
    }
}
