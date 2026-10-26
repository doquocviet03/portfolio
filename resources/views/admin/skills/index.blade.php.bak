

@extends('layouts.admin')



@section('title', 'Quản lý kỹ năng')

@section('page_title', 'Quản lý kỹ năng')



@push('styles')

<style>

.skills-admin {

    --sk-surface: #fff;

    --sk-text: #0f172a;

    --sk-muted: #64748b;

    --sk-border: #e2e8f0;

    --sk-soft: #f8fafc;

    --sk-accent: #2563eb;

    color: var(--sk-text);

}



html[data-theme="dark"] .skills-admin,

html[data-bs-theme="dark"] .skills-admin {

    --sk-surface: #17243a;

    --sk-text: #f1f5f9;

    --sk-muted: #b9c8da;

    --sk-border: #33455e;

    --sk-soft: #1e2e46;

    --sk-accent: #93c5fd;

}



.skills-admin .sk-heading {

    font-weight: 800;

    color: var(--sk-text);

}



.skills-admin .sk-muted {

    color: var(--sk-muted) !important;

}



.skills-admin .sk-panel {

    background: var(--sk-surface);

    border: 1px solid var(--sk-border);

    border-radius: 18px;

    overflow: hidden;

    box-shadow: 0 8px 30px rgba(15, 23, 42, .04);

}



.skills-admin .sk-stat {

    padding: 19px 22px;

    display: flex;

    align-items: center;

    gap: 14px;

}



.skills-admin .sk-stat-icon {

    width: 48px;

    height: 48px;

    border-radius: 13px;

    display: grid;

    place-items: center;

    font-size: 22px;

    background: var(--sk-soft);

    color: var(--sk-accent);

}



.skills-admin .sk-stat-number {

    font-size: 25px;

    font-weight: 800;

    color: var(--sk-text);

}



.skills-admin .sk-filters {

    display: flex;

    flex-wrap: wrap;

    gap: 9px;

}



.skills-admin .sk-filter {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    text-decoration: none;

    padding: 10px 16px;

    border: 1px solid var(--sk-border);

    border-radius: 11px;

    color: var(--sk-text);

    background: var(--sk-surface);

    font-weight: 650;

}



.skills-admin .sk-filter:hover {

    border-color: #60a5fa;

    color: var(--sk-accent);

}



.skills-admin .sk-filter.active {

    background: #2563eb;

    border-color: #2563eb;

    color: #fff;

}



.skills-admin .sk-table {

    --bs-table-bg: transparent;

    --bs-table-color: var(--sk-text);

    margin: 0;

}



.skills-admin .sk-table th {

    color: var(--sk-muted);

    font-size: 12px;

    letter-spacing: .03em;

    text-transform: uppercase;

    font-weight: 700;

    white-space: nowrap;

    border-color: var(--sk-border);

    padding: 16px;

}



.skills-admin .sk-table td {

    color: var(--sk-text);

    border-color: var(--sk-border);

    padding: 16px;

    vertical-align: middle;

}



.skills-admin .sk-table tbody tr:last-child td {

    border-bottom: 0;

}



.skills-admin .sk-icon {

    width: 48px;

    height: 48px;

    flex: 0 0 48px;

    display: grid;

    place-items: center;

    border-radius: 12px;

    background: var(--sk-soft);

    color: var(--sk-accent);

    font-size: 22px;

    overflow: hidden;

}



.skills-admin .sk-icon img {

    width: 100%;

    height: 100%;

    object-fit: contain;

    padding: 5px;

}



.skills-admin .sk-name {

    font-weight: 750;

    color: var(--sk-text);

}



.skills-admin .sk-desc {

    color: var(--sk-muted);

    font-size: 13px;

    line-height: 1.5;

    max-width: 370px;

}



.skills-admin .sk-type {

    display: inline-block;

    border-radius: 30px;

    padding: 6px 11px;

    font-size: 12px;

    font-weight: 700;

    background: rgba(37, 99, 235, .1);

    color: var(--sk-accent);

}



.skills-admin .sk-type.personal {

    background: rgba(16, 185, 129, .12);

    color: #059669;

}



.skills-admin .sk-progress {

    height: 8px;

    min-width: 90px;

    border-radius: 99px;

    background: var(--sk-soft);

    overflow: hidden;

    border: 1px solid var(--sk-border);

}



