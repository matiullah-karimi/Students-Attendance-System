<form action="{{ url('storeResult') }}" method="POST">
    <input type="hidden" name="_token" value="{{csrf_token()}}">

<table class="table table-responsive table-bordered marginTop" id="students_table">
    <thead>
    <th>Name</th>
    <th>F/Name</th>
    <th colspan="2">Status</th>
    </thead>

    <tbody>

    @foreach($students as $student)
        <tr>

            <td>{{$student->name}} <input type="hidden" value="{{$student->id}}" name="id[{{0}}][]"></td>
            <td>{{$student->fname}}</td>
            <td><input type="checkbox" name="status[{{0}}][]" checked class="form-control"></td>

        </tr>

    @endforeach

    </tbody>

</table>
    <input type="submit" value="Submit" class="btn btn-success">

</form>