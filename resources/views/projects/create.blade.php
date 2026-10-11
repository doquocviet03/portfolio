
@extends('layouts.admin')

@section('title', 'Thêm dự án')
@section('page_title', 'Thêm dự án mới')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Thêm dự án mới</h3>

        <a href="{{ route('admin.projects.index') }}"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Quay lại
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Vui lòng kiểm tra thông tin:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.projects.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row g-4">

                    <div class="col-md-8">
                        <label class="form-label fw-semibold">
                            Tên dự án *
                        </label>

                        <input type="text"
                               name="title"
                               value="{{ old('title') }}"
                               class="form-control"
                               maxlength="255"
                               required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Công nghệ sử dụng
                        </label>

                        <input type="text"
                               name="technologies"
                               value="{{ old('technologies') }}"
                               class="form-control"
                               placeholder="Laravel, PHP, MySQL">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            Mô tả dự án *
                        </label>

                        <textarea name="description"
                                  rows="4"
                                  class="form-control"
                                  required>{{ old('description') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            GitHub URL
                        </label>

                        <input type="url"
                               name="github_url"
                               value="{{ old('github_url') }}"
                               class="form-control"
                               placeholder="https://github.com/...">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Demo URL
                        </label>

                        <input type="url"
                               name="demo_url"
                               value="{{ old('demo_url') }}"
                               class="form-control"
                               placeholder="https://...">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            Chức năng nổi bật
                        </label>

                        <textarea name="features"
                                  rows="4"
                                  class="form-control">{{ old('features') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Khó khăn gặp phải
                        </label>

                        <textarea name="challenges"
                                  rows="4"
                                  class="form-control">{{ old('challenges') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Kết quả đạt được
                        </label>

                        <textarea name="results"
                                  rows="4"
                                  class="form-control">{{ old('results') }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            Ảnh dự án
                        </label>

                        <input type="file"
                               id="projectImage"
                               name="image"
                               accept="image/jpeg,image/png,image/webp"
                               class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted">
                            JPG, PNG, WEBP — tối đa 2MB.
                        </small>

                        <div id="previewContainer"
                             class="mt-3"
                             style="display:none;">

                            <p class="fw-semibold">Xem trước ảnh:</p>

                            <img id="imagePreview"
                                 alt="Ảnh dự án được chọn"
                                 class="img-fluid rounded-3 border"
                                 style="max-width:320px;max-height:220px;object-fit:cover;">
                        </div>
                    </div>

                </div>

                <div class="d-flex gap-2 mt-4">

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Thêm dự án
                    </button>

                    <a href="{{ route('admin.projects.index') }}"
                       class="btn btn-outline-secondary">
                        Hủy
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('projectImage');
    const preview = document.getElementById('imagePreview');
    const container = document.getElementById('previewContainer');

    if (!input || !preview || !container) return;

    let imageUrl = null;

    input.addEventListener('change', function () {
        if (imageUrl) {
            URL.revokeObjectURL(imageUrl);
            imageUrl = null;
        }

        const file = input.files[0];

        if (!file) {
            preview.removeAttribute('src');
            container.style.display = 'none';
            return;
        }

        const allowed = ['image/jpeg', 'image/png', 'image/webp'];

        if (!allowed.includes(file.type) || file.size > 2 * 1024 * 1024) {
            alert('Ảnh phải là JPG, PNG hoặc WEBP và không quá 2MB.');
            input.value = '';
            container.style.display = 'none';
            return;
        }

        imageUrl = URL.createObjectURL(file);
        preview.src = imageUrl;
        container.style.display = 'block';
    });

    window.addEventListener('pagehide', function () {
        if (imageUrl) URL.revokeObjectURL(imageUrl);
    });
});
</script>
@endpush
