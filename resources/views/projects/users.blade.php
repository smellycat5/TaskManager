@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Manage Project Users</h2>

        <div class="row">
            <div class="col-md-6">
                <h4>Users in the Project</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projectUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <form action="{{ route('project.deleteUsers', [$project->id, $user->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h3>Users Not in the Project</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <form action="{{ route('project.addUsers', [$project->id, $user->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Add</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
