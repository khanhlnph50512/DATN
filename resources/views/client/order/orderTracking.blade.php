@extends('client.layouts.main')

@section('title', 'Đơn hàng của tôi')

@section('content')
    <style>
        .order-card {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .order-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .order-status {
            font-weight: bold;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-pending {
            color: #e67e22;
            background: #fdf2e9;
        }

        .status-processing {
            color: #e67e22;
            background: #fef5e7;
        }

        .status-shipping {
            color: #3498db;
            background: #ebf5fb;
        }

        .status-delivered {
            color: #27ae60;
            background: #eafaf1;
        }

        .status-cancelled {
            color: #c0392b;
            background: #fdecea;
        }



        .order-info p {
            margin-bottom: 8px;
            font-size: 15px;
        }

        .btn-detail {
            border-radius: 6px;
            padding: 8px 18px;
            font-size: 14px;
            background-color: #f05a28;
            color: white;
            border: none;
            float: right;
        }

        .btn-detail:hover {
            background-color: #d94e20;
        }

        .no-orders {
            text-align: center;
            padding: 80px 0;
            color: #999;
        }

        .no-orders i {
            font-size: 60px;
            margin-bottom: 20px;
            color: #ccc;
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
    @endphp

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
                @php
                    $status = $statusMap[$order->status] ?? [
                        'label' => ucfirst($order->status),
                        'class' => '',
                        'icon' => 'fas fa-info-circle',
                    ];
                @endphp

                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <strong>Mã đơn:</strong> {{ $order->order_number }}<br>
                            <small>🕒 {{ $order->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                        <div class="order-status {{ $status['class'] }}">
                            <i class="{{ $status['icon'] }}"></i>
                            {{ $status['label'] }}
                        </div>
                    </div>

                    <div class="row order-info">
                        <div class="col-md-6">
                            <p><strong>👤 Người nhận:</strong> {{ $order->user->name ?? 'Khách hàng' }}</p>
                            <p><strong>📞 Điện thoại:</strong> {{ $order->phone_number }}</p>
                            <p><strong>📍 Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                            <p><strong>📝 Ghi chú:</strong> {{ $order->note ?? 'Không có' }}</p>
                            <p>
                                <strong>💰 Trạng thái thanh toán:</strong>
                                {{ $order->payment_status === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                            </p>

                        </div>
                        <div class="col-md-6">
                            <p><strong>💳 Phương Thức Thanh toán:</strong> {{ strtoupper($order->payment_method) }}</p>
                            @php
                                $shippingFee = $order->shippingMethod->price ?? 0;
                                $subtotal = $order->total_amount - $shippingFee;
                            @endphp

                            <p><strong>🧮 Tạm tính:</strong> {{ number_format($subtotal, 0, ',', '.') }}đ</p>
                            @if ($shippingFee > 0)
                                <p><strong>🚚 Phí vận chuyển:</strong> {{ number_format($shippingFee, 0, ',', '.') }}đ</p>
                            @endif
                            <p><strong>💸 Tổng tiền:</strong> <span
                                    class="text-danger fw-bold">{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
                            </p> <a href="{{ route('client.order.detail', $order->id) }}" class="btn-detail mt-2">Xem chi
                                tiết</a>

                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        
    </div>
@endsection
