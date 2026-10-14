
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

.contact-detail .cd-title {
    color: var(--cd-text);
    font-weight: 800;
}

.contact-detail .cd-muted {
    color: var(--cd-muted) !important;
}

.contact-detail .cd-card {
    background: var(--cd-bg);
    border: 1px solid var(--cd-border);
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(15,23,42,.05);
}

.contact-detail .cd-main {
    padding: clamp(20px, 3vw, 32px);
}

.contact-detail .cd-icon {
    display: grid;
    place-items: center;
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    border-radius: 13px;
    background: var(--cd-soft);
    color: #60a5fa;
    font-size: 21px;
}

.contact-detail .cd-info {
    padding: 16px 18px;
    border: 1px solid var(--cd-border);
    border-radius: 13px;
    background: var(--cd-soft);
    height: 100%;
}

.contact-detail .cd-info-label {
    color: var(--cd-muted);
    font-size: 13px;
    margin-bottom: 6px;
}

.contact-detail .cd-info-value {
    color: var(--cd-text);
    font-weight: 600;
    overflow-wrap: anywhere;
}

.contact-detail .cd-message {
    background: var(--cd-soft);
    border: 1px solid var(--cd-border);
    border-radius: 15px;
    padding: 22px;
    color: var(--cd-text);
    white-space: pre-wrap;
    overflow-wrap: anywhere;
    line-height: 1.8;
}

.contact-detail .cd-divider {
    border-color: var(--cd-border);
    opacity: 1;
}

.contact-detail .cd-btn {
    border-radius: 10px;
    padding: 10px 16px;
    font-weight: 650;
}

.contact-detail .cd-back {
    background: var(--cd-soft);
    color: var(--cd-text);
    border: 1px solid var(--cd-border);
    border-radius: 10px;
    padding: 10px 16px;
    text-decoration: none;
    font-weight: 600;
}

.contact-detail .cd-back:hover {
    border-color: #60a5fa;
    color: var(--cd-text);
}

.contact-detail .cd-aside {
    padding: 24px;
}

.contact-detail .cd-aside h2 {
    color: var(--cd-text);
    font-size: 17px;
    font-weight: 800;
}

.contact-detail .cd-aside p {
    color: var(--cd-muted);
}

.contact-detail .cd-reply-status {
    padding: 14px 16px;
    border: 1px solid var(--cd-border);
    border-radius: 12px;
    background: var(--cd-soft);
}

@media (max-width: 575.98px) {
    .contact-detail .cd-message {
        padding: 16px;
    }

    .contact-detail .cd-actions > * {
        width: 100%;
    }

    .contact-detail .cd-actions form button {
        width: 100%;
    }
}
</style>
@endpush

@section('content')

@php
    // Đếm số Email đã gửi thành công cho tin nhắn này
    $sentRepliesCount = \App\Models\ContactReply::query()
        ->where('contact_id', $contact->id)
        ->where('status', 'sent')
        ->count();

    $hasReplied = $sentRepliesCount > 0;
@endphp

