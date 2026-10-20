

@extends('layouts.admin')



@section('title', 'Hồ sơ cá nhân')

@section('page_title', 'Quản lý hồ sơ cá nhân')



@push('styles')

<style>

    
.profile-panel {
    --profile-bg: #ffffff;
    --profile-text: #0f172a;
    --profile-muted: #64748b;
    --profile-border: #e2e8f0;
    --profile-input-bg: #f8fafc;

    background: var(--profile-bg);
    color: var(--profile-text);
    border: 1px solid var(--profile-border);
    border-radius: 18px;
    padding: 26px;
    box-shadow: 0 6px 24px rgba(15, 23, 42, .04);
    margin-bottom: 24px;
}

/* DARK MODE */
html[data-bs-theme="dark"] .profile-panel,
html[data-theme="dark"] .profile-panel {
    --profile-bg: #17243a;
    --profile-text: #f1f5f9;
    --profile-muted: #b9c8da;
    --profile-border: #34465e;
    --profile-input-bg: #101b2e;
}

/* TIÊU ĐỀ */
.profile-panel .profile-heading {
    font-size: 18px;
    font-weight: 750;
    margin-bottom: 22px;
    color: var(--profile-text);
}

/* NHÃN FORM */
.profile-panel .form-label {
    font-weight: 600;
    color: var(--profile-text);
}

/* INPUT VÀ TEXTAREA */
.profile-panel .form-control {
    background: var(--profile-input-bg);
    color: var(--profile-text);
    border: 1px solid var(--profile-border);
    border-radius: 10px;
    padding: 11px 13px;
}

.profile-panel .form-control:focus {
    background: var(--profile-bg);
    color: var(--profile-text);
    border-color: #60a5fa;
    box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .12);
}

.profile-panel .form-control::placeholder {
    color: var(--profile-muted);
    opacity: .85;
}

/* CHỮ PHỤ */
.profile-panel .text-muted,
.profile-panel small {
    color: var(--profile-muted) !important;
}

/* AVATAR */
.profile-avatar {
    width: 145px;
    height: 145px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid var(--profile-border);
    background: var(--profile-input-bg);
}

.avatar-placeholder {
    width: 145px;
    height: 145px;
    border-radius: 50%;
    background: var(--profile-input-bg);
    color: #60a5fa;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 58px;
}

/* RESPONSIVE */
@media (max-width: 767px) {
    .profile-panel {
        padding: 20px;
        border-radius: 16px;
    }
}


</style>

@endpush



@section('content')



<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

    <div>

        <h3 class="fw-bold mb-1">Hồ sơ cá nhân</h3>

        <p class="text-muted mb-0">

            Cập nhật thông tin hiển thị trên Portfolio.

        </p>

    </div>



    <a href="{{ route('home') }}"

       target="_blank"

       rel="noopener noreferrer"

       class="btn btn-outline-primary">

        <i class="bi bi-globe me-2"></i>

        Xem website

    </a>

</div>



@if($errors->any())

    <div class="alert alert-danger">

        <strong>Vui lòng kiểm tra lại dữ liệu:</strong>



        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif



