@extends('client.layouts.auth')

@section('title', 'Đăng nhập')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h3 class="mb-4 text-center">Đăng nhập</h3>

        {{-- Thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Thông báo lỗi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM ĐĂNG NHẬP --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf {{-- Token chống CSRF --}}

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Đăng nhập</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('register.form') }}">Chưa có tài khoản?</a> |
            <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
        </div>
    </div>
</div>
@endsection
