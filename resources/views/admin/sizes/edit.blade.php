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
                didClose: () => {
                    window.location.href = "{{ route('admin.sizes.index') }}";
                }
            });
        </script>
    @endif
    <h1>Cập nhật Size</h1>

    <form action="{{ route('admin.sizes.update', $size->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label for="name">Tên size</label>
            <input type="text" name="name" class="form-control" value="{{ $size->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Cập nhật</button>
    </form>
@endsection
