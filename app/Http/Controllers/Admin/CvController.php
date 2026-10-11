<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CvController extends Controller
{
    public function index()
    {
        $profile = Profile::first();

        return view('admin.cv.index', compact('profile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cv' => [
                'required',
                'file',
                'mimes:pdf',
                'mimetypes:application/pdf',
                'max:5120',
            ],
        ], [
            'cv.required' => 'Vui lòng chọn file CV.',
            'cv.mimes' => 'CV phải là file PDF.',
            'cv.mimetypes' => 'File tải lên phải là PDF hợp lệ.',
            'cv.max' => 'CV không được vượt quá 5 MB.',
        ]);

        $profile = Profile::first();

        if (!$profile) {
            return back()->with(
                'error',
                'Chưa có hồ sơ cá nhân. Hãy tạo hồ sơ trước.'
            );
        }

        $oldCv = $profile->cv_path;

        $newPath = $request->file('cv')->storeAs(
            'cvs',
            'cv-' . Str::uuid() . '.pdf',
            'local'
        );

        try {
            $profile->cv_path = $newPath;
            $profile->save();
        } catch (\Throwable $e) {
            Storage::disk('local')->delete($newPath);

            throw $e;
        }

        if ($oldCv && $oldCv !== $newPath) {
            Storage::disk('local')->delete($oldCv);
        }

        return redirect()
            ->route('admin.cv.index')
            ->with('success', 'Cập nhật CV thành công!');
    }

    public function destroy()
    {
        $profile = Profile::firstOrFail();

        $oldCv = $profile->cv_path;

        $profile->cv_path = null;
        $profile->save();

        if ($oldCv) {
            Storage::disk('local')->delete($oldCv);
        }

        return redirect()
            ->route('admin.cv.index')
            ->with('success', 'Đã xóa CV thành công!');
    }
}
