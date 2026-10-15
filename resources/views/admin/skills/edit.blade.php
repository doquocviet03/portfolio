
@extends('layouts.admin')

@section('title', 'Sửa kỹ năng')
@section('page_title', 'Chỉnh sửa kỹ năng')

@push('styles')
<style>
.skill-edit {
    --se-bg: #ffffff;
    --se-text: #0f172a;
    --se-muted: #64748b;
    --se-border: #dbe3ef;
    --se-soft: #f8fafc;
    color: var(--se-text);
}

html[data-bs-theme="dark"] .skill-edit,
html[data-theme="dark"] .skill-edit {
    --se-bg: #17243a;
    --se-text: #f1f5f9;
    --se-muted: #b9c8da;
    --se-border: #34465e;
    --se-soft: #1e2e46;
}

.skill-edit .se-heading {
    color: var(--se-text);
    font-weight: 800;
}

.skill-edit .se-muted,
.skill-edit .form-text {
    color: var(--se-muted) !important;
}

.skill-edit .se-card {
    background: var(--se-bg);
    border: 1px solid var(--se-border);
    border-radius: 20px;
    padding: clamp(20px, 3vw, 32px);
    box-shadow: 0 8px 30px rgba(15,23,42,.05);
}

.skill-edit .se-section-title {
    color: var(--se-text);
    font-size: 18px;
    font-weight: 800;
    border-bottom: 1px solid var(--se-border);
    padding-bottom: 16px;
    margin-bottom: 22px;
}

.skill-edit .form-label {
    color: var(--se-text);
    font-weight: 650;
}

.skill-edit .form-control,
.skill-edit .form-select {
    background: var(--se-soft);
    color: var(--se-text);
    border: 1px solid var(--se-border);
    border-radius: 11px;
    padding: 12px 14px;
}

.skill-edit .form-control:focus,
.skill-edit .form-select:focus {
    background: var(--se-bg);
    color: var(--se-text);
    border-color: #60a5fa;
    box-shadow: 0 0 0 .2rem rgba(59,130,246,.16);
}

.skill-edit .form-control::placeholder {
    color: var(--se-muted);
    opacity: .9;
}

.skill-edit .form-select option {
    background: var(--se-bg);
    color: var(--se-text);
}

.skill-edit .se-level-panel {
    background: var(--se-soft);
    border: 1px solid var(--se-border);
    border-radius: 16px;
    padding: 20px;
}

.skill-edit .se-range {
    accent-color: #2563eb;
    cursor: pointer;
    width: 100%;
}

.skill-edit .se-percent {
    font-size: 29px;
    font-weight: 800;
    color: #3b82f6;
}

.skill-edit .se-progress {
    height: 11px;
    background: var(--se-border);
    border-radius: 999px;
    overflow: hidden;
}

.skill-edit .se-progress-bar {
    height: 100%;
    background: linear-gradient(90deg,#2563eb,#38bdf8);
    border-radius: inherit;
    transition: width .12s ease;
}

.skill-edit .se-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
}

.skill-edit .se-back {
    border: 1px solid var(--se-border);
    color: var(--se-text);
    background: var(--se-soft);
    border-radius: 11px;
    text-decoration: none;
    padding: 11px 18px;
}

.skill-edit .se-back:hover {
    color: var(--se-text);
    border-color: #60a5fa;
}

.skill-edit .se-save {
    border-radius: 11px;
    padding: 11px 22px;
    font-weight: 700;
}

.skill-edit .se-hint {
    color: var(--se-muted);
    font-size: 13px;
}

.skill-edit .se-icon-preview {
    width: 100px;
    height: 100px;
    object-fit: contain;
    border-radius: 16px;
    background: var(--se-soft);
    border: 1px solid var(--se-border);
    padding: 10px;
}

.skill-edit .se-preview-placeholder {
    width: 100px;
    height: 100px;
    border-radius: 16px;
    background: var(--se-soft);
    border: 1px dashed var(--se-border);
    display: grid;
    place-items: center;
    color: #60a5fa;
    font-size: 36px;
}

