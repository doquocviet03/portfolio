
@extends('layouts.app')

@section('title', 'Thêm dự án')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Thêm dự án mới</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên dự án</label>
            <input type="text" name="title" class="form-control"
                   value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control"
                      rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Công nghệ</label>
            <input type="text" name="technologies"
                   class="form-control"
                   value="{{ old('technologies') }}"
                   placeholder="Laravel, PHP, MySQL">
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh dự án</label>
            <input type="file" name="image"
                   class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">GitHub URL</label>
            <input type="url" name="github_url"
                   class="form-control" value="{{ old('github_url') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Demo URL</label>
            <input type="url" name="demo_url"
                   class="form-control" value="{{ old('demo_url') }}">
        </div>

        <button class="btn btn-success">Lưu dự án</button>
        <a href="{{ route('admin.projects.index') }}"
           class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
