@extends('layouts.adminAnatats')
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
                customClass: {
                    popup: 'swal2-red-bg'
                }
            });
        </script>
    @endif

    <h1>Danh sách size giày</h1>
    <a href="" class="btn btn-warning mb-3">
        Thùng rác
    </a>
    <form action="" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="keyword" placeholder="Tìm theo size..." value="{{ request('keyword') }}"
            style="padding: 6px; width: 250px;">
        <button type="submit" style="padding: 6px 12px;">Tìm kiếm</button>
        <a href="{{ route('admin.sizes.index') }}" style="margin-left: 10px;">Xóa tìm kiếm</a>
    </form>
    <div class="px-4 pb-3 d-flex justify-content-end">
        <a href="{{ route('admin.sizes.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Add Size
        </a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Size</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sizes as $size)
                <tr>
                    <td>{{ $size->id }}</td>
                    <td>{{ $size->name }}</td>
                    <td>
                        <a href="{{ route('admin.sizes.edit', $size->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('admin.sizes.destroy', $size->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Xoá?')" class="btn btn-danger">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    {{-- <div style="margin-top: 20px;">
        {{ $products->appends(request()->all())->links() }}
    </div> --}}
@endsection
