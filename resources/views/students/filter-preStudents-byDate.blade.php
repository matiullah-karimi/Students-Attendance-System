<form method="post" action="{{url('students/assign/preStudents/'.$id)}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="form-group">
        <select id="students" name="students[]" multiple="multiple" class="form-control controlWidth">
            @foreach($students as $student)
                <option value="{{$student->id}}">{{$student->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <input type="submit" value="Submit" class="btn btn-info">
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#students').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            buttonWidth: '400px'
        });
    });
</script>