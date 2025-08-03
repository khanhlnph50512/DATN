@extends('admin.layouts.adminAnatats')

@section('title', 'Danh sách đơn hàng')

@section('content')
    <div class="container-fluid px-0 mt-4">
        <div class="px-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Danh sách đơn hàng</h2>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Trạng thái thanh toán</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $statuses = [
                            'pending' => 'Chờ xác nhận',
                            'processing' => 'Xác nhận',
                            'shipping' => 'Đang giao hàng',
                            'delivered' => 'Đã giao',
                            'cancelled' => 'Hủy',
                        ];

                        $nextStatusOptions = [
                            'pending' => ['processing', 'cancelled'],
                            'processing' => ['shipping', 'cancelled'],
                            'shipping' => ['delivered'],
                            'delivered' => [],
                            'cancelled' => [],
                        ];
                    @endphp

                    @foreach ($orders as $order)
                        <tr class="text-center">
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                            <td>
                                @if (count($nextStatusOptions[$order->status]) > 0)
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()"
                                            class="form-select form-select-sm">
                                            <option value="{{ $order->status }}" selected disabled>
                                                {{ $statuses[$order->status] }}
                                            </option>
                                            @foreach ($nextStatusOptions[$order->status] as $next)
                                                <option value="{{ $next }}">
                                                    {{ $statuses[$next] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                @else
                                    <span class="badge bg-secondary">{{ $statuses[$order->status] }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($order->payment_status === 'paid')
                                    <span class="badge bg-success">Đã thanh toán</span>
                                @else
                                    <span class="badge bg-warning text-dark">Chưa thanh toán</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Xem
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center py-3">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
