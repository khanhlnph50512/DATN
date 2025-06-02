<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        /* Flexbox to make sure footer is always at the bottom */
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #121212;
            /* Màu nền tối cho toàn bộ body */
            color: #ffffff;
            /* Chữ màu trắng */
        }

        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        body.dark-mode .navbar,
        body.dark-mode .sidebar {
            background-color: #1f1f1f !important;
        }

        body.dark-mode .nav-link {
            color: #bbb;
        }

        body.dark-mode .nav-link:hover {
            color: #fff;
        }

        .content-wrapper {
            flex: 1;
        }

        footer {
            font-size: 0.9rem;
            background: #1c1c1c;
            /* Màu footer tối hơn */
            color: #888888;
            /* Màu chữ xám cho footer */
        }

        .sidebar {
            height: 100vh;
            background-color: #1f1f1f;
            /* Màu nền tối cho sidebar */
            color: white;
        }

        .sidebar .nav-link {
            color: #d1d1d1;
            /* Màu chữ trong sidebar */
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #ffffff;
            /* Màu chữ trắng khi hover */
            background-color: #333333;
            /* Màu nền khi hover */
            border-radius: 5px;
        }

        .navbar {
            background-color: #000000;
            /* Navbar có màu nền đen */
        }

        .navbar .navbar-brand {
            font-weight: bold;
            color: white;
        }

        .navbar .nav-link {
            position: relative;
            font-size: 1.2rem;
        }

        .navbar .badge {
            font-size: 0.65rem;
            padding: 0.25em 0.4em;
        }

        .navbar img.rounded-circle {
            object-fit: cover;
            border: 2px solid white;
        }

        .table thead {
            background-color: #333333;
            /* Màu nền bảng đen */
            color: white;
        }

        .btn-primary {
            background-color: #444444;
            /* Nút primary màu xám tối */
            border: none;
        }

        .btn-primary:hover {
            background-color: #555555;
            /* Nút hover màu sáng hơn */
        }
    </style>
</head>

<body>

    @include('partials.admin-navbar')

    <div class="container-fluid">
        <div class="row">
            @include('partials.admin-sidebar')

            <div class="content-wrapper col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Include footer -->
    @include('partials.admin-footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Kiểm tra trạng thái dark mode đã lưu
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            document.getElementById('dark-mode-icon').classList.remove('fa-sun');
            document.getElementById('dark-mode-icon').classList.add('fa-moon');
            // Thay đổi màu sắc khi dark mode được bật
            document.body.style.backgroundColor = "#121212"; // Màu nền dark mode
            document.body.style.color = "#ffffff"; // Màu chữ sáng
        }

        document.getElementById('toggle-dark-mode').addEventListener('click', function(e) {
            e.preventDefault();
            document.body.classList.toggle('dark-mode');
            const icon = document.getElementById('dark-mode-icon');

            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
                // Thay đổi màu sắc khi bật dark mode
                document.body.style.backgroundColor = "#121212"; // Màu nền dark mode
                document.body.style.color = "#ffffff"; // Màu chữ sáng
            } else {
                localStorage.setItem('darkMode', 'disabled');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
                // Thay đổi màu sắc khi tắt dark mode
                document.body.style.backgroundColor = "#ffffff"; // Màu nền sáng
                document.body.style.color = "#000000"; // Màu chữ tối
            }
        });
    </script>


</body>

</html>
