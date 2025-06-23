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
                    window.location.href = "{{ route('admin.coupons.index') }}";
                }
            });
        </script>
    @endif
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">
                📋 Mã giảm giá <small class="text-muted fs-6">({{ $coupons->total() }} mã)</small>
            </h2>
            <div>
                <a href="{{ route('admin.coupons.trash') }}" class="btn btn-outline-secondary me-2">
                    🗑️ Thùng rác
                </a>
                <a href="{{ route('admin.coupons.create') }}" class="btn btn-success">
                    ➕ Add Coupon
                </a>
            </div>
        </div>

        <div class="table-responsive shadow-sm rounded bg-white p-3">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Giảm</th>
                        <th scope="col">Hợp lệp</th>
                        <th scope="col">Hiệu lực</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col" width="140px">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($coupons as $coupon)
                        <tr>
                            <td class="text-center">{{ $coupon->id }}</td>
                            <td class="fw-bold text-primary">{{ $coupon->code }}</td>
                            <td>{{ $coupon->description ?? '---' }}</td>
                            <td class="text-center">
                                @if ($coupon->discount_amount)
                                    <span
                                        class="badge bg-info text-dark">{{ number_format($coupon->discount_amount) }}VNĐ</span>
                                @elseif($coupon->discount_percent)
                                    <span class="badge bg-warning text-dark">{{ $coupon->discount_percent }}%</span>
                                @else
                                    <span class="text-muted">Không có</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($coupon->minimum_order_amount)
                                    <span class="badge bg-info text-dark">{{ $coupon->minimum_order_amount }} VNĐ</span>
                                @else
                                    <span class="text-muted">Không có</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <small class="text-success">{{ $coupon->valid_from }}</small> <br>
                                <small class="text-danger">{{ $coupon->valid_until }}</small>
                            </td>
                            <td class="text-center">
                                @if ($coupon->active)
                                    <span class="badge bg-success">✔ Hoạt động</span>
                                @else
                                    <span class="badge bg-secondary">Tắt</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.coupons.show', $coupon->id) }}" class="btn btn-sm btn-info"
                                    title="Xem">
                                    <i class="bx bx-show"></i> <!-- icon xem của Boxicons -->
                                </a>
                                <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-warning"
                                    title="Sửa">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST"
                                    style="display: inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Chưa có mã giảm giá nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $coupons->links() }}
        </div>
    </div>
@endsection
