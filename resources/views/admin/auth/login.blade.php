
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Đăng nhập Admin | Personal Portfolio</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a, #1e40af);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: #fff;
            border-radius: 22px;
            padding: 38px;
            box-shadow: 0 25px 60px rgba(0,0,0,.2);
        }

        .login-icon {
            width: 68px;
            height: 68px;
            border-radius: 18px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 20px;
        }

        .login-title {
            font-size: 27px;
            font-weight: 800;
            color: #0f172a;
        }

        .form-control {
            padding: 12px 14px;
            border-radius: 10px;
        }

        .login-button {
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="login-card">

    <div class="login-icon">
        <i class="bi bi-shield-lock"></i>
    </div>

    <h2 class="login-title text-center">
        Admin Login
    </h2>

    <p class="text-muted text-center mb-4">
        Đăng nhập để quản lý Personal Portfolio.
    </p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.login.submit') }}"
          method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control"
                placeholder="Nhập email"
                autocomplete="username"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">
                Mật khẩu
            </label>

            <div class="input-group">
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="Nhập mật khẩu"
                    autocomplete="current-password"
                    required>

                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    id="togglePassword"
                    aria-label="Hiện hoặc ẩn mật khẩu">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <div class="form-check mb-4">
            <input
                type="checkbox"
                name="remember"
                value="1"
                id="remember"
                class="form-check-input">

            <label for="remember" class="form-check-label">
                Ghi nhớ đăng nhập
            </label>
        </div>

        <button type="submit"
                class="btn btn-primary login-button w-100">
            <i class="bi bi-box-arrow-in-right me-1"></i>
            Đăng nhập
        </button>

    </form>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}"
           class="text-decoration-none">
            <i class="bi bi-arrow-left me-1"></i>
            Quay về website
        </a>
    </div>

</div>

<script>
document.getElementById('togglePassword')
    .addEventListener('click', function () {

        const input = document.getElementById('password');
        const icon = this.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    });
</script>

</body>
</html>
