@extends('admin.layouts.master')
@section('content')
    @if (session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <h1>Danh sách sản phẩm</h1>
    <a href="{{ route('admin.products.trash') }}" class="btn btn-warning mb-3">
        Thùng rác
    </a>
    <!-- Form tìm kiếm -->
    <form action="{{ route('admin.products.index') }}" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="keyword" placeholder="Tìm theo tên sản phẩm..." value="{{ request('keyword') }}"
            style="padding: 6px; width: 250px;">
        <button type="submit" style="padding: 6px 12px;">Tìm kiếm</button>
        <a href="{{ route('admin.products.index') }}" style="margin-left: 10px;">Xóa tìm kiếm</a>
    </form>
    <div class="px-4 pb-3 d-flex justify-content-end">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Add Product
        </a>
    </div>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #f0f0f0;">
            <tr>
                <th style="width: 50px;">ID</th>
                <th style="width: 100px;">Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Thương hiệu</th>
                <th style="width: 120px;">Giá</th>
                <th style="width: 120px;">Giá khuyến mãi</th>
                <th style="width: 100px;">Trạng thái</th>
                <th style="width: 180px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $p)
                <tr>
                    <td style="text-align: center;">{{ $p->id }}</td>
                    <td>
                        @if ($p->primaryImage)
                            <img src="{{ asset('storage/' . $p->primaryImage->image_url) }}" alt="{{ $p->name }}"
                                width="80">
                        @else
                            <span>Chưa có ảnh</span>
                        @endif
                    </td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->brand->name ?? 'Chưa cập nhật' }}</td>
                    <td style="text-align: right;">{{ number_format($p->price, 0, ',', '.') }} đ</td>
                    <td style="text-align: right;">
                        @if ($p->price_sale && $p->price_sale < $p->price)
                            {{ number_format($p->price_sale, 0, ',', '.') }} đ
                        @else
                            -
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if ($p->status)
                            <span style="color: green; font-weight: bold;">Kích hoạt</span>
                        @else
                            <span style="color: red;">Ẩn</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <a href="{{ route('admin.products.show', $p->id) }}" style="margin-right: 8px;">Xem</a>
                        <a href="{{ route('admin.products.edit', $p->id) }}" style="margin-right: 8px;">Sửa</a>
                        <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');"
                                style="background: none; border: none; color: red; cursor: pointer;">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: gray;">Không có sản phẩm nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Phân trang -->
    <div style="margin-top: 20px;">
        {{ $products->appends(request()->all())->links() }}
    </div>
@endsection
