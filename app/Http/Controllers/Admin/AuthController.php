<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HIỂN THỊ FORM ĐĂNG NHẬP
    |--------------------------------------------------------------------------
    */
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | XỬ LÝ ĐĂNG NHẬP
    |--------------------------------------------------------------------------
    */
    public function login(Request $request)
    {
        // Kiểm tra dữ liệu nhập
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Khóa giới hạn theo email và IP
        $key = Str::lower($credentials['email']) . '|' . $request->ip();

        // Kiểm tra số lần đăng nhập sai
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'email' => "Bạn đã đăng nhập sai quá nhiều lần. Vui lòng thử lại sau {$seconds} giây.",
            ]);
        }

        // Thử đăng nhập
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {

            RateLimiter::hit($key, 60);

            throw ValidationException::withMessages([
                'email' => 'Email hoặc mật khẩu không chính xác.',
            ]);
        }

        // Xóa bộ đếm khi đăng nhập thành công
        RateLimiter::clear($key);

        // Tạo lại session để bảo mật
        $request->session()->regenerate();

        return redirect()
            ->intended(route('admin.dashboard'));
    }

    /*
    |--------------------------------------------------------------------------
    | ĐĂNG XUẤT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();

        // Hủy session cũ
        $request->session()->invalidate();

        // Tạo CSRF token mới
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with('success', 'Đăng xuất thành công!');
    }
}
