@extends('layouts.admin')

@section('title', 'Thêm dự án')
@section('page_title', 'Thêm dự án mới')

@push('styles')
<style>
.project-create {
    --pc-bg: #ffffff;
    --pc-text: #0f172a;
    --pc-muted: #64748b;
    --pc-border: #e2e8f0;
    --pc-soft: #f8fafc;
    --pc-input: #ffffff;
    color: var(--pc-text);
}
html[data-theme="dark"] .project-create,
html[data-bs-theme="dark"] .project-create,
body.dark-mode .project-create {
    --pc-bg: #17243a;
    --pc-text: #f1f5f9;
    --pc-muted: #b8c6d8;
    --pc-border: #354760;
    --pc-soft: #1d2d45;
    --pc-input: #122036;
}
.project-create .pc-panel { background: var(--pc-bg); border: 1px solid var(--pc-border); border-radius: 20px; padding: clamp(20px, 3vw, 32px); box-shadow: 0 8px 28px rgba(15,23,42,.04); }
.project-create .pc-heading, .project-create .pc-section-title, .project-create .form-label { color: var(--pc-text); }
.project-create .pc-heading { font-weight: 800; letter-spacing: -.025em; }
.project-create .pc-muted { color: var(--pc-muted) !important; }
.project-create .pc-section-title { font-size: 18px; font-weight: 800; margin-bottom: 6px; }
.project-create .pc-section-note { color: var(--pc-muted); font-size: 14px; margin-bottom: 23px; }
.project-create .pc-divider { border: 0; border-top: 1px solid var(--pc-border); opacity: 1; margin: 30px 0; }
.project-create .form-label { font-weight: 650; margin-bottom: 9px; }
.project-create .form-control { background: var(--pc-input); border: 1px solid var(--pc-border); color: var(--pc-text); border-radius: 12px; padding: 11px 14px; }
.project-create .form-control::placeholder { color: var(--pc-muted); opacity: .8; }
.project-create .form-control:focus { background: var(--pc-input); color: var(--pc-text); border-color: #60a5fa; box-shadow: 0 0 0 3px rgba(59,130,246,.16); }
.project-create .form-control.is-invalid { border-color: #dc3545; }
.project-create .form-text { color: var(--pc-muted); }
.project-create textarea.form-control { min-height: 110px; resize: vertical; }
.project-create .pc-preview { display: none; max-width: 100%; max-height: 260px; object-fit: contain; border-radius: 14px; border: 1px solid var(--pc-border); margin-top: 15px; background: var(--pc-soft); }
.project-create .pc-preview.show { display: block; }
.project-create .pc-actions { display: flex; flex-wrap: wrap; gap: 12px; padding-top: 25px; border-top: 1px solid var(--pc-border); margin-top: 30px; }
.project-create .pc-actions .btn { border-radius: 11px; padding: 11px 22px; font-weight: 650; }
.project-create .pc-cancel { background: var(--pc-soft); color: var(--pc-text); border: 1px solid var(--pc-border); }
.project-create .pc-cancel:hover { color: var(--pc-text); border-color: #60a5fa; background: var(--pc-soft); }
.project-create .pc-back { border: 1px solid var(--pc-border); color: var(--pc-text); background: var(--pc-bg); border-radius: 11px; padding: 10px 16px; text-decoration: none; font-weight: 650; }
.project-create .pc-back:hover { color: #3b82f6; border-color: #60a5fa; }
.project-create .pc-required { color: #e11d48; }
</style>
@endpush

@section('content')
<div class="project-create container-fluid px-0">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 pc-heading mb-1">Thêm dự án mới</h1>
            <p class="pc-muted mb-0">Điền thông tin để giới thiệu dự án trên Portfolio.</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="pc-back"><i class="bi bi-arrow-left me-2"></i>Quay lại danh sách</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger rounded-3" role="alert">
            <div class="fw-semibold mb-1"><i class="bi bi-exclamation-triangle me-2"></i>Vui lòng kiểm tra lại thông tin.</div>
            <ul class="mb-0 ps-4">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="pc-panel">
        @csrf

        <section aria-labelledby="basic-title">
            <h2 id="basic-title" class="pc-section-title"><i class="bi bi-info-circle text-primary me-2"></i>Thông tin cơ bản</h2>
            <p class="pc-section-note">Tên, mô tả và các công nghệ đã sử dụng.</p>

            <div class="mb-4">
                <label for="title" class="form-label">Tên dự án <span class="pc-required" aria-label="bắt buộc">*</span></label>
                <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Ví dụ: Hệ thống quản lý khóa học" required maxlength="255">
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label for="description" class="form-label">Mô tả dự án <span class="pc-required" aria-label="bắt buộc">*</span></label>
                <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Giới thiệu mục tiêu, chức năng và giá trị của dự án..." required>{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div>
                <label for="technologies" class="form-label">Công nghệ sử dụng</label>
                <input id="technologies" name="technologies" type="text" class="form-control @error('technologies') is-invalid @enderror" value="{{ old('technologies') }}" placeholder="Laravel, PHP, MySQL, Bootstrap">
                <div class="form-text">Phân cách các công nghệ bằng dấu phẩy.</div>
                @error('technologies')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </section>

        <hr class="pc-divider">

        <section aria-labelledby="details-title">
            <h2 id="details-title" class="pc-section-title"><i class="bi bi-card-checklist text-primary me-2"></i>Nội dung chi tiết</h2>
            <p class="pc-section-note">Thông tin hiển thị tại trang chi tiết dự án.</p>
            <div class="mb-4">
                <label for="features" class="form-label">Các chức năng chính</label>
                <textarea id="features" name="features" rows="5" class="form-control @error('features') is-invalid @enderror" placeholder="Quản lý dự án, đăng nhập, tìm kiếm...">{{ old('features') }}</textarea>
                @error('features')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label for="challenges" class="form-label">Khó khăn và giải pháp</label>
                <textarea id="challenges" name="challenges" rows="4" class="form-control @error('challenges') is-invalid @enderror" placeholder="Những vấn đề gặp phải và cách xử lý...">{{ old('challenges') }}</textarea>
                @error('challenges')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div>
                <label for="results" class="form-label">Kết quả đạt được</label>
                <textarea id="results" name="results" rows="4" class="form-control @error('results') is-invalid @enderror" placeholder="Kết quả, kiến thức và kinh nghiệm thu được...">{{ old('results') }}</textarea>
                @error('results')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </section>

        <hr class="pc-divider">

        <section aria-labelledby="links-title">
            <h2 id="links-title" class="pc-section-title"><i class="bi bi-link-45deg text-primary me-2"></i>Liên kết dự án</h2>
            <p class="pc-section-note">Có thể để trống nếu chưa có mã nguồn công khai hoặc bản demo.</p>
            <div class="row g-4">
                <div class="col-md-6">
                    <label for="github_url" class="form-label">GitHub URL</label>
                    <input id="github_url" name="github_url" type="url" class="form-control @error('github_url') is-invalid @enderror" value="{{ old('github_url') }}" placeholder="https://github.com/username/repository">
                    @error('github_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="demo_url" class="form-label">Demo URL</label>
                    <input id="demo_url" name="demo_url" type="url" class="form-control @error('demo_url') is-invalid @enderror" value="{{ old('demo_url') }}" placeholder="https://example.com">
                    @error('demo_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </section>

        <hr class="pc-divider">

        <section aria-labelledby="image-title">
            <h2 id="image-title" class="pc-section-title"><i class="bi bi-image text-primary me-2"></i>Hình ảnh dự án</h2>
            <p class="pc-section-note">Ảnh đại diện sẽ hiển thị ở danh sách và trang chi tiết dự án.</p>
            <label for="image" class="form-label">Tải ảnh lên</label>
            <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="form-control @error('image') is-invalid @enderror" aria-describedby="imageHelp">
            <div id="imageHelp" class="form-text">Hỗ trợ JPG, PNG, WEBP. Tối đa 2 MB (theo quy tắc validation hiện tại).</div>
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <img id="imagePreview" class="pc-preview" alt="Xem trước ảnh dự án">
        </section>

        <div class="pc-actions">
            <button type="submit" class="btn btn-primary"><i class="bi bi-check2-circle me-2"></i>Lưu dự án</button>
            <a href="{{ route('admin.projects.index') }}" class="btn pc-cancel">Hủy bỏ</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('image');
    const preview = document.getElementById('imagePreview');
    if (!input || !preview) return;
    let objectUrl = null;
    input.addEventListener('change', function () {
        if (objectUrl) { URL.revokeObjectURL(objectUrl); objectUrl = null; }
        preview.classList.remove('show');
        preview.removeAttribute('src');
        const file = input.files && input.files[0];
        if (!file || !['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) return;
        objectUrl = URL.createObjectURL(file);
        preview.src = objectUrl;
        preview.classList.add('show');
    });
    window.addEventListener('pagehide', function () {
        if (objectUrl) URL.revokeObjectURL(objectUrl);
    });
});
</script>
@endpush
