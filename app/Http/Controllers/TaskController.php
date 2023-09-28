<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{TaskStoreRequest, TaskEditRequest, TaskAssignStoreRequest, TaskToSprintRequest};
use App\Models\Task;
use App\Models\User;
use App\Models\UserTask;
use App\Models\Sprint;
use App\Models\Project;
use App\Models\SprintTask;
use App\Models\ProjectTask;
use Illuminate\Support\Benchmark;

class TaskController extends Controller
{
    protected Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
        $this->middleware('permission:task-list|task-create|task-edit|task-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:task-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:task-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:task-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        // Benchmark::dd(fn () => $project->tasks()->get(), iterations: 10); 
        $tasks = $project->tasks()->with('users')->latest()->get();
        return view('tasks.index', compact('tasks', 'project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request, Project $project)
    {
        $data = $request->validated();
        $data['status'] = 0;
        $data['created_by'] = auth()->user()->id;
        $task = $this->task->create($data);
        ProjectTask::create([
            'project_id' => $project->id,
            'task_id' => $task->id
        ]);
        return redirect()->route('projects.tasks.index', compact('project'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Task $task)
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Employee');
        })->whereHas('projects', function ($query) use ($project) {
            $query->where('projects.id', $project->id); // Replace $projectId with the specific project ID
        })->get();
        $sprints = $project->sprints()->get();
        return view('tasks.assign', compact('users', 'task', 'sprints', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Task $task)
    {

        return view('tasks.edit', compact('task', 'project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskEditRequest $request, Project $project, Task $task)
    {
        $data = $request->validated();
        $task->update($data);
        return redirect()->route('projects.tasks.index', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->route('projects.tasks.index', $project->id);
    }

    public function assign(TaskAssignStoreRequest $request, Project $project, Task $task)
    {
        $user = User::find($request->user_id);
        $taskId = $task->id;
        UserTask::updateOrCreate(
            ['task_id' => $taskId],
            ['user_id' => $user->id],
        );
        return redirect()->route('projects.tasks.index', compact('project'));
    }

    public function toSprint(TaskToSprintRequest $request, $task)
    {
        $sprint = Sprint::find($request->sprint_id);
        SprintTask::updateOrCreate(
            ['task_id' => $task,],
            ['sprint_id' => $sprint->id],
        );
        return redirect()->route('projects.tasks.index');
    }
}
