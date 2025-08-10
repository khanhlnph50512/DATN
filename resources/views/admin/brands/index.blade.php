@extends('admin.layouts.adminAnatats')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        </script>
    @endif

    <div class="container-fluid px-0 py-4" style="background: white;">
        <div class="px-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark">Danh sách thương hiệu</h2>
                <a href="{{ route('admin.brands.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bx bx-plus me-1"></i> Thêm thương hiệu
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle shadow-sm rounded bg-white">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th style="min-width: 250px;">Tên thương hiệu</th>
                            <th style="min-width: 250px;">Mã thương hiệu (Slug)</th>
                            <th style="width: 180px;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td class="text-start ps-3">{{ $brand->name }}</td>
                                <td>{{ $brand->slug }}</td>
                                <td>
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-warning btn-sm me-1" title="Sửa">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Xóa thương hiệu này?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm" title="Xóa">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Không có thương hiệu nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $brands->links() }}
            </div>
        </div>
    </div>
@endsection
