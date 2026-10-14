@extends('layouts.admin')

@section('title', 'Trả lời Email')
@section('page_title', 'Trả lời Email')

@push('styles')
<style>
    .reply-page { max-width: 1150px; margin: 0 auto; }
    .reply-card { background: var(--bs-body-bg); border: 1px solid var(--bs-border-color); border-radius: 18px; overflow: hidden; margin-bottom: 24px; }
    .reply-card-header { padding: 20px 24px; border-bottom: 1px solid var(--bs-border-color); }
    .reply-card-body { padding: 24px; }
    .reply-input { border-radius: 10px; padding: 12px 14px; }
    .reply-message, .reply-history-body { white-space: pre-wrap; overflow-wrap: anywhere; line-height: 1.7; }
    .reply-message { background: var(--bs-tertiary-bg); border: 1px solid var(--bs-border-color); border-radius: 12px; padding: 18px; }
    .reply-history-item { border: 1px solid var(--bs-border-color); border-radius: 12px; padding: 20px; margin-bottom: 16px; }
    .reply-history-item:last-child { margin-bottom: 0; }
    .reply-history-item.status-sent { border-left: 4px solid var(--bs-success); }
    .reply-history-item.status-failed { border-left: 4px solid var(--bs-danger); }
    .reply-history-item.status-pending { border-left: 4px solid var(--bs-warning); }
    .reply-meta { background: var(--bs-tertiary-bg); border-radius: 10px; padding: 14px; }
    .reply-meta-label { font-size: .8rem; color: var(--bs-secondary-color); margin-bottom: 3px; }
    .reply-meta-value { overflow-wrap: anywhere; }
    .reply-stat { border: 1px solid var(--bs-border-color); border-radius: 12px; padding: 15px; height: 100%; }
    @media (max-width: 768px) { .reply-card-header, .reply-card-body { padding: 16px; } .reply-history-item { padding: 15px; } }
</style>
@endpush

