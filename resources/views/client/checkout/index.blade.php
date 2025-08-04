@extends('client.layouts.main')

@section('title', 'Thanh toán')

@section('content')
    <style>
        .checkout-container {
            max-width: 960px;
            margin: 40px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
        }

        .checkout-left,
        .checkout-right {
            flex: 1 1 400px;
        }

        .checkout-left h3,
        .checkout-right h3 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        .order-summary {
            background: #f9f9f9;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 10px;
        }

        .order-total {
            font-weight: bold;
            font-size: 18px;
            color: #f05a28;
            margin-top: 16px;
            display: flex;
            justify-content: space-between;
        }

        .btn-submit {
            background: #f05a28;
            color: white;
            padding: 14px;
            border: none;
            width: 100%;
            border-radius: 6px;
            font-size: 16px;
            margin-top: 20px;
            transition: background 0.2s ease-in-out;
        }

        .btn-submit:hover {
            background: #d94e20;
        }

        .total-breakdown {
            margin-top: 10px;
            font-size: 16px;
        }

        .total-breakdown span {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }
    </style>

    <form id="checkoutForm" method="POST">
        @csrf
        <div class="checkout-container">
            {{-- BÊN TRÁI: THÔNG TIN NGƯỜI NHẬN --}}
            <div class="checkout-left">
                <h3>Thông tin giao hàng</h3>
                <div class="form-group">

                    <input type="text" name="name" class="form-control" placeholder="Họ và tên"
                        value="{{ old('name', $user->name ?? '') }}" required>
                </div>
                <div class="form-group">

                    <input type="text" name="phone_number" class="form-control" placeholder="Số điện thoại"
                        value="{{ old('phone_number', $user->phone ?? '') }}" required>
                </div>
                <div class="form-group">

                    <input type="email" name="email" class="form-control" placeholder="Email (không bắt buộc)"
                        value="{{ old('email', $user->email ?? '') }}">
                </div>
                <div class="form-group">

                    <textarea name="shipping_address" rows="3" class="form-control" placeholder="Địa chỉ giao hàng cụ thể" required>{{ old('shipping_address', $user->address ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <textarea name="note" rows="3" class="form-control" placeholder="Ghi chú cho người giao hàng (nếu có)"></textarea>
                </div>

                <div class="form-group">
                    <label for="shipping_method_id">Chọn phương thức vận chuyển:</label>
                    <select name="shipping_method_id" id="shipping_method_id" class="form-control" required
                        onchange="updateTotal()">
                        @foreach ($shippingMethods as $method)
                            <option value="{{ $method->id }}" data-fee="{{ $method->price }}">
                                {{ $method->name }} - {{ number_format($method->price, 0, ',', '.') }}đ
                            </option>
                        @endforeach
                    </select>
                </div>

                <h3>Phương thức thanh toán</h3>
                <div class="form-group">
                    <label><input type="radio" name="payment_method" value="cod" checked> Thanh toán khi nhận hàng
                        (COD)</label>
                </div>
                <div class="form-group">
                    <label><input type="radio" name="payment_method" value="vnpay">
                        Thanh toán qua VNPAY</label>
                </div>
            </div>

            {{-- BÊN PHẢI: ĐƠN HÀNG --}}
            <div class="checkout-right">
                <div class="order-summary">
                    <h3>Đơn hàng của bạn</h3>

                    @foreach ($cartItems as $item)
                        @php
                            $total = 0;
                            foreach ($cartItems as $item) {
                                $price =
                                    $item->variation->price_sale ??
                                    ($item->variation->price ?? ($item->product->price ?? 0));
                                $total += $price * $item->quantity;
                            }

                            $discount = session('coupon_discount') ?? 0;
                            $finalTotal = $total - $discount;
                        @endphp

                        <div class="order-item">
                            <div>
                                <strong>{{ $item->product->name }}</strong><br>
                                Size: {{ $item->variation->size->name ?? '---' }} |
                                Màu: {{ $item->variation->color->name ?? '---' }}<br>
                                SL: {{ $item->quantity }}
                            </div>
                            <div>
                                {{ number_format($price * $item->quantity, 0, ',', '.') }}đ
                            </div>
                        </div>
                    @endforeach

                    <div class="total-breakdown">
                        <span><strong>Tạm tính:</strong> <span
                                id="subtotal">{{ number_format($total, 0, ',', '.') }}đ</span></span>

                        @if ($discount > 0)
                            <span><strong>Giảm giá:</strong> <span
                                    class="text-danger">-{{ number_format($discount, 0, ',', '.') }}đ</span></span>
                        @endif

                        <span><strong>Phí vận chuyển:</strong> <span id="shippingFee">0đ</span></span>

                        <div class="order-total">
                            <span><strong>Tổng cộng:</strong></span>
                            <span id="grandTotal">{{ number_format($finalTotal, 0, ',', '.') }}đ</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">HOÀN TẤT ĐẶT HÀNG</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        const subtotal = {{ $total }};
        const discount = {{ $discount }};
        const shippingSelect = document.getElementById('shipping_method_id');
        const feeDisplay = document.getElementById('shippingFee');
        const totalDisplay = document.getElementById('grandTotal');

        function updateTotal() {
            const selectedOption = shippingSelect.options[shippingSelect.selectedIndex];
            const fee = parseInt(selectedOption.dataset.fee) || 0;

            feeDisplay.innerText = fee.toLocaleString('vi-VN') + 'đ';
            totalDisplay.innerText = (subtotal - discount + fee).toLocaleString('vi-VN') + 'đ';
        }

        // Gọi ngay khi trang load
        window.onload = updateTotal;
    </script>
    <script>
        const form = document.getElementById('checkoutForm');
        const paymentRadios = document.querySelectorAll('input[name="payment_method"]');

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // chặn submit mặc định

            let selectedPayment = document.querySelector('input[name="payment_method"]:checked').value;

            if (selectedPayment === 'cod') {
                form.action = "{{ route('client.checkout.process') }}";
            } else if (selectedPayment === 'vnpay') {
                form.action = "{{ route('vnpay.payment') }}";
            }

            form.submit();
        });
    </script>
@endsection
