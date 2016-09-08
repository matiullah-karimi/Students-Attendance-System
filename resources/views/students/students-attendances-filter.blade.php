<table class="table table-bordered table-responsive marginTop">

    <thead>
    <th>Name</th>
    <th>F/Name</th>

    @foreach($atts as $att)
        <th>{{$att->date}}</th>
    @endforeach

    </thead>

    <tbody>
        <?php $students = $class->students ?>
        @foreach($students as $student)

            <tr>
                <td>{{$student->name}}</td>
                <td>{{$student->fname}}</td>
            @foreach($atts as $att)
                <?php $student_attendance = $student->attendances()->where('attendance_id', $att->id)->first(); ?>
                @if(count($student_attendance) >0 )
                    @if($student_attendance->pivot->status == 1)

                            <td><i class="glyphicon glyphicon-ok"></i></td>
                        @else
                            <td><i class="glyphicon glyphicon-remove"></i></td>
                        @endif
                    @endif
            @endforeach

        </tr>
    @endforeach


    </tbody>
</table>