@extends('layouts.app')

@section('title', 'Liên hệ | Portfolio')
@section('meta_description', 'Liên hệ để trao đổi về công nghệ, các dự án lập trình, cơ hội hợp tác và công việc trong lĩnh vực Công nghệ thông tin.')

@push('styles')
<style>
.contact-modern {
    --ct-surface: #ffffff;
    --ct-text: #0f172a;
    --ct-muted: #64748b;
    --ct-border: #e2e8f0;
    --ct-soft: #eff6ff;
    color: var(--ct-text);
}
html[data-theme="dark"] .contact-modern,
html[data-bs-theme="dark"] .contact-modern {
    --ct-surface: #111c30;
    --ct-text: #f1f5f9;
    --ct-muted: #a6b5cb;
    --ct-border: #30415c;
    --ct-soft: #1b2e4c;
}
.contact-modern .ct-hero {
    margin: 30px 0 55px;
    padding: clamp(50px, 8vw, 88px) 24px;
    text-align: center;
    border-radius: 26px;
    color: #fff;
    background: radial-gradient(circle at 85% 5%, rgba(96,165,250,.25), transparent 35%),
                linear-gradient(125deg,#0b1220,#172554 60%,#312e81);
}
.contact-modern .ct-eyebrow {
    display: inline-block;
    padding: 8px 18px;
    border: 1px solid rgba(191,219,254,.4);
    background: rgba(255,255,255,.08);
    color: #bfdbfe;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .12em;
}
.contact-modern .ct-hero h1 {
    font-size: clamp(34px,5vw,54px);
    font-weight: 800;
    letter-spacing: -.03em;
    margin: 20px 0 15px;
}
.contact-modern .ct-hero p {
    color: #cbd5e1;
    line-height: 1.85;
    max-width: 650px;
    margin: 0 auto;
}
.contact-modern .ct-card {
    background: var(--ct-surface);
    border: 1px solid var(--ct-border);
    border-radius: 22px;
    padding: clamp(22px,3vw,34px);
    height: 100%;
    box-shadow: 0 8px 30px rgba(15,23,42,.04);
}
.contact-modern .ct-card h2 {
    font-size: 23px;
    font-weight: 800;
    margin-bottom: 25px;
    color: var(--ct-text);
}
.contact-modern .ct-muted { color: var(--ct-muted); }
.contact-modern .ct-info {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    margin-bottom: 24px;
}
.contact-modern .ct-icon {
    width: 50px;
    height: 50px;
    flex: 0 0 50px;
    border-radius: 14px;
    background: #dbeafe;
    color: #1d4ed8;
    display: grid;
    place-items: center;
    font-size: 21px;
}
.contact-modern .ct-info h3 {
    font-size: 15px;
    font-weight: 750;
    margin: 2px 0 6px;
    color: var(--ct-text);
}
.contact-modern .ct-info p {
    margin: 0;
    color: var(--ct-muted);
    overflow-wrap: anywhere;
}
.contact-modern .ct-info a { overflow-wrap: anywhere; }
.contact-modern .ct-social {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.contact-modern .ct-social a {
    width: 46px;
    height: 46px;
    display: grid;
    place-items: center;
    border-radius: 12px;
    background: var(--ct-soft);
    border: 1px solid var(--ct-border);
    color: #2563eb;
    font-size: 20px;
    text-decoration: none;
    transition: transform .2s ease, background .2s ease;
}
html[data-theme="dark"] .contact-modern .ct-social a,
html[data-bs-theme="dark"] .contact-modern .ct-social a { color: #93c5fd; }
.contact-modern .ct-social a:hover {
    background: #2563eb;
    color: white !important;
    transform: translateY(-3px);
}
.contact-modern .ct-form label {
    color: var(--ct-text);
    font-weight: 650;
    margin-bottom: 8px;
}
.contact-modern .ct-form .form-control {
    background: var(--ct-surface);
    color: var(--ct-text);
    border: 1px solid var(--ct-border);
    border-radius: 12px;
    padding: 12px 14px;
}
.contact-modern .ct-form .form-control::placeholder { color: var(--ct-muted); opacity: .85; }
.contact-modern .ct-form .form-control:focus {
    border-color: #60a5fa;
    box-shadow: 0 0 0 .2rem rgba(37,99,235,.12);
}
.contact-modern .ct-form textarea { resize: vertical; min-height: 155px; }
.contact-modern .ct-submit {
    padding: 13px 22px;
    border-radius: 12px;
    font-weight: 750;
}
.contact-modern .ct-cv {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    padding: 13px 18px;
    border-radius: 12px;
    background: #2563eb;
    color: #fff;
    font-weight: 750;
    text-decoration: none;
}
.contact-modern .ct-cv:hover { background: #1d4ed8; color: #fff; }
.contact-modern .ct-divider { border-color: var(--ct-border); opacity: 1; }
.contact-modern .ct-note {
    background: var(--ct-soft);
    border: 1px solid var(--ct-border);
    border-radius: 13px;
    padding: 16px;
    color: var(--ct-muted);
    line-height: 1.7;
}
@media (max-width: 767.98px) {
    .contact-modern .ct-hero { margin-top: 18px; margin-bottom: 35px; border-radius: 18px; }
}
@media (prefers-reduced-motion: reduce) {
    .contact-modern .ct-social a { transition: none; }
    .contact-modern .ct-social a:hover { transform: none; }
}
</style>
@endpush

@section('content')
<div class="container contact-modern pb-5">
    <header class="ct-hero">
        <span class="ct-eyebrow">LET'S CONNECT</span>
        <h1>Liên hệ với tôi</h1>
        <p>Bạn có câu hỏi, ý tưởng dự án hoặc muốn trao đổi về công nghệ?
           Hãy để lại tin nhắn qua biểu mẫu bên dưới.</p>
    </header>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="status">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    <div class="row g-4">
        <aside class="col-lg-5">
            <section class="ct-card">
                <h2><i class="bi bi-person-lines-fill text-primary me-2"></i>Thông tin liên hệ</h2>

                @if($profile?->contact_email)
                    <div class="ct-info">
                        <span class="ct-icon"><i class="bi bi-envelope"></i></span>
                        <div>
                            <h3>Email</h3>
                            <p><a href="mailto:{{ $profile->contact_email }}" class="text-decoration-none">{{ $profile->contact_email }}</a></p>
                        </div>
                    </div>
                @endif
                @if($profile?->phone)
    <div class="ct-info">
        <span class="ct-icon">
            <i class="bi bi-telephone"></i>
        </span>

        <div>
            <h3>Số điện thoại</h3>
            <p>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $profile->phone) }}"
                   class="text-decoration-none">
                    {{ $profile->phone }}
                </a>
            </p>
        </div>
    </div>
@endif
                @if($profile?->location)
                    <div class="ct-info">
                        <span class="ct-icon"><i class="bi bi-geo-alt"></i></span>
                        <div>
                            <h3>Khu vực</h3>
                            <p>{{ $profile->location }}</p>
                        </div>
                    </div>
                @endif

                @if($profile?->job_title)
                    <div class="ct-info">
                        <span class="ct-icon"><i class="bi bi-briefcase"></i></span>
                        <div>
                            <h3>Chuyên môn</h3>
                            <p>{{ $profile->job_title }}</p>
                        </div>
                    </div>
                @endif

                <hr class="ct-divider my-4">

                <h3 class="h6 fw-bold mb-3">Kết nối qua mạng xã hội</h3>
                <div class="ct-social">
                    @if($profile?->github_url)
                        <a href="{{ $profile->github_url }}" target="_blank" rel="noopener noreferrer"
                           title="GitHub" aria-label="GitHub"><i class="bi bi-github"></i></a>
                    @endif
                    @if($profile?->facebook_url)
                        <a href="{{ $profile->facebook_url }}" target="_blank" rel="noopener noreferrer"
                           title="Facebook" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if($profile?->linkedin_url)
                        <a href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener noreferrer"
                           title="LinkedIn" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    @endif
                </div>

                @if($profile?->cv_path)
                    <div class="mt-4">
                        <a href="{{ route('cv.download') }}" class="ct-cv">
                            <i class="bi bi-file-earmark-arrow-down"></i> Tải CV PDF
                        </a>
                        <p class="ct-muted text-center small mt-2 mb-0">Hồ sơ năng lực dưới dạng PDF.</p>
                    </div>
                @endif

                <div class="ct-note mt-4">
                    <i class="bi bi-chat-dots me-2"></i>
                    Bạn cũng có thể gửi tin nhắn trực tiếp bằng biểu mẫu bên cạnh.
                </div>
            </section>
        </aside>

        <div class="col-lg-7">
            <section class="ct-card">
                <h2><i class="bi bi-send text-primary me-2"></i>Gửi tin nhắn</h2>

                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Vui lòng kiểm tra thông tin:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="ct-form">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="contact-name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                            <input id="contact-name" type="text" name="name"
                                   value="{{ old('name') }}" maxlength="255" autocomplete="name"
                                   placeholder="Nhập họ và tên"
                                   class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="contact-email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input id="contact-email" type="email" name="email"
                                   value="{{ old('email') }}" maxlength="255" autocomplete="email"
                                   placeholder="example@gmail.com"
                                   class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="contact-subject" class="form-label">Chủ đề <span class="text-danger">*</span></label>
                            <input id="contact-subject" type="text" name="subject"
                                   value="{{ old('subject') }}" maxlength="255"
                                   placeholder="Nhập chủ đề liên hệ"
                                   class="form-control @error('subject') is-invalid @enderror" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="contact-message" class="form-label">Nội dung <span class="text-danger">*</span></label>
                            <textarea id="contact-message" name="message" rows="7" maxlength="5000"
                                      placeholder="Nhập nội dung tin nhắn..."
                                      class="form-control @error('message') is-invalid @enderror"
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary ct-submit w-100">
                                <i class="bi bi-send me-2"></i> Gửi tin nhắn
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection
