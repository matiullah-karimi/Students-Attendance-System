<table class="table table-responsive table-bordered marginTop" id="students_table">
    <thead>
    <th>Name</th>
    <th>F/Name</th>
    <th colspan="2">Actions</th>
    </thead>

    <tbody>



    @foreach($students as $student)
        <tr>

            <td>{{$student->name}}</td>
            <td>{{$student->fname}}</td>
            <td><a href="#" class=" btn btn-info">Edit</a></td>
            <td>
                <form method="post" action="{{url('students/'.$student->id)}}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <input type="submit" class="btn btn-danger" value="Delete">

                </form>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>