<?php

namespace App\Http\Controllers;

use App\Student;
use App\Subject;
use App\Teacher;
use App\Clas;
use Illuminate\Http\Request;

use App\Http\Requests;

class subjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        return view('Subject/createSubject');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = new Subject();

        $subject->name = $request->get('name');
        $subject->save();

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
        $subject = Subject::find($id);
        $subject->delete();

        return redirect('subjects');
    }

    public function assignStd($id){

        $teachers = Teacher::all();
        $classes = Clas::all();
        $subject = Subject::find($id);

        return view('Subject/assignStudents', compact('teachers', 'classes', 'subject'));
    }

    public function saveStudents(Request $request){

        $teacher = $request->get('teacher');
        $class = $request->get('class');

        $i = 0;
        foreach ($request->get('name') as $studentName){
            $student = new Student();
            $student->name = $studentName[0];
            $student->fname = $request->get('fname')[$i++][0];
            $student->save();
        }
        return redirect()->back();

    }
}
