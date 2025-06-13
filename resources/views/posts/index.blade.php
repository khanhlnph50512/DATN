{{-- resources/views/post/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0" style="color: brown;">Trang Bài Viết</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <!-- Sidebar -->
                <div class="col-xxl-3">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="search-box">
                                <p style="color: brown;" class="py-2 d-block">Tìm kiếm</p>
                                <div class="position-relative">
                                    <input type="text" class="form-control rounded bg-light border-light" placeholder="Search...">
                                    <i class="mdi mdi-magnify search-icon"></i>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-top">
                                <p style="color: brown;" class="py-2 d-block">Thể loại </p>
                                <ul class="list-unstyled fw-medium">
                                    <li><a href="{{ route('post.theloai', ['category' => 'MoiNhat']) }}" class="text-dark py-2 d-block"><i class="mdi mdi-chevron-right me-1"></i> Mới nhất</a></li>
                                    <li><a href="{{ route('post.theloai', ['category' => 'NoiBat']) }}" class="text-dark py-2 d-block">
                                        <i class="mdi mdi-chevron-right me-1"></i> Nổi bật
                                        <span class="badge badge-soft-success rounded-pill float-end ms-1 font-size-12">04</span>
                                    </a></li>
                                    <li><a href="{{ route('post.theloai', ['category' => 'GiamGia']) }}" class="text-dark py-2 d-block"><i class="mdi mdi-chevron-right me-1"></i> Giảm giá</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nội dung bài viết -->
                <div class="col-xxl-9">
                    <div class="row g-4 mb-3">
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end gap-2">
                                <div class="search-box ms-2">
                                    <input type="text" class="form-control" placeholder="Tìm kiếm bài viết">
                                    <i class="ri-search-line search-icon"></i>
                                </div>

                                <select class="form-control w-md">
                                    <option value="All">Tất cả</option>
                                    <option value="Today">Hôm nay</option>
                                    <option value="Yesterday" selected>Hôm qua</option>
                                    <option value="Last 7 Days">7 ngày qua</option>
                                    <option value="Last 30 Days">30 ngày qua</option>
                                    <option value="This Month">Tháng này</option>
                                    <option value="Last Year">Năm ngoái</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        @forelse ($posts as $post)
                            <div class="col-md-4">
                                <div class="card shadow-sm">
                                    <img src="{{ asset($post->image) }}" class="card-img-top" alt="Ảnh bài viết" height="200">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->tieude }}</h5>
                                        <p class="card-text">{{ Str::limit(strip_tags($post->noidung), 100) }}</p>
                                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Xem Chi Tiết</a>
                                    </div>
                                    <div class="card-footer text-muted">
                                        Ngày tạo: {{ $post->ngay_tao }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">Không có bài viết nào.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
