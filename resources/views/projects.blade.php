
@extends('layouts.app')

@section('title', 'Dự án | Portfolio')

@section('content')

<style>
    .projects-page {
        --project-primary: #2563eb;
        --project-dark: #0b1220;
    }

    .projects-page .projects-hero {
        background: linear-gradient(135deg, #0b1220, #172554, #312e81);
        color: white;
        border-radius: 24px;
        padding: 65px 35px;
        margin: 30px 0 45px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .projects-page .projects-hero::after {
        content: "";
        position: absolute;
        width: 250px;
        height: 250px;
        border-radius: 50%;
        background: rgba(96,165,250,.15);
        filter: blur(40px);
        right: -60px;
        top: -100px;
    }

    .projects-page .hero-label {
        display: inline-block;
        color: #93c5fd;
        background: rgba(59,130,246,.15);
        border: 1px solid rgba(147,197,253,.3);
        padding: 8px 17px;
        border-radius: 30px;
        font-size: 13px;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .projects-page .projects-title {
        font-size: clamp(32px, 5vw, 48px);
        font-weight: 800;
        margin-bottom: 18px;
    }

    .projects-page .projects-subtitle {
        color: #cbd5e1;
        max-width: 650px;
        margin: auto;
        line-height: 1.8;
    }

    .projects-page .project-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
        height: 100%;
        transition: all .3s ease;
    }

    .projects-page .project-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 18px 40px rgba(15,23,42,.12);
        border-color: #93c5fd;
    }

    .projects-page .project-image {
        height: 210px;
        background: linear-gradient(135deg, #1d4ed8, #7c3aed);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 65px;
        overflow: hidden;
    }

    .projects-page .project-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s;
    }

    .projects-page .project-card:hover .project-image img {
        transform: scale(1.05);
    }

    .projects-page .project-content {
        padding: 26px;
    }

    .projects-page .project-name {
        font-size: 21px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 14px;
    }

    .projects-page .project-description {
        color: #64748b;
        line-height: 1.8;
        min-height: 75px;
    }

    .projects-page .tech-label {
        display: inline-block;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 30px;
        padding: 7px 13px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 15px;
        overflow-wrap: anywhere;
    }

    .projects-page .project-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .projects-page .project-actions .btn {
        padding: 9px 18px;
        font-size: 14px;
    }

    .projects-page .empty-state {
        background: white;
        border: 1px dashed #cbd5e1;
        border-radius: 20px;
        padding: 70px 25px;
        text-align: center;
    }

    .projects-page .bottom-cta {
        background: #eff6ff;
        border-radius: 20px;
        padding: 40px 25px;
        text-align: center;
        margin-top: 65px;
    }

    @media(max-width: 768px) {
        .projects-page .projects-hero {
            padding: 45px 22px;
            border-radius: 16px;
        }

        .projects-page .project-image {
            height: 190px;
        }
    }
</style>

<div class="container projects-page pb-5">

    <!-- HEADER -->
    <section class="projects-hero">

        <div class="position-relative" style="z-index:1">

            <span class="hero-label">
                MY PORTFOLIO PROJECTS
            </span>

            <h1 class="projects-title">
                🚀 Dự án của tôi
            </h1>

            <p class="projects-subtitle">
                Khám phá những dự án tôi đã thực hiện
                trong quá trình học tập và phát triển
                kỹ năng lập trình. Mỗi dự án là một
                cơ hội để tôi vận dụng kiến thức,
                giải quyết vấn đề và tạo ra
                những sản phẩm hữu ích.
            </p>

        </div>

    </section>

    <!-- THỐNG KÊ -->
    <div class="d-flex align-items-center justify-content-between
                flex-wrap gap-3 mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Danh sách dự án
            </h3>

            <p class="text-muted mb-0">
                Các sản phẩm và bài thực hành nổi bật
            </p>
        </div>

        <span class="badge bg-primary rounded-pill px-3 py-2">
            {{ $projects->count() }} dự án
        </span>

    </div>

    <!-- DANH SÁCH DỰ ÁN -->
    <div class="row g-4">

        @forelse($projects as $project)

            <div class="col-md-6 col-lg-4">

                <div class="project-card">

                    <!-- ẢNH DỰ ÁN -->
                    <div class="project-image">

                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}"
                                 alt="{{ $project->title }}"
                                 loading="lazy">
                        @else
                            <i class="bi bi-code-square"></i>
                        @endif

                    </div>

                    <!-- NỘI DUNG -->
                    <div class="project-content">

                        <h4 class="project-name">
                            {{ $project->title }}
                        </h4>

                        <p class="project-description">
                            {{ \Illuminate\Support\Str::limit($project->description, 145) }}
                        </p>

                        @if($project->technologies)
                            <div>
                                <span class="tech-label">
                                    <i class="bi bi-cpu me-1"></i>
                                    {{ $project->technologies }}
                                </span>
                            </div>
                        @endif

                        <div class="project-actions">

                            @if($project->github_url)
                                <a href="{{ $project->github_url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="btn btn-dark">

                                    <i class="bi bi-github me-1"></i>
                                    GitHub
                                </a>
                            @endif

                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="btn btn-primary">

                                    <i class="bi bi-box-arrow-up-right me-1"></i>
                                    Live Demo
                                </a>
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="empty-state">

                    <div class="display-3 text-primary mb-3">
                        <i class="bi bi-folder2-open"></i>
                    </div>

                    <h4 class="fw-bold">
                        Chưa có dự án nào
                    </h4>

                    <p class="text-muted mb-0">
                        Các dự án sẽ được hiển thị tại đây
                        sau khi cập nhật từ hệ thống quản trị.
                    </p>

                </div>

            </div>

        @endforelse

    </div>

    <!-- LIÊN HỆ -->
    <section class="bottom-cta">

        <h3 class="fw-bold mb-3">
            Bạn quan tâm đến các dự án của tôi?
        </h3>

        <p class="text-muted mb-4">
            Hãy liên hệ để cùng trao đổi về
            công nghệ và những ý tưởng phát triển phần mềm.
        </p>

        <a href="{{ url('/contact') }}"
           class="btn btn-primary px-4">
            <i class="bi bi-envelope me-2"></i>
            Liên hệ với tôi
        </a>

    </section>

</div>

@endsection
