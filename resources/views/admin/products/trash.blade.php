@extends('admin.layouts.adminAnatats')

@section('content')
    <h1>Danh sách sản phẩm đã xóa</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Thương hiệu</th>
                <th>Hình ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>{{ $product->brand->name ?? 'N/A' }}</td>
                    <td>
                        @if ($product->primaryImage)
                            <img src="{{ asset('storage/' . $product->primaryImage->image_url) }}" width="60">
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.products.restore', $product->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            <button class="btn btn-success btn-sm">Khôi phục</button>
                        </form>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc muốn xoá?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
@endsection
