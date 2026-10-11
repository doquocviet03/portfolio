

@extends('layouts.admin')



@section('title', 'Hồ sơ cá nhân')

@section('page_title', 'Quản lý hồ sơ cá nhân')



@push('styles')

<style>

    .profile-panel {

        background: white;

        border: 1px solid #e2e8f0;

        border-radius: 18px;

        padding: 26px;

        box-shadow: 0 6px 24px rgba(15,23,42,.04);

        margin-bottom: 24px;

    }



    .profile-heading {

        font-size: 18px;

        font-weight: 750;

        margin-bottom: 22px;

    }



    .profile-avatar {

        width: 145px;

        height: 145px;

        border-radius: 50%;

        object-fit: cover;

        border: 5px solid #eff6ff;

        background: #f1f5f9;

    }



    .avatar-placeholder {

        width: 145px;

        height: 145px;

        border-radius: 50%;

        background: #dbeafe;

        color: #2563eb;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 58px;

    }



    .form-label {

        font-weight: 600;

        color: var(--bs-body-color, #334155);

    }



    .form-control {

        border-radius: 10px;

        padding: 11px 13px;

    }



    .form-control:focus {

        border-color: #93c5fd;

        box-shadow: 0 0 0 .2rem rgba(37,99,235,.12);

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

                             src="{{ asset('storage/' . $profile->avatar) }}"

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

                    JPG, PNG hoặc WEBP. Tối đa 2 MB.

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



            if (file.size > 2 * 1024 * 1024) {

                alert('Ảnh không được vượt quá 2 MB.');

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

@endpush
