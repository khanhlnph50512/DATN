@extends('admin.layouts.adminAnatats')
@section('title', 'Quản lý đánh giá')

@section('content')
    <div class="container-fluid px-0 mt-4" style="background: white;">
        <div class="px-4 pt-3">
            <h2 class="text-dark">Danh sách đánh giá</h2>

            @if (session('success'))
                <div class="alert alert-success mt-2">{{ session('success') }}</div>
            @endif

            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>ID Sản phẩm</th>
                            <th>Người dùng</th>
                            <th>Đánh giá</th>
                            <th>Số sao</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr class="text-center">
                                <td>{{ $review->id }}</td>
                                <td>{{ $review->product_id ?? 'N/A' }}</td>
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
                                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                                @if ($review->status === 'rejected')
                                                    <option value="rejected" selected>Từ chối</option>
                                                @elseif ($review->status === 'approved')
                                                    <option value="approved" selected>Hiển thị</option>
                                                    <option value="pending">Ẩn</option>
                                                @elseif ($review->status === 'pending')
                                                    <option value="pending" selected>Ẩn</option>
                                                    <option value="approved">Hiển thị</option>
                                                    <option value="rejected">Từ chối</option>
                                                @endif
                                            </select>
                                        </form>
                                    @endif
                                </td>
                                @if (session('error'))
                                    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center py-3">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
@endsection
