<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function discoverYou()
    {
        return view('client.pages.discover-you');
    }
}
