@extends('layouts.app')
@section('content')


    <div class="container">

        <form action="{{ url('storeResult') }}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <select name="class">
                <option>Select Class</option>
                @foreach($teacher->classes as $class)
                    <option value="{{$class->id}}" id="classes" >{{$class->name}}</option>

                @endforeach
            </select>

            <select name="subject">
                <option>Select Subject</option>
                @foreach($teacher->subjects as $subject)
                    <option value="{{$subject->id}}"> {{$subject->name}} </option>
                @endforeach
            </select>
            <div id="class-students">




            </div>

        </form>

        <table class="table table-bordered table-responsive">

            <thead>
            <th>Name</th>
            <th>F/Name</th>

            <?php
            for ($i= 1; $i<= 30; $i++){
                echo '<th>'.$i.'</th>';
            }
            ?>
            </thead>

        </table>

    </div>




@endsection