@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Tasks</h2>
                </div>
                <div class="pull-right py-3">
                    @role('Admin')
                        @can('task-create')
                            <a class="btn btn-success" href="{{ route('projects.tasks.create', $project->id) }}"> Create New Task </a>
                            <a class="btn btn-primary" href="{{ route('project.users', $project->id) }}"> Manage Users </a> <!-- Add this line -->
                        @endcan
                    @endrole

                    @can('task-activity')
                        <a class="btn btn-success" href="{{ route('tasks.activity') }}"> View Task Logs</a>
                    @endcan
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>Title</th>
                <th>Task Description</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Assigned To</th>
                <th>Sprint</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        @if ($task->status == 0)
                            Pending
                        @elseif ($task->status == 1)
                            In Review
                        @elseif ($task->status == 2)
                            Change Requested
                        @elseif ($task->status == 3)
                            Approved
                        @endif
                    </td>
                    <td>
                        @if ($task->priority == 'urgent')
                            <p class='text-danger'>{{ $task->priority }}</p>
                        @else
                            {{ $task->priority }}
                        @endif
                    </td>
                    <td>
                        @if ($task->users->isNotEmpty())
                            @foreach ($task->users as $user)
                                {{ $user->name }}
                            @endforeach
                        @else
                            <p class='text-info'>Not Assigned</p>
                        @endif

                    </td>
                    <td>
                        {{-- @dd($task)
                        @if (isset($task->sprints))
                            @foreach ($task->sprints as $item)
                                @if ($loop->first)
                                {{ $task->sprints }}
                      
                                @endif
                            @endforeach
                        @else
                            <p class='text-info'>None</p>
                        @endif --}}
                    </td>
                    <td>
                        @can('task-edit')
                            <a class="btn btn-primary"
                                href="{{ route('projects.tasks.edit', [$project->id, $task->id]) }}">Edit</a>
                        @endcan

                        @role('Admin')
                            <form action="{{ route('projects.tasks.destroy', [$project->id, $task->id]) }}" method="POST">
                                <a class="btn btn-info"
                                    href="{{ route('projects.tasks.show', [$project->id, $task->id]) }}">Assign</a>

                                @csrf
                                @method('DELETE')
                                @can('task-delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                @endcan
                            </form>
                        @endrole
                        {{-- <a class="btn btn-success" href="{{ route('tasks.', [$task->id]) }}">To Sprint</a> --}}

                        {{-- @if ($task->sprint) --}}
                        {{-- @endif --}}
                    </td>
                </tr>
            @endforeach
        </table>
        {{-- {{ $tasks->links() }} --}}
    </div>
@endsection
