@extends('layouts.admin')

@section('title', 'Quản lý kỹ năng')
@section('page_title', 'Quản lý kỹ năng')

@push('styles')
<style>
.skills-admin {
    --sk-surface: #ffffff;
    --sk-text: #0f172a;
    --sk-muted: #64748b;
    --sk-border: #e2e8f0;
    --sk-soft: #f8fafc;
}
html[data-bs-theme="dark"] .skills-admin,
html[data-theme="dark"] .skills-admin {
    --sk-surface: #17243a;
    --sk-text: #f1f5f9;
    --sk-muted: #b9c8da;
    --sk-border: #33455e;
    --sk-soft: #1e2e46;
}
.skills-admin .sk-heading { color: var(--sk-text); font-weight: 800; }
.skills-admin .sk-muted { color: var(--sk-muted) !important; }
.skills-admin .sk-panel {
    background: var(--sk-surface);
    border: 1px solid var(--sk-border);
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(15,23,42,.05);
}
.skills-admin .sk-stat {
    display: flex; align-items: center; gap: 15px;
    padding: 19px 22px; min-height: 95px;
}
.skills-admin .sk-stat-icon {
    width: 49px; height: 49px; flex: 0 0 49px;
    display: grid; place-items: center; border-radius: 14px;
    font-size: 23px;
}
.skills-admin .sk-stat-number {
    color: var(--sk-text); font-size: 26px; line-height: 1.2; font-weight: 800;
}
.skills-admin .sk-table {
    --bs-table-bg: transparent;
    --bs-table-color: var(--sk-text);
    margin-bottom: 0;
}
.skills-admin .sk-table th {
    color: var(--sk-muted); font-size: 13px;
    font-weight: 700; white-space: nowrap;
    border-bottom-color: var(--sk-border); padding: 16px;
}
.skills-admin .sk-table td {
    color: var(--sk-text); border-bottom-color: var(--sk-border);
    padding: 17px 16px; vertical-align: middle;
}
.skills-admin .sk-table tbody tr:last-child td { border-bottom: 0; }
.skills-admin .sk-id {
    font-size: 13px; font-weight: 700; color: var(--sk-muted);
    background: var(--sk-soft); border: 1px solid var(--sk-border);
    border-radius: 8px; padding: 5px 9px;
}
.skills-admin .sk-skill-icon {
    width: 40px; height: 40px; border-radius: 11px;
    background: var(--sk-soft); color: #60a5fa;
    display: grid; place-items: center; flex-shrink: 0;
}
.skills-admin .sk-progress {
    height: 9px; border-radius: 100px; background: var(--sk-soft);
    border: 1px solid var(--sk-border); overflow: hidden;
}
.skills-admin .sk-progress-fill {
    background: linear-gradient(90deg,#2563eb,#38bdf8);
    height: 100%; border-radius: 100px;
}
.skills-admin .sk-action {
    border-radius: 9px; padding: 7px 12px; font-weight: 600;
}
.skills-admin .sk-empty {
    text-align: center; padding: 60px 20px; color: var(--sk-muted);
}
.skills-admin .sk-empty-icon {
    width: 70px; height: 70px; border-radius: 18px;
    display: grid; place-items: center; margin: 0 auto 16px;
    background: var(--sk-soft); color: #60a5fa; font-size: 32px;
}
.skills-admin .sk-pagination { padding: 18px 22px; border-top: 1px solid var(--sk-border); }
.skills-admin .sk-pagination nav { overflow-x: auto; }
.skills-admin .sk-panel-title { color: var(--sk-text); font-size: 17px; font-weight: 800; }
@media (max-width: 575.98px) {
    .skills-admin .sk-table th, .skills-admin .sk-table td { padding: 12px; }
    .skills-admin .sk-stat { padding: 16px; }
}
</style>
@endpush

@section('content')
<div class="skills-admin container-fluid px-0">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="sk-heading h3 mb-1">Quản lý kỹ năng</h1>
            <p class="sk-muted mb-0">Theo dõi và cập nhật kỹ năng hiển thị trên Portfolio.</p>
        </div>
        <a href="{{ route('admin.skills.create') }}" class="btn btn-primary rounded-3 px-3 py-2 fw-semibold">
            <i class="bi bi-plus-lg me-1"></i> Thêm kỹ năng
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-sm-6">
            <div class="sk-panel sk-stat">
                <div class="sk-stat-icon bg-primary-subtle text-primary"><i class="bi bi-code-slash"></i></div>
                <div>
                    <div class="sk-muted small mb-1">Tổng số kỹ năng</div>
                    <div class="sk-stat-number">{{ $skills->total() }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="sk-panel sk-stat">
                <div class="sk-stat-icon bg-success-subtle text-success"><i class="bi bi-list-check"></i></div>
                <div>
                    <div class="sk-muted small mb-1">Hiển thị trên trang này</div>
                    <div class="sk-stat-number">{{ $skills->count() }}</div>
                </div>
            </div>
        </div>
    </div>

    <section class="sk-panel overflow-hidden">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 px-3 px-md-4 pt-4 pb-3">
            <h2 class="sk-panel-title mb-0">Danh sách kỹ năng</h2>
            <span class="sk-muted small">Trang {{ $skills->currentPage() }} / {{ max(1, $skills->lastPage()) }}</span>
        </div>

        @if($skills->count())
            <div class="table-responsive">
                <table class="table sk-table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên kỹ năng</th>
                            <th scope="col" style="min-width: 200px;">Mức độ</th>
                            <th scope="col" class="text-end">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($skills as $skill)
                            @php
                                $skillLevel = max(0, min(100, (int) $skill->level));
                            @endphp
                            <tr>
                                <td><span class="sk-id">#{{ $skill->id }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="sk-skill-icon"><i class="bi bi-braces"></i></span>
                                        <span class="fw-semibold">{{ $skill->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="sk-progress flex-grow-1" role="progressbar"
                                             aria-label="Mức độ {{ $skill->name }}"
                                             aria-valuenow="{{ $skillLevel }}" aria-valuemin="0" aria-valuemax="100">
                                            <div class="sk-progress-fill" style="width: {{ $skillLevel }}%"></div>
                                        </div>
                                        <span class="fw-semibold small" style="min-width: 40px;">{{ $skillLevel }}%</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap justify-content-end gap-2">
                                        <a href="{{ route('admin.skills.edit', $skill) }}"
                                           class="btn btn-sm btn-outline-primary sk-action">
                                            <i class="bi bi-pencil-square me-1"></i> Sửa
                                        </a>
                                        <form action="{{ route('admin.skills.destroy', $skill) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Bạn có chắc muốn xóa kỹ năng này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger sk-action">
                                                <i class="bi bi-trash3 me-1"></i> Xóa
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
                <div class="sk-empty-icon"><i class="bi bi-code-square"></i></div>
                <h3 class="sk-heading h5">Chưa có kỹ năng nào</h3>
                <p class="sk-muted mb-3">Thêm kỹ năng đầu tiên để hiển thị trên Portfolio.</p>
                <a href="{{ route('admin.skills.create') }}" class="btn btn-primary rounded-3">
                    <i class="bi bi-plus-lg me-1"></i> Thêm kỹ năng
                </a>
            </div>
        @endif

        @if($skills->hasPages())
            <div class="sk-pagination">
                {{ $skills->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
