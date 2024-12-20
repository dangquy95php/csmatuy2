@extends('layouts.template')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header">User
                @can('role-create')
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('team.index') }}">Back</a>
                    </span>
                @endcan
            </div>
            <div class="card-body">
                <div class="lead">
                    <strong>Name:</strong>
                   
                </div>
                <div class="lead">
                    <strong>Email:</strong>
                  
                </div>
                <div class="lead">
                    <strong>Password:</strong>
                    ********
                </div>
            </div>
        </div>
    </div>
</div>
@endsection