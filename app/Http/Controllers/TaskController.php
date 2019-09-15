<?php

namespace App\Http\Controllers;

use App\ProjectsEmployees;
use App\Task;
use App\Project;
use App\Table\TaskTable;
use App\User;
use Illuminate\Http\Request;
use App\Filters\TaskFilters;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project, TaskFilters $filters)
    {
        $tasks = Task::getTasksByProject($project, $filters)->latest()->paginate(20);

        $user = Auth::user();
        if ($user->hasRole('employee')) {
            $tasks = Task::getTasksByProjectsEmployees($project, $filters, $user)->latest()->paginate(20);
        }

        $table = new TaskTable($tasks, $project);
        return view('tasks.index', compact('project', 'tasks', 'table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $task = new Task();
        $employees = (new ProjectsEmployees())->where('project_id', $project->id)->get();
        return view('tasks.create', compact('project', 'task', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required',
            'employee_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id'
        ]);

        $project->addTask($data);

        flash('Task created Successfully.');

        return redirect()->route('projects.tasks.index', $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Task $task)
    {
        return view('tasks.show', compact('project', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Task $task)
    {
        $employees = (new ProjectsEmployees())->where('project_id', $project->id)->get();
        return view('tasks.edit', compact('project', 'task', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required',
            'employee_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id'
        ]);

        $task->update($data);

        flash('Task updated Successfully.');

        return redirect()->route('projects.tasks.index', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Project $project
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        flash('Task deleted Successfully.', 'info');
        return redirect()->route('projects.tasks.index', $project->id);
    }

    /**
     * @param Request $request
     * @param Project $project
     * @param Task $task
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function updateStatus(Request $request, Project $project, Task $task)
    {
        $data = $request->validate([
            'status_id' => 'required|exists:statuses,id'
        ]);
        $task->update($data);
        return response('Task status updated successfully');
    }
}
