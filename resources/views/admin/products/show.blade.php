@extends('admin.layouts.adminAnatats')

@section('content')
<div class="container">
    <h2>Chi tiết sản phẩm</h2>

    <p><strong>Tên:</strong> {{ $product->name }}</p>
    <p><strong>Slug:</strong> {{ $product->slug }}</p>
    <p><strong>Thương hiệu:</strong> {{ $product->brand->name ?? 'N/A' }}</p>
    <p><strong>Danh mục:</strong> {{ $product->category->name ?? 'N/A' }}</p>
    <p><strong>Giá gốc:</strong> {{ number_format($product->price) }}đ</p>
    <p><strong>Giá khuyến mãi:</strong> {{ number_format($product->price_sale) }}đ</p>
    <p><strong>Số lượng:</strong> {{ $product->quantity }}</p>
    <p><strong>Trạng thái:</strong> {{ $product->status ? 'Hiển thị' : 'Ẩn' }}</p>

    <h4>Ảnh sản phẩm</h4>
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        @foreach($product->images as $image)
            <div style="text-align: center;">
                <img src="{{ asset('storage/' . $image->image_url) }}" width="150">
                <p>{{ $image->is_primary ? 'Ảnh chính' : '' }}</p>
            </div>
        @endforeach
    </div>

    <h4>Biến thể</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Màu sắc</th>
            <th>Kích cỡ</th>
            <th>Giá</th>
            <th>Giá khuyến mãi</th>
            <th>Số lượng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($product->variations as $variation)
            <tr>
                <td>{{ $variation->color->name ?? '---' }}</td>
                <td>{{ $variation->size->name ?? '---' }}</td>
                <td>{{ number_format($variation->price) }}đ</td>
                <td>{{ number_format($variation->price_sale) }}đ</td>
                <td>{{ $variation->quantity }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
