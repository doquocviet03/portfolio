
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm kinh nghiệm</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Thêm kinh nghiệm</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.experiences.store') }}"
          method="POST"
          class="card p-4 shadow-sm">

        @csrf

        <div class="mb-3">
            <label class="form-label">Vị trí / Kinh nghiệm</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ old('title') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Công ty / Trường học</label>
            <input type="text"
                   name="company"
                   class="form-control"
                   value="{{ old('company') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description"
                      class="form-control"
                      rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày bắt đầu</label>
            <input type="date"
                   name="start_date"
                   class="form-control"
                   value="{{ old('start_date') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày kết thúc (để trống nếu đang làm)</label>
            <input type="date"
                   name="end_date"
                   class="form-control"
                   value="{{ old('end_date') }}">
        </div>

        <div>
            <button type="submit" class="btn btn-success">
                Lưu kinh nghiệm
            </button>

            <a href="{{ route('admin.experiences.index') }}"
               class="btn btn-secondary">
                Hủy
            </a>
        </div>

    </form>
</div>
</body>
</html>
