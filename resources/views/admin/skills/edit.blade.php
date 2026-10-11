@extends('layouts.admin')

@section('title', 'Sửa kỹ năng')
@section('page_title', 'Chỉnh sửa kỹ năng')

@push('styles')
<style>
.skill-edit { --se-bg:#fff; --se-text:#0f172a; --se-muted:#64748b; --se-border:#dbe3ef; --se-soft:#f8fafc; }
html[data-bs-theme="dark"] .skill-edit, html[data-theme="dark"] .skill-edit { --se-bg:#17243a; --se-text:#f1f5f9; --se-muted:#b9c8da; --se-border:#34465e; --se-soft:#1e2e46; }
.skill-edit .se-heading {color:var(--se-text);font-weight:800}
.skill-edit .se-muted {color:var(--se-muted)!important}
.skill-edit .se-card {background:var(--se-bg);border:1px solid var(--se-border);border-radius:20px;padding:clamp(20px,3vw,32px);box-shadow:0 8px 30px rgba(15,23,42,.05)}
.skill-edit .se-section-title {color:var(--se-text);font-size:18px;font-weight:800;border-bottom:1px solid var(--se-border);padding-bottom:16px;margin-bottom:22px}
.skill-edit .form-label {color:var(--se-text);font-weight:650}
.skill-edit .form-control {background:var(--se-soft);color:var(--se-text);border:1px solid var(--se-border);border-radius:11px;padding:12px 14px}
.skill-edit .form-control:focus {background:var(--se-bg);color:var(--se-text);border-color:#60a5fa;box-shadow:0 0 0 .2rem rgba(59,130,246,.16)}
.skill-edit .form-control::placeholder {color:var(--se-muted);opacity:.9}
.skill-edit .se-level-panel {background:var(--se-soft);border:1px solid var(--se-border);border-radius:16px;padding:20px}
.skill-edit .se-range {accent-color:#2563eb;cursor:pointer;width:100%}
.skill-edit .se-percent {font-size:29px;font-weight:800;color:#3b82f6;min-width:76px;text-align:right}
.skill-edit .se-progress {height:11px;background:var(--se-border);border-radius:999px;overflow:hidden}
.skill-edit .se-progress-bar {height:100%;background:linear-gradient(90deg,#2563eb,#38bdf8);border-radius:inherit;transition:width .12s ease}
.skill-edit .se-actions {display:flex;flex-wrap:wrap;gap:12px;align-items:center}
.skill-edit .se-back {border:1px solid var(--se-border);color:var(--se-text);background:var(--se-soft);border-radius:11px;text-decoration:none;padding:11px 18px}
.skill-edit .se-back:hover {color:var(--se-text);border-color:#60a5fa}
.skill-edit .se-save {border-radius:11px;padding:11px 22px;font-weight:700}
.skill-edit .se-hint {color:var(--se-muted);font-size:13px}
</style>
@endpush

@section('content')
<div class="skill-edit container-fluid px-0">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="se-heading h3 mb-1">Chỉnh sửa kỹ năng</h1>
            <p class="se-muted mb-0">Cập nhật thông tin cho kỹ năng: <strong>{{ $skill->name }}</strong></p>
        </div>
        <a href="{{ route('admin.skills.index') }}" class="se-back"><i class="bi bi-arrow-left me-1"></i> Quay lại danh sách</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger rounded-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> Vui lòng kiểm tra lại thông tin kỹ năng.
        </div>
    @endif

    <div class="row g-4">
        <div class="col-xl-8">
            <section class="se-card">
                <h2 class="se-section-title"><i class="bi bi-pencil-square text-primary me-2"></i>Thông tin kỹ năng</h2>
                <form method="POST" action="{{ route('admin.skills.update', $skill) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="skillName" class="form-label">Tên kỹ năng <span class="text-danger">*</span></label>
                        <input id="skillName" type="text" name="name" value="{{ old('name', $skill->name) }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Ví dụ: Laravel, PHP, Python, MySQL..." required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="skillLevel" class="form-label">Mức độ (0–100) <span class="text-danger">*</span></label>
                        <div class="se-level-panel">
                            <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
                                <span class="se-muted small">Điều chỉnh mức độ</span>
                                <span class="se-percent" id="skillPercent">{{ old('level', $skill->level) }}%</span>
                            </div>
                            <input id="skillLevelRange" class="se-range mb-3" type="range" min="0" max="100" step="1"
                                   value="{{ old('level', $skill->level) }}" aria-label="Điều chỉnh mức độ kỹ năng">
                            <div class="se-progress mb-3" id="skillProgress" role="progressbar"
                                 aria-label="Mức độ kỹ năng" aria-valuemin="0" aria-valuemax="100"
                                 aria-valuenow="{{ old('level', $skill->level) }}">
                                <div class="se-progress-bar" id="skillProgressBar" style="width: {{ max(0, min(100, (int) old('level', $skill->level))) }}%"></div>
                            </div>
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <label for="skillLevel" class="form-label mb-0">Giá trị chính xác</label>
                                <input id="skillLevel" type="number" name="level" min="0" max="100" step="1"
                                       value="{{ old('level', $skill->level) }}" required
                                       class="form-control @error('level') is-invalid @enderror" style="max-width:130px">
                                <span class="se-muted small">%</span>
                                @error('level')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <p class="se-hint mt-2 mb-0">Kéo thanh trượt hoặc nhập số từ 0 đến 100 để thay đổi mức độ.</p>
                    </div>
                    <div class="se-actions">
                        <button type="submit" class="btn btn-primary se-save"><i class="bi bi-check2-circle me-1"></i> Cập nhật kỹ năng</button>
                        <a href="{{ route('admin.skills.index') }}" class="se-back">Hủy thay đổi</a>
                    </div>
                </form>
            </section>
        </div>
        <div class="col-xl-4">
            <aside class="se-card">
                <h2 class="se-section-title"><i class="bi bi-info-circle text-primary me-2"></i>Thông tin hiện tại</h2>
                <p class="se-muted small mb-2">Mã kỹ năng</p>
                <p class="fw-semibold se-heading">#{{ $skill->id }}</p>
                <p class="se-muted small mb-2">Tên đang lưu</p>
                <p class="fw-semibold se-heading">{{ $skill->name }}</p>
                <p class="se-muted small mb-2">Mức độ đang lưu</p>
                <p class="fw-semibold se-heading mb-0">{{ $skill->level }}%</p>
                <hr>
                <p class="se-hint mb-0">Dữ liệu trong hộp này là thông tin đang lưu. Chỉ khi nhấn “Cập nhật kỹ năng”, thay đổi mới được gửi đến máy chủ.</p>
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
    const clamp = value => Math.max(0, Math.min(100, Math.round(Number(value) || 0)));
    function render(value) {
        const level = clamp(value);
        range.value = String(level);
        percent.textContent = level + '%';
        bar.style.width = level + '%';
        progress.setAttribute('aria-valuenow', String(level));
    }
    range.addEventListener('input', function () { number.value = range.value; render(range.value); });
    number.addEventListener('input', function () { render(number.value); });
    number.addEventListener('change', function () { number.value = clamp(number.value); render(number.value); });
    render(number.value);
});
</script>
@endpush
