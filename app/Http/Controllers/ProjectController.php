<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\{Project, ProjectUser, Task};

class ProjectController extends Controller
{
    protected $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->middleware('permission:project-list|project-create|project-edit|project-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:project-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:project-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:project-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('sprints.tasks')->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request)
    {
        $validated = $request->validated();
        $this->project->create($validated);
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $validated = $request->validated();
        $project->update($validated);
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }

    /**
     * Add users to the project.
     *
     */
    public function users(Project $project)
    {
        $projectUsers = $project->users;
        $users = User::whereDoesntHave('projects', function ($query) use ($project) {
            $query->where('project_id', $project->id);
        })->get();
        // dd($projectUsers);
        return view('projects.users', compact('projectUsers', 'users', 'project'));
    }

    /**
     * Add users to the project.
     *
     */
    public function addUsers(Project $project, User $user)
    {
        $project_id = $project->id;
        $user_id = $user->id;
        // dd($user_id);
        ProjectUser::create(['project_id' => $project_id, 'user_id' => $user_id]);
        // ProjectUser::create(
        //     ['project_id'=>$project_id],
        //     ['$user_id'=>$user_id],
        // );
        return redirect()->route('project.users', $project->id);

        // dd('success');
    }

    public function removeUser(Project $project, User $user)
    {
        $tasks = $project->tasks()
            ->with('users')
            ->whereHas('users', function ($query) use ($user) {
                $query->whereIn('users.id', $user->pluck('id'));
            })
            ->pluck('tasks.id');
        $ids = $tasks->toArray();
        $user->tasks()->detach($ids);
        $project->users()->detach($user->id);
        return redirect()->route('project.users', $project->id);
    }
}
