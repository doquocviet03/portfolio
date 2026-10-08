
@extends('layouts.admin')

@section('title', 'Tổng quan')

@section('page_title', 'Tổng quan hệ thống')

@section('content')

<style>
    .dashboard-welcome {
        background: linear-gradient(135deg, #0f172a, #1e40af);
        border-radius: 20px;
        color: white;
        padding: 30px;
        margin-bottom: 28px;
    }

    .dashboard-welcome h2 {
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .dashboard-welcome p {
        color: #cbd5e1;
        margin-bottom: 0;
    }

    .dashboard-stat {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 25px;
        height: 100%;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: .25s;
    }

    .dashboard-stat:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(15,23,42,.08);
    }

    .dashboard-stat-icon {
        width: 60px;
        height: 60px;
        flex-shrink: 0;
        border-radius: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
    }

    .stat-blue {
        background: #dbeafe;
        color: #2563eb;
    }

    .stat-purple {
        background: #ede9fe;
        color: #7c3aed;
    }

    .stat-green {
        background: #d1fae5;
        color: #059669;
    }

    .stat-orange {
        background: #fef3c7;
        color: #d97706;
    }

    .dashboard-stat-number {
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
    }

    .dashboard-stat-label {
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
        margin-top: 6px;
    }

    .dashboard-section-title {
        font-size: 19px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 0;
    }

    .dashboard-table th {
        background: #f8fafc;
        color: #475569;
        font-size: 13px;
        font-weight: 700;
        padding: 15px;
        white-space: nowrap;
    }

    .dashboard-table td {
        padding: 15px;
        color: #334155;
    }

    .dashboard-quick-link {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 17px;
        border-radius: 13px;
        text-decoration: none;
        color: #0f172a;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        transition: .2s;
        font-weight: 600;
    }

    .dashboard-quick-link:hover {
        background: #eff6ff;
        border-color: #93c5fd;
        color: #2563eb;
    }

    .dashboard-quick-link i {
        font-size: 21px;
        color: #2563eb;
    }
</style>

<!-- WELCOME -->

<div class="dashboard-welcome">

    <h2>
        <i class="bi bi-stars me-2"></i>
        Chào mừng trở lại!
    </h2>

    <p>
        Quản lý nội dung Portfolio của bạn
        tại một nơi duy nhất.
    </p>

</div>


<!-- STATISTICS -->

<div class="row g-4 mb-4">

    <div class="col-sm-6 col-xl-3">

        <div class="dashboard-stat">

            <div class="dashboard-stat-icon stat-blue">
                <i class="bi bi-folder2-open"></i>
            </div>

            <div>
                <div class="dashboard-stat-number">
                    {{ $projectCount }}
                </div>

                <div class="dashboard-stat-label">
                    Tổng dự án
                </div>
            </div>

        </div>

    </div>

    <div class="col-sm-6 col-xl-3">

        <div class="dashboard-stat">

            <div class="dashboard-stat-icon stat-purple">
                <i class="bi bi-code-slash"></i>
            </div>

            <div>
                <div class="dashboard-stat-number">
                    {{ $skillCount }}
                </div>

                <div class="dashboard-stat-label">
                    Tổng kỹ năng
                </div>
            </div>

        </div>

    </div>

    <div class="col-sm-6 col-xl-3">

        <div class="dashboard-stat">

            <div class="dashboard-stat-icon stat-green">
                <i class="bi bi-briefcase"></i>
            </div>

            <div>
                <div class="dashboard-stat-number">
                    {{ $experienceCount }}
                </div>

                <div class="dashboard-stat-label">
                    Kinh nghiệm
                </div>
            </div>

        </div>

    </div>

    <div class="col-sm-6 col-xl-3">

        <div class="dashboard-stat">

            <div class="dashboard-stat-icon stat-orange">
                <i class="bi bi-envelope"></i>
            </div>

            <div>
                <div class="dashboard-stat-number">
                    {{ $contactCount }}
                </div>

                <div class="dashboard-stat-label">
                    Tin nhắn liên hệ
                </div>
            </div>

        </div>

    </div>

</div>


<!-- MAIN CONTENT -->

<div class="row g-4">

    <!-- RECENT PROJECTS -->

    <div class="col-xl-7">

        <div class="admin-panel h-100">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

                <h3 class="dashboard-section-title">
                    <i class="bi bi-folder2-open text-primary me-2"></i>
                    Dự án gần đây
                </h3>

                <a href="{{ route('admin.projects.index') }}"
                   class="btn btn-outline-primary btn-sm">
                    Xem tất cả
                </a>

            </div>

            <div class="table-responsive">

                <table class="table dashboard-table">

                    <thead>
                        <tr>
                            <th>Tên dự án</th>
                            <th>Công nghệ</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recentProjects as $project)

                            <tr>

                                <td>
                                    <strong>
                                        {{ $project->title }}
                                    </strong>
                                </td>

                                <td>
                                    <span class="badge bg-primary-subtle text-primary-emphasis">
                                        {{ \Illuminate\Support\Str::limit($project->technologies ?: 'Chưa cập nhật', 35) }}
                                    </span>
                                </td>

                                <td>
                                    {{ $project->created_at?->format('d/m/Y') ?? '—' }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3"
                                    class="text-center text-muted py-4">
                                    Chưa có dự án nào.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- QUICK ACTIONS -->

    <div class="col-xl-5">

        <div class="admin-panel h-100">

            <h3 class="dashboard-section-title mb-4">
                <i class="bi bi-lightning-charge text-primary me-2"></i>
                Thao tác nhanh
            </h3>

            <div class="d-grid gap-3">

                <a href="{{ route('admin.projects.create') }}"
                   class="dashboard-quick-link">
                    <i class="bi bi-plus-circle"></i>
                    Thêm dự án mới
                </a>

                <a href="{{ route('admin.skills.create') }}"
                   class="dashboard-quick-link">
                    <i class="bi bi-code-square"></i>
                    Thêm kỹ năng mới
                </a>

                <a href="{{ route('admin.experiences.create') }}"
                   class="dashboard-quick-link">
                    <i class="bi bi-briefcase"></i>
                    Thêm kinh nghiệm
                </a>

                <a href="{{ route('admin.contacts.index') }}"
                   class="dashboard-quick-link">
                    <i class="bi bi-envelope-open"></i>
                    Quản lý tin nhắn
                </a>

                <a href="{{ route('home') }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="dashboard-quick-link">
                    <i class="bi bi-globe"></i>
                    Xem website công khai
                </a>

            </div>

        </div>

    </div>

</div>


<!-- RECENT CONTACTS -->

<div class="admin-panel mt-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <h3 class="dashboard-section-title">
            <i class="bi bi-envelope text-primary me-2"></i>
            Tin nhắn mới nhất
        </h3>

        <a href="{{ route('admin.contacts.index') }}"
           class="btn btn-outline-primary btn-sm">
            Xem tất cả
        </a>

    </div>

    <div class="table-responsive">

        <table class="table dashboard-table">

            <thead>
                <tr>
                    <th>Người gửi</th>
                    <th>Email</th>
                    <th>Tiêu đề</th>
                    <th>Ngày gửi</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>

                @forelse($recentContacts as $contact)

                    <tr>

                        <td>
                            <strong>{{ $contact->name }}</strong>
                        </td>

                        <td>
                            {{ $contact->email }}
                        </td>

                        <td>
                            {{ \Illuminate\Support\Str::limit($contact->subject ?: 'Không có tiêu đề', 40) }}
                        </td>

                        <td>
                            {{ $contact->created_at?->format('d/m/Y') ?? '—' }}
                        </td>

                        <td>
                            <a href="{{ route('admin.contacts.show', $contact) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                                Xem
                            </a>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5"
                            class="text-center text-muted py-4">
                            Chưa có tin nhắn nào.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
