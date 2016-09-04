
<table class="table table-responsive table-bordered marginTop" id="students_table">
    <thead>
    <th>Name</th>
    <th>F/Name</th>
    <th colspan="2">Status</th>
    </thead>

    <tbody>

    @foreach($students as $student)
        <tr>

            <td>{{$student->name}}</td>
            <td>{{$student->fname}}</td>
            <td><input type="hidden" name="status[{{$student->id}}]" value="off" class="form-control"></td>
            <td><input type="checkbox" name="status[{{$student->id}}]" value="on" checked class="form-control"></td>
        </tr>

    @endforeach

    </tbody>

</table>
    <input type="submit" value="Submit" class="btn btn-success">

