@extends('.client.layouts.main')
@section('title', 'Discover YOU')
@section('content')
    <div class="container py-5">
        {{-- Banner lớn --}}
        <div class="mb-5">
            <img src="{{ asset('assetsClients/images/banner.jpg') }}" alt="Discover YOU Banner"
                class="img-fluid rounded-4 shadow w-100" style="max-height: 400px; object-fit: cover;">
        </div>

        {{-- Giới thiệu --}}
        <div class="row align-items-center mb-5">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset('assetsClients/images/anh1.jpg') }}" alt="Your Style"
                    class="img-fluid rounded-3 w-100" style="max-height: 350px; object-fit: cover;">
            </div>
            <div class="col-md-6">
                <h2 class="mb-3">Tìm kiếm phong cách của bạn</h2>
                <p class="text-muted">
                    Chào mừng bạn đến với thế giới thời trang độc đáo của chúng tôi. "Discover YOU" là nơi bạn thể hiện cá tính và gu thẩm mỹ riêng qua từng bộ trang phục. Hãy khám phá và trải nghiệm ngay hôm nay!
                </p>
                <a href="{{ route('product.index') }}" class="btn btn-dark mt-3">Khám phá ngay</a>
            </div>
        </div>

        {{-- Bộ sưu tập --}}
        <div class="mb-5">
            <h3 class="text-center mb-4">Bộ sưu tập nổi bật</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('assetsClients/images/anh2.jpg') }}"
                            class="card-img-top rounded-top" alt="Collection 1"
                            style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Phong cách đường phố</h5>
                            <p class="card-text">Năng động, cá tính với những thiết kế trẻ trung, phù hợp mọi hoạt động.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('assetsClients/images/anh3.jpg') }}"
                            class="card-img-top rounded-top" alt="Collection 2"
                            style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Phong cách tối giản</h5>
                            <p class="card-text">Đơn giản mà tinh tế, những thiết kế mang tính ứng dụng cao và thanh lịch.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('assetsClients/images/anh4.jpg') }}"
                            class="card-img-top rounded-top" alt="Collection 3"
                            style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Phong cách thể thao</h5>
                            <p class="card-text">Thoải mái, linh hoạt nhưng vẫn đảm bảo thời trang và sự năng động.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="text-center py-5 bg-light rounded-4">
            <h4 class="mb-3">Khám phá bộ sưu tập phù hợp với bạn</h4>
            <a href="{{ route('product.index') }}" class="btn btn-outline-dark">Xem tất cả sản phẩm</a>
        </div>
    </div>
@endsection
