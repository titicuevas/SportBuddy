<?php

namespace App\Http\Controllers;

use App\Services\StatsService;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.index', [
            'stats' => StatsService::adminStats(),
        ]);
    }
}
