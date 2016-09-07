@extends('layouts.app')
@section('page_specific_styles')
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Teachers</div>

                    <div class="panel-body">
                        <a href="{{url('users/create')}}" class="btn btn-lg btn-success">Add Teacher</a>

                        <table class="table table-bordered table-responsive marginTop">
                            <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th colspan="2">Actions</th>
                            </thead>

                            <tbody>

                                @foreach($teachers as $teacher)
                                    <tr>

                                <td>{{$teacher->name}}</td>
                                <td>{{$teacher->email}}</td>
                                    <td> <a href="{{url('users/'.$teacher->id.'/edit')}}"  value="Edit" class="btn btn-info btn-group-sm "> Edit</a> </td>

                                    <td>
                                        <form action="{{url('users/'.$teacher->id)}}" method="post" id="{{$teacher->id}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="form-group">

                                                <button class="btn btn-danger" type="submit">Delete</button>
                                                {{--<button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">--}}
                                                    {{--Delete</button>--}}

                                            </div>
                                        </form>
                                    </td>
                            </tr>

                                    @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


  @include('deleteModalConfirmation')
@endsection

@section('page_specific_scripts')


{{--<script>--}}


    {{--<!-- Form confirm (yes/ok) handler, submits form -->--}}
    {{--$('#confirm').click(function(){--}}

        {{--var id = $('form').attr("id");--}}

        {{--window.location = "http://localhost:8000/teachers/"+id;--}}
       {{--// $('form').submit();--}}
    {{--});--}}

{{--</script>--}}

@stop