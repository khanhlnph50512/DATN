@extends('admin.layouts.adminAnatats')

@section('title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Thông tin đơn hàng #{{ $order->id }}</h4>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Email khách hàng:</strong> {{ $order->email }}</p>
                    <p><strong>Trạng thái:</strong>
                        <span class="badge
                            @if($order->status === 'pending') bg-warning
                            @elseif($order->status === 'processing') bg-info
                            @elseif($order->status === 'completed') bg-success
                            @elseif($order->status === 'canceled') bg-danger
                            @else bg-secondary
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Tổng tiền:</strong> <span class="text-danger fw-bold">{{ number_format($order->total_price, 0, ',', '.') }}đ</span></p>
                </div>
            </div>

            <h5 class="mt-4 mb-3">Danh sách sản phẩm</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->product->name ?? 'Sản phẩm đã bị xóa' }}</td>
                            <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary mt-4">
                <i class="bi bi-arrow-left"></i> Quay lại danh sách đơn hàng
            </a>
        </div>
    </div>
</div>
@endsection
