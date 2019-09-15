<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Status;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $projectGroupCounts = Status::getProjectsCountByStatus();

        if ($user->hasRole('employee')) {
            $projectGroupCounts = Status::getProjectsCountForEmployees();
        }

        return view('dashboard.index', compact('projectGroupCounts'));
    }
}
