@extends('admin.layouts.adminAnatats')

@section('title', 'Danh sách người dùng')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách người dùng</h1>

        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif

        <div class="my-3">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Thêm người dùng</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Mã khách hàng</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>Phone</th>
                    <th>address</th>
                    <th>Vai trò</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->seri_user }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->avater }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info"
                                title="Xem chi tiết">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Không có người dùng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div>
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
