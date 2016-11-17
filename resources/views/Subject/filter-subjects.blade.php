<select name="subject" onchange="filterSubjects()" class="form-control">
    <option>@lang('language.select-subject')</option>
    <?php $subjects = $class->subjects?>
    @foreach($subjects as $subject)
        @if($teacher->role == 0)
        <?php $subject_user = $teacher->subjects()->where('subject_id', $subject->id)->get();?>
    @foreach($subject_user as $sub)
        <option value="{{$sub->id}}"> {{$sub->name}} </option>
        @endforeach
        @else
            <option value="{{$subject->id}}">{{$subject->name}}</option>
        @endif
    @endforeach
</select>
