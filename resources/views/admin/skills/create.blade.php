

@extends('layouts.admin')

@section('title', 'Thêm kỹ năng')

@section('page_title', 'Thêm kỹ năng')

@push('styles')

<style>

.skill-create {

    --sc-bg: #fff;

    --sc-text: #0f172a;

    --sc-muted: #64748b;

    --sc-border: #dbe3ef;

    --sc-soft: #f8fafc;

    color: var(--sc-text);

}

html[data-theme="dark"] .skill-create,

html[data-bs-theme="dark"] .skill-create {

    --sc-bg: #17243a;

    --sc-text: #f1f5f9;

    --sc-muted: #b9c8da;

    --sc-border: #34465e;

    --sc-soft: #1e2e46;

}

.skill-create .sc-heading {

    color: var(--sc-text);

    font-weight: 800;

}

.skill-create .sc-muted,

.skill-create .form-text {

    color: var(--sc-muted) !important;

}

.skill-create .sc-card {

    background: var(--sc-bg);

    border: 1px solid var(--sc-border);

    border-radius: 20px;

    padding: clamp(20px, 3vw, 32px);

    box-shadow: 0 8px 30px rgba(15,23,42,.05);

}

.skill-create .sc-section-title {

    color: var(--sc-text);

    font-size: 18px;

    font-weight: 800;

    border-bottom: 1px solid var(--sc-border);

    padding-bottom: 16px;

    margin-bottom: 22px;

}

.skill-create .form-label {

    color: var(--sc-text);

    font-weight: 650;

}

.skill-create .form-control,

.skill-create .form-select {

    background: var(--sc-soft);

    color: var(--sc-text);

    border: 1px solid var(--sc-border);

    border-radius: 11px;

    padding: 12px 14px;

}

.skill-create .form-control:focus,

.skill-create .form-select:focus {

    background: var(--sc-bg);

    color: var(--sc-text);

    border-color: #60a5fa;

    box-shadow: 0 0 0 .2rem rgba(59,130,246,.16);

}

.skill-create .form-control::placeholder {

    color: var(--sc-muted);

    opacity: .85;

}

.skill-create .form-select option {

    background: var(--sc-bg);

    color: var(--sc-text);

}

.skill-create .sc-level-panel {

    background: var(--sc-soft);

    border: 1px solid var(--sc-border);

    border-radius: 16px;

    padding: 20px;

}

.skill-create .sc-range {

    accent-color: #2563eb;

    cursor: pointer;

    width: 100%;

}

.skill-create .sc-percent {

    font-size: 29px;

    font-weight: 800;

    color: #3b82f6;

    min-width: 76px;

    text-align: right;

}

.skill-create .sc-progress {

    width: 100%;

    height: 11px;

    background: var(--sc-border);

    border-radius: 999px;

    overflow: hidden;

}

.skill-create .sc-progress-bar {

    height: 100%;

    width: 50%;

    background: linear-gradient(90deg, #2563eb, #38bdf8);

    border-radius: inherit;

    transition: width .12s ease;

}

.skill-create .sc-back {

    display: inline-flex;

    align-items: center;

    border: 1px solid var(--sc-border);

    color: var(--sc-text);

    background: var(--sc-soft);

    border-radius: 11px;

    text-decoration: none;

    padding: 11px 18px;

}

.skill-create .sc-back:hover {

    color: var(--sc-text);

    border-color: #60a5fa;

}

.skill-create .sc-save {

    border-radius: 11px;

    padding: 11px 22px;

    font-weight: 700;

}

.skill-create .sc-preview {

    width: 84px;

    height: 84px;

    border-radius: 16px;

    border: 1px dashed var(--sc-border);

    background: var(--sc-soft);

    display: grid;

    place-items: center;

    overflow: hidden;

    color: var(--sc-muted);

}

.skill-create .sc-preview img {

    width: 100%;

    height: 100%;

    object-fit: contain;

}

.skill-create .sc-hint {

    color: var(--sc-muted);

    font-size: 13px;

}

/* Ẩn phần trăm khi chọn kỹ năng cá nhân */

.skill-create #programmingLevelSection[hidden] {

    display: none !important;

}

@media (prefers-reduced-motion: reduce) {

    .skill-create .sc-progress-bar {

        transition: none;

    }

}

