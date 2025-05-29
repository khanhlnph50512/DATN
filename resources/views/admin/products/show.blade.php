@extends('admin.layouts.master')



@section('content')
<div class="container">
    <h1>Chi tiết sản phẩm: {{ $product->name }}</h1>

    <div>
        <strong>Thương hiệu:</strong> {{ $product->brand->name ?? 'Chưa có' }} <br>
        <strong>Danh mục:</strong> {{ $product->category->name ?? 'Chưa có' }} <br>
        <strong>Giá:</strong> {{ number_format($product->price) }} đ <br>
        <strong>Giá sale:</strong> {{ $product->price_sale ? number_format($product->price_sale) . ' đ' : 'Không' }} <br>
        <strong>Số lượng:</strong> {{ $product->quantity }} <br>
        <strong>Mô tả:</strong> <p>{{ $product->description }}</p>
        <strong>Trạng thái:</strong> {!! $product->status ? '<span style="color:green;">Hoạt động</span>' : '<span style="color:red;">Ngưng hoạt động</span>' !!}
    </div>

    <hr>

    <h3>Ảnh sản phẩm</h3>
    <div style="display:flex; gap:15px; flex-wrap: wrap;">
        @foreach($product->images as $image)
            <div>
                <img src="{{ asset('storage/' . $image->image_url) }}" alt="Ảnh sản phẩm" style="width:150px; height:150px; object-fit:cover; border: {{ $image->is_primary ? '3px solid green' : '1px solid #ccc' }}">
                <div style="text-align:center;">{{ $image->is_primary ? 'Ảnh chính' : '' }}</div>
            </div>
        @endforeach
    </div>

    <hr>

    <h3>Biến thể sản phẩm</h3>
    @if ($product->variations->isEmpty())
        <p>Chưa có biến thể</p>
    @else
        <table class="table table-bordered" style="width: 60%">
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

    <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Quay lại danh sách</a>
</div>
@endsection
