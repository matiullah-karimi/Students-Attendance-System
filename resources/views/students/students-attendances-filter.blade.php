<div class="box pre-scrollable noMargin">
    <div class="box-header">
        <b>class:</b> {{$class->name}}</br>
        <b>Subject:</b> {{$subject->name}}</div>
        <button data-toggle="modal" data-target="#updateProfile">Edit</button>
    <div class="box-body">

        <table class="table table-bordered table-responsive marginTop" bgcolor="white">
            <thead>
            <th>Name</th>
            <th>F/Name</th>
            @foreach($atts as $att)
                <th>
                        {{date('Y-m-d', strtotime($att->date))}}
                </th>
            @endforeach

            <th>Total Present</th>
            <th>Total Absent</th>
            <th>Status</th>

            </thead>

            <tbody>

            <?php $students = $class->students()->whereYear('class_student.created_at','=', date('Y'))->get();?>
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

{{--modal--}}
<div class="modal fade" id="updateProfile" role="dialog" aria-labelledby="updateProfile" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update Profile</h4>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <form action="{{url('users/updateProfile/'.Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <div class="input-group date" data-provide="datepicker-inline">
                        <input type="text" class="form-control datepicker" placeholder="Select Date" id="datepicker3" name="to">
                        <div class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger confirm" id="confirm">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(document).ajaxComplete(function(){
        $(".datepicker").datepicker();
    });

    $(document).ready(function(){
        $('#datepicker3').datepicker().on('changeDate', function(e){
            console.log("called");
            var classId = $('select[name=class]').val();
            var subjectId = $('select[name=subject]').val();

            var date = $('#datepicker1').val();

            $.ajax({
                url: '/edit-students-attendance/'+'{{$class->id}}'+'/'+'{{$subject->id}}}',
                data:{
                    date:date,
                },
                success:function(data){
                    console.log(data);
                    $('#students-atts').empty();
                    $('#students-atts').append(data);
                }
            });

        });
    });
</script>



