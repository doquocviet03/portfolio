@extends('layouts.app')



@section('title', (app()->getLocale() === 'en' ? 'Home' : 'Trang chủ') . ' | Đỗ Quốc Việt')



@section('meta_description', app()->getLocale() === 'en' ? 'Personal portfolio featuring my background, skills, projects, and experience in information technology.' : 'Portfolio cá nhân: giới thiệu, kỹ năng, dự án và kinh nghiệm trong lĩnh vực công nghệ thông tin.')



@push('styles')



<style>



/* Chỉ áp dụng cho trang chủ, không ảnh hưởng Admin */



.portfolio-home { --ph-bg:#081526; --ph-panel:#10243b; --ph-panel-2:#0c1d32; --ph-text:#f4f8ff; --ph-muted:#a5b9d2; --ph-line:#203c5b; --ph-blue:#2990ff; background:var(--ph-bg); color:var(--ph-text); }



.portfolio-home a { text-decoration:none; }



.portfolio-home .home-hero { position:relative; overflow:hidden; padding:95px 0 76px; background:radial-gradient(circle at 77% 22%,rgba(24,118,245,.20),transparent 38%),linear-gradient(135deg,#071426,#0b1d34); }



.portfolio-home .home-hero:before { content:""; position:absolute; inset:0; pointer-events:none; background-image:linear-gradient(rgba(100,160,240,.035) 1px,transparent 1px),linear-gradient(90deg,rgba(100,160,240,.035) 1px,transparent 1px); background-size:55px 55px; mask-image:linear-gradient(to bottom,black,transparent); }



.portfolio-home .home-eyebrow { display:inline-flex; gap:9px; align-items:center; color:#83baff; font-weight:700; font-size:.84rem; letter-spacing:.08em; text-transform:uppercase; }



.portfolio-home .home-eyebrow:before { content:""; width:8px; height:8px; border-radius:50%; background:#38d9a9; box-shadow:0 0 0 5px rgba(56,217,169,.12); }



.portfolio-home .home-heading { font-size:clamp(2.5rem,5vw,4.65rem); line-height:1.14; font-weight:850; letter-spacing:-.055em; margin:24px 0 15px; }



.portfolio-home .home-heading span { color:var(--ph-blue); }



.portfolio-home .home-role { font-size:clamp(1.08rem,2vw,1.45rem); color:#d9e9ff; font-weight:700; margin-bottom:20px; }



.portfolio-home .home-description { max-width:650px; color:var(--ph-muted); font-size:1.05rem; line-height:1.9; }



.portfolio-home .home-actions { display:flex; flex-wrap:wrap; gap:12px; margin-top:29px; }



.portfolio-home .home-btn { display:inline-flex; align-items:center; justify-content:center; gap:10px; padding:13px 22px; border-radius:11px; font-weight:750; transition:transform .2s,background .2s,border-color .2s; }



.portfolio-home .home-btn:hover { transform:translateY(-2px); }



.portfolio-home .home-btn-primary { color:#fff; background:linear-gradient(120deg,#1675ee,#359dff); box-shadow:0 12px 30px rgba(21,107,235,.23); }



.portfolio-home .home-btn-primary:hover { color:#fff; }



.portfolio-home .home-btn-outline { color:#e7f1ff; border:1px solid #3a5877; background:rgba(255,255,255,.035); }



.portfolio-home .home-btn-outline:hover { color:#fff; border-color:#63a6ff; }



.portfolio-home .home-social { display:flex; gap:12px; margin-top:25px; }



.portfolio-home .home-social a { width:42px; height:42px; display:grid; place-items:center; border:1px solid var(--ph-line); border-radius:11px; color:#c4dcf8; background:var(--ph-panel-2); font-size:1.15rem; }



.portfolio-home .home-social a:hover { color:#fff; border-color:var(--ph-blue); }



.portfolio-home .home-image-wrap { position:relative; max-width:470px; margin:auto; }



.portfolio-home .home-image-wrap:before { content:""; position:absolute; inset:24px -14px -18px 24px; border-radius:26px; background:linear-gradient(135deg,rgba(41,144,255,.40),rgba(41,144,255,.06)); filter:blur(12px); }



.portfolio-home .home-image { display:block; position:relative; width:100%; height:405px; object-fit:cover; border-radius:24px; border:1px solid #2d4c6b; box-shadow:0 25px 70px rgba(0,0,0,.27); }



.portfolio-home .home-image-empty { position:relative; height:405px; display:grid; place-items:center; border:1px dashed #345675; border-radius:24px; background:linear-gradient(140deg,#102a48,#0b1a2c); color:#6faeff; font-size:7rem; }



.portfolio-home .home-image-label { position:absolute; bottom:-15px; left:-15px; z-index:1; display:flex; align-items:center; gap:9px; padding:12px 17px; background:#102b49; border:1px solid #305476; border-radius:12px; color:#eaf3ff; font-size:.87rem; font-weight:700; }



.portfolio-home .home-image-label i { color:#52a5ff; }



.portfolio-home .home-stats { margin-top:74px; }



.portfolio-home .home-stat { height:100%; text-align:center; padding:23px 12px; background:rgba(16,39,67,.88); border:1px solid #244362; border-radius:15px; }



.portfolio-home .home-stat-number { display:block; font-size:clamp(1.65rem,2.5vw,2.15rem); line-height:1.3; font-weight:850; color:#62adff; }



.portfolio-home .home-stat-label { color:#aec1d8; font-size:.84rem; margin-top:4px; }



.portfolio-home .home-section { padding:78px 0; }



.portfolio-home .home-section-alt { background:#0b1b2e; }



.portfolio-home .home-kicker { color:#59a8ff; font-size:.78rem; font-weight:800; letter-spacing:.13em; text-transform:uppercase; }



.portfolio-home .home-title { font-size:clamp(1.85rem,3.2vw,2.55rem); font-weight:800; letter-spacing:-.035em; margin:12px 0; }



.portfolio-home .home-muted { color:var(--ph-muted); line-height:1.85; }



.portfolio-home .home-panel,.portfolio-home .home-card { background:var(--ph-panel); border:1px solid var(--ph-line); border-radius:17px; }



.portfolio-home .home-panel { padding:30px; }



.portfolio-home .home-about-text { white-space:pre-line; }



.portfolio-home .home-card { height:100%; overflow:hidden; transition:transform .22s,border-color .22s; }



.portfolio-home .home-card:hover { transform:translateY(-5px); border-color:#4074a9; }



.portfolio-home .home-skill-card { padding:25px; }



.portfolio-home .home-skill-icon { width:49px; height:49px; display:grid; place-items:center; background:#17385d; color:#7bbaff; border-radius:12px; font-size:1.45rem; margin-bottom:17px; }



.portfolio-home .home-skill-icon img { width:100%; height:100%; object-fit:contain; padding:6px; }
.portfolio-home .home-skill-icon img.home-devicon { padding:8px; }
.portfolio-home .home-skill-name { font-size:1.1rem; font-weight:750; }



.portfolio-home .home-pill { display:inline-block; color:#9dccff; background:#173455; border-radius:100px; padding:5px 11px; font-size:.8rem; }



.portfolio-home .home-project-image { display:block; height:195px; background:#183452; overflow:hidden; }



.portfolio-home .home-project-image img { width:100%; height:100%; object-fit:cover; }



.portfolio-home .home-project-placeholder { height:100%; display:grid; place-items:center; color:#70b3ff; font-size:3rem; }



.portfolio-home .home-project-body { padding:24px; }



.portfolio-home .home-project-title { font-size:1.13rem; font-weight:800; color:#fff; }



.portfolio-home .home-tech { color:#7db9ff; font-size:.85rem; overflow-wrap:anywhere; }



.portfolio-home .home-link { color:#71b6ff; font-weight:700; }



.portfolio-home .home-link:hover { color:#fff; }



.portfolio-home .home-timeline { border-left:2px solid #285784; padding-left:25px; }



.portfolio-home .home-timeline-item { position:relative; padding:20px 24px; margin-bottom:16px; background:var(--ph-panel); border:1px solid var(--ph-line); border-radius:14px; }



.portfolio-home .home-timeline-item:before { content:""; position:absolute; width:12px; height:12px; border-radius:50%; background:#2990ff; left:-32px; top:25px; }



.portfolio-home .home-contact-banner { text-align:center; border-radius:22px; padding:55px 25px; border:1px solid #285583; background:linear-gradient(125deg,#10365f,#0e2748); }



.portfolio-home .home-empty { border:1px dashed #3b5572; border-radius:13px; padding:24px; color:#a6bbd3; }



html[data-theme="light"] .portfolio-home { --ph-bg:#f7faff; --ph-panel:#fff; --ph-panel-2:#fff; --ph-text:#14263f; --ph-muted:#5f7085; --ph-line:#dce5f0; }



html[data-theme="light"] .portfolio-home .home-hero { background:radial-gradient(circle at 77% 22%,rgba(24,118,245,.12),transparent 40%),#f5f9ff; }



html[data-theme="light"] .portfolio-home .home-role,html[data-theme="light"] .portfolio-home .home-project-title { color:#19314e; }



html[data-theme="light"] .portfolio-home .home-btn-outline { color:#1a3657; border-color:#c8d8e9; }



html[data-theme="light"] .portfolio-home .home-section-alt { background:#edf4fc; }



html[data-theme="light"] .portfolio-home .home-stat { background:#fff; border-color:#d7e5f5; }



html[data-theme="light"] .portfolio-home .home-stat-label { color:#5e7188; }



html[data-theme="light"] .portfolio-home .home-image-label { background:#fff; color:#18334f; }



html[data-theme="light"] .portfolio-home .home-social a { color:#29547e; }



html[data-theme="light"] .portfolio-home .home-timeline-item { background:#fff; }



@@media(max-width:991.98px) { .portfolio-home .home-hero { padding:65px 0; } .portfolio-home .home-image-wrap { margin-top:35px; max-width:420px; } .portfolio-home .home-stats { margin-top:65px; } }



@@media(max-width:575.98px) { .portfolio-home .home-heading { font-size:2.65rem; } .portfolio-home .home-image,.portfolio-home .home-image-empty { height:305px; } .portfolio-home .home-image-label { left:5px; } .portfolio-home .home-section { padding:55px 0; } .portfolio-home .home-panel { padding:22px; } }



@@media(prefers-reduced-motion:reduce) { .portfolio-home .home-card,.portfolio-home .home-btn { transition:none; } }



</style>



@endpush



@section('content')



@php



    $isEn = app()->getLocale() === 'en';



@endphp



<div class="portfolio-home">



    <section class="home-hero">



        <div class="container position-relative">



            <div class="row align-items-center g-5">



                <div class="col-lg-7">



                    <span class="home-eyebrow">{{ $isEn ? 'Welcome to my Portfolio' : 'Chào mừng đến với Portfolio' }}</span>



                    <h1 class="home-heading">{{ $isEn ? 'Hello, I am' : 'Xin chào, tôi là' }}<br><span>{{ $profile?->full_name ?: 'Đỗ Quốc Việt' }}</span></h1>



                    <p class="home-role"><i class="bi bi-code-slash me-2"></i>{{ $isEn



    ? ($profile?->job_title_en ?: $profile?->job_title ?: 'Information Technology Developer')



    : ($profile?->job_title ?: 'Lập trình viên Công nghệ thông tin') }}</p>



                    <p class="home-description">{{ $isEn



    ? ($profile?->short_bio_en ?: $profile?->short_bio ?: 'I enjoy programming and technology, and I am always eager to learn and grow through real-world projects.')



    : ($profile?->short_bio ?: 'Tôi yêu thích lập trình, công nghệ và luôn mong muốn học hỏi, phát triển bản thân thông qua các dự án thực tế.') }}</p>



                    <div class="home-actions">



                        <a class="home-btn home-btn-primary" href="{{ route('projects') }}"><i class="bi bi-grid"></i> {{ $isEn ? 'View Projects' : 'Xem dự án' }} <i class="bi bi-arrow-up-right"></i></a>



@if(Route::has('cv.download') && $profile?->cv_path)



                            <a class="home-btn home-btn-outline" href="{{ route('cv.download') }}"><i class="bi bi-download"></i> {{ $isEn ? 'Download CV' : 'Tải CV' }}</a>



@else



                            <a class="home-btn home-btn-outline" href="{{ route('contact') }}"><i class="bi bi-envelope"></i> {{ $isEn ? 'Contact' : 'Liên hệ' }}</a>



@endif



                    </div>



                    <div class="home-social">



@if($profile?->github_url)



<a href="{{ $profile->github_url }}" target="_blank" rel="noopener noreferrer" title="GitHub" aria-label="GitHub"><i class="bi bi-github"></i></a>



@endif



@if($profile?->linkedin_url)



<a href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener noreferrer" title="LinkedIn" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>



@endif



@if($profile?->facebook_url)



<a href="{{ $profile->facebook_url }}" target="_blank" rel="noopener noreferrer" title="Facebook" aria-label="Facebook"><i class="bi bi-facebook"></i></a>



@endif



                    </div>



                </div>



                <div class="col-lg-5">



                    <div class="home-image-wrap">



@if($profile?->avatar)



                            <img class="home-image" src="{{ asset('storage/' . $profile->avatar) }}" alt="Ảnh của {{ $profile->full_name ?: 'chủ Portfolio' }}" fetchpriority="high">



@else



                            <div class="home-image-empty"><i class="bi bi-person-workspace"></i></div>



@endif



                        <div class="home-image-label"><i class="bi bi-stars"></i> {{ $isEn ? 'Passionate about Technology' : 'Đam mê công nghệ' }}</div>



                    </div>



                </div>



            </div>



            <div class="row g-3 home-stats">



                <div class="col-6 col-lg-3"><div class="home-stat"><span class="home-stat-number">{{ $projects->count() }}+</span><div class="home-stat-label">{{ $isEn ? 'Featured Projects' : 'Dự án nổi bật' }}</div></div></div>



                <div class="col-6 col-lg-3"><div class="home-stat"><span class="home-stat-number">{{ $skills->count() }}+</span><div class="home-stat-label">{{ $isEn ? 'Skills & Technologies' : 'Kỹ năng & công nghệ' }}</div></div></div>



                <div class="col-6 col-lg-3"><div class="home-stat"><span class="home-stat-number">{{ $experiences->count() }}+</span><div class="home-stat-label">{{ $isEn ? 'Experience' : 'Kinh nghiệm' }}</div></div></div>



                <div class="col-6 col-lg-3"><div class="home-stat"><span class="home-stat-number">{{ date('Y') }}</span><div class="home-stat-label">{{ $isEn ? 'Current Year' : 'Năm hiện tại' }}</div></div></div>



            </div>



        </div>



    </section>



    <section class="home-section">



        <div class="container">



            <div class="row align-items-center g-4">



                <div class="col-lg-4">



                    <h2 class="home-title">{{ $isEn ? 'A Little About Me' : 'Một chút về bản thân' }}</h2>



                    <p class="home-muted">{{ $isEn ? 'Learn about my studies, career goals, and passion for technology.' : 'Tìm hiểu về hành trình học tập, định hướng và niềm yêu thích công nghệ của tôi.' }}</p>



                    <a class="home-link" href="{{ route('about') }}">{{ $isEn ? 'About Me' : 'Xem giới thiệu' }} <i class="bi bi-arrow-right ms-1"></i></a>



                </div>



                <div class="col-lg-8"><div class="home-panel"><p class="home-muted home-about-text mb-0">{{ $profile?->translated('about_me') ?: ($isEn ? 'I strive to improve my knowledge, work on real-world projects, and develop my IT skills.' : 'Tôi luôn mong muốn trau dồi kiến thức, tham gia các dự án thực tế và phát triển kỹ năng trong lĩnh vực công nghệ thông tin.') }}</p></div></div>



            </div>



        </div>



    </section>



    <section class="home-section home-section-alt">



        <div class="container">



            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">



                <div><h2 class="home-title">{{ $isEn ? 'Featured Skills' : 'Kỹ năng nổi bật' }}</h2><p class="home-muted mb-0">{{ $isEn ? 'Technologies and skills I am learning and using.' : 'Những công nghệ và kỹ năng tôi đang học tập, sử dụng.' }}</p></div>



                <a class="home-link" href="{{ route('skills') }}">{{ $isEn ? 'All Skills' : 'Tất cả kỹ năng' }} <i class="bi bi-arrow-right"></i></a>



            </div>



            <div class="row g-4">



@forelse($skills as $skill)
    @php
        $skillName = mb_strtolower(trim((string) $skill->name));
        $iconPath = $skill->icon;
        $hasUploadedIcon = filled($iconPath) && str_starts_with($iconPath, 'skills/');

        $devicons = [
            'python' => 'python/python-original.svg',
            'c#' => 'csharp/csharp-original.svg',
            'csharp' => 'csharp/csharp-original.svg',
            'c++' => 'cplusplus/cplusplus-original.svg',
            'java' => 'java/java-original.svg',
            'javascript' => 'javascript/javascript-original.svg',
            'typescript' => 'typescript/typescript-original.svg',
            'php' => 'php/php-original.svg',
            'laravel' => 'laravel/laravel-original.svg',
            'mysql' => 'mysql/mysql-original.svg',
            'html' => 'html5/html5-original.svg',
            'html5' => 'html5/html5-original.svg',
            'css' => 'css3/css3-original.svg',
            'css3' => 'css3/css3-original.svg',
            'bootstrap' => 'bootstrap/bootstrap-original.svg',
            'react' => 'react/react-original.svg',
            'vue' => 'vuejs/vuejs-original.svg',
            'node.js' => 'nodejs/nodejs-original.svg',
            'nodejs' => 'nodejs/nodejs-original.svg',
            'flutter' => 'flutter/flutter-original.svg',
            'dart' => 'dart/dart-original.svg',
            'git' => 'git/git-original.svg',
            'github' => 'github/github-original.svg',
            'docker' => 'docker/docker-original.svg',
            'sql server' => 'microsoftsqlserver/microsoftsqlserver-plain.svg',
            'figma' => 'figma/figma-original.svg',
        ];
        $devicon = $devicons[$skillName] ?? null;
    @endphp
    <div class="col-md-6 col-lg-4">
        <div class="home-card home-skill-card">
            <div class="home-skill-icon">
                @if($hasUploadedIcon)
                    <img src="{{ asset('storage/' . $iconPath) }}"
                         alt="{{ $skill->translated('name') }}" loading="lazy">
                @elseif($devicon && $skill->type === 'programming')
                    <img class="home-devicon"
                         src="{{ 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/' . $devicon }}"
                         alt="{{ $skill->translated('name') }}" loading="lazy">
                @else
                    <i class="bi {{ $skill->type === 'personal' ? 'bi-person-check' : 'bi-code-square' }}"
                       aria-hidden="true"></i>
                @endif
            </div>
            <h3 class="home-skill-name">{{ $skill->translated('name') }}</h3>
            @if($skill->type === 'programming' && $skill->level !== null)
                <span class="home-pill">{{ $skill->level }}%</span>
            @endif
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="home-empty">
            {{ $isEn ? 'No skills have been added yet.' : 'Chưa có kỹ năng nào được cập nhật.' }}
        </div>
    </div>
@endforelse



            </div>



        </div>



    </section>



    <section class="home-section">



        <div class="container">



            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">



                <div><h2 class="home-title">{{ $isEn ? 'Featured Projects' : 'Dự án nổi bật' }}</h2><p class="home-muted mb-0">{{ $isEn ? 'Some of the projects and products I have worked on.' : 'Một số dự án và sản phẩm tôi đã thực hiện.' }}</p></div>



                <a class="home-link" href="{{ route('projects') }}">{{ $isEn ? 'View All' : 'Xem tất cả' }} <i class="bi bi-arrow-right"></i></a>



            </div>



            <div class="row g-4">



@forelse($projects as $project)



                    <div class="col-md-6 col-lg-4">



                        <article class="home-card">



                            <a class="home-project-image" href="{{ route('projects.show', $project) }}" aria-label="{{ $isEn ? 'View project' : 'Xem dự án' }} {{ $project->translated('title') }}">



@if($project->image)



<img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->translated('title') }}" loading="lazy">



@else



<span class="home-project-placeholder"><i class="bi bi-folder2-open"></i></span>



@endif



                            </a>



                            <div class="home-project-body">



                                <h3 class="home-project-title">{{ $project->translated('title') }}</h3>



                                <p class="home-muted">{{ \Illuminate\Support\Str::limit(strip_tags($project->translated('description') ?? ''), 125) }}</p>



@if($project->technologies)



<p class="home-tech"><i class="bi bi-code-slash me-1"></i>{{ \Illuminate\Support\Str::limit($project->technologies, 90) }}</p>



@endif



                                <a class="home-link" href="{{ route('projects.show', $project) }}">{{ $isEn ? 'Project Details' : 'Chi tiết dự án' }} <i class="bi bi-arrow-up-right"></i></a>



                            </div>



                        </article>



                    </div>



@empty



                    <div class="col-12"><div class="home-empty">{{ $isEn ? 'No projects have been added yet.' : 'Chưa có dự án nào được cập nhật.' }}</div></div>



@endforelse



            </div>



        </div>



    </section>



    <section class="home-section home-section-alt">



        <div class="container">



            <div class="row g-4">



                <div class="col-lg-4"><h2 class="home-title">{{ $isEn ? 'Experience' : 'Kinh nghiệm' }}</h2><p class="home-muted">{{ $isEn ? 'My learning journey, work experience, and lessons gained.' : 'Quá trình học tập, làm việc và những điều tôi tích lũy được.' }}</p><a class="home-link" href="{{ route('experience') }}">{{ $isEn ? 'View Details' : 'Xem chi tiết' }} <i class="bi bi-arrow-right"></i></a></div>



                <div class="col-lg-8"><div class="home-timeline">



@forelse($experiences as $experience)



                        <article class="home-timeline-item"><h3 class="h5 fw-bold">{{ $experience->translated('title') }}</h3>



@if($experience->translated('company'))



<p class="home-tech mb-2">{{ $experience->translated('company') }}</p>



@endif



@if($experience->translated('description'))



<p class="home-muted mb-0" style="white-space:pre-line">{{ $experience->translated('description') }}</p>



@endif



</article>



@empty



                        <div class="home-empty">{{ $isEn ? 'No experience has been added yet.' : 'Chưa có thông tin kinh nghiệm.' }}</div>



@endforelse



                </div></div>



            </div>



        </div>



    </section>



    <section class="home-section">



        <div class="container"><div class="home-contact-banner"><span class="home-kicker">{{ $isEn ? "Let's Connect" : 'Cùng kết nối' }}</span><h2 class="home-title">{{ $isEn ? 'Have an idea to discuss?' : 'Bạn có ý tưởng muốn trao đổi?' }}</h2><p class="home-muted mb-4">{{ $isEn ? "Let's connect to share ideas about technology, projects, and collaboration opportunities." : 'Hãy liên hệ để cùng chia sẻ về công nghệ, dự án và cơ hội hợp tác.' }}</p><a class="home-btn home-btn-primary" href="{{ route('contact') }}"><i class="bi bi-send"></i> {{ $isEn ? 'Send a Message' : 'Gửi lời nhắn' }}</a></div></div>



    </section>



</div>



@endsection
