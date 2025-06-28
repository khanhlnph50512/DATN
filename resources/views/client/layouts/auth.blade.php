<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Xác thực')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-box {
            background: white;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
        }
        .auth-title {
            font-weight: bold;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <div class="auth-box">
        <h2 class="text-center auth-title">@yield('title')</h2>
        <p class="text-center text-muted mb-4">@yield('subtitle')</p>

        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
