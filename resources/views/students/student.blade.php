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
                <a href="javascript:void(0)" id="{{ $student->id }}" class="btn btn-danger delete" onclick="confirm(this.id);">
                    Delete</a>
            </td>
        </tr>

            @endforeach
        </tbody>
    </table>
        {!! $students->render()  !!}
    </div>

</div>
@include('deleteModalConfirmation')
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

          function confirm(id){
              $('#confirmDelete').modal('show');
              <!-- Form confirm (yes/ok) handler, submits form -->
              $('.confirm').click(function(){
                  var url = '{{url('students/destroy')}}/'+id;
                  $('a.delete').attr('href', url);
              });

          };

    </script>
    @endsection