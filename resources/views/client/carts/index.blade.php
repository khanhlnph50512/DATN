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

        <style>.cart-actions {
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

                @foreach ($items as $item)
                    <div class="row cart-item align-items-center mb-3">
                        <div class="col-md-3">
                            @if ($item->product->primaryImage)
                                <img src="{{ asset('asset/img/' . $item->product->primaryImage->image_url) }}"
                                    alt="{{ $item->product->name }}" style="max-width: 100px;">
                                <br>
                            @else
                                <span>Chưa có ảnh</span>
                            @endif
                        </div>
                        <div class="col-md-6 cart-product-info">
                            <h4>{{ $item->product->name }}</h4>
                            <p>Giá: {{ number_format($item->product->price, 0, ',', '.') }} VND</p>
                            <p>Size: {{ $item->variation->size->name ?? '---' }}</p>
                            <p>Màu sắc: {{ $item->variation->color->name ?? '---' }}</p>
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
                            <form action="{{ route('client.carts.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <div class="text-danger mt-2">Còn hàng</div>
                            <div class="font-weight-bold mt-2 text-orange">
                                {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} VND
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

                    <form class="promo-form mb-3">
                        <input type="text" placeholder="Nhập mã khuyến mãi" class="form-control mb-2">
                        <button type="button" class="btn btn-outline-dark w-100">ÁP DỤNG</button>
                    </form>

                    <div>
                        <p>Đơn hàng: {{ number_format($total, 0, ',', '.') }} VND</p>
                        <p>Giảm: 0 VND</p>
                    </div>

                    <div class="summary-total font-weight-bold">
                        Tạm tính: {{ number_format($total, 0, ',', '.') }} VND
                    </div>

                    <a href="{{ route('client.checkout') }}" class="btn-checkout btn btn-warning w-100 mt-3">
                        TIẾP TỤC THANH TOÁN
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
