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
            <h2 class="fw-bold">🗑️ Thùng rác mã giảm giá</h2>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary">
                ⬅ Quay lại danh sách
            </a>
        </div>

        @if ($coupons->count())
            <table class="table table-bordered shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Mã</th>
                        <th>Ngày xoá</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                        <tr>
                            <td class="fw-bold">{{ $coupon->code }}</td>
                            <td>{{ $coupon->deleted_at->format('d/m/Y H:i') }}</td>
                            <td>
                                {{-- Xác nhận khôi phục --}}
                                <form action="{{ route('admin.coupons.restore', $coupon->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Bạn có chắc muốn khôi phục mã này?')">
                                    @csrf
                                    <button class="btn btn-success btn-sm">♻️ Khôi phục</button>
                                </form>

                                {{-- Xác nhận xoá vĩnh viễn --}}
                                <form action="{{ route('admin.coupons.forceDelete', $coupon->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('⚠️ Xoá vĩnh viễn! Bạn chắc chắn không?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">❌ Xoá vĩnh viễn</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="fw-bold">Không có mã giảm giá nào trong thùng rác.</p>
        @endif
    </div>
@endsection
