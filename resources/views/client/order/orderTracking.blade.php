@extends('client.layouts.main')

@section('title', 'Đơn hàng của tôi')

@section('content')
<style>
    .order-card {
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .order-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.07);
        transform: scale(1.01);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 10px;
    }

    .order-status {
        font-weight: bold;
        color: #f05a28;
        background-color: #fff3e0;
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 14px;
    }

    .order-info p {
        margin-bottom: 6px;
        font-size: 15px;
    }

    .btn-detail {
        border-radius: 5px;
        padding: 8px 16px;
        font-size: 14px;
        background-color: #f05a28;
        color: white;
        border: none;
        transition: background 0.3s ease;
    }

    .btn-detail:hover {
        background-color: #d94e20;
    }

    .no-orders {
        text-align: center;
        padding: 60px 0;
        color: #999;
    }

    .no-orders i {
        font-size: 60px;
        margin-bottom: 20px;
        color: #ccc;
    }

</style>

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-5">🧾 Danh sách đơn hàng của bạn</h2>

    @if ($orders->isEmpty())
        <div class="no-orders">
            <i class="fas fa-box-open"></i>
            <p>Chưa có đơn hàng nào.</p>
            <a href="{{ route('product.index') }}" class="btn btn-outline-primary mt-3">Tiếp tục mua sắm</a>
        </div>
    @else
        @foreach ($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <strong>Mã đơn:</strong> {{ $order->order_number }}<br>
                        <small>Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <div class="order-status">
                        {{ ucfirst($order->status) }}
                    </div>
                </div>

                <div class="row order-info">
                    <div class="col-md-6">
                        <p><strong>Người nhận:</strong> {{ $order->user->name ?? 'Khách hàng' }}</p>
                        <p><strong>Điện thoại:</strong> {{ $order->phone_number }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                        <p><strong>Ghi chú:</strong> {{ $order->note ?? 'Không có' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Phương thức thanh toán:</strong> {{ strtoupper($order->payment_method) }}</p>
                        <p><strong>Trạng thái thanh toán:</strong> {{ ucfirst($order->payment_status) }}</p>
                        <p><strong>Tổng tiền:</strong> <span class="text-danger fw-bold">{{ number_format($order->total_amount, 0, ',', '.') }}đ</span></p>
                        <a href="{{ route('client.order.detail', $order->id) }}" class="btn-detail mt-2">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
