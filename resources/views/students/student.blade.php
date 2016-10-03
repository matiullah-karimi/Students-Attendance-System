@extends('layouts.master')
@section('content')

<div class="container">

    <select name="class" class="center-block form-control controlWidth">

        <option>Filter Students by class</option>
        @foreach($classes as $class)
            <option value="{{$class->id}}"  id="classes">{{$class->name}}</option>
        @endforeach
    </select>

    <div id="class-students">

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
            <td><a href="{{url('students/'.$student->id.'/edit')}}" class="btn btn-info ">Edit</a></td>
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
        {!! $students->render()  !!}
    </div>

</div>

    @endsection


@section('page_specific_scripts')
    <script>

          $(function(){

              $('select[name="class"]').change(function(){
                  var id = $('select[name=class]').val();
                  $.ajax({
                      url:'students/filter/'+id,
                      success:function(data){
                          console.log(data)
                          $('#class-students').empty();
                          $('#class-students').append(data);
                      }
                  });
              });

          });

    </script>
    @endsection