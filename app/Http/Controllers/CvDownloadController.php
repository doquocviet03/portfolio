<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CvDownloadController extends Controller
{
    private function getCv()
    {
        $profile = Profile::first();

        abort_unless(
            $profile && $profile->cv_path,
            404,
            'Chưa có CV.'
        );

        $path = $profile->cv_path;

        // Chỉ cho phép CV có tên UUID trong thư mục cvs/
        abort_unless(
            preg_match(
                '/^cvs\/cv-[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}\.pdf$/i',
                $path
            ) === 1,
            404,
            'Đường dẫn CV không hợp lệ.'
        );

        abort_unless(
            Storage::disk('local')->exists($path),
            404,
            'Không tìm thấy CV.'
        );

        return [$profile, $path];
    }

    public function download()
    {
        [$profile, $path] = $this->getCv();

        $filename = 'CV-' .
            Str::slug($profile->full_name ?: 'Portfolio') .
            '.pdf';

        return Storage::disk('local')->download(
            $path,
            $filename,
            [
                'Content-Type' => 'application/pdf',
                'X-Content-Type-Options' => 'nosniff',
            ]
        );
    }

    public function preview()
    {
        [, $path] = $this->getCv();

        return response()->file(
            Storage::disk('local')->path($path),
            [
                'Content-Type' => 'application/pdf',
                'X-Content-Type-Options' => 'nosniff',
                'Content-Disposition' => 'inline',
            ]
        );
    }
}