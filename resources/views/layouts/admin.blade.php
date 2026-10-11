<!DOCTYPE html>
<html lang="vi" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') | Portfolio</title>
    <script>
        (function () {
            try {
                var theme = localStorage.getItem('portfolio-admin-theme');
                document.documentElement.setAttribute('data-bs-theme', theme === 'dark' ? 'dark' : 'light');
            } catch (e) {}
        })();
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=1100">
    @stack('styles')
</head>
<body class="admin-body">
@php
    $adminLinks = [
        ['route' => 'admin.dashboard', 'match' => 'admin.dashboard', 'icon' => 'bi-grid-1x2', 'text' => 'Dashboard'],
        ['route' => 'admin.profile.edit', 'match' => 'admin.profile.*', 'icon' => 'bi-person-vcard', 'text' => 'Hồ sơ cá nhân'],
        ['route' => 'admin.cv.index', 'match' => 'admin.cv.*', 'icon' => 'bi-file-earmark-person', 'text' => 'Quản lý CV'],
        ['route' => 'admin.projects.index', 'match' => 'admin.projects.*', 'icon' => 'bi-folder2-open', 'text' => 'Quản lý dự án'],
        ['route' => 'admin.skills.index', 'match' => 'admin.skills.*', 'icon' => 'bi-stars', 'text' => 'Quản lý kỹ năng'],
        ['route' => 'admin.experiences.index', 'match' => 'admin.experiences.*', 'icon' => 'bi-briefcase', 'text' => 'Kinh nghiệm'],
        ['route' => 'admin.contacts.index', 'match' => 'admin.contacts.*', 'icon' => 'bi-envelope', 'text' => 'Liên hệ'],
        ['route' => 'admin.backups.index', 'match' => 'admin.backups.*', 'icon' => 'bi-database', 'text' => 'Sao lưu dữ liệu'],
    ];
@endphp
<div class="mobile-overlay" id="mobileOverlay" aria-hidden="true"></div>
<aside class="admin-sidebar" id="adminSidebar" aria-label="Menu quản trị">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand text-decoration-none">
        <span class="brand-symbol"><i class="bi bi-code-square"></i></span>
        <span class="brand-copy"><strong>Portfolio Admin</strong><small>Management system</small></span>
    </a>
    <div class="sidebar-scroll">
        <div class="sidebar-label">QUẢN LÝ WEBSITE</div>
        <nav class="sidebar-menu" aria-label="Điều hướng quản trị">
            @foreach($adminLinks as $link)
                <a href="{{ route($link['route']) }}" class="{{ request()->routeIs($link['match']) ? 'active' : '' }}" @if(request()->routeIs($link['match'])) aria-current="page" @endif>
                    <i class="bi {{ $link['icon'] }}"></i><span>{{ $link['text'] }}</span>
                    @if(request()->routeIs($link['match']))<i class="bi bi-chevron-right nav-chevron"></i>@endif
                </a>
            @endforeach
            <div class="sidebar-label sidebar-label-secondary">HỆ THỐNG</div>
            <a href="{{ route('admin.account.edit') }}" class="{{ request()->routeIs('admin.account.*') ? 'active' : '' }}" @if(request()->routeIs('admin.account.*')) aria-current="page" @endif>
                <i class="bi bi-gear"></i><span>Cài đặt tài khoản</span>
            </a>
            <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-box-arrow-up-right"></i><span>Xem website</span>
            </a>
        </nav>
    </div>
    <div class="sidebar-footer">
        <div class="sidebar-account">
            <span class="sidebar-avatar">{{ mb_strtoupper(mb_substr(auth()->user()?->name ?? 'A', 0, 1)) }}</span>
            <span class="sidebar-account-copy"><strong>{{ auth()->user()?->name ?? 'Administrator' }}</strong><small>Quản trị viên</small></span>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-logout"><i class="bi bi-box-arrow-right"></i> Đăng xuất</button>
        </form>
    </div>
</aside>
<div class="admin-main">
    <header class="admin-topbar">
        <div class="topbar-start">
            <button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Mở menu" aria-expanded="false" aria-controls="adminSidebar"><i class="bi bi-list"></i></button>
            <div class="topbar-heading"><span class="topbar-kicker">PORTFOLIO / ADMIN</span><h1>@yield('page_title', 'Quản trị Portfolio')</h1></div>
        </div>
        <div class="topbar-actions">
            <a href="{{ route('home') }}" class="topbar-icon" title="Xem website" aria-label="Xem website" target="_blank" rel="noopener noreferrer"><i class="bi bi-globe2"></i></a>
            <button type="button" class="topbar-icon" id="adminThemeToggle" title="Đổi chế độ sáng tối" aria-label="Đổi chế độ sáng tối" aria-pressed="false"><i class="bi bi-moon-stars" id="adminThemeIcon"></i></button>
            <div class="admin-user"><span class="admin-avatar">{{ mb_strtoupper(mb_substr(auth()->user()?->name ?? 'A', 0, 1)) }}</span><span class="admin-user-info"><strong>{{ auth()->user()?->name ?? 'Admin' }}</strong><small>Administrator</small></span></div>
        </div>
    </header>
    <main class="admin-content" id="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button></div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button></div>
        @endif
        @yield('content')
    </main>
    <footer class="admin-bottom">Portfolio Admin <span>&copy; {{ date('Y') }}</span></footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    'use strict';
    const sidebar = document.getElementById('adminSidebar');
    const toggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('mobileOverlay');
    const themeToggle = document.getElementById('adminThemeToggle');
    const themeIcon = document.getElementById('adminThemeIcon');
    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('sidebar-open');
    }
    toggle.addEventListener('click', function () {
        const isOpen = sidebar.classList.toggle('show');
        overlay.classList.toggle('show', isOpen);
        toggle.setAttribute('aria-expanded', String(isOpen));
        document.body.classList.toggle('sidebar-open', isOpen);
    });
    overlay.addEventListener('click', closeSidebar);
    document.addEventListener('keydown', function (event) { if (event.key === 'Escape') closeSidebar(); });
    document.querySelectorAll('.sidebar-menu a').forEach(function (link) {
        link.addEventListener('click', function () { if (window.innerWidth < 992) closeSidebar(); });
    });
    window.addEventListener('resize', function () { if (window.innerWidth >= 992) closeSidebar(); });
    function updateThemeButton() {
        const dark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
        themeIcon.className = dark ? 'bi bi-sun' : 'bi bi-moon-stars';
        themeToggle.setAttribute('aria-pressed', String(dark));
        themeToggle.setAttribute('title', dark ? 'Chuyển sang chế độ sáng' : 'Chuyển sang chế độ tối');
    }
    updateThemeButton();
    themeToggle.addEventListener('click', function () {
        const dark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
        const next = dark ? 'light' : 'dark';
        document.documentElement.setAttribute('data-bs-theme', next);
        try { localStorage.setItem('portfolio-admin-theme', next); } catch (e) {}
        updateThemeButton();
    });
})();
</script>
@stack('scripts')
</body>
</html>
