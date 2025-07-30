@extends('admin.layouts.adminAnatats')

@section('content')
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
                didClose: () => {
                    window.location.href = "{{ route('admin.categories.index') }}";
                }
            });
        </script>
    @endif
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
        <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1 mt-3">Edit Category</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-tile mb-0">Category information</h5>
                </div>
                <form id="category-form" action="{{ route('admin.categories.update', $category->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                        </div>
                        <div class="row mb-3">
                           
                            <div class="col">
                                <label class="form-label">Image</label><br>
                                @if ($category->image)
                                    <img src="{{ asset($category->image) }}" width="100" class="mb-2"><br>
                                @endif
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>
                    </div>
                </form>

                <div class="px-4 pb-3 d-flex justify-content-between">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="bx bx-list-ul me-1"></i> List Category
                    </a>
                    <button type="submit" form="category-form" class="btn btn-primary">
                        <i class="bx bx-save me-1"></i> Update Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@endsection
