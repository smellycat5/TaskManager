<?php

namespace App\Models;

use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

//    public $preventsLazyLoading = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'client_name',
        'client_email',
    ];

    public function taskUsers()
    {
        return $this->hasManyThrough(User::class, ProjectTask::class, 'project_id', 'id','id','user_id');
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function sprints()
    {
        return $this->belongsToMany(Sprint::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
  
    public function projectTask()
    {
        return $this->hasMany(ProjectTask::class);
    }
}
