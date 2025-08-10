<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItem;
use App\Models\Admin\Product;
use App\Models\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   public function index(Request $request)
    {
        // Thống kê tổng
        $totalRevenue = (float) Order::where('status', 'completed')->sum('total_amount');
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd   = Carbon::now()->endOfMonth();

        $monthRevenue = (float) Order::where('status', 'completed')
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->sum('total_amount');

        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'completed')->count();
        $canceledOrders = Order::where('status', 'canceled')->count();

        $totalProducts = Product::count();
        $totalCustomers = User::count();
        $newCustomersThisMonth = User::whereBetween('created_at', [$monthStart, $monthEnd])->count();

        // Dữ liệu biểu đồ 12 tháng (từ 11 tháng trước tới tháng hiện tại)
        $start = Carbon::now()->subMonths(11)->startOfMonth();
        $chartLabels = [];
        $chartRevenue = [];
        $chartOrders = [];

        for ($i = 0; $i < 12; $i++) {
            $m = $start->copy()->addMonths($i);
            $chartLabels[] = $m->format('M Y'); // ví dụ: "Jan 2025"

            // dùng whereYear/whereMonth với số nguyên
            $chartRevenue[] = (float) Order::where('status', 'completed')
                ->whereYear('created_at', $m->year)
                ->whereMonth('created_at', $m->month)
                ->sum('total_amount');

            $chartOrders[] = (int) Order::whereYear('created_at', $m->year)
                ->whereMonth('created_at', $m->month)
                ->count();
        }

        return view('admin.dashboard', [
            'totalRevenue' => $totalRevenue,
            'monthRevenue' => $monthRevenue,
            'totalOrders' => $totalOrders,
            'completedOrders' => $completedOrders,
            'canceledOrders' => $canceledOrders,
            'totalProducts' => $totalProducts,
            'totalCustomers' => $totalCustomers,
            'newCustomersThisMonth' => $newCustomersThisMonth,
            'chartLabels' => $chartLabels,
            'chartRevenue' => $chartRevenue,
            'chartOrders' => $chartOrders,
        ]);
    }
}
