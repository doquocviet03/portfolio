
@extends('layouts.app')

@section('title', 'Kinh nghiệm | Portfolio')

@section('content')

<style>
    /* ==============================
       EXPERIENCE PAGE
    ============================== */

    .experience-page {
        --exp-primary: #2563eb;
        --exp-dark: #0b1220;
    }

    /* HERO */

    .experience-page .experience-hero {
        background: linear-gradient(
            135deg,
            #0b1220 0%,
            #172554 55%,
            #312e81 100%
        );
        border-radius: 24px;
        padding: 70px 30px;
        margin: 30px 0 50px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .experience-page .experience-hero::before {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        background: rgba(96, 165, 250, .17);
        border-radius: 50%;
        filter: blur(45px);
        right: -80px;
        top: -110px;
    }

    .experience-page .hero-label {
        display: inline-block;
        color: #93c5fd;
        background: rgba(59, 130, 246, .15);
        border: 1px solid rgba(147, 197, 253, .3);
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .experience-page .hero-title {
        font-size: clamp(32px, 5vw, 48px);
        font-weight: 800;
        margin-bottom: 20px;
    }

    .experience-page .hero-description {
        max-width: 700px;
        margin: auto;
        color: #cbd5e1;
        line-height: 1.9;
    }

    /* SECTION */

    .experience-page .section-heading {
        font-size: 28px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .experience-page .section-description {
        color: #64748b;
        line-height: 1.8;
    }

    /* TIMELINE */

    .experience-page .timeline {
        position: relative;
        padding-left: 43px;
        margin-top: 40px;
    }

    .experience-page .timeline::before {
        content: "";
        position: absolute;
        left: 13px;
        top: 10px;
        bottom: 20px;
        width: 3px;
        border-radius: 10px;
        background: linear-gradient(
            to bottom,
            #2563eb,
            #7c3aed,
            #cbd5e1
        );
    }

    .experience-page .timeline-item {
        position: relative;
        margin-bottom: 30px;
    }

    .experience-page .timeline-item::before {
        content: "";
        position: absolute;
        left: -39px;
        top: 28px;
        width: 17px;
        height: 17px;
        border: 4px solid white;
        border-radius: 50%;
        background: #2563eb;
        box-shadow: 0 0 0 3px #bfdbfe;
        z-index: 2;
    }

    /* EXPERIENCE CARD */

    .experience-page .experience-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 30px;
        transition: all .3s ease;
    }

    .experience-page .experience-card:hover {
        transform: translateY(-5px);
        border-color: #93c5fd;
        box-shadow: 0 18px 40px rgba(15, 23, 42, .10);
    }

    .experience-page .experience-date {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 30px;
        padding: 8px 15px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .experience-page .experience-title {
        font-size: 23px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 10px;
        overflow-wrap: anywhere;
    }

    .experience-page .experience-company {
        color: #475569;
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .experience-page .experience-description {
        color: #64748b;
        line-height: 1.9;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    /* INFO CARDS */

    .experience-page .info-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 30px;
        height: 100%;
        transition: all .3s ease;
    }

    .experience-page .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
    }

    .experience-page .info-icon {
        width: 55px;
        height: 55px;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .experience-page .info-card h4 {
        font-size: 19px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .experience-page .info-card p {
        color: #64748b;
        line-height: 1.8;
        margin-bottom: 0;
    }

    /* EMPTY */

    .experience-page .empty-state {
        background: white;
        border: 1px dashed #cbd5e1;
        border-radius: 20px;
        padding: 65px 25px;
        text-align: center;
    }

    /* CTA */

    .experience-page .experience-cta {
        background: linear-gradient(135deg, #eff6ff, #eef2ff);
        border-radius: 22px;
        padding: 45px 25px;
        text-align: center;
        margin-top: 65px;
    }

    @media(max-width: 768px) {
        .experience-page .experience-hero {
            padding: 45px 22px;
            border-radius: 16px;
        }

        .experience-page .timeline {
            padding-left: 32px;
        }

        .experience-page .timeline::before {
            left: 9px;
        }

        .experience-page .timeline-item::before {
            left: -30px;
        }

        .experience-page .experience-card {
            padding: 23px;
        }

        .experience-page .experience-title {
            font-size: 20px;
        }
    }
</style>


<div class="container experience-page pb-5">

    <!-- ==============================
         HERO
    ============================== -->

    <section class="experience-hero">

        <div class="position-relative" style="z-index:1">

            <span class="hero-label">
                MY JOURNEY & EXPERIENCE
            </span>

            <h1 class="hero-title">
                Hành trình & Kinh nghiệm
            </h1>

            <p class="hero-description">
                Mỗi trải nghiệm đều mang đến những
                kiến thức và bài học quý giá.
                Đây là những cột mốc trong quá trình
                học tập, thực hành dự án và
                phát triển kỹ năng công nghệ của tôi.
            </p>

        </div>

    </section>


    <!-- ==============================
         EXPERIENCE LIST
    ============================== -->

    <section>

        <div class="d-flex justify-content-between
                    align-items-center flex-wrap gap-3 mb-4">

            <div>

                <h2 class="section-heading">
                    <i class="bi bi-clock-history text-primary me-2"></i>
                    Dòng thời gian
                </h2>

                <p class="section-description mb-0">
                    Các hoạt động và kinh nghiệm đã tích lũy
                </p>

            </div>

            <span class="badge bg-primary rounded-pill px-3 py-2">
                {{ $experiences->count() }} trải nghiệm
            </span>

        </div>


        @if($experiences->isNotEmpty())

            <div class="timeline">

                @foreach($experiences as $experience)

                    <div class="timeline-item">

                        <article class="experience-card">

                            <!-- THỜI GIAN -->
                            <div class="experience-date">

                                <i class="bi bi-calendar-event"></i>

                                @if($experience->start_date)
                                    {{ \Illuminate\Support\Carbon::parse($experience->start_date)->format('m/Y') }}
                                @else
                                    Chưa xác định
                                @endif

                                <span>—</span>

                                @if($experience->end_date)
                                    {{ \Illuminate\Support\Carbon::parse($experience->end_date)->format('m/Y') }}
                                @else
                                    Hiện tại
                                @endif

                            </div>

                            <!-- VỊ TRÍ -->
                            <h3 class="experience-title">
                                {{ $experience->title }}
                            </h3>

                            <!-- ĐƠN VỊ -->
                            @if($experience->company)
                                <div class="experience-company">

                                    <i class="bi bi-building me-2 text-primary"></i>

                                    {{ $experience->company }}

                                </div>
                            @endif

                            <!-- MÔ TẢ -->
                            @if($experience->description)
                                <div class="experience-description">{{ $experience->description }}</div>
                            @endif

                        </article>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty-state">

                <div class="display-3 text-primary mb-3">
                    <i class="bi bi-briefcase"></i>
                </div>

                <h4 class="fw-bold">
                    Chưa có kinh nghiệm nào
                </h4>

                <p class="text-muted mb-0">
                    Dữ liệu kinh nghiệm sẽ được hiển thị
                    sau khi cập nhật từ trang quản trị.
                </p>

            </div>

        @endif

    </section>


    <!-- ==============================
         PERSONAL DEVELOPMENT
    ============================== -->

    <section class="mt-5 pt-4">

        <div class="text-center mb-4">

            <h2 class="section-heading">
                Những điều tôi luôn hướng đến
            </h2>

            <p class="section-description">
                Không chỉ tích lũy kinh nghiệm,
                tôi còn tập trung cải thiện
                các kỹ năng quan trọng trong công việc.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="info-card">

                    <div class="info-icon">
                        <i class="bi bi-code-slash"></i>
                    </div>

                    <h4>Phát triển chuyên môn</h4>

                    <p>
                        Tăng cường khả năng lập trình,
                        tìm hiểu công nghệ mới và
                        áp dụng kiến thức vào các dự án thực tế.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="info-card">

                    <div class="info-icon">
                        <i class="bi bi-people"></i>
                    </div>

                    <h4>Hợp tác và giao tiếp</h4>

                    <p>
                        Học cách trao đổi ý tưởng,
                        tiếp nhận phản hồi và
                        phối hợp hiệu quả khi làm việc nhóm.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="info-card">

                    <div class="info-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>

                    <h4>Không ngừng tiến bộ</h4>

                    <p>
                        Chủ động học hỏi từ những thử thách,
                        cải thiện phương pháp làm việc
                        và xây dựng định hướng phát triển lâu dài.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- ==============================
         CALL TO ACTION
    ============================== -->

    <section class="experience-cta">

        <h2 class="fw-bold mb-3">
            Khám phá các dự án tôi đã thực hiện
        </h2>

        <p class="text-muted mb-4">
            Những trải nghiệm và kiến thức tích lũy
            được vận dụng trong các sản phẩm
            và dự án lập trình của tôi.
        </p>

        <div class="d-flex justify-content-center flex-wrap gap-3">

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
