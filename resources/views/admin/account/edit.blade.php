@extends('layouts.admin')

@section('title', 'Cài đặt tài khoản')
@section('page_title', 'Cài đặt tài khoản Admin')

@push('styles')
<style>
.account-settings { --ac-surface:#fff; --ac-text:#0f172a; --ac-muted:#64748b; --ac-border:#e2e8f0; --ac-soft:#f8fafc; }
html[data-bs-theme="dark"] .account-settings, html[data-theme="dark"] .account-settings { --ac-surface:#17243a; --ac-text:#f1f5f9; --ac-muted:#b9c8da; --ac-border:#34465e; --ac-soft:#1e2e46; }
.account-settings .ac-title { color:var(--ac-text); font-weight:800; }
.account-settings .ac-muted { color:var(--ac-muted)!important; }
.account-settings .ac-card { background:var(--ac-surface); color:var(--ac-text); border:1px solid var(--ac-border); border-radius:20px; padding:clamp(20px,3vw,30px); box-shadow:0 8px 28px rgba(15,23,42,.05); }
.account-settings .ac-icon { display:grid; place-items:center; width:54px; height:54px; border-radius:15px; background:rgba(59,130,246,.13); color:#3b82f6; font-size:25px; margin-bottom:18px; }
.account-settings .ac-section-title { font-weight:800; font-size:20px; margin-bottom:7px; }
.account-settings .form-label { color:var(--ac-text); font-weight:650; }
.account-settings .form-control { background:var(--ac-soft); color:var(--ac-text); border:1px solid var(--ac-border); border-radius:11px; padding:11px 13px; }
.account-settings .form-control:focus { background:var(--ac-surface); color:var(--ac-text); border-color:#60a5fa; box-shadow:0 0 0 .2rem rgba(59,130,246,.15); }
.account-settings .form-control::placeholder { color:var(--ac-muted); }
.account-settings .ac-input-wrap { position:relative; }
.account-settings .ac-input-wrap .form-control { padding-right:48px; }
.account-settings .ac-eye { position:absolute; right:5px; top:50%; transform:translateY(-50%); border:0; background:transparent; color:var(--ac-muted); width:40px; height:40px; border-radius:9px; }
.account-settings .ac-eye:hover { background:var(--ac-border); }
.account-settings .ac-btn { border-radius:11px; padding:11px 20px; font-weight:700; }
.account-settings .ac-note { border:1px solid var(--ac-border); background:var(--ac-soft); color:var(--ac-muted); padding:14px 16px; border-radius:12px; font-size:13px; }
.account-settings .ac-detail { padding:12px 0; border-bottom:1px solid var(--ac-border); overflow-wrap:anywhere; }
.account-settings .ac-detail:last-child { border-bottom:0; }
.account-settings .ac-detail-label { color:var(--ac-muted); font-size:13px; margin-bottom:3px; }
.account-settings .ac-detail-value { color:var(--ac-text); font-weight:650; }
</style>
@endpush

@section('content')
<div class="account-settings container-fluid px-0">
    <div class="mb-4">
        <h1 class="ac-title h3 mb-1">Cài đặt tài khoản</h1>
        <p class="ac-muted mb-0">Cập nhật thông tin đăng nhập và bảo mật tài khoản quản trị.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    <div class="row g-4 align-items-stretch">
        <div class="col-lg-6">
            <section class="ac-card h-100">
                <div class="ac-icon"><i class="bi bi-person-gear"></i></div>
                <h2 class="ac-section-title">Thông tin tài khoản</h2>
                <p class="ac-muted mb-4">Đổi tên và email đăng nhập. Xác nhận bằng mật khẩu hiện tại.</p>

                <form action="{{ route('admin.account.updateInfo') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="adminName" class="form-label">Tên Admin <span class="text-danger">*</span></label>
                        <input id="adminName" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" maxlength="255" autocomplete="name" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="adminEmail" class="form-label">Email đăng nhập <span class="text-danger">*</span></label>
                        <input id="adminEmail" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" maxlength="255" autocomplete="email" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="infoCurrentPassword" class="form-label">Mật khẩu hiện tại <span class="text-danger">*</span></label>
                        <div class="ac-input-wrap">
                            <input id="infoCurrentPassword" type="password" name="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   autocomplete="current-password" required>
                            <button type="button" class="ac-eye" data-toggle-password="infoCurrentPassword" aria-label="Hiện mật khẩu" aria-pressed="false"><i class="bi bi-eye"></i></button>
                        </div>
                        @error('current_password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        <div class="ac-muted small mt-2">Bắt buộc để xác nhận thay đổi tên hoặc email.</div>
                    </div>
                    <button type="submit" class="btn btn-primary ac-btn"><i class="bi bi-floppy me-2"></i>Lưu thông tin</button>
                </form>
            </section>
        </div>

        <div class="col-lg-6">
            <section class="ac-card h-100">
                <div class="ac-icon"><i class="bi bi-shield-lock"></i></div>
                <h2 class="ac-section-title">Đổi mật khẩu</h2>
                <p class="ac-muted mb-4">Dùng mật khẩu riêng, khó đoán để bảo vệ tài khoản Admin.</p>

                <form action="{{ route('admin.account.updatePassword') }}" method="POST" id="changePasswordForm">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="passwordCurrent" class="form-label">Mật khẩu hiện tại <span class="text-danger">*</span></label>
                        <div class="ac-input-wrap">
                            <input id="passwordCurrent" type="password" name="current_password"
                                   class="form-control @error('current_password', 'passwordUpdate') is-invalid @enderror"
                                   autocomplete="current-password" required>
                            <button type="button" class="ac-eye" data-toggle-password="passwordCurrent" aria-label="Hiện mật khẩu" aria-pressed="false"><i class="bi bi-eye"></i></button>
                        </div>
                        @error('current_password', 'passwordUpdate')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Mật khẩu mới <span class="text-danger">*</span></label>
                        <div class="ac-input-wrap">
                            <input id="newPassword" type="password" name="password"
                                   class="form-control @error('password', 'passwordUpdate') is-invalid @enderror"
                                   autocomplete="new-password" minlength="8" required>
                            <button type="button" class="ac-eye" data-toggle-password="newPassword" aria-label="Hiện mật khẩu" aria-pressed="false"><i class="bi bi-eye"></i></button>
                        </div>
                        @error('password', 'passwordUpdate')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
                        <div class="ac-input-wrap">
                            <input id="confirmPassword" type="password" name="password_confirmation"
                                   class="form-control" autocomplete="new-password" minlength="8" required>
                            <button type="button" class="ac-eye" data-toggle-password="confirmPassword" aria-label="Hiện mật khẩu" aria-pressed="false"><i class="bi bi-eye"></i></button>
                        </div>
                        <div id="passwordMismatch" class="text-danger small mt-1 d-none" role="alert">Mật khẩu xác nhận chưa khớp.</div>
                    </div>
                    <div class="ac-note mb-4"><i class="bi bi-info-circle me-2"></i>Nên dùng mật khẩu dài, không trùng với mật khẩu đã sử dụng. Hệ thống sẽ áp dụng quy tắc kiểm tra trong Controller.</div>
                    <button type="submit" class="btn btn-primary ac-btn"><i class="bi bi-key me-2"></i>Đổi mật khẩu</button>
                </form>
            </section>
        </div>
    </div>

    <section class="ac-card mt-4">
        <h2 class="ac-section-title mb-3"><i class="bi bi-person-check text-success me-2"></i>Tài khoản hiện tại</h2>
        <div class="row g-3">
            <div class="col-md-4"><div class="ac-detail"><div class="ac-detail-label">Tên tài khoản</div><div class="ac-detail-value">{{ $user->name }}</div></div></div>
            <div class="col-md-5"><div class="ac-detail"><div class="ac-detail-label">Email</div><div class="ac-detail-value">{{ $user->email }}</div></div></div>
            <div class="col-md-3"><div class="ac-detail"><div class="ac-detail-label">Trạng thái</div><div><span class="badge text-bg-success">Đang đăng nhập</span></div></div></div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-toggle-password]').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = document.getElementById(button.getAttribute('data-toggle-password'));
            if (!input) return;
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            button.setAttribute('aria-pressed', show ? 'true' : 'false');
            button.setAttribute('aria-label', show ? 'Ẩn mật khẩu' : 'Hiện mật khẩu');
            button.innerHTML = show ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
        });
    });
    const form = document.getElementById('changePasswordForm');
    const password = document.getElementById('newPassword');
    const confirmation = document.getElementById('confirmPassword');
    const warning = document.getElementById('passwordMismatch');
    if (form && password && confirmation && warning) {
        form.addEventListener('submit', function (event) {
            const mismatch = password.value !== confirmation.value;
            warning.classList.toggle('d-none', !mismatch);
            if (mismatch) { event.preventDefault(); confirmation.focus(); }
        });
    }
});
</script>
@endpush
