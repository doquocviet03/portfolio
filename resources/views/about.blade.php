@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'About | Đỗ Quốc Việt' : 'Giới thiệu | Đỗ Quốc Việt')
@section('meta_description', app()->getLocale() === 'en' ? 'Learn about my background, skills, and career goals in information technology.' : 'Giới thiệu bản thân, thông tin cá nhân và mục tiêu nghề nghiệp trong lĩnh vực Công nghệ thông tin.')

@push('styles')
<style>
.about-v2{--a-bg:#f3f7fd;--a-card:#fff;--a-text:#13233d;--a-muted:#63758f;--a-line:#dbe6f4;--a-blue:#267ef5;--a-soft:#eaf2ff;color:var(--a-text);background:var(--a-bg)}
html[data-theme="dark"] .about-v2,html[data-bs-theme="dark"] .about-v2{--a-bg:#0b1629;--a-card:#12243c;--a-text:#f2f7ff;--a-muted:#a6bad5;--a-line:#29415f;--a-blue:#64a9ff;--a-soft:#192f4b}
.about-v2 .a-hero{padding:86px 0 78px;background:radial-gradient(ellipse at 83% 20%,rgba(52,130,255,.15),transparent 44%);border-bottom:1px solid var(--a-line)}
.about-v2 .a-kicker{display:inline-flex;align-items:center;gap:9px;color:var(--a-blue);font-size:.82rem;font-weight:800;letter-spacing:.13em;text-transform:uppercase;margin-bottom:19px}
.about-v2 .a-kicker:before{content:"";width:9px;height:9px;border-radius:50%;background:#31ce95;box-shadow:0 0 0 5px rgba(49,206,149,.12)}
.about-v2 .a-title{font-size:clamp(2.3rem,5vw,4.1rem);line-height:1.15;font-weight:850;letter-spacing:-.045em;margin:0 0 16px;color:var(--a-text)}
.about-v2 .a-gradient{color:var(--a-blue)}
.about-v2 .a-role{font-size:1.24rem;font-weight:750;color:var(--a-blue);margin-bottom:22px}
.about-v2 .a-desc{font-size:1.03rem;line-height:1.95;color:var(--a-muted);max-width:640px;white-space:pre-line}
.about-v2 .a-actions{display:flex;flex-wrap:wrap;gap:12px;margin-top:28px}
.about-v2 .a-btn{display:inline-flex;align-items:center;gap:10px;padding:13px 20px;border-radius:12px;text-decoration:none;font-weight:700;transition:transform .2s,background-color .2s}
.about-v2 .a-btn:hover{transform:translateY(-2px)}
.about-v2 .a-btn-primary{background:#287ff4;color:white;box-shadow:0 12px 28px rgba(37,99,235,.22)}
.about-v2 .a-btn-primary:hover{background:#176bd8;color:white}
.about-v2 .a-btn-outline{background:var(--a-card);border:1px solid var(--a-line);color:var(--a-text)}
.about-v2 .a-btn-outline:hover{color:var(--a-blue)}
.about-v2 .a-photo-wrap{position:relative;max-width:390px;margin:auto;padding:13px}
.about-v2 .a-photo-wrap:before{content:"";position:absolute;inset:0;border:1px solid rgba(70,145,255,.4);border-radius:31px;transform:rotate(5deg)}
.about-v2 .a-photo{position:relative;width:100%;aspect-ratio:4/4.4;object-fit:cover;border-radius:23px;border:5px solid var(--a-card);box-shadow:0 25px 65px rgba(4,20,48,.22)}
.about-v2 .a-photo-empty{position:relative;display:grid;place-items:center;width:100%;aspect-ratio:4/4.4;background:var(--a-soft);border:5px solid var(--a-card);border-radius:23px;color:var(--a-blue);font-size:8rem}
.about-v2 .a-photo-label{position:absolute;bottom:-4px;left:-8px;background:var(--a-card);color:var(--a-text);border:1px solid var(--a-line);padding:12px 16px;border-radius:12px;box-shadow:0 12px 28px rgba(4,20,48,.12);font-weight:750;font-size:.88rem}
.about-v2 .a-photo-label i{color:var(--a-blue)}
.about-v2 .a-section{padding:78px 0}
.about-v2 .a-section-alt{background:var(--a-soft)}
.about-v2 .a-section-label{font-size:.78rem;color:var(--a-blue);letter-spacing:.13em;font-weight:800;text-transform:uppercase;margin-bottom:9px}
.about-v2 .a-section-title{font-size:clamp(1.7rem,3vw,2.5rem);font-weight:800;letter-spacing:-.035em;margin-bottom:13px;color:var(--a-text)}
.about-v2 .a-section-sub{color:var(--a-muted);line-height:1.8}
.about-v2 .a-card{background:var(--a-card);border:1px solid var(--a-line);border-radius:21px;padding:30px;height:100%;box-shadow:0 12px 32px rgba(8,30,64,.035)}
.about-v2 .a-card-title{display:flex;align-items:center;gap:12px;font-size:1.18rem;font-weight:800;margin-bottom:23px;color:var(--a-text)}
.about-v2 .a-icon{width:43px;height:43px;flex:0 0 43px;display:grid;place-items:center;background:var(--a-soft);color:var(--a-blue);border-radius:12px;font-size:1.22rem}
.about-v2 .a-copy{white-space:pre-line;line-height:2;color:var(--a-muted);overflow-wrap:anywhere}
.about-v2 .a-info{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:13px}
.about-v2 .a-info-item{background:var(--a-soft);border:1px solid var(--a-line);border-radius:13px;padding:15px;min-width:0}
.about-v2 .a-info-item i{color:var(--a-blue);font-size:1.1rem;margin-right:7px}
.about-v2 .a-info-label{font-size:.78rem;color:var(--a-muted);margin:8px 0 4px}
.about-v2 .a-info-value{font-size:.95rem;font-weight:700;color:var(--a-text);overflow-wrap:anywhere}
.about-v2 .a-goal{border-left:4px solid #287ff4}
.about-v2 .a-socials{display:flex;flex-wrap:wrap;gap:10px}
.about-v2 .a-social{display:inline-flex;align-items:center;gap:9px;padding:11px 15px;border-radius:11px;border:1px solid var(--a-line);background:var(--a-card);color:var(--a-text);text-decoration:none;font-weight:700}
.about-v2 .a-social:hover{color:var(--a-blue);border-color:var(--a-blue)}
.about-v2 .a-social i{color:var(--a-blue)}
.about-v2 .a-cta{background:linear-gradient(115deg,#1553b9,#287ff4);border-radius:22px;padding:42px;color:#fff}
.about-v2 .a-cta h2{color:#fff;font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800}
.about-v2 .a-cta p{color:#e1edff;line-height:1.8}
.about-v2 .a-cta .a-btn{background:#fff;color:#1553b9}
@media(max-width:991.98px){.about-v2 .a-hero{padding:65px 0}.about-v2 .a-photo-wrap{max-width:310px;margin-top:25px}.about-v2 .a-section{padding:60px 0}}
@media(max-width:575.98px){.about-v2 .a-hero{padding:45px 0}.about-v2 .a-info{grid-template-columns:1fr}.about-v2 .a-card{padding:22px}.about-v2 .a-cta{padding:28px}}
@media(prefers-reduced-motion:reduce){.about-v2 .a-btn{transition:none}}
</style>
@endpush

@section('content')
@php $isEn = app()->getLocale() === 'en'; @endphp
<div class="about-v2">
    <section class="a-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <h1 class="a-title">{{ $isEn ? 'Hello, I am' : 'Xin chào, tôi là' }}<br><span class="a-gradient">{{ $profile?->full_name ?: 'Đỗ Quốc Việt' }}</span></h1>
                    <div class="a-role"><i class="bi bi-code-slash me-2"></i>{{ $profile?->translated('job_title') ?: ($isEn ? 'Information Technology Developer' : 'Lập trình viên Công nghệ thông tin') }}</div>
                    <p class="a-desc">{{ $profile?->translated('short_bio') ?: ($isEn ? 'I enjoy technology and programming and always seek to learn new things.' : 'Tôi yêu thích công nghệ, lập trình và luôn chủ động học hỏi những kiến thức mới để phát triển bản thân.') }}</p>
                    <div class="a-actions">
                        <a class="a-btn a-btn-primary" href="{{ route('projects') }}"><i class="bi bi-grid"></i> {{ $isEn ? 'View projects' : 'Xem dự án' }} <i class="bi bi-arrow-up-right"></i></a>
                        @if($profile?->cv_path && Route::has('cv.download'))
                            <a class="a-btn a-btn-outline" href="{{ route('cv.download') }}"><i class="bi bi-download"></i> {{ $isEn ? 'Download CV' : 'Tải CV' }}</a>
                        @else
                            <a class="a-btn a-btn-outline" href="{{ route('contact') }}"><i class="bi bi-envelope"></i> {{ $isEn ? 'Contact' : 'Liên hệ' }}</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="a-photo-wrap">
                        @if($profile?->avatar)
                            <img class="a-photo" src="{{ asset('uploads/' . $profile->avatar) }}" alt="{{ $isEn ? 'Portrait of ' : 'Ảnh chân dung của ' }}{{ $profile->full_name ?: ($isEn ? 'portfolio owner' : 'chủ Portfolio') }}" decoding="async">
                        @else
                            <div class="a-photo-empty"><i class="bi bi-person"></i></div>
                        @endif
                        <div class="a-photo-label"><i class="bi bi-stars me-2"></i>{{ $isEn ? 'Always learning & growing' : 'Luôn học hỏi & phát triển' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="a-section">
        <div class="container">
            <h2 class="a-section-title">{{ $isEn ? 'More about me' : 'Tìm hiểu thêm về tôi' }}</h2>
            <p class="a-section-sub mb-4">{{ $isEn ? 'Personal background, learning journey, and future goals.' : 'Thông tin cá nhân, hành trình học tập và định hướng phát triển.' }}</p>
            <div class="row g-4">
                <div class="col-lg-7">
                    <article class="a-card">
                        <h3 class="a-card-title"><span class="a-icon"><i class="bi bi-person-lines-fill"></i></span>{{ $isEn ? 'About me' : 'Giới thiệu chi tiết' }}</h3>
                        <div class="a-copy">{{ $profile?->translated('about_me') ?: ($isEn ? 'I am interested in information technology, enjoy building practical products, and continuously improve my programming skills.' : 'Tôi quan tâm đến lĩnh vực Công nghệ thông tin, yêu thích việc xây dựng sản phẩm thực tế và không ngừng rèn luyện kỹ năng lập trình.') }}</div>
                    </article>
                </div>
                <div class="col-lg-5">
                    <aside class="a-card">
                        <h3 class="a-card-title"><span class="a-icon"><i class="bi bi-person-vcard"></i></span>{{ $isEn ? 'Personal information' : 'Thông tin cá nhân' }}</h3>
                        <div class="a-info">
                            @if($profile?->full_name)
                                <div class="a-info-item"><i class="bi bi-person"></i><div class="a-info-label">{{ $isEn ? 'Full name' : 'Họ và tên' }}</div><div class="a-info-value">{{ $profile->full_name }}</div></div>
                            @endif
                            @if($profile?->translated('field'))
                                <div class="a-info-item"><i class="bi bi-laptop"></i><div class="a-info-label">{{ $isEn ? 'Field' : 'Lĩnh vực' }}</div><div class="a-info-value">{{ $profile->translated('field') }}</div></div>
                            @endif
                            @if($profile?->location)
                                <div class="a-info-item"><i class="bi bi-geo-alt"></i><div class="a-info-label">{{ $isEn ? 'Location' : 'Khu vực' }}</div><div class="a-info-value">{{ $profile->location }}</div></div>
                            @endif
                            @if($profile?->contact_email)
                                <div class="a-info-item"><i class="bi bi-envelope"></i><div class="a-info-label">Email</div><div class="a-info-value">{{ $profile->contact_email }}</div></div>
                            @endif
                        </div>
                        @if(!$profile?->full_name && !$profile?->translated('field') && !$profile?->location && !$profile?->contact_email)
                            <p class="a-copy mb-0">{{ $isEn ? 'Personal information is being updated.' : 'Thông tin cá nhân đang được cập nhật trong Admin.' }}</p>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <section class="a-section a-section-alt">
        <div class="container">
            <h2 class="a-section-title">{{ $isEn ? 'Career goals' : 'Mục tiêu nghề nghiệp' }}</h2>
            <p class="a-section-sub mb-4">{{ $isEn ? 'What I aim to achieve in my professional journey.' : 'Những điều tôi hướng đến trong hành trình phát triển chuyên môn.' }}</p>
            <article class="a-card a-goal">
                <h3 class="a-card-title"><span class="a-icon"><i class="bi bi-bullseye"></i></span>{{ $isEn ? 'My goals' : 'Mục tiêu của tôi' }}</h3>
                <div class="a-copy">{{ $profile?->translated('career_goal') ?: ($isEn ? 'I aim to gain practical experience, grow professionally, and contribute to meaningful technology projects.' : 'Tôi mong muốn tích lũy kinh nghiệm thực tế, phát triển kiến thức chuyên môn và đóng góp vào các dự án công nghệ có giá trị.') }}</div>
            </article>
        </div>
    </section>

    <section class="a-section">
        <div class="container">
            <div class="a-cta">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <h2 class="mb-3">{{ $isEn ? 'Let\'s connect!' : 'Cùng kết nối và trao đổi!' }}</h2>
                        <p class="mb-3">{{ $isEn ? 'Interested in my projects or discussing technology? Feel free to get in touch.' : 'Bạn muốn tìm hiểu về các dự án hoặc trao đổi về công nghệ? Hãy liên hệ với tôi.' }}</p>
                        <div class="a-socials">
                            @if($profile?->github_url)<a class="a-social" href="{{ $profile->github_url }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-github"></i> GitHub</a>@endif
                            @if($profile?->linkedin_url)<a class="a-social" href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i> LinkedIn</a>@endif
                            @if($profile?->facebook_url)<a class="a-social" href="{{ $profile->facebook_url }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i> Facebook</a>@endif
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end"><a href="{{ route('contact') }}" class="a-btn"><i class="bi bi-send"></i> {{ $isEn ? 'Contact me' : 'Liên hệ ngay' }} <i class="bi bi-arrow-right"></i></a></div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
