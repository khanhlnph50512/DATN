@extends('.client.layouts.main')
@section('content')

    <!-- CONTENT -->
    <div class="prd-detail container-fluid">
        <input type="hidden" id="is-page-product-detail" value="1">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                <div class="wrapper-slide">
                    {{-- Ảnh chính --}}
                    <div class="prd-detail-main-img">
                        <img class="main-img"
                            src="{{ asset('storage/' . ($product->primaryImage->image_url ?? 'default.jpg')) }}"
                            alt="Ảnh chính" style="width: 100%; max-height: 500px; object-fit: contain;">
                    </div>


                    {{-- Danh sách ảnh phụ (thumbnail) --}}
                    <div class="prd-detail-slide1" style="margin-top: 15px; display: flex; gap: 10px; flex-wrap: wrap;">
                        @foreach ($product->images as $img)
                            <div class="thumbnail"
                                style="width: 120px; height: 120px; overflow: hidden; border: 1px solid #ddd;">
                                <div class="cont-item">
                                    <img src="{{ asset('storage/' . $img->image_url) }}"
                                        data-img-normal="{{ asset('storage/' . $img->image_url) }}"
                                        data-img-large="{{ asset('storage/' . $img->image_url) }}" alt="Ảnh phụ"
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

                    <div class="row grp-btn1 mt-4">
                        <div class="col-12 d-flex flex-wrap align-items-center gap-2">
                            <button type="button" class="btn btn-dark w-50 py-2" id="addProductToCart"
                                data-ananas-validations>
                                <strong>THÊM VÀO GIỎ HÀNG</strong>
                            </button>

                            <button type="button" class="btn btn-warning w-50 py-2 text-white" id="buyNow">
                                <strong>MUA NGAY</strong>
                            </button>
                            {{-- <a href="javascript:void(0)" data-product-id="{{ $product->id }}"
                                class="btn btn-light border addToWishList"
                                data-liked="{{ $isFavorite ? 'true' : 'false' }}"
                                style="width: 48px; height: 48px; display: inline-flex; align-items: center; justify-content: center;">
                                <svg id="wishlist-icon-{{ $product->id }}" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" width="24" height="24"
                                    fill="{{ $isFavorite ? 'red' : 'none' }}" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5
                     5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78
                     1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                                </svg>
                            </a> --}}
                        </div>
                    </div>
            </div>
            </form>

            {{-- Thông tin sản phẩm --}}

        </div>

        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 visible-xs visible-sm">
            <div class="row prd-detail-img"></div>
        </div>
        {{-- BÌNH LUẬN SẢN PHẨM --}}
        <div class="container mt-5">
            <h4>Đánh giá & Bình luận</h4>

            {{-- Nếu đã đăng nhập --}}
            @auth
                <form action="{{ route('client.comments.store') }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="form-group">
                        <label for="content">Bình luận của bạn</label>
                        <textarea name="content" class="form-control" rows="4" required placeholder="Viết bình luận..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Gửi bình luận</button>
                </form>
            @else
                <p class="text-danger">Bạn cần <a href="{{ route('login') }}">đăng nhập</a> để bình luận.</p>
            @endauth

            {{-- Danh sách bình luận đã duyệt --}}
            <h4 class="mt-5 mb-3">Bình luận sản phẩm</h4>

            @if ($product->comments && $product->comments->where('status', 'approved')->count())
                <ul class="list-group">
                    @foreach ($product->comments->where('status', 'approved')->sortByDesc('created_at') as $comment)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div>
                                    <i class="fas fa-user-circle text-primary"></i>
                                    <strong>{{ $comment->user->name ?? 'Người dùng' }}</strong>
                                </div>
                                <small class="text-muted">
                                    <i class="far fa-clock"></i> {{ $comment->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <p class="mb-1">{{ $comment->content }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle"></i> Chưa có bình luận nào cho sản phẩm này.
                </div>
            @endif

        </div>
    </div>
    </div>

    {{-- Sản phẩm liên quan, ... có thể giữ nguyên phần này --}}
    <script>
        const variations = @json($product->variations);
    </script>
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
        ////////////////////////////////////////////////////////////////
        document.querySelectorAll('.addToWishList').forEach(btn => {
            btn.addEventListener('click', function() {
                const svg = this.querySelector('svg');
                const liked = this.dataset.liked === 'true';

                if (liked) {
                    svg.setAttribute('fill', 'red');
                    this.dataset.liked = 'false';
                    // Gửi request xoá khỏi wishlist (nếu cần)
                } else {
                    svg.setAttribute('fill', 'deeppink');
                    this.dataset.liked = 'true';
                    // Gửi request thêm vào wishlist (nếu cần)
                }
            });
        });
        /////////////////////////
        function updatePrice() {
            const selectedColorId = document.querySelector('input[name="color_id"]:checked')?.value;
            const selectedSizeId = document.getElementById('size_id')?.value;

            if (!selectedColorId || !selectedSizeId) return;

            const variation = variations.find(v => v.color_id == selectedColorId && v.size_id == selectedSizeId);

            if (variation) {
                const priceElem = document.querySelector('.saleprice');
                if (variation.price_sale && variation.price_sale > 0) {
                    priceElem.textContent = new Intl.NumberFormat('vi-VN').format(variation.price_sale) + ' VND';
                } else {
                    priceElem.textContent = new Intl.NumberFormat('vi-VN').format(variation.price) + ' VND';
                }
            }
        }

        // Gắn sự kiện khi chọn màu hoặc size
        document.querySelectorAll('input[name="color_id"]').forEach(el => el.addEventListener('change', updatePrice));
        document.getElementById('size_id').addEventListener('change', updatePrice);
    </script>
    <script>
        document.getElementById('buyNow').addEventListener('click', function() {
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
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Sau khi thêm giỏ hàng thành công, chuyển hướng tới trang giỏ hàng
                        window.location.href = '{{ route('client.carts.index') }}';
                    } else {
                        alert(data.error || 'Đã có lỗi xảy ra');
                    }
                })
                .catch(() => alert('Lỗi kết nối hoặc xử lý server'));
        });
    </script>
    @push('scripts')
    @endpush

@endsection
