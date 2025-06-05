<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    // Danh sách khách hàng (hoạt động)
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    // Form thêm mới
    public function create()
    {
        return view('admin.customers.create');
    }

    // Lưu khách hàng mới
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:customers',
            'password' => 'required|min:6',
        ]);

        Customer::create([
            'seri_customer' => 'CUS' . strtoupper(Str::random(6)),
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'avatar'        => $request->avatar,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'gender'        => $request->gender,
            'birthday'      => $request->birthday,
        ]);

        return redirect()->route('customers.index')->with('success', 'Thêm khách hàng thành công.');
    }

    // Form sửa
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    // Cập nhật khách hàng
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
        ]);

        $customer->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'avatar'   => $request->avatar,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'gender'   => $request->gender,
            'birthday' => $request->birthday,
        ]);

        return redirect()->route('customers.index')->with('success', 'Cập nhật thành công.');
    }

    // Xóa mềm
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Đã chuyển vào thùng rác.');
    }

    // Danh sách đã xóa
    public function trash()
    {
        $customers = Customer::onlyTrashed()->paginate(10);
        return view('admin.customers.trash', compact('customers'));
    }

    // Khôi phục
    public function restore($id)
    {
        $customer = Customer::withTrashed()->findOrFail($id);
        $customer->restore();

        return redirect()->route('customers.trash')->with('success', 'Khôi phục thành công.');
    }

    // Xóa vĩnh viễn
    public function forceDelete($id)
    {
        $customer = Customer::withTrashed()->findOrFail($id);
        $customer->forceDelete();

        return redirect()->route('customers.trash')->with('success', 'Đã xóa vĩnh viễn.');
    }
}
