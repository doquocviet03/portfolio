@extends('layouts.admin')

@section('title', 'Sao lưu dữ liệu')
@section('page_title', 'Sao lưu dữ liệu')

@push('styles')
<style>
.backup-page { --bk-surface:#fff;--bk-text:#0f172a;--bk-muted:#64748b;--bk-border:#e2e8f0;--bk-soft:#f8fafc; }
html[data-bs-theme="dark"] .backup-page,html[data-theme="dark"] .backup-page {
 --bk-surface:#17243a;--bk-text:#f1f5f9;--bk-muted:#b9c8da;--bk-border:#34465e;--bk-soft:#1e2e46;
}
.backup-page .bk-heading{color:var(--bk-text);font-weight:800}
.backup-page .bk-muted{color:var(--bk-muted)!important}
.backup-page .bk-card{background:var(--bk-surface);border:1px solid var(--bk-border);border-radius:20px;box-shadow:0 8px 28px rgba(15,23,42,.05)}
.backup-page .bk-summary{display:flex;align-items:center;gap:15px;padding:22px}
.backup-page .bk-icon{width:50px;height:50px;display:grid;place-items:center;border-radius:14px;font-size:23px;flex-shrink:0}
.backup-page .bk-count{font-size:26px;font-weight:800;color:var(--bk-text);line-height:1.2}
.backup-page .bk-info{border:1px solid var(--bk-border);border-left:4px solid #3b82f6;border-radius:14px;padding:17px 20px;background:var(--bk-soft);color:var(--bk-text)}
.backup-page .bk-table{--bs-table-bg:transparent;--bs-table-color:var(--bk-text);margin-bottom:0}
.backup-page .bk-table th{font-size:13px;color:var(--bk-muted);font-weight:700;padding:17px;border-color:var(--bk-border);white-space:nowrap}
.backup-page .bk-table td{padding:18px 17px;border-color:var(--bk-border);vertical-align:middle;color:var(--bk-text)}
.backup-page .bk-table tbody tr:last-child td{border-bottom:0}
.backup-page .bk-file-icon{width:42px;height:42px;display:grid;place-items:center;border-radius:12px;background:var(--bk-soft);color:#60a5fa;font-size:20px;flex-shrink:0}
.backup-page .bk-file-name{overflow-wrap:anywhere;word-break:break-word}
.backup-page .bk-action{border-radius:9px;font-weight:600;padding:7px 12px;white-space:nowrap}
.backup-page .bk-empty{text-align:center;padding:55px 20px;color:var(--bk-muted)}
.backup-page .bk-empty-icon{font-size:36px;display:block;margin-bottom:10px;color:#60a5fa}
.backup-page .bk-create{border-radius:11px;font-weight:700;padding:11px 18px}
.backup-page .bk-table-header{padding:22px 22px 16px}
.backup-page .bk-panel-title{font-weight:800;color:var(--bk-text);font-size:17px}
@media(max-width:575.98px){.backup-page .bk-table th,.backup-page .bk-table td{padding:12px}.backup-page .bk-create{width:100%}}
</style>
@endpush

@section('content')
<div class="backup-page container-fluid px-0">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="bk-heading h3 mb-1">Sao lưu dữ liệu</h1>
            <p class="bk-muted mb-0">Tạo, tải xuống và quản lý bản sao lưu Personal Portfolio.</p>
        </div>
        <form action="{{ route('admin.backups.store') }}" method="POST" id="createBackupForm">
            @csrf
            <button type="submit" class="btn btn-primary bk-create" id="createBackupButton">
                <i class="bi bi-cloud-arrow-up me-2"></i>Tạo bản sao lưu
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="bk-card bk-summary h-100">
                <span class="bk-icon bg-primary-subtle text-primary"><i class="bi bi-archive"></i></span>
                <div>
                    <div class="bk-muted small mb-1">Tổng bản sao lưu</div>
                    <div class="bk-count">{{ count($backups) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="bk-card bk-summary h-100">
                <span class="bk-icon bg-success-subtle text-success"><i class="bi bi-shield-check"></i></span>
                <div>
                    <div class="fw-bold" style="color:var(--bk-text)">Bảo vệ dữ liệu</div>
                    <div class="bk-muted small">Tải và lưu bản sao lưu ở nơi an toàn</div>
                </div>
            </div>
        </div>
    </div>

    <div class="bk-info d-flex align-items-start gap-3 mb-4" role="note">
        <i class="bi bi-info-circle-fill text-primary fs-5"></i>
        <div>
            <div class="fw-bold mb-1">Lưu ý về sao lưu</div>
            <div class="bk-muted small">
                Theo cấu hình sao lưu hiện tại, file ZIP có thể chứa dữ liệu cơ sở dữ liệu và ảnh đã tải lên.
                Hãy tải file về máy, cất giữ an toàn và kiểm tra khả năng khôi phục trước khi cần sử dụng.
            </div>
        </div>
    </div>

    <section class="bk-card overflow-hidden">
        <div class="bk-table-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h2 class="bk-panel-title mb-0"><i class="bi bi-database me-2 text-primary"></i>Danh sách bản sao lưu</h2>
            <span class="bk-muted small">{{ count($backups) }} file</span>
        </div>

        @if(count($backups))
            <div class="table-responsive">
                <table class="table bk-table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Tên file</th>
                            <th scope="col">Dung lượng</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col" class="text-end">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($backups as $backup)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="bk-file-icon"><i class="bi bi-file-earmark-zip"></i></span>
                                        <span class="fw-semibold bk-file-name">{{ $backup['name'] }}</span>
                                    </div>
                                </td>
                                <td class="text-nowrap">{{ $backup['size'] }} MB</td>
                                <td class="text-nowrap">{{ $backup['date'] }}</td>
                                <td>
                                    <div class="d-flex flex-wrap justify-content-end gap-2">
                                        <a href="{{ route('admin.backups.download', $backup['name']) }}"
                                           class="btn btn-sm btn-outline-primary bk-action">
                                            <i class="bi bi-download me-1"></i>Tải xuống
                                        </a>
                                        <form method="POST"
                                              action="{{ route('admin.backups.destroy', $backup['name']) }}"
                                              onsubmit="return confirm('Bạn chắc chắn muốn xóa bản sao lưu này? Hành động này không thể hoàn tác.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger bk-action">
                                                <i class="bi bi-trash3 me-1"></i>Xóa
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
            <div class="bk-empty">
                <i class="bi bi-inbox bk-empty-icon"></i>
                <h3 class="bk-heading h5">Chưa có bản sao lưu nào</h3>
                <p class="bk-muted mb-0">Nhấn “Tạo bản sao lưu” để bắt đầu.</p>
            </div>
        @endif
    </section>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createBackupForm');
    const button = document.getElementById('createBackupButton');
    if (!form || !button) return;
    form.addEventListener('submit', function () {
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm me-2" aria-hidden="true"></span>Đang tạo bản sao lưu...';
    });
});
</script>
@endpush
