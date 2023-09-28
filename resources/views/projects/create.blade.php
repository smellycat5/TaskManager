@extends('layouts.app')

@section('content')
<div class='container'>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Project</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('projects.index') }}"> Back </a>
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

<form action="{{ route('projects.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Project Name:</strong>
                <input type="text" name="name" placeholder="Project Name" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Client Name:</strong>
                <input type="text" name="client_name" placeholder="Client Name" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Client Email:</strong>
                <input type="email" name="client_email" placeholder="Client Email" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
</div>

@endsection
