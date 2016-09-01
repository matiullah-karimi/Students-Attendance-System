@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Attendance Dashboard</div>

                <div class="panel-body">
                    <a href="{{url('users')}}" class="btn btn-info">Teacher Entry</a>
                    <a href="{{url('subjects')}}" class="btn btn-info">Course Entry</a>
                    <a href="{{url('students')}}" class="btn btn-info">Students</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
