@extends('layouts.master')
@section('content')


    <div class="container">
        <form action="{{url('students/'.$student->id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <input type="text" name="name" class="form-control controlWidth" placeholder="name" value="{{$student->name}}" required>
            </div>
            <div class="form-group">
                <input type="text" name="fname" class="form-control controlWidth" placeholder="father name" value="{{$student->fname}}" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Update">
            </div>
        </form>
    </div>

@endsection