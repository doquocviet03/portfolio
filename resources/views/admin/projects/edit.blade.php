@extends('layouts.admin')

@section('title', 'Chỉnh sửa dự án')
@section('page_title', 'Chỉnh sửa dự án')

@push('styles')
<style>
.project-edit-page {
    --pe-surface: #ffffff;
    --pe-text: #0f172a;
    --pe-muted: #64748b;
    --pe-border: #dbe3ef;
    --pe-soft: #f8fafc;
    color: var(--pe-text);
}
html[data-theme="dark"] .project-edit-page,
html[data-bs-theme="dark"] .project-edit-page,
body.dark-mode .project-edit-page {
    --pe-surface: #17243a;
    --pe-text: #f1f5f9;
    --pe-muted: #b8c5d8;
    --pe-border: #34465e;
    --pe-soft: #1e2e46;
}
.project-edit-page .pe-heading { color: var(--pe-text); font-weight: 800; }
.project-edit-page .pe-muted { color: var(--pe-muted) !important; }
.project-edit-page .pe-card {
    background: var(--pe-surface);
    border: 1px solid var(--pe-border);
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(15,23,42,.05);
    padding: clamp(20px,3vw,30px);
    margin-bottom: 24px;
}
.project-edit-page .pe-section-title {
    font-size: 18px; font-weight: 800; color: var(--pe-text);
    padding-bottom: 14px; margin-bottom: 20px;
    border-bottom: 1px solid var(--pe-border);
}
.project-edit-page .form-label { color: var(--pe-text); font-weight: 650; }
.project-edit-page .form-control {
    background: var(--pe-soft); color: var(--pe-text);
    border: 1px solid var(--pe-border);
    border-radius: 11px; padding: 12px 14px;
}
.project-edit-page .form-control:focus {
    background: var(--pe-surface); color: var(--pe-text);
    border-color: #60a5fa; box-shadow: 0 0 0 .2rem rgba(59,130,246,.16);
}
.project-edit-page .form-control::placeholder { color: var(--pe-muted); opacity: .85; }
.project-edit-page .form-control[type="file"]::file-selector-button {
    background: var(--pe-surface); color: var(--pe-text);
    border: 0; border-right: 1px solid var(--pe-border);
    padding: 12px 16px; margin: -12px 14px -12px -14px;
}
.project-edit-page .pe-preview {
    width: 100%; max-width: 420px; max-height: 260px;
    object-fit: contain; border-radius: 14px;
    border: 1px solid var(--pe-border);
    background: var(--pe-soft);
    padding: 8px;
}
.project-edit-page .pe-image-label {
    display: block; font-size: 13px; color: var(--pe-muted);
    margin-bottom: 10px;
}
.project-edit-page .pe-note {
    padding: 12px 15px; border-radius: 12px;
    background: var(--pe-soft); color: var(--pe-muted);
    border: 1px solid var(--pe-border); font-size: 14px;
}
.project-edit-page .pe-actions {
    display: flex; flex-wrap: wrap; gap: 12px;
    align-items: center;
}
.project-edit-page .pe-btn-secondary {
    background: var(--pe-soft); border: 1px solid var(--pe-border);
    color: var(--pe-text); border-radius: 11px; padding: 11px 18px;
    text-decoration: none;
}
.project-edit-page .pe-btn-secondary:hover {
    color: var(--pe-text); border-color: #60a5fa;
}
.project-edit-page .pe-btn-primary {
    border-radius: 11px; padding: 11px 22px; font-weight: 700;
}
.project-edit-page .invalid-feedback { color: #ef4444; }
.project-edit-page .pe-count { color: var(--pe-muted); font-size: 12px; }
</style>
@endpush

@section('content')
<div class="container-fluid px-0 project-edit-page">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="pe-heading h3 mb-1">Chỉnh sửa dự án</h1>
            <p class="pe-muted mb-0">{{ $project->title }}</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="pe-btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong><i class="bi bi-exclamation-triangle me-1"></i> Không thể cập nhật dự án.</strong>
            <p class="mb-0 mt-1">Vui lòng kiểm tra các trường được đánh dấu bên dưới.</p>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project) }}"
          method="POST" enctype="multipart/form-data" id="projectEditForm">
        @csrf
        @method('PUT')

        <section class="pe-card">
            <h2 class="pe-section-title"><i class="bi bi-info-circle text-primary me-2"></i>Thông tin cơ bản</h2>

            <div class="mb-4">
                <label for="projectTitle" class="form-label">Tên dự án <span class="text-danger">*</span></label>
                <input id="projectTitle" type="text" name="title"
                       value="{{ old('title', $project->title) }}"
                       class="form-control @error('title') is-invalid @enderror"
                       placeholder="Nhập tên dự án" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="projectDescription" class="form-label">Mô tả dự án <span class="text-danger">*</span></label>
                <textarea id="projectDescription" name="description" rows="5"
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Giới thiệu mục tiêu, nội dung và ý nghĩa dự án..." required>{{ old('description', $project->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="projectTechnologies" class="form-label">Công nghệ sử dụng</label>
                <input id="projectTechnologies" type="text" name="technologies"
                       value="{{ old('technologies', $project->technologies) }}"
                       class="form-control @error('technologies') is-invalid @enderror"
                       placeholder="Laravel, PHP, MySQL, Bootstrap">
                <div class="form-text pe-muted">Ngăn cách các công nghệ bằng dấu phẩy.</div>
                @error('technologies') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </section>

        <section class="pe-card">
            <h2 class="pe-section-title"><i class="bi bi-card-checklist text-primary me-2"></i>Nội dung chi tiết</h2>

            <div class="mb-4">
                <label for="projectFeatures" class="form-label">Các chức năng chính</label>
                <textarea id="projectFeatures" name="features" rows="5"
                          class="form-control @error('features') is-invalid @enderror"
                          placeholder="Liệt kê những chức năng quan trọng...">{{ old('features', $project->features) }}</textarea>
                @error('features') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="projectChallenges" class="form-label">Khó khăn và giải pháp</label>
                <textarea id="projectChallenges" name="challenges" rows="4"
                          class="form-control @error('challenges') is-invalid @enderror"
                          placeholder="Khó khăn đã gặp và cách khắc phục...">{{ old('challenges', $project->challenges) }}</textarea>
                @error('challenges') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="projectResults" class="form-label">Kết quả đạt được</label>
                <textarea id="projectResults" name="results" rows="4"
                          class="form-control @error('results') is-invalid @enderror"
                          placeholder="Kết quả, bài học và thành tựu...">{{ old('results', $project->results) }}</textarea>
                @error('results') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </section>

        <section class="mb-4 p-3 rounded-4 border" style="border-color:var(--pc-border,var(--pe-border)) !important;">
            <h2 class="h5 fw-bold mb-2"><i class="bi bi-translate me-2 text-primary"></i>Bản dịch tiếng Anh</h2>
            <p class="small mb-3">Nhập nội dung tiếng Việt trước, nhấn dịch và kiểm tra bản dịch. Bạn có thể sửa từng ô trước khi lưu dự án.</p>
            <button type="button" id="translateProjectButton" class="btn btn-outline-primary mb-3">
                <i class="bi bi-translate me-1"></i> Tự động dịch sang English
            </button>
            <div id="translateProjectStatus" class="small mb-3" role="status" aria-live="polite"></div>
            <div class="mb-3">
                    <label for="title_en" class="form-label">Tên dự án (English)</label>
                    <input id="title_en" name="title_en" type="text" maxlength="255" value="{{ old('title_en', $project->title_en) }}" class="form-control @error('title_en') is-invalid @enderror">
                    @error('title_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            <div class="mb-3">
                    <label for="description_en" class="form-label">Mô tả dự án (English)</label>
                    <textarea id="description_en" name="description_en" rows="4" class="form-control @error('description_en') is-invalid @enderror">{{ old('description_en', $project->description_en) }}</textarea>
                    @error('description_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            <div class="mb-3">
                    <label for="features_en" class="form-label">Main features (English)</label>
                    <textarea id="features_en" name="features_en" rows="4" class="form-control @error('features_en') is-invalid @enderror">{{ old('features_en', $project->features_en) }}</textarea>
                    @error('features_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            <div class="mb-3">
                    <label for="challenges_en" class="form-label">Challenges and solutions (English)</label>
                    <textarea id="challenges_en" name="challenges_en" rows="4" class="form-control @error('challenges_en') is-invalid @enderror">{{ old('challenges_en', $project->challenges_en) }}</textarea>
                    @error('challenges_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            <div class="mb-3">
                    <label for="results_en" class="form-label">Results (English)</label>
                    <textarea id="results_en" name="results_en" rows="4" class="form-control @error('results_en') is-invalid @enderror">{{ old('results_en', $project->results_en) }}</textarea>
                    @error('results_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
        </section>

        <section class="pe-card">
            <h2 class="pe-section-title"><i class="bi bi-link-45deg text-primary me-2"></i>Liên kết dự án</h2>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="projectGithub" class="form-label">GitHub URL</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-github"></i></span>
                        <input id="projectGithub" type="url" name="github_url"
                               value="{{ old('github_url', $project->github_url) }}"
                               class="form-control @error('github_url') is-invalid @enderror"
                               placeholder="https://github.com/...">
                        @error('github_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="projectDemo" class="form-label">Demo URL</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-box-arrow-up-right"></i></span>
                        <input id="projectDemo" type="url" name="demo_url"
                               value="{{ old('demo_url', $project->demo_url) }}"
                               class="form-control @error('demo_url') is-invalid @enderror"
                               placeholder="https://...">
                        @error('demo_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </section>

        <section class="pe-card">
            <h2 class="pe-section-title"><i class="bi bi-image text-primary me-2"></i>Ảnh dự án</h2>
            @if($project->image)
                <div class="mb-3">
                    <span class="pe-image-label">Ảnh hiện tại</span>
                    <img src="{{ asset('storage/' . $project->image) }}"
                         alt="Ảnh hiện tại của dự án {{ $project->title }}"
                         class="pe-preview" loading="lazy">
                </div>
            @endif

            <div class="mb-3">
                <label for="projectImage" class="form-label">Chọn ảnh mới</label>
                <input id="projectImage" type="file" name="image"
                       accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                       class="form-control @error('image') is-invalid @enderror">
                <div class="form-text pe-muted">Để trống nếu muốn giữ ảnh hiện tại. JPG, PNG hoặc WEBP; tối đa 2 MB nếu Controller đang áp dụng giới hạn này.</div>
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div id="newImagePreviewWrap" class="mb-3" hidden>
                <span class="pe-image-label">Xem trước ảnh mới</span>
                <img id="newImagePreview" class="pe-preview" alt="Ảnh mới được chọn">
                <div class="pe-count mt-2" id="newImageInfo"></div>
            </div>
            <div class="pe-note"><i class="bi bi-info-circle me-2"></i>Chỉ khi nhấn <strong>Cập nhật dự án</strong>, ảnh mới mới được gửi lên máy chủ.</div>
        </section>

        <div class="pe-actions mb-4">
            <button type="submit" class="btn btn-primary pe-btn-primary">
                <i class="bi bi-check2-circle me-1"></i> Cập nhật dự án
            </button>
            <a href="{{ route('admin.projects.index') }}" class="pe-btn-secondary">Hủy thay đổi</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('projectImage');
    const wrapper = document.getElementById('newImagePreviewWrap');
    const preview = document.getElementById('newImagePreview');
    const info = document.getElementById('newImageInfo');
    if (!input || !wrapper || !preview || !info) return;

    let currentUrl = null;
    function clearPreview() {
        if (currentUrl) URL.revokeObjectURL(currentUrl);
        currentUrl = null;
        preview.removeAttribute('src');
        wrapper.hidden = true;
        info.textContent = '';
    }
    input.addEventListener('change', function () {
        clearPreview();
        const file = input.files && input.files[0];
        if (!file) return;
        if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
            info.textContent = 'Vui lòng chọn ảnh JPG, PNG hoặc WEBP.';
            wrapper.hidden = false;
            return;
        }
        currentUrl = URL.createObjectURL(file);
        preview.src = currentUrl;
        info.textContent = file.name + ' - ' + (file.size / 1024 / 1024).toFixed(2) + ' MB';
        wrapper.hidden = false;
    });
    window.addEventListener('pagehide', clearPreview);
});
</script>

document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('translateProjectButton');
    const status = document.getElementById('translateProjectStatus');
    if (!button || !status) return;

    const pairs = {
        title: 'title_en',
        description: 'description_en',
        features: 'features_en',
        challenges: 'challenges_en',
        results: 'results_en'
    };
    button.addEventListener('click', async function () {
        const form = button.closest('form');
        const payload = {};
        for (const source of Object.keys(pairs)) {
            payload[source] = form.elements.namedItem(source)?.value || '';
        }
        if (!Object.values(payload).some(v => v.trim())) {
            status.textContent = 'Vui lòng nhập nội dung tiếng Việt trước khi dịch.';
            return;
        }
        const populated = Object.values(pairs).filter(name =>
            (form.elements.namedItem(name)?.value || '').trim()
        );
        if (populated.length && !window.confirm(
            'Các ô tiếng Anh đã có nội dung. Bạn có muốn thay bằng bản dịch mới không?'
        )) return;

        button.disabled = true;
        status.textContent = 'Đang dịch nội dung, vui lòng chờ...';
        try {
            const response = await fetch(@json(route('admin.projects.translate')), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                credentials: 'same-origin',
                body: JSON.stringify(payload)
            });
            const data = await response.json();
            if (!response.ok) {
                const firstError = data.errors
                    ? Object.values(data.errors).flat()[0]
                    : null;
                throw new Error(firstError || data.message || 'Không thể dịch nội dung.');
            }
            for (const [name, value] of Object.entries(data.translations || {})) {
                if (Object.values(pairs).includes(name)) {
                    const target = form.elements.namedItem(name);
                    if (target) target.value = value || '';
                }
            }
            status.textContent = 'Đã dịch xong. Hãy kiểm tra và nhấn Lưu/Cập nhật dự án.';
        } catch (error) {
            status.textContent = 'Lỗi dịch: ' + error.message;
        } finally {
            button.disabled = false;
        }
    });
});
@endpush
