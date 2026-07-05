<?php

namespace App\Http\Controllers;

use App\Services\StatsService;

class AdminDashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.index', [
            'stats' => StatsService::adminStats(),
        ]);
    }
}
