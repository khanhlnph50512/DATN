@extends('admin.layouts.adminAnatats')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Cập nhật sản phẩm</h2>

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

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Tên sản phẩm --}}
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
            </div>

            {{-- Thương hiệu --}}
            <div class="mb-3">
                <label class="form-label">Thương hiệu</label>
                <select name="brand_id" class="form-select" required>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Danh mục --}}
            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select name="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Trạng thái --}}
            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select" required>
                    <option value="1" {{ $product->status ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ !$product->status ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>

            {{-- Mô tả --}}
            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Giới tính --}}
            <div class="mb-3">
                <label class="form-label">Giới tính</label>
                <select name="gender" class="form-select" required>
                    <option value="">-- Chọn giới tính --</option>
                    <option value="nam" {{ $product->gender == 'nam' ? 'selected' : '' }}>Nam</option>
                    <option value="nu" {{ $product->gender == 'nu' ? 'selected' : '' }}>Nữ</option>
                    <option value="unisex" {{ $product->gender == 'unisex' ? 'selected' : '' }}>Unisex</option>
                </select>
            </div>

            {{-- Ảnh sản phẩm --}}
            <div class="mb-3">
                <label>Ảnh sản phẩm (nhiều ảnh)</label>
                <input type="file" name="images[]" multiple class="form-control">
                <div class="mt-2">
                    @foreach ($product->images as $index => $img)
                        <div style="display:inline-block; margin-right: 10px; text-align:center">
                            <img src="{{ asset('storage/' . $img->image_url) }}" width="100">
                            <br>
                            <input type="radio" name="primary_image" value="{{ $index }}"
                                {{ $img->is_primary ? 'checked' : '' }}> Ảnh chính
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Giá gốc --}}
            <div class="mb-3">
                <label class="form-label">Giá gốc</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control"
                    required>
            </div>

            {{-- Giá khuyến mãi --}}
            <div class="mb-3">
                <label class="form-label">Giá khuyến mãi (nếu có)</label>
                <input type="number" name="price_sale" value="{{ old('price_sale', $product->price_sale) }}"
                    class="form-control">
            </div>

            {{-- Số lượng --}}
            <div class="mb-3">
                <div class="mb-3">
                    <p><strong>Tổng số lượng:</strong> <span id="totalQuantity">0</span></p>
                </div>
            </div>

            {{-- Biến thể sản phẩm --}}
            <hr>
            {{-- Biến thể sản phẩm --}}
            <hr>
            <h5>Biến thể sản phẩm</h5>
            <div id="variant-container">
                @foreach ($product->variations as $i => $variant)
                    <div class="row variant-item mb-3">
                        <div class="col-md-3">
                            <label>Màu sắc</label>
                            <select name="variations[{{ $i }}][color_id]" class="form-select">
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}"
                                        {{ $variant->color_id == $color->id ? 'selected' : '' }}>
                                        {{ $color->name }} ({{ $color->code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Kích cỡ</label>
                            <select name="variations[{{ $i }}][size_id]" class="form-select">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}"
                                        {{ $variant->size_id == $size->id ? 'selected' : '' }}>
                                        {{ $size->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Giá</label>
                            <input type="number" name="variations[{{ $i }}][price]"
                                value="{{ $variant->price }}" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>Giá khuyến mãi</label>
                            <input type="number" name="variations[{{ $i }}][price_sale]"
                                value="{{ $variant->price_sale }}" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>Số lượng</label>
                            <input type="number" name="variations[{{ $i }}][quantity]"
                                value="{{ $variant->quantity }}" class="form-control">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-sm remove-variant">X</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-secondary mb-3" id="add-variant">+ Thêm biến thể</button>


            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </form>
    </div>

    <script>
        let variantIndex = {{ count($product->variations) }};

        function createVariantHTML(index) {
            return `
            <div class="row variant-item mb-3">
                <div class="col-md-3">
                    <label>Màu sắc</label>
                    <select name="variations[${index}][color_id]" class="form-select">
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }} ({{ $color->code }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Kích cỡ</label>
                    <select name="variations[${index}][size_id]" class="form-select">
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Giá</label>
                    <input type="number" name="variations[${index}][price]" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Giá khuyến mãi</label>
                    <input type="number" name="variations[${index}][price_sale]" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Số lượng</label>
                    <input type="number" name="variations[${index}][quantity]" class="form-control">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm remove-variant">X</button>
                </div>
            </div>
        `;
        }

        function updateTotalQuantity() {
            let total = 0;
            document.querySelectorAll('input[name$="[quantity]"]').forEach(input => {
                total += parseInt(input.value) || 0;
            });
            document.getElementById('totalQuantity').textContent = total;
        }

        function updateRemoveButtons() {
            const variants = document.querySelectorAll('.variant-item');
            variants.forEach(variant => {
                const btn = variant.querySelector('.remove-variant');
                btn.style.display = (variants.length === 1) ? 'none' : 'inline-block';
            });
        }

        // Thêm biến thể mới
        document.getElementById('add-variant').addEventListener('click', function() {
            document.getElementById('variant-container').insertAdjacentHTML('beforeend', createVariantHTML(
                variantIndex));
            variantIndex++;
            updateRemoveButtons();
        });

        // Xóa biến thể
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-variant')) {
                e.target.closest('.variant-item').remove();
                updateRemoveButtons();
                updateTotalQuantity();
            }
        });

        // Cập nhật tổng số lượng khi nhập
        document.addEventListener('input', function(e) {
            if (e.target.name.endsWith('[quantity]')) {
                updateTotalQuantity();
            }
        });

        // Khởi tạo ban đầu
        updateTotalQuantity();
        updateRemoveButtons();
    </script>

@endsection
