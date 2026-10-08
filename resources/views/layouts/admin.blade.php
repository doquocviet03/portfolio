
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Dashboard') | Portfolio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 255px;
            --admin-bg: #f1f5f9;
            --admin-dark: #0f172a;
            --admin-primary: #2563eb;
        }

        body {
            background: var(--admin-bg);
            font-family: 'Segoe UI', sans-serif;
            color: #0f172a;
        }

        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: #0f172a;
            color: #fff;
            padding: 24px 15px;
            overflow-y: auto;
            z-index: 1030;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px 28px;
            border-bottom: 1px solid #334155;
            margin-bottom: 24px;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            background: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .sidebar-brand h2 {
            font-size: 17px;
            font-weight: 800;
            margin: 0;
        }

        .sidebar-brand small {
            color: #94a3b8;
            font-size: 12px;
        }

        .sidebar-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            color: #64748b;
            padding: 0 14px;
            margin: 20px 0 10px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 13px;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 11px;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 14px;
            transition: .2s;
        }

        .sidebar-link i {
            font-size: 19px;
        }

        .sidebar-link:hover {
            background: #1e293b;
            color: #fff;
        }

        .sidebar-link.active {
            background: #2563eb;
            color: #fff;
        }

        .sidebar-logout {
            background: transparent;
            border: 0;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .admin-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 18px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .admin-topbar h1 {
            font-size: 20px;
            font-weight: 800;
            margin: 0;
        }

        .admin-topbar .admin-user {
            color: #64748b;
            font-size: 14px;
        }

        .admin-content {
            padding: 30px;
            max-width: 1600px;
            margin: 0 auto;
        }

        .admin-panel {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(15,23,42,.03);
        }

        .admin-page-title {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .admin-page-subtitle {
            color: #64748b;
            margin-bottom: 28px;
        }

        .admin-content .btn {
            border-radius: 9px;
        }

        .admin-content .table {
            vertical-align: middle;
        }

        .admin-content .form-control,
        .admin-content .form-select {
            border-radius: 9px;
            padding: 10px 13px;
        }

        .mobile-menu-button {
            display: none;
        }

        .sidebar-overlay {
            display: none;
        }

        @media (max-width: 991px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform .25s ease;
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .mobile-menu-button {
                display: inline-flex;
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.5);
                z-index: 1020;
            }

            .admin-content {
                padding: 20px 15px;
            }

            .admin-topbar {
                padding: 15px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div id="sidebarOverlay"
     class="sidebar-overlay"
     onclick="closeAdminSidebar()"></div>

<aside class="admin-sidebar" id="adminSidebar">

    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="bi bi-code-square"></i>
        </div>

        <div>
            <h2>Portfolio Admin</h2>
            <small>Management System</small>
        </div>
    </div>

    <div class="sidebar-label">QUẢN LÝ</div>

    <nav aria-label="Điều hướng quản trị">

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i>
            Tổng quan
        </a>

        <a href="{{ route('admin.projects.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <i class="bi bi-folder2-open"></i>
            Dự án
        </a>

        <a href="{{ route('admin.skills.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
            <i class="bi bi-code-slash"></i>
            Kỹ năng
        </a>

        <a href="{{ route('admin.experiences.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
            <i class="bi bi-briefcase"></i>
            Kinh nghiệm
        </a>

        <a href="{{ route('admin.contacts.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
            <i class="bi bi-envelope"></i>
            Tin nhắn
        </a>

    </nav>

    <div class="sidebar-label">TÀI KHOẢN</div>

    <a href="{{ route('home') }}"
       target="_blank"
       rel="noopener noreferrer"
       class="sidebar-link">
        <i class="bi bi-box-arrow-up-right"></i>
        Xem website
    </a>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf

        <button type="submit" class="sidebar-link sidebar-logout">
            <i class="bi bi-box-arrow-right"></i>
            Đăng xuất
        </button>
    </form>

</aside>

<div class="admin-main">

    <header class="admin-topbar">

        <div class="d-flex align-items-center gap-3">

            <button type="button"
                    class="btn btn-outline-secondary mobile-menu-button"
                    onclick="openAdminSidebar()"
                    aria-label="Mở menu">
                <i class="bi bi-list"></i>
            </button>

            <h1>@yield('page_title', 'Dashboard')</h1>

        </div>

        <div class="admin-user">
            <i class="bi bi-person-circle me-1"></i>
            {{ auth()->user()?->name ?? 'Admin' }}
        </div>

    </header>

    <main class="admin-content">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Đóng"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function openAdminSidebar() {
        document.getElementById('adminSidebar').classList.add('open');
        document.getElementById('sidebarOverlay').classList.add('show');
    }

    function closeAdminSidebar() {
        document.getElementById('adminSidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.remove('show');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeAdminSidebar();
        }
    });
</script>

@stack('scripts')

</body>
</html>
