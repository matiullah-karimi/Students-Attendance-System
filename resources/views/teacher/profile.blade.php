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
                        @if(Auth::user()->role = 0)
                        <h5 class="widget-user-desc">Lecturer</h5>
                        @else
                            <h5 class="widget-user-desc">Admin</h5>
                        @endif
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{asset('images/avatar5.png')}}" alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{count(Auth::user()->classes)}}</h5>
                                    <span class="description-text">CLASSES</span>
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
                                    <span class="description-text">SUBJECTS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="box-body">
                        Hello
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>
    </div>
@endsection