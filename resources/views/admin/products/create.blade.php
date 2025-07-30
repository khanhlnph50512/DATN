@extends('admin.layouts.adminAnatats')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Thêm sản phẩm mới</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Lỗi!</strong> Vui lòng kiểm tra lại dữ liệu nhập vào.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Tên sản phẩm --}}
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            {{-- Thương hiệu --}}
            <div class="mb-3">
                <label class="form-label">Thương hiệu</label>
                <select name="brand_id" class="form-select" required>
                    <option value="">-- Chọn thương hiệu --</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>


            {{-- Category --}}
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- Trạng thái --}}
            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select" required>
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>

            {{-- Mô tả --}}
            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>
            {{-- Giới tính --}}
            <div class="mb-3">
                <label class="form-label">Giới tính</label>
                <select name="gender" class="form-select" required>
                    <option value="">-- Chọn giới tính --</option>
                    <option value="nam">Nam</option>
                    <option value="nu">Nữ</option>
                    <option value="unisex">Unisex</option>
                </select>
            </div>

            {{-- Ảnh --}}
            <div class="mb-3">
                <label class="form-label">Ảnh sản phẩm (nhiều ảnh)</label>
                <input type="file" name="images[]" multiple class="form-control">
            </div>
            <div class="mb-3">
                <label for="primary_image" class="form-label">Chọn ảnh chính <span class="text-danger">*</span></label>
                <input type="number" min="0" class="form-control" name="primary_image" id="primary_image" required>
                <small class="text-muted">0 là ảnh đầu tiên</small>
            </div>


            {{-- Giá gốc --}}
            <div class="mb-3">
                <label class="form-label">Giá gốc</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            {{-- Giá giảm --}}
            <div class="mb-3">
                <label class="form-label">Giá khuyến mãi (nếu có)</label>
                <input type="number" name="price_sale" class="form-control">
            </div>

            {{-- Số lượng --}}
            <div class="mb-3">
                <label class="form-label">Số lượng</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>

            {{-- Biến thể sản phẩm --}}
            <hr>
            <h5>Biến thể sản phẩm</h5>
            <div id="variant-container">
                <div class="row variant-item mb-3">
                    {{-- Màu sắc --}}
                    <div class="col-md-3">
                        <label>Màu sắc</label>
                        <select name="variations[0][color_id]" class="form-select">
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">
                                    {{ $color->name }} ({{ $color->code }})
                                </option>
                            @endforeach
                        </select>

                    </div>

                    {{-- Kích cỡ --}}
                    <div class="col-md-3">
                        <label>Kích cỡ</label>
                        <select name="variations[0][size_id]" class="form-select">
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Giá --}}
                    <div class="col-md-2">
                        <label>Giá</label>
                        <input type="number" name="variations[0][price]" class="form-control">
                    </div>

                    {{-- Giá giảm --}}
                    <div class="col-md-2">
                        <label>Giá khuyến mãi</label>
                        <input type="number" name="variations[0][price_sale]" class="form-control">
                    </div>

                    {{-- Số lượng --}}
                    <div class="col-md-2">
                        <label>Số lượng</label>
                        <input type="number" name="variations[0][quantity]" class="form-control">
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary mb-3" onclick="addVariant()">+ Thêm biến thể</button>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </form>
    </div>

    <script>
        let variantIndex = 1;

        function addVariant() {
            const container = document.getElementById('variant-container');

            const variantHTML = `
        <div class="row variant-item mb-3">
            <div class="col-md-3">
                <select name="variations[${variantIndex}][color_id]" class="form-select">
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}" style="background-color: {{ $color->code }}; color: #fff;">
                            ● {{ $color->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="variations[${variantIndex}][size_id]" class="form-select">
                    @foreach ($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="variations[${variantIndex}][price]" class="form-control">
            </div>
            <div class="col-md-2">
                <input type="number" name="variations[${variantIndex}][price_sale]" class="form-control">
            </div>
            <div class="col-md-2">
                <input type="number" name="variations[${variantIndex}][quantity]" class="form-control">
            </div>
        </div>
        `;

            container.insertAdjacentHTML('beforeend', variantHTML);
            variantIndex++;
        }
    </script>
@endsection
