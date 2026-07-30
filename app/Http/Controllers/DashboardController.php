<?php

namespace App\Http\Controllers;

use App\Services\StatsService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', StatsService::dashboardForUser(auth()->id()));
    }
}
