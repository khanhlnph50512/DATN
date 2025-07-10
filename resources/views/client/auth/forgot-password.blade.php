@extends('client.layouts.auth')

@section('title', 'Quên mật khẩu')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h3 class="mb-4 text-center">Quên mật khẩu</h3>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        {{-- Hiển thị lỗi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM QUÊN MẬT KHẨU --}}
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Nhập email của bạn" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Gửi liên kết đặt lại mật khẩu</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login.form') }}">← Quay lại đăng nhập</a>
        </div>
    </div>
</div>
@endsection
