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
                didClose: () => {
                    window.location.href = "{{ route('admin.colors.index') }}";
                }
            });
        </script>
    @endif
    <h2>Thêm màu mới</h2>

    <form action="{{ route('admin.colors.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Tên màu:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Mã màu (hex):</label>
            <input type="color" name="code" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Lưu màu</button>
        <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
