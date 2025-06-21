@extends('layouts.adminAnatats')

@section('title', 'Cập nhật người dùng')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Cập nhật người dùng</h1>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Họ tên</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu mới (nếu đổi)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <textarea name="address" id="address" class="form-control" rows="2">{{ old('address', $user->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="avatar" class="form-label">Ảnh đại diện</label>
            @if ($user->avatar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar" width="100">
                </div>
            @endif
            <input type="file" name="avatar" id="avatar" class="form-control">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Vai trò</label>
            <select name="role" id="role" class="form-select" required>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>Customer</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</div>
@endsection
