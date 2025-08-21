@extends('.client.layouts.main')
@section('content')
    <div class="prd1-cont container-fluid">
        <div class="row">

            <!-- FILTER ON PC VERSION (will be hidden on mobile)-->

            <!-- END FILTER ON PC VERSION (will be hidden on mobile)-->

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 prd1-right">

                <div class="row prd1-right-items">
                    @if ($products->count())
                        @foreach ($products as $product)
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 item">
                                <div class="thumbnail">
                                    <div class="cont-item">
                                        <a
                                            href="{{ route('client.products.detailProducts', ['slug' => Str::slug($product->name), 'id' => $product->id]) }}">
                                            @if ($product->primaryImage)
                                                <img src="{{ asset('storage/' . $product->primaryImage->image_url) }}"
                                                    width="100">
                                                width="100">
                                                <br>
                                            @else
                                                <span>Chưa có ảnh</span>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="button">
                                        <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                            href="{{ route('client.products.detailProducts', ['slug' => Str::slug($product->name), 'id' => $product->id]) }}">
                                            MUA NGAY
                                        </a>
                                       
                                    </div>
                                    <div class="caption">
                                        <h3 class="type">New Arrival</h3>
                                        <h3 class="divider"></h3>
                                        <h3 class="name">
                                            <a
                                                href="{{ route('client.products.detailProducts', ['slug' => Str::slug($product->name), 'id' => $product->id]) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h3>
                                        <h3 class="color">Material Color</h3>
                                        <h3 class="price">
                                            @if ($product->price_sale)
                                                <span style="text-decoration: line-through;">
                                                    {{ number_format($product->price, 0, ',', '.') }} VND
                                                </span><br>
                                                <span style="color: red;">
                                                    {{ number_format($product->price_sale, 0, ',', '.') }} VND
                                                </span>
                                            @else
                                                {{ number_format($product->price, 0, ',', '.') }} VND
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <h4>Không tìm thấy sản phẩm nào phù hợp.</h4>
                        </div>
                    @endif
                </div>

                {{-- Phân trang --}}
                @if ($products->count())
                    <div class="pagination-wrapper text-center">
                        {{ $products->appends(request()->all())->links() }}
                    </div>
                @endif

                <div class="gotop hidden-xs hidden-sm">
                    <a href="#"><img src="../wp-content/themes/ananas/fe-assets/images/gotop.png"></a>
                </div>
                <div class="text-center load-more-icon">
                    <img src="../wp-content/themes/ananas/fe-assets/images/loading.gif">
                </div>

            </div>

            <input type="hidden" value="1" class="isProductListPage">
        </div>
    </div>
    <!-- END CONTENT -->

@endsection