<div class="contact-detail container-fluid px-0">

    {{-- Tiêu đề trang --}}
    <div class="d-flex flex-wrap justify-content-between
                align-items-center gap-3 mb-4">

        <div>
            <h1 class="cd-title h3 mb-1">
                Chi tiết tin nhắn
            </h1>

            <p class="cd-muted mb-0">
                Xem thông tin liên hệ, nội dung và phản hồi khách hàng.
            </p>
        </div>

        <a href="{{ route('admin.contacts.index') }}"
           class="cd-back">

            <i class="bi bi-arrow-left me-1"></i>
            Quay lại danh sách
        </a>

    </div>

    {{-- Thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3"
             role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Đóng"></button>
        </div>
    @endif

    {{-- Thông báo lỗi --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3"
             role="alert">

            <i class="bi bi-exclamation-triangle me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Đóng"></button>
        </div>
    @endif

    <div class="row g-4">

        {{-- NỘI DUNG CHÍNH --}}
        <div class="col-xl-8">

            <article class="cd-card cd-main">

                {{-- Thông tin tiêu đề --}}
                <div class="d-flex flex-wrap align-items-start gap-3 mb-4">

                    <div class="cd-icon">
                        <i class="bi bi-envelope-paper"></i>
                    </div>

                    <div class="flex-grow-1" style="min-width: 0;">

                        <p class="cd-muted small mb-1">
                            Tiêu đề tin nhắn
                        </p>

                        <h2 class="cd-title h4 mb-2"
                            style="overflow-wrap: anywhere;">

                            {{ $contact->subject }}
                        </h2>

                        <div class="d-flex flex-wrap gap-2">

                            @if($contact->is_read)

                                <span class="badge text-bg-success
                                             rounded-pill px-3 py-2">

                                    <i class="bi bi-check2-circle me-1"></i>
                                    Đã đọc
                                </span>

                            @else

                                <span class="badge text-bg-warning
                                             rounded-pill px-3 py-2">

                                    <i class="bi bi-envelope me-1"></i>
                                    Chưa đọc
                                </span>

                            @endif

                            @if($hasReplied)

                                <span class="badge text-bg-primary
                                             rounded-pill px-3 py-2">

                                    <i class="bi bi-reply-fill me-1"></i>
                                    Đã trả lời
                                </span>

                            @else

                                <span class="badge text-bg-secondary
                                             rounded-pill px-3 py-2">

                                    <i class="bi bi-clock me-1"></i>
                                    Chưa trả lời
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

                {{-- Thông tin người gửi --}}
                <div class="row g-3 mb-4">

                    <div class="col-md-6">
                        <div class="cd-info">

                            <div class="cd-info-label">
                                <i class="bi bi-person me-1"></i>
                                Người gửi
                            </div>

                            <div class="cd-info-value">
                                {{ $contact->name }}
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="cd-info">

                            <div class="cd-info-label">
                                <i class="bi bi-at me-1"></i>
                                Email
                            </div>

                            <div class="cd-info-value">
                                {{ $contact->email }}
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="cd-info">

                            <div class="cd-info-label">
                                <i class="bi bi-calendar-event me-1"></i>
                                Ngày gửi
                            </div>

                            <div class="cd-info-value">
                                {{ $contact->created_at?->copy()->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') ?? 'Không xác định' }}
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="cd-info">

                            <div class="cd-info-label">
                                <i class="bi bi-chat-left-text me-1"></i>
                                Trạng thái đọc
                            </div>

                            <div class="cd-info-value">
                                {{ $contact->is_read ? 'Đã đọc' : 'Chưa đọc' }}
                            </div>

                        </div>
                    </div>

                </div>

                <hr class="cd-divider my-4">

                {{-- Nội dung tin nhắn --}}
                <h3 class="cd-title h5 mb-3">

                    <i class="bi bi-chat-square-text
                              text-primary me-2"></i>

                    Nội dung tin nhắn
                </h3>

                <div class="cd-message">{{ $contact->message }}</div>

                {{-- CÁC NÚT THAO TÁC --}}
                <div class="d-flex flex-wrap gap-2 mt-4 cd-actions">

                    {{-- NÚT TRẢ LỜI EMAIL TRONG ADMIN --}}
                    <a href="{{ route('admin.contacts.reply', $contact) }}"
                       class="btn btn-primary cd-btn">

                        <i class="bi bi-send me-1"></i>
                        Trả lời Email
                    </a>

                    {{-- NÚT XEM LỊCH SỬ --}}
                    @if($hasReplied)

                        <a href="{{ route('admin.contacts.reply', $contact) }}"
                           class="btn btn-outline-primary cd-btn">

                            <i class="bi bi-clock-history me-1"></i>
                            Xem lịch sử trả lời
                        </a>

                    @endif

                    {{-- ĐÁNH DẤU CHƯA ĐỌC --}}
                    @if($contact->is_read)

                        <form method="POST"
                              action="{{ route('admin.contacts.unread', $contact) }}">

                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                    class="btn btn-outline-secondary cd-btn">

                                <i class="bi bi-envelope me-1"></i>
                                Đánh dấu chưa đọc
                            </button>

                        </form>

                    @endif

                    {{-- XÓA TIN NHẮN --}}
                    <form method="POST"
                          action="{{ route('admin.contacts.destroy', $contact) }}"
                          onsubmit="return confirm('Bạn chắc chắn muốn xóa tin nhắn này? Lịch sử trả lời liên quan cũng sẽ bị xóa.')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-outline-danger cd-btn">

                            <i class="bi bi-trash3 me-1"></i>
                            Xóa tin nhắn
                        </button>

                    </form>

                </div>

            </article>

        </div>

        {{-- SIDEBAR --}}
        <div class="col-xl-4">

            <aside class="cd-card cd-aside">

                <h2 class="mb-3">

                    <i class="bi bi-info-circle
                              text-primary me-2"></i>

                    Thông tin
                </h2>

                <p class="small mb-3">
                    Tin nhắn được gửi từ biểu mẫu liên hệ
                    trên website Portfolio.
                </p>

                <div class="cd-info mb-3">

                    <div class="cd-info-label">
                        Mã tin nhắn
                    </div>

                    <div class="cd-info-value">
                        #{{ $contact->id }}
                    </div>

                </div>

                <div class="cd-info mb-3">

                    <div class="cd-info-label">
                        Thời gian nhận
                    </div>

                    <div class="cd-info-value">
                        {{ $contact->created_at?->copy()->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') ?? 'Không xác định' }}
                    </div>

                </div>

                {{-- THỐNG KÊ EMAIL TRẢ LỜI --}}
                <h2 class="mt-4 mb-3">

                    <i class="bi bi-envelope-check
                              text-primary me-2"></i>

                    Trạng thái phản hồi
                </h2>

                <div class="cd-reply-status">

                    @if($hasReplied)

                        <div class="d-flex align-items-center gap-2 mb-2">

                            <i class="bi bi-check-circle-fill
                                      text-success fs-5"></i>

                            <span class="fw-semibold text-success">
                                Đã trả lời
                            </span>

                        </div>

                        <p class="small mb-2">
                            Đã gửi thành công
                            <strong>{{ $sentRepliesCount }}</strong>
                            email cho người liên hệ.
                        </p>

                        <a href="{{ route('admin.contacts.reply', $contact) }}"
                           class="btn btn-sm btn-outline-primary">

                            <i class="bi bi-clock-history me-1"></i>
                            Xem lịch sử
                        </a>

                    @else

                        <div class="d-flex align-items-center gap-2 mb-2">

                            <i class="bi bi-clock
                                      text-warning fs-5"></i>

                            <span class="fw-semibold">
                                Chưa trả lời
                            </span>

                        </div>

                        <p class="small mb-3">
                            Chưa có email trả lời nào
                            được gửi thành công.
                        </p>

                        <a href="{{ route('admin.contacts.reply', $contact) }}"
                           class="btn btn-sm btn-primary">

                            <i class="bi bi-reply-fill me-1"></i>
                            Trả lời ngay
                        </a>

                    @endif

                </div>

            </aside>

        </div>

    </div>

</div>
@endsection
