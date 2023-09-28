@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Projects</h2>
            </div>
            <div class="pull-right py-4">
                {{-- @can('project-create') --}}
                    <a class="btn btn-success" href="{{ route('projects.create') }}"> Create New Project </a>
                {{-- @endcan --}}

                <!-- You can add other buttons or links here as needed -->
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
            <th>Project Name</th>
            <th>Client Name</th>
            <th>Client Email</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($projects as $project)
    <tr>
        <td>{{ $project->name }}</td>
        <td>{{ $project->client_name }}</td>
        <td>{{ $project->client_email }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('projects.show', $project->id) }}">Show</a>

            <!-- Edit Button -->
            <a class="btn btn-primary" href="{{ route('projects.edit', $project->id) }}">Edit</a>

            <!-- Tasks Button -->
            <a class="btn btn-success" href="{{ route('projects.tasks.index', $project->id) }}">Tasks</a>

            <!-- Delete Button -->
            <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
@endforeach
    </table>
    {{-- {{ $projects->links() }} --}}
</div>
@endsection
