@extends('admin.layouts.adminAnatats')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

<div class="py-4 w-100" style="background-color: white;">
    <div class="container-fluid"><!-- vẫn dùng container-fluid để full chiều ngang -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-dark m-0">Danh sách mã giảm giá</h2>
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-success">➕ Thêm mã mới</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Mã</th>
                        <th>Mô tả</th>
                        <th>Giảm (VNĐ)</th>
                        <th>Giảm (%)</th>
                        <th>Đơn tối thiểu</th>
                        <th>Thời gian áp dụng</th>
                        <th>Giới hạn</th>
                        <th>Kích hoạt</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->id }}</td>
                        <td><strong>{{ $coupon->code }}</strong></td>
                        <td>{{ $coupon->description }}</td>
                        <td>{{ number_format($coupon->discount_amount) }}</td>
                        <td>{{ $coupon->discount_percent }}%</td>
                        <td>{{ number_format($coupon->minimum_order_amount) }}</td>
                        <td>{{ $coupon->valid_from }}<br>→ {{ $coupon->valid_until }}</td>
                        <td>{{ $coupon->usage_limit ?? 'Không giới hạn' }}</td>
                        <td>
                            @if($coupon->active)
                                <span class="badge bg-success">✔️ Có</span>
                            @else
                                <span class="badge bg-secondary">❌ Không</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Bạn chắc chắn xóa?')" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">Không có mã nào</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $coupons->links() }}
        </div>
    </div>
</div>
@endsection
