@extends('client.layouts.main')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Sản phẩm yêu thích của bạn</h2>

    @if($wishlists->isEmpty())
        <p>Bạn chưa có sản phẩm nào trong danh sách yêu thích.</p>
    @else
        <div class="row">
            @foreach($wishlists as $item)
                @php
                    $product = $item->product;
                @endphp
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <a href="{{ route('product.show', $product->slug) }}">
                            <img src="{{ $product->primaryImage->image_url ?? 'default.jpg' }}" class="card-img-top" alt="{{ $product->name }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ number_format($product->price) }}₫</p>
                        </div>
                        <div class="card-footer">
                            <form method="POST" class="removeFromWishlistForm">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="button" class="btn btn-danger btn-sm removeFromWishlist">Xóa khỏi yêu thích</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.removeFromWishlist').click(function () {
            const button = $(this);
            const productId = button.closest('form').find('input[name="product_id"]').val();

            $.ajax({
                url: "{{ route('wishlist.remove') }}",
                type: 'POST',
                data: {
                    product_id: productId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (res) {
                    alert(res.message);
                    location.reload();
                },
                error: function () {
                    alert('Có lỗi xảy ra!');
                }
            });
        });
    });
</script>
@endsection
