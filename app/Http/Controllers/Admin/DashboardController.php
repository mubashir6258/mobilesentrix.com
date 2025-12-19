<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => 1234,
            'total_orders' => 567,
            'total_revenue' => 89234.50,
            'pending_orders' => 23,
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
