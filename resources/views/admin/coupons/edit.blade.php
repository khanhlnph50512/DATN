@extends('admin.layouts.adminAnatats')

@section('content')
<div class="container">
    <h2 class="fw-bold my-4">✏️ Sửa mã giảm giá</h2>

    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST" class="bg-white p-4 shadow rounded">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Mã giảm giá *</label>
            <input type="text" name="code" value="{{ old('code', $coupon->code) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description', $coupon->description) }}</textarea>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label fw-bold">Giảm theo tiền (VNĐ)</label>
                <input type="number" name="discount_amount" value="{{ old('discount_amount', $coupon->discount_amount) }}" class="form-control">
            </div>
            <div class="col">
                <label class="form-label fw-bold">Giảm theo %</label>
                <input type="number" name="discount_percent" value="{{ old('discount_percent', $coupon->discount_percent) }}" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label fw-bold">Áp dụng đơn từ (VNĐ)</label>
                <input type="number" name="minimum_order_amount" value="{{ old('minimum_order_amount', $coupon->minimum_order_amount) }}" class="form-control">
            </div>
            <div class="col">
                <label class="form-label fw-bold">Lượt sử dụng</label>
                <input type="number" name="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit) }}" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label fw-bold">Hiệu lực từ *</label>
                <input type="date" name="valid_from" value="{{ old('valid_from', \Carbon\Carbon::parse($coupon->valid_from)->format('Y-m-d')) }}" class="form-control" required>
            </div>
            <div class="col">
                <label class="form-label fw-bold">Hiệu lực đến *</label>
                <input type="date" name="valid_until" value="{{ old('valid_until', \Carbon\Carbon::parse($coupon->valid_until)->format('Y-m-d')) }}" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Trạng thái *</label>
            <select name="active" class="form-select" required>
                <option value="1" {{ $coupon->active ? 'selected' : '' }}>✔ Hoạt động</option>
                <option value="0" {{ !$coupon->active ? 'selected' : '' }}>❌ Tắt</option>
            </select>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">⬅ Huỷ</a>
        </div>
    </form>
</div>
@endsection
