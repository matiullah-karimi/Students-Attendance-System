<table class="table table-bordered table-responsive">

    <thead>
    <th>Name</th>
    <th>F/Name</th>


    @foreach($atts as $att)
        <th>{{$att->date}}</th>
    @endforeach

    </thead>

    <tbody>

    @foreach($att->students as $student)
        <tr>
            <td>{{$student->name}}</td>
            <td>{{$student->fname}}</td>

            @foreach($student->attendances as $attendance)
                <td>{{$attendance->pivot->status}}</td>
            @endforeach

        </tr>
    @endforeach

    </tbody>
</table>