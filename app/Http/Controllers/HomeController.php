<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Clas;
use App\Http\Requests;
use App\Student;
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

        return view('home', compact('teacher', 'students'));
    }

    public function storeResult(Request $request){

        $teacherId = Auth::user()->id;
        $subjectId = $request->get('subject');
        $classId = $request->get('class');

        $attendance = new Attendance();

        $attendance->subject_id = $subjectId;
        $attendance->user_id = $teacherId;
        $attendance->class_id = $classId;
        $attendance->date = Carbon::now();
        $attendance->save();

        $student_status = $request->get('status');

        foreach ($student_status as $key => $value){

            $student =  Student::find($key);
            if($value == 'on'){
                $value = 1;
            }else{
                $value = 0;
            }
            $attendance->students()->attach($student->id, ['status' => $value]);

        }
        return redirect()->back();
    }

    public function export2Excel(){

        Excel::create('New file', function($excel) {

            $excel->sheet('New sheet', function($sheet) {
                $classes = Clas::all();
                
//                $sheet->loadView('students.students-attendance', compact('classes'));

            });

        })->download('xls');
    }
}
