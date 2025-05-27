@extends('admin.layouts.master')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">

        <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1 mt-3">Add a new Category</h4>
        </div>

    </div>

    <div class="row">

        <!-- First column-->
        <div class="col-12 col-lg-8">
            <!-- category Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-tile mb-0">Category information</h5>
                </div>
                <form id="category-form" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="ecommerce-category-name">Name</label>
                            <input type="text" class="form-control" id="ecommerce-category-name"
                                placeholder="Category name" name="name" aria-label="Category name">
                        </div>
                        <div class="row mb-3">
                            <div class="col"><label class="form-label" for="ecommerce-category-sku">SKU</label>
                                <input type="number" class="form-control" id="ecommerce-category-sku" placeholder="SKU"
                                 aria-label="category SKU">
                            </div>
                            <div class="col"><label class="form-label" for="ecommerce-category-barcode">Image</label>
                                <input type="file" class="form-control" id="ecommerce-category-barcode"
                                    placeholder="Image" name="image" aria-label="category image">
                            </div>
                        </div>
                    </div>
                </form>

                <div class="px-4 pb-3 d-flex justify-content-between">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="bx bx-list-ul me-1"></i> List Category
                    </a>

                    <button type="submit" form="category-form" class="btn btn-primary">
                        <i class="bx bx-plus me-1"></i> Add Category
                    </button>
                </div>

            </div>
        </div>
        <!-- /Second column -->
    </div>
    <!-- / Content -->
@endsection
