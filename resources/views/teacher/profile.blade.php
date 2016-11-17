@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                        <h3 class="widget-user-username">{{Auth::user()->name}}</h3>
                        @if(Auth::user()->role == 0)
                        <h5 class="widget-user-desc">@lang('language.lecturer')</h5>
                        @else
                            <h5 class="widget-user-desc">@lang('language.admin')</h5>
                        @endif
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{asset('images/'.Auth::user()->image)}}" alt="User Avatar">
                    </div>
                    <div class="box-footer bg-red-active">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{count(Auth::user()->classes)}}</h5>
                                    <span class="description-text">@lang('language.classes')</span>
                                </div>
                                <!-- /.description-block -->
                            </div>

                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header"></h5>
                                    <span class="description-text"></span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->

                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{count(Auth::user()->subjects)}}</h5>
                                    <span class="description-text">@lang('language.subjects')</span>
                                </div>
                                <!-- /.description-block -->
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="box-body bg-orange-active">
                        <table class="table">
                            <tr>
                                <td>@lang('language.name')</td>
                                <td>{{Auth::user()->name}}</td>
                            </tr>

                            <tr>
                                <td>@lang('language.email')</td>
                                <td>{{Auth::user()->email}}</td>
                            </tr>
                            <tr>
                                <td>@lang('language.classes')</td>
                                <td>@foreach(Auth::user()->classes as $class)
                                    <ul>
                                        <li> {{$class->name}}</li>
                                    </ul>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('language.subjects')</td>
                                <td>@foreach(Auth::user()->subjects as $subject)
                                        <ul>
                                            <li> {{$subject->name}}</li>
                                        </ul>
                                    @endforeach
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" class="text-center">
                                    <button class="text-center fa fa-edit btn btn-success" data-toggle="modal" data-target="#updateProfile">@lang('language.edit')</button>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateProfile" role="dialog" aria-labelledby="updateProfile" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">@lang('language.update')</h4>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <form action="{{url('users/updateProfile/'.Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="form-group">
                            <input type="text" placeholder="name" name="name" class="form-control" value="{{Auth::user()->name}}" required>
                        </div>

                        <div class="form-group">
                            <input type="email" placeholder="email" name="email" class="form-control" value="{{Auth::user()->email}}" required>
                        </div>

                        <div class="form-group">
                            <input type="password" placeholder="password" name="password" class="form-control" value="" required>
                        </div>

                        <div class="form-group">
                            <input type="file" placeholder="image" name="image" class="form-control" value="{{asset('images/'.Auth::user()->image)}}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('language.cancel')</button>
                        <button type="submit" class="btn btn-danger confirm" id="confirm">@lang('language.update')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection