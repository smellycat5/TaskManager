<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use App\Models\Task;
use App\Notifications\TaskStatusNotification;

class TaskService
{
    public function checkStatus($task)
    {
        if ($task->status == '2'){
            $user = $task->users()->first();
            $taskName = $task->title; 
            $userName =$user->name;
            $user->notify(new TaskStatusNotification($userName, $taskName));  
            // dd($user);
                // $task_name = $task->title;
        }
    }
}