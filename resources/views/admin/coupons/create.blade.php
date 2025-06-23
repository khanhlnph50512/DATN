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
            <h2 class="fw-bold">➕ Thêm mã giảm giá</h2>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-primary">⬅️ Quay lại</a>
        </div>

        <form action="{{ route('admin.coupons.store') }}" method="POST" class="shadow-sm bg-white p-4 rounded">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Mã giảm giá *</label>
                    <input type="text" name="code" value="{{ old('code') }}" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Trạng thái</label>
                    <select name="active" class="form-select">
                        <option value="1">✔ Hoạt động</option>
                        <option value="0">❌ Tắt</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Mô tả</label>
                    <textarea name="description" rows="2" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Giảm theo số tiền (VNĐ)</label>
                    <input type="number" name="discount_amount" class="form-control" value="{{ old('discount_amount') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Giảm theo phần trăm (%)</label>
                    <input type="number" name="discount_percent" class="form-control"
                        value="{{ old('discount_percent') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Áp dụng cho đơn từ (VNĐ)</label>
                    <input type="number" name="minimum_order_amount" class="form-control"
                        value="{{ old('minimum_order_amount', $coupon->minimum_order_amount ?? 0) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Hiệu lực từ *</label>
                    <input type="date" name="valid_from" class="form-control" value="{{ old('valid_from') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Hiệu lực đến *</label>
                    <input type="date" name="valid_until" class="form-control" value="{{ old('valid_until') }}"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Giới hạn lượt sử dụng</label>
                    <input type="number" name="usage_limit" class="form-control" value="{{ old('usage_limit', 1) }}">
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success px-4">✅ Lưu mới</button>
            </div>
        </form>
    </div>
@endsection
