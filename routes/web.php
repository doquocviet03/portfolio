<?php

use Illuminate\Support\Facades\Route;

// PUBLIC CONTROLLERS
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CvDownloadController;

// ADMIN CONTROLLERS
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\CvController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\SitemapController;


/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE
|--------------------------------------------------------------------------
*/

// Trang chủ
Route::get('/', [
    PortfolioController::class,
    'home'
])->name('home');

// SITEMAP XML
Route::get('/sitemap.xml', [SitemapController::class, 'index'])
    ->name('sitemap');

// Giới thiệu
Route::get('/about', [
    PortfolioController::class,
    'about'
])->name('about');

// Kỹ năng
Route::get('/skills', [
    PortfolioController::class,
    'skills'
])->name('skills');

// Danh sách dự án
Route::get('/projects', [
    PortfolioController::class,
    'projects'
])->name('projects');

// Chi tiết dự án
Route::get('/projects/{project}', [
    PortfolioController::class,
    'projectDetail'
])->name('projects.show');

// Kinh nghiệm
Route::get('/experience', [
    PortfolioController::class,
    'experience'
])->name('experience');

// Trang liên hệ
Route::get('/contact', [
    PortfolioController::class,
    'contact'
])->name('contact');

// Gửi tin nhắn liên hệ
Route::post('/contact', [
    ContactController::class,
    'store'
])
->middleware('throttle:5,1')
->name('contact.store');


/*
|--------------------------------------------------------------------------
| CV PDF - PUBLIC WEBSITE - BƯỚC 10.7
|--------------------------------------------------------------------------
*/

// Tải CV PDF
Route::get('/cv/download', [
    CvDownloadController::class,
    'download'
])->name('cv.download');

// Xem trước CV PDF
Route::get('/cv/preview', [
    CvDownloadController::class,
    'preview'
])->name('cv.preview');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

// Chuyển /login sang trang đăng nhập Admin
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Chỉ khách chưa đăng nhập
Route::middleware('guest')->group(function () {

    // Form đăng nhập
    Route::get('/admin/login', [
        AuthController::class,
        'showLogin'
    ])->name('admin.login');

    // Xử lý đăng nhập
   Route::post('/admin/login', [
    AuthController::class,
    'login'
])
->middleware('throttle:5,1')
->name('admin.login.submit');

});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/', [
            DashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | LOGOUT
        |--------------------------------------------------------------------------
        */

        Route::post('/logout', [
            AuthController::class,
            'logout'
        ])->name('logout');


        /*
        |--------------------------------------------------------------------------
        | QUẢN LÝ HỒ SƠ CÁ NHÂN
        |--------------------------------------------------------------------------
        */

        Route::get('/profile', [
            ProfileController::class,
            'edit'
        ])->name('profile.edit');

        Route::put('/profile', [
            ProfileController::class,
            'update'
        ])->name('profile.update');


        /*
        |--------------------------------------------------------------------------
        | QUẢN LÝ CV PDF - BƯỚC 10.7
        |--------------------------------------------------------------------------
        */

        // Trang quản lý CV
        Route::get('/cv', [
            CvController::class,
            'index'
        ])->name('cv.index');

        // Tải CV mới lên
        Route::post('/cv', [
            CvController::class,
            'store'
        ])->name('cv.store');

        // Xóa CV hiện tại
        Route::delete('/cv', [
            CvController::class,
            'destroy'
        ])->name('cv.destroy');


        /*
        |--------------------------------------------------------------------------
        | CÀI ĐẶT TÀI KHOẢN ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/account', [
            AccountController::class,
            'edit'
        ])->name('account.edit');

        Route::put('/account/info', [
            AccountController::class,
            'updateInfo'
        ])->name('account.updateInfo');

        Route::put('/account/password', [
            AccountController::class,
            'updatePassword'
        ])->name('account.updatePassword');


        /*
        |--------------------------------------------------------------------------
        | QUẢN LÝ DỰ ÁN
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'projects',
            ProjectController::class
        )->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | QUẢN LÝ KỸ NĂNG
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'skills',
            SkillController::class
        )->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | QUẢN LÝ KINH NGHIỆM
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'experiences',
            ExperienceController::class
        )->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | QUẢN LÝ TIN NHẮN LIÊN HỆ
        |--------------------------------------------------------------------------
        */

        // Danh sách tin nhắn
        Route::get('/contacts', [
            AdminContactController::class,
            'index'
        ])->name('contacts.index');

        // Xem chi tiết tin nhắn
        Route::get('/contacts/{contact}', [
            AdminContactController::class,
            'show'
        ])->name('contacts.show');

        // Đánh dấu tin nhắn chưa đọc
        Route::patch('/contacts/{contact}/unread', [
            AdminContactController::class,
            'markUnread'
        ])->name('contacts.unread');

        // Xóa tin nhắn
        Route::delete('/contacts/{contact}', [
            AdminContactController::class,
            'destroy'
        ])->name('contacts.destroy');


        /*
        |--------------------------------------------------------------------------
        | QUẢN LÝ SAO LƯU DỮ LIỆU - BƯỚC 10.6
        |--------------------------------------------------------------------------
        */

        // Xem danh sách bản sao lưu
        Route::get('/backups', [
            BackupController::class,
            'index'
        ])->name('backups.index');

        // Tạo bản sao lưu mới
        Route::post('/backups', [
            BackupController::class,
            'store'
        ])->name('backups.store');

        // Tải bản sao lưu về máy
        Route::get('/backups/{filename}/download', [
            BackupController::class,
            'download'
        ])->name('backups.download');

        // Xóa bản sao lưu
        Route::delete('/backups/{filename}', [
            BackupController::class,
            'destroy'
        ])->name('backups.destroy');

    });
    if (app()->environment('local')) {
    Route::get('/preview-error-500', function () {
        return response()->view('errors.500', [], 500);
    });
}
