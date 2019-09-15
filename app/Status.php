<?php

namespace App;

use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Status extends Model
{
    use Userstamps,SoftDeletes;
    
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    protected $dates = ['deleted_at'];
    
    /**
     * A status may have many projects.
     *
     * @return void
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * A status may have many tasks.
     *
     * @return void
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get a group based projects count for statuses.
     *
     * @return mixed
     */
    public static function getProjectsCountByStatus()
    {
        return self::join('projects', 'projects.status_id', '=', 'statuses.id')
        ->where(function ($q) {
            $q->where('projects.deleted_at', null);
            $user = Auth::user();
            if ($user->hasRole('client')) {
                $q->where('projects.client_id', $user->id);
            }
        })
        ->groupBy('statuses.id')
        ->get(
            ['statuses.id','statuses.title','statuses.slug', DB::raw('count(projects.id) as count')]
        );
    }

    /**
     * @return mixed
     */
    public static function getProjectsCountForEmployees()
    {
        return self::join('projects', 'projects.status_id', '=', 'statuses.id')
        ->join('projects_employees', 'projects_employees.project_id', '=', 'projects.id')
        ->where(function ($q) {
            $q->where('projects.deleted_at', null);
            $user = Auth::user();
            if ($user->hasRole('employee')) {
                $q->where('projects_employees.employee_id', $user->id);
            }
        })
        ->groupBy('statuses.id')
        ->get(
            ['statuses.id','statuses.title','statuses.slug', DB::raw('count(projects.id) as count')]
        );
    }
}
