@extends('layouts.admin')

@section('title', 'Quản lý tin nhắn')
@section('page_title', 'Quản lý tin nhắn')

@push('styles')
<style>
.contacts-page{--ct-bg:#fff;--ct-fg:#0f172a;--ct-muted:#64748b;--ct-border:#e2e8f0;--ct-soft:#f8fafc}
html[data-bs-theme="dark"] .contacts-page,html[data-theme="dark"] .contacts-page{--ct-bg:#17243a;--ct-fg:#f1f5f9;--ct-muted:#b9c8da;--ct-border:#33455e;--ct-soft:#1e2e46}
.contacts-page .ct-title{color:var(--ct-fg);font-weight:800}
.contacts-page .ct-muted{color:var(--ct-muted)!important}
.contacts-page .ct-card{background:var(--ct-bg);border:1px solid var(--ct-border);border-radius:18px;box-shadow:0 8px 30px rgba(15,23,42,.05)}
.contacts-page .ct-stat{padding:21px;display:flex;align-items:center;gap:16px;min-height:108px}
.contacts-page .ct-stat-icon{height:48px;width:48px;flex-shrink:0;display:grid;place-items:center;border-radius:13px;font-size:22px}
.contacts-page .ct-number{color:var(--ct-fg);font-size:28px;line-height:1.15;font-weight:800}
.contacts-page .ct-label{font-size:14px;color:var(--ct-muted)}
.contacts-page .form-label{color:var(--ct-fg);font-weight:650}
.contacts-page .form-control,.contacts-page .form-select{background-color:var(--ct-soft);border:1px solid var(--ct-border);color:var(--ct-fg);border-radius:10px;padding:11px 13px}
.contacts-page .form-control::placeholder{color:var(--ct-muted)}
.contacts-page .form-control:focus,.contacts-page .form-select:focus{background-color:var(--ct-bg);color:var(--ct-fg);border-color:#60a5fa;box-shadow:0 0 0 .2rem rgba(59,130,246,.15)}
.contacts-page .ct-table{--bs-table-bg:transparent;--bs-table-color:var(--ct-fg);margin:0}
.contacts-page .ct-table th{font-size:13px;color:var(--ct-muted);font-weight:750;white-space:nowrap;padding:15px;border-color:var(--ct-border)}
.contacts-page .ct-table td{color:var(--ct-fg);padding:16px 15px;vertical-align:middle;border-color:var(--ct-border)}
.contacts-page .ct-table tbody tr:last-child td{border-bottom:0}
.contacts-page .ct-avatar{width:39px;height:39px;display:grid;place-items:center;border-radius:12px;background:var(--ct-soft);color:#60a5fa;flex-shrink:0}
.contacts-page .ct-subject{max-width:300px;overflow-wrap:anywhere}
.contacts-page .ct-action{border-radius:9px;font-weight:600;white-space:nowrap}
.contacts-page .ct-badge{border-radius:100px;font-weight:650;padding:7px 11px;display:inline-block;font-size:12px}
.contacts-page .ct-empty{text-align:center;padding:55px 15px;color:var(--ct-muted)}
.contacts-page .ct-pagination{padding:18px 22px;border-top:1px solid var(--ct-border)}
.contacts-page .ct-pagination nav{overflow-x:auto}
@media(max-width:575.98px){.contacts-page .ct-table td,.contacts-page .ct-table th{padding:12px}}
</style>
@endpush

@section('content')
<div class="contacts-page container-fluid px-0">
    <div class="mb-4">
        <h1 class="ct-title h3 mb-1">Tin nhắn liên hệ</h1>
        <p class="ct-muted mb-0">Theo dõi và quản lý các tin nhắn được gửi từ website Portfolio.</p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-4">
            <div class="ct-card ct-stat">
                <span class="ct-stat-icon bg-primary-subtle text-primary"><i class="bi bi-envelope"></i></span>
                <div><div class="ct-label mb-1">Tổng tin nhắn</div><div class="ct-number">{{ $totalContacts }}</div></div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="ct-card ct-stat">
                <span class="ct-stat-icon bg-warning-subtle text-warning"><i class="bi bi-envelope-exclamation"></i></span>
                <div><div class="ct-label mb-1">Chưa đọc</div><div class="ct-number">{{ $unreadContacts }}</div></div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="ct-card ct-stat">
                <span class="ct-stat-icon bg-success-subtle text-success"><i class="bi bi-envelope-check"></i></span>
                <div><div class="ct-label mb-1">Đã đọc</div><div class="ct-number">{{ $readContacts }}</div></div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    <section class="ct-card p-3 p-md-4 mb-4">
        <div class="d-flex align-items-center gap-2 mb-3">
            <i class="bi bi-funnel text-primary"></i>
            <h2 class="ct-title h6 mb-0">Tìm kiếm và bộ lọc</h2>
        </div>
        <form method="GET" action="{{ route('admin.contacts.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-6 col-lg-7">
                    <label for="contactSearch" class="form-label">Tìm kiếm</label>
                    <input id="contactSearch" type="search" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Tên, email, tiêu đề...">
                </div>
                <div class="col-md-3">
                    <label for="contactStatus" class="form-label">Trạng thái</label>
                    <select id="contactStatus" name="status" class="form-select">
                        <option value="all" @selected(($status ?? 'all') === 'all')>Tất cả</option>
                        <option value="unread" @selected(($status ?? 'all') === 'unread')>Chưa đọc</option>
                        <option value="read" @selected(($status ?? 'all') === 'read')>Đã đọc</option>
                    </select>
                </div>
                <div class="col-md-3 col-lg-2">
                    <button type="submit" class="btn btn-primary w-100 rounded-3 py-2"><i class="bi bi-search me-1"></i> Lọc</button>
                </div>
            </div>
        </form>
    </section>

    <section class="ct-card overflow-hidden">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 px-3 px-md-4 pt-4 pb-3">
            <h2 class="ct-title h6 mb-0">Danh sách tin nhắn</h2>
            <span class="ct-muted small">{{ $contacts->total() }} kết quả</span>
        </div>
        @if($contacts->count())
            <div class="table-responsive">
                <table class="table ct-table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Người gửi</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Ngày gửi</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col" class="text-end">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="ct-avatar"><i class="bi bi-person"></i></span>
                                        <div>
                                            <div class="fw-semibold">{{ $contact->name }}</div>
                                            <div class="ct-muted small text-break">{{ $contact->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><div class="ct-subject">{{ \Illuminate\Support\Str::limit($contact->subject, 45) }}</div></td>
                                <td class="text-nowrap"><span class="ct-muted small">{{ $contact->created_at?->format('d/m/Y H:i') }}</span></td>
                                <td>
                                    @if($contact->is_read)
                                        <span class="ct-badge bg-success-subtle text-success"><i class="bi bi-check-circle me-1"></i> Đã đọc</span>
                                    @else
                                        <span class="ct-badge bg-warning-subtle text-warning-emphasis"><i class="bi bi-circle-fill me-1" style="font-size:7px"></i> Chưa đọc</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap justify-content-end gap-2">
                                        <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-outline-primary ct-action"><i class="bi bi-eye me-1"></i> Xem</a>
                                        @if($contact->is_read)
                                            <form method="POST" action="{{ route('admin.contacts.unread', $contact) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary ct-action"><i class="bi bi-envelope me-1"></i> Chưa đọc</button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" onsubmit="return confirm('Bạn chắc chắn muốn xóa tin nhắn này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger ct-action"><i class="bi bi-trash3 me-1"></i> Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="ct-empty">
                <i class="bi bi-inbox fs-1 d-block mb-3 text-primary"></i>
                <h3 class="ct-title h5">Không tìm thấy tin nhắn</h3>
                <p class="ct-muted mb-3">Chưa có tin nhắn phù hợp với bộ lọc hiện tại.</p>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-primary rounded-3">Xóa bộ lọc</a>
            </div>
        @endif
        @if($contacts->hasPages())
            <div class="ct-pagination">{{ $contacts->appends(request()->query())->links('pagination::bootstrap-5') }}</div>
        @endif
    </section>
</div>
@endsection
