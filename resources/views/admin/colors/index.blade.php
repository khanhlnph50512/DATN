@extends('admin.layouts.adminAnatats')

@section('content')
    <div class="container-fluid px-0 mt-4">
        <div class="bg-white p-4 rounded shadow-sm">

            {{-- Hiển thị lỗi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Thông báo thành công --}}
            @if (session('success'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 2500,
                        timerProgressBar: true
                    });
                </script>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Danh sách màu</h2>
                <a href="{{ route('admin.colors.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Thêm màu
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
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
                            <tr class="text-center">
                                <td>{{ $color->id }}</td>
                                <td>{{ $color->name }}</td>
                                <td>{{ $color->code }}</td>
                                <td>
                                    <div style="width: 30px; height: 30px; border-radius: 5px; border: 1px solid #ccc; background-color: {{ $color->code }}"></div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.colors.edit', $color->id) }}" class="btn btn-sm btn-warning" title="Sửa">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.colors.destroy', $color->id) }}" method="POST" onsubmit="return confirm('Bạn muốn xóa màu này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" title="Xóa">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
