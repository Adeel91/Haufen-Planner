<?php

namespace App\Table;

use App\ProjectsEmployees;
use App\Table\Table;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Credential;
use App\Task;
use App\Status;

class ProjectTable extends Table
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

    /**
     * @var array
     */
    protected $columns = [
        'id' => 'ID',
        'title' => 'Title',
        'status' => 'Status',
        'client' => 'Supervisor',
        'employee' => 'Team Members'
    ];

    /**
     * ProjectTable constructor.
     * @param $data
     */
    public function __construct($data)
    {
        parent::__construct($data);
        $this->statuses = Status::all();
    }

    /**
     * @return array|void
     */
    public function getColumns()
    {
        if (Auth::user()->hasRole('client')) {
            unset($this->columns['client']);
        }

        return $this->columns;
    }

    /**
     * @param string $column
     * @param object $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|int|mixed|string
     */
    public function getColumnValue($column, $project)
    {
        $data = '';

        $projectEmployees = ProjectsEmployees::where('project_id', $project->id);

        switch ($column) {
            case 'id':
                $data = $this->rowId++;
                break;

            case 'title':
                $data =  '<a class="project-title" href="'. route('projects.tasks.index', $project->id) .'">'. $project->title .'</a>';
                break;

            case 'status':
                if (Auth::user()->can('projects.updateStatus', $project)) {
                    $data =  view('statuses.dropdown', [
                        'statuses'=>$this->statuses,
                        'model'=>$project,
                        'endPoint' => route('projectsUpdateStatus', $project->id)
                    ]);
                } else {
                    $data =  $project->status->title;
                }
                break;
            
            case 'client':
                $data =  '<a title="'. $project->client->name .'" class="members-initial is_'. $this->i .'" href="'. route('projects.index', ['for'=>$project->client->name]) .'">'.strtoupper(substr($project->client->name, 0, 2)).'</a>';

                $this->i++;

                if ($this->i > 6) {
                    $this->i = 1;
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
                $data = $this->defaultColumnValue($column, $project);
                break;
        }

        return $data;
    }

    /**
     * @param $item
     * @return array|void
     */
    public function generateQuickActionLinks($item)
    {
        $links = [];
        $user = Auth::user();
        if ($user->can('projects.view', $item)) {
            $links['details'] = [
                'title' => 'Details',
                'link' => route('projects.show', $item->id)
            ];
        }
        if ($user->can('projects.update', $item)) {
            $links['edit'] = [
                'title' => 'Edit',
                'link' => route('projects.edit', $item->id)
            ];
        }
        if ($user->can('credentials.index', $item, Credential::class)) {
            $links['credential'] = [
                'title' => 'Credentials',
                'link' => route('projects.credentials.index', $item->id)
            ];
        }
        if ($user->can('credentials.create', $item, Credential::class)) {
            $links['new-credential'] = [
                'title' => 'New Credential',
                'link' => route('projects.credentials.create', $item->id)
            ];
        }
        if ($user->can('tasks.create', $item, Task::class)) {
            $links['new-task'] = [
                'title' => 'New Task',
                'link' => route('projects.tasks.create', $item->id)
            ];
        }
        if ($user->can('projects.delete', $item)) {
            $links['delete'] = [
                'title' => 'Delete',
                'link' => route('projects.destroy', $item->id)
            ];
        }
        return $links;
    }
}
