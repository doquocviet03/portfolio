<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php

        $seoTitle = trim($__env->yieldContent('title', 'Personal Portfolio'));

        $seoDescription = trim($__env->yieldContent('meta_description', 'Website Portfolio cá nhân giới thiệu bản thân, kỹ năng, dự án và kinh nghiệm trong lĩnh vực Công nghệ thông tin.'));

        $seoImage = trim($__env->yieldContent('meta_image', asset('images/portfolio-og.png')));

        $seoUrl = url()->current();

    @endphp

    <title>{{ $seoTitle }}</title>

    <meta name="description" content="{{ $seoDescription }}">

    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ $seoUrl }}">

    <meta property="og:type" content="website">

    <meta property="og:locale" content="vi_VN">

    <meta property="og:site_name" content="Personal Portfolio">

    <meta property="og:title" content="{{ $seoTitle }}">

    <meta property="og:description" content="{{ $seoDescription }}">

    <meta property="og:url" content="{{ $seoUrl }}">

    <meta property="og:image" content="{{ $seoImage }}">

    <meta property="og:image:alt" content="Personal Portfolio">

    <meta name="twitter:card" content="summary_large_image">

    <meta name="twitter:title" content="{{ $seoTitle }}">

    <meta name="twitter:description" content="{{ $seoDescription }}">

    <meta name="twitter:image" content="{{ $seoImage }}">

    <meta name="theme-color" content="#0b1220">

    <script>

        (function () {

            try {

                const saved = localStorage.getItem('portfolio-theme');

                document.documentElement.dataset.theme = (saved === 'dark' || saved === 'light')

                    ? saved

                    : (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

            } catch (error) {

                document.documentElement.dataset.theme = 'light';
                document.documentElement.setAttribute('data-bs-theme', 'light');

            }

        })();

    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>

        :root {

            --primary: #2563eb;

            --primary-light: #60a5fa;

            --dark: #0b1220;

            --text: #1e293b;

            --muted: #64748b;

            --border: #e2e8f0;

        }

        html { scroll-behavior: smooth; }

        body { font-family: Inter, 'Segoe UI', system-ui, -apple-system, sans-serif; background: #f8fafc; color: var(--text); min-height: 100vh; display: flex; flex-direction: column; }

        .portfolio-navbar { background: rgba(9, 16, 31, .97); backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px); border-bottom: 1px solid rgba(148,163,184,.13); padding: 12px 0; position: sticky; top: 0; z-index: 1030; box-shadow: 0 10px 35px rgba(2,6,23,.08); }

        .portfolio-navbar .navbar-brand { display: inline-flex; align-items: center; gap: 10px; color: #fff; font-size: 21px; font-weight: 800; letter-spacing: -.65px; text-decoration: none; }

        .portfolio-navbar .brand-icon { display: inline-grid; place-items: center; width: 42px; height: 42px; border-radius: 13px; background: linear-gradient(135deg,#2563eb,#7c3aed); box-shadow: 0 5px 18px rgba(37,99,235,.25); font-size: 19px; }

        .portfolio-navbar .brand-dot { color: #60a5fa; }

        .portfolio-navbar .nav-link { display: inline-flex; align-items: center; gap: 7px; padding: 10px 12px !important; border-radius: 10px; color: #b9c6db; font-size: 13.5px; font-weight: 600; white-space: nowrap; transition: background-color .2s ease, color .2s ease, transform .2s ease; }

        .portfolio-navbar .nav-link:hover { color: #fff; background: rgba(96,165,250,.12); }

        .portfolio-navbar .nav-link.active:not(.nav-contact) { color: #fff; background: rgba(59,130,246,.2); }

        .portfolio-navbar .nav-contact { color: #fff !important; background: linear-gradient(135deg,#2563eb,#3b82f6); padding: 10px 16px !important; box-shadow: 0 5px 16px rgba(37,99,235,.2); }

        .portfolio-navbar .nav-contact:hover { background: linear-gradient(135deg,#1d4ed8,#2563eb); transform: translateY(-1px); }

        .portfolio-navbar .navbar-toggler { border: 1px solid rgba(148,163,184,.3); border-radius: 10px; padding: 8px 11px; }

        .portfolio-navbar .navbar-toggler:focus { box-shadow: 0 0 0 3px rgba(96,165,250,.25); }

        .portfolio-navbar .theme-toggle { display: inline-grid; place-items: center; flex-shrink: 0; width: 40px; height: 40px; border: 1px solid rgba(148,163,184,.35); border-radius: 11px; background: rgba(148,163,184,.1); color: #f8fafc; cursor: pointer; transition: background-color .2s, transform .2s; }

        .portfolio-navbar .theme-toggle:hover { background: rgba(148,163,184,.23); transform: translateY(-1px); }

        .portfolio-main { flex: 1; width: 100%; }

        .btn { border-radius: 11px; font-weight: 600; transition: background-color .2s, border-color .2s, transform .2s; }

        .btn-primary { background: #2563eb; border-color: #2563eb; }

        .btn-primary:hover { background: #1d4ed8; border-color: #1d4ed8; transform: translateY(-1px); }

        .portfolio-footer { margin-top: 64px; padding: 64px 0 24px; background: #0b1220; color: #cbd5e1; border-top: 1px solid #1e293b; }

        .portfolio-footer .footer-brand { display: inline-flex; align-items: center; gap: 10px; color: #fff; font-weight: 800; font-size: 22px; letter-spacing: -.5px; }

        .portfolio-footer .footer-brand-icon { display: inline-grid; place-items: center; width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg,#2563eb,#7c3aed); }

        .portfolio-footer h5 { color: #fff; font-size: 15px; font-weight: 700; margin-bottom: 18px; }

        .portfolio-footer p { color: #94a3b8; line-height: 1.85; max-width: 430px; }

        .portfolio-footer a { color: #cbd5e1; text-decoration: none; transition: color .2s, border-color .2s, background-color .2s; }

        .portfolio-footer a:hover { color: #93c5fd; }

        .portfolio-footer .footer-links a { display: inline-block; margin-bottom: 13px; font-size: 14px; }

        .portfolio-footer .footer-social { display: inline-grid; place-items: center; width: 42px; height: 42px; border: 1px solid #334155; border-radius: 12px; font-size: 18px; margin-right: 8px; }

        .portfolio-footer .footer-social:hover { border-color: #60a5fa; background: rgba(59,130,246,.1); }

        .portfolio-footer .footer-bottom { border-top: 1px solid #26354a; margin-top: 42px; padding-top: 22px; font-size: 13px; color: #94a3b8; }

        @media (max-width:1199.98px) {

            .portfolio-navbar .navbar-collapse { margin-top: 15px; padding: 14px; background: #111e33; border: 1px solid #26354a; border-radius: 16px; }

            .portfolio-navbar .nav-link { display: flex; width: 100%; }

            .portfolio-navbar .nav-contact { margin-top: 6px; justify-content: center; }

            .portfolio-navbar .theme-toggle { margin-top: 6px; }

        }

        @media (prefers-reduced-motion:reduce) { html { scroll-behavior: auto; } *, *::before, *::after { transition-duration: .01ms !important; } }

    </style>

    <link rel="stylesheet" href="{{ asset('css/dark-mode.css') }}?v=108">

    @stack('styles')

</head>

<body>

    <nav class="navbar navbar-expand-xl navbar-dark portfolio-navbar" aria-label="Điều hướng chính">

        <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}" aria-label="Portfolio - Trang chủ">

                <span class="brand-icon"><i class="bi bi-code-slash"></i></span>

                <span>Portfolio<span class="brand-dot">.</span></span>

            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#portfolioNavbar" aria-controls="portfolioNavbar" aria-expanded="false" aria-label="Mở menu">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="portfolioNavbar">

                <ul class="navbar-nav ms-auto align-items-xl-center gap-xl-1">

                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Trang chủ</a></li>

                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}" @if(request()->routeIs('about')) aria-current="page" @endif>Giới thiệu</a></li>

                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('skills') ? 'active' : '' }}" href="{{ route('skills') }}" @if(request()->routeIs('skills')) aria-current="page" @endif>Kỹ năng</a></li>

                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('projects', 'projects.show') ? 'active' : '' }}" href="{{ route('projects') }}" @if(request()->routeIs('projects', 'projects.show')) aria-current="page" @endif>Dự án</a></li>

                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('experience') ? 'active' : '' }}" href="{{ route('experience') }}" @if(request()->routeIs('experience')) aria-current="page" @endif>Kinh nghiệm</a></li>

                    <li class="nav-item"><a class="nav-link nav-contact {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}" @if(request()->routeIs('contact')) aria-current="page" @endif><i class="bi bi-envelope"></i> Liên hệ</a></li>

                    @auth

                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Admin</a></li>

                    @endauth

                    <li class="nav-item d-flex align-items-center py-2 py-xl-0 ms-xl-1">

                        <button type="button" id="themeToggle" class="theme-toggle" aria-label="Chuyển đổi giao diện" aria-pressed="false" title="Đổi giao diện"><i class="bi bi-moon-stars-fill"></i></button>

                    </li>

                </ul>

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

                    <div class="footer-brand mb-3"><span class="footer-brand-icon"><i class="bi bi-code-slash"></i></span> Portfolio<span style="color:#60a5fa">.</span></div>

                    <p>Không gian giới thiệu hành trình học tập, kỹ năng, kinh nghiệm và những dự án công nghệ mình đã thực hiện.</p>

                    <div class="mt-3">

                        <a class="footer-social" href="{{ route('projects') }}" aria-label="Xem dự án"><i class="bi bi-folder2-open"></i></a>

                        <a class="footer-social" href="{{ route('skills') }}" aria-label="Xem kỹ năng"><i class="bi bi-tools"></i></a>

                        <a class="footer-social" href="{{ route('contact') }}" aria-label="Liên hệ"><i class="bi bi-envelope"></i></a>

                    </div>

                </div>

                <div class="col-6 col-lg-3">

                    <h5>Khám phá</h5>

                    <div class="footer-links d-flex flex-column align-items-start">

                        <a href="{{ route('home') }}">Trang chủ</a>

                        <a href="{{ route('about') }}">Giới thiệu</a>

                        <a href="{{ route('skills') }}">Kỹ năng</a>

                        <a href="{{ route('projects') }}">Dự án</a>

                        <a href="{{ route('experience') }}">Kinh nghiệm</a>

                    </div>

                </div>

                <div class="col-6 col-lg-4">

                    <h5>Kết nối</h5>

                    <p>Bạn muốn trao đổi về dự án, công nghệ hoặc cơ hội hợp tác? Mình luôn sẵn sàng lắng nghe.</p>

                    <a href="{{ route('contact') }}" class="btn btn-primary text-white px-4 py-2"><i class="bi bi-send me-2"></i>Gửi tin nhắn</a>

                </div>

            </div>

            <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between gap-2">

                <span>© {{ date('Y') }} Portfolio. All rights reserved.</span>

                <span>Built with <i class="bi bi-heart-fill text-danger"></i> Laravel &amp; Bootstrap</span>

            </div>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/dark-mode.js') }}?v=108" defer></script>

    @stack('scripts')

</body>

</html>
