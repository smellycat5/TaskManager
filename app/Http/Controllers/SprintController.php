<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sprint;
use App\Models\Project;

class SprintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        dd($project);
        // $sprints = Sprint::with('tasks')->where('project_id'= $project->id)->get();
        return view('sprints.index', compact('sprints'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        return view('sprints.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $project)
    {
        $data = $request->count;
        $duration = $request->duration;
        $start = now();
        $sprints = []; // Initialize an empty array to store sprint data

        for ($i = 0; $i < $data; $i++) {
            $end = $start->copy()->addWeeks($duration);
            $sprint = [
                'start_time' => $start,
                'end_time' => $end,
            ];
            $sprints[] = $sprint; // Push each sprint data into the $sprints array
            $start = $end;
        }
        Project::find($project)->sprints()->createMany($sprints);
        dd($sprints);
    }


    /**
     * Display the specified resource.
     */
    public function show(Sprint $sprint)
    {
        $sprints = Sprint::with('tasks')->get();
        return view('sprints.index', compact('sprints'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
