@extends('layouts.app')

@section('title', 'Trang chủ | Portfolio')
@section('meta_description', 'Portfolio cá nhân giới thiệu bản thân, kỹ năng lập trình, dự án Công nghệ thông tin và định hướng nghề nghiệp.')

@push('styles')
<style>
/* HOME PAGE — scoped styles to avoid changing Admin and other pages */
.portfolio-home { --home-accent:#3b82f6; --home-ink:#10213b; --home-muted:#64748b; --home-surface:#fff; --home-border:#e2e8f0; color:var(--home-ink); }
.portfolio-home .home-hero { position:relative; overflow:hidden; padding:105px 0 95px; background:radial-gradient(ellipse at 82% 18%,rgba(59,130,246,.16),transparent 42%),linear-gradient(135deg,#f4f8ff,#fff 65%); }
.portfolio-home .home-hero::before { content:""; position:absolute; inset:auto -8% -160px auto; width:380px; height:380px; border-radius:50%; background:rgba(99,102,241,.07); pointer-events:none; }
.portfolio-home .home-eyebrow { display:inline-flex; align-items:center; gap:9px; border:1px solid rgba(59,130,246,.22); border-radius:100px; padding:9px 15px; color:#2563eb; background:rgba(59,130,246,.07); font-weight:700; font-size:.84rem; letter-spacing:.03em; }
.portfolio-home .home-eyebrow .dot { width:8px; height:8px; border-radius:50%; background:#22c55e; box-shadow:0 0 0 4px rgba(34,197,94,.12); }
.portfolio-home .home-heading { margin:24px 0 15px; font-size:clamp(2.55rem,5.2vw,4.6rem); line-height:1.12; letter-spacing:-.055em; font-weight:800; overflow-wrap:anywhere; }
.portfolio-home .home-heading .gradient-text { background:linear-gradient(100deg,#2563eb,#7c3aed); -webkit-background-clip:text; background-clip:text; color:transparent; }
.portfolio-home .home-role { color:#2563eb; font-size:clamp(1.12rem,2.1vw,1.5rem); font-weight:700; }
.portfolio-home .home-description { color:var(--home-muted); font-size:1.06rem; line-height:1.9; max-width:630px; }
.portfolio-home .home-btn { display:inline-flex; align-items:center; justify-content:center; gap:10px; border-radius:13px; padding:13px 23px; font-weight:700; text-decoration:none; transition:transform .2s,box-shadow .2s,background .2s; }
.portfolio-home .home-btn:hover { transform:translateY(-3px); }
.portfolio-home .home-btn-primary { background:linear-gradient(110deg,#2563eb,#4f46e5); color:#fff; box-shadow:0 12px 28px rgba(37,99,235,.2); }
.portfolio-home .home-btn-primary:hover { color:#fff; box-shadow:0 16px 30px rgba(37,99,235,.28); }
.portfolio-home .home-btn-secondary { color:var(--home-ink); border:1px solid var(--home-border); background:var(--home-surface); }
.portfolio-home .home-btn-secondary:hover { color:#2563eb; border-color:#93c5fd; }
.portfolio-home .home-social { display:flex; flex-wrap:wrap; gap:10px; margin-top:26px; }
.portfolio-home .home-social a { width:43px; height:43px; border:1px solid var(--home-border); border-radius:12px; display:inline-flex; justify-content:center; align-items:center; color:var(--home-ink); background:var(--home-surface); text-decoration:none; font-size:1.18rem; transition:all .2s; }
.portfolio-home .home-social a:hover { color:#2563eb; border-color:#93c5fd; transform:translateY(-3px); }
.portfolio-home .home-portrait-wrap { position:relative; max-width:405px; margin:auto; }
.portfolio-home .home-portrait-glow { position:absolute; inset:12px; border-radius:40px; background:linear-gradient(135deg,#60a5fa,#8b5cf6); transform:rotate(7deg); opacity:.22; }
.portfolio-home .home-portrait { position:relative; width:100%; aspect-ratio:1/1; object-fit:cover; border-radius:35px; border:8px solid var(--home-surface); box-shadow:0 30px 75px rgba(30,64,175,.17); background:#dbeafe; }
.portfolio-home .home-portrait-placeholder { position:relative; aspect-ratio:1/1; display:flex; align-items:center; justify-content:center; border-radius:35px; border:8px solid var(--home-surface); background:linear-gradient(135deg,#dbeafe,#e9d5ff); font-size:8rem; color:#4f46e5; box-shadow:0 30px 75px rgba(30,64,175,.13); }
.portfolio-home .home-floating-label { position:absolute; bottom:-18px; left:-18px; display:flex; gap:10px; align-items:center; padding:13px 18px; border:1px solid var(--home-border); background:var(--home-surface); color:var(--home-ink); border-radius:14px; box-shadow:0 15px 35px rgba(15,23,42,.12); font-weight:700; }
.portfolio-home .home-floating-label i { color:#2563eb; font-size:1.35rem; }
.portfolio-home .home-section { padding:90px 0; }
.portfolio-home .home-section-alt { background:#f4f7fc; }
.portfolio-home .home-section-kicker { display:block; color:#2563eb; text-transform:uppercase; letter-spacing:.14em; font-size:.77rem; font-weight:800; margin-bottom:12px; }
.portfolio-home .home-section-title { font-size:clamp(1.9rem,3.4vw,2.6rem); font-weight:800; letter-spacing:-.035em; margin:0 0 15px; }
.portfolio-home .home-section-desc { color:var(--home-muted); line-height:1.8; }
.portfolio-home .home-panel { background:var(--home-surface); border:1px solid var(--home-border); border-radius:22px; padding:35px; box-shadow:0 16px 45px rgba(15,23,42,.035); }
.portfolio-home .home-about-text { white-space:pre-line; color:var(--home-muted); font-size:1.06rem; line-height:2; }
.portfolio-home .home-card { height:100%; background:var(--home-surface); border:1px solid var(--home-border); border-radius:20px; overflow:hidden; transition:transform .25s,box-shadow .25s,border-color .25s; }
.portfolio-home .home-card:hover { transform:translateY(-6px); border-color:#bfdbfe; box-shadow:0 20px 40px rgba(15,23,42,.09); }
.portfolio-home .home-skill-card { padding:28px; }
.portfolio-home .home-skill-icon { display:flex; align-items:center; justify-content:center; width:56px; height:56px; border-radius:16px; color:#2563eb; background:linear-gradient(135deg,#dbeafe,#eef2ff); font-size:1.6rem; margin-bottom:20px; }
.portfolio-home .home-skill-name { font-weight:750; font-size:1.15rem; margin-bottom:12px; }
.portfolio-home .home-pill { display:inline-block; border:1px solid rgba(59,130,246,.16); border-radius:100px; padding:5px 12px; background:rgba(59,130,246,.08); color:#2563eb; font-size:.78rem; font-weight:700; }
.portfolio-home .home-project-media { display:block; height:215px; overflow:hidden; background:linear-gradient(135deg,#dbeafe,#ede9fe); }
.portfolio-home .home-project-media img { display:block; width:100%; height:100%; object-fit:cover; transition:transform .35s; }
.portfolio-home .home-card:hover .home-project-media img { transform:scale(1.045); }
.portfolio-home .home-project-placeholder { display:flex; height:100%; align-items:center; justify-content:center; color:#4f46e5; font-size:3.5rem; }
.portfolio-home .home-project-body { padding:26px; }
.portfolio-home .home-project-title { font-size:1.18rem; font-weight:800; margin-bottom:12px; }
.portfolio-home .home-project-desc { color:var(--home-muted); line-height:1.8; min-height:55px; }
.portfolio-home .home-tech { color:#2563eb; font-size:.87rem; line-height:1.7; overflow-wrap:anywhere; }
.portfolio-home .home-inline-link { display:inline-flex; align-items:center; gap:9px; font-weight:750; text-decoration:none; color:#2563eb; }
.portfolio-home .home-inline-link:hover { color:#1d4ed8; }
.portfolio-home .home-timeline { position:relative; padding-left:32px; }
.portfolio-home .home-timeline::before { content:""; position:absolute; left:9px; top:10px; bottom:10px; width:2px; background:#bfdbfe; }
.portfolio-home .home-timeline-item { position:relative; background:var(--home-surface); border:1px solid var(--home-border); border-radius:17px; padding:24px 27px; margin-bottom:20px; }
.portfolio-home .home-timeline-item::before { content:""; position:absolute; top:30px; left:-30px; width:14px; height:14px; background:#2563eb; border:3px solid #dbeafe; border-radius:50%; }
.portfolio-home .home-timeline-item h3 { font-size:1.1rem; font-weight:800; }
.portfolio-home .home-timeline-item p { color:var(--home-muted); line-height:1.8; white-space:pre-line; }
.portfolio-home .home-contact-banner { border-radius:28px; padding:65px 35px; color:#fff; text-align:center; background:radial-gradient(circle at 15% 15%,rgba(255,255,255,.15),transparent 40%),linear-gradient(120deg,#1d4ed8,#4338ca); }
.portfolio-home .home-contact-banner p { color:#dbeafe; }
.portfolio-home .home-contact-banner .home-btn { background:#fff; color:#1d4ed8; }
.portfolio-home .home-contact-banner .home-btn:hover { color:#1d4ed8; }
.portfolio-home .home-empty { color:var(--home-muted); border:1px dashed var(--home-border); border-radius:18px; padding:35px; text-align:center; width:100%; }
html[data-theme="dark"] .portfolio-home { --home-ink:#f1f5f9; --home-muted:#a8b7cb; --home-surface:#172438; --home-border:#334155; }
html[data-theme="dark"] .portfolio-home .home-hero { background:radial-gradient(ellipse at 82% 18%,rgba(59,130,246,.19),transparent 45%),linear-gradient(135deg,#0b1220,#111d31); }
html[data-theme="dark"] .portfolio-home .home-section-alt { background:#101b2d; }
html[data-theme="dark"] .portfolio-home .home-eyebrow { color:#93c5fd; background:rgba(59,130,246,.13); }
html[data-theme="dark"] .portfolio-home .home-role,html[data-theme="dark"] .portfolio-home .home-section-kicker,html[data-theme="dark"] .portfolio-home .home-tech,html[data-theme="dark"] .portfolio-home .home-inline-link { color:#93c5fd; }
html[data-theme="dark"] .portfolio-home .home-pill { color:#93c5fd; }
html[data-theme="dark"] .portfolio-home .home-social a:hover,html[data-theme="dark"] .portfolio-home .home-btn-secondary:hover { color:#93c5fd; }
@media(max-width:991.98px){.portfolio-home .home-hero{padding:75px 0}.portfolio-home .home-portrait-wrap{max-width:330px;margin-top:30px}.portfolio-home .home-section{padding:65px 0}}
@media(max-width:575.98px){.portfolio-home .home-hero{padding:55px 0 70px}.portfolio-home .home-heading{font-size:2.5rem}.portfolio-home .home-portrait-wrap{max-width:270px}.portfolio-home .home-floating-label{left:0;bottom:-13px;font-size:.8rem;padding:10px 12px}.portfolio-home .home-panel{padding:23px}.portfolio-home .home-contact-banner{padding:45px 22px}.portfolio-home .home-btn{padding:12px 17px}}
@media(prefers-reduced-motion:reduce){.portfolio-home .home-card,.portfolio-home .home-btn,.portfolio-home .home-project-media img,.portfolio-home .home-social a{transition:none}.portfolio-home .home-card:hover,.portfolio-home .home-btn:hover,.portfolio-home .home-social a:hover{transform:none}}
</style>
@endpush

@section('content')
<div class="portfolio-home">
    {{-- HERO --}}
    <section class="home-hero">
        <div class="container position-relative">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="home-eyebrow"><span class="dot"></span> CHÀO MỪNG ĐẾN VỚI PORTFOLIO</span>
                    <h1 class="home-heading">Xin chào, tôi là<br><span class="gradient-text">{{ $profile?->full_name ?: 'Tên của bạn' }}</span></h1>
                    <p class="home-role mb-3"><i class="bi bi-code-slash me-2"></i>{{ $profile?->job_title ?: 'Web Developer' }}</p>
                    <p class="home-description">{{ $profile?->short_bio ?: 'Chào mừng bạn đến với website Portfolio cá nhân của tôi. Đây là nơi giới thiệu những kỹ năng, dự án và kinh nghiệm của tôi.' }}</p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="{{ route('projects') }}" class="home-btn home-btn-primary"><i class="bi bi-grid-1x2"></i> Khám phá dự án <i class="bi bi-arrow-up-right"></i></a>
                        <a href="{{ route('contact') }}" class="home-btn home-btn-secondary"><i class="bi bi-chat-dots"></i> Liên hệ với tôi</a>
                        @if($profile?->cv_path && Route::has('cv.download'))
                            <a href="{{ route('cv.download') }}" class="home-btn home-btn-secondary"><i class="bi bi-file-earmark-arrow-down"></i> Tải CV PDF</a>
                        @endif
                    </div>
                    <div class="home-social">
                        @if($profile?->github_url)<a href="{{ $profile->github_url }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub" title="GitHub"><i class="bi bi-github"></i></a>@endif
                        @if($profile?->linkedin_url)<a href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" title="LinkedIn"><i class="bi bi-linkedin"></i></a>@endif
                        @if($profile?->facebook_url)<a href="{{ $profile->facebook_url }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" title="Facebook"><i class="bi bi-facebook"></i></a>@endif
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="home-portrait-wrap">
                        <div class="home-portrait-glow"></div>
                        @if($profile?->avatar)
                            <img class="home-portrait" src="{{ asset('storage/' . $profile->avatar) }}" alt="Ảnh đại diện của {{ $profile->full_name ?: 'chủ Portfolio' }}" fetchpriority="high" decoding="async">
                        @else
                            <div class="home-portrait-placeholder"><i class="bi bi-person"></i></div>
                        @endif
                        <div class="home-floating-label"><i class="bi bi-stars"></i> Đam mê công nghệ</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ABOUT --}}
    <section class="home-section">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-4">
                    <span class="home-section-kicker">01 / VỀ TÔI</span>
                    <h2 class="home-section-title">Một chút về bản thân</h2>
                    <p class="home-section-desc">Tìm hiểu về hành trình học tập, sở thích và định hướng phát triển của tôi.</p>
                    <a href="{{ route('about') }}" class="home-inline-link">Khám phá thêm <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="col-lg-8">
                    <div class="home-panel"><p class="home-about-text mb-0">{{ $profile?->about_me ?: 'Tôi yêu thích công nghệ, lập trình và luôn mong muốn học hỏi những kiến thức mới để phát triển bản thân.' }}</p></div>
                </div>
            </div>
        </div>
    </section>

    {{-- SKILLS --}}
    <section class="home-section home-section-alt">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5">
                <div><span class="home-section-kicker">02 / CHUYÊN MÔN</span><h2 class="home-section-title">Kỹ năng nổi bật</h2><p class="home-section-desc mb-0">Những kỹ năng và công nghệ tôi đang sử dụng, phát triển.</p></div>
                <a href="{{ route('skills') }}" class="home-inline-link">Tất cả kỹ năng <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="row g-4">
                @forelse($skills as $skill)
                    <div class="col-md-6 col-lg-4"><div class="home-card home-skill-card"><div class="home-skill-icon"><i class="bi bi-code-square"></i></div><h3 class="home-skill-name">{{ $skill->name }}</h3>@if($skill->level)<span class="home-pill">{{ $skill->level }}</span>@endif</div></div>
                @empty
                    <div class="col-12"><div class="home-empty">Chưa có kỹ năng nào được cập nhật.</div></div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- PROJECTS --}}
    <section class="home-section">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5">
                <div><span class="home-section-kicker">03 / SẢN PHẨM</span><h2 class="home-section-title">Dự án nổi bật</h2><p class="home-section-desc mb-0">Một số sản phẩm và dự án tôi đã thực hiện.</p></div>
                <a href="{{ route('projects') }}" class="home-inline-link">Xem tất cả dự án <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="row g-4">
                @forelse($projects as $project)
                    <div class="col-md-6 col-lg-4">
                        <article class="home-card">
                            <a class="home-project-media" href="{{ route('projects.show', $project) }}" aria-label="Xem dự án {{ $project->title }}">
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" loading="lazy" decoding="async">
                                @else
                                    <span class="home-project-placeholder"><i class="bi bi-folder2-open"></i></span>
                                @endif
                            </a>
                            <div class="home-project-body">
                                <h3 class="home-project-title">{{ $project->title }}</h3>
                                <p class="home-project-desc">{{ \Illuminate\Support\Str::limit($project->description, 125) }}</p>
                                @if($project->technologies)<p class="home-tech mb-3"><i class="bi bi-code-slash me-1"></i>{{ \Illuminate\Support\Str::limit($project->technologies, 90) }}</p>@endif
                                <a href="{{ route('projects.show', $project) }}" class="home-inline-link">Chi tiết dự án <i class="bi bi-arrow-up-right"></i></a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12"><div class="home-empty">Chưa có dự án nào được cập nhật.</div></div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- EXPERIENCE --}}
    <section class="home-section home-section-alt">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4"><span class="home-section-kicker">04 / HÀNH TRÌNH</span><h2 class="home-section-title">Kinh nghiệm</h2><p class="home-section-desc">Quá trình học tập, làm việc và những điều tôi tích lũy được.</p><a href="{{ route('experience') }}" class="home-inline-link">Xem chi tiết <i class="bi bi-arrow-right"></i></a></div>
                <div class="col-lg-8"><div class="home-timeline">
                    @forelse($experiences as $experience)
                        <article class="home-timeline-item">
                            <h3>{{ $experience->title }}</h3>
                            @if($experience->company)
                                <p class="home-tech fw-semibold mb-2">{{ $experience->company }}</p>
                            @endif
                            @if($experience->description)
                                <p class="mb-0">{{ $experience->description }}</p>
                            @endif
                        </article>
                    @empty
                        <div class="home-empty">Chưa có thông tin kinh nghiệm.</div>
                    @endforelse
                </div></div>
            </div>
        </div>
    </section>

    {{-- CONTACT --}}
    <section class="home-section">
        <div class="container"><div class="home-contact-banner"><span class="text-uppercase fw-bold small" style="letter-spacing:.14em">CÙNG KẾT NỐI</span><h2 class="home-section-title mt-3 text-white">Bạn có ý tưởng muốn trao đổi?</h2><p class="mb-4">Hãy liên hệ để cùng chia sẻ về công nghệ, dự án và cơ hội hợp tác.</p><a href="{{ route('contact') }}" class="home-btn"><i class="bi bi-send"></i> Gửi lời nhắn <i class="bi bi-arrow-right"></i></a></div></div>
    </section>
</div>
@endsection
