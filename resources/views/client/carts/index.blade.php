@extends('client.layouts.main')
@section('content')
    <style>
        .cart-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .cart-item {
            border-bottom: 1px solid #ddd;
            padding: 20px 0;
        }

        .cart-item img {
            max-width: 100%;
            height: auto;
        }

        .cart-product-info h4 {
            font-weight: bold;
            font-size: 18px;
        }

        .cart-product-info p {
            margin-bottom: 8px;
        }

        .cart-summary {
            border-top: 2px solid #000;
            padding-top: 20px;
        }

        .summary-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .summary-total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        .btn-checkout {
            width: 100%;
            background-color: #ff5e14;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 12px;
            border: none;
            border-radius: 0;
            margin-top: 20px;
        }

        .promo-form input[type="text"] {
            width: 70%;
            display: inline-block;
            padding: 8px;
            border: 1px solid #ccc;
        }

        .promo-form button {
            display: inline-block;
            width: 28%;
            padding: 8px;
            background-color: #ff5e14;
            color: white;
            border: none;
        }

        .cart-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .cart-actions form,
        .cart-actions a {
            margin: 0;
        }
    </style>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-8">
                <div class="cart-title">GIỎ HÀNG</div>

                @php
                    $total = 0;
                @endphp

                @foreach ($items as $item)
                    @php
                        $variation = $item->variation;
                        $price = $variation->price_sale ?? ($variation->price ?? $item->product->price);
                        $subtotal = $price * $item->quantity;
                        $total += $subtotal;
                    @endphp

                    <div class="row cart-item align-items-center mb-3">
                        <div class="col-md-3">
                            @if ($item->product->primaryImage)
                                <img src="{{ asset('storage/' . $item->product->primaryImage->image_url) }}"
                                    alt="{{ $item->product->name }}" style="max-width: 100px;">
                            @else
                                <span>Chưa có ảnh</span>
                            @endif
                        </div>

                        <div class="col-md-6 cart-product-info">
                            <h4>{{ $item->product->name }}</h4>
                            <p>
                                Giá:
                                @if ($variation->price_sale && $variation->price_sale < $variation->price)
                                    <del class="text-muted">{{ number_format($variation->price, 0, ',', '.') }} VND</del>
                                    <strong class="text-danger">
                                        {{ number_format($variation->price_sale, 0, ',', '.') }} VND
                                    </strong>
                                @else
                                    {{ number_format($variation->price, 0, ',', '.') }} VND
                                @endif
                            </p>
                            <p>Size: {{ $variation->size->name ?? '---' }}</p>
                            <p>Màu sắc: {{ $variation->color->name ?? '---' }}</p>
                            <form action="{{ route('client.carts.updateQuantity', $item->id) }}" method="POST">
                                @csrf
                                <label>Số lượng:</label>
                                <select name="quantity" onchange="this.form.submit()" class="form-control w-50">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $i == $item->quantity ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </form>
                        </div>

                        <div class="col-md-3 text-right">
                            <form action="{{ route('client.carts.remove', $item->id) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-trash me-1"></i> Xóa
                                </button>
                            </form>
                            <div class="font-weight-bold mt-2 text-orange">
                                {{ number_format($subtotal, 0, ',', '.') }} VND
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex align-items-center gap-2 mt-4">
                    <form action="{{ route('client.carts.clear') }}" method="POST" class="m-0"
                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng không?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-secondary">XÓA HẾT</button>
                    </form>

                    <a href="{{ route('product.index') }}" class="btn btn-outline-primary">← Quay lại mua hàng</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="cart-summary">
                    <div class="summary-title">ĐƠN HÀNG</div>

                    @if (session('applied_coupon'))
                        <div class="mt-3">
                            <p class="mb-2">
                                Đã áp dụng mã:
                                <strong>{{ session('applied_coupon') }}</strong>
                            </p>

                            <form action="{{ route('client.cart.removeCoupon') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này?')">
                                    Xóa mã
                                </button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('client.cart.applyCoupon') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="coupon_code" class="form-control" placeholder="Nhập mã giảm giá"
                                    required>
                                <button class="btn btn-primary" type="submit">Áp dụng</button>
                            </div>
                        </form>
                    @endif

                    @if (session('coupon_error'))
                        <div class="text-danger mt-2">{{ session('coupon_error') }}</div>
                    @endif

                    @if (session('coupon_success'))
                        <div class="text-success mt-2">{{ session('coupon_success') }}</div>
                    @endif


                    @php
                        $discount = session('coupon_discount') ?? 0;
                        $finalTotal = $total - $discount;
                    @endphp

                    <div>
                        <p>Đơn hàng: {{ number_format($total, 0, ',', '.') }} VND</p>
                        @if ($discount > 0)
                            <p>Giảm: -{{ number_format($discount, 0, ',', '.') }} VND</p>
                        @endif
                    </div>

                    <div class="summary-total font-weight-bold">
                        Tạm tính: {{ number_format($finalTotal, 0, ',', '.') }} VND
                    </div>

                    @auth
                        <a href="{{ route('client.checkout') }}" class="btn-checkout btn btn-warning w-100 mt-3">
                            TIẾP TỤC THANH TOÁN
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-dark w-100 mt-3">
                            ĐĂNG NHẬP ĐỂ THANH TOÁN
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
