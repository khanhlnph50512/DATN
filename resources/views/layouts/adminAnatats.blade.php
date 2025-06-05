<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Admin - Anatats @yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Custom CSS -->
  <style>
    html,
    body {
      height: 100%;
      margin: 0;
    }

    body {
      min-height: 100vh;
      background-color: #121212;
      color: #ffffff;
      display: flex;
      flex-direction: column;
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
      flex: 1 0 auto;
      overflow-x: auto;
    }

    footer {
      font-size: 0.9rem;
      background: #1c1c1c;
      color: #888888;
      flex-shrink: 0;
    }

    .sidebar {
      height: 100vh;
      background-color: #1f1f1f;
      color: white;
    }

    .sidebar .nav-link {
      color: #d1d1d1;
      transition: all 0.3s ease;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      color: #ffffff;
      background-color: #333333;
      border-radius: 5px;
    }

    .navbar {
      background-color: #000000;
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
      color: white;
    }

    .btn-primary {
      background-color: #444444;
      border: none;
    }

    .btn-primary:hover {
      background-color: #555555;
    }

    /* Responsive fixes */
    img {
      max-width: 100%;
      height: auto;
    }

    table {
      width: 100%;
      display: block;
      overflow-x: auto;
    }

    .long-text {
      word-break: break-word;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: absolute;
        width: 100%;
        z-index: 1000;
        display: none;
      }
    }

  </style>
</head>

<body>

  @include('partials.admin-navbar')

  <div class="container-fluid">
    <div class="row">
      @include('partials.admin-sidebar')

      <div class="content-wrapper col-12 col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
        @yield('content')
      </div>
    </div>
  </div>

  @include('partials.admin-footer')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Dark mode toggle logic
    if (localStorage.getItem('darkMode') === 'enabled') {
      document.body.classList.add('dark-mode');
      document.getElementById('dark-mode-icon')?.classList.remove('fa-sun');
      document.getElementById('dark-mode-icon')?.classList.add('fa-moon');
      document.body.style.backgroundColor = "#121212";
      document.body.style.color = "#ffffff";
    }

    document.getElementById('toggle-dark-mode')?.addEventListener('click', function (e) {
      e.preventDefault();
      document.body.classList.toggle('dark-mode');
      const icon = document.getElementById('dark-mode-icon');

      if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('darkMode', 'enabled');
        icon?.classList.remove('fa-sun');
        icon?.classList.add('fa-moon');
        document.body.style.backgroundColor = "#121212";
        document.body.style.color = "#ffffff";
      } else {
        localStorage.setItem('darkMode', 'disabled');
        icon?.classList.remove('fa-moon');
        icon?.classList.add('fa-sun');
        document.body.style.backgroundColor = "#ffffff";
        document.body.style.color = "#000000";
      }
    });
  </script>

</body>

</html>
