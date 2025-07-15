@extends('client.layouts.main')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<style>
    .detail-container {
        max-width: 960px;
        margin: 40px auto;
        padding: 30px;
        border: 1px solid #eee;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .detail-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 25px;
        border-bottom: 1px solid #eaeaea;
        padding-bottom: 10px;
    }

    .detail-header h4 {
        margin-bottom: 5px;
    }

    .order-items {
        border-top: 1px solid #eee;
        margin-top: 20px;
        padding-top: 20px;
    }

    .item {
        display: flex;
        gap: 16px;
        margin-bottom: 16px;
        border-bottom: 1px dashed #ddd;
        padding-bottom: 12px;
    }

    .item img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 1px solid #ddd;
        border-radius: 6px;
    }

    .item-info {
        flex: 1;
    }

    .item-info strong {
        font-size: 16px;
    }

    .item-price {
        min-width: 150px;
        text-align: right;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        font-size: 18px;
        font-weight: bold;
        color: #f05a28;
        margin-top: 20px;
        padding-top: 10px;
        border-top: 2px solid #f0f0f0;
    }

    .badge-status {
        padding: 4px 10px;
        background: #fff3e0;
        color: #f05a28;
        border-radius: 5px;
        font-size: 14px;
    }
</style>

<div class="detail-container">
    <div class="detail-header">
        <div>
            <h4>Đơn hàng: {{ $order->order_number }}</h4>
            <p>Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>
        <div>
            <span class="badge-status">{{ ucfirst($order->status) }}</span>
        </div>
    </div>

    <div>
        <h5>Thông tin người nhận</h5>
        <p><strong>Họ tên:</strong> {{ $order->user->name ?? 'Khách' }}</p>
        <p><strong>Email:</strong> {{ $order->email ?? '---' }}</p>
        <p><strong>Điện thoại:</strong> {{ $order->phone_number }}</p>
        <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
        <p><strong>Ghi chú:</strong> {{ $order->note ?? '---' }}</p>
    </div>

    <div class="order-items">
        <h5>Sản phẩm</h5>
        @foreach ($order->orderItems as $item)
            <div class="item">
<img src="{{ asset('asset/img/' . $item->image) }}" alt="{{ $item->product_name }}">
                <div class="item-info">
                    <strong>{{ $item->product_name }}</strong><br>
                    @if($item->variation_name)
                        <small>Phân loại: {{ $item->variation_name }}</small><br>
                    @endif
                    @if($item->category_name)
                        <small>Danh mục: {{ $item->category_name }}</small><br>
                    @endif
                    @if($item->brand_name)
                        <small>Thương hiệu: {{ $item->brand_name }}</small><br>
                    @endif
                    <small>SL: {{ $item->quantity }}</small>
                </div>
                <div class="item-price">
                    <div>{{ number_format($item->price, 0, ',', '.') }}đ</div>
                    @if($item->discount > 0)
                        <div>Giảm: {{ number_format($item->discount, 0, ',', '.') }}đ</div>
                    @endif
                    <div class="text-orange font-weight-bold">
                        {{ number_format($item->final_price, 0, ',', '.') }}đ
                    </div>
                </div>
            </div>
        @endforeach

        <div class="total-row">
            <span>Tổng thanh toán:</span>
            <span>{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
        </div>
    </div>
</div>
@endsection
