@extends('layouts.adminAnatats')

@section('content')
    <style>
        .product-details-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 30px;
            flex-wrap: wrap;
        }

        .product-info {
            flex: 1;
            min-width: 300px;
        }

        .product-info p {
            margin: 8px 0;
        }

        .product-images {
            width: 300px;
        }

        .product-images img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 6px;
            border: 3px solid #ccc;
        }

        .primary-image {
            border-color: green !important;
        }

        .variant-table {
            margin-top: 30px;
            border-collapse: collapse;
            width: 100%;
        }

        .variant-table th,
        .variant-table td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: center;
        }

        .variant-table th {
            background-color: #f8f8f8;
        }

        .btn-back {
            margin-top: 25px;
        }

        .status-active {
            color: green;
            font-weight: bold;
        }

        .status-inactive {
            color: red;
            font-weight: bold;
        }
    </style>

    <div class="container">
        <h1>Chi tiết sản phẩm: {{ $product->name }}</h1>

        <div class="product-details-container">
            {{-- Thông tin sản phẩm --}}
            <div class="product-info">
                <p><strong>Thương hiệu:</strong> {{ $product->brand->name ?? 'Chưa có' }}</p>
                <p><strong>Danh mục:</strong> {{ $product->category->name ?? 'Chưa có' }}</p>
                <p><strong>Giá:</strong> {{ number_format($product->price) }} đ</p>
                <p><strong>Giá sale:</strong>
                    {{ $product->price_sale ? number_format($product->price_sale) . ' đ' : 'Không' }}</p>
                <p><strong>Số lượng:</strong> {{ $product->quantity }}</p>
                <p><strong>Mô tả:</strong> {{ $product->description }}</p>
                <p><strong>Trạng thái:</strong>
                    {!! $product->status
                        ? '<span class="status-active">Hoạt động</span>'
                        : '<span class="status-inactive">Ngưng hoạt động</span>' !!}
                </p>
            </div>

            {{-- Ảnh sản phẩm --}}
            <div class="product-images">
                @foreach ($product->images as $image)
                    <div style="margin-bottom: 10px; display: inline-block; text-align: center;">
                        <img src="{{ asset('asset/img/' . $image->image_url) }}"
                            style="width: 100px; height: 100px; object-fit: cover; border: {{ $image->is_primary ? '3px solid green' : '1px solid #ccc' }};"
                            class="{{ $image->is_primary ? 'primary-image' : '' }}" alt="Ảnh sản phẩm">
                        @if ($image->is_primary)
                            <p style="margin-top: 5px; color: green;">Ảnh chính</p>
                        @endif
                    </div>
                @endforeach
            </div>

        </div>

        {{-- Biến thể sản phẩm --}}
        <h3>Biến thể sản phẩm</h3>
        @if ($product->variations->isEmpty())
            <p>Chưa có biến thể</p>
        @else
            <table class="variant-table">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Màu sắc</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product->variations as $variation)
                        <tr>
                            <td>{{ $variation->size->name ?? 'N/A' }}</td>
                            <td>{{ $variation->color->name ?? 'N/A' }}</td>
                            <td>{{ $variation->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-back">Quay lại danh sách</a>
    </div>
@endsection
