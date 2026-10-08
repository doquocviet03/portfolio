
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa kinh nghiệm</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Chỉnh sửa kinh nghiệm</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.experiences.update', $experience) }}"
          method="POST"
          class="card p-4 shadow-sm">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Vị trí / Kinh nghiệm</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ old('title', $experience->title) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Công ty / Trường học</label>
            <input type="text"
                   name="company"
                   class="form-control"
                   value="{{ old('company', $experience->company) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description"
                      class="form-control"
                      rows="4">{{ old('description', $experience->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày bắt đầu</label>
            <input type="date"
                   name="start_date"
                   class="form-control"
                   value="{{ old('start_date', $experience->start_date?->format('Y-m-d')) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày kết thúc</label>
            <input type="date"
                   name="end_date"
                   class="form-control"
                   value="{{ old('end_date', $experience->end_date?->format('Y-m-d')) }}">
        </div>

        <div>
            <button type="submit" class="btn btn-success">
                Cập nhật kinh nghiệm
            </button>

            <a href="{{ route('admin.experiences.index') }}"
               class="btn btn-secondary">
                Quay lại
            </a>
        </div>

    </form>
</div>
</body>
</html>
