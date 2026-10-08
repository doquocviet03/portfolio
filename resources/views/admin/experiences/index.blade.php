
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý kinh nghiệm</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Quản lý kinh nghiệm</h2>

        <a href="{{ route('admin.experiences.create') }}"
           class="btn btn-primary">
            + Thêm kinh nghiệm
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Vị trí</th>
                        <th>Công ty / Trường</th>
                        <th>Bắt đầu</th>
                        <th>Kết thúc</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($experiences as $experience)
                        <tr>
                            <td>{{ $experience->id }}</td>
                            <td>{{ $experience->title }}</td>
                            <td>{{ $experience->company }}</td>
                            <td>
                                {{ $experience->start_date?->format('d/m/Y') }}
                            </td>
                            <td>
                                {{ $experience->end_date?->format('d/m/Y') ?? 'Hiện tại' }}
                            </td>
                            <td>
                                <a href="{{ route('admin.experiences.edit', $experience) }}"
                                   class="btn btn-warning btn-sm">
                                    Sửa
                                </a>

                                <form action="{{ route('admin.experiences.destroy', $experience) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Bạn chắc chắn muốn xóa?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Chưa có kinh nghiệm nào.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $experiences->links() }}

        </div>
    </div>

    <a href="{{ route('admin.dashboard') }}"
       class="btn btn-secondary mt-4">
        Quay lại Dashboard
    </a>

</div>
</body>
</html>
