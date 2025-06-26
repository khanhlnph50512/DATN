@extends('admin.layouts.adminAnatats')

@section('title', 'Trang điều khiển')

@section('content')
<h2 class="mb-4">Bảng điều khiển</h2>

<div class="row g-3">
  <!-- Sản phẩm -->
  <div class="col-md-4">
    <div class="card text-white bg-primary h-100">
      <div class="card-header">Sản phẩm</div>
      <div class="card-body">
        <h5 class="card-title">150 sản phẩm</h5>
        <p class="card-text">Quản lý các sản phẩm trong hệ thống.</p>
      </div>
    </div>
  </div>

  <!-- Người dùng -->
  <div class="col-md-4">
    <div class="card text-white bg-success h-100">
      <div class="card-header">Quản lý người dùng</div>
      <div class="card-body">
        <h5 class="card-title">300 người dùng</h5>
        <p class="card-text">Quản lý thông tin người dùng.</p>
      </div>
    </div>
  </div>

  <!-- Đơn hàng -->
  <div class="col-md-4">
    <div class="card text-dark bg-warning h-100">
      <div class="card-header">Quản lý đơn hàng</div>
      <div class="card-body">
        <h5 class="card-title">25 đơn hàng</h5>
        <p class="card-text">Theo dõi và quản lý đơn hàng.</p>
      </div>
    </div>
  </div>
</div>
@endsection
