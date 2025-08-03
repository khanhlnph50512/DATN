@extends('admin.layouts.adminAnatats')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách sản phẩm</h1>
        <a href="{{ route('admin.products.trash') }}" class="btn btn-warning mb-3">
            🗑️ Xem sản phẩm đã xóa
        </a>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2500
                });
            </script>
        @endif
        @if ($errors->any())
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: '{{ $errors->first() }}',
                    showConfirmButton: true
                });
            </script>
        @endif
        {{-- Bảng danh sách --}}
        <div class="card mb-4 mt-3">
            <div class="card-header">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Thêm sản phẩm</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Giá</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $index => $product)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($product->primaryImage)
                                        <img src="{{ asset('storage/' . $product->primaryImage->image_url) }}"
                                            width="60" height="60" alt="Ảnh chính">
                                    @else
                                        <span class="text-muted">Không có ảnh</span>
                                    @endif
                                </td>
                                <td class="text-start">{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '---' }}</td>
                                <td>{{ $product->brand->name ?? '---' }}</td>
                                <td>
                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                </td>
                                <td>
                                    @if ($product->status)
                                        <span class="badge bg-success">Hiển thị</span>
                                    @else
                                        <span class="badge bg-secondary">Ẩn</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                        <a href="{{ route('admin.products.show', $product->id) }}"
                                            class="btn btn-sm btn-info">
                                            Chi tiết
                                        </a>

                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-sm btn-warning">
                                            Sửa
                                        </a>

                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Bạn có chắc muốn xoá?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Xoá</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Không có sản phẩm nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Phân trang --}}
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
