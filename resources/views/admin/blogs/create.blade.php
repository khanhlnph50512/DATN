@extends('admin.layouts.adminAnatats')

@section('content')
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
    <div class="container py-4">
        <h2 class="fw-bold">📝 Thêm bài viết</h2>

        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tóm tắt</label>
                <textarea name="summary" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <textarea name="content" class="form-control" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="status" value="1" checked>
                <label class="form-check-label">Hiển thị</label>
            </div>

            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection
