
@extends('layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Skills | Đỗ Quốc Việt' : 'Kỹ năng | Đỗ Quốc Việt')

@push('styles')
<style>
    .skills-v5 {
        padding: 70px 0 90px;
        color: var(--bs-body-color);
    }

    .skills-v5 .sk-hero {
        text-align: center;
        margin-bottom: 65px;
    }

    .skills-v5 .sk-kicker {
        display: inline-block;
        color: #6366f1;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .skills-v5 .sk-title {
        font-size: clamp(32px, 5vw, 52px);
        font-weight: 800;
        margin-bottom: 20px;
    }

    .skills-v5 .sk-lead {
        max-width: 750px;
        margin: 0 auto;
        color: var(--bs-secondary-color);
        line-height: 1.8;
        font-size: 16px;
    }

    .skills-v5 .sk-section {
        margin-bottom: 75px;
    }

    .skills-v5 .sk-section-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .skills-v5 .sk-section-title {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .skills-v5 .sk-subtitle {
        color: var(--bs-secondary-color);
        margin: 0;
    }

    .skills-v5 .sk-count {
        white-space: nowrap;
        padding: 10px 16px;
        border-radius: 50px;
        background: rgba(99, 102, 241, 0.1);
        color: #6366f1;
        font-size: 14px;
        font-weight: 600;
    }

    .skills-v5 .sk-card {
        height: 100%;
        padding: 28px;
        border-radius: 20px;
        border: 1px solid var(--bs-border-color);
        background: var(--bs-body-bg);
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.035);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .skills-v5 .sk-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(99, 102, 241, 0.12);
    }

    .skills-v5 .sk-icon {
        width: 62px;
        height: 62px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border-radius: 16px;
        background: rgba(99, 102, 241, 0.09);
        color: #6366f1;
        font-size: 30px;
        margin-bottom: 22px;
    }

    .skills-v5 .sk-icon img {
        width: 38px;
        height: 38px;
        object-fit: contain;
    }

    .skills-v5 .sk-card h3 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .skills-v5 .sk-description {
        color: var(--bs-secondary-color);
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .skills-v5 .sk-empty {
        padding: 35px;
        border: 1px dashed var(--bs-border-color);
        border-radius: 18px;
        text-align: center;
        color: var(--bs-secondary-color);
    }

    .skills-v5 .sk-cta {
        padding: 55px 25px;
        text-align: center;
        border-radius: 25px;
        color: #fff;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
    }

    .skills-v5 .sk-cta h2 {
        font-weight: 800;
    }

    .skills-v5 .sk-cta p {
        color: rgba(255, 255, 255, 0.85);
    }

    .skills-v5 .sk-cta .btn {
        padding: 11px 22px;
        border-radius: 12px;
        font-weight: 600;
    }

    @media (max-width: 767px) {
        .skills-v5 {
            padding: 45px 0 65px;
        }

        .skills-v5 .sk-section-head {
            align-items: flex-start;
            flex-direction: column;
        }

        .skills-v5 .sk-section-title {
            font-size: 24px;
        }

        .skills-v5 .sk-card {
            padding: 22px;
        }
    }
</style>
@endpush

@section('content')

@php
    $isEnglish = app()->getLocale() === 'en';

    $techLogos = [
        'php' => 'php/php-original.svg',
        'laravel' => 'laravel/laravel-original.svg',
        'python' => 'python/python-original.svg',
        'mysql' => 'mysql/mysql-original.svg',
        'html' => 'html5/html5-original.svg',
        'html5' => 'html5/html5-original.svg',
        'css' => 'css3/css3-original.svg',
        'css3' => 'css3/css3-original.svg',
        'javascript' => 'javascript/javascript-original.svg',
        'bootstrap' => 'bootstrap/bootstrap-original.svg',
        'git' => 'git/git-original.svg',
        'github' => 'github/github-original.svg',
        'java' => 'java/java-original.svg',
        'flutter' => 'flutter/flutter-original.svg',
        'dart' => 'dart/dart-original.svg',
        'react' => 'react/react-original.svg',
        'vue' => 'vuejs/vuejs-original.svg',
        'node.js' => 'nodejs/nodejs-original.svg',
        'c++' => 'cplusplus/cplusplus-original.svg',
        'c#' => 'csharp/csharp-original.svg',
    ];

    $programmingSkills = $programmingSkills ?? collect();
    $personalSkills = $personalSkills ?? collect();
@endphp

<div class="skills-v5">
    <div class="container">

        <header class="sk-hero">

            <h1 class="sk-title">{{ $isEnglish ? 'My Skills' : 'Kỹ năng của tôi' }}</h1>

            <p class="sk-lead">
                {{ $isEnglish
                    ? 'Technologies, technical knowledge, and personal skills I am developing through learning and projects.'
                    : 'Những công nghệ, kiến thức chuyên môn và kỹ năng cá nhân tôi đang rèn luyện trong quá trình học tập và thực hiện dự án.' }}
            </p>
        </header>

        {{-- KỸ NĂNG LẬP TRÌNH --}}
        <section class="sk-section" aria-labelledby="technical-title">

            <div class="sk-section-head">
                <div>
                    <h2 id="technical-title" class="sk-section-title">
                        {{ $isEnglish ? 'Technical Skills' : 'Kỹ năng lập trình' }}
                    </h2>

                    <p class="sk-subtitle">
                        {{ $isEnglish ? 'Programming languages, frameworks, databases, and tools.' : 'Ngôn ngữ lập trình, framework, cơ sở dữ liệu và công cụ.' }}
                    </p>
                </div>

                <span class="sk-count">
                    <i class="bi bi-grid-3x3-gap me-2"></i>
                    {{ $programmingSkills->count() }} {{ $isEnglish ? 'skills' : 'kỹ năng' }}
                </span>
            </div>

            <div class="row g-4">

                @forelse($programmingSkills as $skill)

                    @php
                        $skillName = mb_strtolower(trim((string) $skill->name));

                        $logoPath = $techLogos[$skillName] ?? null;

                        $uploadedIcon = !empty($skill->icon)
                            ? (
                                filter_var($skill->icon, FILTER_VALIDATE_URL)
                                    ? $skill->icon
                                    : asset('uploads/' . ltrim($skill->icon, '/'))
                            )
                            : null;
                    @endphp

                    <div class="col-md-6 col-lg-4">
                        <article class="sk-card">

                            <div class="d-flex justify-content-between align-items-center gap-2">

                                <span class="sk-icon">

                                    @if($uploadedIcon)
                                        <img
                                            src="{{ $uploadedIcon }}"
                                            alt="Logo {{ $skill->translated('name') }}"
                                            loading="lazy"
                                            onerror="this.style.display='none';this.nextElementSibling.style.display='inline-block'"
                                        >
                                        <i class="bi bi-code-square" style="display:none"></i>

                                    @elseif($logoPath)
                                        <img
                                            src="{{ 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/' . $logoPath }}"
                                            alt="Logo {{ $skill->translated('name') }}"
                                            loading="lazy"
                                            onerror="this.style.display='none';this.nextElementSibling.style.display='inline-block'"
                                        >
                                        <i class="bi bi-code-square" style="display:none"></i>

                                    @else
                                        <i class="bi bi-code-square"></i>
                                    @endif

                                </span>

                            </div>

                            <h3>{{ $skill->translated('name') }}</h3>

                            @if(filled($skill->translated('description')))
                                <p class="sk-description">
                                    {{ $skill->translated('description') }}
                                </p>
                            @endif

                        </article>
                    </div>

                @empty
                    <div class="col-12">
                        <div class="sk-empty">
                            {{ $isEnglish ? 'No technical skills yet.' : 'Chưa có kỹ năng lập trình. Hãy thêm trong Admin.' }}
                        </div>
                    </div>
                @endforelse

            </div>
        </section>

        {{-- KỸ NĂNG CÁ NHÂN --}}
        <section class="sk-section" aria-labelledby="personal-title">

            <div class="sk-section-head">
                <div>
                    <h2 id="personal-title" class="sk-section-title">
                        {{ $isEnglish ? 'Personal Skills' : 'Kỹ năng cá nhân' }}
                    </h2>

                    <p class="sk-subtitle">
                        {{ $isEnglish ? 'Skills that support learning, teamwork, and personal growth.' : 'Các kỹ năng hỗ trợ học tập, làm việc và phát triển bản thân.' }}
                    </p>
                </div>

                <span class="sk-count">
                    <i class="bi bi-person-check me-2"></i>
                    {{ $personalSkills->count() }} {{ $isEnglish ? 'skills' : 'kỹ năng' }}
                </span>
            </div>

            <div class="row g-4">

                @forelse($personalSkills as $skill)

                    @php
                        $uploadedIcon = !empty($skill->icon)
                            ? (
                                filter_var($skill->icon, FILTER_VALIDATE_URL)
                                    ? $skill->icon
                                    : asset('uploads/' . ltrim($skill->icon, '/'))
                            )
                            : null;
                    @endphp

                    <div class="col-md-6 col-lg-4">
                        <article class="sk-card">

                            <span class="sk-icon">

                                @if($uploadedIcon)
                                    <img
                                        src="{{ $uploadedIcon }}"
                                        alt="{{ $isEnglish ? 'Icon' : 'Biểu tượng' }} {{ $skill->translated('name') }}"
                                        loading="lazy"
                                        onerror="this.style.display='none';this.nextElementSibling.style.display='inline-block'"
                                    >
                                    <i class="bi bi-person-check" style="display:none"></i>
                                @else
                                    <i class="bi bi-person-check"></i>
                                @endif

                            </span>

                            <h3>{{ $skill->translated('name') }}</h3>

                            @if(filled($skill->translated('description')))
                                <p class="sk-description">
                                    {{ $skill->translated('description') }}
                                </p>
                            @endif

                        </article>
                    </div>

                @empty
                    <div class="col-12">
                        <div class="sk-empty">
                            {{ $isEnglish ? 'No personal skills yet.' : 'Chưa có kỹ năng cá nhân. Hãy thêm trong Admin.' }}
                        </div>
                    </div>
                @endforelse

            </div>
        </section>

        {{-- KHÁM PHÁ DỰ ÁN --}}
        <section class="sk-cta" aria-labelledby="skills-cta-title">

            <h2 id="skills-cta-title" class="mb-3">
                {{ $isEnglish ? 'Explore My Projects' : 'Khám phá các dự án của tôi' }}
            </h2>

            <p class="mb-4">
                {{ $isEnglish ? 'See how I apply these skills in real projects.' : 'Xem cách tôi áp dụng những kỹ năng này trong các dự án thực tế.' }}
            </p>

            <div class="d-flex flex-wrap justify-content-center gap-3">

                <a href="{{ route('projects') }}" class="btn btn-light">
                    <i class="bi bi-folder2-open me-2"></i>
                    {{ $isEnglish ? 'View Projects' : 'Xem dự án' }}
                </a>

                <a href="{{ route('contact') }}" class="btn btn-outline-light">
                    <i class="bi bi-envelope me-2"></i>
                    {{ $isEnglish ? 'Contact' : 'Liên hệ' }}
                </a>

            </div>
        </section>

    </div>
</div>

@endsection
