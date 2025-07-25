<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
 public function index()
    {
        $shippingMethods = ShippingMethod::all();
        return response()->json($shippingMethods);
    }
}
