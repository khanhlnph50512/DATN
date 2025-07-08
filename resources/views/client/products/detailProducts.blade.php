@extends('.client.layouts.main')
@section('content')
    <!-- CONTENT -->
    <div class="prd-detail container-fluid">
        <input type="hidden" id="is-page-product-detail" value="1">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 hidden-xs hidden-sm">
                <ol class="breadcrumb">
                    <li><a href="../../product-list/index2819.html?gender=&amp;category=shoes&amp;attribute=">Shoes</a></li>
                    <li><a href="../../product-list/indexb5c0.html?gender=&amp;category=&amp;attribute=track-6">Track 6</a>
                    </li>
                    <li class="active">Track 6 Fold-over Tongue - The Team - Low Top</li>
                </ol>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                <div class="wrapper-slide">
                    {{-- Ảnh chính --}}
                    <div class="prd-detail-main-img">
                        <img class="main-img"
                            src="{{ asset('asset/img/' . ($product->primaryImage->image_url ?? 'default.jpg')) }}"
                            alt="Ảnh chính" style="width: 100%; max-height: 500px; object-fit: contain;">
                    </div>

                    {{-- Danh sách ảnh phụ (thumbnail) --}}
                    <div class="prd-detail-slide1" style="margin-top: 15px; display: flex; gap: 10px; flex-wrap: wrap;">
                        @foreach ($product->images as $img)
                            <div class="thumbnail"
                                style="width: 120px; height: 120px; overflow: hidden; border: 1px solid #ddd;">
                                <div class="cont-item">
                                    <img src="{{ asset('asset/img/' . $img->image_url) }}"
                                        data-img-normal="{{ asset('asset/img/' . $img->image_url) }}"
                                        data-img-large="{{ asset('asset/img/' . $img->image_url) }}" alt="Ảnh phụ"
                                        style="width: 100%; height: 100%; object-fit: cover; cursor: pointer;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 prd-detail-right">
                {{-- Tên sản phẩm --}}
                <h4>{{ $product->name }}</h4>

                {{-- Mã sản phẩm & Tình trạng --}}
                <h6 class="detail1">
                    <span class="pull-left">
                        Mã sản phẩm: <strong>{{ $product->code ?? 'N/A' }}</strong>
                    </span>
                    <span class="pull-right">
                        Tình trạng:
                        <strong>{{ $product->status == 1 ? 'New Arrival' : 'Ngừng bán' }}</strong>
                    </span>
                </h6>

                {{-- Giá --}}
                <h5 class="detail1">
                    @if ($product->price_sale)
                        <span class="saleprice">{{ number_format($product->price_sale, 0, ',', '.') }} VND</span>
                    @else
                        <span class="saleprice">{{ number_format($product->price, 0, ',', '.') }} VND</span>
                    @endif
                </h5>

                <div class="divider"></div>

                {{-- Form thêm giỏ hàng --}}
                <form id="formAddToCart" action="#" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    {{-- MÀU: hiển thị khối màu tròn --}}
                    <div class="form-group">
                        <label><strong>Chọn màu:</strong></label>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            @php
                                $colors = $product->variations->pluck('color')->unique('id');
                            @endphp
                            @foreach ($colors as $color)
                                <label style="cursor: pointer;">
                                    <input type="radio" name="color_id" value="{{ $color->id }}" hidden>
                                    <span
                                        style="
                                        display: inline-block;
                                        width: 30px;
                                        height: 30px;
                                        border-radius: 50%;
                                        background-color: {{ $color->code }};
                                        border: 1px solid #ccc;
                                    "></span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- SIZE --}}
                    <div class="form-group" style="margin-top: 15px;">
                        <label for="size_id"><strong>Chọn size:</strong></label>
                        <select name="size_id" id="size_id" class="form-control">
                            <option selected disabled>-- Chọn size --</option>
                            @php
                                $sizes = $product->variations->pluck('size')->unique('id');
                            @endphp
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SỐ LƯỢNG --}}
                    <div class="form-group" style="margin-top: 15px;">
                        <label for="quantity"><strong>Chọn số lượng:</strong></label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1"
                            max="{{ $product->quantity }}" value="1">
                    </div>

                    <div class="row grp-btn1" style="margin-top: 15px;">
                        <button type="button" class="btn btn-addcart" id="addProductToCart" data-ananas-validations>THÊM
                            VÀO GIỎ HÀNG</button>

                        <a href="javascript:void(0)" data-idProduct="{{ $product->id }}"
                            class="btn btn-like addToWishList" data-isProductListPage="0" data-liked="false"
                            data-action="transferCartToWishList"
                            data-img="../../wp-content/themes/ananas/fe-assets/images/svg/Heart_product_1.svg"
                            data-img-like="https://ananas.vn/wp-content/themes/ananas/fe-assets/images/svg/Heart_product_2.svg ?"
                            data-img-unlike="../../wp-content/themes/ananas/fe-assets/images/svg/Heart_product_1.svg">
                            <img id="image-heart"
                                src="../../wp-content/themes/ananas/fe-assets/images/svg/Heart_product_1.svg"></a>
                    </div>
                </form>

                {{-- Thông tin sản phẩm --}}
                <div class="row" style="margin-top: 15px;">
                    <div class="panel-group" id="prdDetailInfor" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#prdDetailInfor"
                                        href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        THÔNG TIN SẢN PHẨM <span class="caret"></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                aria-labelledby="headingOne">
                                <div class="divider-1"></div>
                                <div class="panel-body">
                                    <h6>
                                        <p>Gender: Unisex<br />
                                            Size run: 36 – 46<br />
                                            Upper: C-Leather<br />
                                            Outsole: Rubber</p>
                                        <p><a href="../../wp-content/uploads/Ananas_SizeChart.jpg"><img
                                                    class="alignnone wp-image-886913"
                                                    src="../../wp-content/uploads/Ananas_SizeChart.jpg" alt=""
                                                    width="398" height="563"
                                                    srcset="https://ananas.vn/wp-content/uploads/Ananas_SizeChart.jpg 481w, https://ananas.vn/wp-content/uploads/Ananas_SizeChart-212x300.jpg 212w, https://ananas.vn/wp-content/uploads/Ananas_SizeChart-184x260.jpg 184w, https://ananas.vn/wp-content/uploads/Ananas_SizeChart-353x500.jpg 353w"
                                                    sizes="(max-width: 398px) 100vw, 398px" /></a></p>
                                    </h6>
                                </div>
                            </div>
                            <div class="divider-1"></div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse"
                                        data-parent="#prdDetailInfor" href="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        QUY ĐỊNH ĐỔI SẢN PHẨM <span class="caret"></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingTwo">
                                <div class="divider-1"></div>
                                <div class="panel-body">
                                    <h6>
                                        <ul>
                                            <li>Chỉ đổi hàng 1 lần duy nhất, mong bạn cân nhắc kĩ trước khi quyết định.
                                            </li>
                                            <li>Thời hạn đổi sản phẩm khi mua trực tiếp tại cửa hàng là 07 ngày, kể từ ngày
                                                mua.
                                                Đổi sản phẩm khi mua online là 14 ngày, kể từ ngày nhận hàng.
                                            </li>
                                            <li>Sản phẩm đổi phải kèm hóa đơn. Bắt buộc phải còn nguyên tem, hộp, nhãn mác.
                                            </li>
                                            <li>Sản phẩm đổi không có dấu hiệu đã qua sử dụng, không giặt tẩy, bám bẩn, biến
                                                dạng.
                                            </li>
                                            <li>Ananas chỉ ưu tiên hỗ trợ đổi size. Trong trường hợp sản phẩm hết size cần
                                                đổi,
                                                bạn có thể đổi sang 01 sản phẩm khác:<br />
                                                - Nếu sản phẩm muốn đổi ngang giá trị hoặc có giá trị cao hơn, bạn sẽ cần bù
                                                khoảng chênh lệch tại thời điểm đổi (nếu có).<br />
                                                - Nếu bạn mong muốn đổi sản phẩm có giá trị thấp hơn, chúng tôi sẽ không
                                                hoàn
                                                lại tiền.</li>
                                            <li>Trong trường hợp sản phẩm - size bạn muốn đổi không còn hàng trong hệ thống.
                                                Vui lòng chọn sản phẩm khác.</li>
                                            <li>Không hoàn trả bằng tiền mặt dù bất cứ trong trường hợp nào. Mong bạn thông
                                                cảm.
                                            </li>
                                            <li>Không áp dụng chính sách đổi hàng với các sản phẩm đang áp dụng chương trình
                                                Sale Off
                                                từ 40% trở lên.</li>
                                        </ul>
                                    </h6>
                                </div>
                            </div>
                            <div class="divider-1"></div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse"
                                        data-parent="#prdDetailInfor" href="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        BẢO HÀNH THẾ NÀO ? <span class="caret"></span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingThree">
                                <div class="divider-1"></div>
                                <div class="panel-body">
                                    <h6>
                                        <p>Mỗi đôi giày Ananas trước khi xuất xưởng đều trải qua nhiều khâu kiểm tra.
                                            Tuy vậy, trong quá trình sử dụng, nếu nhận thấy các lỗi: gãy đế, hở đế, đứt
                                            chỉ may,...trong thời gian 6 tháng từ ngày mua hàng, mong bạn sớm gửi sản phẩm
                                            về
                                            Ananas nhằm giúp chúng tôi có cơ hội phục vụ bạn tốt hơn. Vui lòng gửi sản phẩm
                                            về bất kỳ cửa hàng Ananas nào, hoặc gửi đến trung tâm bảo hành Ananas ngay trong
                                            trung tâm TP.HCM trong giờ hành chính:</p>
                                        <p>Địa chỉ: 5C Tân Cảng, P.25, Q.Bình Thạnh , TP. Hồ Chí Minh.<br />
                                            Hotline: 1900 0014</p>
                                    </h6>
                                </div>
                            </div>
                            <div class="divider-1 hidden-xs hidden-sm"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 visible-xs visible-sm">
                <div class="row prd-detail-img"></div>
            </div>
        </div>
    </div>

    {{-- Sản phẩm liên quan, ... có thể giữ nguyên phần này --}}

    <script>
        document.getElementById('addProductToCart').addEventListener('click', function() {
            const form = document.getElementById('formAddToCart');
            const formData = new FormData(form);

            // Kiểm tra bắt buộc
            if (!formData.get('color_id') || !formData.get('size_id')) {
                alert('Vui lòng chọn màu và size!');
                return;
            }

            fetch('{{ route('client.carts.add') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json', // để Laravel trả JSON
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert(data.success);
                        // nếu muốn redirect sang trang giỏ hàng thì bật dòng sau:
                        // window.location.href = '{{ route('client.carts.index') }}';
                    } else {
                        alert(data.error || 'Đã có lỗi xảy ra');
                    }
                })
                .catch(() => alert('Lỗi kết nối hoặc xử lý server'));
        });
    </script>
@endsection