@section('content')
<div class="reply-page">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-reply-fill me-2"></i>Trả lời Email</h4>
            <p class="text-body-secondary mb-0">Soạn phản hồi và theo dõi lịch sử Email của liên hệ này.</p>
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary rounded-3">
            <i class="bi bi-arrow-left me-1"></i>Quay lại danh sách
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Vui lòng kiểm tra lại thông tin:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="reply-card">
        <div class="reply-card-header">
            <h5 class="fw-semibold mb-0"><i class="bi bi-envelope-open me-2 text-primary"></i>Tin nhắn của khách</h5>
        </div>
        <div class="reply-card-body">
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="text-body-secondary small mb-1">Người gửi</div>
                    <div class="fw-semibold">{{ $contact->name }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-body-secondary small mb-1">Email liên hệ</div>
                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                </div>
                <div class="col-md-8">
                    <div class="text-body-secondary small mb-1">Tiêu đề</div>
                    <div class="fw-semibold">{{ $contact->subject ?: 'Liên hệ từ Portfolio' }}</div>
                </div>
                <div class="col-md-4">
                    <div class="text-body-secondary small mb-1">Thời gian nhận (Việt Nam)</div>
                    <div>{{ $contact->created_at?->copy()->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') ?? 'Không xác định' }}</div>
                </div>
            </div>
            <div class="reply-message">{{ $contact->message }}</div>
        </div>
    </div>

    <div class="reply-card">
        <div class="reply-card-header">
            <h5 class="fw-semibold mb-0"><i class="bi bi-pencil-square me-2 text-primary"></i>Soạn Email trả lời</h5>
        </div>
        <div class="reply-card-body">
            <form id="contactReplyForm" action="{{ route('admin.contacts.reply.store', $contact) }}" method="POST">
                @csrf
                <input type="hidden" name="submission_token" value="{{ old('submission_token', (string) \Illuminate\Support\Str::uuid()) }}">
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="replyRecipient">Người nhận</label>
                    <input id="replyRecipient" type="email" class="form-control reply-input" value="{{ $contact->email }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="replySubject" class="form-label fw-semibold">Tiêu đề Email <span class="text-danger">*</span></label>
                    <input type="text" name="subject" id="replySubject" maxlength="255" required
                           class="form-control reply-input @error('subject') is-invalid @enderror"
                           value="{{ old('subject', 'Re: ' . ($contact->subject ?: 'Liên hệ từ Portfolio')) }}">
                    @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label for="replyBody" class="form-label fw-semibold">Nội dung trả lời <span class="text-danger">*</span></label>
                    <textarea name="body" id="replyBody" rows="10" maxlength="20000" required
                              class="form-control reply-input @error('body') is-invalid @enderror"
                              placeholder="Nhập nội dung trả lời khách hàng...">{{ old('body') }}</textarea>
                    @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <div class="form-text">Nội dung sẽ được gửi tới email người liên hệ.</div>
                </div>
                <div class="d-flex flex-wrap justify-content-end gap-2">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary px-4">Hủy</a>
                    <button type="submit" id="sendReplyButton" class="btn btn-primary px-4">
                        <i class="bi bi-send me-2"></i>Gửi Email
                    </button>
                </div>
            </form>
        </div>
    </div>

    @php
        $sentCount = $replies->where('status', 'sent')->count();
        $failedCount = $replies->where('status', 'failed')->count();
        $pendingCount = $replies->count() - $sentCount - $failedCount;
    @endphp

    <div class="reply-card">
        <div class="reply-card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h5 class="fw-semibold mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Lịch sử trả lời Email</h5>
            <span class="badge text-bg-secondary">{{ $replies->count() }} Email</span>
        </div>
        <div class="reply-card-body">
            <div class="row g-3 mb-4">
                <div class="col-6 col-lg-3"><div class="reply-stat"><div class="text-body-secondary small">Tổng Email</div><div class="fs-4 fw-bold">{{ $replies->count() }}</div></div></div>
                <div class="col-6 col-lg-3"><div class="reply-stat"><div class="text-success small">Đã gửi</div><div class="fs-4 fw-bold">{{ $sentCount }}</div></div></div>
                <div class="col-6 col-lg-3"><div class="reply-stat"><div class="text-danger small">Thất bại</div><div class="fs-4 fw-bold">{{ $failedCount }}</div></div></div>
                <div class="col-6 col-lg-3"><div class="reply-stat"><div class="text-warning-emphasis small">Đang chờ</div><div class="fs-4 fw-bold">{{ $pendingCount }}</div></div></div>
            </div>

            @forelse($replies as $reply)
                @php
                    $replyStatus = in_array($reply->status, ['sent', 'failed'], true) ? $reply->status : 'pending';
                    $createdTime = $reply->created_at?->copy()->timezone('Asia/Ho_Chi_Minh');
                    $sentTime = $reply->sent_at?->copy()->timezone('Asia/Ho_Chi_Minh');
                @endphp
                <article class="reply-history-item status-{{ $replyStatus }}">
                    <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
                        <div>
                            <div class="fw-bold">{{ $reply->subject }}</div>
                            <div class="small text-body-secondary mt-1">Email #{{ $reply->id }}</div>
                        </div>
                        @if($replyStatus === 'sent')
                            <span class="badge text-bg-success"><i class="bi bi-check-circle me-1"></i>Đã gửi</span>
                        @elseif($replyStatus === 'failed')
                            <span class="badge text-bg-danger"><i class="bi bi-x-circle me-1"></i>Gửi thất bại</span>
                        @else
                            <span class="badge text-bg-warning"><i class="bi bi-hourglass-split me-1"></i>Đang chờ xử lý</span>
                        @endif
                    </div>

                    <div class="reply-meta mb-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="reply-meta-label"><i class="bi bi-person-badge me-1"></i>Admin gửi</div>
                                <div class="reply-meta-value fw-semibold">{{ $reply->admin?->name ?? 'Không xác định' }}</div>
                                @if($reply->admin?->email)
                                    <div class="reply-meta-value small text-body-secondary">{{ $reply->admin->email }}</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="reply-meta-label"><i class="bi bi-envelope me-1"></i>Người nhận</div>
                                <div class="reply-meta-value">{{ $reply->recipient_email }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="reply-meta-label"><i class="bi bi-calendar-plus me-1"></i>Thời gian tạo (Việt Nam)</div>
                                <div class="reply-meta-value">{{ $createdTime?->format('d/m/Y H:i:s') ?? 'Không xác định' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="reply-meta-label"><i class="bi bi-calendar-check me-1"></i>Thời gian gửi thành công (Việt Nam)</div>
                                <div class="reply-meta-value">
                                    @if($replyStatus === 'sent' && $sentTime)
                                        {{ $sentTime->format('d/m/Y H:i:s') }}
                                    @elseif($replyStatus === 'failed')
                                        Chưa gửi thành công
                                    @else
                                        Chưa có thời gian gửi thành công
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="small text-body-secondary fw-semibold mb-2">Nội dung Email</div>
                    <div class="reply-history-body">{{ $reply->body }}</div>

                    @if($replyStatus === 'failed')
                        <div class="alert alert-danger mt-3 mb-0 py-2" role="status">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Email này chưa được xác nhận gửi thành công. Hãy kiểm tra hộp thư đã gửi trước khi thử lại để tránh gửi trùng.
                        </div>
                        <form method="POST"
                              action="{{ route('admin.contacts.reply.retry', ['contact' => $contact, 'reply' => $reply]) }}"
                              class="retry-email-form mt-3"
                              onsubmit="return confirm('Bạn đã kiểm tra hộp thư đã gửi và muốn thử gửi lại Email này?');">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm retry-email-button">
                                <i class="bi bi-arrow-clockwise me-1"></i>Gửi lại Email thất bại
                            </button>
                        </form>
                    @endif
                </article>
            @empty
                <div class="text-center py-4">
                    <i class="bi bi-envelope-paper fs-1 text-body-secondary"></i>
                    <p class="text-body-secondary mt-3 mb-0">Chưa có Email trả lời nào.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('contactReplyForm');
    const button = document.getElementById('sendReplyButton');
    document.querySelectorAll('.retry-email-form').forEach(function (retryForm) {
        retryForm.addEventListener('submit', function (event) {
            const retryButton = retryForm.querySelector('.retry-email-button');
            if (!retryButton) return;
            if (retryButton.disabled) {
                event.preventDefault();
                return;
            }
            retryButton.disabled = true;
            retryButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Đang gửi lại...';
        });
    });

    if (!form || !button) return;

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) return;
        if (button.disabled) {
            event.preventDefault();
            return;
        }
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Đang gửi Email...';
    });
});
</script>
@endpush
