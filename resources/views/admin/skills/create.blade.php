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
}
html[data-bs-theme="dark"] .skill-create,
html[data-theme="dark"] .skill-create {
    --sc-bg: #17243a;
    --sc-text: #f1f5f9;
    --sc-muted: #b9c8da;
    --sc-border: #34465e;
    --sc-soft: #1e2e46;
}
.skill-create .sc-heading { color: var(--sc-text); font-weight: 800; }
.skill-create .sc-muted { color: var(--sc-muted) !important; }
.skill-create .sc-card {
    background: var(--sc-bg);
    border: 1px solid var(--sc-border);
    border-radius: 20px;
    padding: clamp(20px, 3vw, 32px);
    box-shadow: 0 8px 30px rgba(15,23,42,.05);
}
.skill-create .sc-section-title {
    color: var(--sc-text); font-size: 18px; font-weight: 800;
    border-bottom: 1px solid var(--sc-border);
    padding-bottom: 16px; margin-bottom: 22px;
}
.skill-create .form-label { color: var(--sc-text); font-weight: 650; }
.skill-create .form-control {
    background: var(--sc-soft); color: var(--sc-text);
    border: 1px solid var(--sc-border); border-radius: 11px;
    padding: 12px 14px;
}
.skill-create .form-control:focus {
    background: var(--sc-bg); color: var(--sc-text);
    border-color: #60a5fa; box-shadow: 0 0 0 .2rem rgba(59,130,246,.16);
}
.skill-create .form-control::placeholder { color: var(--sc-muted); opacity: .9; }
.skill-create .sc-level-panel {
    background: var(--sc-soft); border: 1px solid var(--sc-border);
    border-radius: 16px; padding: 20px;
}
.skill-create .sc-range { accent-color: #2563eb; cursor: pointer; width: 100%; }
.skill-create .sc-percent {
    font-size: 29px; font-weight: 800; color: #3b82f6;
    min-width: 76px; text-align: right;
}
.skill-create .sc-progress {
    width: 100%; height: 11px; background: var(--sc-border);
    border-radius: 999px; overflow: hidden;
}
.skill-create .sc-progress-bar {
    height: 100%; width: 50%; background: linear-gradient(90deg,#2563eb,#38bdf8);
    border-radius: inherit; transition: width .12s ease;
}
.skill-create .sc-action {
    display: flex; flex-wrap: wrap; gap: 12px; align-items: center;
}
.skill-create .sc-back {
    border: 1px solid var(--sc-border); color: var(--sc-text);
    background: var(--sc-soft); border-radius: 11px;
    text-decoration: none; padding: 11px 18px;
}
.skill-create .sc-back:hover { color: var(--sc-text); border-color: #60a5fa; }
.skill-create .sc-save { border-radius: 11px; padding: 11px 22px; font-weight: 700; }
.skill-create .sc-hint { color: var(--sc-muted); font-size: 13px; }
</style>
@endpush

@section('content')
<div class="skill-create container-fluid px-0">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="sc-heading h3 mb-1">Thêm kỹ năng mới</h1>
            <p class="sc-muted mb-0">Bổ sung kỹ năng và thiết lập mức độ hiển thị trên Portfolio.</p>
        </div>
        <a href="{{ route('admin.skills.index') }}" class="sc-back">
            <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger rounded-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Vui lòng kiểm tra lại thông tin kỹ năng.
        </div>
    @endif

    <div class="row g-4">
        <div class="col-xl-8">
            <section class="sc-card">
                <h2 class="sc-section-title"><i class="bi bi-code-slash text-primary me-2"></i>Thông tin kỹ năng</h2>

                <form method="POST" action="{{ route('admin.skills.store') }}" id="createSkillForm">
                    @csrf

                    <div class="mb-4">
                        <label for="skillName" class="form-label">Tên kỹ năng <span class="text-danger">*</span></label>
                        <input id="skillName" type="text" name="name"
                               value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Ví dụ: Laravel, PHP, Python, MySQL..."
                               autocomplete="off" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <p class="sc-hint mt-2 mb-0">Nhập tên ngôn ngữ, công cụ hoặc công nghệ bạn muốn giới thiệu.</p>
                    </div>

                    <div class="mb-4">
                        <label for="skillLevel" class="form-label">Mức độ (0–100) <span class="text-danger">*</span></label>
                        <div class="sc-level-panel">
                            <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
                                <span class="sc-muted small">Điều chỉnh mức độ</span>
                                <span class="sc-percent" id="skillPercent">50%</span>
                            </div>
                            <input id="skillLevelRange" type="range" class="sc-range mb-3"
                                   min="0" max="100" step="1"
                                   value="{{ old('level', 50) }}"
                                   aria-label="Điều chỉnh mức độ kỹ năng">
                            <div class="sc-progress mb-3" role="progressbar" id="skillProgress"
                                 aria-label="Mức độ kỹ năng" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50">
                                <div class="sc-progress-bar" id="skillProgressBar"></div>
                            </div>
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <label for="skillLevel" class="form-label mb-0">Giá trị chính xác</label>
                                <input id="skillLevel" type="number" name="level"
                                       class="form-control @error('level') is-invalid @enderror"
                                       style="max-width: 130px;"
                                       min="0" max="100" step="1"
                                       value="{{ old('level', 50) }}" required>
                                <span class="sc-muted small">%</span>
                                @error('level')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <p class="sc-hint mt-2 mb-0">Có thể kéo thanh trượt hoặc nhập trực tiếp số từ 0 đến 100.</p>
                    </div>

                    <div class="sc-action">
                        <button type="submit" class="btn btn-primary sc-save">
                            <i class="bi bi-check2-circle me-1"></i> Lưu kỹ năng
                        </button>
                        <a href="{{ route('admin.skills.index') }}" class="sc-back">Hủy</a>
                    </div>
                </form>
            </section>
        </div>

        <div class="col-xl-4">
            <aside class="sc-card">
                <h2 class="sc-section-title"><i class="bi bi-lightbulb text-warning me-2"></i>Gợi ý nhập liệu</h2>
                <p class="sc-muted mb-3">Bạn có thể thêm kỹ năng theo từng nhóm:</p>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge text-bg-primary">Laravel</span>
                    <span class="badge text-bg-secondary">PHP</span>
                    <span class="badge text-bg-success">Python</span>
                    <span class="badge text-bg-info">MySQL</span>
                    <span class="badge text-bg-dark">Bootstrap</span>
                </div>
                <p class="sc-hint mb-0">Mức độ là giá trị do bạn tự đánh giá và có thể cập nhật lại sau.</p>
            </aside>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const number = document.getElementById('skillLevel');
    const range = document.getElementById('skillLevelRange');
    const percent = document.getElementById('skillPercent');
    const bar = document.getElementById('skillProgressBar');
    const progress = document.getElementById('skillProgress');
    if (!number || !range || !percent || !bar || !progress) return;

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
    range.addEventListener('input', function () {
        number.value = range.value;
        render(range.value);
    });
    number.addEventListener('input', function () {
        render(number.value);
    });
    number.addEventListener('change', function () {
        number.value = clamp(number.value);
        render(number.value);
    });
    render(number.value);
});
</script>
@endpush
