@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Teacher</div>

                    <div class="panel-body">
                        <form method="post" action="{{ url('teachers') }}">
                            <input type="hidden" value="{{csrf_token()}}" name="_token">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="text" class="form-control" name="email">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-danger">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection