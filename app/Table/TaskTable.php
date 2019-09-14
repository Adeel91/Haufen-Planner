<?php

namespace App\Table;

use App\ProjectsEmployees;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Status;

class TaskTable extends Table
{
    protected $i = 1;

    protected $primaryKey = 'title';

    protected $project;

    protected $columns = [
        'title' => 'Title',
        'status' => 'Status',
        'employee' => 'Assigned To'
    ];

    public function __construct($data, $project)
    {
        $this->project = $project;
        parent::__construct($data);
        $this->statuses = Status::all();
    }

    public function getColumnValue($column, $task)
    {
        $data = '';

        $projectEmployees = ProjectsEmployees::where('project_id', $this->project->id);
        
        switch ($column) {
            case 'title':
                $data =  '<a href="'. route('tasks.comments.index', $task->id) .'">'. $task->title .'</a>';
                break;

            case 'status':
                if (Auth::user()->can('tasks.updateStatus', [$this->project,$task])) {
                    $data =  view('statuses.dropdown', [
                        'statuses'=>$this->statuses,
                        'model'=>$task,
                        'endPoint' => route('tasksUpdateStatus', ['project' => $this->project->id, 'task' => $task->id])
                        ]);
                } else {
                    $data =  $task->status->title;
                }
                break;

            case 'employee':
                if (!$projectEmployees->get()->all()) {
                    $data = 'N/A';
                }

                foreach ($projectEmployees->get()->all() as $item) {
                    $user = User::find($item->employee_id);
                    $data .= '<a title="'. $user->name. '" class="members-initial is_'. $this->i .'" href="javascript:void(0)">'.strtoupper(substr($user->name, 0, 2)).'</a>';

                    $this->i++;

                    if ($this->i > 6) {
                        $this->i = 1;
                    }
                }

                break;

            default:
                $data = $this->defaultColumnValue($column, $task);
                break;
        }

        return $data;
    }

    public function generateQuickActionLinks($task)
    {
        $links = [];
        $user = Auth::user();
        if ($user->can('tasks.update', [$this->project, $task])) {
            $links['edit'] = [
                'title' => 'Edit',
                'link' => route('projects.tasks.edit', ['project'=>$this->project->id,'task'=>$task->id])
            ];
        }
        if ($user->can('tasks.delete', [$this->project, $task])) {
            $links['delete'] = [
                'title' => 'Delete',
                'link' => route('projects.tasks.destroy', ['project'=>$this->project->id,'task'=>$task->id])
            ];
        }
        
        return $links;
    }
}
