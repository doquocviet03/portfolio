
@extends('layouts.app')

@section('title', 'Trang chủ | Personal Portfolio')

@section('content')

<style>
    /* =================================
       HOME PAGE
    ================================= */

    .modern-home {
        --home-blue: #2563eb;
        --home-dark: #0b1220;
    }

    /* HERO */

    .modern-home .hero-section {
        background: linear-gradient(
            135deg,
            #0b1220 0%,
            #172554 55%,
            #312e81 100%
        );

        color: #fff;
        border-radius: 26px;
        padding: 75px 55px;
        margin: 30px 0 60px;
        position: relative;
        overflow: hidden;
    }

    .modern-home .hero-section::before {
        content: "";
        position: absolute;
        width: 350px;
        height: 350px;
        border-radius: 50%;
        background: rgba(96, 165, 250, .17);
        filter: blur(55px);
        right: -100px;
        top: -130px;
    }

    .modern-home .hero-content {
        position: relative;
        z-index: 2;
    }

    .modern-home .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        background: rgba(59,130,246,.15);
        border: 1px solid rgba(147,197,253,.3);
        color: #bfdbfe;
        padding: 9px 17px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 25px;
    }

    .modern-home .hero-title {
        font-size: clamp(34px, 4.5vw, 57px);
        font-weight: 850;
        line-height: 1.2;
        margin-bottom: 23px;
        letter-spacing: -1px;
    }

    .modern-home .gradient-text {
        background: linear-gradient(90deg, #60a5fa, #c4b5fd);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .modern-home .hero-description {
        color: #cbd5e1;
        line-height: 1.9;
        font-size: 16px;
        max-width: 580px;
        margin-bottom: 30px;
    }

    .modern-home .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
    }

    .modern-home .hero-actions .btn {
        padding: 13px 25px;
        border-radius: 12px;
        font-weight: 700;
    }

    .modern-home .hero-outline {
        color: #fff;
        border: 1px solid #64748b;
        background: transparent;
    }

    .modern-home .hero-outline:hover {
        color: #fff;
        border-color: #93c5fd;
        background: rgba(59,130,246,.15);
    }

    /* CODE WINDOW */

    .modern-home .code-window {
        background: #0b1220;
        border: 1px solid #334155;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 25px 60px rgba(0,0,0,.25);
    }

    .modern-home .code-header {
        background: #1e293b;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .modern-home .code-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
    }

    .modern-home .code-body {
        padding: 25px;
        font-family: Consolas, monospace;
        font-size: 13px;
        line-height: 2.1;
        color: #e2e8f0;
        overflow-wrap: anywhere;
    }

    .modern-home .code-blue {
        color: #93c5fd;
    }

    .modern-home .code-green {
        color: #86efac;
    }

    .modern-home .code-purple {
        color: #c4b5fd;
    }

    /* COMMON SECTIONS */

    .modern-home .section-header {
        margin-bottom: 30px;
    }

    .modern-home .section-label {
        color: #2563eb;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 1.5px;
        margin-bottom: 12px;
        display: block;
    }

    .modern-home .section-title {
        color: #0f172a;
        font-size: clamp(26px, 4vw, 35px);
        font-weight: 800;
        margin-bottom: 13px;
    }

    .modern-home .section-subtitle {
        color: #64748b;
        line-height: 1.8;
        max-width: 650px;
    }

    .modern-home .home-section {
        margin-bottom: 75px;
    }

    /* STATS */

    .modern-home .stat-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 25px;
        height: 100%;
        text-align: center;
        transition: .3s;
    }

    .modern-home .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(15,23,42,.08);
    }

    .modern-home .stat-number {
        font-size: 35px;
        font-weight: 800;
        color: #2563eb;
    }

    .modern-home .stat-label {
        color: #64748b;
        font-weight: 600;
        font-size: 14px;
    }

    /* SERVICE CARDS */

    .modern-home .service-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 30px;
        height: 100%;
        transition: .3s;
    }

    .modern-home .service-card:hover {
        transform: translateY(-6px);
        border-color: #93c5fd;
        box-shadow: 0 18px 40px rgba(15,23,42,.09);
    }

    .modern-home .service-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin-bottom: 23px;
    }

    .modern-home .service-card h3 {
        font-size: 20px;
        font-weight: 750;
        margin-bottom: 14px;
    }

    .modern-home .service-card p {
        color: #64748b;
        line-height: 1.85;
        margin-bottom: 0;
    }

    /* PROJECTS */

    .modern-home .project-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
        height: 100%;
        transition: .3s;
    }

    .modern-home .project-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(15,23,42,.10);
    }

    .modern-home .project-image {
        height: 200px;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 55px;
        overflow: hidden;
    }

    .modern-home .project-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s;
    }

    .modern-home .project-card:hover .project-image img {
        transform: scale(1.05);
    }

    .modern-home .project-content {
        padding: 25px;
    }

    .modern-home .project-name {
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .modern-home .project-description {
        color: #64748b;
        line-height: 1.8;
        min-height: 75px;
    }

    .modern-home .tech-badge {
        display: inline-block;
        color: #2563eb;
        background: #eff6ff;
        border-radius: 30px;
        padding: 7px 13px;
        font-size: 12px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    /* SKILLS */

    .modern-home .skill-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 25px;
        height: 100%;
        transition: .3s;
    }

    .modern-home .skill-card:hover {
        transform: translateY(-4px);
        border-color: #93c5fd;
    }

    .modern-home .skill-name {
        font-weight: 750;
        color: #0f172a;
        overflow-wrap: anywhere;
    }

    .modern-home .skill-level {
        font-weight: 800;
        color: #2563eb;
    }

    .modern-home .skill-progress {
        background: #e2e8f0;
        height: 9px;
        border-radius: 30px;
        overflow: hidden;
        margin-top: 18px;
    }

    .modern-home .skill-fill {
        background: linear-gradient(90deg, #2563eb, #7c3aed);
        height: 100%;
        border-radius: 30px;
    }

    /* EXPERIENCE */

    .modern-home .experience-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #2563eb;
        border-radius: 16px;
        padding: 25px;
        height: 100%;
        transition: .3s;
    }

    .modern-home .experience-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(15,23,42,.08);
    }

    .modern-home .experience-date {
        font-size: 13px;
        font-weight: 700;
        color: #2563eb;
        margin-bottom: 12px;
    }

    .modern-home .experience-title {
        font-size: 19px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 9px;
    }

    .modern-home .experience-company {
        color: #475569;
        font-weight: 600;
        margin-bottom: 13px;
    }

    .modern-home .experience-description {
        color: #64748b;
        line-height: 1.8;
        white-space: pre-line;
    }

    /* CTA */

    .modern-home .home-cta {
        background: linear-gradient(135deg, #0b1220, #1e3a8a);
        border-radius: 24px;
        padding: 55px 30px;
        text-align: center;
        color: white;
    }

    .modern-home .home-cta h2 {
        font-size: clamp(25px, 4vw, 36px);
        font-weight: 800;
    }

    .modern-home .home-cta p {
        color: #cbd5e1;
        max-width: 620px;
        margin: 18px auto 28px;
        line-height: 1.9;
    }

    /* EMPTY */

    .modern-home .empty-state {
        background: white;
        border: 1px dashed #cbd5e1;
        border-radius: 18px;
        padding: 45px 20px;
        text-align: center;
        color: #64748b;
    }

    @media(max-width: 991px) {
        .modern-home .hero-section {
            padding: 50px 30px;
        }

        .modern-home .code-window {
            margin-top: 35px;
        }
    }

    @media(max-width: 576px) {
        .modern-home .hero-section {
            padding: 40px 22px;
            border-radius: 18px;
        }

        .modern-home .code-body {
            padding: 17px;
            font-size: 11px;
        }

        .modern-home .hero-actions .btn {
            width: 100%;
        }
    }
</style>


<div class="container modern-home pb-5">

    <!-- =================================
         HERO
    ================================= -->

    <section class="hero-section">

        <div class="row align-items-center g-5">

            <div class="col-lg-7 hero-content">

                <span class="hero-badge">
                    <i class="bi bi-circle-fill text-success"
                       style="font-size:9px"></i>
                    WELCOME TO MY PORTFOLIO
                </span>

                <h1 class="hero-title">
                    Xin chào! 👋 <br>
                    Tôi đam mê
                    <span class="gradient-text">
                        Lập trình & Công nghệ
                    </span>
                </h1>

                <p class="hero-description">
                    Tôi yêu thích việc xây dựng website,
                    phát triển ứng dụng và tìm hiểu
                    những công nghệ mới.

                    Với tinh thần học hỏi và sáng tạo,
                    tôi luôn cố gắng biến ý tưởng
                    thành những sản phẩm thực tế.
                </p>

                <div class="hero-actions">

                    <a href="{{ url('/projects') }}"
                       class="btn btn-primary">

                        <i class="bi bi-folder2-open me-2"></i>
                        Xem dự án
                    </a>

                    <a href="{{ url('/contact') }}"
                       class="btn hero-outline">

                        <i class="bi bi-envelope me-2"></i>
                        Liên hệ
                    </a>

                </div>

            </div>


            <!-- CODE WINDOW -->
            <div class="col-lg-5 hero-content">

                <div class="code-window">

                    <div class="code-header">

                        <span class="code-dot"
                              style="background:#fb7185"></span>

                        <span class="code-dot"
                              style="background:#fbbf24"></span>

                        <span class="code-dot"
                              style="background:#4ade80"></span>

                        <span class="ms-auto text-secondary small">
                            developer.php
                        </span>

                    </div>

                    <div class="code-body">

                        <div>
                            <span class="code-purple">&lt;?php</span>
                        </div>

                        <div>
                            <span class="code-blue">class</span>
                            Developer {
                        </div>

                        <div class="ps-3">
                            <span class="code-purple">public</span>
                            $passion =
                            <span class="code-green">
                                'Web Development';
                            </span>
                        </div>

                        <div class="ps-3">
                            <span class="code-purple">public</span>
                            $framework =
                            <span class="code-green">
                                'Laravel';
                            </span>
                        </div>

                        <div class="ps-3">
                            <span class="code-purple">public</span>
                            $database =
                            <span class="code-green">
                                'MySQL';
                            </span>
                        </div>

                        <div class="ps-3">
                            <span class="code-purple">public</span>
                            $mindset =
                            <span class="code-green">
                                'Keep Learning';
                            </span>
                        </div>

                        <div>}</div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =================================
         STATS
    ================================= -->

    <section class="home-section">

        <div class="row g-4">

            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-number">
                        {{ $projects->count() }}+
                    </div>

                    <div class="stat-label">
                        Dự án nổi bật
                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-number">
                        {{ $skills->count() }}+
                    </div>

                    <div class="stat-label">
                        Kỹ năng công nghệ
                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-number">
                        {{ $experiences->count() }}+
                    </div>

                    <div class="stat-label">
                        Trải nghiệm nổi bật
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =================================
         ABOUT SHORT
    ================================= -->

    <section class="home-section">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <span class="section-label">
                    ABOUT ME
                </span>

                <h2 class="section-title">
                    Một chút về bản thân
                </h2>

                <p class="section-subtitle">
                    Tôi là người yêu thích Công nghệ thông tin,
                    đặc biệt quan tâm đến phát triển website,
                    lập trình ứng dụng và làm việc với dữ liệu.
                </p>

                <p class="section-subtitle">
                    Tôi luôn cố gắng nâng cao kiến thức
                    thông qua việc học tập,
                    thực hành dự án và tìm hiểu
                    những công nghệ mới.
                </p>

                <a href="{{ url('/about') }}"
                   class="btn btn-outline-primary mt-3 px-4">

                    Tìm hiểu thêm về tôi
                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

            </div>

            <div class="col-lg-6">

                <div class="row g-3">

                    <div class="col-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-code-slash"></i>
                            </div>
                            <h3>Lập trình</h3>
                            <p>
                                Xây dựng và phát triển ứng dụng.
                            </p>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-database"></i>
                            </div>
                            <h3>Dữ liệu</h3>
                            <p>
                                Làm việc với cơ sở dữ liệu MySQL.
                            </p>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-palette"></i>
                            </div>
                            <h3>Giao diện</h3>
                            <p>
                                Thiết kế website responsive.
                            </p>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-lightbulb"></i>
                            </div>
                            <h3>Sáng tạo</h3>
                            <p>
                                Tìm kiếm giải pháp công nghệ mới.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =================================
         FEATURED PROJECTS
    ================================= -->

    <section class="home-section">

        <div class="section-header">

            <span class="section-label">
                FEATURED PROJECTS
            </span>

            <h2 class="section-title">
                Dự án nổi bật
            </h2>

            <p class="section-subtitle">
                Một số dự án được thực hiện
                trong quá trình học tập
                và phát triển kỹ năng lập trình.
            </p>

        </div>

        <div class="row g-4">

            @forelse($projects as $project)

                <div class="col-md-6 col-lg-4">

                    <div class="project-card">

                        <div class="project-image">

                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}"
                                     alt="{{ $project->title }}"
                                     loading="lazy">
                            @else
                                <i class="bi bi-code-square"></i>
                            @endif

                        </div>

                        <div class="project-content">

                            <h3 class="project-name">
                                {{ $project->title }}
                            </h3>

                            <p class="project-description">
                                {{ \Illuminate\Support\Str::limit($project->description, 115) }}
                            </p>

                            @if($project->technologies)
                                <div class="mb-3">
                                    <span class="tech-badge">
                                        {{ $project->technologies }}
                                    </span>
                                </div>
                            @endif

                            <div class="d-flex flex-wrap gap-2">

                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="btn btn-sm btn-dark">
                                        <i class="bi bi-github me-1"></i>
                                        GitHub
                                    </a>
                                @endif

                                @if($project->demo_url)
                                    <a href="{{ $project->demo_url }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="btn btn-sm btn-primary">
                                        <i class="bi bi-box-arrow-up-right me-1"></i>
                                        Demo
                                    </a>
                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-folder2-open display-5"></i>
                        <p class="mt-3 mb-0">
                            Chưa có dự án nào được cập nhật.
                        </p>
                    </div>
                </div>

            @endforelse

        </div>

        <div class="text-center mt-4">

            <a href="{{ url('/projects') }}"
               class="btn btn-outline-primary px-4 py-2">

                Xem tất cả dự án
                <i class="bi bi-arrow-right ms-2"></i>

            </a>

        </div>

    </section>


    <!-- =================================
         SKILLS
    ================================= -->

    <section class="home-section">

        <div class="section-header">

            <span class="section-label">
                TECH STACK
            </span>

            <h2 class="section-title">
                Kỹ năng công nghệ
            </h2>

            <p class="section-subtitle">
                Những công nghệ và kỹ năng
                tôi đang sử dụng và tiếp tục phát triển.
            </p>

        </div>

        <div class="row g-4">

            @forelse($skills as $skill)

                @php
                    $level = max(0, min(100, (int) $skill->level));
                @endphp

                <div class="col-md-6 col-lg-4">

                    <div class="skill-card">

                        <div class="d-flex justify-content-between align-items-center">

                            <span class="skill-name">
                                <i class="bi bi-code-square text-primary me-2"></i>
                                {{ $skill->name }}
                            </span>

                            <span class="skill-level">
                                {{ $level }}%
                            </span>

                        </div>

                        <div class="skill-progress"
                             role="progressbar"
                             aria-label="{{ $skill->name }}"
                             aria-valuenow="{{ $level }}"
                             aria-valuemin="0"
                             aria-valuemax="100">

                            <div class="skill-fill"
                                 style="width: {{ $level }}%">
                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="empty-state">
                        Chưa có kỹ năng nào được cập nhật.
                    </div>
                </div>

            @endforelse

        </div>

        <div class="text-center mt-4">

            <a href="{{ url('/skills') }}"
               class="btn btn-outline-primary px-4">

                Xem tất cả kỹ năng
                <i class="bi bi-arrow-right ms-2"></i>

            </a>

        </div>

    </section>


    <!-- =================================
         EXPERIENCE
    ================================= -->

    <section class="home-section">

        <div class="section-header">

            <span class="section-label">
                MY JOURNEY
            </span>

            <h2 class="section-title">
                Hành trình & Kinh nghiệm
            </h2>

            <p class="section-subtitle">
                Những trải nghiệm giúp tôi tích lũy
                kiến thức và phát triển chuyên môn.
            </p>

        </div>

        <div class="row g-4">

            @forelse($experiences as $experience)

                <div class="col-md-6 col-lg-4">

                    <div class="experience-card">

                        <div class="experience-date">

                            <i class="bi bi-calendar-event me-1"></i>

                            @if($experience->start_date)
                                {{ \Illuminate\Support\Carbon::parse($experience->start_date)->format('m/Y') }}
                            @else
                                Chưa xác định
                            @endif

                            —

                            @if($experience->end_date)
                                {{ \Illuminate\Support\Carbon::parse($experience->end_date)->format('m/Y') }}
                            @else
                                Hiện tại
                            @endif

                        </div>

                        <h3 class="experience-title">
                            {{ $experience->title }}
                        </h3>

                        @if($experience->company)
                            <div class="experience-company">
                                <i class="bi bi-building me-1"></i>
                                {{ $experience->company }}
                            </div>
                        @endif

                        <div class="experience-description">
                            {{ \Illuminate\Support\Str::limit($experience->description, 140) }}
                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="empty-state">
                        Chưa có kinh nghiệm nào được cập nhật.
                    </div>
                </div>

            @endforelse

        </div>

        <div class="text-center mt-4">

            <a href="{{ url('/experience') }}"
               class="btn btn-outline-primary px-4">

                Xem hành trình của tôi
                <i class="bi bi-arrow-right ms-2"></i>

            </a>

        </div>

    </section>


    <!-- =================================
         CONTACT CTA
    ================================= -->

    <section class="home-cta">

        <h2>
            Bạn muốn kết nối với tôi?
        </h2>

        <p>
            Tôi luôn sẵn sàng trao đổi
            về lập trình, công nghệ,
            những ý tưởng sáng tạo
            và các dự án thú vị.
        </p>

        <a href="{{ url('/contact') }}"
           class="btn btn-primary px-4 py-3">

            <i class="bi bi-envelope me-2"></i>
            Liên hệ ngay

        </a>

    </section>

</div>

@endsection
