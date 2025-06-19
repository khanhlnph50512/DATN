@extends('layouts.adminAnatats')

@section('content')
    <div class="container py-4">
        <h2 class="fw-bold mb-4 text-primary"><i class="fas fa-edit me-2"></i>Sửa bài viết</h2>

        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data"
            class="shadow-sm p-4 rounded bg-light">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Tóm tắt</label>
                <textarea name="summary" class="form-control" rows="3" required>{{ old('summary', $blog->summary) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nội dung</label>
                <textarea name="content" class="form-control" rows="6" required>{{ old('content', $blog->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Ảnh hiện tại</label><br>
                @if ($blog->image)
                    <img src="{{ asset('img/blogs/' . $blog->image) }}" alt="Ảnh cũ" class="img-thumbnail mb-2"
                        width="150">
                @else
                    <p class="text-muted fst-italic">Không có ảnh</p>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Ảnh mới (nếu thay)</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="status" value="1" class="form-check-input" id="status"
                    {{ $blog->status ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Hiển thị bài viết</label>
            </div>

            <button type="submit" class="btn btn-success rounded-pill px-4">
                <i class="fas fa-save me-1"></i>Cập nhật
            </button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary rounded-pill px-4 ms-2">
                <i class="fas fa-arrow-left me-1"></i>Quay lại
            </a>
        </form>
    </div>
@endsection
