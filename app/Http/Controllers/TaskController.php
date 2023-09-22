<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{TaskStoreRequest,TaskEditRequest, TaskAssignStoreRequest};
use App\Models\Task;
use App\Models\User;
use App\Models\UserTask;

class TaskController extends Controller
{
    protected Task $task;

    public function __construct(Task $task)
    {
        $this->task=$task;
        $this->middleware('permission:task-list|task-create|task-edit|task-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:task-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:task-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:task-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->task->latest()->with('user')->paginate(10);
        // dd($tasks);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 0;
        $data['created_by'] = auth()->user()->id;
        $this->task->create($data);
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Employee');
        })->get();
        return view('tasks.assign', compact('users', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Task $task)
    {

        return view('tasks.edit', compact('task'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(TaskEditRequest $request, Task $task)
    {
        $data = $request->validated();
        $task->update($data);
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function assign(TaskAssignStoreRequest $request, $id)
    {
        $user =User::find($request->user_id);
        $task = Task::find($id)->id;
        UserTask::updateOrCreate(
            ['task_id' => $task],
            ['user_id'=>$user->id],
        );
        return redirect()->route('tasks.index');
    }
}