<form action="{{ route('admin.profile.update') }}"

      method="POST"

      enctype="multipart/form-data">



    @csrf

    @method('PUT')



    <div class="row g-4">



        <div class="col-lg-4">



            <div class="profile-panel text-center">



                <h5 class="profile-heading">

                    <i class="bi bi-person-circle text-primary me-2"></i>

                    Ảnh đại diện

                </h5>



                <div class="d-flex justify-content-center mb-3">



                    @if($profile?->avatar)

                        <img id="avatarPreview"

                             src="{{ asset('uploads/' . $profile->avatar) }}"

                             class="profile-avatar"

                             alt="Ảnh đại diện">

                    @else

                        <div id="avatarPlaceholder"

                             class="avatar-placeholder">

                            <i class="bi bi-person"></i>

                        </div>



                        <img id="avatarPreview"

                             class="profile-avatar d-none"

                             alt="Ảnh đại diện">

                    @endif



                </div>



                <input type="file"

                       name="avatar"

                       id="avatarInput"

                       class="form-control @error('avatar') is-invalid @enderror"

                       accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">



                <small class="text-muted d-block mt-3">

                    JPG, PNG hoặc WEBP. Tối đa 10 MB.

                </small>



            </div>



            <div class="profile-panel">



                <h5 class="profile-heading">

                    <i class="bi bi-link-45deg text-primary me-2"></i>

                    Mạng xã hội

                </h5>



                <div class="mb-3">

                    <label class="form-label">GitHub</label>



                    <input type="url"

                           name="github_url"

                           class="form-control"

                           placeholder="https://github.com/..."

                           value="{{ old('github_url', $profile?->github_url) }}">

                </div>



                <div class="mb-3">

                    <label class="form-label">Facebook</label>



                    <input type="url"

                           name="facebook_url"

                           class="form-control"

                           placeholder="https://facebook.com/..."

                           value="{{ old('facebook_url', $profile?->facebook_url) }}">

                </div>



                <div>

                    <label class="form-label">LinkedIn</label>



                    <input type="url"

                           name="linkedin_url"

                           class="form-control"

                           placeholder="https://linkedin.com/in/..."

                           value="{{ old('linkedin_url', $profile?->linkedin_url) }}">

                </div>



            </div>



        </div>



        <div class="col-lg-8">



            <div class="profile-panel">



                <h5 class="profile-heading">

                    <i class="bi bi-person-vcard text-primary me-2"></i>

                    Thông tin cơ bản

                </h5>



                <div class="row g-3">



                    <div class="col-md-6">

                        <label class="form-label">

                            Họ và tên <span class="text-danger">*</span>

                        </label>



                        <input type="text"

                               name="full_name"

                               class="form-control"

                               value="{{ old('full_name', $profile?->full_name) }}"

                               required>

                    </div>



                    <div class="col-md-6">

                        <label class="form-label">Chức danh</label>



                        <input type="text"

                               name="job_title"

                               class="form-control"

                               placeholder="Web Developer"

                               value="{{ old('job_title', $profile?->job_title) }}">

                    </div>



                    <div class="col-md-6">

                        <label class="form-label">Lĩnh vực</label>



                        <input type="text"

                               name="field"

                               class="form-control"

                               value="{{ old('field', $profile?->field) }}">

                    </div>



                    <div class="col-md-6">

                        <label class="form-label">Khu vực</label>



                        <input type="text"

                               name="location"

                               class="form-control"

                               value="{{ old('location', $profile?->location) }}">

                    </div>



                    <div class="col-12">

                        <label class="form-label">Email liên hệ</label>



                        <input type="email"

                               name="contact_email"

                               class="form-control"

                               value="{{ old('contact_email', $profile?->contact_email) }}">

                    </div>

                        <div class="col-md-6">
                            <label for="profile-phone" class="form-label">Số điện thoại</label>
                            <input type="tel"
                                   id="profile-phone"
                                   name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', $profile?->phone) }}"
                                   placeholder="Ví dụ: 0987 654 321"
                                   autocomplete="tel"
                                   maxlength="20">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                </div>



            </div>



            <div class="profile-panel">



                <h5 class="profile-heading">

                    <i class="bi bi-file-person text-primary me-2"></i>

                    Nội dung giới thiệu

                </h5>



                <div class="mb-4">

                    <label class="form-label">Giới thiệu ngắn</label>



                    <textarea name="short_bio"

                              class="form-control"

                              rows="3">{{ old('short_bio', $profile?->short_bio) }}</textarea>

                </div>



                <div class="mb-4">

                    <label class="form-label">Giới thiệu chi tiết</label>



                    <textarea name="about_me"

                              class="form-control"

                              rows="7">{{ old('about_me', $profile?->about_me) }}</textarea>

                </div>



                <div>

                    <label class="form-label">Mục tiêu nghề nghiệp</label>



                    <textarea name="career_goal"

                              class="form-control"

                              rows="5">{{ old('career_goal', $profile?->career_goal) }}</textarea>

                </div>



            </div>



            <div class="profile-panel">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                    <h5 class="profile-heading mb-0"><i class="bi bi-translate text-primary me-2"></i>Nội dung tiếng Anh (English)</h5>
                    <button type="button" id="translateProfileBtn" class="btn btn-outline-primary"><i class="bi bi-translate me-1"></i>Tự động dịch sang English</button>
                </div>
                <p class="text-muted small">Nhập nội dung tiếng Việt ở phía trên, nhấn tự động dịch, kiểm tra bản dịch rồi nhấn Lưu thông tin.</p>
                <div id="profileTranslateStatus" class="alert d-none" role="status" aria-live="polite"></div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="job_title_en" class="form-label">Chức danh tiếng Anh</label>
                        <input type="text" id="job_title_en" name="job_title_en" class="form-control @error('job_title_en') is-invalid @enderror" maxlength="255" value="{{ old('job_title_en', $profile?->job_title_en) }}">
                        @error('job_title_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="field_en" class="form-label">Lĩnh vực tiếng Anh</label>
                        <input type="text" id="field_en" name="field_en" class="form-control @error('field_en') is-invalid @enderror" maxlength="255" value="{{ old('field_en', $profile?->field_en) }}">
                        @error('field_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label for="short_bio_en" class="form-label">Giới thiệu ngắn tiếng Anh</label>
                        <textarea id="short_bio_en" name="short_bio_en" rows="3" class="form-control @error('short_bio_en') is-invalid @enderror" maxlength="2000">{{ old('short_bio_en', $profile?->short_bio_en) }}</textarea>
                        @error('short_bio_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label for="about_me_en" class="form-label">Giới thiệu chi tiết tiếng Anh</label>
                        <textarea id="about_me_en" name="about_me_en" rows="6" class="form-control @error('about_me_en') is-invalid @enderror">{{ old('about_me_en', $profile?->about_me_en) }}</textarea>
                        @error('about_me_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label for="career_goal_en" class="form-label">Mục tiêu nghề nghiệp tiếng Anh</label>
                        <textarea id="career_goal_en" name="career_goal_en" rows="6" class="form-control @error('career_goal_en') is-invalid @enderror">{{ old('career_goal_en', $profile?->career_goal_en) }}</textarea>
                        @error('career_goal_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-3">



                <button type="submit"

                        class="btn btn-primary px-4 py-2">

                    <i class="bi bi-floppy me-2"></i>

                    Lưu thông tin

                </button>



                <a href="{{ route('admin.dashboard') }}"

                   class="btn btn-outline-secondary px-4 py-2">

                    Quay lại Dashboard

                </a>



            </div>



        </div>



    </div>



</form>



@endsection



@push('scripts')

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const input = document.getElementById('avatarInput');

        const preview = document.getElementById('avatarPreview');

        const placeholder = document.getElementById('avatarPlaceholder');



        let previousUrl = null;



        input.addEventListener('change', function () {

            const file = this.files[0];



            if (!file) return;



            if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {

                alert('Vui lòng chọn ảnh JPG, PNG hoặc WEBP.');

                this.value = '';

                return;

            }



            if (file.size > 10 * 1024 * 1024) {

                alert('Ảnh không được vượt quá 10 MB.');

                this.value = '';

                return;

            }



            if (previousUrl) {

                URL.revokeObjectURL(previousUrl);

            }



            previousUrl = URL.createObjectURL(file);



            preview.src = previousUrl;

            preview.classList.remove('d-none');



            if (placeholder) {

                placeholder.classList.add('d-none');

            }

        });

    });

</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('translateProfileBtn');
    const status = document.getElementById('profileTranslateStatus');
    if (!button || !status) return;

    const fields = ['job_title', 'field', 'short_bio', 'about_me', 'career_goal'];
    const showStatus = (message, kind) => {
        status.textContent = message;
        status.className = 'alert alert-' + kind;
    };

    button.addEventListener('click', async function () {
        const payload = {};
        fields.forEach(field => {
            payload[field] = document.querySelector('[name="' + field + '"]')?.value || '';
        });

        if (!fields.some(field => payload[field].trim() !== '')) {
            showStatus('Hãy nhập ít nhất một nội dung tiếng Việt trước khi dịch.', 'warning');
            return;
        }

        button.disabled = true;
        showStatus('Đang dịch nội dung, vui lòng chờ...', 'info');
        try {
            const response = await fetch(@json(route('admin.profile.translate')), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': @json(csrf_token()),
                },
                credentials: 'same-origin',
                body: JSON.stringify(payload)
            });
            const data = await response.json();
            if (!response.ok) {
                const validationMessage = data.errors
                    ? Object.values(data.errors).flat().join(' ')
                    : null;
                throw new Error(validationMessage || data.message || 'Không thể dịch nội dung.');
            }
            if (!data.translations) throw new Error('Phản hồi dịch không hợp lệ.');

            fields.forEach(field => {
                const target = document.querySelector('[name="' + field + '_en"]');
                if (target && Object.prototype.hasOwnProperty.call(data.translations, field + '_en')) {
                    target.value = data.translations[field + '_en'] ?? '';
                }
            });
            showStatus('Đã dịch xong. Hãy kiểm tra bản dịch và nhấn Lưu thông tin để lưu vào database.', 'success');
        } catch (error) {
            showStatus(error.message || 'Có lỗi khi dịch. Vui lòng thử lại.', 'danger');
        } finally {
            button.disabled = false;
        }
    });
});
</script>
@endpush
