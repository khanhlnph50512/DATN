@extends('client.layouts.auth')

@section('content')


    <div class="card shadow">
    <div class="card-body">
        <h3 class="mb-4 text-center">Đặt lại mật khẩu</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu mới" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Cập nhật mật khẩu</button>
        </form>
    </div>
</div>
@endsection
