@extends('layouts.admin')

@section('title', 'Quản lý kinh nghiệm')
@section('page_title', 'Quản lý kinh nghiệm')

@push('styles')
<style>
.experience-admin {
    --exp-surface: #fff;
    --exp-text: #0f172a;
    --exp-muted: #64748b;
    --exp-border: #e2e8f0;
    --exp-soft: #f8fafc;
}
html[data-bs-theme="dark"] .experience-admin,
html[data-theme="dark"] .experience-admin {
    --exp-surface: #17243a;
    --exp-text: #f1f5f9;
    --exp-muted: #b8c6d8;
    --exp-border: #33455e;
    --exp-soft: #1e2e46;
}
.experience-admin .exp-title { color: var(--exp-text); font-weight: 800; }
.experience-admin .exp-muted { color: var(--exp-muted) !important; }
.experience-admin .exp-card {
    background: var(--exp-surface);
    border: 1px solid var(--exp-border);
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(15,23,42,.05);
}
.experience-admin .exp-stat {
    display: flex; align-items: center; gap: 15px;
    padding: 20px 24px; min-height: 96px;
}
.experience-admin .exp-stat-icon {
    display: grid; place-items: center;
    width: 52px; height: 52px; border-radius: 15px;
    font-size: 23px; flex-shrink: 0;
}
.experience-admin .exp-stat-number {
    color: var(--exp-text); font-weight: 800;
    font-size: 28px; line-height: 1.2;
}
.experience-admin .exp-table {
    --bs-table-bg: transparent;
    --bs-table-color: var(--exp-text);
    margin-bottom: 0;
}
.experience-admin .exp-table th {
    color: var(--exp-muted); font-size: 13px;
    font-weight: 700; white-space: nowrap;
    padding: 16px; border-bottom-color: var(--exp-border);
}
.experience-admin .exp-table td {
    color: var(--exp-text); padding: 17px 16px;
    vertical-align: middle; border-bottom-color: var(--exp-border);
}
.experience-admin .exp-table tbody tr:last-child td { border-bottom: 0; }
.experience-admin .exp-id {
    display: inline-block; font-size: 13px; font-weight: 700;
    color: var(--exp-muted); background: var(--exp-soft);
    border: 1px solid var(--exp-border); border-radius: 8px;
    padding: 5px 9px;
}
.experience-admin .exp-role-icon {
    display: grid; place-items: center;
    width: 42px; height: 42px; flex-shrink: 0;
    border-radius: 12px; background: var(--exp-soft);
    color: #60a5fa; font-size: 19px;
}
.experience-admin .exp-role { font-weight: 700; color: var(--exp-text); }
.experience-admin .exp-now {
    color: #047857; background: #d1fae5;
    padding: 6px 10px; border-radius: 999px;
    font-size: 12px; font-weight: 750; white-space: nowrap;
}
html[data-bs-theme="dark"] .experience-admin .exp-now,
html[data-theme="dark"] .experience-admin .exp-now {
    color: #a7f3d0; background: #064e3b;
}
.experience-admin .exp-actions { display: flex; justify-content: flex-end; flex-wrap: wrap; gap: 8px; }
.experience-admin .exp-actions .btn { border-radius: 9px; font-weight: 600; padding: 7px 12px; }
.experience-admin .exp-empty { text-align: center; padding: 56px 20px; color: var(--exp-muted); }
.experience-admin .exp-empty-icon {
    width: 72px; height: 72px; margin: 0 auto 16px;
    display: grid; place-items: center;
    border-radius: 20px; background: var(--exp-soft);
    color: #60a5fa; font-size: 30px;
}
.experience-admin .exp-pagination { border-top: 1px solid var(--exp-border); padding: 18px 22px; }
.experience-admin .exp-pagination nav { overflow-x: auto; }
@media (max-width: 575.98px) {
    .experience-admin .exp-table th, .experience-admin .exp-table td { padding: 12px; }
    .experience-admin .exp-stat { padding: 16px; }
}
</style>
@endpush

@section('content')
<div class="experience-admin container-fluid px-0">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="exp-title h3 mb-1">Quản lý kinh nghiệm</h1>
            <p class="exp-muted mb-0">Theo dõi quá trình học tập và làm việc trên Portfolio.</p>
        </div>
        <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary rounded-3 fw-semibold px-3 py-2">
            <i class="bi bi-plus-lg me-1"></i> Thêm kinh nghiệm
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
            <div class="exp-card exp-stat">
                <span class="exp-stat-icon bg-primary-subtle text-primary"><i class="bi bi-briefcase"></i></span>
                <div>
                    <div class="exp-muted small mb-1">Tổng kinh nghiệm</div>
                    <div class="exp-stat-number">{{ $experiences->total() }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="exp-card exp-stat">
                <span class="exp-stat-icon bg-success-subtle text-success"><i class="bi bi-list-check"></i></span>
                <div>
                    <div class="exp-muted small mb-1">Hiển thị trên trang</div>
                    <div class="exp-stat-number">{{ $experiences->count() }}</div>
                </div>
            </div>
        </div>
    </div>

    <section class="exp-card overflow-hidden">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 px-3 px-md-4 pt-4 pb-3">
            <h2 class="exp-title h5 mb-0">Danh sách kinh nghiệm</h2>
            <span class="exp-muted small">Trang {{ $experiences->currentPage() }} / {{ max(1, $experiences->lastPage()) }}</span>
        </div>

        @if($experiences->count())
            <div class="table-responsive">
                <table class="table exp-table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Vị trí</th>
                            <th scope="col">Công ty / Trường</th>
                            <th scope="col">Bắt đầu</th>
                            <th scope="col">Kết thúc</th>
                            <th scope="col" class="text-end">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($experiences as $experience)
                            <tr>
                                <td><span class="exp-id">#{{ $experience->id }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="exp-role-icon"><i class="bi bi-briefcase"></i></span>
                                        <span class="exp-role">{{ $experience->title }}</span>
                                    </div>
                                </td>
                                <td>{{ $experience->company }}</td>
                                <td class="small">{{ $experience->start_date?->format('d/m/Y') ?? '—' }}</td>
                                <td>
                                    @if($experience->end_date)
                                        <span class="small">{{ $experience->end_date->format('d/m/Y') }}</span>
                                    @else
                                        <span class="exp-now"><i class="bi bi-circle-fill me-1" style="font-size: 7px;"></i>Hiện tại</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="exp-actions">
                                        <a href="{{ route('admin.experiences.edit', $experience) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil-square me-1"></i> Sửa
                                        </a>
                                        <form action="{{ route('admin.experiences.destroy', $experience) }}" method="POST"
                                              class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa kinh nghiệm này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
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
            <div class="exp-empty">
                <div class="exp-empty-icon"><i class="bi bi-briefcase"></i></div>
                <h3 class="exp-title h5">Chưa có kinh nghiệm nào</h3>
                <p class="exp-muted mb-3">Thêm thông tin học tập hoặc công việc đầu tiên.</p>
                <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary rounded-3">
                    <i class="bi bi-plus-lg me-1"></i> Thêm kinh nghiệm
                </a>
            </div>
        @endif

        @if($experiences->hasPages())
            <div class="exp-pagination">{{ $experiences->links() }}</div>
        @endif
    </section>

    <div class="mt-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Quay lại Dashboard
        </a>
    </div>
</div>
@endsection
