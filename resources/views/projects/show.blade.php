@extends('layouts.app')



@section('title', $project->title . ' | Personal Portfolio')

@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($project->description ?? 'Thông tin chi tiết dự án và các công nghệ sử dụng.'), 155))



@push('styles')

<style>

.project-detail-page {

    --pd-surface: #fff;

    --pd-text: #0f172a;

    --pd-muted: #64748b;

    --pd-border: #e2e8f0;

    --pd-soft: #f1f5f9;

    color: var(--pd-text);

}

html[data-theme="dark"] .project-detail-page,

html[data-bs-theme="dark"] .project-detail-page {

    --pd-surface: #111c30;

    --pd-text: #f1f5f9;

    --pd-muted: #a8b6ca;

    --pd-border: #30415c;

    --pd-soft: #1a2941;

}

.project-detail-page .pd-hero {

    position: relative;

    overflow: hidden;

    border-radius: 26px;

    background: radial-gradient(circle at 90% 0%, rgba(96,165,250,.3), transparent 40%),

                linear-gradient(120deg,#0b1220,#172554 60%,#312e81);

    color: #fff;

    padding: clamp(35px,6vw,75px);

    margin-bottom: 35px;

}

.project-detail-page .pd-back {

    display: inline-flex;

    gap: 9px;

    align-items: center;

    color: #bfdbfe;

    text-decoration: none;

    font-weight: 600;

}

.project-detail-page .pd-back:hover { color: #fff; }

.project-detail-page .pd-eyebrow {

    display: inline-block;

    margin: 30px 0 13px;

    padding: 7px 14px;

    border: 1px solid rgba(191,219,254,.4);

    border-radius: 30px;

    color: #bfdbfe;

    font-size: 12px;

    font-weight: 700;

    letter-spacing: .12em;

}

.project-detail-page .pd-hero h1 {

    font-size: clamp(30px,5vw,52px);

    font-weight: 800;

    overflow-wrap: anywhere;

    letter-spacing: -.025em;

}

.project-detail-page .pd-hero p {

    color: #cbd5e1;

    line-height: 1.8;

    max-width: 660px;

}

.project-detail-page .pd-card {

    background: var(--pd-surface);

    border: 1px solid var(--pd-border);

    border-radius: 21px;

    padding: clamp(21px,3vw,30px);

    margin-bottom: 24px;

    box-shadow: 0 8px 30px rgba(15,23,42,.04);

}

.project-detail-page .pd-card h2 {

    color: var(--pd-text);

    font-size: 21px;

    font-weight: 800;

    margin-bottom: 19px;

}

.project-detail-page .pd-card h2 i { color: #60a5fa; }

.project-detail-page .pd-text {

    color: var(--pd-muted);

    line-height: 1.9;

    white-space: pre-line;

    overflow-wrap: anywhere;

}

.project-detail-page .pd-image {

    display: block;

    width: 100%;

    max-height: 510px;

    object-fit: contain;

    border-radius: 15px;

    background: var(--pd-soft);

}

.project-detail-page .pd-placeholder {

    min-height: 280px;

    display: grid;

    place-items: center;

    border-radius: 15px;

    background: var(--pd-soft);

    color: var(--pd-muted);

    font-size: 65px;

}

.project-detail-page .pd-tech {

    display: inline-block;

    border-radius: 9px;

    background: #dbeafe;

    color: #1d4ed8;

    padding: 7px 12px;

    margin: 0 6px 8px 0;

    font-size: 13px;

    font-weight: 700;

}

.project-detail-page .pd-muted { color: var(--pd-muted); }

.project-detail-page .pd-link {

    display: flex;

    justify-content: center;

    align-items: center;

    gap: 9px;

    border-radius: 11px;

    padding: 12px 15px;

    text-decoration: none;

    font-weight: 700;

    margin-top: 10px;

    background: #2563eb;

    color: white;

}

.project-detail-page .pd-link:hover { background: #1d4ed8; color: white; }

.project-detail-page .pd-link.github { background: #0f172a; }

.project-detail-page .pd-link.github:hover { background: #334155; }

.project-detail-page .pd-divider { border-color: var(--pd-border); opacity: 1; }

.project-detail-page .pd-related {

    border: 1px solid var(--pd-border);

    background: var(--pd-surface);

    border-radius: 19px;

    overflow: hidden;

    height: 100%;

    transition: transform .2s ease, box-shadow .2s ease;

}

.project-detail-page .pd-related:hover {

    transform: translateY(-4px);

    box-shadow: 0 15px 35px rgba(15,23,42,.1);

}

.project-detail-page .pd-related img {

    display: block;

    width: 100%;

    height: 190px;

    object-fit: cover;

}

.project-detail-page .pd-related .pd-placeholder { min-height: 190px; }

.project-detail-page .pd-related-body { padding: 22px; }

.project-detail-page .pd-related h3 {

    color: var(--pd-text);

    font-size: 19px;

    font-weight: 750;

    overflow-wrap: anywhere;

}

.project-detail-page .pd-related p {

    color: var(--pd-muted);

    line-height: 1.7;

    font-size: 14px;

}

@media (max-width: 767.98px) {

    .project-detail-page .pd-hero { border-radius: 18px; }

}

@media (prefers-reduced-motion: reduce) {

    .project-detail-page .pd-related { transition: none; }

    .project-detail-page .pd-related:hover { transform: none; }

}


/* Consistent readable foregrounds in both theme modes */
.project-detail-page .pd-card,
.project-detail-page .pd-related,
.project-detail-page .pd-card p,
.project-detail-page .pd-card .fw-semibold,
.project-detail-page #related-projects-title {
    color: var(--pd-text) !important;
}
.project-detail-page .pd-card .pd-text,
.project-detail-page .pd-card .pd-muted,
.project-detail-page .pd-related p {
    color: var(--pd-muted) !important;
}
.project-detail-page .pd-card h2,
.project-detail-page .pd-related h3 {
    color: var(--pd-text) !important;
}
.project-detail-page .pd-hero h1 { color: #ffffff !important; }
.project-detail-page .pd-hero p { color: #cbd5e1 !important; }
.project-detail-page .pd-tech { background: #dbeafe !important; color: #1e40af !important; }
.project-detail-page .pd-link { color: #ffffff !important; }
.project-detail-page .pd-related-body a.btn-outline-primary { color: #2563eb; }
html[data-theme="dark"] .project-detail-page .pd-related-body a.btn-outline-primary,
html[data-bs-theme="dark"] .project-detail-page .pd-related-body a.btn-outline-primary { color: #93c5fd; border-color: #60a5fa; }
html[data-theme="dark"] .project-detail-page .pd-related-body a.btn-outline-primary:hover,
html[data-bs-theme="dark"] .project-detail-page .pd-related-body a.btn-outline-primary:hover { color: #0b1220; background: #93c5fd; }
</style>

@endpush



@section('content')

@php

    $techList = array_values(array_filter(

        array_map('trim', preg_split('/[,;\r\n]+/', (string) ($project->technologies ?? ''))),

        fn ($item) => $item !== ''

    ));

@endphp



<div class="container py-5 project-detail-page">

    <header class="pd-hero">

        <a href="{{ route('projects') }}" class="pd-back">

            <i class="bi bi-arrow-left"></i> Quay lại danh sách dự án

        </a>

        <div><span class="pd-eyebrow">PROJECT CASE STUDY</span></div>

        <h1>{{ $project->title }}</h1>

        <p class="mb-0 mt-3">

            Khám phá thông tin, công nghệ, các chức năng và kết quả của dự án.

        </p>

    </header>



    <div class="row g-4">

        <main class="col-lg-8">

            <section class="pd-card" aria-label="Hình ảnh dự án">

                @if($project->image)

                    <img src="{{ asset('storage/' . $project->image) }}"

                         alt="Hình ảnh dự án {{ $project->title }}"

                         class="pd-image"

                         decoding="async">

                @else

                    <div class="pd-placeholder" aria-label="Chưa có hình ảnh dự án">

                        <i class="bi bi-folder2-open"></i>

                    </div>

                @endif

            </section>



            <section class="pd-card">

                <h2><i class="bi bi-info-circle me-2"></i>Giới thiệu dự án</h2>

                <div class="pd-text">{{ $project->description ?: 'Chưa cập nhật mô tả dự án.' }}</div>

            </section>



            @if($project->features)

                <section class="pd-card">

                    <h2><i class="bi bi-list-check me-2"></i>Các chức năng chính</h2>

                    <div class="pd-text">{{ $project->features }}</div>

                </section>

            @endif



            @if($project->challenges)

                <section class="pd-card">

                    <h2><i class="bi bi-lightbulb me-2"></i>Khó khăn và giải pháp</h2>

                    <div class="pd-text">{{ $project->challenges }}</div>

                </section>

            @endif



            @if($project->results)

                <section class="pd-card">

                    <h2><i class="bi bi-trophy me-2"></i>Kết quả đạt được</h2>

                    <div class="pd-text">{{ $project->results }}</div>

                </section>

            @endif

        </main>



        <aside class="col-lg-4">

            <section class="pd-card">

                <h2><i class="bi bi-cpu me-2"></i>Công nghệ sử dụng</h2>

                @forelse($techList as $tech)

                    <span class="pd-tech">{{ $tech }}</span>

                @empty

                    <p class="pd-muted mb-0">Chưa cập nhật công nghệ.</p>

                @endforelse

            </section>



            <section class="pd-card">

                <h2><i class="bi bi-link-45deg me-2"></i>Liên kết dự án</h2>

                @if($project->github_url)

                    <a class="pd-link github" href="{{ $project->github_url }}"

                       target="_blank" rel="noopener noreferrer">

                        <i class="bi bi-github"></i> Xem mã nguồn GitHub

                    </a>

                @endif

                @if($project->demo_url)

                    <a class="pd-link" href="{{ $project->demo_url }}"

                       target="_blank" rel="noopener noreferrer">

                        <i class="bi bi-box-arrow-up-right"></i> Xem Live Demo

                    </a>

                @endif

                @if(!$project->github_url && !$project->demo_url)

                    <p class="pd-muted mb-0">Chưa có liên kết cho dự án này.</p>

                @endif

            </section>



            <section class="pd-card">

                <h2><i class="bi bi-calendar3 me-2"></i>Thông tin dự án</h2>

                <p class="pd-muted small mb-1">Ngày thêm dự án</p>

                <p class="fw-semibold mb-3">{{ $project->created_at?->format('d/m/Y') ?? 'Chưa cập nhật' }}</p>

                <hr class="pd-divider">

                <p class="pd-muted small mb-1">Cập nhật gần nhất</p>

                <p class="fw-semibold mb-0">{{ $project->updated_at?->format('d/m/Y') ?? 'Chưa cập nhật' }}</p>

            </section>

        </aside>

    </div>



    @if(isset($relatedProjects) && $relatedProjects->isNotEmpty())

        <section class="mt-5" aria-labelledby="related-projects-title">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

                <h2 id="related-projects-title" class="fw-bold mb-0">Dự án khác</h2>

                <a href="{{ route('projects') }}" class="text-decoration-none">

                    Xem tất cả <i class="bi bi-arrow-right"></i>

                </a>

            </div>

            <div class="row g-4">

                @foreach($relatedProjects as $related)

                    <div class="col-md-6 col-lg-4">

                        <article class="pd-related">

                            @if($related->image)

                                <img src="{{ asset('storage/' . $related->image) }}"

                                     alt="Dự án {{ $related->title }}"

                                     loading="lazy" decoding="async">

                            @else

                                <div class="pd-placeholder"><i class="bi bi-folder2-open"></i></div>

                            @endif

                            <div class="pd-related-body">

                                <h3>{{ $related->title }}</h3>

                                <p>{{ \Illuminate\Support\Str::limit($related->description ?? '', 110) }}</p>

                                <a href="{{ route('projects.show', $related) }}"

                                   class="btn btn-outline-primary rounded-pill">

                                    Xem chi tiết <i class="bi bi-arrow-right ms-1"></i>

                                </a>

                            </div>

                        </article>

                    </div>

                @endforeach

            </div>

        </section>

    @endif

</div>

@endsection
