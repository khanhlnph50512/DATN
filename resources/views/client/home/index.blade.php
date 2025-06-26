@extends('.client.layouts.main')
@section('content')
    <!-- END HEADER MOBILE--> <!-- CONTENT -->
    <div class="home-banner container-fluid">
        <!-- PC banner1 -->
        <div class="slide-banner hidden-xs hidden-sm">
            <a href="product-list/indexcd9e.html?gender=&amp;category=&amp;attribute=day-slide">
                <div class="cont-item">
                    <img src="wp-content/uploads/1920x960.jpg">
                </div>
            </a>
        </div>
        <!-- End PC banner1 -->

        <!-- Mobile banner1 -->
        <div class="slide-banner-mobile visible-xs visible-sm">
            <a href="product-list/indexcd9e.html?gender=&amp;category=&amp;attribute=day-slide">
                <div class="cont-item">
                    <img src="wp-content/uploads/BANNER-DAYSLIDE-02.jpg">
                </div>
            </a>
        </div>
        <!-- End Mobile banner1 -->
    </div>

    <div class="home-collection container-fluid">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 left">
                <div class="slide-collection">
                    <div class="cont-item">
                        <div class="adv-collection"><a
                                href="product-list/indexdf17.html?gender=&amp;category=&amp;attribute=black">
                                {{-- <img
                                    src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                            </a>
                        </div>
                        <div class="content-collection">
                            <h3 class="title"><a
                                    href="product-list/indexdf17.html?gender=&amp;category=&amp;attribute=black">BLACK &
                                    BLACK</a>
                            </h3>
                            <h3 class="description">
                                <p>Mặc dù được ứng dụng rất nhiều, nhưng sắc đen lúc nào cũng toát lên một vẻ huyền bí không
                                    nhàm chán</p>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 right">
                <div class="adv-collection"><a href="promotion/clearance-sale/index.html">
                        {{-- <img src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                    </a>
                </div>
                <div class="content-collection">
                    <h3 class="title"><a href="promotion/clearance-sale/index.html">OUTLET SALE</a>
                    </h3>
                    <h3 class="description">
                        <p>Danh mục những sản phẩm bán tại "giá tốt hơn" chỉ được bán kênh online - Online Only, chúng đã
                            từng làm mưa làm gió một thời gian và hiện đang rơi vào tình trạng bể size, bể số.</p>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <!-- PC: Home-buy -->
    <div class="home-buy container-fluid hidden-xs hidden-sm">
        <div class="row title">DANH MỤC MUA HÀNG</div>
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 item">
                <div class="item-bg">
                    <div class="black-bg"></div>
                    {{-- <img src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                </div>
                <div class="item-group">
                    <a class="title" href="#">GIÀY NAM</a>
                    <a class="sub"
                        href="product-list/index3b57.html?gender=men&amp;category=&amp;attribute=new-arrival">New
                        Arrivals</a>
                    <a class="sub" href="product-list/index.html">Best Seller</a>
                    <a class="sub" href="promotion/clearance-sale/index.html">Sale-off</a>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 item">
                <div class="item-bg">
                    <div class="black-bg"></div>
                    {{-- <img src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                </div>
                <div class="item-group">
                    <a class="title" href="#">GIÀY NỮ</a>
                    <a class="sub"
                        href="product-list/index78a3.html?gender=women&amp;category=&amp;attribute=new-arrival">New
                        Arrivals</a>
                    <a class="sub" href="product-list/index.html">Best Seller</a>
                    <a class="sub" href="promotion/clearance-sale/index.html">Sale-off</a>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 item">
                <div class="item-bg">
                    <div class="black-bg"></div>
                    {{-- <img src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                </div>
                <div class="item-group">
                    <a class="title" href="#">DÒNG SẢN PHẨM</a>
                    <a class="sub" href="product-list/index62a9.html?gender=&amp;category=&amp;attribute=basas">Basas</a>
                    <a class="sub"
                        href="product-list/index9809.html?gender=&amp;category=&amp;attribute=vintas">Vintas</a>
                    <a class="sub" href="product-list/index8b9a.html?gender=&amp;category=&amp;attribute=urbas">Urbas</a>
                    <a class="sub"
                        href="product-list/index688b.html?gender=&amp;category=&amp;attribute=pattas">Pattas</a>
                </div>
            </div>
        </div>
    </div>
@endsection
