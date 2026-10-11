@extends('layouts.admin')

@section('title', 'Thêm kinh nghiệm')
@section('page_title', 'Thêm kinh nghiệm')

@push('styles')
<style>
.experience-create { --ec-card:#fff; --ec-text:#0f172a; --ec-muted:#64748b; --ec-border:#dbe3ef; --ec-soft:#f8fafc; }
html[data-bs-theme="dark"] .experience-create, html[data-theme="dark"] .experience-create { --ec-card:#17243a; --ec-text:#f1f5f9; --ec-muted:#b8c5d8; --ec-border:#34465e; --ec-soft:#1e2e46; }
.experience-create .ec-heading { color:var(--ec-text); font-weight:800; }
.experience-create .ec-muted { color:var(--ec-muted)!important; }
.experience-create .ec-card { background:var(--ec-card); border:1px solid var(--ec-border); border-radius:20px; padding:clamp(20px,3vw,32px); box-shadow:0 8px 30px rgba(15,23,42,.05); }
.experience-create .ec-title { color:var(--ec-text); font-size:18px; font-weight:800; padding-bottom:16px; margin-bottom:22px; border-bottom:1px solid var(--ec-border); }
.experience-create .form-label { color:var(--ec-text); font-weight:650; }
.experience-create .form-control { background:var(--ec-soft); color:var(--ec-text); border:1px solid var(--ec-border); border-radius:11px; padding:12px 14px; }
.experience-create .form-control:focus { background:var(--ec-card); color:var(--ec-text); border-color:#60a5fa; box-shadow:0 0 0 .2rem rgba(59,130,246,.16); }
.experience-create .form-control::placeholder { color:var(--ec-muted); opacity:.85; }
.experience-create .ec-back { background:var(--ec-soft); border:1px solid var(--ec-border); color:var(--ec-text); text-decoration:none; border-radius:11px; padding:11px 18px; display:inline-flex; align-items:center; }
.experience-create .ec-back:hover { color:var(--ec-text); border-color:#60a5fa; }
.experience-create .ec-save { border-radius:11px; padding:11px 22px; font-weight:700; }
.experience-create .ec-note { background:var(--ec-soft); border:1px solid var(--ec-border); border-radius:13px; padding:16px; color:var(--ec-muted); }
.experience-create .ec-actions { display:flex; flex-wrap:wrap; align-items:center; gap:12px; }
.experience-create .ec-hint { color:var(--ec-muted); font-size:13px; }
</style>
@endpush

@section('content')
<div class="experience-create container-fluid px-0">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="ec-heading h3 mb-1">Thêm kinh nghiệm mới</h1>
            <p class="ec-muted mb-0">Bổ sung kinh nghiệm làm việc, thực tập hoặc học tập vào Portfolio.</p>
        </div>
        <a href="{{ route('admin.experiences.index') }}" class="ec-back"><i class="bi bi-arrow-left me-2"></i>Quay lại danh sách</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger rounded-3" role="alert">
            <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Vui lòng kiểm tra lại thông tin:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-xl-8">
            <form action="{{ route('admin.experiences.store') }}" method="POST" class="ec-card">
                @csrf
                <h2 class="ec-title"><i class="bi bi-briefcase text-primary me-2"></i>Thông tin kinh nghiệm</h2>

                <div class="mb-4">
                    <label for="experienceTitle" class="form-label">Vị trí / Kinh nghiệm <span class="text-danger">*</span></label>
                    <input id="experienceTitle" type="text" name="title" value="{{ old('title') }}"
                           class="form-control @error('title') is-invalid @enderror"
                           placeholder="Ví dụ: Thực tập sinh QA Game, Sinh viên CNTT..." required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="experienceCompany" class="form-label">Công ty / Trường học <span class="text-danger">*</span></label>
                    <input id="experienceCompany" type="text" name="company" value="{{ old('company') }}"
                           class="form-control @error('company') is-invalid @enderror"
                           placeholder="Tên công ty, tổ chức hoặc trường học" required>
                    @error('company') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="experienceDescription" class="form-label">Mô tả</label>
                    <textarea id="experienceDescription" name="description" rows="6"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Mô tả công việc, nhiệm vụ, công nghệ sử dụng và kết quả đạt được...">{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <p class="ec-hint mt-2 mb-0">Nên viết ngắn gọn những công việc và kết quả nổi bật.</p>
                </div>

                <h2 class="ec-title"><i class="bi bi-calendar3 text-primary me-2"></i>Thời gian</h2>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="experienceStart" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                        <input id="experienceStart" type="date" name="start_date" value="{{ old('start_date') }}"
                               class="form-control @error('start_date') is-invalid @enderror" required>
                        @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="experienceEnd" class="form-label">Ngày kết thúc</label>
                        <input id="experienceEnd" type="date" name="end_date" value="{{ old('end_date') }}"
                               class="form-control @error('end_date') is-invalid @enderror">
                        @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <p class="ec-hint mb-4"><i class="bi bi-info-circle me-1"></i>Để trống ngày kết thúc nếu bạn vẫn đang làm việc hoặc học tập tại đây.</p>

                <div id="dateWarning" class="alert alert-warning d-none" role="alert">
                    Ngày kết thúc không được trước ngày bắt đầu.
                </div>

                <div class="ec-actions">
                    <button type="submit" class="btn btn-primary ec-save" id="saveExperience">
                        <i class="bi bi-check2-circle me-1"></i> Lưu kinh nghiệm
                    </button>
                    <a href="{{ route('admin.experiences.index') }}" class="ec-back">Hủy</a>
                </div>
            </form>
        </div>
        <div class="col-xl-4">
            <aside class="ec-card">
                <h2 class="ec-title"><i class="bi bi-lightbulb text-warning me-2"></i>Gợi ý nhập liệu</h2>
                <div class="ec-note mb-3">
                    <strong class="d-block mb-2" style="color:var(--ec-text)">Vị trí / Kinh nghiệm</strong>
                    Ghi tên vai trò cụ thể, chẳng hạn “Thực tập sinh kiểm thử phần mềm”.
                </div>
                <div class="ec-note mb-3">
                    <strong class="d-block mb-2" style="color:var(--ec-text)">Mô tả</strong>
                    Nêu các nhiệm vụ chính, kỹ năng đã sử dụng và kết quả đạt được.
                </div>
                <div class="ec-note">
                    <strong class="d-block mb-2" style="color:var(--ec-text)">Thời gian</strong>
                    Nếu vẫn đang làm việc, chỉ cần nhập ngày bắt đầu.
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const start = document.getElementById('experienceStart');
    const end = document.getElementById('experienceEnd');
    const warning = document.getElementById('dateWarning');
    if (!start || !end || !warning) return;
    function validateDates() {
        end.min = start.value || '';
        const invalid = Boolean(start.value && end.value && end.value < start.value);
        warning.classList.toggle('d-none', !invalid);
        end.setCustomValidity(invalid ? 'Ngày kết thúc không được trước ngày bắt đầu.' : '');
    }
    start.addEventListener('change', validateDates);
    end.addEventListener('change', validateDates);
    validateDates();
});
</script>
@endpush
