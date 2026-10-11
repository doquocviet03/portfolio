@extends('layouts.admin')

@section('title', 'Chi tiết tin nhắn')
@section('page_title', 'Chi tiết tin nhắn')

@push('styles')
<style>
.contact-detail {
    --cd-bg: #ffffff;
    --cd-text: #0f172a;
    --cd-muted: #64748b;
    --cd-border: #e2e8f0;
    --cd-soft: #f8fafc;
}
html[data-bs-theme="dark"] .contact-detail,
html[data-theme="dark"] .contact-detail {
    --cd-bg: #17243a;
    --cd-text: #f1f5f9;
    --cd-muted: #b9c8da;
    --cd-border: #33455e;
    --cd-soft: #1e2e46;
}
.contact-detail .cd-title { color: var(--cd-text); font-weight: 800; }
.contact-detail .cd-muted { color: var(--cd-muted) !important; }
.contact-detail .cd-card {
    background: var(--cd-bg); border: 1px solid var(--cd-border);
    border-radius: 20px; box-shadow: 0 8px 30px rgba(15,23,42,.05);
}
.contact-detail .cd-main { padding: clamp(20px, 3vw, 32px); }
.contact-detail .cd-icon {
    display: grid; place-items: center; width: 44px; height: 44px;
    flex-shrink: 0; border-radius: 13px;
    background: var(--cd-soft); color: #60a5fa; font-size: 21px;
}
.contact-detail .cd-info {
    padding: 16px 18px; border: 1px solid var(--cd-border);
    border-radius: 13px; background: var(--cd-soft); height: 100%;
}
.contact-detail .cd-info-label { color: var(--cd-muted); font-size: 13px; margin-bottom: 6px; }
.contact-detail .cd-info-value { color: var(--cd-text); font-weight: 600; overflow-wrap: anywhere; }
.contact-detail .cd-message {
    background: var(--cd-soft); border: 1px solid var(--cd-border);
    border-radius: 15px; padding: 22px; color: var(--cd-text);
    white-space: pre-wrap; overflow-wrap: anywhere; line-height: 1.8;
}
.contact-detail .cd-divider { border-color: var(--cd-border); opacity: 1; }
.contact-detail .cd-btn { border-radius: 10px; padding: 10px 16px; font-weight: 650; }
.contact-detail .cd-back {
    background: var(--cd-soft); color: var(--cd-text);
    border: 1px solid var(--cd-border); border-radius: 10px;
    padding: 10px 16px; text-decoration: none; font-weight: 600;
}
.contact-detail .cd-back:hover { border-color: #60a5fa; color: var(--cd-text); }
.contact-detail .cd-aside { padding: 24px; }
.contact-detail .cd-aside h2 { color: var(--cd-text); font-size: 17px; font-weight: 800; }
.contact-detail .cd-aside p { color: var(--cd-muted); }
@media (max-width: 575.98px) {
    .contact-detail .cd-message { padding: 16px; }
    .contact-detail .cd-actions > * { width: 100%; }
    .contact-detail .cd-actions form button { width: 100%; }
}
</style>
@endpush

@section('content')
<div class="contact-detail container-fluid px-0">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="cd-title h3 mb-1">Chi tiết tin nhắn</h1>
            <p class="cd-muted mb-0">Xem thông tin liên hệ và nội dung người gửi.</p>
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="cd-back">
            <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-xl-8">
            <article class="cd-card cd-main">
                <div class="d-flex flex-wrap align-items-start gap-3 mb-4">
                    <div class="cd-icon"><i class="bi bi-envelope-paper"></i></div>
                    <div class="flex-grow-1" style="min-width: 0;">
                        <p class="cd-muted small mb-1">Tiêu đề tin nhắn</p>
                        <h2 class="cd-title h4 mb-2" style="overflow-wrap: anywhere;">{{ $contact->subject }}</h2>
                        @if($contact->is_read)
                            <span class="badge text-bg-success rounded-pill px-3 py-2">
                                <i class="bi bi-check2-circle me-1"></i> Đã đọc
                            </span>
                        @else
                            <span class="badge text-bg-warning rounded-pill px-3 py-2">
                                <i class="bi bi-envelope me-1"></i> Chưa đọc
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="cd-info">
                            <div class="cd-info-label"><i class="bi bi-person me-1"></i> Người gửi</div>
                            <div class="cd-info-value">{{ $contact->name }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cd-info">
                            <div class="cd-info-label"><i class="bi bi-at me-1"></i> Email</div>
                            <div class="cd-info-value">{{ $contact->email }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cd-info">
                            <div class="cd-info-label"><i class="bi bi-calendar-event me-1"></i> Ngày gửi</div>
                            <div class="cd-info-value">{{ $contact->created_at?->format('d/m/Y H:i') ?? 'Không xác định' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cd-info">
                            <div class="cd-info-label"><i class="bi bi-chat-left-text me-1"></i> Trạng thái</div>
                            <div class="cd-info-value">{{ $contact->is_read ? 'Đã đọc' : 'Chưa đọc' }}</div>
                        </div>
                    </div>
                </div>

                <hr class="cd-divider my-4">
                <h3 class="cd-title h5 mb-3"><i class="bi bi-chat-square-text text-primary me-2"></i>Nội dung tin nhắn</h3>
                <div class="cd-message">{{ $contact->message }}</div>

                <div class="d-flex flex-wrap gap-2 mt-4 cd-actions">
                    <a href="mailto:{{ $contact->email }}" class="btn btn-primary cd-btn">
                        <i class="bi bi-reply me-1"></i> Trả lời qua email
                    </a>
                    @if($contact->is_read)
                        <form method="POST" action="{{ route('admin.contacts.unread', $contact) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-secondary cd-btn">
                                <i class="bi bi-envelope me-1"></i> Đánh dấu chưa đọc
                            </button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                          onsubmit="return confirm('Bạn chắc chắn muốn xóa tin nhắn này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger cd-btn">
                            <i class="bi bi-trash3 me-1"></i> Xóa tin nhắn
                        </button>
                    </form>
                </div>
            </article>
        </div>

        <div class="col-xl-4">
            <aside class="cd-card cd-aside">
                <h2 class="mb-3"><i class="bi bi-info-circle text-primary me-2"></i>Thông tin</h2>
                <p class="small mb-3">Tin nhắn được gửi từ biểu mẫu liên hệ trên website Portfolio.</p>
                <div class="cd-info mb-3">
                    <div class="cd-info-label">Mã tin nhắn</div>
                    <div class="cd-info-value">#{{ $contact->id }}</div>
                </div>
                <div class="cd-info">
                    <div class="cd-info-label">Thời gian nhận</div>
                    <div class="cd-info-value">{{ $contact->created_at?->format('d/m/Y H:i') ?? 'Không xác định' }}</div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
