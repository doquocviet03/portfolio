@extends('layouts.app')

@section('title', 'Kỹ năng | Portfolio')
@section('meta_description', 'Khám phá kỹ năng lập trình, công nghệ sử dụng và kỹ năng phát triển phần mềm.')

@push('styles')
<style>
    .skills-modern {
        --sk-surface: #ffffff;
        --sk-text: #0f172a;
        --sk-muted: #64748b;
        --sk-border: #e2e8f0;
        --sk-soft: #f1f5f9;
        --sk-accent: #2563eb;
        color: var(--sk-text);
    }
    html[data-theme="dark"] .skills-modern,
    html[data-bs-theme="dark"] .skills-modern {
        --sk-surface: #111c30;
        --sk-text: #f1f5f9;
        --sk-muted: #a6b5cb;
        --sk-border: #30415c;
        --sk-soft: #192943;
        --sk-accent: #93c5fd;
    }
    .skills-modern .sk-hero {
        margin: 30px 0 65px;
        padding: clamp(52px, 8vw, 95px) 24px;
        border-radius: 28px;
        position: relative;
        overflow: hidden;
        text-align: center;
        color: #fff;
        background: radial-gradient(circle at 85% 12%, rgba(96,165,250,.28), transparent 35%),
                    linear-gradient(120deg, #0b1220, #172554 60%, #312e81);
    }
    .skills-modern .sk-hero > * { position: relative; z-index: 1; }
    .skills-modern .sk-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid rgba(191,219,254,.35);
        border-radius: 99px;
        background: rgba(255,255,255,.09);
        padding: 8px 17px;
        color: #bfdbfe;
        font-weight: 700;
        font-size: 12px;
        letter-spacing: .12em;
        text-transform: uppercase;
    }
    .skills-modern .sk-hero h1 {
        margin: 22px 0 16px;
        font-size: clamp(34px, 5vw, 58px);
        font-weight: 850;
        letter-spacing: -.035em;
    }
    .skills-modern .sk-hero p {
        max-width: 680px;
        margin: 0 auto;
        color: #cbd5e1;
        line-height: 1.85;
        font-size: 16px;
    }
    .skills-modern .sk-section { padding-bottom: 78px; }
    .skills-modern .sk-heading {
        font-weight: 800;
        font-size: clamp(25px, 3vw, 34px);
        color: var(--sk-text);
        letter-spacing: -.025em;
        margin-bottom: 10px;
    }
    .skills-modern .sk-muted { color: var(--sk-muted); }
    .skills-modern .sk-count {
        border: 1px solid var(--sk-border);
        background: var(--sk-soft);
        color: var(--sk-text);
        border-radius: 99px;
        padding: 9px 17px;
        font-weight: 700;
        font-size: 13px;
    }
    .skills-modern .sk-card {
        background: var(--sk-surface);
        border: 1px solid var(--sk-border);
        border-radius: 22px;
        padding: 27px;
        height: 100%;
        box-shadow: 0 8px 28px rgba(15,23,42,.035);
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .skills-modern .sk-card:hover {
        transform: translateY(-5px);
        border-color: #60a5fa;
        box-shadow: 0 18px 42px rgba(37,99,235,.12);
    }
    .skills-modern .sk-icon {
        width: 57px;
        height: 57px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border-radius: 17px;
        background: linear-gradient(135deg, #dbeafe, #e0e7ff);
        color: #1d4ed8;
        font-size: 26px;
        flex-shrink: 0;
    }
    .skills-modern .sk-card h3 {
        font-size: 19px;
        font-weight: 750;
        margin: 22px 0 9px;
        overflow-wrap: anywhere;
        color: var(--sk-text);
    }
    .skills-modern .sk-level {
        display: inline-block;
        border-radius: 8px;
        padding: 5px 10px;
        background: var(--sk-soft);
        color: var(--sk-accent);
        font-size: 13px;
        font-weight: 700;
    }
    .skills-modern .sk-progress {
        margin-top: 19px;
        background: var(--sk-soft);
        height: 9px;
        border-radius: 99px;
        overflow: hidden;
    }
    .skills-modern .sk-progress-fill {
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(90deg, #2563eb, #8b5cf6);
    }
    .skills-modern .sk-progress-note {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 10px;
        font-size: 12px;
        color: var(--sk-muted);
    }
    .skills-modern .sk-info-card h3 { font-size: 18px; margin-top: 20px; }
    .skills-modern .sk-info-card p { color: var(--sk-muted); line-height: 1.8; margin: 0; }
    .skills-modern .sk-empty {
        border: 1px dashed var(--sk-border);
        border-radius: 22px;
        padding: 60px 25px;
        text-align: center;
        color: var(--sk-muted);
        background: var(--sk-surface);
    }
    .skills-modern .sk-cta {
        padding: clamp(35px, 6vw, 65px);
        border-radius: 26px;
        background: linear-gradient(125deg, #172554, #312e81);
        text-align: center;
        color: #fff;
        margin-bottom: 55px;
    }
    .skills-modern .sk-cta h2 { font-weight: 800; }
    .skills-modern .sk-cta p { color: #dbeafe; }
    .skills-modern .sk-cta .btn-light { color: #172554; font-weight: 700; }
    .skills-modern .sk-cta .btn-outline-light { font-weight: 700; }
    @media (max-width: 767.98px) {
        .skills-modern .sk-hero { margin-top: 18px; margin-bottom: 45px; border-radius: 19px; }
        .skills-modern .sk-section { padding-bottom: 55px; }
        .skills-modern .sk-card { padding: 23px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .skills-modern .sk-card { transition: none; }
        .skills-modern .sk-card:hover { transform: none; }
    }
</style>
@endpush

@section('content')
<div class="container skills-modern">
    <header class="sk-hero">
        <span class="sk-eyebrow"><i class="bi bi-stars"></i> Skills & Expertise</span>
        <h1>Kỹ năng của tôi</h1>
        <p>Những công nghệ, kiến thức chuyên môn và kỹ năng tôi đang sử dụng,
           rèn luyện và phát triển qua học tập cùng các dự án thực tế.</p>
    </header>

    <section class="sk-section" aria-labelledby="skills-title">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <div>
                <h2 id="skills-title" class="sk-heading">Kỹ năng chuyên môn</h2>
                <p class="sk-muted mb-0">Danh sách kỹ năng được cập nhật từ hệ thống quản trị.</p>
            </div>
            <span class="sk-count"><i class="bi bi-grid-3x3-gap me-2"></i>{{ $skills->count() }} kỹ năng</span>
        </div>

        <div class="row g-4">
            @forelse($skills as $skill)
                @php
                    $rawLevel = $skill->level;
                    $hasNumericLevel = is_numeric($rawLevel);
                    $numericLevel = $hasNumericLevel ? max(0, min(100, (float) $rawLevel)) : null;
                @endphp
                <div class="col-md-6 col-lg-4">
                    <article class="sk-card">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <span class="sk-icon"><i class="bi bi-code-square"></i></span>
                            @if($hasNumericLevel)
                                <span class="sk-level">{{ round($numericLevel) }}%</span>
                            @elseif(filled($rawLevel))
                                <span class="sk-level">{{ $rawLevel }}</span>
                            @endif
                        </div>
                        <h3>{{ $skill->name }}</h3>
                        @if($hasNumericLevel)
                            <div class="sk-progress" role="progressbar"
                                 aria-label="Mức độ kỹ năng {{ $skill->name }}"
                                 aria-valuenow="{{ $numericLevel }}"
                                 aria-valuemin="0" aria-valuemax="100">
                                <div class="sk-progress-fill" style="width: {{ $numericLevel }}%"></div>
                            </div>
                            <div class="sk-progress-note">
                                <span>Mức độ đã cập nhật</span>
                                <span>{{ round($numericLevel) }}/100</span>
                            </div>
                        @elseif(filled($rawLevel))
                            <p class="sk-muted small mb-0 mt-3">Cấp độ: {{ $rawLevel }}</p>
                        @else
                            <p class="sk-muted small mb-0 mt-3">Đang tiếp tục phát triển</p>
                        @endif
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="sk-empty">
                        <i class="bi bi-tools display-4 d-block mb-3"></i>
                        <h3 class="h5 fw-bold">Chưa có kỹ năng nào</h3>
                        <p class="mb-0">Danh sách sẽ xuất hiện sau khi kỹ năng được thêm từ Admin.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <section class="sk-section" aria-labelledby="soft-skills-title">
        <div class="text-center mb-4">
            <h2 id="soft-skills-title" class="sk-heading">Kỹ năng hỗ trợ</h2>
            <p class="sk-muted mb-0">Những năng lực quan trọng khi học tập và phát triển phần mềm.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <article class="sk-card sk-info-card">
                    <span class="sk-icon"><i class="bi bi-lightbulb"></i></span>
                    <h3>Tư duy giải quyết vấn đề</h3>
                    <p>Phân tích yêu cầu, xác định nguyên nhân và tìm kiếm hướng xử lý phù hợp khi lập trình.</p>
                </article>
            </div>
            <div class="col-md-4">
                <article class="sk-card sk-info-card">
                    <span class="sk-icon"><i class="bi bi-people"></i></span>
                    <h3>Làm việc nhóm</h3>
                    <p>Trao đổi ý tưởng, phối hợp công việc và cùng các thành viên hoàn thành mục tiêu.</p>
                </article>
            </div>
            <div class="col-md-4">
                <article class="sk-card sk-info-card">
                    <span class="sk-icon"><i class="bi bi-book"></i></span>
                    <h3>Tự học và phát triển</h3>
                    <p>Chủ động đọc tài liệu, thực hành công nghệ mới và cải thiện kiến thức chuyên môn.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="sk-cta" aria-labelledby="skills-cta-title">
        <h2 id="skills-cta-title" class="mb-3">Khám phá các dự án của tôi</h2>
        <p class="mb-4">Xem cách những kỹ năng này được áp dụng trong các sản phẩm và bài thực hành.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ url('/projects') }}" class="btn btn-light px-4 py-2">
                <i class="bi bi-folder2-open me-2"></i>Xem dự án
            </a>
            <a href="{{ url('/contact') }}" class="btn btn-outline-light px-4 py-2">
                <i class="bi bi-envelope me-2"></i>Liên hệ
            </a>
        </div>
    </section>
</div>
@endsection