.skill-edit .se-info-row {
    border-bottom: 1px solid var(--se-border);
    padding-bottom: 12px;
    margin-bottom: 12px;
}

.skill-edit #skillLevelSection[hidden] {
    display: none !important;
}

@media (prefers-reduced-motion: reduce) {
    .skill-edit .se-progress-bar {
        transition: none;
    }
}
</style>
@endpush

@section('content')
@php
    $selectedType = old('type', $skill->type ?? 'programming');
    $selectedLevel = old('level', $skill->level ?? 50);

    $hasIcon = filled($skill->icon)
        && (
            str_starts_with($skill->icon, 'skills/')
            || filter_var($skill->icon, FILTER_VALIDATE_URL)
        );

    $iconUrl = $hasIcon
        ? (
            filter_var($skill->icon, FILTER_VALIDATE_URL)
                ? $skill->icon
                : asset('storage/' . $skill->icon)
        )
        : null;
@endphp

<div class="skill-edit container-fluid px-0">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="se-heading h3 mb-1">
                Chỉnh sửa kỹ năng
            </h1>

            <p class="se-muted mb-0">
                Cập nhật thông tin cho kỹ năng:
                <strong>{{ $skill->name }}</strong>
            </p>
        </div>

        <a href="{{ route('admin.skills.index') }}" class="se-back">
            <i class="bi bi-arrow-left me-1"></i>
            Quay lại danh sách
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger rounded-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Vui lòng kiểm tra lại thông tin.

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-xl-8">
            <section class="se-card">

                <h2 class="se-section-title">
                    <i class="bi bi-pencil-square text-primary me-2"></i>
                    Thông tin kỹ năng
                </h2>

                <form
                    method="POST"
                    action="{{ route('admin.skills.update', $skill) }}"
                    enctype="multipart/form-data"
                    id="editSkillForm"
                >
                    @csrf
                    @method('PUT')

                    {{-- LOẠI KỸ NĂNG --}}
                    <div class="mb-4">
                        <label for="skillType" class="form-label">
                            Loại kỹ năng
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            id="skillType"
                            name="type"
                            class="form-select @error('type') is-invalid @enderror"
                            required
                        >
                            <option value="programming"
                                @selected($selectedType === 'programming')>
                                Kỹ năng lập trình
                            </option>

                            <option value="personal"
                                @selected($selectedType === 'personal')>
                                Kỹ năng cá nhân
                            </option>
                        </select>

                        @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <p class="se-hint mt-2 mb-0">
                            Kỹ năng lập trình có phần trăm thành thạo.
                            Kỹ năng cá nhân chỉ hiển thị tên, biểu tượng và mô tả.
                        </p>
                    </div>

                    {{-- TÊN KỸ NĂNG --}}
                    <div class="mb-4">
                        <label for="skillName" class="form-label">
                            Tên kỹ năng
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            id="skillName"
                            type="text"
                            name="name"
                            value="{{ old('name', $skill->name) }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Ví dụ: Laravel, Python, Làm việc nhóm..."
                            maxlength="255"
                            required
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- MÔ TẢ --}}
                    <div class="mb-4">
                        <label for="skillDescription" class="form-label">
                            Mô tả kỹ năng
                        </label>

                        <textarea
                            id="skillDescription"
                            name="description"
                            rows="4"
                            maxlength="2000"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Mô tả ngắn về kiến thức, kinh nghiệm hoặc khả năng..."
                        >{{ old('description', $skill->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- LOGO / ICON --}}
                    <div class="mb-4">
                        <label for="skillIcon" class="form-label">
                            Logo / Biểu tượng kỹ năng
                        </label>

                        <div class="d-flex align-items-center flex-wrap gap-3 mb-3">
                            <img
                                id="skillIconPreview"
                                src="{{ $iconUrl ?? '' }}"
                                alt="Logo kỹ năng"
                                class="se-icon-preview"
                                style="{{ $hasIcon ? '' : 'display:none;' }}"
                            >

                            <div
                                id="skillIconPlaceholder"
                                class="se-preview-placeholder"
                                style="{{ $hasIcon ? 'display:none;' : '' }}"
                            >
                                <i class="bi bi-image"></i>
                            </div>

                            <div>
                                <div class="fw-semibold se-heading">
                                    Xem trước logo
                                </div>

                                <div class="se-hint">
                                    JPG, PNG, WebP — tối đa 2 MB
                                </div>
                            </div>
                        </div>

                        <input
                            type="file"
                            id="skillIcon"
                            name="icon"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            class="form-control @error('icon') is-invalid @enderror"
                        >

                        @error('icon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <p class="se-hint mt-2 mb-0">
                            Không chọn ảnh mới nếu muốn giữ nguyên logo hiện tại.
                        </p>
                    </div>

                    {{-- MỨC ĐỘ LẬP TRÌNH --}}
                    <div
                        class="mb-4"
                        id="skillLevelSection"
                        @if($selectedType === 'personal') hidden @endif
                    >
                        <label for="skillLevel" class="form-label">
                            Mức độ kỹ năng (0–100%)
                            <span class="text-danger">*</span>
                        </label>

                        <div class="se-level-panel">
                            <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
                                <span class="se-muted small">
                                    Điều chỉnh mức độ
                                </span>

                                <span class="se-percent" id="skillPercent">
                                    {{ $selectedLevel }}%
                                </span>
                            </div>

                            <input
                                id="skillLevelRange"
                                type="range"
                                class="se-range mb-3"
                                min="0"
                                max="100"
                                step="1"
                                value="{{ $selectedLevel }}"
                                aria-label="Điều chỉnh mức độ kỹ năng"
                            >

                            <div
                                class="se-progress mb-3"
                                id="skillProgress"
                                role="progressbar"
                                aria-label="Mức độ kỹ năng"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                aria-valuenow="{{ max(0, min(100, (int) $selectedLevel)) }}"
                            >
                                <div
                                    class="se-progress-bar"
                                    id="skillProgressBar"
                                    style="width: {{ max(0, min(100, (int) $selectedLevel)) }}%"
                                ></div>
                            </div>

                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <label for="skillLevel" class="form-label mb-0">
                                    Giá trị chính xác
                                </label>

                                <input
                                    id="skillLevel"
                                    type="number"
                                    name="level"
                                    min="0"
                                    max="100"
                                    step="1"
                                    value="{{ $selectedLevel }}"
                                    class="form-control @error('level') is-invalid @enderror"
                                    style="max-width:130px"
                                    @if($selectedType === 'programming') required @else disabled @endif
                                >

                                <span class="se-muted small">%</span>
                            </div>

                            @error('level')
                                <div class="text-danger small mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <p class="se-hint mt-2 mb-0">
                            Chỉ áp dụng cho kỹ năng lập trình.
                        </p>
                    </div>

                    {{-- THỨ TỰ HIỂN THỊ --}}
                    <div class="mb-4">
                        <label for="skillSortOrder" class="form-label">
                            Thứ tự hiển thị
                        </label>

                        <input
                            id="skillSortOrder"
                            type="number"
                            name="sort_order"
                            min="0"
                            max="99999"
                            step="1"
                            value="{{ old('sort_order', $skill->sort_order ?? 0) }}"
                            class="form-control @error('sort_order') is-invalid @enderror"
                            style="max-width:200px"
                        >

                        @error('sort_order')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <p class="se-hint mt-2 mb-0">
                            Số nhỏ hơn sẽ được hiển thị trước.
                        </p>
                    </div>

                    {{-- NÚT LƯU --}}
                    <div class="se-actions">
                        <button type="submit" class="btn btn-primary se-save">
                            <i class="bi bi-check2-circle me-1"></i>
                            Cập nhật kỹ năng
                        </button>

                        <a href="{{ route('admin.skills.index') }}" class="se-back">
                            Hủy thay đổi
                        </a>
                    </div>
                </form>
            </section>
        </div>

        {{-- THÔNG TIN HIỆN TẠI --}}
        <div class="col-xl-4">
            <aside class="se-card">

                <h2 class="se-section-title">
                    <i class="bi bi-info-circle text-primary me-2"></i>
                    Thông tin hiện tại
                </h2>

                <div class="se-info-row">
                    <div class="se-muted small mb-1">Mã kỹ năng</div>
                    <div class="fw-semibold se-heading">
                        #{{ $skill->id }}
                    </div>
                </div>

                <div class="se-info-row">
                    <div class="se-muted small mb-1">Tên đang lưu</div>
                    <div class="fw-semibold se-heading">
                        {{ $skill->name }}
                    </div>
                </div>

                <div class="se-info-row">
                    <div class="se-muted small mb-1">Loại kỹ năng</div>

                    @if(($skill->type ?? 'programming') === 'personal')
                        <span class="badge text-bg-success">
                            Kỹ năng cá nhân
                        </span>
                    @else
                        <span class="badge text-bg-primary">
                            Kỹ năng lập trình
                        </span>
                    @endif
                </div>

                <div class="se-info-row">
                    <div class="se-muted small mb-1">Mức độ đang lưu</div>
                    <div class="fw-semibold se-heading">
                        @if(($skill->type ?? 'programming') === 'programming')
                            {{ $skill->level !== null ? $skill->level . '%' : 'Chưa cập nhật' }}
                        @else
                            Không áp dụng
                        @endif
                    </div>
                </div>

                <div class="se-info-row">
                    <div class="se-muted small mb-1">Thứ tự</div>
                    <div class="fw-semibold se-heading">
                        {{ $skill->sort_order ?? 0 }}
                    </div>
                </div>

                <p class="se-hint mb-0">
                    Thông tin bên trên là dữ liệu đang lưu.
                    Chỉ khi nhấn "Cập nhật kỹ năng", thay đổi mới được lưu.
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
    const levelSection = document.getElementById('skillLevelSection');

    const number = document.getElementById('skillLevel');
    const range = document.getElementById('skillLevelRange');
    const percent = document.getElementById('skillPercent');
    const bar = document.getElementById('skillProgressBar');
    const progress = document.getElementById('skillProgress');

    const iconInput = document.getElementById('skillIcon');
    const iconPreview = document.getElementById('skillIconPreview');
    const iconPlaceholder = document.getElementById('skillIconPlaceholder');

    const originalIconUrl = @json($iconUrl);
    const hasOriginalIcon = @json($hasIcon);

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

    function updateType() {
        const isProgramming = type.value === 'programming';

        levelSection.hidden = !isProgramming;
        number.disabled = !isProgramming;
        range.disabled = !isProgramming;
        number.required = isProgramming;

        if (isProgramming) {
            if (number.value === '') {
                number.value = '50';
            }
            render(number.value);
        }
    }

    type.addEventListener('change', updateType);

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

    render(number.value);
    updateType();

    let previewUrl = null;

    function restoreOriginalIcon() {
        if (hasOriginalIcon && originalIconUrl) {
            iconPreview.src = originalIconUrl;
            iconPreview.style.display = '';
            iconPlaceholder.style.display = 'none';
        } else {
            iconPreview.removeAttribute('src');
            iconPreview.style.display = 'none';
            iconPlaceholder.style.display = '';
        }
    }

    iconInput.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        if (!file) {
            restoreOriginalIcon();
            return;
        }

        if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
            alert('Vui lòng chọn ảnh JPG, PNG hoặc WebP.');
            this.value = '';
            restoreOriginalIcon();
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Dung lượng ảnh không được vượt quá 2 MB.');
            this.value = '';
            restoreOriginalIcon();
            return;
        }

        previewUrl = URL.createObjectURL(file);
        iconPreview.src = previewUrl;
        iconPreview.style.display = '';
        iconPlaceholder.style.display = 'none';
    });

    window.addEventListener('pagehide', function () {
        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
        }
    });
});
</script>
@endpush
