<nav class="navbar navbar-expand-lg px-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Anatats</a>

    <ul class="navbar-nav ms-auto d-flex flex-row align-items-center gap-3">
      <!-- Biểu tượng ngôn ngữ -->
      <li class="nav-item">
        <a class="nav-link text-white" href="#">
          <i class="fas fa-globe"></i>
        </a>
      </li>

      <!-- Chế độ sáng/tối -->
      <li class="nav-item">
  <a class="nav-link text-white" href="#" id="toggle-dark-mode" title="Chuyển chế độ sáng/tối">
    <i class="fas fa-sun" id="dark-mode-icon"></i>
  </a>
</li>

      <!-- Ứng dụng -->
      <li class="nav-item">
        <a class="nav-link text-white" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>

      <!-- Thông báo với badge -->
      <li class="nav-item position-relative">
        <a class="nav-link text-white" href="#">
          <i class="fas fa-bell"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            5
          </span>
        </a>
      </li>

      <!-- Avatar người dùng với dropdown -->
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <img src="{{ Auth::user()->avatar ?? asset('images/default-avatar.jpg') }}" alt="Avatar" class="rounded-circle" width="35" height="35">
    <span class="position-absolute bottom-0 end-0 translate-middle p-1 bg-success border border-white rounded-circle"></span>
  </a>
  <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
    <li class="px-3 py-2">
      <strong>Nguyễn Văn A</strong><br>
      <small>admin@example.com</small>
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
