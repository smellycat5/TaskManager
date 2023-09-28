@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New Sprints</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('projects.index') }}"> Back to Projects</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Something went wrong.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sprints.store2',$project->id)}}" method="POST">
        @csrf
        <div class="row">
            <!-- Disabled Project Name Field -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Project Name:</strong>
                    <input type="text" name="project_id" class="form-control" value="{{ $project->id }}" placeholder="{{ $project->name }}" disabled  >
                </div>
            </div>

            <!-- Sprint Duration Field -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Duration (in weeks):</strong>
                    <input type="number" name="duration" placeholder="Duration" class="form-control">
                </div>
            </div>

            <!-- Sprint Count Field -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Count:</strong>
                    <input type="number" name="count" placeholder="Count" class="form-control">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
