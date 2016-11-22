<?php

namespace App\Http\Controllers\Api;

use App\Clas;
use App\Student;
use App\User;
use App\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class apiController extends Controller
{

    public function index(){
        $teacher = User::find(Auth::user()->id);
        $classes = $teacher->classes;

        return response()->json(compact("classes"));
    }

    public function products(){
        $teachers = User::all();
        return response()->json(compact('teachers'));
    }

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');


        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(['token' => $token, 'name' => Auth::user()->name, 'email' => Auth::user()->email, 'image' => Auth::user()->image]);
    }

    public function teacherClassSubjects($id)
    {
        $class = Clas::find($id);
        $teacherSubjects = collect();
        $subjects = $class->subjects;
        foreach($subjects as $subject){
            $teacherSubjects = $teacherSubjects->merge(Auth::user()->subjects()->where('subject_id', $subject->id)->get());
        }

            return response()->json(compact("teacherSubjects"));
    }

    public function classStudents ($id)
    {
        $class = Clas::find($id);
        $students = $class->students()->whereYear('class_student.created_at','=', date('Y'))->get();

        return response()->json(compact("students"));
    }

    public function saveResult($id, $subject_id,  Request $request)
    {
         $teacherId = Auth::user()->id;
         
        $subjectId = $subject_id;
        $classId = $id;

        $limit = Attendance::where('user_id', $teacherId)
            ->where('subject_id', $subjectId)
            ->where('class_id', $classId)
            ->where('date', date("Y/m/d"))
            ->get()->count();

        if ($limit <=3){
            $attendance = new Attendance();
            $attendance->subject_id = $subjectId;
            $attendance->user_id = $teacherId;
            $attendance->class_id = $classId;
            $attendance->date = Carbon::now();

            $attendance->save();

            $student_status = $request->get('results');

            foreach ($student_status as $key => $value){
                $student =  Student::find($key);
                $attendance->students()->attach($student->id, ['status' => $value]);
            }

            return response()->json(['message' => 'Successfully Submitted'], 200);
        }
        else {
            return response()->json(['message' => 'You can not take attendance more than 4 times in a day'], 200);
        }

    }

    public function TeacherClasses(){
        $classes = Auth::user()->classes()->get();

        return response()->json(compact('classes'));
    }
    public function TeacherSubjects(){
        $subjects = Auth::user()->subjects()->get();

        return response()->json(compact('subjects'));
    }

}
