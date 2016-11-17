<div class="box">
    <div class="box-header">
<h2><th>@lang('language.students-att')</th></h2>
    </div>
    <div class="box-body">
        <table class="table table-condensed marginTop" id="students_table">
            <thead>
            <th>@lang('language.name')</th>
            <th>@lang('language.f-name')</th>
            <th>@lang('language.Status')</th>
            </thead>

            <tbody>

            @foreach($students as $student)
                <tr>
                    <td>{{$student->name}}</td>
                    <td>{{$student->fname}}</td>
                    <input type="hidden" name="status[{{$student->id}}]" value="off" class="form-control">
                    <td><input type="checkbox" name="status[{{$student->id}}]" value="on" checked class="checkbox "></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <input type="submit" value="{{trans('language.submit')}}" class="btn btn-success">
    </div>
</div>


