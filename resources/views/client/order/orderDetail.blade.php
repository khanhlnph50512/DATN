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
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
        }

        .status-pending {
            background: #fdf2e9;
            color: #e67e22;
        }

        .status-processing {
            background: #fef5e7;
            color: #e67e22;
        }

        .status-shipping {
            background: #ebf5fb;
            color: #3498db;
        }

        .status-delivered {
            background: #eafaf1;
            color: #27ae60;
        }

        .status-cancelled {
            background: #fdecea;
            color: #c0392b;
        }
    </style>

    @php
        $statusMap = [
            'pending' => ['label' => 'Chờ xác nhận', 'class' => 'status-pending', 'icon' => 'fas fa-hourglass-start'],
            'processing' => ['label' => 'Xác nhận', 'class' => 'status-processing', 'icon' => 'fas fa-cogs'],
            'shipping' => ['label' => 'Đang giao hàng', 'class' => 'status-shipping', 'icon' => 'fas fa-truck'],
            'delivered' => ['label' => 'Đã giao', 'class' => 'status-delivered', 'icon' => 'fas fa-check-circle'],
            'cancelled' => ['label' => 'Đã hủy', 'class' => 'status-cancelled', 'icon' => 'fas fa-times-circle'],
        ];
        $status = $statusMap[$order->status] ?? [
            'label' => ucfirst($order->status),
            'class' => '',
            'icon' => 'fas fa-info-circle',
        ];
    @endphp

    <div class="detail-container">
        <div class="detail-header">
             @if ($order->status === 'pending')
                <form action="{{ route('client.orders.cancel', $order->id) }}" method="POST"
                    onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này?');">
                    @csrf
                    <button class="btn btn-danger mt-2" style="border-radius: 6px; font-size: 14px;">
                        <i class="fas fa-times-circle"></i> Hủy đơn hàng
                    </button>
                </form>
            @endif
            <div>
                <h4>Đơn hàng: {{ $order->order_number }}</h4>
                <p>Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <span class="badge-status {{ $status['class'] }}">
                    <i class="{{ $status['icon'] }}"></i>
                    {{ $status['label'] }}
                </span>
            </div>
        </div>

        <div>
            <h5>Thông tin người nhận</h5>
            <p><strong>Họ tên:</strong> {{ $order->user->name ?? 'Khách' }}</p>
            <p><strong>Email:</strong> {{ $order->email ?? '---' }}</p>
            <p><strong>Điện thoại:</strong> {{ $order->phone_number }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
            <p><strong>Ghi chú:</strong> {{ $order->note ?? '---' }}</p>
            <p>
                <strong>💰 Trạng thái thanh toán:</strong>
                {{ $order->payment_status === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
            </p>
        </div>

        <div class="order-items">
            <h5>Sản phẩm</h5>
            @foreach ($order->orderItems as $item)
                <div class="item">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->product_name }}">
                    <div class="item-info">
                        <strong>{{ $item->product_name }}</strong><br>
                        @if ($item->variation_name)
                            <small>Phân loại: {{ $item->variation_name }}</small><br>
                        @endif
                        @if ($item->category_name)
                            <small>Danh mục: {{ $item->category_name }}</small><br>
                        @endif
                        @if ($item->brand_name)
                            <small>Thương hiệu: {{ $item->brand_name }}</small><br>
                        @endif
                        <small>SL: {{ $item->quantity }}</small>
                    </div>
                    <div class="item-price">
                        <div>{{ number_format($item->price, 0, ',', '.') }}đ</div>
                        @if ($item->discount > 0)
                            <div>Giảm: {{ number_format($item->discount, 0, ',', '.') }}đ</div>
                        @endif
                        <div class="text-orange font-weight-bold">
                            {{ number_format($item->final_price, 0, ',', '.') }}đ
                        </div>
                    </div>
                </div>
            @endforeach

            @php
                $shippingFee = $order->shippingMethod->price ?? 0;
                $subtotal = $order->total_amount - $shippingFee;
            @endphp

            <div class="total-row">
                <span>Tạm tính:</span>
                <span>{{ number_format($subtotal, 0, ',', '.') }}đ</span>
            </div>

            @if ($shippingFee > 0)
                <div class="total-row">
                    <span>Phí vận chuyển ({{ $order->shippingMethod->name ?? '---' }}):</span>
                    <span>{{ number_format($shippingFee, 0, ',', '.') }}đ</span>
                </div>
            @endif

            <div class="total-row" style="border-top: 3px double #ddd;">
                <span>Tổng thanh toán:</span>
                <span>{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
            </div>

        </div>
    </div>
@endsection
