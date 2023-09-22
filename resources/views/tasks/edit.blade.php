@extends('layouts.app')

@section('content')
    <div class='container'>

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Task</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('tasks.index') }}"> Back </a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Something went wrong.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Title:</strong>
                        <input type="text" name="title" value="{{ $task->title }}"
                            class="form-control" placeholder="Task Title">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Task Description:</strong>
                        <input type="text" name="description" value="{{ $task->description }}"
                            class="form-control" placeholder="Task Description">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Priority:</strong>
                        <select name="priority" class="form-control">
                            <option value="urgent" {{ $task->priority === 'urgent' ? 'selected' : '' }}>Urgent</option>
                            <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High</option>
                            <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Status:</strong>
                        <select name="status" class="form-control">
                            <option value="0" {{ $task->status === "0" ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ $task->status === "1" ? 'selected' : '' }}>In Review</option>
                            <option value="2" {{ $task->status === "2" ? 'selected' : '' }}>Change Requested</option>
                            <option value="3" {{ $task->status === "3" ? 'selected' : '' }}>Approved</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
