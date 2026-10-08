
@extends('layouts.app')

@section('title', 'Quản lý dự án')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between mb-4">
        <h2>Quản lý dự án</h2>
        <a href="{{ route('admin.projects.create') }}"
           class="btn btn-primary">+ Thêm dự án</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên dự án</th>
                    <th>Công nghệ</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>
                            @if($project->image)
                                <img src="{{ asset('storage/'.$project->image) }}"
                                     width="90" alt="Ảnh dự án">
                            @endif
                        </td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->technologies }}</td>
                        <td>
                            <a href="{{ route('admin.projects.edit', $project) }}"
                               class="btn btn-warning btn-sm">Sửa</a>

                            <form action="{{ route('admin.projects.destroy', $project) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Bạn muốn xóa dự án này?')">
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
                        <td colspan="5" class="text-center">
                            Chưa có dự án nào.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $projects->links() }}
</div>
@endsection
