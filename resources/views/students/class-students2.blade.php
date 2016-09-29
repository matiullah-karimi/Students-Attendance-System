<div class="box">
    <div class="box-header">
<h2>Students Attendance</h2>
    </div>
    <div class="box-body">
        <table class="table table-condensed marginTop" id="students_table">
            <thead>
            <th>Name</th>
            <th>F/Name</th>
            <th>Status</th>
            </thead>

            <tbody>

            @foreach($students as $student)
                <tr>
                    <td>{{$student->name}}</td>
                    <td>{{$student->fname}}</td>
                    <input type="hidden" name="status[{{$student->id}}]" value="off" class="form-control">
                    <td><input type="checkbox" name="status[{{$student->id}}]" value="on" checked class="form-control"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <input type="submit" value="Submit" class="btn btn-success">
    </div>
</div>


