@extends('client.layouts.main')

@section('title', 'Cập nhật hồ sơ')

@section('content')
<style>
    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 12px 16px;
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        background-color: #fff;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    }

    .card {
        background-color: #ffffff;
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .btn-custom {
        background: linear-gradient(to right, #4e73df, #1cc88a);
        border: none;
        padding: 12px 24px;
        font-weight: 500;
        border-radius: 30px;
        transition: background 0.3s ease;
    }

    .btn-custom:hover {
        background: linear-gradient(to right, #3d5ec9, #17a673);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header text-center bg-white border-bottom-0 pt-4">
                    <h3 class="fw-bold text-primary mb-1">Cập nhật hồ sơ</h3>
                    <p class="text-muted small">Giữ thông tin chính xác để dễ dàng giao dịch</p>
                </div>

                <div class="card-body px-4 py-4">
                    @if (session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" class="row g-3">
                        @csrf

                        <div class="col-12">
                            <label class="form-label fw-semibold">Họ tên</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Nhập họ tên">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control bg-light" value="{{ $user->email }}" readonly>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Số điện thoại</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="form-control @error('phone') is-invalid @enderror" placeholder="Nhập số điện thoại">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Địa chỉ</label>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}"
                                class="form-control @error('address') is-invalid @enderror" placeholder="Nhập địa chỉ">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Giới tính</label>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="">-- Chọn giới tính --</option>
                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Nam</option>
                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Nữ</option>
                                <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Khác</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 text-center pt-3">
                            <button type="submit" class="btn btn-custom">
                                <i class="fas fa-save me-1"></i> Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
