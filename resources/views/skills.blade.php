
@extends('layouts.app')

@section('title', 'Kỹ năng | Portfolio')

@section('content')

<style>
    /* ==============================
       SKILLS PAGE
    ============================== */

    .skills-page {
        --primary: #2563eb;
        --dark: #0b1220;
        --muted: #64748b;
    }

    /* HERO */

    .skills-page .skills-hero {
        background: linear-gradient(
            135deg,
            #0b1220 0%,
            #172554 55%,
            #312e81 100%
        );

        border-radius: 24px;
        padding: 70px 30px;
        margin: 30px 0 45px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .skills-page .skills-hero::before {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: rgba(96, 165, 250, .15);
        filter: blur(45px);
        top: -120px;
        right: -80px;
    }

    .skills-page .hero-label {
        display: inline-block;
        background: rgba(59, 130, 246, .15);
        border: 1px solid rgba(147, 197, 253, .3);
        color: #93c5fd;
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .skills-page .hero-title {
        font-size: clamp(32px, 5vw, 48px);
        font-weight: 800;
        margin-bottom: 20px;
    }

    .skills-page .hero-description {
        max-width: 700px;
        margin: auto;
        color: #cbd5e1;
        line-height: 1.9;
        font-size: 16px;
    }

    /* SECTION */

    .skills-page .section-heading {
        font-size: 27px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .skills-page .section-description {
        color: #64748b;
        line-height: 1.8;
    }

    /* SKILL CARD */

    .skills-page .skill-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 27px;
        height: 100%;
        transition: all .3s ease;
        position: relative;
        overflow: hidden;
    }

    .skills-page .skill-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 18px 40px rgba(15, 23, 42, .10);
        border-color: #93c5fd;
    }

    .skills-page .skill-icon {
        width: 55px;
        height: 55px;
        border-radius: 15px;
        background: linear-gradient(135deg, #dbeafe, #e0e7ff);
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        margin-bottom: 20px;
    }

    .skills-page .skill-name {
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0;
        overflow-wrap: anywhere;
    }

    .skills-page .skill-percent {
        font-size: 16px;
        font-weight: 800;
        color: #2563eb;
        white-space: nowrap;
    }

    /* PROGRESS BAR */

    .skills-page .skill-progress {
        height: 10px;
        background: #e2e8f0;
        border-radius: 30px;
        overflow: hidden;
        margin-top: 22px;
    }

    .skills-page .skill-progress-fill {
        height: 100%;
        border-radius: 30px;
        background: linear-gradient(90deg, #2563eb, #7c3aed);
        transition: width 1s ease;
    }

    .skills-page .skill-caption {
        display: flex;
        justify-content: space-between;
        color: #94a3b8;
        font-size: 12px;
        margin-top: 11px;
    }

    /* INFO CARDS */

    .skills-page .info-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 30px;
        height: 100%;
        transition: .3s;
    }

    .skills-page .info-card:hover {
        box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
        transform: translateY(-4px);
    }

    .skills-page .info-icon {
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .skills-page .info-card h4 {
        font-size: 19px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .skills-page .info-card p {
        color: #64748b;
        line-height: 1.8;
        margin-bottom: 0;
    }

    /* EMPTY */

    .skills-page .empty-state {
        padding: 65px 25px;
        text-align: center;
        background: white;
        border: 1px dashed #cbd5e1;
        border-radius: 20px;
    }

    /* CTA */

    .skills-page .skills-cta {
        background: linear-gradient(135deg, #eff6ff, #eef2ff);
        border-radius: 22px;
        padding: 45px 25px;
        text-align: center;
        margin-top: 65px;
    }

    @media(max-width: 768px) {
        .skills-page .skills-hero {
            padding: 45px 22px;
            border-radius: 16px;
        }

        .skills-page .skill-card {
            padding: 22px;
        }

        .skills-page .section-heading {
            font-size: 23px;
        }
    }
</style>


<div class="container skills-page pb-5">

    <!-- ==============================
         HERO
    ============================== -->

    <section class="skills-hero">

        <div class="position-relative" style="z-index:1">

            <span class="hero-label">
                MY SKILLS & EXPERTISE
            </span>

            <h1 class="hero-title">
                Kỹ năng của tôi
            </h1>

            <p class="hero-description">
                Trong quá trình học tập và thực hành,
                tôi không ngừng tìm hiểu những công nghệ mới,
                nâng cao khả năng lập trình, tư duy logic
                và giải quyết vấn đề.

                Dưới đây là những kỹ năng và công nghệ
                tôi đã tiếp cận và đang tiếp tục phát triển.
            </p>

        </div>

    </section>


    <!-- ==============================
         SKILLS LIST
    ============================== -->

    <section>

        <div class="d-flex justify-content-between
                    align-items-center flex-wrap gap-3 mb-4">

            <div>

                <h2 class="section-heading">
                    <i class="bi bi-code-slash text-primary me-2"></i>
                    Kỹ năng chuyên môn
                </h2>

                <p class="section-description mb-0">
                    Danh sách các công nghệ và kỹ năng hiện có
                </p>

            </div>

            <span class="badge bg-primary rounded-pill px-3 py-2">
                {{ $skills->count() }} kỹ năng
            </span>

        </div>


        <div class="row g-4">

            @forelse($skills as $skill)

                @php
                    $level = max(0, min(100, (int) $skill->level));
                @endphp

                <div class="col-md-6 col-lg-4">

                    <div class="skill-card">

                        <div class="d-flex justify-content-between
                                    align-items-start">

                            <div class="skill-icon">
                                <i class="bi bi-code-square"></i>
                            </div>

                            <span class="skill-percent">
                                {{ $level }}%
                            </span>

                        </div>

                        <h3 class="skill-name">
                            {{ $skill->name }}
                        </h3>

                        <div class="skill-progress"
                             role="progressbar"
                             aria-label="Mức độ kỹ năng {{ $skill->name }}"
                             aria-valuenow="{{ $level }}"
                             aria-valuemin="0"
                             aria-valuemax="100">

                            <div class="skill-progress-fill"
                                 style="width: {{ $level }}%">
                            </div>

                        </div>

                        <div class="skill-caption">
                            <span>Đang phát triển</span>
                            <span>{{ $level }}/100</span>
                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="empty-state">

                        <div class="display-3 text-primary mb-3">
                            <i class="bi bi-tools"></i>
                        </div>

                        <h4 class="fw-bold">
                            Chưa có kỹ năng nào
                        </h4>

                        <p class="text-muted mb-0">
                            Danh sách kỹ năng sẽ xuất hiện
                            sau khi được thêm từ trang quản trị.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </section>


    <!-- ==============================
         ADDITIONAL SKILLS
    ============================== -->

    <section class="mt-5 pt-4">

        <div class="text-center mb-4">

            <h2 class="section-heading">
                Kỹ năng hỗ trợ
            </h2>

            <p class="section-description">
                Bên cạnh kiến thức chuyên môn,
                tôi luôn chú trọng phát triển
                những kỹ năng cần thiết trong công việc.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="info-card">

                    <div class="info-icon">
                        <i class="bi bi-lightbulb"></i>
                    </div>

                    <h4>Tư duy giải quyết vấn đề</h4>

                    <p>
                        Phân tích yêu cầu, xác định nguyên nhân
                        và tìm kiếm giải pháp phù hợp
                        khi gặp vấn đề trong quá trình lập trình.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="info-card">

                    <div class="info-icon">
                        <i class="bi bi-people"></i>
                    </div>

                    <h4>Làm việc nhóm</h4>

                    <p>
                        Trao đổi ý tưởng, phân chia công việc
                        và phối hợp với các thành viên
                        để hoàn thành mục tiêu chung.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="info-card">

                    <div class="info-icon">
                        <i class="bi bi-book"></i>
                    </div>

                    <h4>Tự học và phát triển</h4>

                    <p>
                        Chủ động tìm hiểu tài liệu,
                        thực hành các công nghệ mới
                        và liên tục cải thiện kiến thức
                        cũng như kỹ năng chuyên môn.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- ==============================
         CALL TO ACTION
    ============================== -->

    <section class="skills-cta">

        <h2 class="fw-bold mb-3">
            Khám phá những dự án của tôi
        </h2>

        <p class="text-muted mb-4">
            Những kỹ năng trên được vận dụng
            trong các dự án và bài thực hành.
            Hãy xem các sản phẩm tôi đã xây dựng.
        </p>

        <div class="d-flex justify-content-center
                    flex-wrap gap-3">

            <a href="{{ url('/projects') }}"
               class="btn btn-primary px-4 py-2">

                <i class="bi bi-folder2-open me-2"></i>
                Xem dự án
            </a>

            <a href="{{ url('/contact') }}"
               class="btn btn-outline-primary px-4 py-2">

                <i class="bi bi-envelope me-2"></i>
                Liên hệ
            </a>

        </div>

    </section>

</div>

@endsection
