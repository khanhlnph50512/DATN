@extends('admin.layouts.adminAnatats')
@section('title', 'Quản lý bình luận')

@section('content')
    <div class="container mt-4">
        <h3>Quản lý bình luận</h3>

        @foreach ($comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $comment->user->name ?? 'Ẩn danh' }} -
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </h5>
                    <p>{{ $comment->content }}</p>
                    <p><strong>Sản phẩm:</strong> {{ $comment->product->name ?? 'Đã xóa' }}</p>
                    <p><strong>Trạng thái:</strong>
                        <span class="badge bg-{{ $comment->status == 'approved' ? 'success' : ($comment->status == 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($comment->status) }}
                        </span>
                    </p>

                    @if($comment->status == 'pending')
                        <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            <button class="btn btn-success btn-sm">Duyệt</button>
                        </form>
                        <form action="{{ route('admin.comments.reject', $comment->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            <button class="btn btn-warning btn-sm">Từ chối</button>
                        </form>
                    @endif

                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </div>
            </div>
        @endforeach

        {{ $comments->links() }}
    </div>
@endsection
