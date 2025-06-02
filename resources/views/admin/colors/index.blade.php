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
                timer: 2500,
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
        <input type="text" name="keyword" placeholder="Tìm theo tên màu..." value="{{ request('keyword') }}"
            style="padding: 6px; width: 250px;">
        <button type="submit" style="padding: 6px 12px;">Tìm kiếm</button>
        <a href="{{ route('admin.colors.index') }}" style="margin-left: 10px;">Xóa tìm kiếm</a>
    </form>
    <div class="px-4 pb-3 d-flex justify-content-end">
        <a href="{{ route('admin.colors.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i> Add Color
        </a>
    </div>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên màu</th>
                <th>Mã màu</th>
                <th>Xem màu</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colors as $color)
                <tr>
                    <td>{{ $color->id }}</td>
                    <td>{{ $color->name }}</td>
                    <td>{{ $color->code }}</td>
                    <td>
                        <div style="width: 30px; height: 30px; background-color: {{ $color->code }}"></div>
                    </td>
                    <td>
                        <a href="{{ route('admin.colors.edit', $color->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.colors.destroy', $color->id) }}" method="POST"
                            style="display:inline-block">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Bạn muốn xóa màu này?')"
                                class="btn btn-sm btn-danger">Xoá</button>
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
