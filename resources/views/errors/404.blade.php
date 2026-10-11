
@extends('layouts.app')

@section('title', '404 - Không tìm thấy trang')

@push('styles')
<style>
    .error-page {
        min-height: 65vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 70px 20px;
        text-align: center;
    }

    .error-card {
        max-width: 600px;
        width: 100%;
        padding: 50px 30px;
        border-radius: 24px;
        background: var(--portfolio-surface, #fff);
        border: 1px solid var(--portfolio-border, #e2e8f0);
        box-shadow: 0 15px 50px rgba(15,23,42,.06);
    }

    .error-code {
        font-size: clamp(90px, 15vw, 150px);
        font-weight: 900;
        line-height: 1;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .error-heading {
        margin-top: 20px;
        font-weight: 800;
        color: var(--portfolio-text, #0f172a);
    }

    .error-description {
        color: var(--portfolio-muted, #64748b);
        margin: 18px 0 30px;
        line-height: 1.8;
    }

    .error-home-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 13px 26px;
        border-radius: 12px;
        background: #2563eb;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        transition: .25s;
    }

    .error-home-btn:hover {
        background: #1d4ed8;
        color: #fff;
        transform: translateY(-3px);
    }
</style>
@endpush

@section('content')
<section class="error-page">
    <div class="error-card">

        <div class="error-code">404</div>

        <h1 class="error-heading">
            Không tìm thấy trang!
        </h1>

        <p class="error-description">
            Rất tiếc, trang bạn đang tìm kiếm không tồn tại
            hoặc đã được chuyển sang địa chỉ khác.
        </p>

        <a href="{{ url('/') }}" class="error-home-btn">
            <i class="bi bi-house-door-fill"></i>
            Quay về trang chủ
        </a>

    </div>
</section>
@endsection

