@extends('layoutsAnatats.admin')

@section('content')
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                customClass: {
                    popup: 'swal2-red-bg'
                }
            });
        </script>
    @endif

    <h1>Danh sách màu</h1>
    <a href="" class="btn btn-warning mb-3">
        Thùng rác
    </a>
    <form action="" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="keyword" placeholder="Tìm theo tên thương hiệu..." value="{{ request('keyword') }}"
            style="padding: 6px; width: 250px;">
        <button type="submit" style="padding: 6px 12px;">Tìm kiếm</button>
        <a href="{{ route('admin.brands.index') }}" style="margin-left: 10px;">Xóa tìm kiếm</a>
    </form>
    <div class="px-4 pb-3 d-flex justify-content-end">
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>+ Add Brand
        </a>
    </div>
    <div class="container mt-4">
        <table class="table table-bordered"; style="text-align: center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên thương hiệu</th>
                    <th>Mã thương hiệu</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->slug }}</td>
                        <td>
                            <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Xóa thương hiệu này?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $brands->links() }}
    </div>
@endsection
