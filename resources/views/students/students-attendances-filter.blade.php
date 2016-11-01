<div class="box scrollbox pre-scrollable">
    <div class="box-header"><b>class:</b> {{$class->name}}</br>
        <b>Subject:</b> {{$subject->name}}</div>
    <div class="box-body">


        <table class="table table-bordered table-responsive marginTop" bgcolor="white">
            <thead>
            <th>Name</th>
            <th>F/Name</th>
            @foreach($atts as $att)
                <th>{{$att->date}}</th>
            @endforeach

            <th>Total Present</th>
            <th>Total Absent</th>
            <th>Status</th>

            </thead>

            <tbody>
            <?php $students = $class->students ?>
            @foreach($students as $student)

                <tr>
                    <td>{{$student->name}}</td>
                    <td>{{$student->fname}}</td>
                    @foreach($atts as $att)
                        <?php $student_attendance = $student->attendances()->where('attendance_id', $att->id)->first(); ?>
                        @if(count($student_attendance) > 0 )
                            @if($student_attendance->pivot->status == 1)
                                <td><i class="glyphicon glyphicon-ok"></i></td>
                            @else
                                <td><i class="glyphicon glyphicon-remove"></i></td>
                            @endif
                        @else
                            <td>N/A</td>
                        @endif

                    @endforeach


                    <?php $present = $student->attendances()->where('subject_id', $subject_id)->where('class_id', $class_id)
                            ->having('status', '>', 0)->get()->count();?>
                    <?php $absent = $student->attendances()->where('subject_id', $subject_id)->where('class_id', $class_id)
                            ->where('subject_id', $subject_id)->having('status', '=', 0)->get()->count();?>
                    <td><?php echo $present?></td>
                    <td><?php echo $absent?></td>
                    <td><?php if ($absent > (($present+$absent)/4)){
                            echo 'Fail';
                            }
                            else{
                                echo 'Pass';
                            }
                         ?></td>

                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
</div>

