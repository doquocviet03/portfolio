@extends('layouts.app')

@section('title', 'Dự án | Portfolio')
@section('meta_description', 'Khám phá các dự án lập trình, công nghệ và sản phẩm tôi đã thực hiện.')

@push('styles')
<style>
.projects-page{--pj-bg:#f8fafc;--pj-card:#fff;--pj-text:#0f172a;--pj-muted:#475569;--pj-border:#dbe3ee;--pj-field:#fff;--pj-chip:#eff6ff;--pj-chip-text:#1d4ed8;--pj-link:#1d4ed8;background:var(--pj-bg);color:var(--pj-text);padding:52px 0 80px;min-height:65vh}
html[data-theme="dark"] .projects-page,html[data-bs-theme="dark"] .projects-page{--pj-bg:#0b1220;--pj-card:#172238;--pj-text:#f1f5f9;--pj-muted:#cbd5e1;--pj-border:#334155;--pj-field:#111c30;--pj-chip:#223a60;--pj-chip-text:#bfdbfe;--pj-link:#93c5fd}
.projects-page .pj-eyebrow{color:var(--pj-link);font-weight:750;letter-spacing:.13em;text-transform:uppercase;font-size:12px}
.projects-page .pj-heading{font-weight:850;letter-spacing:-.035em;color:var(--pj-text);font-size:clamp(32px,5vw,48px)}
.projects-page .pj-intro{color:var(--pj-muted);max-width:680px;margin:12px auto 0;line-height:1.8}
.projects-page .pj-panel,.projects-page .pj-card{background:var(--pj-card);border:1px solid var(--pj-border);border-radius:20px;box-shadow:0 12px 32px rgba(0,0,0,.045)}
.projects-page .pj-panel{padding:22px;margin:38px 0 28px}
.projects-page .form-label{color:var(--pj-text);font-weight:650}
.projects-page .form-control,.projects-page .form-select{background-color:var(--pj-field);color:var(--pj-text);border:1px solid var(--pj-border);border-radius:11px;min-height:46px}
.projects-page .form-control::placeholder{color:var(--pj-muted);opacity:.85}
.projects-page .form-control:focus,.projects-page .form-select:focus{background-color:var(--pj-field);color:var(--pj-text);border-color:#60a5fa;box-shadow:0 0 0 .2rem rgba(59,130,246,.15)}
.projects-page .form-select option{background:var(--pj-field);color:var(--pj-text)}
.projects-page .pj-card{overflow:hidden;height:100%;transition:transform .2s,border-color .2s}
.projects-page .pj-card:hover{transform:translateY(-4px);border-color:#60a5fa}
.projects-page .pj-image{width:100%;height:210px;object-fit:cover;display:block;background:var(--pj-chip)}
.projects-page .pj-image-fallback{height:210px;display:grid;place-items:center;background:linear-gradient(135deg,#1e3a8a,#4338ca);color:white;font-size:48px}
.projects-page .pj-content{padding:24px;display:flex;flex-direction:column;min-height:230px}
.projects-page .pj-title{color:var(--pj-text)!important;font-size:20px;font-weight:800;margin-bottom:10px}
.projects-page .pj-desc{color:var(--pj-muted)!important;line-height:1.75;font-size:14px;flex-grow:1}
.projects-page .pj-chip{display:inline-block;background:var(--pj-chip);color:var(--pj-chip-text)!important;border:1px solid var(--pj-border);border-radius:30px;padding:5px 11px;font-size:12px;font-weight:650;margin:0 5px 7px 0}
.projects-page .pj-view{color:var(--pj-link)!important;font-weight:750;text-decoration:none}
.projects-page .pj-view:hover{text-decoration:underline}
.projects-page .pj-meta{color:var(--pj-muted)}
.projects-page .pj-empty{background:var(--pj-card);border:1px dashed var(--pj-border);border-radius:20px;padding:65px 20px;text-align:center;color:var(--pj-muted)}
.projects-page .pagination .page-link{background:var(--pj-card);color:var(--pj-text);border-color:var(--pj-border)}
.projects-page .pagination .page-link:hover{background:var(--pj-chip);color:var(--pj-chip-text)}
.projects-page .pagination .page-item.active .page-link{background:#2563eb;color:#fff;border-color:#2563eb}
.projects-page .pagination .page-item.disabled .page-link{background:var(--pj-card);color:var(--pj-muted);opacity:.6}
@media(max-width:767.98px){.projects-page{padding:36px 0 55px}.projects-page .pj-panel{padding:16px}.projects-page .pj-image,.projects-page .pj-image-fallback{height:190px}}
@media(prefers-reduced-motion:reduce){.projects-page .pj-card{transition:none}.projects-page .pj-card:hover{transform:none}}
</style>
@endpush

@section('content')
<section class="projects-page">
    <div class="container">
        <div class="text-center">
            <span class="pj-eyebrow">My Portfolio</span>
            <h1 class="pj-heading mt-2">Dự án của tôi</h1>
            <p class="pj-intro">Các sản phẩm và dự án tôi đã thực hiện trong quá trình học tập, phát triển kỹ năng và khám phá công nghệ.</p>
        </div>

        <form action="{{ route('projects') }}" method="GET" class="pj-panel" role="search">
            <div class="row g-3 align-items-end">
                <div class="col-lg-5">
                    <label for="project-search" class="form-label">Tìm kiếm dự án</label>
                    <input id="project-search" class="form-control" type="search" name="search" value="{{ $search ?? request('search') }}" placeholder="Nhập tên dự án...">
                </div>
                <div class="col-lg-4">
                    <label for="project-technology" class="form-label">Công nghệ</label>
                    <select id="project-technology" name="technology" class="form-select">
                        <option value="">Tất cả công nghệ</option>
                        @foreach(($technologies ?? []) as $tech)
                            <option value="{{ $tech }}" @selected((string)($technology ?? request('technology')) === (string)$tech)>{{ $tech }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3">
                    <label for="project-sort" class="form-label">Sắp xếp</label>
                    <select id="project-sort" name="sort" class="form-select">
                        <option value="latest" @selected(($sort ?? request('sort','latest')) === 'latest')>Mới nhất</option>
                        <option value="oldest" @selected(($sort ?? request('sort')) === 'oldest')>Cũ nhất</option>
                        <option value="name_asc" @selected(($sort ?? request('sort')) === 'name_asc')>Tên A–Z</option>
                        <option value="name_desc" @selected(($sort ?? request('sort')) === 'name_desc')>Tên Z–A</option>
                    </select>
                </div>
                <div class="col-12 d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-search me-2"></i>Tìm kiếm</button>
                    <a href="{{ route('projects') }}" class="btn btn-outline-secondary">Xóa bộ lọc</a>
                </div>
            </div>
        </form>

        @if($projects->count())
            <p class="pj-meta mb-3">Hiển thị {{ $projects->count() }} dự án trên trang này</p>
            <div class="row g-4">
                @foreach($projects as $project)
                    <div class="col-md-6 col-xl-4">
                        <article class="pj-card">
                            @if($project->image)
                                <img class="pj-image" src="{{ asset('storage/' . $project->image) }}" alt="Ảnh dự án {{ $project->title }}" loading="lazy">
                            @else
                                <div class="pj-image-fallback" aria-hidden="true"><i class="bi bi-code-square"></i></div>
                            @endif
                            <div class="pj-content">
                                <h2 class="pj-title">{{ $project->title }}</h2>
                                <p class="pj-desc">{{ \Illuminate\Support\Str::limit(strip_tags($project->description ?? ''), 140) }}</p>
                                @if($project->technologies)
                                    <div class="mb-3">
                                        @foreach(preg_split('/[,;\r\n]+/', $project->technologies) as $tech)
                                            @if(trim($tech) !== '')
                                                <span class="pj-chip">{{ trim($tech) }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                                <a class="pj-view mt-auto" href="{{ route('projects.show', $project) }}">Xem chi tiết <i class="bi bi-arrow-up-right ms-1"></i></a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            @if(method_exists($projects, 'links'))
                <div class="mt-5 d-flex justify-content-center">{{ $projects->appends(request()->query())->links('pagination::bootstrap-5') }}</div>
            @endif
        @else
            <div class="pj-empty">
                <i class="bi bi-folder-x fs-1 d-block mb-3"></i>
                <h2 class="h5 fw-bold" style="color:var(--pj-text)">Chưa tìm thấy dự án</h2>
                <p>Hãy thử từ khóa hoặc bộ lọc khác.</p>
                <a href="{{ route('projects') }}" class="btn btn-primary">Xem tất cả dự án</a>
            </div>
        @endif
    </div>
</section>
@endsection