.skills-admin .sk-progress-fill {

    height: 100%;

    background: linear-gradient(90deg, #2563eb, #38bdf8);

}



.skills-admin .sk-action {

    border-radius: 9px;

    font-weight: 650;

}



.skills-admin .sk-empty {

    padding: 55px 20px;

    text-align: center;

    color: var(--sk-muted);

}



.skills-admin .sk-pagination {

    padding: 18px;

    border-top: 1px solid var(--sk-border);

}



.skills-admin .sk-pagination nav {

    overflow-x: auto;

}



/* Bootstrap 5 pagination scoped to this page */
.skills-admin .sk-pagination .pagination {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 6px;
    margin: 0;
    padding: 0;
    list-style: none;
}
.skills-admin .sk-pagination .page-link {
    background: var(--sk-surface);
    border: 1px solid var(--sk-border);
    color: var(--sk-text);
    border-radius: 9px;
    padding: 8px 12px;
    box-shadow: none;
}
.skills-admin .sk-pagination .page-link:hover {
    color: var(--sk-accent);
    border-color: var(--sk-accent);
}
.skills-admin .sk-pagination .page-item.active .page-link {
    background: #2563eb;
    border-color: #2563eb;
    color: #fff;
}
.skills-admin .sk-pagination .page-item.disabled .page-link {
    opacity: .45;
    pointer-events: none;
}
.skills-admin .sk-pagination svg {
    width: 16px;
    height: 16px;
}

@media (max-width: 575.98px) {

    .skills-admin .sk-table th,

    .skills-admin .sk-table td {

        padding: 12px;

    }

}

</style>

@endpush



@section('content')

@php

    $activeType = $type ?? request('type');



    $activeType = in_array(

        $activeType,

        ['programming', 'personal'],

        true

    ) ? $activeType : null;

@endphp



<div class="skills-admin container-fluid px-0">



    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>

            <h1 class="sk-heading h3 mb-1">

                Quản lý kỹ năng

            </h1>

            <p class="sk-muted mb-0">

                Thêm, chỉnh sửa và quản lý kỹ năng hiển thị trên Portfolio.

            </p>

        </div>



        <a href="{{ route('admin.skills.create') }}"

           class="btn btn-primary rounded-3 px-3 py-2 fw-semibold">

            <i class="bi bi-plus-lg me-1"></i>

            Thêm kỹ năng

        </a>

    </div>



    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"

             role="alert">

            {{ session('success') }}

            <button type="button"

                    class="btn-close"

                    data-bs-dismiss="alert"

                    aria-label="Đóng"></button>

        </div>

    @endif



    <div class="row g-3 mb-4">

        <div class="col-md-6">

            <div class="sk-panel sk-stat">

                <div class="sk-stat-icon">

                    <i class="bi bi-grid-3x3-gap"></i>

                </div>

                <div>

                    <div class="sk-muted small">

                        {{ $activeType ? 'Tổng số kỹ năng theo bộ lọc' : 'Tổng số kỹ năng' }}

                    </div>

                    <div class="sk-stat-number">

                        {{ $skills->total() }}

                    </div>

                </div>

            </div>

        </div>



        <div class="col-md-6">

            <div class="sk-panel sk-stat">

                <div class="sk-stat-icon">

                    <i class="bi bi-list-check"></i>

                </div>

                <div>

                    <div class="sk-muted small">

                        Hiển thị trên trang này

                    </div>

                    <div class="sk-stat-number">

                        {{ $skills->count() }}

                    </div>

                </div>

            </div>

        </div>

    </div>



    <nav class="sk-filters mb-4"

         aria-label="Lọc loại kỹ năng">



        <a href="{{ route('admin.skills.index') }}"

           class="sk-filter {{ !$activeType ? 'active' : '' }}"

           @if(!$activeType) aria-current="page" @endif>

            <i class="bi bi-grid"></i>

            Tất cả

        </a>



        <a href="{{ route('admin.skills.index', ['type' => 'programming']) }}"

           class="sk-filter {{ $activeType === 'programming' ? 'active' : '' }}"

           @if($activeType === 'programming') aria-current="page" @endif>

            <i class="bi bi-code-slash"></i>

            Kỹ năng lập trình

        </a>



        <a href="{{ route('admin.skills.index', ['type' => 'personal']) }}"

           class="sk-filter {{ $activeType === 'personal' ? 'active' : '' }}"

           @if($activeType === 'personal') aria-current="page" @endif>

            <i class="bi bi-people"></i>

            Kỹ năng cá nhân

        </a>

    </nav>



    <section class="sk-panel">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 px-3 px-md-4 py-3">

            <h2 class="sk-heading h5 mb-0">

                Danh sách kỹ năng

            </h2>

            <span class="sk-muted small">

                Trang {{ $skills->currentPage() }}

                /

                {{ max(1, $skills->lastPage()) }}

            </span>

        </div>



        @if($skills->count())

            <div class="table-responsive">

                <table class="table sk-table align-middle">

                    <thead>

                        <tr>

                            <th scope="col">Kỹ năng</th>

                            <th scope="col">Loại</th>

                            <th scope="col">Mức độ</th>

                            <th scope="col">Thứ tự</th>

                            <th scope="col" class="text-end">Thao tác</th>

                        </tr>

                    </thead>



                    <tbody>

                        @foreach($skills as $skill)

                            @php

                                $isPersonal = $skill->type === 'personal';



                                $hasLevel = !$isPersonal

                                    && $skill->level !== null

                                    && is_numeric($skill->level);



                                $level = $hasLevel

                                    ? max(0, min(100, (int) $skill->level))

                                    : null;



                                $iconPath = $skill->icon;



                                $hasUploadedIcon = filled($iconPath)

                                    && str_starts_with($iconPath, 'skills/');

                            @endphp



                            <tr>

                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <span class="sk-icon">

                                            @if($hasUploadedIcon)

                                                <img

                                                    src="{{ asset('storage/' . $iconPath) }}"

                                                    alt="Logo {{ $skill->name }}"

                                                    loading="lazy">

                                            @else

                                                <i class="bi {{ $isPersonal ? 'bi-person-check' : 'bi-code-square' }}"

                                                   aria-hidden="true"></i>

                                            @endif

                                        </span>



                                        <div>

                                            <div class="sk-name">

                                                {{ $skill->name }}

                                            </div>



                                            @if(filled($skill->description))

                                                <div class="sk-desc mt-1">

                                                    {{ \Illuminate\Support\Str::limit($skill->description, 105) }}

                                                </div>

                                            @endif



                                            <div class="sk-muted small mt-1">

                                                #{{ $skill->id }}

                                            </div>

                                        </div>

                                    </div>

                                </td>



                                <td>

                                    <span class="sk-type {{ $isPersonal ? 'personal' : '' }}">

                                        {{ $isPersonal ? 'Cá nhân' : 'Lập trình' }}

                                    </span>

                                </td>



                                <td>

                                    @if($hasLevel)

                                        <div class="d-flex align-items-center gap-2">

                                            <div class="sk-progress flex-grow-1"

                                                 role="progressbar"

                                                 aria-label="Mức độ {{ $skill->name }}"

                                                 aria-valuenow="{{ $level }}"

                                                 aria-valuemin="0"

                                                 aria-valuemax="100">

                                                <div class="sk-progress-fill"

                                                     style="width: {{ $level }}%"></div>

                                            </div>



                                            <span class="small fw-semibold">

                                                {{ $level }}%

                                            </span>

                                        </div>

                                    @else

                                        <span class="sk-muted small">

                                            Không áp dụng

                                        </span>

                                    @endif

                                </td>



                                <td>

                                    <span class="sk-muted fw-semibold">

                                        {{ $skill->sort_order ?? 0 }}

                                    </span>

                                </td>



                                <td>

                                    <div class="d-flex justify-content-end flex-wrap gap-2">

                                        <a href="{{ route('admin.skills.edit', $skill) }}"

                                           class="btn btn-sm btn-outline-primary sk-action">

                                            <i class="bi bi-pencil-square me-1"></i>

                                            Sửa

                                        </a>



                                        <form

                                            action="{{ route('admin.skills.destroy', $skill) }}"

                                            method="POST"

                                            class="d-inline"

                                            onsubmit="return confirm('Bạn có chắc muốn xóa kỹ năng này?')">



                                            @csrf

                                            @method('DELETE')



                                            <button type="submit"

                                                    class="btn btn-sm btn-outline-danger sk-action">

                                                <i class="bi bi-trash3 me-1"></i>

                                                Xóa

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="sk-empty">

                <i class="bi bi-folder-x display-5 d-block mb-3"></i>



                <h3 class="sk-heading h5">

                    Chưa có kỹ năng phù hợp

                </h3>



                <p class="sk-muted">

                    Hãy thêm kỹ năng mới hoặc chọn bộ lọc khác.

                </p>



                <a href="{{ route('admin.skills.create') }}"

                   class="btn btn-primary">

                    Thêm kỹ năng

                </a>

            </div>

        @endif



        @if($skills->hasPages())

            <div class="sk-pagination">

                {{ $skills->withQueryString()->links('pagination::bootstrap-5') }}

            </div>

        @endif

    </section>

</div>

@endsection
