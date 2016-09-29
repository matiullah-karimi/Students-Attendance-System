@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

                @if(Auth::user()->role != 1)

                        <form action="{{ url('storeResult') }}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <select name="class" class="form-control controlWidth">
                                <option>Select Class</option>
                                @foreach($teacher->classes as $class)
                                    <option value="{{$class->id}}" id="classes" >{{$class->name}}</option>

                                @endforeach
                            </select>

                            <div id="teacher-subject" class="marginTop"></div>

                            <div id="class-students"></div>

                        </form>

                    @else

                    <div class="row">

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Students</span>
                                    <span class="info-box-number">1,410</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Teachers</span>
                                    <span class="info-box-number">1,410</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-orange"><i class="fa fa-th"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Classes</span>
                                    <span class="info-box-number">1,410</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-book"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Subjects</span>
                                    <span class="info-box-number">1,410</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                    </div>

                    @endif




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
    </div>
</div>
@endsection

@section('page_specific_scripts')
    <script>

        $(function(){

            $('select[name="class"]').change(function(){
                var id = $('select[name=class]').val();
                $.ajax({
                    url:'students/filter2/'+id,
                    success:function(data){
                        console.log(data)
                        $('#class-students').empty();
                        $('#class-students').append(data);
                    }
                });

                $.ajax({
                    url:'subjects/filterSubject/'+id,
                    success:function(data){
                        console.log(data)
                        $('#teacher-subject').empty();
                        $('#teacher-subject').append(data);
                    }
                });
            });

        })

    </script>
@endsection
