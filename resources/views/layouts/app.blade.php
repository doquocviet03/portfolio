<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $seoTitle = trim($__env->yieldContent('title', 'Đỗ Quốc Việt | Personal Portfolio'));
        $seoDescription = trim($__env->yieldContent('meta_description', 'Portfolio cá nhân của Đỗ Quốc Việt: giới thiệu, kỹ năng, dự án và kinh nghiệm trong lĩnh vực Công nghệ thông tin.'));
        $seoImage = trim($__env->yieldContent('meta_image', asset('images/portfolio-og.png')));
        $seoUrl = url()->current();
    @endphp
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $seoUrl }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:site_name" content="Đỗ Quốc Việt | Portfolio">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoUrl }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:image:alt" content="Portfolio Đỗ Quốc Việt">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">
    <meta name="theme-color" content="#071426">

    <script>
        (function () {
            try {
                const saved = localStorage.getItem('portfolio-theme');
                const theme = (saved === 'light' || saved === 'dark') ? saved : 'dark';
                document.documentElement.dataset.theme = theme;
                document.documentElement.setAttribute('data-bs-theme', theme);
            } catch (e) {
                document.documentElement.dataset.theme = 'dark';
                document.documentElement.setAttribute('data-bs-theme', 'dark');
            }
        })();
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dark-mode.css') }}?v=108">
    <style>
        :root {
            --primary: #168bff;
            --primary-light: #60a5fa;
            --dark: #071426;
            --text: #e9f1fc;
            --muted: #a2b4cc;
            --border: #203650;
            --portfolio-bg: #071426;
            --portfolio-panel: #10233b;
            --portfolio-text: #e9f1fc;
            --portfolio-muted: #a2b4cc;
        }
        html[data-theme="light"] {
            --text: #16283e;
            --muted: #61758c;
            --border: #dbe6f2;
            --portfolio-bg: #f5f9ff;
            --portfolio-panel: #fff;
            --portfolio-text: #16283e;
            --portfolio-muted: #61758c;
        }
        html { scroll-behavior: smooth; }
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            font-family: Inter, 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--portfolio-bg);
            color: var(--portfolio-text);
            transition: background-color .25s ease, color .25s ease;
        }
        .portfolio-main { flex: 1; width: 100%; }
        .portfolio-navbar {
            position: sticky; top: 0; z-index: 1030;
            background: rgba(7, 20, 38, .96);
            backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(125, 161, 208, .15);
            padding: 12px 0;
        }
        .portfolio-navbar .navbar-brand {
            display: inline-flex; align-items: center; gap: 10px;
            color: #fff; text-decoration: none;
            font-weight: 800; font-size: 19px; letter-spacing: -.5px;
        }
        .portfolio-navbar .brand-icon, .footer-brand-icon {
            display: inline-grid; place-items: center;
            width: 39px; height: 39px; flex-shrink: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, #1179f4, #315be9);
            color: #fff; box-shadow: 0 5px 20px rgba(22, 139, 255, .22);
        }
        .portfolio-navbar .nav-link {
            color: #bdcce1; font-size: 14px; font-weight: 600;
            padding: 10px 13px !important; border-radius: 10px;
            transition: background .2s ease, color .2s ease;
        }
        .portfolio-navbar .nav-link:hover,
        .portfolio-navbar .nav-link.active { color: #55aaff !important; background: rgba(22,139,255,.11); }
        .portfolio-navbar .navbar-toggler { border: 1px solid #39506b; border-radius: 10px; }
        .portfolio-navbar .navbar-toggler:focus { box-shadow: 0 0 0 3px rgba(22,139,255,.25); }
        .theme-toggle {
            display: inline-grid; place-items: center;
            width: 40px; height: 40px; flex-shrink: 0;
            border: 1px solid #36506f; border-radius: 11px;
            background: rgba(255,255,255,.06); color: #f5f9ff;
            cursor: pointer; transition: background .2s ease;
        }
        .theme-toggle:hover { background: rgba(22,139,255,.2); }
        .btn-cv {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            border: 1px solid #168bff; border-radius: 11px;
            padding: 10px 17px; background: #147cf5; color: #fff;
            font-size: 14px; font-weight: 700; text-decoration: none;
            transition: background .2s ease, transform .2s ease;
            white-space: nowrap;
        }
        .btn-cv:hover { background: #0868d8; color: #fff; transform: translateY(-1px); }
        .btn-primary { background-color: #147cf5; border-color: #147cf5; }
        .btn-primary:hover { background-color: #0868d8; border-color: #0868d8; }
        .portfolio-footer {
            margin-top: 70px; padding: 56px 0 22px;
            background: #06111f; color: #c4d2e5;
            border-top: 1px solid #203650;
        }
        .footer-brand { display: inline-flex; align-items: center; gap: 10px; color: #fff; font-size: 20px; font-weight: 800; }
        .portfolio-footer h5 { font-size: 15px; font-weight: 700; color: #fff; margin-bottom: 17px; }
        .portfolio-footer p { color: #99adc7; line-height: 1.8; }
        .portfolio-footer a { color: #c4d2e5; text-decoration: none; transition: color .2s; }
        .portfolio-footer a:hover { color: #60a5fa; }
        .footer-links a { display: inline-block; margin-bottom: 12px; font-size: 14px; }
        .footer-social {
            display: inline-grid; place-items: center;
            width: 41px; height: 41px; margin-right: 8px;
            border: 1px solid #2a4564; border-radius: 11px; font-size: 18px;
        }
        .footer-social:hover { background: rgba(22,139,255,.12); border-color: #168bff; }
        .footer-bottom {
            margin-top: 38px; padding-top: 20px;
            border-top: 1px solid #203650;
            color: #91a6c0; font-size: 13px;
        }
        html[data-theme="light"] .portfolio-footer { background: #eaf2fb; border-color: #d7e4f1; color: #334e6c; }
        html[data-theme="light"] .portfolio-footer h5,
        html[data-theme="light"] .footer-brand { color: #152b45; }
        html[data-theme="light"] .portfolio-footer p,
        html[data-theme="light"] .portfolio-footer a,
        html[data-theme="light"] .footer-bottom { color: #526c89; }
        html[data-theme="light"] .footer-bottom { border-color: #d7e4f1; }
        @media (max-width: 1199.98px) {
            .portfolio-navbar .navbar-collapse {
                margin-top: 14px; padding: 14px;
                background: #10233b; border: 1px solid #284463; border-radius: 15px;
            }
            .portfolio-navbar .nav-link { display: block; width: 100%; }
            .navbar-actions { padding: 10px 12px 2px; justify-content: flex-start; }
        }
        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { transition-duration: .01ms !important; animation-duration: .01ms !important; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-xl navbar-dark portfolio-navbar" aria-label="Điều hướng chính">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}" aria-label="Portfolio - Trang chủ">
                <span class="brand-icon"><i class="bi bi-code-slash"></i></span>
                <span>Portfolio</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#portfolioNavbar" aria-controls="portfolioNavbar" aria-expanded="false" aria-label="Mở menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="portfolioNavbar">
                <ul class="navbar-nav ms-auto align-items-xl-center gap-xl-1">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}" @if(request()->routeIs('about')) aria-current="page" @endif>Giới thiệu</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('projects', 'projects.show') ? 'active' : '' }}" href="{{ route('projects') }}" @if(request()->routeIs('projects', 'projects.show')) aria-current="page" @endif>Dự án</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('skills') ? 'active' : '' }}" href="{{ route('skills') }}" @if(request()->routeIs('skills')) aria-current="page" @endif>Kỹ năng</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}" @if(request()->routeIs('contact')) aria-current="page" @endif>Liên hệ</a></li>
                </ul>
                <div class="navbar-actions d-flex align-items-center gap-2 ms-xl-3">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="nav-link" title="Trang quản trị"><i class="bi bi-speedometer2"></i><span class="d-xl-none ms-2">Admin</span></a>
                    @endauth
                    <button type="button" id="themeToggle" class="theme-toggle" aria-label="Chuyển đổi giao diện sáng tối" aria-pressed="false" title="Đổi giao diện"><i class="bi bi-moon-stars-fill"></i></button>
                    <a href="{{ route('cv.download') }}" class="btn-cv"><i class="bi bi-download"></i> Tải CV</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="portfolio-main" id="main-content">
        @yield('content')
    </main>

    <footer class="portfolio-footer">
        <div class="container">
            <div class="row g-4 g-lg-5">
                <div class="col-lg-5">
                    <div class="footer-brand mb-3"><span class="footer-brand-icon"><i class="bi bi-code-slash"></i></span> Đỗ Quốc Việt</div>
                    <p>Không gian giới thiệu bản thân, kỹ năng lập trình, kỹ năng cá nhân và những dự án công nghệ mình đã thực hiện.</p>
                    <div class="mt-3">
                        <a class="footer-social" href="{{ route('projects') }}" aria-label="Dự án" title="Dự án"><i class="bi bi-folder2-open"></i></a>
                        <a class="footer-social" href="{{ route('skills') }}" aria-label="Kỹ năng" title="Kỹ năng"><i class="bi bi-tools"></i></a>
                        <a class="footer-social" href="{{ route('contact') }}" aria-label="Liên hệ" title="Liên hệ"><i class="bi bi-envelope"></i></a>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <h5>Khám phá</h5>
                    <div class="footer-links d-flex flex-column align-items-start">
                        <a href="{{ route('home') }}">Trang chủ</a>
                        <a href="{{ route('about') }}">Giới thiệu</a>
                        <a href="{{ route('projects') }}">Dự án</a>
                        <a href="{{ route('skills') }}">Kỹ năng</a>
                        <a href="{{ route('experience') }}">Kinh nghiệm</a>
                    </div>
                </div>
                <div class="col-6 col-lg-4">
                    <h5>Kết nối</h5>
                    <p>Bạn muốn trao đổi về dự án, công nghệ hoặc cơ hội hợp tác? Hãy gửi tin nhắn cho mình.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary text-white px-4 py-2"><i class="bi bi-send me-2"></i>Gửi tin nhắn</a>
                </div>
            </div>
            
<div class="footer-bottom d-flex justify-content-center text-center">
    <span>Thiết kế và phát triển bởi Đỗ Quốc Việt</span>
</div>

        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dark-mode.js') }}?v=109" defer></script>
    @stack('scripts')
</body>
</html>
