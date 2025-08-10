@extends('admin.layouts.adminAnatats')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

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
                customClass: {
                    popup: 'swal2-red-bg'
                }
            });
        </script>
    @endif
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">





            <!-- Product List Widget -->

            <!-- Product List Table -->
            <div class="card">
                <!-- Tiêu đề chính -->
                <div class="px-4 pt-3">
                    <h4 class="breadcrumb-wrapper mb-4">
                        <span class="text-muted fw-light"></span> Danh sách danh mục
                    </h4>
                </div>

                <!-- Nút Thêm Danh Mục -->
                <div class="px-4 pb-3 d-flex justify-content-end">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus me-1"></i> Add Category
                    </a>
                </div>

                <div class="card-datatable table-responsive">
                    <table class="datatables-products table">
                        <thead class="border-top">
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @if ($category->image)
                                            <img src="{{ asset($category->image) }}" width="50">
                                        @endif
                                    </td>

                                    <td class="text-nowrap">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-warning" title="Sửa">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                            style="display: inline-block;"
                                            onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- / Content -->


        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection
