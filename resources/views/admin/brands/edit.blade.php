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
                timer: 2000,
                timerProgressBar: true,
                didClose: () => {
                    window.location.href = "{{ route('admin.brands.index') }}";
                }
            });
        </script>
    @endif
    <div class="container mt-4">
        <h2>Cập nhật thương hiệu</h2>
        <form action="{{ route('admin.brands.update', $brand) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label for="name">Tên thương hiệu</label>
                <input type="text" name="name" value="{{ $brand->name }}" class="form-control" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
