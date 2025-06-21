<!-- Start Header Area -->
<header class="header-area header-wide">
    <!-- main header start -->
    <div class="main-header d-none d-lg-block">

   
        <!-- header middle area start -->
        <div class="header-main-area sticky">
            <div class="container">
                <div class="row align-items-center position-relative">

                    <!-- start logo area -->
                    <div class="col-lg-2">
                        <div class="logo">
                           <a href="{{ config('app.base_url') }}">
                                <img src="assets/img/logo/logo.jpg" alt="Brand Logo">
                            </a>
                        </div>
                    </div>
                    <!-- start logo area -->

                    <!-- main menu area start -->
                    <div class="col-lg-6 position-static">
                        <div class="main-menu-area">
                            <div class="main-menu">
                                <!-- main menu navbar start -->
                                <nav class="desktop-menu">
                                    <ul>
                                       <li><a href="{{ config('app.base_url') }}">Trang chủ</a></li>

                                        </li>

                                        <li><a href="http://localhost/PH49685-DuAn1/base_du_an_1/index.php?act=list-sanpham">Sản phẩm </i></a>
                                            <!-- <ul class="dropdown">
                                                <li><a href="blog-left-sidebar.html">blog left sidebar</a></li>
                                            </ul> -->
                                        </li>
                                        <li><a href="http://localhost/PH49685-DuAn1/base_du_an_1/index.php?act=gioi-thieu">Giới thiệu</a></li>
                                        <li><a href="http://localhost/PH49685-DuAn1/base_du_an_1/index.php?act=lien-he">Liên hệ</a></li>
                                        <li><a href="http://localhost/PH49685-DuAn1/base_du_an_1/index.php?act=tintucs">Tin tức</a></li>
                                        <li><a href="http://localhost/PH49685-DuAn1/base_du_an_1/index.php?act=khuyen-mai">Khuyến mãi</a></li>
                                    </ul>
                                </nav>
                                <!-- main menu navbar end -->
                            </div>
                        </div>
                    </div>
                    <!-- main menu area end -->

                    <!-- mini cart area start -->
                    <div class="col-lg-4">

                        <div class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                            <div class="header-search-container">
                                <button class="search-trigger d-xl-none d-lg-block"><i class="pe-7s-search"></i></button>
                                <form action="<?= 'http://localhost/PH49685-DuAn1/base_du_an_1/index.php' . '?act=search-san-pham' ?>" method="GET" class="header-search-box">
                                    <input type="text" name="search" placeholder="Nhập tên sản phẩm" class="header-search-field">
                                    <button type="submit" class="header-search-btn"><i class="pe-7s-search"></i></button>
                                </form>

                            </div>

                            <div class="header-configure-area">
                                <ul class="nav justify-content-end">
                                    <label>
                                        <?php
                                        if (isset($_SESSION['nguoidungs_client']['ten_nguoi_dung'])) {
                                            echo "Xin chào, " . $_SESSION['nguoidungs_client']['ten_nguoi_dung'] . "!";
                                        } else {
                                            echo "Xin chào, khách!";
                                        }
                                        ?>
                                    </label>
                                    <li class="user-hover">
                                        <a href="#">
                                            <i class="pe-7s-user"></i>
                                        </a>
                                        <ul class="dropdown-list">
                                            <li><a href="<?= 'http://localhost/PH49685-DuAn1/base_du_an_1/admin/index.php' . '?act=form-dang-nhap' ?>">Đăng nhập admin</a></li>
                                            <li>
                                                <?php if (isset($_SESSION['nguoidungs_client'])): ?>
                                                    <!-- Nếu người dùng đã đăng nhập -->
                                                    <a href="http://localhost/PH49685-DuAn1/base_du_an_1/index.php?act=taikhoan">Tài khoản cá nhân</a>
                                                    <a href="http://localhost/PH49685-DuAn1/base_du_an_1/index.php?act=lich-su-mua-hang">Xem đơn hàng</a>
                                                    <a onclick="return confirm('Đăng xuất tài khoản?')" href="http://localhost/PH49685-DuAn1/base_du_an_1/index.php?act=logout">Đăng Xuất</a>
                                                <?php else: ?>
                                                    <!-- Nếu người dùng chưa đăng nhập -->
                                                    <a href="http://localhost/PH49685-DuAn1/base_du_an_1/index.php?act=login">Đăng Nhập</a>
                                                    <a href="<?= 'http://localhost/PH49685-DuAn1/base_du_an_1/index.php' . '?act=dangky' ?>">Đăng ký</a>
                                                <?php endif; ?>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="http://localhost/PH49685-DuAn1/base_du_an_1/index.php?act=gio-hang" class="minicart-btn">
                                            <i class="pe-7s-shopbag"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- mini cart area end -->

                </div>
            </div>
        </div>
        <!-- header middle area end -->
    </div>
    <!-- main header start -->


</header>
<!-- end Header Area -->