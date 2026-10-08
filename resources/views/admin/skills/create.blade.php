
@extends('layouts.app')

@section('title', 'Thêm kỹ năng')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Thêm kỹ năng</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.skills.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên kỹ năng</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mức độ (0–100)</label>
            <input type="number" name="level" class="form-control"
                   min="0" max="100"
                   value="{{ old('level', 50) }}" required>
        </div>

        <button class="btn btn-success">Lưu kỹ năng</button>
        <a href="{{ route('admin.skills.index') }}"
           class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
