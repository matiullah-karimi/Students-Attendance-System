@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <form action="{{url('users/'.$teacher->id)}}" method="post">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-group">
                                <input type="text" placeholder="name" name="name" class="form-control" value="{{$teacher->name}}">
                            </div>

                            <div class="form-group">
                                <input type="text" placeholder="email" name="email" class="form-control" value="{{$teacher->email}}">
                            </div>

                            <div class="form-group">
                                <input type="password" placeholder="password" name="password" class="form-control" value="{{$teacher->password}}">
                            </div>

                            <div class="form-group">
                                <input type="submit"  class="btn btn-danger" >
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection