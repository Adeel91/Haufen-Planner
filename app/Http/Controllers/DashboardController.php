<?php

namespace App\Http\Controllers;

use App\Task;
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
        $tasks = Task::getTasksForEmployees();

        if ($user->hasRole('employee')) {
            $projectGroupCounts = Status::getProjectsCountForEmployees();
        }
//echo '<pre>';dump($tasks);die;
        return view('dashboard.index', compact('projectGroupCounts', 'tasks'));
    }
}
