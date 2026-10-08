
@extends('layouts.app')

@section('title', 'Liên hệ | Portfolio')

@section('content')

@php
    // THAY THÔNG TIN CÁ NHÂN TẠI ĐÂY
    $contactEmail = 'vietdp03@gmail.com';
    $contactPhone = '0971 674 160';
    $contactLocation = 'Hà Nội, Việt Nam';

    // DÁN LINK FACEBOOK CỦA BẠN VÀO ĐÂY
    $facebookUrl = 'https://www.facebook.com/doquocviet.03';
@endphp

<style>
    .contact-page .contact-hero {
        background: linear-gradient(135deg, #0b1220, #172554, #312e81);
        color: #fff;
        border-radius: 24px;
        padding: 65px 30px;
        text-align: center;
        margin: 30px 0 45px;
    }

    .contact-page .hero-label {
        display: inline-block;
        padding: 8px 18px;
        border-radius: 30px;
        background: rgba(59,130,246,.18);
        color: #93c5fd;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 18px;
    }

    .contact-page .hero-title {
        font-size: clamp(32px, 5vw, 48px);
        font-weight: 800;
        margin-bottom: 18px;
    }

    .contact-page .hero-description {
        color: #cbd5e1;
        max-width: 650px;
        margin: auto;
        line-height: 1.9;
    }

    .contact-page .contact-info {
        background: #0f172a;
        color: #fff;
        border-radius: 22px;
        padding: 35px;
        height: 100%;
    }

    .contact-page .contact-info h2,
    .contact-page .contact-form-card h2 {
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 15px;
    }

    .contact-page .info-description {
        color: #94a3b8;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .contact-page .contact-item {
        display: flex;
        gap: 15px;
        align-items: center;
        margin-bottom: 25px;
    }

    .contact-page .contact-icon {
        width: 50px;
        height: 50px;
        flex-shrink: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #1e3a5f;
        color: #93c5fd;
        border-radius: 14px;
        font-size: 22px;
    }

    .contact-page .contact-item-label {
        font-size: 13px;
        color: #94a3b8;
        margin-bottom: 4px;
    }

    .contact-page .contact-item-value {
        color: #fff;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    /* FACEBOOK */

    .contact-page .facebook-section {
        margin-top: 35px;
        border-top: 1px solid #334155;
        padding-top: 28px;
    }

    .contact-page .facebook-section h3 {
        font-size: 19px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .contact-page .facebook-button {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        background: #1877f2;
        color: white;
        text-decoration: none;
        padding: 15px 20px;
        border-radius: 12px;
        font-weight: 700;
        transition: all .3s ease;
    }

    .contact-page .facebook-button:hover {
        background: #0866d6;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(24,119,242,.25);
    }

    .contact-page .facebook-button i {
        font-size: 24px;
    }

    /* FORM */

    .contact-page .contact-form-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 35px;
        height: 100%;
        box-shadow: 0 10px 35px rgba(15,23,42,.04);
    }

    .contact-page .form-description {
        color: #64748b;
        line-height: 1.8;
        margin-bottom: 28px;
    }

    .contact-page .form-label {
        font-weight: 600;
        color: #334155;
        margin-bottom: 9px;
    }

    .contact-page .form-control {
        border-radius: 11px;
        padding: 13px 15px;
        border: 1px solid #cbd5e1;
        background: #f8fafc;
    }

    .contact-page .form-control:focus {
        background: #fff;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59,130,246,.12);
    }

    .contact-page textarea.form-control {
        min-height: 160px;
        resize: vertical;
    }

    .contact-page .submit-button {
        background: linear-gradient(135deg, #2563eb, #4f46e5);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 15px 22px;
        font-weight: 700;
        width: 100%;
        transition: all .3s ease;
    }

    .contact-page .submit-button:hover {
        background: linear-gradient(135deg, #1d4ed8, #4338ca);
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(37,99,235,.2);
    }

    .contact-page .contact-bottom {
        background: #eff6ff;
        border-radius: 20px;
        padding: 35px;
        margin-top: 50px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .contact-page .contact-hero {
            padding: 45px 20px;
            border-radius: 16px;
        }

        .contact-page .contact-info,
        .contact-page .contact-form-card {
            padding: 25px;
        }
    }
</style>

<div class="container contact-page pb-5">

    <!-- HEADER -->
    <section class="contact-hero">

        <span class="hero-label">
            GET IN TOUCH
        </span>

        <h1 class="hero-title">
            Liên hệ với tôi
        </h1>

        <p class="hero-description">
            Bạn có câu hỏi, muốn trao đổi về dự án
            hoặc chia sẻ những ý tưởng công nghệ?
            Hãy kết nối với tôi qua Facebook
            hoặc gửi tin nhắn trực tiếp tại đây.
        </p>

    </section>

    <div class="row g-4">

        <!-- THÔNG TIN LIÊN HỆ -->
        <div class="col-lg-5">

            <div class="contact-info">

                <h2>
                    Thông tin liên hệ
                </h2>

                <p class="info-description">
                    Bạn có thể liên hệ với tôi thông qua
                    những kênh bên dưới.
                </p>

                <!-- EMAIL -->
                <div class="contact-item">

                    <div class="contact-icon">
                        <i class="bi bi-envelope"></i>
                    </div>

                    <div>
                        <div class="contact-item-label">
                            Email
                        </div>

                        <div class="contact-item-value">
                            {{ $contactEmail }}
                        </div>
                    </div>

                </div>

                <!-- PHONE -->
                <div class="contact-item">

                    <div class="contact-icon">
                        <i class="bi bi-telephone"></i>
                    </div>

                    <div>
                        <div class="contact-item-label">
                            Điện thoại
                        </div>

                        <div class="contact-item-value">
                            {{ $contactPhone }}
                        </div>
                    </div>

                </div>

                <!-- LOCATION -->
                <div class="contact-item">

                    <div class="contact-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>

                    <div>
                        <div class="contact-item-label">
                            Nơi ở
                        </div>

                        <div class="contact-item-value">
                            {{ $contactLocation }}
                        </div>
                    </div>

                </div>

                <!-- FACEBOOK -->
                <div class="facebook-section">

                    <h3>
                        <i class="bi bi-share me-2"></i>
                        Kết nối mạng xã hội
                    </h3>

                    <p class="info-description mb-3">
                        Theo dõi hoặc nhắn tin cho tôi
                        thông qua Facebook.
                    </p>

                    <a href="{{ $facebookUrl }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="facebook-button">

                        <i class="bi bi-facebook"></i>

                        <span>
                            Truy cập Facebook của tôi
                        </span>

                        <i class="bi bi-arrow-up-right"
                           style="font-size:16px"></i>

                    </a>

                </div>

            </div>

        </div>

        <!-- FORM LIÊN HỆ -->
        <div class="col-lg-7">

            <div class="contact-form-card">

                <h2>
                    <i class="bi bi-send text-primary me-2"></i>
                    Gửi tin nhắn
                </h2>

                <p class="form-description">
                    Điền thông tin vào biểu mẫu dưới đây
                    để gửi lời nhắn đến tôi.
                </p>

                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Vui lòng kiểm tra lại thông tin đã nhập.
                    </div>
                @endif

                <form action="{{ route('contact.store') }}"
                      method="POST">

                    @csrf

                    <!-- NAME -->
                    <div class="mb-3">

                        <label for="name" class="form-label">
                            Họ và tên <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Nhập họ và tên"
                               value="{{ old('name') }}"
                               maxlength="255"
                               required>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">

                        <label for="email" class="form-label">
                            Email <span class="text-danger">*</span>
                        </label>

                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="example@gmail.com"
                               value="{{ old('email') }}"
                               maxlength="255"
                               required>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- SUBJECT -->
                    <div class="mb-3">

                        <label for="subject" class="form-label">
                            Tiêu đề
                        </label>

                        <input type="text"
                               id="subject"
                               name="subject"
                               class="form-control @error('subject') is-invalid @enderror"
                               placeholder="Nhập tiêu đề tin nhắn"
                               value="{{ old('subject') }}"
                               maxlength="255">

                        @error('subject')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- MESSAGE -->
                    <div class="mb-4">

                        <label for="message" class="form-label">
                            Nội dung <span class="text-danger">*</span>
                        </label>

                        <textarea id="message"
                                  name="message"
                                  class="form-control @error('message') is-invalid @enderror"
                                  placeholder="Nhập nội dung bạn muốn gửi..."
                                  required>{{ old('message') }}</textarea>

                        @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <button type="submit"
                            class="submit-button">

                        <i class="bi bi-send-fill me-2"></i>
                        Gửi tin nhắn

                    </button>

                </form>

            </div>

        </div>

    </div>

    <!-- BOTTOM SECTION -->
    <section class="contact-bottom">

        <h3 class="fw-bold mb-3">
            Cảm ơn bạn đã ghé thăm Portfolio!
        </h3>

        <p class="text-muted mb-4">
            Hãy khám phá thêm các dự án và kỹ năng
            mà tôi đã phát triển trong quá trình học tập.
        </p>

        <a href="{{ url('/projects') }}"
           class="btn btn-primary px-4">

            <i class="bi bi-folder2-open me-2"></i>
            Xem dự án

        </a>

    </section>

</div>

@endsection
