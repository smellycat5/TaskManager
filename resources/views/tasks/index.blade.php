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
                        <a class="btn btn-success" href="{{ route('tasks.create') }}"> Create New Task </a>
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
                <th>Title</th> <!-- Add Title Section -->
                <th>Task Description</th>
                <th>Status</th>
                <th>Priority</th> <!-- Add Priority Section -->
                <th>Assigned To</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td> <!-- Display the title -->
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
                    <td>@if (($task->priority == 'urgent'))
                      
                        <p class='text-danger'>  {{ $task->priority }}</p>
                        @else
                        {{ $task->priority}}
                        @endif
                    </td> <!-- Display the priority -->
                    <td>
                        @if (isset($task->user->name))
                            {{ $task->user->name }}
                        @else
                            <p class='text-info'>Not Assigned</p>
                        @endif
                    </td>
                    <td>
                        @can('task-edit')
                            <a class="btn btn-primary" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                        @endcan

                        @role('Admin')
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('tasks.show', $task->id) }}">Assign</a>

                                @csrf
                                @method('DELETE')
                                @can('task-delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                @endcan
                            </form>
                        @endrole
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $tasks->links() }}
    </div>
@endsection
