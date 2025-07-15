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

    .checkout-left, .checkout-right {
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
</style>

<form action="{{ route('client.checkout.process') }}" method="POST">
    @csrf
    <div class="checkout-container">
        {{-- BÊN TRÁI: THÔNG TIN NGƯỜI NHẬN --}}
        <div class="checkout-left">
            <h3>Thông tin giao hàng</h3>

            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Họ và tên" required>
            </div>

            <div class="form-group">
                <input type="text" name="phone_number" class="form-control" placeholder="Số điện thoại" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email (không bắt buộc)">
            </div>

            <div class="form-group">
                <textarea name="shipping_address" rows="3" class="form-control" placeholder="Địa chỉ giao hàng cụ thể" required></textarea>
            </div>

            <div class="form-group">
                <textarea name="note" rows="3" class="form-control" placeholder="Ghi chú cho người giao hàng (nếu có)"></textarea>
            </div>

            <h3>Phương thức thanh toán</h3>
            <div class="form-group">
                <label><input type="radio" name="payment_method" value="cod" checked> Thanh toán khi nhận hàng (COD)</label>
            </div>
            <div class="form-group">
                <label><input type="radio" name="payment_method" value="online" disabled> Thanh toán online (chưa hỗ trợ)</label>
            </div>
        </div>

        {{-- BÊN PHẢI: ĐƠN HÀNG --}}
        <div class="checkout-right">
            <div class="order-summary">
                <h3>Đơn hàng của bạn</h3>

                @foreach ($cartItems as $item)
                    <div class="order-item">
                        <div>
                            <strong>{{ $item->product->name }}</strong><br>
                            Size: {{ $item->variation->size->name ?? '---' }} |
                            Màu: {{ $item->variation->color->name ?? '---' }}<br>
                            SL: {{ $item->quantity }}
                        </div>
                        <div>
                            {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}đ
                        </div>
                    </div>
                @endforeach

                <div class="order-total">
                    <span>Tổng cộng:</span>
                    <span>{{ number_format($total, 0, ',', '.') }}đ</span>
                </div>

                <button type="submit" class="btn-submit">HOÀN TẤT ĐẶT HÀNG</button>
            </div>
        </div>
    </div>
</form>
@endsection
