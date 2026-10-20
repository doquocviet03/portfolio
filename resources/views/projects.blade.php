@extends('layouts.app')







@section('title', app()->getLocale() === 'en' ? 'Projects | Đỗ Quốc Việt' : 'Dự án | Đỗ Quốc Việt')



@section('meta_description', app()->getLocale() === 'en' ? 'Explore my software projects and technology work.' : 'Khám phá các dự án lập trình, công nghệ và sản phẩm tôi đã thực hiện.')







@push('styles')



<style>



.projects-page{--pj-bg:#f5f8fd;--pj-card:#fff;--pj-text:#14243b;--pj-muted:#62748c;--pj-border:#dce6f2;--pj-field:#fff;--pj-chip:#eaf3ff;--pj-chip-text:#1769d5;--pj-link:#1769d5;background:var(--pj-bg);color:var(--pj-text);padding:72px 0 100px;min-height:70vh}



html[data-theme="dark"] .projects-page,html[data-bs-theme="dark"] .projects-page{--pj-bg:#081527;--pj-card:#11243d;--pj-text:#f4f8ff;--pj-muted:#acbfd6;--pj-border:#254160;--pj-field:#0d1d32;--pj-chip:#183657;--pj-chip-text:#91c7ff;--pj-link:#69b5ff}



.projects-page .pj-eyebrow{display:inline-block;color:var(--pj-link);font-weight:800;letter-spacing:.17em;text-transform:uppercase;font-size:12px;margin-bottom:12px}



.projects-page .pj-heading{font-weight:850;letter-spacing:-.045em;color:var(--pj-text);font-size:clamp(34px,5vw,54px)}



.projects-page .pj-intro{color:var(--pj-muted);max-width:670px;margin:15px auto 0;line-height:1.85}



.projects-page .pj-panel,.projects-page .pj-card{background:var(--pj-card);border:1px solid var(--pj-border);border-radius:20px;box-shadow:0 15px 45px rgba(3,14,31,.07)}



.projects-page .pj-panel{padding:27px;margin:42px 0 30px}



.projects-page .form-label{color:var(--pj-text);font-weight:700;font-size:14px}



.projects-page .form-control,.projects-page .form-select{background-color:var(--pj-field);color:var(--pj-text);border:1px solid var(--pj-border);border-radius:11px;min-height:48px}



.projects-page .form-control::placeholder{color:var(--pj-muted);opacity:.8}



.projects-page .form-control:focus,.projects-page .form-select:focus{background-color:var(--pj-field);color:var(--pj-text);border-color:#4098ff;box-shadow:0 0 0 .2rem rgba(59,130,246,.14)}



.projects-page .form-select option{background:var(--pj-field);color:var(--pj-text)}



.projects-page .pj-suggest-wrap{position:relative}
.projects-page .pj-suggest-input{padding-right:52px}
.projects-page .pj-suggest-toggle{position:absolute;right:3px;top:3px;bottom:3px;width:44px;background:transparent;color:var(--pj-text);border:0;border-radius:9px;display:grid;place-items:center}
.projects-page .pj-suggest-toggle:hover,.projects-page .pj-suggest-toggle:focus-visible{background:var(--pj-chip);outline-offset:-3px}
.projects-page .pj-suggest-menu{position:absolute;z-index:40;top:calc(100% + 5px);left:0;right:0;max-height:250px;overflow-y:auto;background:var(--pj-card);border:1px solid var(--pj-border);border-radius:12px;box-shadow:0 14px 35px rgba(0,0,0,.2);padding:5px}
.projects-page .pj-suggest-option{display:block;width:100%;border:0;background:transparent;color:var(--pj-text);text-align:left;padding:11px 12px;border-radius:8px;overflow-wrap:anywhere}
.projects-page .pj-suggest-option:hover,.projects-page .pj-suggest-option:focus-visible{background:var(--pj-chip);color:var(--pj-chip-text)}
.projects-page .pj-suggest-empty{padding:10px 12px;color:var(--pj-muted);font-size:13px}

.projects-page .pj-search-btn{background:linear-gradient(115deg,#1479ec,#329dff);color:#fff;border:0;border-radius:11px;padding:11px 24px;font-weight:700}



.projects-page .pj-reset-btn{border:1px solid var(--pj-border);color:var(--pj-text);border-radius:11px;padding:10px 20px;text-decoration:none;font-weight:650}



.projects-page .pj-reset-btn:hover{background:var(--pj-chip);color:var(--pj-link)}



.projects-page .pj-card{overflow:hidden;height:100%;display:flex;flex-direction:column;transition:transform .25s,border-color .25s,box-shadow .25s}



.projects-page .pj-card:hover{transform:translateY(-7px);border-color:#348ff6;box-shadow:0 20px 50px rgba(0,90,200,.13)}



.projects-page .pj-image-link{display:block;overflow:hidden}



.projects-page .pj-image{width:100%;height:225px;object-fit:cover;display:block;background:var(--pj-chip);transition:transform .35s}



.projects-page .pj-card:hover .pj-image{transform:scale(1.045)}



.projects-page .pj-image-fallback{height:225px;display:grid;place-items:center;background:linear-gradient(135deg,#12375e,#2858a0);color:#dbeafe;font-size:50px}



.projects-page .pj-content{padding:26px;display:flex;flex-direction:column;flex:1}



.projects-page .pj-title{color:var(--pj-text)!important;font-size:20px;font-weight:800;margin-bottom:12px}



.projects-page .pj-desc{color:var(--pj-muted)!important;line-height:1.8;font-size:14px;flex-grow:1}



.projects-page .pj-chip{display:inline-block;background:var(--pj-chip);color:var(--pj-chip-text)!important;border:1px solid var(--pj-border);border-radius:30px;padding:6px 12px;font-size:12px;font-weight:650;margin:0 5px 8px 0}



.projects-page .pj-view{color:var(--pj-link)!important;font-weight:750;text-decoration:none;display:inline-flex;align-items:center;gap:8px}



.projects-page .pj-view:hover{text-decoration:underline}



.projects-page .pj-meta{color:var(--pj-muted);font-size:14px}



.projects-page .pj-empty{background:var(--pj-card);border:1px dashed var(--pj-border);border-radius:20px;padding:65px 20px;text-align:center;color:var(--pj-muted)}



.projects-page .pagination .page-link{background:var(--pj-card);color:var(--pj-text);border-color:var(--pj-border)}



.projects-page .pagination .page-link:hover{background:var(--pj-chip);color:var(--pj-chip-text)}



.projects-page .pagination .page-item.active .page-link{background:#2588f7;color:#fff;border-color:#2588f7}



.projects-page .pagination .page-item.disabled .page-link{background:var(--pj-card);color:var(--pj-muted);opacity:.6}



@media(max-width:767.98px){.projects-page{padding:45px 0 65px}.projects-page .pj-panel{padding:18px}.projects-page .pj-image,.projects-page .pj-image-fallback{height:195px}}



@media(prefers-reduced-motion:reduce){.projects-page .pj-card,.projects-page .pj-image{transition:none}.projects-page .pj-card:hover{transform:none}}



</style>



@endpush







@section('content')



<section class="projects-page">



    <div class="container">



        <header class="text-center">



            <h1 class="pj-heading">{{ app()->getLocale() === 'en' ? 'My Projects' : 'Dự án của tôi' }}</h1>



            <p class="pj-intro">{{ app()->getLocale() === 'en' ? 'Projects I have built while learning, developing skills, and exploring technology.' : 'Những sản phẩm và dự án tôi đã thực hiện trong quá trình học tập, rèn luyện kỹ năng và khám phá công nghệ.' }}</p>



        </header>







        <form action="{{ route('projects') }}" method="GET" class="pj-panel" role="search">



            <div class="row g-3 align-items-end">



                <div class="col-lg-5">



                    <label for="project-search" class="form-label">{{ app()->getLocale() === 'en' ? 'Search projects' : 'Tìm kiếm dự án' }}</label>



                    @php
                        // Fetch all project titles, including projects outside the current pagination page.
                        $suggestedProjects = \App\Models\Project::query()->orderBy('title')->get(['id', 'title', 'title_en']);
                    @endphp
                    <div class="pj-suggest-wrap" id="pjSuggestWrap">
                        <input id="project-search" class="form-control pj-suggest-input" type="search" name="search"
                               value="{{ $search ?? request('search') }}"
                               placeholder="{{ app()->getLocale() === 'en' ? 'Enter or select project...' : 'Nhập hoặc chọn tên dự án...' }}"
                               autocomplete="off" aria-autocomplete="list" aria-controls="pjSuggestMenu" aria-expanded="false">
                        <button class="pj-suggest-toggle" type="button" id="pjSuggestToggle" aria-label="{{ app()->getLocale() === 'en' ? 'Show project suggestions' : 'Hiển thị danh sách dự án' }}" aria-controls="pjSuggestMenu" aria-expanded="false">
                            <i class="bi bi-chevron-down" aria-hidden="true"></i>
                        </button>
                        <div id="pjSuggestMenu" class="pj-suggest-menu" role="listbox" hidden>
                            @foreach($suggestedProjects as $suggestedProject)
                                <button type="button" role="option" class="pj-suggest-option"
                                        data-project-name="{{ $suggestedProject->translated('title') }}">{{ $suggestedProject->translated('title') }}</button>
                            @endforeach
                            <div id="pjSuggestEmpty" class="pj-suggest-empty" hidden>{{ app()->getLocale() === 'en' ? 'No matching projects' : 'Không có dự án phù hợp' }}</div>
                        </div>
                    </div>



                </div>



                <div class="col-lg-4">



                    <label for="project-technology" class="form-label">{{ app()->getLocale() === 'en' ? 'Technology' : 'Công nghệ' }}</label>



                    <select id="project-technology" name="technology" class="form-select">



                        <option value="">{{ app()->getLocale() === 'en' ? 'All technologies' : 'Tất cả công nghệ' }}</option>



                        @foreach(($technologies ?? []) as $tech)



                            <option value="{{ $tech }}" @selected((string)($technology ?? request('technology')) === (string)$tech)>{{ $tech }}</option>



                        @endforeach



                    </select>



                </div>



                <div class="col-lg-3">



                    <label for="project-sort" class="form-label">{{ app()->getLocale() === 'en' ? 'Sort by' : 'Sắp xếp' }}</label>



                    <select id="project-sort" name="sort" class="form-select">



                        <option value="latest" @selected(($sort ?? request('sort', 'latest')) === 'latest')>{{ app()->getLocale() === 'en' ? 'Newest' : 'Mới nhất' }}</option>



                        <option value="oldest" @selected(($sort ?? request('sort')) === 'oldest')>{{ app()->getLocale() === 'en' ? 'Oldest' : 'Cũ nhất' }}</option>



                        <option value="name" @selected(($sort ?? request('sort')) === 'name')>{{ app()->getLocale() === 'en' ? 'Name A–Z' : 'Tên A–Z' }}</option>





                    </select>



                </div>



                <div class="col-12 d-flex gap-2 flex-wrap mt-4">



                    <button type="submit" class="pj-search-btn"><i class="bi bi-search me-2"></i>{{ app()->getLocale() === 'en' ? 'Search' : 'Tìm kiếm' }}</button>



                    <a href="{{ route('projects') }}" class="pj-reset-btn"><i class="bi bi-arrow-counterclockwise me-1"></i>{{ app()->getLocale() === 'en' ? 'Clear filters' : 'Xóa bộ lọc' }}</a>



                </div>



            </div>



        </form>







        @if($projects->count())



            <p class="pj-meta mb-3"><i class="bi bi-grid-3x3-gap me-1"></i> {{ app()->getLocale() === 'en' ? 'Showing ' . $projects->count() . ' projects on this page' : 'Hiển thị ' . $projects->count() . ' dự án trên trang này' }}</p>



            <div class="row g-4">



                @foreach($projects as $project)



                    <div class="col-md-6 col-xl-4">



                        <article class="pj-card">



                            <a class="pj-image-link" href="{{ route('projects.show', $project) }}" aria-label="{{ (app()->getLocale() === 'en' ? 'View project ' : 'Xem dự án ') . $project->translated('title') }}">



                                @if($project->image)



                                    <img class="pj-image" src="{{ asset('uploads/' . $project->image) }}" alt="{{ (app()->getLocale() === 'en' ? 'Project image: ' : 'Ảnh dự án ') . $project->translated('title') }}" loading="lazy" decoding="async">



                                @else



                                    <div class="pj-image-fallback" aria-hidden="true"><i class="bi bi-code-square"></i></div>



                                @endif



                            </a>



                            <div class="pj-content">



                                <h2 class="pj-title">{{ $project->translated('title') }}</h2>



                                <p class="pj-desc">{{ \Illuminate\Support\Str::limit(strip_tags($project->translated('description') ?? ''), 145) }}</p>



                                @if($project->technologies)



                                    <div class="mb-3">



                                        @foreach(preg_split('/[,;\r\n]+/', $project->technologies) as $tech)



                                            @if(trim($tech) !== '')



                                                <span class="pj-chip">{{ trim($tech) }}</span>



                                            @endif



                                        @endforeach



                                    </div>



                                @endif



                                <a class="pj-view mt-auto" href="{{ route('projects.show', $project) }}">{{ app()->getLocale() === 'en' ? 'View details' : 'Xem chi tiết' }} <i class="bi bi-arrow-up-right"></i></a>



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



                <h2 class="h5 fw-bold" style="color:var(--pj-text)">{{ app()->getLocale() === 'en' ? 'No projects found' : 'Chưa tìm thấy dự án' }}</h2>



                <p>{{ app()->getLocale() === 'en' ? 'Try another keyword or filter.' : 'Hãy thử từ khóa hoặc bộ lọc khác.' }}</p>



                <a href="{{ route('projects') }}" class="pj-search-btn d-inline-block text-decoration-none">{{ app()->getLocale() === 'en' ? 'View all projects' : 'Xem tất cả dự án' }}</a>



            </div>



        @endif



    </div>



</section>



@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const wrap = document.getElementById('pjSuggestWrap');
    const input = document.getElementById('project-search');
    const toggle = document.getElementById('pjSuggestToggle');
    const menu = document.getElementById('pjSuggestMenu');
    const empty = document.getElementById('pjSuggestEmpty');
    if (!wrap || !input || !toggle || !menu) return;
    const options = Array.from(menu.querySelectorAll('.pj-suggest-option'));
    const normalize = value => value.toLocaleLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/đ/g, 'd').trim();
    function closeMenu() {
        menu.hidden = true;
        input.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-expanded', 'false');
    }
    function showMenu(filter = '') {
        const q = normalize(filter);
        let shown = 0;
        options.forEach(option => {
            const matches = normalize(option.dataset.projectName || '').includes(q);
            option.hidden = !matches;
            if (matches) shown++;
        });
        if (empty) empty.hidden = shown !== 0;
        menu.hidden = false;
        input.setAttribute('aria-expanded', 'true');
        toggle.setAttribute('aria-expanded', 'true');
    }
    toggle.addEventListener('click', () => menu.hidden ? showMenu('') : closeMenu());
    input.addEventListener('input', () => showMenu(input.value));
    input.addEventListener('keydown', event => {
        if (event.key === 'Escape') closeMenu();
        if (event.key === 'ArrowDown') {
            event.preventDefault();
            showMenu(input.value);
            const first = options.find(option => !option.hidden);
            if (first) first.focus();
        }
    });
    menu.addEventListener('keydown', event => {
        if (event.key === 'Escape') { closeMenu(); input.focus(); }
    });
    options.forEach(option => option.addEventListener('click', () => {
        input.value = option.dataset.projectName || '';
        closeMenu();
        input.focus();
    }));
    document.addEventListener('click', event => { if (!wrap.contains(event.target)) closeMenu(); });
});
</script>
@endpush
