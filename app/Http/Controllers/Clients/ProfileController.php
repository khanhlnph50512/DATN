<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('client.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
        ]);

        $user = Auth::user();
        if ($user instanceof \App\Models\Admin\User) {
            $user->update($request->only(['name', 'phone', 'address', 'gender']));
        }

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
    }
}
