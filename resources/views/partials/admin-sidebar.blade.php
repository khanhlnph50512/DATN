<head>
    <style>
        /* Đổi màu chữ cho phần nội dung nổi bật */
        .highlighted span {
            color: #ff5733;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            background-color: #282828;
            padding: 6px 10px;
            border-radius: 4px;
        }

        /* Hover hiệu ứng: đổi màu nền và chữ */
        .highlighted:hover span {
            color: #ffffff;
            background-color: #c70039;
            cursor: pointer;
        }

        /* Định dạng sidebar */
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

        .sidebar .nav-link i {
            font-size: 1.2rem;
        }

        /* Hover hiệu ứng cho nhóm */
        .sidebar-heading span {
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        /* Tối ưu responsive cho sidebar */
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                width: 100%;
                z-index: 1000;
                display: none;
            }

            .sidebar.show {
                display: block;
            }
        }

        /* Tăng khả năng hiển thị khi dùng chế độ tối */
        body.dark-mode .sidebar {
            background-color: #1a1a1a;
        }
    </style>
</head>

<nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse text-white">
    <div class="position-sticky pt-3 px-3">

        <!-- Nhóm: Tổng quan -->
        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-1 mb-2 text-uppercase highlighted">
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
        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-1 mb-2 text-uppercase highlighted">
            <span>Quản lý nội dung</span>
        </h6>
        <ul class="nav flex-column mb-3">
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.products.index') }}"><i
                        class="fas fa-box me-2"></i> Sản phẩm</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.categories.index') }}"><i
                        class="fas fa-list-alt me-2"></i> Danh mục</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.colors.index') }}"><i
                        class="fas fa-palette me-2"></i> Màu sắc</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.sizes.index') }}"><i
                        class="fas fa-ruler-combined me-2"></i> Size</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.brands.index') }}"><i
                        class="fas fa-industry me-2"></i> Thương hiệu</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.coupons.index') }}"><i
                        class="fas fa-tags me-2"></i> Mã giảm giá</a></li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('admin.coupons.index') }}">
                    <i class="fas fa-ticket-alt me-2"></i> Mã giảm giá theo đơn hàng
                </a>
            </li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.blogs.index') }}"><i
                        class="fas fa-newspaper me-2"></i> Bài viết</a></li>
        </ul>

        <!-- Nhóm: Quản lý người dùng -->
        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-1 mb-2 text-uppercase highlighted">
            <span>Người dùng & khách hàng</span>
        </h6>
        <ul class="nav flex-column mb-3">
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.users.index') }}"><i
                        class="fas fa-user me-2"></i> Người dùng</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.customers.index') }}"><i
                        class="fas fa-users me-2"></i> Khách hàng</a></li>
        </ul>

        <!-- Nhóm: Quản lý giao dịch -->
        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-1 mb-2 text-uppercase highlighted">
            <span>Giao dịch & đánh giá</span>
        </h6>
        <ul class="nav flex-column mb-3">
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-shopping-cart me-2"></i>
                    Đơn hàng</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-star me-2"></i> Đánh
                    giá</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-envelope me-2"></i> Liên
                    hệ</a></li>
        </ul>

        <!-- Nhóm: Quản trị hệ thống -->
        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-1 mb-2 text-uppercase highlighted">
            <span>Hệ thống</span>
        </h6>
        <ul class="nav flex-column mb-3">
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-chart-bar me-2"></i>
                    Thống kê</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-cogs me-2"></i> Cài
                    đặt</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-user-shield me-2"></i>
                    Phân quyền</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-truck me-2"></i> Vận
                    chuyển</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-receipt me-2"></i> Hóa
                    đơn</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fas fa-history me-2"></i> Nhật
                    ký hoạt động</a></li>
        </ul>

    </div>
</nav>
