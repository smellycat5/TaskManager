@extends('layouts.app')

@section('content')
    <div class='container'>

        <form action="{{ route('tasks.assign', [$project->id,$task->id]) }}" method="POST">
            @csrf

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Assign To:</strong>
                    <select name="user_id" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center py-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <form action="{{ route('tasks.toSprint', $task->id) }}" method="POST">
            @csrf

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Assign To Sprint:</strong>
                    <select name="sprint_id" class="form-control">
                        @foreach ($sprints as $sprint)
                            <option value="{{ $sprint->id }}">
                                Sprint ID: {{ $sprint->id }} - Start Time: {{ $sprint->start_time }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center py-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
