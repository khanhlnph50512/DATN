@extends('admin.layouts.adminAnatats')



@section('content')
<div class="container">
    <h1>Danh sách sản phẩm đã xóa (Thùng rác)</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mb-3">Quay lại danh sách sản phẩm</a>

    @if($products->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Thương hiệu</th>
                <th>Ngày xóa</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->brand->name ?? 'N/A' }}</td>
                <td>{{ $product->deleted_at->format('d/m/Y H:i') }}</td>
                <td>
                    <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit" onclick="return confirm('Bạn có chắc muốn khôi phục sản phẩm này?')">Khôi phục</button>
                    </form>

                    <form action="{{ route('admin.products.forceDelete', $product->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn sản phẩm này?')">Xóa vĩnh viễn</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}

    @else
        <p>Không có sản phẩm nào trong thùng rác.</p>
    @endif
</div>
@endsection
