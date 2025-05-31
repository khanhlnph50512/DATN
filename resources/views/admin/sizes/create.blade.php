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
                    window.location.href = "{{ route('admin.sizes.index') }}";
                }
            });
        </script>
    @endif
    <h1>Thêm Size</h1>

    <form action="{{ route('admin.sizes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên size</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Lưu</button>
    </form>
@endsection
