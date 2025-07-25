@extends('admin.layouts.adminAnatats')

@section('content')
<div class="container">
    <h2>Cập nhật sản phẩm</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Thông tin chung --}}
        <div class="mb-3">
            <label>Tên sản phẩm</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Thương hiệu</label>
            <select name="brand_id" class="form-control">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Danh mục</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Giá gốc</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Giá khuyến mãi</label>
            <input type="number" name="price_sale" value="{{ old('price_sale', $product->price_sale) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Số lượng</label>
            <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ $product->status ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ !$product->status ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        {{-- Ảnh sản phẩm --}}
        <div class="mb-3">
            <label>Ảnh sản phẩm</label>
            <input type="file" name="images[]" multiple class="form-control">
            <div class="mt-2">
                @foreach($product->images as $index => $img)
                    <div style="display:inline-block; margin-right: 10px; text-align:center">
                        <img src="{{ asset('storage/' . $img->image_url) }}" width="100">
                        <br>
                        <input type="radio" name="primary_image" value="{{ $index }}" {{ $img->is_primary ? 'checked' : '' }}> Ảnh chính
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Biến thể --}}
        <h4>Biến thể sản phẩm</h4>
        <div id="variation-wrapper">
            @foreach($product->variations as $i => $variant)
            <div class="row mb-2">
                <div class="col">
                    <select name="variations[{{ $i }}][color_id]" class="form-control">
                        <option value="">-- Chọn màu --</option>
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}" {{ $variant->color_id == $color->id ? 'selected' : '' }}>
                                {{ $color->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select name="variations[{{ $i }}][size_id]" class="form-control">
                        <option value="">-- Chọn size --</option>
                        @foreach($sizes as $size)
                            <option value="{{ $size->id }}" {{ $variant->size_id == $size->id ? 'selected' : '' }}>
                                {{ $size->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col"><input type="number" name="variations[{{ $i }}][price]" class="form-control" value="{{ $variant->price }}" placeholder="Giá"></div>
                <div class="col"><input type="number" name="variations[{{ $i }}][price_sale]" class="form-control" value="{{ $variant->price_sale }}" placeholder="Giá sale"></div>
                <div class="col"><input type="number" name="variations[{{ $i }}][quantity]" class="form-control" value="{{ $variant->quantity }}" placeholder="Số lượng"></div>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
