@extends('layouts.app')

@section('title', 'Kinh nghiệm | Portfolio')
@section('meta_description', 'Hành trình học tập, kinh nghiệm dự án và phát triển chuyên môn trong lĩnh vực Công nghệ thông tin.')

@push('styles')
<style>
.experience-modern {
    --ex-bg: #ffffff;
    --ex-text: #0f172a;
    --ex-muted: #64748b;
    --ex-border: #e2e8f0;
    --ex-soft: #eff6ff;
    color: var(--ex-text);
}
html[data-theme="dark"] .experience-modern,
html[data-bs-theme="dark"] .experience-modern {
    --ex-bg: #111c30;
    --ex-text: #f1f5f9;
    --ex-muted: #a6b5cb;
    --ex-border: #30415c;
    --ex-soft: #1b2e4c;
}
.experience-modern .ex-hero {
    margin: 30px 0 65px;
    padding: clamp(50px,8vw,92px) 24px;
    border-radius: 27px;
    background: radial-gradient(circle at 85% 5%, rgba(96,165,250,.28), transparent 35%),
                linear-gradient(125deg,#0b1220,#172554 60%,#312e81);
    text-align: center;
    color: white;
}
.experience-modern .ex-label {
    display: inline-block;
    padding: 8px 18px;
    border: 1px solid rgba(191,219,254,.4);
    background: rgba(255,255,255,.07);
    border-radius: 30px;
    color: #bfdbfe;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .12em;
}
.experience-modern .ex-hero h1 {
    font-size: clamp(33px,5vw,54px);
    font-weight: 800;
    letter-spacing: -.03em;
    margin: 22px 0 15px;
}
.experience-modern .ex-hero p {
    max-width: 690px;
    margin: 0 auto;
    line-height: 1.85;
    color: #cbd5e1;
}
.experience-modern .ex-heading {
    font-size: clamp(25px,3vw,33px);
    font-weight: 800;
    color: var(--ex-text);
    margin-bottom: 10px;
}
.experience-modern .ex-muted { color: var(--ex-muted); }
.experience-modern .ex-count {
    padding: 9px 16px;
    border: 1px solid var(--ex-border);
    border-radius: 30px;
    background: var(--ex-soft);
    color: var(--ex-text);
    font-size: 13px;
    font-weight: 700;
}
.experience-modern .ex-timeline {
    position: relative;
    padding-left: 45px;
    margin-top: 35px;
}
.experience-modern .ex-timeline::before {
    content: "";
    position: absolute;
    left: 13px;
    top: 13px;
    bottom: 30px;
    width: 3px;
    border-radius: 8px;
    background: linear-gradient(#2563eb,#7c3aed);
}
.experience-modern .ex-item {
    position: relative;
    margin-bottom: 26px;
}
.experience-modern .ex-item::before {
    content: "";
    position: absolute;
    left: -39px;
    top: 29px;
    width: 17px;
    height: 17px;
    border-radius: 50%;
    background: #2563eb;
    border: 4px solid var(--ex-bg);
    box-shadow: 0 0 0 3px #93c5fd;
}
.experience-modern .ex-card {
    background: var(--ex-bg);
    border: 1px solid var(--ex-border);
    border-radius: 21px;
    padding: clamp(22px,3vw,32px);
    height: 100%;
    transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
}
.experience-modern .ex-card:hover {
    transform: translateY(-4px);
    border-color: #93c5fd;
    box-shadow: 0 16px 38px rgba(15,23,42,.1);
}
.experience-modern .ex-date {
    display: inline-flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;
    padding: 8px 14px;
    border-radius: 30px;
    background: var(--ex-soft);
    color: #2563eb;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 18px;
}
html[data-theme="dark"] .experience-modern .ex-date,
html[data-bs-theme="dark"] .experience-modern .ex-date { color: #93c5fd; }
.experience-modern .ex-card h3 {
    color: var(--ex-text);
    font-size: clamp(20px,2.5vw,24px);
    font-weight: 800;
    overflow-wrap: anywhere;
    margin-bottom: 12px;
}
.experience-modern .ex-company {
    font-weight: 650;
    color: var(--ex-muted);
    margin-bottom: 16px;
}
.experience-modern .ex-description {
    white-space: pre-line;
    overflow-wrap: anywhere;
    color: var(--ex-muted);
    line-height: 1.9;
}
.experience-modern .ex-icon {
    width: 55px;
    height: 55px;
    border-radius: 16px;
    background: #dbeafe;
    color: #1d4ed8;
    display: grid;
    place-items: center;
    font-size: 25px;
    margin-bottom: 20px;
}
.experience-modern .ex-info h3 { font-size: 19px; }
.experience-modern .ex-info p { color: var(--ex-muted); line-height: 1.8; margin: 0; }
.experience-modern .ex-empty {
    border: 1px dashed var(--ex-border);
    border-radius: 20px;
    background: var(--ex-bg);
    text-align: center;
    padding: 65px 25px;
    color: var(--ex-muted);
}
.experience-modern .ex-cta {
    background: linear-gradient(125deg,#172554,#312e81);
    border-radius: 24px;
    padding: clamp(35px,6vw,65px);
    color: #fff;
    text-align: center;
    margin: 70px 0 50px;
}
.experience-modern .ex-cta p { color: #dbeafe; }
.experience-modern .ex-cta .btn-light { color: #172554; font-weight: 700; }
@media (max-width: 767.98px) {
    .experience-modern .ex-hero { margin-top: 18px; margin-bottom: 45px; border-radius: 18px; }
    .experience-modern .ex-timeline { padding-left: 32px; }
    .experience-modern .ex-timeline::before { left: 9px; }
    .experience-modern .ex-item::before { left: -30px; }
}
@media (prefers-reduced-motion: reduce) {
    .experience-modern .ex-card { transition: none; }
    .experience-modern .ex-card:hover { transform: none; }
}
</style>
@endpush

@section('content')
<div class="container experience-modern pb-4">
    <header class="ex-hero">
        <span class="ex-label">MY JOURNEY & EXPERIENCE</span>
        <h1>Hành trình & Kinh nghiệm</h1>
        <p>Những cột mốc trong quá trình học tập, thực hành dự án và phát triển kỹ năng công nghệ của tôi.</p>
    </header>

    <section aria-labelledby="timeline-title">
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
            <div>
                <h2 id="timeline-title" class="ex-heading">Dòng thời gian</h2>
                <p class="ex-muted mb-0">Các hoạt động và kinh nghiệm đã tích lũy.</p>
            </div>
            <span class="ex-count">
                <i class="bi bi-clock-history me-2"></i>{{ $experiences->count() }} trải nghiệm
            </span>
        </div>

        @if($experiences->isNotEmpty())
            <div class="ex-timeline">
                @foreach($experiences as $experience)
                    <div class="ex-item">
                        <article class="ex-card">
                            @if($experience->start_date || $experience->end_date)
                                <div class="ex-date">
                                    <i class="bi bi-calendar3"></i>
                                    <span>
                                        {{ $experience->start_date ? \Illuminate\Support\Carbon::parse($experience->start_date)->format('m/Y') : 'Chưa xác định' }}
                                        —
                                        {{ $experience->end_date ? \Illuminate\Support\Carbon::parse($experience->end_date)->format('m/Y') : 'Hiện tại' }}
                                    </span>
                                </div>
                            @endif

                            <h3>{{ $experience->title }}</h3>

                            @if($experience->company)
                                <div class="ex-company">
                                    <i class="bi bi-building me-2"></i>{{ $experience->company }}
                                </div>
                            @endif

                            @if($experience->description)
                                <div class="ex-description">{{ $experience->description }}</div>
                            @endif
                        </article>
                    </div>
                @endforeach
            </div>
        @else
            <div class="ex-empty">
                <i class="bi bi-briefcase display-4 d-block mb-3"></i>
                <h3 class="h5 fw-bold">Chưa có kinh nghiệm nào</h3>
                <p class="mb-0">Dữ liệu sẽ xuất hiện sau khi được cập nhật từ trang quản trị.</p>
            </div>
        @endif
    </section>

    <section class="mt-5 pt-4" aria-labelledby="development-title">
        <div class="text-center mb-4">
            <h2 id="development-title" class="ex-heading">Những điều tôi luôn hướng đến</h2>
            <p class="ex-muted mb-0">Không ngừng phát triển chuyên môn và các kỹ năng làm việc.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <article class="ex-card ex-info">
                    <span class="ex-icon"><i class="bi bi-code-slash"></i></span>
                    <h3>Phát triển chuyên môn</h3>
                    <p>Tăng cường kỹ năng lập trình, tìm hiểu công nghệ và ứng dụng kiến thức vào dự án.</p>
                </article>
            </div>
            <div class="col-md-4">
                <article class="ex-card ex-info">
                    <span class="ex-icon"><i class="bi bi-people"></i></span>
                    <h3>Hợp tác và giao tiếp</h3>
                    <p>Trao đổi ý tưởng, tiếp nhận phản hồi và phối hợp hiệu quả khi làm việc nhóm.</p>
                </article>
            </div>
            <div class="col-md-4">
                <article class="ex-card ex-info">
                    <span class="ex-icon"><i class="bi bi-graph-up-arrow"></i></span>
                    <h3>Không ngừng tiến bộ</h3>
                    <p>Học hỏi từ thử thách, cải thiện phương pháp làm việc và định hướng phát triển lâu dài.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="ex-cta" aria-labelledby="experience-cta-title">
        <h2 id="experience-cta-title" class="fw-bold mb-3">Khám phá các dự án tôi đã thực hiện</h2>
        <p class="mb-4">Những kiến thức và trải nghiệm được vận dụng trong các sản phẩm thực tế.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('projects') }}" class="btn btn-light px-4 py-2">
                <i class="bi bi-folder2-open me-2"></i>Xem dự án
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light px-4 py-2">
                <i class="bi bi-envelope me-2"></i>Liên hệ
            </a>
        </div>
    </section>
</div>
@endsection
