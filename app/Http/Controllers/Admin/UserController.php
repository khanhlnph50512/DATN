<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users =  User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'role' => 'required|in:admin,customers',
    ]);

    // Nếu người dùng hiện tại là admin, không cho phép chuyển thành customer
    if ($user->role === 'admin' && $request->role === 'customers') {
        return redirect()->route('admin.users.index')->with('error', 'Không thể chuyển quyền admin thành khách hàng');
    }

    // Nếu người dùng hiện tại là customer và muốn chuyển thành admin => cho phép
    $user->role = $request->role;
    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'Cập nhật vai trò người dùng thành công');
}

    /**
     * Remove the specified resource from storage.
     */

}
