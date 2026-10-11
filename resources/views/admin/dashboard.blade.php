@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Tổng quan hệ thống')

@push('styles')
<style>
.admin-dashboard {
    --dash-card: #ffffff;
    --dash-text: #0f172a;
    --dash-muted: #64748b;
    --dash-border: #e2e8f0;
    --dash-soft: #f8fafc;
    --dash-link: #1d4ed8;
    color: var(--dash-text);
}
html[data-theme="dark"] .admin-dashboard,
html[data-bs-theme="dark"] .admin-dashboard,
body.dark-mode .admin-dashboard {
    --dash-card: #17243a;
    --dash-text: #f1f5f9;
    --dash-muted: #b4c4d8;
    --dash-border: #33455e;
    --dash-soft: #1d2e48;
    --dash-link: #93c5fd;
}
.admin-dashboard .dash-muted { color: var(--dash-muted) !important; }
.admin-dashboard .dash-title { color: var(--dash-text); font-weight: 800; }
.admin-dashboard .dash-panel {
    background: var(--dash-card);
    border: 1px solid var(--dash-border);
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(15,23,42,.05);
}
.admin-dashboard .dash-stat { height: 100%; padding: 24px; transition: transform .2s; }
.admin-dashboard .dash-stat:hover { transform: translateY(-3px); }
.admin-dashboard .dash-stat-icon {
    width: 52px; height: 52px; border-radius: 15px;
    display: grid; place-items: center; font-size: 24px;
}
.admin-dashboard .dash-stat-number {
    font-size: clamp(28px, 3vw, 38px); font-weight: 800;
    color: var(--dash-text); line-height: 1.2;
}
.admin-dashboard .dash-link { color: var(--dash-link); text-decoration: none; font-weight: 650; }
.admin-dashboard .dash-link:hover { text-decoration: underline; }
.admin-dashboard .dash-panel-header {
    display: flex; align-items: center; justify-content: space-between;
    gap: 12px; flex-wrap: wrap; margin-bottom: 20px;
}
.admin-dashboard .dash-panel-title {
    color: var(--dash-text); font-size: 18px; font-weight: 800; margin: 0;
}
.admin-dashboard .dash-table { --bs-table-bg: transparent; --bs-table-color: var(--dash-text); margin-bottom: 0; }
.admin-dashboard .dash-table th {
    color: var(--dash-muted); border-bottom-color: var(--dash-border);
    font-size: 13px; white-space: nowrap; padding: 13px 10px;
}
.admin-dashboard .dash-table td {
    color: var(--dash-text); border-bottom-color: var(--dash-border);
    vertical-align: middle; padding: 14px 10px;
}
.admin-dashboard .dash-table tbody tr:last-child td { border-bottom: 0; }
.admin-dashboard .dash-thumb {
    width: 48px; height: 48px; border-radius: 12px;
    object-fit: cover; flex-shrink: 0; background: var(--dash-soft);
}
.admin-dashboard .dash-thumb-empty {
    display: grid; place-items: center; color: var(--dash-muted); font-size: 20px;
}
.admin-dashboard .dash-project-name { color: var(--dash-text); font-weight: 700; overflow-wrap: anywhere; }
.admin-dashboard .dash-message { padding: 16px 0; border-bottom: 1px solid var(--dash-border); }
.admin-dashboard .dash-message:last-child { border-bottom: 0; }
.admin-dashboard .dash-message strong { color: var(--dash-text); }
.admin-dashboard .dash-message p { color: var(--dash-text); overflow-wrap: anywhere; }
.admin-dashboard .dash-quick {
    display: flex; align-items: center; gap: 12px; height: 100%;
    border: 1px solid var(--dash-border); background: var(--dash-soft);
    color: var(--dash-text); border-radius: 14px; padding: 18px;
    text-decoration: none; font-weight: 650; transition: border-color .2s, transform .2s;
}
.admin-dashboard .dash-quick:hover {
    border-color: #60a5fa; color: var(--dash-link); transform: translateY(-2px);
}
.admin-dashboard .dash-quick i { font-size: 21px; color: var(--dash-link); }
.admin-dashboard .dash-chart { height: 290px; position: relative; }
.admin-dashboard .dash-action {
    border: 1px solid var(--dash-border); color: var(--dash-link);
    background: var(--dash-soft); border-radius: 9px;
    padding: 7px 11px; display: inline-block; text-decoration: none;
}
.admin-dashboard .dash-action:hover { border-color: #60a5fa; color: var(--dash-link); }
@media (max-width: 575.98px) {
    .admin-dashboard .dash-stat { padding: 19px; }
    .admin-dashboard .dash-chart { height: 240px; }
}
@media (prefers-reduced-motion: reduce) {
    .admin-dashboard .dash-stat, .admin-dashboard .dash-quick { transition: none; }
    .admin-dashboard .dash-stat:hover, .admin-dashboard .dash-quick:hover { transform: none; }
}
</style>
@endpush

@section('content')
<div class="admin-dashboard container-fluid px-0">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="dash-title h3 mb-1">Dashboard</h1>
            <p class="dash-muted mb-0">Tổng quan dữ liệu website Personal Portfolio.</p>
        </div>
        <a href="{{ route('home') }}" class="dash-action" target="_blank" rel="noopener noreferrer">
            <i class="bi bi-box-arrow-up-right me-1"></i> Xem website
        </a>
    </div>

    <div class="row g-3 g-xl-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <section class="dash-panel dash-stat">
                <div class="d-flex justify-content-between align-items-start gap-2">
                    <div>
                        <p class="dash-muted mb-2">Tổng dự án</p>
                        <div class="dash-stat-number">{{ $totalProjects }}</div>
                    </div>
                    <div class="dash-stat-icon bg-primary-subtle text-primary"><i class="bi bi-folder2-open"></i></div>
                </div>
                <a class="dash-link d-inline-block mt-3" href="{{ route('admin.projects.index') }}">Quản lý dự án <i class="bi bi-arrow-right"></i></a>
            </section>
        </div>
        <div class="col-sm-6 col-xl-3">
            <section class="dash-panel dash-stat">
                <div class="d-flex justify-content-between align-items-start gap-2">
                    <div>
                        <p class="dash-muted mb-2">Kỹ năng</p>
                        <div class="dash-stat-number">{{ $totalSkills }}</div>
                    </div>
                    <div class="dash-stat-icon bg-success-subtle text-success"><i class="bi bi-code-slash"></i></div>
                </div>
                <a class="dash-link d-inline-block mt-3" href="{{ route('admin.skills.index') }}">Quản lý kỹ năng <i class="bi bi-arrow-right"></i></a>
            </section>
        </div>
        <div class="col-sm-6 col-xl-3">
            <section class="dash-panel dash-stat">
                <div class="d-flex justify-content-between align-items-start gap-2">
                    <div>
                        <p class="dash-muted mb-2">Kinh nghiệm</p>
                        <div class="dash-stat-number">{{ $totalExperiences }}</div>
                    </div>
                    <div class="dash-stat-icon bg-warning-subtle text-warning-emphasis"><i class="bi bi-briefcase"></i></div>
                </div>
                <a class="dash-link d-inline-block mt-3" href="{{ route('admin.experiences.index') }}">Quản lý kinh nghiệm <i class="bi bi-arrow-right"></i></a>
            </section>
        </div>
        <div class="col-sm-6 col-xl-3">
            <section class="dash-panel dash-stat">
                <div class="d-flex justify-content-between align-items-start gap-2">
                    <div>
                        <p class="dash-muted mb-2">Tin nhắn</p>
                        <div class="dash-stat-number">{{ $totalContacts }}</div>
                    </div>
                    <div class="dash-stat-icon bg-danger-subtle text-danger"><i class="bi bi-envelope"></i></div>
                </div>
                <a class="dash-link d-inline-block mt-3" href="{{ route('admin.contacts.index') }}">Xem tin nhắn <i class="bi bi-arrow-right"></i></a>
            </section>
        </div>
    </div>

    <section class="dash-panel p-3 p-md-4 mb-4">
        <div class="dash-panel-header">
            <h2 class="dash-panel-title"><i class="bi bi-bar-chart text-primary me-2"></i>Dự án trong 6 tháng gần nhất</h2>
        </div>
        <div class="dash-chart">
            <canvas id="projectsChart" role="img" aria-label="Biểu đồ số dự án được tạo trong 6 tháng gần nhất"></canvas>
        </div>
    </section>

    <div class="row g-4 mb-4">
        <div class="col-xl-7">
            <section class="dash-panel p-3 p-md-4 h-100">
                <div class="dash-panel-header">
                    <h2 class="dash-panel-title">Dự án mới nhất</h2>
                    <a href="{{ route('admin.projects.index') }}" class="dash-link small">Xem tất cả <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table dash-table align-middle">
                        <thead><tr><th>Dự án</th><th>Ngày tạo</th><th>Thao tác</th></tr></thead>
                        <tbody>
                        @forelse($recentProjects as $project)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($project->image)
                                            <img src="{{ asset('storage/' . $project->image) }}" alt="" class="dash-thumb" loading="lazy">
                                        @else
                                            <div class="dash-thumb dash-thumb-empty"><i class="bi bi-folder"></i></div>
                                        @endif
                                        <div>
                                            <div class="dash-project-name">{{ $project->title }}</div>
                                            <small class="dash-muted">{{ \Illuminate\Support\Str::limit($project->technologies ?? '', 35) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="small">{{ $project->created_at?->format('d/m/Y') ?? '—' }}</td>
                                <td><a class="dash-action small" href="{{ route('admin.projects.edit', $project) }}"><i class="bi bi-pencil-square me-1"></i>Sửa</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center dash-muted py-4">Chưa có dự án nào.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div class="col-xl-5">
            <section class="dash-panel p-3 p-md-4 h-100">
                <div class="dash-panel-header">
                    <h2 class="dash-panel-title">Tin nhắn mới nhất</h2>
                    <a href="{{ route('admin.contacts.index') }}" class="dash-link small">Xem tất cả <i class="bi bi-arrow-right"></i></a>
                </div>
                @forelse($recentContacts as $contact)
                    <article class="dash-message">
                        <div class="d-flex flex-wrap justify-content-between gap-2">
                            <strong>{{ $contact->name }}</strong>
                            <small class="dash-muted">{{ $contact->created_at?->format('d/m/Y') ?? '—' }}</small>
                        </div>
                        <div class="dash-muted small mt-1">{{ $contact->email }}</div>
                        <p class="small mt-2 mb-2">{{ \Illuminate\Support\Str::limit($contact->message ?? '', 90) }}</p>
                        <a class="dash-link small" href="{{ route('admin.contacts.show', $contact) }}">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
                    </article>
                @empty
                    <p class="dash-muted text-center py-4 mb-0">Chưa có tin nhắn nào.</p>
                @endforelse
            </section>
        </div>
    </div>

    <section class="dash-panel p-3 p-md-4">
        <div class="dash-panel-header"><h2 class="dash-panel-title">Truy cập nhanh</h2></div>
        <div class="row g-3">
            <div class="col-sm-6 col-xl-3">
                <a class="dash-quick" href="{{ route('admin.projects.create') }}"><i class="bi bi-plus-circle"></i> Thêm dự án</a>
            </div>
            <div class="col-sm-6 col-xl-3">
                <a class="dash-quick" href="{{ route('admin.skills.create') }}"><i class="bi bi-code-slash"></i> Thêm kỹ năng</a>
            </div>
            <div class="col-sm-6 col-xl-3">
                <a class="dash-quick" href="{{ route('admin.experiences.create') }}"><i class="bi bi-briefcase"></i> Thêm kinh nghiệm</a>
            </div>
            <div class="col-sm-6 col-xl-3">
                <a class="dash-quick" href="{{ route('admin.profile.edit') }}"><i class="bi bi-person-circle"></i> Chỉnh sửa hồ sơ</a>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.8/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('projectsChart');
    if (!canvas || typeof Chart === 'undefined') return;

    const chart = new Chart(canvas, {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Số dự án',
                data: @json($chartData),
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderColor: '#3b82f6',
                borderWidth: 1,
                borderRadius: 8,
                maxBarThickness: 56
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { color: '#94a3b8' }, grid: { display: false } },
                y: { beginAtZero: true, ticks: { color: '#94a3b8', precision: 0, stepSize: 1 }, grid: { color: 'rgba(148,163,184,.18)' } }
            }
        }
    });
});
</script>
@endpush