</style>

@endpush

@section('content')

<div class="skill-create container-fluid px-0">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>

            <h1 class="sc-heading h3 mb-1">

                Thêm kỹ năng mới

            </h1>

            <p class="sc-muted mb-0">

                Quản lý kỹ năng lập trình và kỹ năng cá nhân hiển thị trên Portfolio.

            </p>

        </div>

        <a href="{{ route('admin.skills.index') }}" class="sc-back">

            <i class="bi bi-arrow-left me-2"></i>

            Quay lại danh sách

        </a>

    </div>

    @if($errors->any())

        <div class="alert alert-danger rounded-3" role="alert">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            Vui lòng kiểm tra lại thông tin bên dưới.

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="row g-4">

        <div class="col-xl-8">

            <section class="sc-card">

                <h2 class="sc-section-title">

                    <i class="bi bi-grid-3x3-gap text-primary me-2"></i>

                    Thông tin kỹ năng

                </h2>

                <form method="POST"

                      action="{{ route('admin.skills.store') }}"

                      enctype="multipart/form-data"

                      id="createSkillForm">

                    @csrf

                    <div class="row g-3 mb-4">

                        <div class="col-md-6">

                            <label for="skillType" class="form-label">

                                Loại kỹ năng <span class="text-danger">*</span>

                            </label>

                            <select id="skillType"

                                    name="type"

                                    class="form-select @error('type') is-invalid @enderror"

                                    required>

                                <option value="programming"

                                    @selected(old('type', 'programming') === 'programming')>

                                    Kỹ năng lập trình

                                </option>

                                <option value="personal"

                                    @selected(old('type') === 'personal')>

                                    Kỹ năng cá nhân

                                </option>

                            </select>

                            @error('type')

                                <div class="invalid-feedback">{{ $message }}</div>

                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label for="skillOrder" class="form-label">

                                Thứ tự hiển thị

                            </label>

                            <input id="skillOrder"

                                   type="number"

                                   name="sort_order"

                                   min="0"

                                   max="99999"

                                   step="1"

                                   value="{{ old('sort_order', 0) }}"

                                   class="form-control @error('sort_order') is-invalid @enderror">

                            @error('sort_order')

                                <div class="invalid-feedback">{{ $message }}</div>

                            @enderror

                        </div>

                    </div>

                    <div class="mb-4">

                        <label for="skillName" class="form-label">

                            Tên kỹ năng <span class="text-danger">*</span>

                        </label>

                        <input id="skillName"

                               name="name"

                               type="text"

                               maxlength="255"

                               value="{{ old('name') }}"

                               class="form-control @error('name') is-invalid @enderror"

                               placeholder="Ví dụ: Laravel, Python, Làm việc nhóm..."

                               required>

                        @error('name')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                    <div class="mb-4">

                        <label for="skillDescription" class="form-label">

                            Mô tả kỹ năng

                        </label>

                        <textarea id="skillDescription"

                                  name="description"

                                  rows="4"

                                  maxlength="2000"

                                  class="form-control @error('description') is-invalid @enderror"

                                  placeholder="Mô tả ngắn về kiến thức, công cụ hoặc khả năng của bạn...">{{ old('description') }}</textarea>

                        @error('description')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                    {{-- BẢN DỊCH TIẾNG ANH --}}
                    <div class="mb-4 p-3 rounded-3" style="border:1px solid var(--sc-border);background:var(--sc-soft);">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                            <h3 class="h6 fw-bold mb-0">English translation</h3>
                            <button type="button" id="translateSkillBtn" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-translate me-1"></i> Tự động dịch sang English
                            </button>
                        </div>
                        <div id="skillTranslateMessage" class="small mb-3" role="status" aria-live="polite"></div>
                        <div class="mb-3">
                            <label for="skillNameEn" class="form-label">Tên kỹ năng (English)</label>
                            <input id="skillNameEn" name="name_en" type="text" maxlength="255"
                                value="{{ old('name_en') }}"
                                class="form-control @error('name_en') is-invalid @enderror"
                                placeholder="e.g. Teamwork, Communication, Laravel">
                            @error('name_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label for="skillDescriptionEn" class="form-label">Mô tả kỹ năng (English)</label>
                            <textarea id="skillDescriptionEn" name="description_en" rows="4" maxlength="5000"
                                class="form-control @error('description_en') is-invalid @enderror"
                                placeholder="Describe this skill in English...">{{ old('description_en') }}</textarea>
                            @error('description_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">

                        <label for="skillIcon" class="form-label">

                            Logo / Icon kỹ năng

                        </label>

                        <div class="d-flex align-items-start gap-3 flex-wrap">

                            <div class="sc-preview"

                                 id="skillIconPreview"

                                 aria-label="Xem trước logo">

                                <i class="bi bi-image fs-2"></i>

                            </div>

                            <div class="flex-grow-1" style="min-width:220px">

                                <input id="skillIcon"

                                       name="icon"

                                       type="file"

                                       accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"

                                       class="form-control @error('icon') is-invalid @enderror">

                                @error('icon')

                                    <div class="invalid-feedback">{{ $message }}</div>

                                @enderror

                                <div class="sc-hint mt-2">

                                    Chấp nhận JPG, PNG, WebP, tối đa 2 MB.

                                    Nếu không tải ảnh, giao diện sử dụng biểu tượng mặc định.

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="mb-4" id="programmingLevelSection">

                        <label for="skillLevel" class="form-label">

                            Mức độ thành thạo (0–100%)

                            <span class="text-danger">*</span>

                        </label>

                        <div class="sc-level-panel">

                            <div class="d-flex justify-content-between align-items-center gap-3 mb-3">

                                <span class="sc-muted small">

                                    Điều chỉnh mức độ

                                </span>

                                <span class="sc-percent" id="skillPercent">

                                    50%

                                </span>

                            </div>

                            <input id="skillLevelRange"

                                   type="range"

                                   class="sc-range mb-3"

                                   min="0"

                                   max="100"

                                   step="1"

                                   value="{{ old('level', 50) }}"

                                   aria-label="Điều chỉnh mức độ kỹ năng">

                            <div class="sc-progress mb-3"

                                 role="progressbar"

                                 id="skillProgress"

                                 aria-label="Mức độ kỹ năng"

                                 aria-valuemin="0"

                                 aria-valuemax="100"

                                 aria-valuenow="50">

                                <div class="sc-progress-bar"

                                     id="skillProgressBar"></div>

                            </div>

                            <div class="d-flex flex-wrap align-items-center gap-3">

                                <label for="skillLevel" class="form-label mb-0">

                                    Giá trị chính xác

                                </label>

                                <input id="skillLevel"

                                       type="number"

                                       name="level"

                                       class="form-control @error('level') is-invalid @enderror"

                                       style="max-width:130px"

                                       min="0"

                                       max="100"

                                       step="1"

                                       value="{{ old('level', 50) }}">

                                <span class="sc-muted small">%</span>

                            </div>

                            @error('level')

                                <div class="text-danger small mt-2">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <p class="sc-hint mt-2 mb-0">

                            Chỉ áp dụng cho kỹ năng lập trình.

                            Kỹ năng cá nhân không sử dụng phần trăm.

                        </p>

                    </div>

                    <div class="d-flex flex-wrap align-items-center gap-3">

                        <button type="submit"

                                class="btn btn-primary sc-save">

                            <i class="bi bi-check2-circle me-2"></i>

                            Lưu kỹ năng

                        </button>

                        <a href="{{ route('admin.skills.index') }}"

                           class="sc-back">

                            Hủy

                        </a>

                    </div>

                </form>

            </section>

        </div>

        <div class="col-xl-4">

            <aside class="sc-card">

                <h2 class="sc-section-title">

                    <i class="bi bi-lightbulb text-warning me-2"></i>

                    Gợi ý nhập liệu

                </h2>

                <p class="fw-semibold mb-2">Kỹ năng lập trình</p>

                <p class="sc-muted small">

                    PHP, Laravel, Python, MySQL, JavaScript, HTML/CSS.

                    Có thể thêm logo và mức độ thành thạo.

                </p>

                <hr>

                <p class="fw-semibold mb-2">Kỹ năng cá nhân</p>

                <p class="sc-muted small">

                    Làm việc nhóm, giao tiếp, quản lý thời gian,

                    giải quyết vấn đề, tư duy logic, tự học.

                    Không cần phần trăm.

                </p>

                <p class="sc-hint mb-0">

                    Các kỹ năng sẽ xuất hiện trên website khi trang kỹ năng

                    công khai đọc dữ liệu từ database.

                </p>

            </aside>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const type = document.getElementById('skillType');

    const section = document.getElementById('programmingLevelSection');

    const number = document.getElementById('skillLevel');

    const range = document.getElementById('skillLevelRange');

    const percent = document.getElementById('skillPercent');

    const bar = document.getElementById('skillProgressBar');

    const progress = document.getElementById('skillProgress');

    const file = document.getElementById('skillIcon');

    const preview = document.getElementById('skillIconPreview');

    let previewUrl = null;

    function clamp(value) {

        return Math.max(0, Math.min(100, Math.round(Number(value) || 0)));

    }

    function render(value) {

        const level = clamp(value);

        range.value = String(level);

        percent.textContent = level + '%';

        bar.style.width = level + '%';

        progress.setAttribute('aria-valuenow', String(level));

    }

    function syncType() {

        const programming = type.value === 'programming';

        section.hidden = !programming;

        number.disabled = !programming;

        range.disabled = !programming;

        number.required = programming;

        if (programming) {

            render(number.value);

        }

    }

    type.addEventListener('change', syncType);

    range.addEventListener('input', function () {

        number.value = range.value;

        render(range.value);

    });

    number.addEventListener('input', function () {

        render(number.value);

    });

    number.addEventListener('change', function () {

        if (number.value !== '') {

            number.value = String(clamp(number.value));

        }

        render(number.value);

    });

    file.addEventListener('change', function () {

        if (previewUrl) {

            URL.revokeObjectURL(previewUrl);

            previewUrl = null;

        }

        const selected = file.files && file.files[0];

        if (

            !selected ||

            !['image/jpeg', 'image/png', 'image/webp'].includes(selected.type)

        ) {

            preview.innerHTML = '<i class="bi bi-image fs-2"></i>';

            return;

        }

        previewUrl = URL.createObjectURL(selected);

        const img = document.createElement('img');

        img.src = previewUrl;

        img.alt = 'Xem trước logo kỹ năng';

        preview.replaceChildren(img);

    });

    // Dịch tự động, chỉ lưu khi người dùng nhấn Lưu kỹ năng.
    const translateButton = document.getElementById('translateSkillBtn');
    const translateMessage = document.getElementById('skillTranslateMessage');
    translateButton.addEventListener('click', async function () {
        const name = document.getElementById('skillName').value.trim();
        const description = document.getElementById('skillDescription').value.trim();
        if (!name && !description) {
            translateMessage.textContent = 'Hãy nhập tên hoặc mô tả tiếng Việt trước.';
            return;
        }
        const token = document.querySelector('#createSkillForm input[name="_token"]')?.value;
        if (!token) {
            translateMessage.textContent = 'Không tìm thấy CSRF token. Vui lòng tải lại trang.';
            return;
        }
        translateButton.disabled = true;
        translateMessage.textContent = 'Đang dịch...';
        try {
            const response = await fetch(@json(route('admin.skills.translate')), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                credentials: 'same-origin',
                body: JSON.stringify({ name, description })
            });
            const result = await response.json();
            if (!response.ok) {
                const details = result.errors
                    ? Object.values(result.errors).flat().join(' ')
                    : (result.message || 'Không thể dịch.');
                throw new Error(details);
            }
            const translated = result.translations || {};
            if (typeof translated.name_en === 'string') {
                document.getElementById('skillNameEn').value = translated.name_en;
            }
            if (typeof translated.description_en === 'string') {
                document.getElementById('skillDescriptionEn').value = translated.description_en;
            }
            const failed = Object.keys(result.errors || {});
            translateMessage.textContent = failed.length
                ? 'Một số trường chưa dịch được: ' + failed.join(', ') + '. Bạn có thể sửa thủ công.'
                : 'Đã dịch xong. Kiểm tra bản dịch và nhấn Lưu kỹ năng để ghi vào database.';
        } catch (error) {
            translateMessage.textContent = error.message || 'Lỗi kết nối dịch tự động.';
        } finally {
            translateButton.disabled = false;
        }
    });

    render(number.value);

    syncType();

});

</script>

@endpush
