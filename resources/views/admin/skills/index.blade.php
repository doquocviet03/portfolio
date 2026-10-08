
@extends('layouts.app')

@section('title', 'Quản lý kỹ năng')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between mb-4">
        <h2>Quản lý kỹ năng</h2>
        <a href="{{ route('admin.skills.create') }}"
           class="btn btn-primary">+ Thêm kỹ năng</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên kỹ năng</th>
                <th>Mức độ</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse($skills as $skill)
                <tr>
                    <td>{{ $skill->id }}</td>
                    <td>{{ $skill->name }}</td>
                    <td style="min-width: 180px">
                        <div class="progress">
                            <div class="progress-bar"
                                 style="width: {{ $skill->level }}%">
                                {{ $skill->level }}%
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.skills.edit', $skill) }}"
                           class="btn btn-warning btn-sm">Sửa</a>

                        <form method="POST"
                              action="{{ route('admin.skills.destroy', $skill) }}"
                              class="d-inline"
                              onsubmit="return confirm('Xóa kỹ năng này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">
                        Chưa có kỹ năng nào.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $skills->links() }}
</div>
@endsection
