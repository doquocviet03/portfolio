
@extends('layouts.app')

@section('title', 'Sửa dự án')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Chỉnh sửa dự án</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên dự án</label>
            <input type="text" name="title" class="form-control"
                   value="{{ old('title', $project->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control"
                      rows="4">{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Công nghệ</label>
            <input type="text" name="technologies" class="form-control"
                   value="{{ old('technologies', $project->technologies) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh mới (không bắt buộc)</label>
            <input type="file" name="image"
                   class="form-control" accept="image/*">

            @if($project->image)
                <img src="{{ asset('storage/'.$project->image) }}"
                     width="140" class="mt-3" alt="Ảnh hiện tại">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">GitHub URL</label>
            <input type="url" name="github_url" class="form-control"
                   value="{{ old('github_url', $project->github_url) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Demo URL</label>
            <input type="url" name="demo_url" class="form-control"
                   value="{{ old('demo_url', $project->demo_url) }}">
        </div>

        <button class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.projects.index') }}"
           class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
