<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HIỂN THỊ TRANG QUẢN LÝ TÀI KHOẢN
    |--------------------------------------------------------------------------
    */
    public function edit()
    {
        $user = Auth::user();

        return view('admin.account.edit', compact('user'));
    }

    /*
    |--------------------------------------------------------------------------
    | CẬP NHẬT TÊN VÀ EMAIL
    |--------------------------------------------------------------------------
    */
    public function updateInfo(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'current_password' => [
                'required',
                'current_password',
            ],
        ]);

        $emailChanged = $user->email !== $validated['email'];

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Nếu đổi email thì cần xác minh lại
        if ($emailChanged) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()
            ->route('admin.account.edit')
            ->with('success', 'Cập nhật thông tin tài khoản thành công!');
    }

    /*
    |--------------------------------------------------------------------------
    | ĐỔI MẬT KHẨU ADMIN
    |--------------------------------------------------------------------------
    */
    public function updatePassword(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validated = $request->validateWithBag('passwordUpdate', [
            'current_password' => [
                'required',
                'current_password',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers(),
            ],
        ]);

        $user = Auth::user();

        // Mã hóa mật khẩu mới trước khi lưu
        $user->password = Hash::make($validated['password']);

        // Lưu mật khẩu vào database
        $user->save();

        // Tạo lại Session sau khi đổi mật khẩu
        $request->session()->regenerate();

        return redirect()
            ->route('admin.account.edit')
            ->with('success', 'Đổi mật khẩu thành công!');
    }
}
