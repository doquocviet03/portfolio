
@extends('layouts.app')

@section('title', 'Giới thiệu | Personal Portfolio')

@section('content')

@php
    $fullName = 'Đỗ Quốc Việt';
    $field = 'Công nghệ thông tin';
    $careerDirection = 'Phát triển phần mềm';
    $location = 'Việt Nam';

    // Ảnh cá nhân trong public/images/avatar.jpg
    $avatar = asset('images/avatar.jpg');
@endphp

<style>
    .about-page {
        --primary: #2563eb;
        --dark: #0b1220;
    }

    /* HERO */

    .about-page .about-hero {
        background: linear-gradient(
            135deg,
            #0b1220,
            #172554,
            #312e81
        );
        color: white;
        padding: 65px 30px;
        border-radius: 25px;
        text-align: center;
        margin: 30px 0 55px;
        position: relative;
        overflow: hidden;
    }

    .about-page .hero-label {
        display: inline-block;
        color: #bfdbfe;
        background: rgba(59,130,246,.18);
        border: 1px solid rgba(147,197,253,.3);
        padding: 9px 20px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .about-page .hero-title {
        font-size: clamp(32px, 5vw, 48px);
        font-weight: 800;
        margin-bottom: 18px;
    }

    .about-page .hero-description {
        max-width: 650px;
        margin: auto;
        color: #cbd5e1;
        line-height: 1.9;
    }

    /* COMMON */

    .about-page .about-section {
        margin-bottom: 75px;
    }

    .about-page .section-label {
        display: block;
        color: #2563eb;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 1.4px;
        margin-bottom: 12px;
    }

    .about-page .section-title {
        color: #0f172a;
        font-size: clamp(25px, 4vw, 34px);
        font-weight: 800;
        margin-bottom: 18px;
    }

    .about-page .section-description {
        color: #64748b;
        line-height: 1.9;
        margin-bottom: 17px;
    }

    /* PROFILE CARD */

    .about-page .profile-card {
        background: linear-gradient(
            145deg,
            #0f172a,
            #1e3a8a
        );
        border-radius: 22px;
        padding: 35px;
        color: white;
        text-align: center;
        height: 100%;
        box-shadow: 0 20px 45px rgba(15,23,42,.12);
    }

    /* ẢNH CÁ NHÂN */

    .about-page .profile-avatar {
        width: 175px;
        height: 175px;
        border-radius: 50%;
        border: 4px solid #60a5fa;
        padding: 5px;
        margin: 0 auto 25px;
        overflow: hidden;
        background: #1e3a8a;
        box-shadow: 0 0 30px rgba(96,165,250,.4);
        transition: .3s ease;
    }

    .about-page .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
        display: block;
    }

    .about-page .profile-avatar:hover {
        transform: scale(1.06);
        box-shadow: 0 0 45px rgba(96,165,250,.6);
    }

    .about-page .profile-name {
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .about-page .profile-role {
        color: #bfdbfe;
        font-weight: 600;
        margin-bottom: 23px;
    }

    .about-page .profile-divider {
        border-color: rgba(255,255,255,.2);
        margin: 25px 0;
    }

    .about-page .profile-detail {
        display: flex;
        align-items: center;
        gap: 12px;
        text-align: left;
        color: #e2e8f0;
        margin-bottom: 18px;
    }

    .about-page .profile-detail i {
        font-size: 20px;
        color: #93c5fd;
        width: 24px;
    }

    /* INTRO */

    .about-page .intro-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 35px;
        height: 100%;
    }

    .about-page .intro-highlight {
        background: #eff6ff;
        border-left: 4px solid #2563eb;
        padding: 20px 23px;
        border-radius: 12px;
        color: #1e40af;
        font-weight: 600;
        line-height: 1.8;
        margin-top: 25px;
    }

    /* INTERESTS */

    .about-page .interest-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 30px;
        height: 100%;
        transition: .3s;
    }

    .about-page .interest-card:hover {
        transform: translateY(-6px);
        border-color: #93c5fd;
        box-shadow: 0 18px 40px rgba(15,23,42,.08);
    }

    .about-page .interest-icon {
        width: 60px;
        height: 60px;
        border-radius: 17px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
        margin-bottom: 22px;
    }

    .about-page .interest-card h3 {
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 14px;
    }

    .about-page .interest-card p {
        color: #64748b;
        line-height: 1.85;
        margin-bottom: 0;
    }

    /* JOURNEY */

    .about-page .journey-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 35px;
    }

    .about-page .journey-item {
        position: relative;
        padding-left: 35px;
        padding-bottom: 32px;
        border-left: 2px solid #bfdbfe;
        margin-left: 10px;
    }

    .about-page .journey-item:last-child {
        padding-bottom: 0;
        border-left-color: transparent;
    }

    .about-page .journey-item::before {
        content: "";
        position: absolute;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: #2563eb;
        border: 3px solid #dbeafe;
        left: -9px;
        top: 3px;
    }

    .about-page .journey-item h3 {
        font-size: 19px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .about-page .journey-item p {
        color: #64748b;
        line-height: 1.85;
        margin-bottom: 0;
    }

    /* STRENGTHS */

    .about-page .strength-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 26px;
        height: 100%;
        display: flex;
        align-items: flex-start;
        gap: 17px;
        transition: .3s;
    }

    .about-page .strength-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(15,23,42,.07);
    }

    .about-page .strength-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .about-page .strength-card h3 {
        font-size: 17px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .about-page .strength-card p {
        color: #64748b;
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 0;
    }

    /* GOALS */

    .about-page .goal-card {
        background: linear-gradient(
            135deg,
            #eff6ff,
            #eef2ff
        );
        border: 1px solid #dbeafe;
        border-radius: 22px;
        padding: 35px;
        height: 100%;
    }

    .about-page .goal-card h3 {
        font-size: 22px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 20px;
    }

    .about-page .goal-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .about-page .goal-list li {
        display: flex;
        gap: 13px;
        margin-bottom: 17px;
        color: #334155;
        line-height: 1.8;
    }

    .about-page .goal-list li:last-child {
        margin-bottom: 0;
    }

    .about-page .goal-list i {
        color: #2563eb;
        margin-top: 3px;
    }

    /* CTA */

    .about-page .about-cta {
        background: linear-gradient(
            135deg,
            #0b1220,
            #1e3a8a
        );
        border-radius: 24px;
        padding: 55px 30px;
        text-align: center;
        color: white;
    }

    .about-page .about-cta h2 {
        font-size: clamp(25px, 4vw, 35px);
        font-weight: 800;
        margin-bottom: 18px;
    }

    .about-page .about-cta p {
        max-width: 620px;
        margin: 0 auto 28px;
        color: #cbd5e1;
        line-height: 1.9;
    }

    @media(max-width: 768px) {
        .about-page .about-hero {
            padding: 45px 20px;
            border-radius: 18px;
        }

        .about-page .profile-card,
        .about-page .intro-card,
        .about-page .journey-box,
        .about-page .goal-card {
            padding: 25px;
        }

        .about-page .profile-avatar {
            width: 150px;
            height: 150px;
        }
    }
</style>


<div class="container about-page pb-5">

    <!-- HERO -->

    <section class="about-hero">

        <span class="hero-label">
            ABOUT ME
        </span>

        <h1 class="hero-title">
            Giới thiệu bản thân
        </h1>

        <p class="hero-description">
            Tìm hiểu về hành trình học tập,
            niềm đam mê công nghệ
            và những mục tiêu tôi đang hướng tới.
        </p>

    </section>


    <!-- PROFILE & INTRO -->

    <section class="about-section">

        <div class="row g-4">

            <!-- PROFILE -->
            <div class="col-lg-4">

                <div class="profile-card">

                    <!-- ẢNH CÁ NHÂN -->
                    <div class="profile-avatar">

                        <img
                            src="{{ $avatar }}"
                            alt="Ảnh đại diện {{ $fullName }}"
                        >

                    </div>

                    <h2 class="profile-name">
                        {{ $fullName }}
                    </h2>

                    <p class="profile-role">
                        {{ $field }}
                    </p>

                    <hr class="profile-divider">

                    <div class="profile-detail">
                        <i class="bi bi-mortarboard"></i>
                        <span>{{ $field }}</span>
                    </div>

                    <div class="profile-detail">
                        <i class="bi bi-code-slash"></i>
                        <span>{{ $careerDirection }}</span>
                    </div>

                    <div class="profile-detail">
                        <i class="bi bi-geo-alt"></i>
                        <span>{{ $location }}</span>
                    </div>

                    <a href="{{ url('/contact') }}"
                       class="btn btn-primary w-100 mt-3 py-3">

                        <i class="bi bi-envelope me-2"></i>
                        Liên hệ với tôi

                    </a>

                </div>

            </div>


            <!-- INTRO -->
            <div class="col-lg-8">

                <div class="intro-card">

                    <span class="section-label">
                        WHO AM I?
                    </span>

                    <h2 class="section-title">
                        Xin chào, tôi là {{ $fullName }}!
                    </h2>

                    <p class="section-description">
                        Tôi yêu thích lĩnh vực Công nghệ thông tin,
                        đặc biệt là lập trình và phát triển
                        các ứng dụng phần mềm.
                    </p>

                    <p class="section-description">
                        Trong quá trình học tập,
                        tôi đã tìm hiểu và thực hành
                        với nhiều công nghệ như PHP,
                        Laravel, MySQL, Python,
                        HTML, CSS và JavaScript.
                    </p>

                    <p class="section-description">
                        Tôi quan tâm đến việc xây dựng
                        các website có giao diện thân thiện,
                        dễ sử dụng và có khả năng
                        giải quyết những bài toán thực tế.
                    </p>

                    <p class="section-description">
                        Bên cạnh kiến thức lập trình,
                        tôi cũng chú trọng phát triển
                        khả năng tự học, tư duy logic,
                        kỹ năng giải quyết vấn đề
                        và tinh thần làm việc nhóm.
                    </p>

                    <div class="intro-highlight">
                        <i class="bi bi-lightbulb me-2"></i>

                        Mục tiêu của tôi là không ngừng học hỏi,
                        tích lũy kinh nghiệm thực tế
                        và trở thành một lập trình viên
                        có chuyên môn vững vàng.
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- INTERESTS -->

    <section class="about-section">

        <div class="text-center mb-5">

            <span class="section-label">
                MY INTERESTS
            </span>

            <h2 class="section-title">
                Lĩnh vực tôi quan tâm
            </h2>

            <p class="section-description">
                Những lĩnh vực công nghệ
                tôi đang tìm hiểu và phát triển.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-6 col-lg-3">
                <div class="interest-card">

                    <div class="interest-icon">
                        <i class="bi bi-code-slash"></i>
                    </div>

                    <h3>Web Development</h3>

                    <p>
                        Phát triển website bằng
                        PHP, Laravel, HTML,
                        CSS và JavaScript.
                    </p>

                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="interest-card">

                    <div class="interest-icon">
                        <i class="bi bi-database"></i>
                    </div>

                    <h3>Database</h3>

                    <p>
                        Thiết kế và quản lý
                        cơ sở dữ liệu,
                        đặc biệt là MySQL.
                    </p>

                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="interest-card">

                    <div class="interest-icon">
                        <i class="bi bi-bar-chart"></i>
                    </div>

                    <h3>Data Analysis</h3>

                    <p>
                        Khám phá dữ liệu,
                        xây dựng biểu đồ
                        và phân tích bằng Python.
                    </p>

                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="interest-card">

                    <div class="interest-icon">
                        <i class="bi bi-bug"></i>
                    </div>

                    <h3>Software Testing</h3>

                    <p>
                        Tìm hiểu kiểm thử
                        chức năng phần mềm,
                        ghi nhận và xử lý lỗi.
                    </p>

                </div>
            </div>

        </div>

    </section>


    <!-- LEARNING JOURNEY -->

    <section class="about-section">

        <div class="row align-items-center g-4">

            <div class="col-lg-5">

                <span class="section-label">
                    MY JOURNEY
                </span>

                <h2 class="section-title">
                    Hành trình học tập
                </h2>

                <p class="section-description">
                    Tôi tin rằng việc học lập trình
                    là một quá trình liên tục,
                    cần kết hợp giữa lý thuyết
                    và thực hành.
                </p>

                <p class="section-description">
                    Mỗi dự án là cơ hội
                    để áp dụng kiến thức,
                    giải quyết vấn đề
                    và hoàn thiện kỹ năng.
                </p>

                <a href="{{ url('/projects') }}"
                   class="btn btn-outline-primary px-4 mt-2">

                    Xem các dự án
                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

            </div>

            <div class="col-lg-7">

                <div class="journey-box">

                    <div class="journey-item">

                        <h3>
                            <i class="bi bi-book me-2 text-primary"></i>
                            Xây dựng nền tảng
                        </h3>

                        <p>
                            Học kiến thức cơ bản
                            về lập trình, thuật toán,
                            cơ sở dữ liệu và
                            phát triển phần mềm.
                        </p>

                    </div>

                    <div class="journey-item">

                        <h3>
                            <i class="bi bi-laptop me-2 text-primary"></i>
                            Thực hành dự án
                        </h3>

                        <p>
                            Xây dựng ứng dụng web
                            với Laravel, MySQL
                            và các công nghệ liên quan.
                        </p>

                    </div>

                    <div class="journey-item">

                        <h3>
                            <i class="bi bi-graph-up-arrow me-2 text-primary"></i>
                            Phát triển kỹ năng
                        </h3>

                        <p>
                            Tìm hiểu thêm về Python,
                            phân tích dữ liệu,
                            kiểm thử phần mềm
                            và làm việc nhóm.
                        </p>

                    </div>

                    <div class="journey-item">

                        <h3>
                            <i class="bi bi-rocket-takeoff me-2 text-primary"></i>
                            Định hướng tương lai
                        </h3>

                        <p>
                            Tiếp tục hoàn thiện
                            kiến thức chuyên môn
                            và tìm kiếm cơ hội
                            áp dụng vào thực tế.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- STRENGTHS -->

    <section class="about-section">

        <div class="text-center mb-5">

            <span class="section-label">
                PERSONAL STRENGTHS
            </span>

            <h2 class="section-title">
                Kỹ năng và điểm mạnh
            </h2>

            <p class="section-description">
                Những kỹ năng tôi luôn
                chú trọng rèn luyện.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-6">

                <div class="strength-card">

                    <div class="strength-icon">
                        <i class="bi bi-lightbulb"></i>
                    </div>

                    <div>
                        <h3>Tư duy logic</h3>
                        <p>
                            Phân tích yêu cầu,
                            tìm hiểu nguyên nhân
                            và xây dựng giải pháp.
                        </p>
                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="strength-card">

                    <div class="strength-icon">
                        <i class="bi bi-people"></i>
                    </div>

                    <div>
                        <h3>Làm việc nhóm</h3>
                        <p>
                            Trao đổi ý tưởng,
                            phối hợp thực hiện
                            và hỗ trợ thành viên.
                        </p>
                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="strength-card">

                    <div class="strength-icon">
                        <i class="bi bi-book"></i>
                    </div>

                    <div>
                        <h3>Tinh thần tự học</h3>
                        <p>
                            Chủ động nghiên cứu
                            tài liệu và thực hành
                            các công nghệ mới.
                        </p>
                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="strength-card">

                    <div class="strength-icon">
                        <i class="bi bi-check2-circle"></i>
                    </div>

                    <div>
                        <h3>Trách nhiệm</h3>
                        <p>
                            Chú trọng chất lượng,
                            kiểm tra kết quả
                            và hoàn thiện công việc.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- CAREER GOALS -->

    <section class="about-section">

        <div class="text-center mb-5">

            <span class="section-label">
                CAREER GOALS
            </span>

            <h2 class="section-title">
                Mục tiêu nghề nghiệp
            </h2>

        </div>

        <div class="row g-4">

            <div class="col-lg-6">

                <div class="goal-card">

                    <h3>
                        <i class="bi bi-bullseye me-2"></i>
                        Mục tiêu ngắn hạn
                    </h3>

                    <ul class="goal-list">

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>
                                Củng cố kiến thức
                                lập trình và cơ sở dữ liệu.
                            </span>
                        </li>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>
                                Nâng cao kỹ năng
                                Laravel, PHP và MySQL.
                            </span>
                        </li>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>
                                Hoàn thiện các dự án
                                để xây dựng Portfolio.
                            </span>
                        </li>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>
                                Tích lũy kinh nghiệm
                                thông qua thực hành.
                            </span>
                        </li>

                    </ul>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="goal-card">

                    <h3>
                        <i class="bi bi-rocket-takeoff me-2"></i>
                        Mục tiêu dài hạn
                    </h3>

                    <ul class="goal-list">

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>
                                Phát triển năng lực
                                chuyên môn trong lĩnh vực CNTT.
                            </span>
                        </li>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>
                                Tham gia xây dựng
                                các sản phẩm phần mềm thực tế.
                            </span>
                        </li>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>
                                Tiếp tục cập nhật
                                các công nghệ mới.
                            </span>
                        </li>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>
                                Trở thành một thành viên
                                có đóng góp tích cực
                                trong đội ngũ phát triển.
                            </span>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </section>


    <!-- CTA -->

    <section class="about-cta">

        <h2>
            Cùng kết nối và chia sẻ ý tưởng!
        </h2>

        <p>
            Cảm ơn bạn đã tìm hiểu về tôi.
            Hãy khám phá những dự án tôi đã thực hiện
            hoặc liên hệ nếu bạn muốn trao đổi thêm.
        </p>

        <div class="d-flex flex-wrap gap-3 justify-content-center">

            <a href="{{ url('/projects') }}"
               class="btn btn-primary px-4 py-3">

                <i class="bi bi-folder2-open me-2"></i>
                Xem dự án

            </a>

            <a href="{{ url('/contact') }}"
               class="btn btn-outline-light px-4 py-3">

                <i class="bi bi-envelope me-2"></i>
                Liên hệ

            </a>

        </div>

    </section>

</div>

@endsection
