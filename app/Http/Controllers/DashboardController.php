<?php

namespace App\Http\Controllers;

use App\Services\StatsService;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $data = StatsService::dashboardForUser(auth()->id());

        return view('dashboard', $data);
    }
}
