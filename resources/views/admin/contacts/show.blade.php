
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết tin nhắn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <h2 class="mb-4">Chi tiết tin nhắn</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            <p><strong>Họ tên:</strong> {{ $contact->name }}</p>

            <p><strong>Email:</strong> {{ $contact->email }}</p>

            <p>
                <strong>Tiêu đề:</strong>
                {{ $contact->subject ?? 'Không có tiêu đề' }}
            </p>

            <p>
                <strong>Ngày gửi:</strong>
                {{ $contact->created_at->format('d/m/Y H:i') }}
            </p>

            <hr>

            <h5>Nội dung tin nhắn</h5>

            <div class="bg-light p-3 rounded"
                 style="white-space: pre-wrap;">{{ $contact->message }}</div>

            <a href="{{ route('admin.contacts.index') }}"
               class="btn btn-secondary mt-4">
                Quay lại danh sách
            </a>

        </div>
    </div>

</div>

</body>
</html>
