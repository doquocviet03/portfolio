<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Chưa đăng nhập
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        // Đã đăng nhập nhưng không có quyền Admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập trang quản trị.');
        }

        return $next($request);
    }
}
