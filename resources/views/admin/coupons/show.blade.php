@extends('admin.layouts.adminAnatats')

@section('content')
<div class="container-fluid px-5">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="fw-bold text-primary">🔍 Chi tiết mã giảm giá</h2>
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary">⬅ Quay lại danh sách</a>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
            <div class="row g-4">

                <div class="col-md-6">
                    <h5 class="text-muted">📌 Mã giảm giá</h5>
                    <p class="fs-5 fw-bold text-dark">{{ $coupon->code }}</p>
                </div>

                <div class="col-md-6">
                    <h5 class="text-muted">📄 Mô tả</h5>
                    <p class="fs-6 text-dark">{{ $coupon->description ?? 'Không có' }}</p>
                </div>

                <div class="col-md-4">
                    <h5 class="text-muted">🔢 Giá trị giảm</h5>
                    <p class="fs-6 text-dark">
                        @if($coupon->discount_amount)
                            {{ number_format($coupon->discount_amount) }}đ
                        @else
                            {{ $coupon->discount_percent }}%
                        @endif
                    </p>
                </div>

                <div class="col-md-4">
                    <h5 class="text-muted">🎯 Đơn tối thiểu</h5>
                    <p class="fs-6 text-dark">
                        {{ number_format($coupon->minimum_order_amount) }}đ
                    </p>
                </div>

                <div class="col-md-4">
                    <h5 class="text-muted">⏳ Hiệu lực</h5>
                    <p class="fs-6 text-dark">
                        {{ $coupon->valid_from }} → {{ $coupon->valid_until }}
                    </p>
                </div>

                <div class="col-md-4">
                    <h5 class="text-muted">🔁 Lượt dùng còn lại</h5>
                    <p class="fs-6 text-dark">{{ $coupon->usage_limit }}</p>
                </div>

                <div class="col-md-4">
                    <h5 class="text-muted">📅 Đã xoá?</h5>
                    <p class="fs-6 text-dark">
                        @if($coupon->deleted_at)
                            🗑️ Xoá lúc {{ $coupon->deleted_at->format('d/m/Y H:i') }}
                        @else
                            ✔ Chưa xoá
                        @endif
                    </p>
                </div>

                <div class="col-md-4">
                    <h5 class="text-muted">⚙️ Trạng thái</h5>
                    <p class="fs-6 text-dark">
                        {!! $coupon->active
                            ? '<span class="badge bg-success">✔ Hoạt động</span>'
                            : '<span class="badge bg-secondary">❌ Tắt</span>' !!}
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
