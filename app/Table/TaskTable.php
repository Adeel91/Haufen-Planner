<?php

namespace App\Table;

use App\ProjectsEmployees;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Status;

class TaskTable extends Table
{
    /**
     * @var int
     */
    protected $i = 1;

    /**
     * @var int
     */
    protected $rowId = 1;

    /**
     * @var string
     */
    protected $primaryKey = 'title';

    protected $project;

    /**
     * @var array
     */
    protected $columns = [
        'id' => 'ID',
        'title' => 'Title',
        'status' => 'Status',
        'employee' => 'Assigned To'
    ];

    /**
     * TaskTable constructor.
     * @param $data
     * @param $project
     */
    public function __construct($data, $project)
    {
        $this->project = $project;
        parent::__construct($data);
        $this->statuses = Status::all();
    }

    /**
     * @param string $column
     * @param object $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|int|mixed|string
     */
    public function getColumnValue($column, $task)
    {
        $data = '';
        
        switch ($column) {
            case 'id':
                $data = $this->rowId++;
                break;

            case 'title':
                $data =  '<a class="project-title" href="'. route('tasks.comments.index', $task->id) .'">'. $task->title .'</a>';
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
                $user = User::find($task->employee_id);

                if (!$user) {
                    $data = 'N/A';
                }
                else {
                    $data = '<a title="' . $user->name . '" class="members-initial is_' . $this->i . '" href="javascript:void(0)">' . strtoupper(substr($user->name, 0, 2)) . '</a>';

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

    /**
     * @param $task
     * @return array|void
     */
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
