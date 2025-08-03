@extends('admin.layouts.adminAnatats')

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
                <label for="role" class="form-label">Vai trò</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="customers" {{ old('role', $user->role) == 'customers' ? 'selected' : '' }}>Customer
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
@endsection
