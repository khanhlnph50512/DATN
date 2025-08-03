@extends('admin.layouts.adminAnatats')
@section('title', 'Quản lý bình luận')

@section('title', 'Quản lý đánh giá')

@section('content')
    <div class="container mt-4">
        <h2>Danh sách đánh giá</h2>

        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sản phẩm</th>
                    <th>Người dùng</th>
                    <th>Đánh giá</th>
                    <th>Số sao</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>{{ $review->product->name ?? 'N/A' }}</td>
                        <td>{{ $review->user->name ?? 'Khách' }}</td>
                        <td>{{ $review->review }}</td>
                        <td>{{ $review->rating }} ⭐</td>
                        <td>
                            @if ($review->status === 'rejected')
                                <span class="badge bg-danger">Từ chối</span>
                            @else
                                <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <select name="status" onchange="this.form.submit()" class="form-select">
                                        <option value="pending" {{ $review->status == 'pending' ? 'selected' : '' }}>Ẩn
                                            </option>
                                        <option value="approved" {{ $review->status == 'approved' ? 'selected' : '' }}>Hiển
                                            thị</option>
                                        <option value="rejected">Từ chối</option>
                                    </select>
                                </form>
                            @endif
                        </td>
                        @if (session('error'))
                            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                        @endif

                        <td>
                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST"
                                onsubmit="return confirm('Xóa đánh giá này?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $reviews->links() }}
    </div>
@endsection
