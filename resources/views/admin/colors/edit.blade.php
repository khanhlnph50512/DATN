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
    <h2>Sửa màu: {{ $color->name }}</h2>

    <form action="{{ route('admin.colors.update', $color->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Tên màu:</label>
            <input type="text" name="name" class="form-control" value="{{ $color->name }}" required>
        </div>
        <div class="form-group">
            <label>Mã màu:</label>
            <input type="color" name="code" class="form-control" value="{{ $color->code }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Cập nhật</button>
        <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
