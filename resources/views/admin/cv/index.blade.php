
@extends('layouts.admin')

@section('title', 'Quản lý CV')
@section('page_title', 'Quản lý CV PDF')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h3 class="fw-bold">Quản lý CV PDF</h3>
        <p class="text-muted">
            Tải lên, cập nhật và quản lý CV cá nhân.
        </p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="row g-4">

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-cloud-arrow-up me-2"></i>
                        Tải lên CV
                    </h5>

                    <form action="{{ route('admin.cv.store') }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="cv"
                                   class="form-label fw-semibold">
                                Chọn file PDF
                            </label>

                            <input type="file"
                                   name="cv"
                                   id="cv"
                                   class="form-control @error('cv') is-invalid @enderror"
                                   accept=".pdf,application/pdf"
                                   required>

                            <div class="form-text">
                                Chỉ chấp nhận PDF, tối đa 5 MB.
                            </div>
                        </div>

                        <button type="submit"
                                class="btn btn-primary">
                            <i class="bi bi-upload me-1"></i>
                            Lưu CV
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-file-earmark-pdf me-2"></i>
                        CV hiện tại
                    </h5>

                    @if($profile && $profile->cv_path)

                        <div class="alert alert-success">
                            <i class="bi bi-check-circle me-1"></i>
                            Đã tải CV lên hệ thống.
                        </div>

                        <p class="small text-muted text-break">
                            {{ basename($profile->cv_path) }}
                        </p>

                        <div class="d-flex flex-wrap gap-2">

                            <a href="{{ route('cv.preview') }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="btn btn-outline-primary">
                                <i class="bi bi-eye me-1"></i>
                                Xem CV
                            </a>

                            <a href="{{ route('cv.download') }}"
                               class="btn btn-outline-success">
                                <i class="bi bi-download me-1"></i>
                                Tải CV
                            </a>

                            <form action="{{ route('admin.cv.destroy') }}"
                                  method="POST"
                                  onsubmit="return confirm('Bạn chắc chắn muốn xóa CV?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-outline-danger">
                                    <i class="bi bi-trash me-1"></i>
                                    Xóa CV
                                </button>
                            </form>

                        </div>

                    @else

                        <div class="alert alert-warning mb-0">
                            Chưa có CV nào được tải lên.
                        </div>

                    @endif

                </div>
            </div>
        </div>

    </div>

</div>

@endsection
