<?php

namespace App;

use App\Project;
use App\Status;
use App\Traits\Userstamps;
use App\Filters\TaskFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use SoftDeletes, Userstamps;
    
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    protected $with = ['status'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder       $query
     * @param  ThreadFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, TaskFilters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * A task belongs to status
     *
     * @return void
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * A taks belongs to project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectsEmployees()
    {
        return $this->hasMany(ProjectsEmployees::class);
    }

    /**
     * A task may have many comments.
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Add a comment to task.
     *
     * @param array $attributes
     * @return void
     */
    public function addComment($attributes)
    {
        return $this->comments()->create($attributes);
    }

    /**
     * Get a project by taks
     *
     * @param Project $project
     * @param TaskFilters $filters
     * @return mixed
     */
    public static function getTasksByProject(Project $project, TaskFilters $filters)
    {
        return static::where('project_id', $project->id)->filter($filters);
    }

    /**
     * @param \App\Project $project
     * @param TaskFilters $filters
     * @param $user
     * @return mixed
     */
    public static function getTasksByProjectsEmployees(Project $project, TaskFilters $filters, $user)
    {
        return static::where('project_id', $project->id)->where('employee_id', $user->id)->filter($filters);
    }

    /**
     * @return mixed
     */
    public static function getTasksForEmployees()
    {
        return self::join('statuses', 'tasks.status_id', '=', 'statuses.id')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where(function ($q) {
                $q->where('tasks.deleted_at', null);

                $user = Auth::user();
                $q->where('tasks.employee_id', $user->id);
            })
            ->orderBy('tasks.due_date', 'DESC')
            ->limit(10)
            ->get(
                ['tasks.id', DB::raw('tasks.title as taskTitle'), 'tasks.description', 'tasks.due_date', 'tasks.project_id', DB::raw('projects.title as projectTitle'), 'statuses.slug']
            );
    }
}
