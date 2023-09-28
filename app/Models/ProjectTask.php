<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;
    protected $table = 'project_task';
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'project_id',
        'task_id',
    ];


    // public function project()
    // {
    //     return $this->belongsTo(Project::class);
    // }

    // public function task()
    // {
    //     return $this->belongsTo(Task::class);
    // }
}
