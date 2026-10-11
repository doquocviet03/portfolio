@extends('layouts.app')

@section('title', 'Giới thiệu | Portfolio')
@section('meta_description', 'Tìm hiểu thông tin cá nhân, quá trình học tập, mục tiêu nghề nghiệp và định hướng phát triển trong lĩnh vực Công nghệ thông tin.')

@push('styles')
<style>
    .about-page {
        --about-primary: #2563eb;
        --about-heading: #0f172a;
        --about-text: #475569;
        --about-muted: #64748b;
        --about-surface: #ffffff;
        --about-soft: #f1f5f9;
        --about-line: #e2e8f0;
        color: var(--about-heading);
    }
    html[data-theme="dark"] .about-page,
    [data-bs-theme="dark"] .about-page {
        --about-heading: #f8fafc;
        --about-text: #cbd5e1;
        --about-muted: #94a3b8;
        --about-surface: #111c30;
        --about-soft: #0b1425;
        --about-line: #283850;
        --about-primary: #60a5fa;
    }
    .about-page .about-hero {
        position: relative;
        overflow: hidden;
        padding: clamp(70px, 9vw, 120px) 0;
        background: radial-gradient(circle at 85% 15%, rgba(59,130,246,.16), transparent 36%),
                    linear-gradient(135deg, var(--about-soft), var(--about-surface));
        border-bottom: 1px solid var(--about-line);
    }
    .about-page .about-hero::before {
        content: '';
        position: absolute;
        width: 340px;
        height: 340px;
        border: 1px solid rgba(59,130,246,.12);
        border-radius: 50%;
        right: -120px;
        bottom: -210px;
        pointer-events: none;
    }
    .about-page .about-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border: 1px solid rgba(59,130,246,.24);
        border-radius: 100px;
        background: rgba(59,130,246,.09);
        color: var(--about-primary);
        font-weight: 700;
        font-size: .85rem;
        letter-spacing: .02em;
    }
    .about-page .about-heading {
        font-size: clamp(2.35rem, 5vw, 4rem);
        line-height: 1.14;
        font-weight: 800;
        letter-spacing: -.045em;
        color: var(--about-heading);
        overflow-wrap: anywhere;
    }
    .about-page .about-role { color: var(--about-primary); font-size: clamp(1.15rem, 2vw, 1.5rem); font-weight: 700; }
    .about-page .about-lead { max-width: 630px; color: var(--about-text); font-size: 1.06rem; line-height: 1.9; white-space: pre-line; }
    .about-page .about-actions .btn { padding: 12px 22px; border-radius: 12px; font-weight: 650; }
    .about-page .about-outline-btn { border: 1px solid var(--about-line); color: var(--about-heading); background: var(--about-surface); }
    .about-page .about-outline-btn:hover { color: #fff; background: #2563eb; border-color: #2563eb; }
    .about-page .about-portrait-wrap { position: relative; width: min(100%, 340px); margin: 0 auto; }
    .about-page .about-portrait-wrap::before { content: ''; position: absolute; inset: -16px; border: 1px solid rgba(59,130,246,.23); border-radius: 34px; transform: rotate(-5deg); }
    .about-page .about-portrait,
    .about-page .about-portrait-placeholder {
        position: relative;
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        border-radius: 28px;
        border: 6px solid var(--about-surface);
        box-shadow: 0 25px 65px rgba(15,23,42,.16);
    }
    .about-page .about-portrait-placeholder { display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg,#dbeafe,#bfdbfe); color: #2563eb; font-size: 7rem; }
    .about-page .about-portrait-label { position: absolute; bottom: -19px; left: 50%; transform: translateX(-50%); padding: 10px 18px; border-radius: 12px; background: #2563eb; color: white; box-shadow: 0 10px 25px rgba(37,99,235,.28); font-weight: 700; white-space: nowrap; font-size: .9rem; }
    .about-page .about-section { padding: clamp(64px, 8vw, 96px) 0; }
    .about-page .about-section-alt { background: var(--about-soft); }
    .about-page .about-section-heading { font-size: clamp(1.65rem, 3vw, 2.3rem); color: var(--about-heading); font-weight: 800; letter-spacing: -.025em; }
    .about-page .about-section-subtitle { color: var(--about-muted); line-height: 1.8; }
    .about-page .about-panel { background: var(--about-surface); border: 1px solid var(--about-line); border-radius: 22px; padding: clamp(24px, 4vw, 38px); height: 100%; box-shadow: 0 10px 35px rgba(15,23,42,.035); }
    .about-page .about-panel-title { font-size: 1.25rem; font-weight: 750; color: var(--about-heading); margin-bottom: 20px; }
    .about-page .about-panel-icon { display: inline-flex; align-items: center; justify-content: center; width: 46px; height: 46px; margin-right: 10px; background: rgba(59,130,246,.1); color: var(--about-primary); border-radius: 13px; vertical-align: middle; }
    .about-page .about-copy { white-space: pre-line; color: var(--about-text); font-size: 1.02rem; line-height: 1.95; overflow-wrap: anywhere; }
    .about-page .about-info-item { display: flex; gap: 14px; padding: 16px 0; border-bottom: 1px solid var(--about-line); }
    .about-page .about-info-item:last-child { border-bottom: 0; padding-bottom: 0; }
    .about-page .about-info-icon { flex: 0 0 40px; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: var(--about-soft); color: var(--about-primary); border-radius: 11px; font-size: 1.15rem; }
    .about-page .about-info-label { color: var(--about-muted); font-size: .84rem; margin-bottom: 3px; }
    .about-page .about-info-value { color: var(--about-heading); font-weight: 650; overflow-wrap: anywhere; }
    .about-page .about-goal { border-left: 4px solid #2563eb; }
    .about-page .about-cta { padding: clamp(34px, 6vw, 60px); border-radius: 26px; background: linear-gradient(120deg,#1d4ed8,#4338ca); color: #fff; overflow: hidden; position: relative; }
    .about-page .about-cta h2 { font-size: clamp(1.7rem, 3vw, 2.4rem); font-weight: 800; color: #fff; }
    .about-page .about-cta p { color: #dbeafe; line-height: 1.8; }
    .about-page .about-social { display: inline-flex; align-items: center; gap: 8px; padding: 10px 15px; border-radius: 11px; color: #fff; text-decoration: none; border: 1px solid rgba(255,255,255,.35); transition: background .2s, transform .2s; }
    .about-page .about-social:hover { background: rgba(255,255,255,.16); color: #fff; transform: translateY(-2px); }
    .about-page .about-social-primary { background: #fff; color: #1d4ed8; border-color: #fff; font-weight: 700; }
    .about-page .about-social-primary:hover { color: #1d4ed8; background: #eff6ff; }
    @media (max-width: 991.98px) { .about-page .about-hero { text-align: center; } .about-page .about-lead { margin-inline: auto; } .about-page .about-actions { justify-content: center; } .about-page .about-portrait-wrap { margin-top: 24px; } }
    @media (prefers-reduced-motion: reduce) { .about-page .about-social { transition: none; } }
</style>
@endpush

@section('content')
<div class="about-page">
    <section class="about-hero">
        <div class="container position-relative">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="about-eyebrow mb-4"><i class="bi bi-stars"></i> TÌM HIỂU VỀ TÔI</span>
                    <h1 class="about-heading mb-3">{{ $profile?->full_name ?: 'Giới thiệu bản thân' }}</h1>
                    <div class="about-role mb-3">{{ $profile?->job_title ?: 'Web Developer' }}</div>
                    <p class="about-lead mb-4">{{ $profile?->short_bio ?: 'Tôi yêu thích lập trình, công nghệ và luôn cố gắng học hỏi để phát triển kỹ năng của mình.' }}</p>
                    <div class="about-actions d-flex flex-wrap gap-3">
                        <a href="{{ route('projects') }}" class="btn btn-primary"><i class="bi bi-grid-3x3-gap me-2"></i>Xem dự án</a>
                        <a href="{{ route('contact') }}" class="btn about-outline-btn"><i class="bi bi-chat-dots me-2"></i>Liên hệ</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="about-portrait-wrap">
                        @if($profile?->avatar)
                            <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Ảnh đại diện của {{ $profile->full_name ?: 'chủ sở hữu Portfolio' }}" class="about-portrait" width="340" height="340" decoding="async">
                        @else
                            <div class="about-portrait-placeholder" aria-label="Ảnh đại diện mặc định"><i class="bi bi-person"></i></div>
                        @endif
                        <div class="about-portrait-label"><i class="bi bi-code-slash me-2"></i>{{ $profile?->job_title ?: 'Web Developer' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="mb-5">
                <span class="about-eyebrow mb-3">01 / CÂU CHUYỆN CỦA TÔI</span>
                <h2 class="about-section-heading">Hơn cả những dòng code</h2>
                <p class="about-section-subtitle mb-0">Thông tin và hành trình phát triển bản thân.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-7">
                    <article class="about-panel">
                        <h3 class="about-panel-title"><span class="about-panel-icon"><i class="bi bi-person-lines-fill"></i></span>Giới thiệu chi tiết</h3>
                        <div class="about-copy">{{ $profile?->about_me ?: 'Chào mừng bạn đến với Portfolio của tôi. Đây là nơi tôi chia sẻ thông tin cá nhân, quá trình học tập, kinh nghiệm và những dự án đã thực hiện.' }}</div>
                    </article>
                </div>
                <div class="col-lg-5">
                    <aside class="about-panel">
                        <h3 class="about-panel-title"><span class="about-panel-icon"><i class="bi bi-card-list"></i></span>Thông tin cá nhân</h3>
                        @if($profile?->full_name)
                            <div class="about-info-item"><div class="about-info-icon"><i class="bi bi-person"></i></div><div><div class="about-info-label">Họ và tên</div><div class="about-info-value">{{ $profile->full_name }}</div></div></div>
                        @endif
                        @if($profile?->field)
                            <div class="about-info-item"><div class="about-info-icon"><i class="bi bi-laptop"></i></div><div><div class="about-info-label">Lĩnh vực</div><div class="about-info-value">{{ $profile->field }}</div></div></div>
                        @endif
                        @if($profile?->location)
                            <div class="about-info-item"><div class="about-info-icon"><i class="bi bi-geo-alt"></i></div><div><div class="about-info-label">Khu vực</div><div class="about-info-value">{{ $profile->location }}</div></div></div>
                        @endif
                        @if($profile?->contact_email)
                            <div class="about-info-item"><div class="about-info-icon"><i class="bi bi-envelope"></i></div><div><div class="about-info-label">Email</div><div class="about-info-value">{{ $profile->contact_email }}</div></div></div>
                        @endif
                        @if(!$profile?->full_name && !$profile?->field && !$profile?->location && !$profile?->contact_email)
                            <p class="about-copy mb-0">Thông tin cá nhân đang được cập nhật.</p>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section about-section-alt">
        <div class="container">
            <div class="mb-4">
                <span class="about-eyebrow mb-3">02 / ĐỊNH HƯỚNG</span>
                <h2 class="about-section-heading">Mục tiêu nghề nghiệp</h2>
            </div>
            <article class="about-panel about-goal">
                <h3 class="about-panel-title"><span class="about-panel-icon"><i class="bi bi-bullseye"></i></span>Điều tôi đang hướng đến</h3>
                <div class="about-copy">{{ $profile?->career_goal ?: 'Tôi mong muốn phát triển kiến thức chuyên môn, tích lũy kinh nghiệm thực tế và trở thành một lập trình viên có năng lực trong tương lai.' }}</div>
            </article>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="about-cta text-center">
                <span class="d-inline-block mb-3 text-white-50 fw-semibold">03 / KẾT NỐI</span>
                <h2 class="mb-3">Cùng kết nối và trao đổi!</h2>
                <p class="mb-4">Bạn muốn tìm hiểu thêm về dự án hoặc trao đổi về công nghệ? Hãy liên hệ với tôi.</p>
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    @if($profile?->github_url)
                        <a class="about-social" href="{{ $profile->github_url }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-github"></i> GitHub</a>
                    @endif
                    @if($profile?->facebook_url)
                        <a class="about-social" href="{{ $profile->facebook_url }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i> Facebook</a>
                    @endif
                    @if($profile?->linkedin_url)
                        <a class="about-social" href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i> LinkedIn</a>
                    @endif
                    <a class="about-social about-social-primary" href="{{ route('contact') }}"><i class="bi bi-envelope"></i> Liên hệ ngay</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
