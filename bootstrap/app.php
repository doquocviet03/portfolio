<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\SetLocale;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |--------------------------------------------------------------------------
        | ĐĂNG KÝ MIDDLEWARE ADMIN
        |--------------------------------------------------------------------------
        |
        | Kiểm tra quyền truy cập trang quản trị.
        |
        */

        $middleware->alias([
            'admin' => AdminMiddleware::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | MIDDLEWARE CHUYỂN ĐỔI NGÔN NGỮ
        |--------------------------------------------------------------------------
        |
        | Hỗ trợ Tiếng Việt (vi) và English (en).
        | Lấy ngôn ngữ từ Session.
        | Giữ ngôn ngữ khi chuyển trang hoặc tải lại website.
        |
        */

        $middleware->web(append: [
            SetLocale::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
