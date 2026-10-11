
@extends('layouts.app')

@section('title', '500 - Lỗi hệ thống | Portfolio')

@push('styles')
<style>
    .error500-page {
        min-height: 70vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 70px 20px;
        background: var(--portfolio-bg, #f8fafc);
    }

    .error500-card {
        width: 100%;
        max-width: 650px;
        padding: 55px 35px;
        text-align: center;
        border-radius: 24px;
        background: var(--portfolio-surface, #fff);
        border: 1px solid var(--portfolio-border, #e2e8f0);
        box-shadow: 0 15px 50px rgba(15, 23, 42, .08);
    }

    .error500-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        background: rgba(239, 68, 68, .10);
        color: #ef4444;
        font-size: 42px;
    }

    .error500-code {
        font-size: clamp(90px, 15vw, 145px);
        font-weight: 900;
        line-height: 1;
        letter-spacing: -5px;
        background: linear-gradient(135deg, #ef4444, #f97316);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .error500-title {
        font-size: 28px;
        font-weight: 800;
        margin-top: 22px;
        color: var(--portfolio-text, #0f172a);
    }

    .error500-description {
        margin: 20px auto 30px;
        max-width: 470px;
        color: var(--portfolio-muted, #64748b);
        line-height: 1.8;
    }

    .error500-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
    }

    .error500-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 13px 24px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all .25s ease;
        cursor: pointer;
    }

    .error500-btn-primary {
        color: #fff;
        background: #2563eb;
        border: 1px solid #2563eb;
    }

    .error500-btn-primary:hover {
        background: #1d4ed8;
        color: #fff;
        transform: translateY(-2px);
    }

    .error500-btn-secondary {
        color: var(--portfolio-text, #0f172a);
        background: transparent;
        border: 1px solid var(--portfolio-border, #cbd5e1);
    }

    .error500-btn-secondary:hover {
        background: rgba(148, 163, 184, .12);
        color: var(--portfolio-text, #0f172a);
    }

    @media (max-width: 576px) {
        .error500-card {
            padding: 40px 20px;
        }

        .error500-title {
            font-size: 23px;
        }
    }
</style>
@endpush

@section('content')
<section class="error500-page">

    <div class="error500-card">

        <div class="error500-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>

        <div class="error500-code">
            500
        </div>

        <h1 class="error500-title">
            Hệ thống đang gặp sự cố!
        </h1>

        <p class="error500-description">
            Rất tiếc, đã xảy ra lỗi trong quá trình
            xử lý yêu cầu của bạn.

            Vui lòng thử lại sau ít phút.
            Nếu sự cố tiếp diễn, hãy liên hệ với
            quản trị viên website.
        </p>

        <div class="error500-actions">

            <a href="{{ url('/') }}"
               class="error500-btn error500-btn-primary">
                <i class="bi bi-house-door-fill"></i>
                Về trang chủ
            </a>

            <button type="button"
                    class="error500-btn error500-btn-secondary"
                    onclick="window.location.reload()">
                <i class="bi bi-arrow-clockwise"></i>
                Thử lại
            </button>

        </div>

    </div>

</section>
@endsection
