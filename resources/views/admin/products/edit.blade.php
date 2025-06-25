@extends('admin.layouts.adminAnatats')

@section('content')
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                didClose: () => {
                    window.location.href = "{{ route('admin.categories.index') }}";
                }
            });
        </script>
    @endif
    <h1>Chỉnh sửa sản phẩm</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <style>
        form label {
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="number"],
        form textarea,
        form select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button[type="submit"]:hover {
            background-color: #218838;
        }

        table {
            margin-top: 10px;
            border-collapse: collapse;
        }

        th {
            background-color: #f2f2f2;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px 10px;
        }

        #preview-images img {
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Tên sản phẩm:</label><br>
        <input type="text" name="name" value="{{ old('name', $product->name) }}"><br><br>

        <label>Thương hiệu:</label><br>
        <select name="brand_id">
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}"
                    {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Danh mục:</label><br>
        <select name="category_id">
            <option value="">-- Chọn danh mục --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Mô tả:</label><br>
        <textarea name="description">{{ old('description', $product->description) }}</textarea><br><br>

        <label>Giá:</label><br>
        <input type="number" name="price" value="{{ old('price', $product->price) }}"><br><br>

        <label>Giá khuyến mãi:</label><br>
        <input type="number" name="price_sale" value="{{ old('price_sale', $product->price_sale) }}"><br><br>

        <label>Số lượng tổng:</label><br>
        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}"><br><br>

        <label>Trạng thái:</label><br>
        <select name="status">
            <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Kích hoạt</option>
            <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Ẩn</option>
        </select><br><br>

        <label>Hình ảnh hiện tại:</label><br>
        <div id="current-images" style="margin-bottom:10px;">
            @foreach ($productImages as $image)
                <div style="display:inline-block; position: relative; margin-right:10px; width:120px; text-align:center;">
                    <img src="{{ asset('asset/img/' . $image->image_url) }}" alt="Ảnh sản phẩm"
                        style="width:100px; height:100px; object-fit:cover; border: {{ $image->is_primary ? '3px solid green' : '1px solid #ccc' }};">

                    {{-- Chọn ảnh chính --}}
                    <label style="display:block; margin-top:4px;">
                        <input type="radio" name="primary_image_id" value="{{ $image->id }}"
                            {{ old('primary_image_id', $productImages->where('is_primary', 1)->first()->id ?? '') == $image->id ? 'checked' : '' }}>
                        Ảnh chính
                    </label>

                    {{-- Nút xoá ảnh --}}
                    <label style="display:block; margin-top:4px; color:red;">
                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"> Xoá ảnh
                    </label>

                    {{-- Upload thay ảnh hiện tại --}}
                    <label style="display:block; margin-top:4px;">
                        <input type="file" name="replace_images[{{ $image->id }}]">
                        Thay ảnh
                    </label>
                </div>
            @endforeach
        </div>


        <label>Thêm ảnh mới (chọn nhiều):</label><br>
        <input type="file" name="images[]" multiple accept="image/*"><br><br>

        <hr>

        <label><strong>Chọn Size:</strong></label><br>
        @foreach ($sizes as $size)
            <label style="margin-right: 15px; cursor:pointer;">
                <input type="checkbox" name="sizes[]" value="{{ $size->id }}"
                    {{ (is_array(old('sizes')) && in_array($size->id, old('sizes'))) ||
                    (!old('sizes') && $productVariants->pluck('size_id')->contains($size->id))
                        ? 'checked'
                        : '' }}>
                {{ $size->name }}
            </label>
        @endforeach
        <br><br>

        <label><strong>Chọn Màu:</strong></label><br>
        @foreach ($colors as $color)
            <label style="margin-right: 15px; cursor:pointer; display:inline-flex; align-items:center;">
                <input type="checkbox" name="colors[]" value="{{ $color->id }}"
                    {{ (is_array(old('colors')) && in_array($color->id, old('colors'))) ||
                    (!old('colors') && $productVariants->pluck('color_id')->contains($color->id))
                        ? 'checked'
                        : '' }}>
                <span
                    style="display:inline-block; width:15px; height:15px; background-color: {{ $color->code ?? '#000' }}; border: 1px solid #ccc; margin-left:5px; margin-right:5px;"></span>
                {{ $color->name }}
            </label>
        @endforeach
        <br><br>

        <label><strong>Số lượng từng biến thể (Size + Màu):</strong></label><br>
        <div id="variations-quantity-container"></div>

        <br>
        <button type="submit">Cập nhật sản phẩm</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>

    <script>
        const sizesCheckboxes = document.querySelectorAll('input[name="sizes[]"]');
        const colorsCheckboxes = document.querySelectorAll('input[name="colors[]"]');
        const container = document.getElementById('variations-quantity-container');

        // Dữ liệu biến thể từ server (productVariants)
        const productVariants = @json($productVariants->map(fn($v) => ['size_id' => $v->size_id, 'color_id' => $v->color_id, 'quantity' => $v->quantity]));

        function createQuantityInputs() {
            container.innerHTML = '';

            const selectedSizes = Array.from(sizesCheckboxes).filter(cb => cb.checked).map(cb => ({
                id: parseInt(cb.value),
                name: cb.parentElement.textContent.trim()
            }));

            const selectedColors = Array.from(colorsCheckboxes).filter(cb => cb.checked).map(cb => {
                const label = cb.parentElement;
                const colorBox = label.querySelector('span');
                return {
                    id: parseInt(cb.value),
                    name: label.textContent.trim(),
                    colorCode: colorBox.style.backgroundColor
                };
            });

            if (selectedSizes.length === 0 || selectedColors.length === 0) {
                container.innerHTML =
                    '<p style="color:#888;">Vui lòng chọn ít nhất 1 Size và 1 Màu để nhập số lượng biến thể.</p>';
                return;
            }

            const table = document.createElement('table');
            table.style.borderCollapse = 'collapse';
            table.style.width = '100%';

            const thead = document.createElement('thead');
            const trHead = document.createElement('tr');
            ['Size', 'Màu', 'Số lượng'].forEach(text => {
                const th = document.createElement('th');
                th.textContent = text;
                th.style.border = '1px solid #ccc';
                th.style.padding = '8px';
                trHead.appendChild(th);
            });
            thead.appendChild(trHead);
            table.appendChild(thead);

            const tbody = document.createElement('tbody');

            selectedSizes.forEach((size) => {
                selectedColors.forEach((color) => {
                    const tr = document.createElement('tr');

                    const tdSize = document.createElement('td');
                    tdSize.textContent = size.name;
                    tdSize.style.border = '1px solid #ccc';
                    tdSize.style.padding = '6px 10px';
                    tr.appendChild(tdSize);

                    const tdColor = document.createElement('td');
                    tdColor.style.border = '1px solid #ccc';
                    tdColor.style.padding = '6px 10px';

                    const colorBox = document.createElement('span');
                    colorBox.style.display = 'inline-block';
                    colorBox.style.width = '15px';
                    colorBox.style.height = '15px';
                    colorBox.style.backgroundColor = color.colorCode;
                    colorBox.style.border = '1px solid #ccc';
                    colorBox.style.marginRight = '6px';
                    colorBox.style.verticalAlign = 'middle';

                    tdColor.appendChild(colorBox);
                    tdColor.appendChild(document.createTextNode(color.name.trim()));
                    tr.appendChild(tdColor);

                    const tdQuantity = document.createElement('td');
                    tdQuantity.style.border = '1px solid #ccc';
                    tdQuantity.style.padding = '6px 10px';

                    const quantityInput = document.createElement('input');
                    quantityInput.type = 'number';
                    quantityInput.name = `variations[${size.id}_${color.id}][quantity]`;
                    quantityInput.min = 0;
                    quantityInput.style.width = '70px';

                    // Tìm quantity hiện có từ productVariants
                    const variant = productVariants.find(v => v.size_id === size.id && v.color_id === color
                        .id);
                    quantityInput.value = variant ? variant.quantity : 0;

                    const sizeInput = document.createElement('input');
                    sizeInput.type = 'hidden';
                    sizeInput.name = `variations[${size.id}_${color.id}][size_id]`;
                    sizeInput.value = size.id;

                    const colorInput = document.createElement('input');
                    colorInput.type = 'hidden';
                    colorInput.name = `variations[${size.id}_${color.id}][color_id]`;
                    colorInput.value = color.id;

                    tdQuantity.appendChild(quantityInput);
                    tdQuantity.appendChild(sizeInput);
                    tdQuantity.appendChild(colorInput);

                    tr.appendChild(tdQuantity);

                    tbody.appendChild(tr);
                });
            });

            table.appendChild(tbody);
            container.appendChild(table);
        }

        sizesCheckboxes.forEach(cb => cb.addEventListener('change', createQuantityInputs));
        colorsCheckboxes.forEach(cb => cb.addEventListener('change', createQuantityInputs));

        window.addEventListener('load', createQuantityInputs);
    </script>

@endsection
