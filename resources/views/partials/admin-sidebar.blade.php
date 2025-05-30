<head>
  <style>
    .highlighted span {
      color: #ff5733; /* Màu chữ nổi bật */
      font-weight: bold; /* Chữ đậm */
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Hiệu ứng bóng đổ */
      background-color: #282828; /* Nền dark cho phần tiêu đề */
      padding: 6px 10px; /* Thêm khoảng cách xung quanh */
      border-radius: 4px; /* Bo góc */
    }
    
    .highlighted:hover span {
      color: #ffffff; /* Màu chữ sáng khi hover */
      background-color: #c70039; /* Nền đổi màu khi hover */
      cursor: pointer; /* Thay đổi con trỏ khi hover */
    }
  </style>
</head>

<nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse text-white">
  <div class="position-sticky pt-3 px-3">
    
    <!-- Nhóm: Tổng quan -->
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-1 mb-2 text-uppercase highlighted">
      <span>Tổng quan</span>
    </h6>
    <ul class="nav flex-column mb-3">
      <li class="nav-item">
        <a class="nav-link text-white active" href="#">
          <i class="fas fa-tachometer-alt me-2"></i> Tổng quan hệ thống
        </a>
      </li>
    </ul>

    <!-- Nhóm: Quản lý nội dung -->
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-1 mb-2 text-uppercase highlighted">
      <span>Quản lý nội dung</span>
    </h6>
    <ul class="nav flex-column mb-3">
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-box me-2"></i> Sản phẩm</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-list-alt me-2"></i> Danh mục</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-tags me-2"></i> Mã giảm giá</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-newspaper me-2"></i> Bài viết</a></li>
    </ul>

    <!-- Nhóm: Quản lý người dùng -->
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-1 mb-2 text-uppercase highlighted">
      <span>Người dùng & khách hàng</span>
    </h6>
    <ul class="nav flex-column mb-3">
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-user me-2"></i> Người dùng</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-users me-2"></i> Khách hàng</a></li>
    </ul>

    <!-- Nhóm: Quản lý giao dịch -->
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-1 mb-2 text-uppercase highlighted">
      <span>Giao dịch & đánh giá</span>
    </h6>
    <ul class="nav flex-column mb-3">
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-shopping-cart me-2"></i> Đơn hàng</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-star me-2"></i> Đánh giá</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-envelope me-2"></i> Liên hệ</a></li>
    </ul>

    <!-- Nhóm: Quản trị hệ thống -->
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-1 mb-2 text-uppercase highlighted">
      <span>Hệ thống</span>
    </h6>
    <ul class="nav flex-column mb-3">
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-chart-bar me-2"></i> Thống kê</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-cogs me-2"></i> Cài đặt</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-user-shield me-2"></i> Phân quyền</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-truck me-2"></i> Vận chuyển</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-receipt me-2"></i> Hóa đơn</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-history me-2"></i> Nhật ký hoạt động</a></li>
    </ul>

  </div>
</nav>
