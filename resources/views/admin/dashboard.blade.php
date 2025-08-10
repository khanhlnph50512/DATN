@extends('admin.layouts.adminAnatats')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📊 Thống kê tổng quan</h2>

    <div class="row g-3">
        <!-- Doanh thu -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 bg-success text-white">
                <div class="card-body">
                    <h6 class="fw-bold">Tổng doanh thu</h6>
                    <h3 class="fw-bold">{{ number_format($totalRevenue) }} đ</h3>
                    <small>Tháng này: {{ number_format($monthRevenue) }} đ</small>
                </div>
            </div>
        </div>

        <!-- Đơn hàng -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 bg-info text-white">
                <div class="card-body">
                    <h6 class="fw-bold">Tổng đơn hàng</h6>
                    <h3 class="fw-bold">{{ $totalOrders }}</h3>
                    <small>Hoàn thành: {{ $completedOrders }} | Hủy: {{ $canceledOrders }}</small>
                </div>
            </div>
        </div>

        <!-- Sản phẩm -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 bg-warning text-dark">
                <div class="card-body">
                    <h6 class="fw-bold">Tổng sản phẩm</h6>
                    <h3 class="fw-bold">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>

        <!-- Khách hàng -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3 bg-primary text-white">
                <div class="card-body">
                    <h6 class="fw-bold">Khách hàng</h6>
                    <h3 class="fw-bold">{{ $totalCustomers }}</h3>
                    <small>Tháng này: {{ $newCustomersThisMonth }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ -->
    <div class="card shadow-sm border-0 rounded-3 mt-5">
        <div class="card-body">
            <h5 class="mb-4">📈 Biểu đồ Doanh thu & Đơn hàng theo tháng</h5>
            <canvas id="statsChart" height="120"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($chartLabels ?? []);
    const revenue = @json($chartRevenue ?? []);
    const orders = @json($chartOrders ?? []);

    const ctx = document.getElementById('statsChart').getContext('2d');
    const statsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Doanh thu',
                    data: revenue,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Số đơn hàng',
                    data: orders,
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderWidth: 2,
                    tension: 0.3
                }
            ]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
</script>
@endsection
