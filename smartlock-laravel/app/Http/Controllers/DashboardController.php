<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessLog;
use App\Models\DoorStatus;

class DashboardController extends Controller
{
    public function index()
    {
        $recentLogs = AccessLog::with('user')->orderBy('accessed_at', 'desc')->take(5)->get();
        $doorStatus = DoorStatus::orderBy('updated_at', 'desc')->first();

        return view('dashboard', compact('recentLogs', 'doorStatus'));
    }
}
