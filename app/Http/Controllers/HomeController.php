<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Clas;
use App\Http\Requests;
use App\Student;
use App\Subject;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacherId = Auth::user()->id;

        $teacher = User::find($teacherId);

        $students = Student::all();
        $teachers = User::all();
        $classes = Clas::all();
        $subjects = Subject::all();


        return view('home', compact('teacher', 'students', 'teachers', 'classes', 'subjects'));
    }

    public function storeResult(Request $request){

        $this->validate($request, [
            'class' => 'required|not_in:Select Class',
            'subject' => 'required|not_in:Select Subject'
        ]);

        $teacherId = Auth::user()->id;
        $subjectId = $request->get('subject');
        $classId = $request->get('class');

        $limit = Attendance::where('user_id', $teacherId)
            ->where('subject_id', $subjectId)
            ->where('class_id', $classId)
            ->where('date', date("Y/m/d"))
            ->get()->count();

        if ($limit <= 3) {

            $attendance = new Attendance();

            $attendance->subject_id = $subjectId;
            $attendance->user_id = $teacherId;
            $attendance->class_id = $classId;
            $attendance->date = Carbon::now();
            $attendance->save();

            $student_status = $request->get('status');

            foreach ($student_status as $key => $value) {

                $student = Student::find($key);
                if ($value == 'on') {
                    $value = 1;
                } else {
                    $value = 0;
                }
                $attendance->students()->attach($student->id, ['status' => $value]);

            }
        }else{
            return redirect('/home')->with('status', 'You can not take attendance more than three times in a day ');
        }
        return redirect()->back();
    }

    public function editStudentsAttendance (Request $request, $cId, $sId){

        $att = Attendance::where('user_id', Auth::user()->id)
            ->where('class_id', $cId)
            ->where('subject_id', $sId)
            ->where('date', $request->get('date'))->get();
        dd($att);
        //return $students;
    }

    public function ShowChart(){
        $classes = Clas::all();
       return view('showChart', compact('classes'));
    }
}
