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
            return Response::HTTP_FORBIDDEN;
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
        $students = $class->students;

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
        $class = Clas::find($id);


        if (Auth::user()->role == 0){
            $atts = Attendance::where('subject_id', $subject_id)->where('class_id', $id)
                ->where('user_id', Auth::user()->id)->get();
        }
        else{
            $atts = Attendance::where('subject_id', $subject_id)->where('class_id', $id)->get();
        }


        return view('students/students-attendances-filter', compact('atts', 'class', 'subject_id'));
    }


}
