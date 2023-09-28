<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'status',
        'title',
        'priority',
        'created_by',
    ];

    public function userTasks()
    {
        return $this->hasMany(UserTask::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // public function project()
    // {
    //     return $this->hasOneThrough(Project::class, ProjectTask::class, 'task_id', 'id', 'id' , 'project_id');
    // }

    public function project()
    {
        return $this->belongsToMany(Task::class);
    }

    public function projectTask()
    {
        return $this->belongsTo(ProjectTask::class);
    }
}
