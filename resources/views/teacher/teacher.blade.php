@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('language.teachers')</div>

                    <div class="panel-body">
                        <a href="{{url('users/create')}}" class="btn btn-success">@lang('language.create-teacher')</a>

                        <table class="table table-bordered table-responsive marginTop">
                            <thead>
                            <th>@lang('language.name')</th>
                            <th>@lang('language.email')</th>
                            <th>@lang('language.assign-classes')</th>
                            <th colspan="2">@lang('language.actions')</th>
                            </thead>

                            <tbody>

                                @foreach($teachers as $teacher)
                                    <tr>

                                <td>{{$teacher->name}}</td>
                                <td>{{$teacher->email}}</td>
                                <td><a href="{{url('users/assignClasses/'.$teacher->id)}}" class="btn btn-warning">@lang('language.assign-classes')</a></td>
                                    <td> <a href="{{url('users/'.$teacher->id.'/edit')}}"  value="Edit" class="btn btn-info btn-group-sm">@lang('language.edit')</a></td>

                                    <td>
                                        <a href="javascript:void(0)" id="{{ $teacher->id }}" class="btn btn-danger delete" onclick="confirm(this.id);">
                                            @lang('language.delete')</a>
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

    <script>
        function confirm(id){
            $('#confirmDelete').modal('show');
            <!-- Form confirm (yes/ok) handler, submits form -->
            $('.confirm').click(function(){
                var url = '{{url('users/destroy')}}/'+id;
                $('a.delete').attr('href', url);
            });

        };
    </script>

@endsection