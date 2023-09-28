@extends('layouts.app')

@section('content')
    <div class='container'>
        <h2>{{ $project->name }}</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sprint</th>
                    <th>Tasks</th>
                </tr>
            </thead>
            {{-- @dd($project) --}}
            <tbody>
                @foreach ($project->sprints as $sprint)
                    <tr>
                        <td>
                            Sprint ID: {{ $sprint->id }}<br>
                            Start Time: {{ $sprint->start_time }}<br>
                            End Time: {{ $sprint->end_time }}<br>
                            <!-- Sprint-related information -->
                        </td>
                        <td>
                            <ul>
                                @foreach ($sprint->tasks as $task)
                                    <li>
                                        Task ID: {{ $task->id }}<br>
                                        Title: {{ $task->title }}<br>
                                        <!-- Task-related information -->
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
