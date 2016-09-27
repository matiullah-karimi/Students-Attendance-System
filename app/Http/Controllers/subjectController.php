<?php

namespace App\Http\Controllers;

use App\Student;
use App\Subject;
use App\User;
use App\Clas;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class subjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role != 1) {
            return response()->view('errors.403');
        }
        $subjects = Subject::all();
        return view('Subject/subject', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role != 1) {
            return response()->view('errors.403');
        }
        $classes = Clas::all();
        return view('Subject/createSubject', compact('classes'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->role != 1) {
            return response()->view('errors.403');
        }
//        $this->validate($request, [
//            'class' => 'required|not_in:Select Class',
//        ]);

        $subject_name = $request->get('name');
        $classes = $request->get('classes');

        if (!empty($subject_name) && is_array($subject_name)) {
            foreach ($subject_name as $name) {
                $subject = new Subject();
                $subject->name = $name;
                $subject->save();

                if (!empty($classes) && is_array($classes)) {
                    foreach ($classes as $classId){
                        $class = Clas::find($classId);
                        $class->subjects()->attach($subject);
                    }
                }
            }
        }
        return redirect('/subjects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->role != 1) {
            return response()->view('errors.403');
        }
        $subject = Subject::find($id);
        return view('Subject/showSubject');
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
            return response()->view('errors.403');
        }
        $subject = Subject::find($id);
        return view('Subject/editSubject', compact('subject'));
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
            return response()->view('errors.403');
        }
        $subject = Subject::find($id);
        $subject->update($request->all());

        return redirect('subjects');
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
            return response()->view('errors.403');
        }
        $subject = Subject::find($id);
        $subject->delete();

        return redirect('subjects');
    }

    public function assignTeacher($id)
    {
        if (Auth::user()->role != 1) {
            return response()->view('errors.403');
        }

        $subjectTeachers = DB::table('subjects')
            ->join('subject_user', 'subjects.id', '=', 'subject_user.subject_id')
            ->join('users', 'subject_user.user_id', '=', 'users.id')
            ->where('subjects.id', '=', $id)
            ->select('users.id')->lists('id');

        $teachers = User::whereNotIn('id', $subjectTeachers)->where('users.role', '=', 0)->get();
        $subjectTeachers = User::whereIn('id', $subjectTeachers)->where('users.role', '=', 0)->get();

        $subject = Subject::find($id);

        return view('Subject/assignTeacher', compact('teachers', 'subject', 'subjectTeachers'));
    }

    public function saveSubjectTeacher(Request $request){
        if (Auth::user()->role != 1) {
            return response()->view('errors.403');
        }
        $this->validate($request, [
            'teacher' => 'required|not_in:Select Teacher',
        ]);
        // adding students to a class
        $class = $request->get('class');


        // adding subjects to a class
        $subject = $request->get('subject');
        $classModel = Clas::find($class);

        // adding teachers to a class
        $teacher = $request->get('teacher');
       // $classModel->teachers()->attach($teacher);

        $subjectT = Subject::find($subject);
        $subjectT->teachers()->attach($teacher);

        return redirect('subjects');
    }

    public function filterSubjects($id){

        $class = Clas::find($id);
        $teacher = User::find(Auth::user()->id);

        return view('Subject/filter-subjects', compact('class', 'teacher'));
    }
}
