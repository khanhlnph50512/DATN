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
                <p><strong>Tổng số lượng:</strong> <span id="totalQuantity">0</span></p>
            </div>

            {{-- Biến thể sản phẩm --}}
            <hr>
            <div class="mb-3">
                <label class="form-label">Biến thể</label>

                <div id="variant-container">
                    <div class="row variant-item mb-3">
                        <div class="col-md-3">
                            <select name="variations[0][color_id]" class="form-select">
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }} ({{ $color->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="variations[0][size_id]" class="form-select">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="variations[0][price]" class="form-control" placeholder="Giá">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="variations[0][price_sale]" class="form-control"
                                placeholder="Giá KM">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="variations[0][quantity]" class="form-control" placeholder="SL">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-sm remove-variant">X</button>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-variant" class="btn btn-secondary mt-2">+ Thêm biến thể</button>
            </div>

            <script>
                let variantIndex = 1;

                function createVariantHTML(index) {
                    return `
        <div class="row variant-item mb-3">
            <div class="col-md-3">
                <select name="variations[${index}][color_id]" class="form-select">
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }} ({{ $color->code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="variations[${index}][size_id]" class="form-select">
                    @foreach ($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="variations[${index}][price]" class="form-control" placeholder="Giá">
            </div>
            <div class="col-md-2">
                <input type="number" name="variations[${index}][price_sale]" class="form-control" placeholder="Giá KM">
            </div>
            <div class="col-md-2">
                <input type="number" name="variations[${index}][quantity]" class="form-control" placeholder="SL">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-variant">X</button>
            </div>
        </div>`;
                }

                function updateRemoveButtons() {
                    const variants = document.querySelectorAll('.variant-item');
                    variants.forEach(variant => {
                        const btn = variant.querySelector('.remove-variant');
                        btn.style.display = (variants.length === 1) ? 'none' : 'inline-block';
                    });
                }

                // Thêm biến thể
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
                    }
                });

                // Khởi tạo
                updateRemoveButtons();
                /////////////////
                function updateTotalQuantity() {
                    let total = 0;
                    document.querySelectorAll('input[name$="[quantity]"]').forEach(input => {
                        total += parseInt(input.value) || 0;
                    });
                    document.getElementById('totalQuantity').textContent = total;
                }

                document.addEventListener('input', function(e) {
                    if (e.target.name.endsWith('[quantity]')) {
                        updateTotalQuantity();
                    }
                });
                //////////////
                function updateRemoveButtons() {
                    const variants = document.querySelectorAll('.variant-item');
                    variants.forEach((variant, index) => {
                        const btn = variant.querySelector('.remove-variant');
                        if (variants.length === 1) {
                            btn.style.display = 'none'; // Ẩn nút
                        } else {
                            btn.style.display = 'inline-block'; // Hiện nút
                        }
                    });
                }
            </script>

        @endsection
