@extends('admin.layouts.adminAnatats')

@section('title', 'Chỉnh sửa mã giảm giá')

@section('content')
<style>
    label.form-label {
        color: black !important;
    }
</style>

<div class="container mt-4">
    <h2 class="mb-4">Chỉnh sửa mã giảm giá</h2>

    <!-- Thông báo -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST" class="card card-body">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Mã code *</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description', $coupon->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Giảm giá cố định (VNĐ)</label>
            <input type="number" name="discount_amount" id="discount_amount" class="form-control" step="0.01" value="{{ old('discount_amount', $coupon->discount_amount) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Giảm theo phần trăm (%)</label>
            <input type="number" name="discount_percent" id="discount_percent" class="form-control" step="0.01" value="{{ old('discount_percent', $coupon->discount_percent) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Đơn hàng tối thiểu (VNĐ)</label>
            <input type="number" name="minimum_order_amount" class="form-control" step="0.01" value="{{ old('minimum_order_amount', $coupon->minimum_order_amount) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày bắt đầu *</label>
            <input type="date" name="valid_from" class="form-control" value="{{ old('valid_from', $coupon->valid_from->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày kết thúc *</label>
            <input type="date" name="valid_until" class="form-control" value="{{ old('valid_until', $coupon->valid_until->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giới hạn số lần sử dụng</label>
            <input type="number" name="usage_limit" class="form-control" value="{{ old('usage_limit', $coupon->usage_limit) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái *</label>
            <select name="active" class="form-select" required>
                <option value="1" {{ old('active', $coupon->active) ? 'selected' : '' }}>Kích hoạt</option>
                <option value="0" {{ old('active', $coupon->active) ? '' : 'selected' }}>Tạm tắt</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const percent = document.getElementById('discount_percent');
        const amount = document.getElementById('discount_amount');

        function toggleInputs() {
            if (percent.value) {
                amount.disabled = true;
            } else {
                amount.disabled = false;
            }

            if (amount.value) {
                percent.disabled = true;
            } else {
                percent.disabled = false;
            }
        }

        percent.addEventListener('input', toggleInputs);
        amount.addEventListener('input', toggleInputs);
        toggleInputs();
    });
</script>
@endsection
