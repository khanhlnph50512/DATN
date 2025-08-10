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
                <h2 class="mb-0" style="color:black">Danh sách size </h2>
                <a href="{{ route('admin.sizes.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Thêm size
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tên size</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sizes as $size)
                            <tr class="text-center">
                                <td>{{ $size->id }}</td>
                                <td>{{ $size->name }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.sizes.edit', $size->id) }}"
                                            class="btn btn-sm btn-warning" title="Sửa">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.sizes.destroy', $size->id) }}" method="POST"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xoá?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Xoá">
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
