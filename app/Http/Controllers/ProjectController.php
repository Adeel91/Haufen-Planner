<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use App\ProjectsEmployees;
use App\Table\ProjectTable;
use Illuminate\Http\Request;
use App\Filters\ProjectFilters;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectFilters $filters)
    {
        $projects = Project::latest()->filter($filters)->paginate(20);

        $user = Auth::user();
        if ($user->hasRole('employee')) {
            $projectEmployees = ProjectsEmployees::where('employee_id', $user->id)->get();

            $projectList = [];
            foreach ($projects as $project) {
                foreach ($projectEmployees as $employee) {
                    if ($project->id === $employee->project_id) {
                        $projectList[] = $project;
                    }
                }
            }

            $projects = $projectList;

            $projects = new LengthAwarePaginator($projects, count($projectList), 20);
        }

        $table = new ProjectTable($projects);
        return view('projects.index', compact('projects', 'table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        $clients = User::role('client')->get();
        $employees = User::role('employee')->get();
        return view('projects.create', compact('project', 'clients', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'client_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $project = Project::create($data);

        foreach ($request->input('employee_id') as $item) {
            $employee = new ProjectsEmployees();
            $employee->employee_id = (int) $item;
            $employee->project_id = $project->id;

            $project->projectsEmployees()->save($employee);
        }

        flash('Project Created Successfully.');

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $taskGroupCounts = $project->tasksGroupbyCount();
        return view('projects.show', compact('project', 'taskGroupCounts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $clients = User::role('client')->get();
        $employees = User::role('employee')->get();
        return view('projects.edit', compact('project', 'clients', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'client_id' => 'required|exists:users,id',
            'status_id' => 'required|exists:statuses,id',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $project->update($data);

        ProjectsEmployees::where('project_id', $project->id)->delete();

        foreach ($request->input('employee_id') as $item) {
            $employee = new ProjectsEmployees();
            $employee->employee_id = (int) $item;
            $employee->project_id = $project->id;

            $project->projectsEmployees()->save($employee);
        }

        flash('Project Updated Successfully.');

        return redirect()->route('projects.index');
    }

    /**
     * Remo     ve the specified resource from storage.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Project $project)
    {
        $project->delete();
        flash('Project Deleted Successfully.', 'info');
        return redirect()->route('projects.index');
    }

    /**
     * Update the project status
     *
     * @param Request $request
     * @param Project $project
     * @return void
     */
    public function updateStatus(Request $request, Project $project)
    {
        $data = $request->validate([
            'status_id' => 'required|exists:statuses,id'
        ]);
        $project->update($data);
        return response('Project status updated successfully');
    }
}
