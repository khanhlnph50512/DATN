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
                    window.location.href = "{{ route('admin.products.index') }}";
                }
            });
        </script>
    @endif
    @if (session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <h1>Thêm sản phẩm</h1>

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

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Các phần thông tin sản phẩm -->
        <label>Tên sản phẩm:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Thương hiệu:</label><br>
        <select name="brand_id">
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}</option>
            @endforeach
        </select><br><br>

        <label>Danh mục:</label><br>
        <select name="category_id">
            <option value="">-- Chọn danh mục --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Mô tả:</label><br>
        <textarea name="description">{{ old('description') }}</textarea><br><br>

        <label>Giá:</label><br>
        <input type="number" name="price" value="{{ old('price') }}"><br><br>

        <label>Giá khuyến mãi:</label><br>
        <input type="number" name="price_sale" value="{{ old('price_sale') }}"><br><br>

        <label>Số lượng tổng:</label><br>
        <input type="number" name="quantity" value="{{ old('quantity') }}"><br><br>

        <label>Trạng thái:</label><br>
        <select name="status">
            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Kích hoạt</option>
            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Ẩn</option>
        </select><br><br>

        <label>Hình ảnh (chọn nhiều ảnh):</label><br>
        <input type="file" id="images" name="images[]" multiple accept="image/*"><br><br>

        <div id="preview-images" style="margin-bottom: 10px;"></div>

        <label>Chọn ảnh chính:</label><br>
        <div id="primary-image-options" style="margin-bottom: 20px;">
            <input type="radio" name="primary_image" value="0"> Ảnh 1
            <input type="radio" name="primary_image" value="1"> Ảnh 2
        </div>


        <hr>

        <!-- Phần chọn biến thể riêng biệt -->
        <label><strong>Chọn Size:</strong></label><br>
        @foreach ($sizes as $size)
            <label style="margin-right: 15px; cursor:pointer;">
                <input type="checkbox" name="sizes[]" value="{{ $size->id }}"
                    {{ is_array(old('sizes')) && in_array($size->id, old('sizes')) ? 'checked' : '' }}>
                {{ $size->name }}
            </label>
        @endforeach
        <br><br>

        <label><strong>Chọn Màu:</strong></label><br>
        @foreach ($colors as $color)
            <label style="margin-right: 15px; cursor:pointer; display:inline-flex; align-items:center;">
                <input type="checkbox" name="colors[]" value="{{ $color->id }}"
                    {{ is_array(old('colors')) && in_array($color->id, old('colors')) ? 'checked' : '' }}>
                <span
                    style="display:inline-block; width:15px; height:15px; background-color: {{ $color->code ?? '#000' }}; border: 1px solid #ccc; margin-left:5px; margin-right:5px;"></span>
                {{ $color->name }}
            </label>
        @endforeach
        <br><br>

        <label><strong>Nhập số lượng cho từng biến thể (Size + Màu):</strong></label><br>
        <div id="variations-quantity-container">
            <!-- JS sẽ tạo bảng số lượng biến thể ở đây -->
        </div>

        <br>
        <button type="submit">Thêm sản phẩm</button>
    </form>

    <script>
        const sizesCheckboxes = document.querySelectorAll('input[name="sizes[]"]');
        const colorsCheckboxes = document.querySelectorAll('input[name="colors[]"]');
        const container = document.getElementById('variations-quantity-container');

        function createQuantityInputs() {
            container.innerHTML = '';

            // Lấy mảng size đã chọn
            const selectedSizes = Array.from(sizesCheckboxes).filter(cb => cb.checked).map(cb => ({
                id: cb.value,
                name: cb.parentElement.textContent.trim()
            }));

            // Lấy mảng color đã chọn
            const selectedColors = Array.from(colorsCheckboxes).filter(cb => cb.checked).map(cb => {
                const label = cb.parentElement;
                const colorBox = label.querySelector('span');
                return {
                    id: cb.value,
                    name: label.textContent.trim(),
                    colorCode: colorBox.style.backgroundColor
                };
            });

            if (selectedSizes.length === 0 || selectedColors.length === 0) {
                container.innerHTML =
                    '<p style="color:#888;">Vui lòng chọn ít nhất 1 Size và 1 Màu để nhập số lượng biến thể.</p>';
                return;
            }

            // Tạo bảng nhập số lượng biến thể
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

            selectedSizes.forEach((size, sizeIndex) => {
                selectedColors.forEach((color, colorIndex) => {
                    const tr = document.createElement('tr');

                    // Size
                    const tdSize = document.createElement('td');
                    tdSize.textContent = size.name;
                    tdSize.style.border = '1px solid #ccc';
                    tdSize.style.padding = '6px 10px';
                    tr.appendChild(tdSize);

                    // Color + ô màu
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

                    // Quantity input + hidden size_id + hidden color_id
                    const tdQuantity = document.createElement('td');
                    tdQuantity.style.border = '1px solid #ccc';
                    tdQuantity.style.padding = '6px 10px';

                    // input quantity
                    const quantityInput = document.createElement('input');
                    quantityInput.type = 'number';
                    quantityInput.name = `variations[${size.id}_${color.id}][quantity]`;
                    quantityInput.value = 0;
                    quantityInput.min = 0;
                    quantityInput.style.width = '70px';

                    // hidden size_id
                    const sizeInput = document.createElement('input');
                    sizeInput.type = 'hidden';
                    sizeInput.name = `variations[${size.id}_${color.id}][size_id]`;
                    sizeInput.value = size.id;

                    // hidden color_id
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

        // Gán sự kiện cho checkbox size & color
        sizesCheckboxes.forEach(cb => cb.addEventListener('change', createQuantityInputs));
        colorsCheckboxes.forEach(cb => cb.addEventListener('change', createQuantityInputs));

        // Khởi tạo lúc load trang (ví dụ nếu có old input)
        window.addEventListener('load', () => {
            createQuantityInputs();

            // Nếu bạn muốn khôi phục giá trị số lượng từ old input thì có thể viết thêm đoạn JS lấy data cũ rồi gán lại giá trị
            // Phần này tùy bạn cần thì mình hỗ trợ thêm nhé
        });

        // Phần preview ảnh giữ nguyên code của bạn, không đổi
        const imagesInput = document.getElementById('images');
        const preview = document.getElementById('preview-images');
        const primaryOptions = document.getElementById('primary-image-options');

        function renderPrimaryOptions() {
            primaryOptions.innerHTML = '';

            const files = imagesInput.files;

            if (files.length === 0) {
                primaryOptions.innerHTML = '<p>Chưa có ảnh nào được chọn</p>';
                return;
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Tạo radio chọn ảnh chính
                const label = document.createElement('label');
                label.style.marginRight = '10px';

                const radio = document.createElement('input');
                radio.type = 'radio';
                radio.name = 'primary_image_index';
                radio.value = i;
                if (i === 0) radio.checked = true;

                label.appendChild(radio);
                label.appendChild(document.createTextNode(' Ảnh thứ ' + (i + 1)));

                primaryOptions.appendChild(label);
            }
        }

        function previewFiles() {
            preview.innerHTML = '';

            const files = imagesInput.files;
            if (files.length === 0) {
                preview.innerHTML = '<p>Chưa có ảnh nào được chọn</p>';
                primaryOptions.innerHTML = '';
                return;
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    img.style.marginRight = '10px';
                    img.style.marginBottom = '10px';

                    preview.appendChild(img);
                };

                reader.readAsDataURL(file);
            }

            renderPrimaryOptions();
        }

        imagesInput.addEventListener('change', previewFiles);
    </script>
@endsection
