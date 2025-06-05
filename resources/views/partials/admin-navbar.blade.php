<nav class="navbar navbar-expand-lg px-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Anatats</a>

    <ul class="navbar-nav ms-auto d-flex flex-row align-items-center gap-3">
      <!-- Language Icon -->
      <li class="nav-item">
        <a class="nav-link text-white" href="#">
          <i class="fas fa-globe"></i>
        </a>
      </li>

      <!-- Dark Mode Toggle -->
      <li class="nav-item">
        <a class="nav-link text-white" href="#" id="toggle-dark-mode" title="Chuyển chế độ sáng/tối">
          <i class="fas fa-sun" id="dark-mode-icon"></i>
        </a>
      </li>

      <!-- App Icon -->
      <li class="nav-item">
        <a class="nav-link text-white" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>

      <!-- Notification with Badge -->
      <li class="nav-item position-relative">
        <a class="nav-link text-white" href="#">
          <i class="fas fa-bell"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            5 <!-- You can replace this with dynamic data -->
          </span>
        </a>
      </li>

      <!-- User Avatar with Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <!-- Dynamic User Avatar -->
          <img src="{{ Auth::user() ?? asset('images/default-avatar.jpg') }}" alt="Avatar" class="rounded-circle" width="35" height="35">
          <span class="position-absolute bottom-0 end-0 translate-middle p-1 bg-success border border-white rounded-circle"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
          <li class="px-3 py-2">
            <strong>{{ Auth::user() }}</strong><br>
            <small>{{ Auth::user() }}</small>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Trang cá nhân</a></li>
          <li><a class="dropdown-item" href="#"><i class="fas fa-key me-2"></i>Đổi mật khẩu</a></li>
          <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>

<!-- Add the following script for dark mode toggle -->
<script>
  document.getElementById('toggle-dark-mode').addEventListener('click', function () {
    document.body.classList.toggle('dark-mode'); // Toggle dark mode class
    let icon = document.getElementById('dark-mode-icon');
    if (document.body.classList.contains('dark-mode')) {
      icon.classList.replace('fa-sun', 'fa-moon'); // Change icon when dark mode is activated
    } else {
      icon.classList.replace('fa-moon', 'fa-sun'); // Revert to sun icon when light mode is activated
    }
  });
</script>
