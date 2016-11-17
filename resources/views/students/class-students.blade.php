<table class="table table-condensed table-responsive table-bordered marginTop" id="students_table">
    <thead>
    <th>@lang('language.name')</th>
    <th>@lang('language.f-name')</th>
    <th colspan="2">@lang('language.actions')</th>
    </thead>

    <tbody>

    @foreach($students as $student)
        <tr>

            <td>{{$student->name}}</td>
            <td>{{$student->fname}}</td>
            <td><a href="#" class=" btn btn-info">@lang('language.edit')</a></td>
            <td>
                <form method="post" action="{{url('students/'.$student->id)}}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <input type="submit" class="btn btn-danger" value="{{trans('language.delete')}}">

                </form>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>