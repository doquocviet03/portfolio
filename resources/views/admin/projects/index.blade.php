@extends('layouts.admin')

@section('title', 'Quản lý dự án')
@section('page_title', 'Quản lý dự án')

@push('styles')
<style>
.admin-projects-page {
    --ap-surface: #ffffff;
    --ap-text: #0f172a;
    --ap-muted: #64748b;
    --ap-border: #e2e8f0;
    --ap-soft: #f8fafc;
    color: var(--ap-text);
}
html[data-theme="dark"] .admin-projects-page,
html[data-bs-theme="dark"] .admin-projects-page,
body.dark-mode .admin-projects-page {
    --ap-surface: #17243a;
    --ap-text: #f1f5f9;
    --ap-muted: #b6c5d8;
    --ap-border: #33455e;
    --ap-soft: #1d2e48;
}
.admin-projects-page .ap-heading { color: var(--ap-text); font-weight: 800; }
.admin-projects-page .ap-muted { color: var(--ap-muted) !important; }
.admin-projects-page .ap-card {
    background: var(--ap-surface);
    border: 1px solid var(--ap-border);
    border-radius: 20px;
    box-shadow: 0 8px 28px rgba(15, 23, 42, .05);
    overflow: hidden;
}
.admin-projects-page .ap-card-header {
    display: flex; align-items: center; justify-content: space-between;
    gap: 12px; flex-wrap: wrap; padding: 22px 24px;
    border-bottom: 1px solid var(--ap-border);
}
.admin-projects-page .ap-table {
    --bs-table-bg: transparent;
    --bs-table-color: var(--ap-text);
    --bs-table-border-color: var(--ap-border);
    margin: 0;
}
.admin-projects-page .ap-table th {
    color: var(--ap-muted); background: var(--ap-soft);
    font-size: 12px; font-weight: 750; letter-spacing: .04em;
    text-transform: uppercase; padding: 15px 18px; white-space: nowrap;
}
.admin-projects-page .ap-table td {
    color: var(--ap-text); padding: 17px 18px; vertical-align: middle;
}
.admin-projects-page .ap-table tbody tr:last-child td { border-bottom: 0; }
.admin-projects-page .ap-thumb {
    width: 78px; height: 56px; object-fit: cover;
    border-radius: 11px; background: var(--ap-soft);
    border: 1px solid var(--ap-border); display: block;
}
.admin-projects-page .ap-thumb-empty {
    display: grid; place-items: center;
    color: var(--ap-muted); font-size: 24px;
}
.admin-projects-page .ap-project-title {
    font-weight: 750; color: var(--ap-text);
    min-width: 150px; overflow-wrap: anywhere;
}
.admin-projects-page .ap-tech {
    display: inline-block; margin: 2px 5px 2px 0;
    padding: 5px 9px; border-radius: 8px;
    background: var(--ap-soft); border: 1px solid var(--ap-border);
    color: var(--ap-text); font-size: 12px; font-weight: 650;
}
.admin-projects-page .ap-btn-edit {
    background: var(--ap-soft); color: var(--ap-text);
    border: 1px solid var(--ap-border);
}
.admin-projects-page .ap-btn-edit:hover { color: #2563eb; border-color: #60a5fa; }
.admin-projects-page .ap-btn-delete {
    background: transparent; color: #dc2626;
    border: 1px solid #fca5a5;
}
.admin-projects-page .ap-btn-delete:hover { color: white; background: #b91c1c; border-color: #b91c1c; }
html[data-theme="dark"] .admin-projects-page .ap-btn-delete,
html[data-bs-theme="dark"] .admin-projects-page .ap-btn-delete,
body.dark-mode .admin-projects-page .ap-btn-delete { color: #fca5a5; border-color: #7f1d1d; }
html[data-theme="dark"] .admin-projects-page .ap-btn-delete:hover,
html[data-bs-theme="dark"] .admin-projects-page .ap-btn-delete:hover,
body.dark-mode .admin-projects-page .ap-btn-delete:hover { color: #fff; }
.admin-projects-page .ap-pagination { border-top: 1px solid var(--ap-border); padding: 18px 24px; }
.admin-projects-page .ap-pagination .pagination { margin-bottom: 0; }
.admin-projects-page .ap-pagination .page-link {
    background: var(--ap-surface); color: var(--ap-text); border-color: var(--ap-border);
}
.admin-projects-page .ap-pagination .active .page-link { background: #2563eb; border-color: #2563eb; color: white; }
.admin-projects-page .ap-pagination .disabled .page-link { color: var(--ap-muted); opacity: .6; }
@media (max-width: 767.98px) {
    .admin-projects-page .ap-card-header { padding: 18px; }
    .admin-projects-page .ap-table th, .admin-projects-page .ap-table td { padding: 12px; }
    .admin-projects-page .ap-pagination { padding: 16px; }
}
</style>
@endpush

@section('content')
<div class="admin-projects-page container-fluid px-0">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="ap-heading h3 mb-1">Quản lý dự án</h1>
            <p class="ap-muted mb-0">Xem, thêm, chỉnh sửa và quản lý các dự án Portfolio.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary rounded-3 px-3 py-2 fw-semibold">
            <i class="bi bi-plus-lg me-1"></i> Thêm dự án
        </a>
    </div>

    <section class="ap-card">
        <div class="ap-card-header">
            <div>
                <h2 class="h6 ap-heading mb-1">Danh sách dự án</h2>
                <p class="ap-muted small mb-0">Tổng cộng {{ $projects->total() }} dự án</p>
            </div>
            <span class="ap-muted small"><i class="bi bi-folder2-open me-1"></i> Dữ liệu từ hệ thống</span>
        </div>
        <div class="table-responsive">
            <table class="table ap-table align-middle">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên dự án</th>
                        <th scope="col">Công nghệ</th>
                        <th scope="col" class="text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td class="ap-muted small">#{{ $project->id }}</td>
                            <td>
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="Ảnh minh họa dự án {{ $project->title }}" class="ap-thumb" loading="lazy">
                                @else
                                    <div class="ap-thumb ap-thumb-empty" aria-label="Chưa có ảnh"><i class="bi bi-image"></i></div>
                                @endif
                            </td>
                            <td><div class="ap-project-title">{{ $project->title }}</div></td>
                            <td>
                                @php
                                    $techItems = array_values(array_filter(array_map('trim', preg_split('/[,;\r\n]+/', (string) ($project->technologies ?? '')))));
                                @endphp
                                @forelse($techItems as $tech)
                                    <span class="ap-tech">{{ $tech }}</span>
                                @empty
                                    <span class="ap-muted small">Chưa cập nhật</span>
                                @endforelse
                            </td>
                            <td>
                                <div class="d-flex justify-content-end align-items-center flex-wrap gap-2">
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm ap-btn-edit rounded-3 px-3" aria-label="Sửa dự án {{ $project->title }}">
                                        <i class="bi bi-pencil-square me-1"></i> Sửa
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa dự án này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm ap-btn-delete rounded-3 px-3" aria-label="Xóa dự án {{ $project->title }}">
                                            <i class="bi bi-trash3 me-1"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="ap-muted mb-2"><i class="bi bi-folder2-open fs-1"></i></div>
                                <div class="ap-heading fw-semibold">Chưa có dự án nào</div>
                                <p class="ap-muted small mt-2 mb-3">Hãy tạo dự án đầu tiên để hiển thị trên Portfolio.</p>
                                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">Thêm dự án</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($projects->hasPages())
            <div class="ap-pagination">{{ $projects->links() }}</div>
        @endif
    </section>
</div>
@endsection
