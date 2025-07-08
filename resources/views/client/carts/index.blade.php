@extends('client.layouts.main')
@section('content')
    <div class="main-cart container-fluid" data-cart-list>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 prd-search">
            <div class="row prd-search-title">GIỎ HÀNG CỦA BẠN</div>
            <div class="row divider2"></div>

            @if($items->isEmpty())
                <div class="text-no-result">Bạn đang không có sản phẩm nào trong giỏ hàng!</div>
                <div class="row button1 text-center">
                    <a href="{{ route('product.index') }}" class="btn btn-buy">QUAY LẠI MUA HÀNG</a>
                </div>
            @else
                @foreach($items as $item)
                    <div class="row cart-item mb-4">
                        <div class="col-md-2">
                            <img src="{{ $item->product->image ?? asset('no-image.png') }}" alt="{{ $item->product->name }}" class="img-responsive">
                        </div>
                        <div class="col-md-6">
                            <h4>{{ $item->product->name }}</h4>
                            <p>Giá: {{ number_format($item->product->price, 0, ',', '.') }} VND</p>
                            <p>Size: {{ $item->variation->size->name ?? '---' }}</p>

                            <form action="{{ route('client.cart.update', $item->id) }}" method="POST" class="form-inline">
                                @csrf
                                <label for="quantity">Số lượng:</label>
                                <select name="quantity" onchange="this.form.submit()" class="form-control mx-2">
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $i == $item->quantity ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </form>

                            <form action="{{ route('client.cart.remove', $item->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                            </form>
                        </div>
                        <div class="col-md-4 text-right">
                            <strong>{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} VND</strong>
                        </div>
                    </div>
                    <hr>
                @endforeach

                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('client.cart.clear') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-warning">XÓA HẾT</button>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        <h4>Tạm tính: <strong>{{ number_format($total, 0, ',', '.') }} VND</strong></h4>
                        <a href="{{ route('client.checkout.index') }}" class="btn btn-success">TIẾP TỤC THANH TOÁN</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
