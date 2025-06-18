@extends('layouts.adminAnatats')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h2 class="card-title fw-bold text-primary">
                <i class="fas fa-book-open me-2"></i>{{ $blog->title }}
            </h2>
            <p class="text-muted small mb-3">
                <i class="fas fa-calendar-alt me-1"></i>Ngày đăng: {{ $blog->created_at->format('d/m/Y H:i') }} | 
                <i class="fas fa-eye me-1"></i>Trạng thái: 
                <span class="badge {{ $blog->status ? 'bg-success' : 'bg-secondary' }}">
                    {{ $blog->status ? 'Hiển thị' : 'Ẩn' }}
                </span>
            </p>

            @if ($blog->image)
                <img src="{{ asset('img/blogs/' . $blog->image) }}" class="img-fluid rounded mb-4" alt="Ảnh bài viết">
            @endif

            <h5 class="fw-semibold">Tóm tắt</h5>
            <p>{{ $blog->summary }}</p>

            <h5 class="fw-semibold">Nội dung</h5>
            <div>{!! nl2br(e($blog->content)) !!}</div>

            <div class="mt-4">
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary rounded-pill">
                    <i class="fas fa-arrow-left me-1"></i>Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
