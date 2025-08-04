@extends('client.layouts.main')

@section('title', 'Sản phẩm yêu thích')

@section('content')
    <style>
        .wishlist-card {
            transition: all 0.3s ease-in-out;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            height: 100%;
        }

        .wishlist-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .wishlist-card img {
            height: 220px;
            object-fit: cover;
        }

        .wishlist-card .card-body {
            text-align: center;
        }

        .wishlist-card .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .price {
            font-size: 1rem;
        }

        .price-original {
            text-decoration: line-through;
            color: #888;
            margin-right: 6px;
        }

        .category-badge {
            display: inline-block;
            background: #f0f0f0;
            border-radius: 10px;
            padding: 3px 10px;
            font-size: 0.85rem;
            margin-bottom: 10px;
        }
    </style>

    <div class="container py-5">
        <h2 class="mb-4">Danh sách sản phẩm yêu thích</h2>

        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card wishlist-card">
                        <img src="{{ asset('storage/' . $product->primaryImage->image_url) }}" class="card-img-top"
                            alt="{{ $product->name }}">
                        <div class="card-body">
                            @if ($product->category)
                                <div class="category-badge">{{ $product->category->name }}</div>
                            @endif

                            <h5 class="card-title">{{ $product->name }}</h5>

                            <div class="price mb-2">
                                @if ($product->price_sale)
                                    <span class="price-original">{{ number_format($product->price) }}đ</span>
                                    <span class="text-danger fw-bold">{{ number_format($product->price_sale) }}đ</span>
                                @else
                                    <span class="text-dark fw-bold">{{ number_format($product->price) }}đ</span>
                                @endif
                            </div>

                            <div class="d-grid gap-2">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="{{ route('client.products.detailProducts', ['slug' => Str::slug($product->name), 'id' => $product->id]) }}">
                                    Chi tiết sản phẩm
                                </a>
                                <form action="{{ route('client.wishlist.remove', $product->id) }}" method="POST"
                                    onsubmit="return confirm('Bạn chắc chắn muốn xóa khỏi danh sách yêu thích?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Xóa khỏi yêu thích</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">Chưa có sản phẩm nào được yêu thích.</div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
