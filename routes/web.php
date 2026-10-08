
<?php

use Illuminate\Support\Facades\Route;

// ==========================================
// CONTROLLER TRANG PORTFOLIO
// ==========================================

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;

// ==========================================
// CONTROLLER ADMIN
// ==========================================

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;


// ==========================================
// 1. TRANG PORTFOLIO
// ==========================================

// Trang chủ
Route::get('/', [PortfolioController::class, 'home'])
    ->name('home');

// Giới thiệu
Route::get('/about', [PortfolioController::class, 'about'])
    ->name('about');

// Kỹ năng
Route::get('/skills', [PortfolioController::class, 'skills'])
    ->name('skills');

// Dự án
Route::get('/projects', [PortfolioController::class, 'projects'])
    ->name('projects');

// Kinh nghiệm
Route::get('/experience', [PortfolioController::class, 'experience'])
    ->name('experience');

// Liên hệ
Route::get('/contact', [PortfolioController::class, 'contact'])
    ->name('contact');

// Gửi tin nhắn liên hệ
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');


// ==========================================
// 2. CHUYỂN HƯỚNG ĐĂNG NHẬP
// ==========================================

// Sửa lỗi Route [login] not defined
// Laravel sẽ chuyển người chưa đăng nhập
// đến trang đăng nhập Admin.

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');


// ==========================================
// 3. ĐĂNG NHẬP ADMIN
// ==========================================

Route::middleware('guest')->group(function () {

    // Hiển thị form đăng nhập
    Route::get('/admin/login', [AuthController::class, 'showLogin'])
        ->name('admin.login');

    // Xử lý đăng nhập
    Route::post('/admin/login', [AuthController::class, 'login'])
        ->name('admin.login.submit');

});


// ==========================================
// 4. ADMIN DASHBOARD
// ==========================================

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        // ==================================
        // DASHBOARD
        // ==================================

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');


        // ==================================
        // ĐĂNG XUẤT
        // ==================================

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');


        // ==================================
        // QUẢN LÝ DỰ ÁN
        // ==================================

        Route::resource('projects', ProjectController::class)
            ->except(['show']);


        // ==================================
        // QUẢN LÝ KỸ NĂNG
        // ==================================

        Route::resource('skills', SkillController::class)
            ->except(['show']);


        // ==================================
        // QUẢN LÝ KINH NGHIỆM
        // ==================================

        Route::resource('experiences', ExperienceController::class)
            ->except(['show']);


        // ==================================
        // QUẢN LÝ TIN NHẮN LIÊN HỆ
        // ==================================

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

        // Xóa tin nhắn
        Route::delete('/contacts/{contact}', [
            AdminContactController::class,
            'destroy'
        ])->name('contacts.destroy');

    });
