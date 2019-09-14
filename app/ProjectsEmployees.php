<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectsEmployees extends Model
{
    /**
     * Get the projects that owns the comment.
     */
    public function projects()
    {
        return $this->belongsTo(Project::class);
    }
}