<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function user()
    {
        return $this->hasOneThrough(User::class, UserTask::class, 'task_id', 'id', 'id', 'user_id');
    }
}
