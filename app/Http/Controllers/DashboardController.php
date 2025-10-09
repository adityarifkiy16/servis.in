<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $arr['count'] =
            [
                'products' => \App\Models\Product::count(),
                'services_schedules' => \App\Models\Service::where('status', 0)->count(),
                'users' => \App\Models\User::count(),
            ];
        $arr['recentServices'] = \App\Models\Service::with(['serviceType', 'product'])->latest()->limit(5)->get();
        return view('dashboard.index', $arr);
    }
}
