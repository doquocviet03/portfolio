@extends('layouts.admin')

@section('title', 'Chỉnh sửa kinh nghiệm')
@section('page_title', 'Chỉnh sửa kinh nghiệm')

@push('styles')
<style>
.experience-edit {
    --ee-surface: #fff;
    --ee-soft: #f8fafc;
    --ee-text: #0f172a;
    --ee-muted: #64748b;
    --ee-border: #e2e8f0;
}
html[data-bs-theme="dark"] .experience-edit,
html[data-theme="dark"] .experience-edit {
    --ee-surface: #17243a;
    --ee-soft: #1e2e46;
    --ee-text: #f1f5f9;
    --ee-muted: #b9c8da;
    --ee-border: #34465e;
}
.experience-edit .ee-heading { color: var(--ee-text); font-weight: 800; }
.experience-edit .ee-muted { color: var(--ee-muted) !important; }
.experience-edit .ee-card {
    background: var(--ee-surface);
    border: 1px solid var(--ee-border);
    border-radius: 20px;
    padding: clamp(20px, 3vw, 32px);
    box-shadow: 0 8px 30px rgba(15, 23, 42, .05);
}
.experience-edit .ee-card-title {
    font-size: 18px; font-weight: 800; color: var(--ee-text);
    border-bottom: 1px solid var(--ee-border);
    padding-bottom: 16px; margin-bottom: 22px;
}
.experience-edit .form-label { color: var(--ee-text); font-weight: 650; }
.experience-edit .form-control {
    color: var(--ee-text); background: var(--ee-soft);
    border: 1px solid var(--ee-border);
    border-radius: 11px; padding: 12px 14px;
}
.experience-edit .form-control::placeholder { color: var(--ee-muted); opacity: .9; }
.experience-edit .form-control:focus {
    color: var(--ee-text); background: var(--ee-surface);
    border-color: #60a5fa; box-shadow: 0 0 0 .2rem rgba(59, 130, 246, .16);
}
.experience-edit .ee-help { color: var(--ee-muted); font-size: 13px; }
.experience-edit .ee-back {
    display: inline-flex; align-items: center; gap: 7px;
    border: 1px solid var(--ee-border); background: var(--ee-soft);
    color: var(--ee-text); border-radius: 11px;
    padding: 11px 17px; text-decoration: none; font-weight: 600;
}
.experience-edit .ee-back:hover { color: var(--ee-text); border-color: #60a5fa; }
.experience-edit .ee-submit { border-radius: 11px; padding: 11px 22px; font-weight: 700; }
.experience-edit .ee-detail {
    background: var(--ee-soft); border: 1px solid var(--ee-border);
    border-radius: 13px; padding: 15px;
}
.experience-edit .ee-detail + .ee-detail { margin-top: 12px; }
.experience-edit .ee-detail-label { color: var(--ee-muted); font-size: 12px; margin-bottom: 5px; }
.experience-edit .ee-detail-value { color: var(--ee-text); font-weight: 650; overflow-wrap: anywhere; }
.experience-edit .ee-status {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(34, 197, 94, .12); color: #16a34a;
    padding: 5px 10px; border-radius: 999px; font-size: 12px; font-weight: 700;
}
</style>
@endpush

@section('content')
<div class="experience-edit container-fluid px-0">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="ee-heading h3 mb-1">Chỉnh sửa kinh nghiệm</h1>
            <p class="ee-muted mb-0">Cập nhật thông tin công việc hoặc quá trình học tập trên Portfolio.</p>
        </div>
        <a href="{{ route('admin.experiences.index') }}" class="ee-back">
            <i class="bi bi-arrow-left"></i> Danh sách kinh nghiệm
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger rounded-3" role="alert">
            <div class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Vui lòng kiểm tra lại thông tin</div>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-xl-8">
            <section class="ee-card">
                <h2 class="ee-card-title"><i class="bi bi-pencil-square text-primary me-2"></i>Thông tin kinh nghiệm</h2>
                <form action="{{ route('admin.experiences.update', $experience) }}" method="POST" id="editExperienceForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="experienceTitle" class="form-label">Vị trí / Kinh nghiệm <span class="text-danger">*</span></label>
                        <input type="text" id="experienceTitle" name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $experience->title) }}"
                               placeholder="Ví dụ: Thực tập sinh lập trình Web" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="experienceCompany" class="form-label">Công ty / Trường học <span class="text-danger">*</span></label>
                        <input type="text" id="experienceCompany" name="company"
                               class="form-control @error('company') is-invalid @enderror"
                               value="{{ old('company', $experience->company) }}"
                               placeholder="Ví dụ: Công ty ABC hoặc Trường Đại học XYZ" required>
                        @error('company') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="experienceDescription" class="form-label">Mô tả</label>
                        <textarea id="experienceDescription" name="description" rows="5"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Mô tả công việc, nhiệm vụ, thành tích hoặc kiến thức đã học...">{{ old('description', $experience->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <p class="ee-help mt-2 mb-0">Có thể ghi các nhiệm vụ và kết quả nổi bật trong quá trình làm việc hoặc học tập.</p>
                    </div>

                    <h2 class="ee-card-title mt-4"><i class="bi bi-calendar3 text-primary me-2"></i>Thời gian</h2>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="experienceStart" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                            <input type="date" id="experienceStart" name="start_date"
                                   class="form-control @error('start_date') is-invalid @enderror"
                                   value="{{ old('start_date', $experience->start_date?->format('Y-m-d')) }}" required>
                            @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="experienceEnd" class="form-label">Ngày kết thúc</label>
                            <input type="date" id="experienceEnd" name="end_date"
                                   class="form-control @error('end_date') is-invalid @enderror"
                                   value="{{ old('end_date', $experience->end_date?->format('Y-m-d')) }}">
                            @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <p class="ee-help mb-3"><i class="bi bi-info-circle me-1"></i>Để trống ngày kết thúc nếu bạn vẫn đang làm việc hoặc học tập tại đây.</p>
                    <div id="dateWarning" class="alert alert-warning d-none rounded-3" role="alert">
                        <i class="bi bi-exclamation-circle me-1"></i>Ngày kết thúc không được trước ngày bắt đầu.
                    </div>

                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <button type="submit" class="btn btn-primary ee-submit">
                            <i class="bi bi-check2-circle me-1"></i> Cập nhật kinh nghiệm
                        </button>
                        <a href="{{ route('admin.experiences.index') }}" class="ee-back">Hủy</a>
                    </div>
                </form>
            </section>
        </div>

        <div class="col-xl-4">
            <aside class="ee-card">
                <h2 class="ee-card-title"><i class="bi bi-info-circle text-primary me-2"></i>Dữ liệu hiện tại</h2>
                <div class="ee-detail">
                    <div class="ee-detail-label">Mã kinh nghiệm</div>
                    <div class="ee-detail-value">#{{ $experience->id }}</div>
                </div>
                <div class="ee-detail">
                    <div class="ee-detail-label">Vị trí / Kinh nghiệm</div>
                    <div class="ee-detail-value">{{ $experience->title }}</div>
                </div>
                <div class="ee-detail">
                    <div class="ee-detail-label">Công ty / Trường học</div>
                    <div class="ee-detail-value">{{ $experience->company }}</div>
                </div>
                <div class="ee-detail">
                    <div class="ee-detail-label">Bắt đầu</div>
                    <div class="ee-detail-value">{{ $experience->start_date?->format('d/m/Y') ?? 'Chưa có' }}</div>
                </div>
                <div class="ee-detail">
                    <div class="ee-detail-label">Kết thúc</div>
                    <div class="ee-detail-value">
                        @if($experience->end_date)
                            {{ $experience->end_date->format('d/m/Y') }}
                        @else
                            <span class="ee-status"><i class="bi bi-circle-fill" style="font-size: 7px;"></i> Hiện tại</span>
                        @endif
                    </div>
                </div>
                <p class="ee-help mt-3 mb-0">Thông tin bên phải là dữ liệu đang lưu, chưa bao gồm những thay đổi bạn đang nhập.</p>
            </aside>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('editExperienceForm');
    const start = document.getElementById('experienceStart');
    const end = document.getElementById('experienceEnd');
    const warning = document.getElementById('dateWarning');
    if (!form || !start || !end || !warning) return;

    function validateDates() {
        const invalid = Boolean(start.value && end.value && end.value < start.value);
        end.setCustomValidity(invalid ? 'Ngày kết thúc không được trước ngày bắt đầu.' : '');
        end.classList.toggle('is-invalid', invalid);
        warning.classList.toggle('d-none', !invalid);
        return !invalid;
    }
    start.addEventListener('change', validateDates);
    end.addEventListener('change', validateDates);
    form.addEventListener('submit', function (event) {
        if (!validateDates()) {
            event.preventDefault();
            end.reportValidity();
        }
    });
});
</script>
@endpush
