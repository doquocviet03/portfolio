
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Personal Portfolio')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-light: #60a5fa;
            --dark: #0b1220;
            --text: #1e293b;
            --muted: #64748b;
            --border: #e2e8f0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f8fafc;
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */

        .portfolio-navbar {
            background: rgba(11, 18, 32, 0.97);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(148, 163, 184, 0.15);
            padding: 13px 0;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .portfolio-navbar .navbar-brand {
            font-size: 23px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.5px;
        }

        .portfolio-navbar .brand-icon {
            display: inline-flex;
            width: 39px;
            height: 39px;
            justify-content: center;
            align-items: center;
            border-radius: 11px;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            margin-right: 8px;
        }

        .portfolio-navbar .nav-link {
            color: #cbd5e1;
            font-weight: 500;
            padding: 10px 13px !important;
            border-radius: 9px;
            transition: all 0.2s;
        }

        .portfolio-navbar .nav-link:hover,
        .portfolio-navbar .nav-link.active {
            color: #fff;
            background: rgba(59, 130, 246, 0.18);
        }

        .portfolio-navbar .nav-contact {
            background: #2563eb;
            color: white !important;
            border-radius: 10px;
            padding: 10px 18px !important;
        }

        .portfolio-navbar .nav-contact:hover {
            background: #1d4ed8;
        }

        .portfolio-navbar .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.25);
        }

        .portfolio-navbar .navbar-toggler:focus {
            box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.5);
        }

        /* MAIN */

        .portfolio-main {
            flex: 1;
        }

        /* GLOBAL BUTTONS */

        .btn {
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #2563eb;
            border-color: #2563eb;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
            transform: translateY(-2px);
        }

        .btn-outline-primary:hover {
            transform: translateY(-2px);
        }

        /* FOOTER */

        .portfolio-footer {
            background: #0b1220;
            color: #cbd5e1;
            padding: 55px 0 22px;
            margin-top: 50px;
        }

        .portfolio-footer h5 {
            color: white;
            font-weight: 700;
        }

        .portfolio-footer p {
            color: #94a3b8;
            line-height: 1.8;
        }

        .portfolio-footer a {
            display: inline-block;
            color: #cbd5e1;
            text-decoration: none;
            margin-bottom: 10px;
            transition: color 0.2s;
        }

        .portfolio-footer a:hover {
            color: #60a5fa;
        }

        .footer-social {
            display: inline-flex !important;
            width: 38px;
            height: 38px;
            align-items: center;
            justify-content: center;
            border: 1px solid #334155;
            border-radius: 10px;
            margin-right: 8px;
            font-size: 18px;
        }

        .footer-social:hover {
            border-color: #60a5fa;
        }

        .footer-bottom {
            border-top: 1px solid #334155;
            padding-top: 20px;
            margin-top: 35px;
            font-size: 14px;
            color: #94a3b8;
        }

        @media (max-width: 991px) {
            .portfolio-navbar .navbar-collapse {
                padding-top: 15px;
            }

            .portfolio-navbar .nav-contact {
                display: inline-block;
                margin-top: 8px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark portfolio-navbar">

        <div class="container">

            <a class="navbar-brand d-flex align-items-center"
               href="{{ url('/') }}">

                <span class="brand-icon">
                    <i class="bi bi-code-slash"></i>
                </span>

                Portfolio<span style="color:#60a5fa">.</span>
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#portfolioNavbar"
                    aria-controls="portfolioNavbar"
                    aria-expanded="false"
                    aria-label="Mở menu">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse"
                 id="portfolioNavbar">

                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                           href="{{ url('/') }}">
                            Trang chủ
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}"
                           href="{{ url('/about') }}">
                            Giới thiệu
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('skills') ? 'active' : '' }}"
                           href="{{ url('/skills') }}">
                            Kỹ năng
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('projects') ? 'active' : '' }}"
                           href="{{ url('/projects') }}">
                            Dự án
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('experience') ? 'active' : '' }}"
                           href="{{ url('/experience') }}">
                            Kinh nghiệm
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-contact {{ request()->is('contact') ? 'active' : '' }}"
                           href="{{ url('/contact') }}">
                            <i class="bi bi-envelope me-1"></i>
                            Liên hệ
                        </a>
                    </li>

                    @auth
                        <li class="nav-item ms-lg-2">
                            <a class="nav-link"
                               href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i>
                                Admin
                            </a>
                        </li>
                    @endauth

                </ul>

            </div>

        </div>

    </nav>


    <!-- NỘI DUNG CÁC TRANG -->
    <main class="portfolio-main">

        @if(session('success'))
            <div class="container mt-4">
                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">
                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Đóng"></button>
                </div>
            </div>
        @endif

        @yield('content')

    </main>


    <!-- FOOTER -->
    <footer class="portfolio-footer">

        <div class="container">

            <div class="row g-4">

                <div class="col-lg-5">

                    <h5 class="fs-4 mb-3">
                        <i class="bi bi-code-slash text-primary me-2"></i>
                        Portfolio.
                    </h5>

                    <p>
                        Website Portfolio cá nhân được xây dựng
                        nhằm giới thiệu bản thân, kỹ năng,
                        các dự án đã thực hiện và
                        định hướng phát triển trong
                        lĩnh vực Công nghệ thông tin.
                    </p>

                    <div class="mt-3">
                        <a class="footer-social"
                           href="{{ url('/projects') }}"
                           aria-label="Xem dự án">
                            <i class="bi bi-folder2-open"></i>
                        </a>

                        <a class="footer-social"
                           href="{{ url('/skills') }}"
                           aria-label="Xem kỹ năng">
                            <i class="bi bi-tools"></i>
                        </a>

                        <a class="footer-social"
                           href="{{ url('/contact') }}"
                           aria-label="Liên hệ">
                            <i class="bi bi-envelope"></i>
                        </a>
                    </div>

                </div>

                <div class="col-6 col-lg-3">

                    <h5 class="mb-3">Khám phá</h5>

                    <div class="d-flex flex-column">
                        <a href="{{ url('/') }}">Trang chủ</a>
                        <a href="{{ url('/about') }}">Giới thiệu</a>
                        <a href="{{ url('/skills') }}">Kỹ năng</a>
                        <a href="{{ url('/projects') }}">Dự án</a>
                    </div>

                </div>

                <div class="col-6 col-lg-4">

                    <h5 class="mb-3">Kết nối</h5>

                    <p>
                        Bạn muốn tìm hiểu thêm về các dự án
                        hoặc trao đổi về công nghệ?
                        Hãy gửi tin nhắn qua trang liên hệ.
                    </p>

                    <a href="{{ url('/contact') }}"
                       class="btn btn-primary text-white px-4">
                        <i class="bi bi-send me-2"></i>
                        Gửi tin nhắn
                    </a>

                </div>

            </div>

            <div class="footer-bottom">

                <div class="row align-items-center g-2">

                    <div class="col-md-6">
                        © {{ date('Y') }} Portfolio.
                        All rights reserved.
                    </div>

                    <div class="col-md-6 text-md-end">
                        Made with
                        <i class="bi bi-heart-fill text-danger"></i>
                        using Laravel & Bootstrap
                    </div>

                </div>

            </div>

        </div>

    </footer>


    <!-- BOOTSTRAP JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
