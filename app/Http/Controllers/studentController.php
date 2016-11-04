<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Clas;
use App\Student;
use App\Subject;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role != 1) {
            return response()->view('errors.403');
        }
        $students = Student::paginate(10);
        $classes = Clas::all();

        return view('students/student', compact('students', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->role != 1) {
            return Response::HTTP_FORBIDDEN;
        }
        $student = Student::find($id);
        return view('students/edit-student', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role != 1) {
            return Response::HTTP_FORBIDDEN;
        }
        $student = Student::find($id);
        $student->name = $request->get('name');
        $student->fname = $request->get('fname');
        $student->update();

        return redirect('students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role != 1) {
            return Response::HTTP_FORBIDDEN;
        }

        $student = Student::find($id);
        $student->delete();;

        return redirect()->back();

    }

    public function filterStudents($id){

       $class = Clas::find($id);
        $students = $class->students;

        return view('students/class-students', compact('students'));
    }

    public function filterStudents2($id){

        $class = Clas::find($id);
        $students = $class->students()->whereYear('class_student.created_at','=', date('Y'))->get();

        return view('students/class-students2', compact('students'));
    }

    public function studentsAttendance(){

        $teacher_id = Auth::user()->id;
        $teacher = User::find($teacher_id);

        $classes = Clas::all();
        $subjects = Subject::all();


        return view('students/students-attendance', compact('teacher', 'classes', 'subjects'));
    }

    public function filterStudentsAttendance($id){

        $subject_id = Input::get('subId');
        $subject = Subject::find($subject_id);
        $class = Clas::find($id);
        $class_id = $id;


        $from = date('Y').'-3-22';
        $to = date('Y').'-12-22';

        if (Auth::user()->role == 0){
            $atts = Attendance::where('subject_id', $subject_id)->where('class_id', $id)
                ->where('user_id', Auth::user()->id)
                ->whereBetween('date', [$from, $to])->get();
        }
        else{
            $atts = Attendance::where('subject_id', $subject_id)->where('class_id', $id)
                ->whereBetween('date', [$from, $to])->get();
        }


        return view('students/students-attendances-filter', compact('atts', 'class', 'subject_id', 'class_id', 'subject'));
    }

    public function preStudents($id, $class_id)
    {
        $class = Clas::find($id);
        $students = $class->students()->whereYear('class_student.created_at','=', date('Y'))->get();

        return view('students/preStudents-filter', compact('students', 'class', 'class_id'));

    }

    public function assignPreStudents(Request $request, $id){

        $class = Clas::find($id);
        $students = $request->get('students');
        if (!empty($students) && is_array($students)) {
            foreach ($students as $student_id){
                $student = Student::find($student_id);
                $class->students()->attach($student);
            }
        }

        return redirect()->back();
    }

    public function filterByDate(Request $request, $id, $sid)
    {
        $class_id = $id;
        $subject_id = $sid;
        $class = Clas::find($class_id);
        $subject = Subject::find($subject_id);

        $from = date('Y-m-d', strtotime($request->get('from')));
        $to = date('Y-m-d', strtotime($request->get('to')));

        if (Auth::user()->role == 0){
            $atts = Attendance::where('subject_id', $sid)
                ->where('class_id', $id)
                ->where('user_id', Auth::user()->id)
                ->whereBetween('date', [$from, $to])->get();
        }
        else{
            $atts = Attendance::where('subject_id', $sid)->where('class_id', $id)
                ->whereBetween('date', [$from, $to])->get();
        }

        $students = $class->students()->whereBetween('class_student.created_at', [$from, $to])->get();
        //return $atts;
        return view('students/filter-by-date', compact('atts', 'class_id', 'subject_id', 'class', 'subject', 'from', 'to','students'));
    }



}
