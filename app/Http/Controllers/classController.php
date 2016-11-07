<?php

namespace App\Http\Controllers;

use App\Clas;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class classController extends Controller
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
        $classes = Clas::all();
        return view('classes.classes', compact('classes'));
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
        return view('classes.create-class');
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
        $class_name = $request->get('name');

        if (!empty($class_name) && is_array($class_name)) {
            foreach ($class_name as $name) {
                $class = new Clas();
                $class->name = $name;
                $class->save();
            }
        }

        return redirect('classes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $class = Clas::find($id);
        return view('classes.edit-class', compact('class'));
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
        $class = Clas::find($id);
        $class->update ($request->all());
        return redirect('classes');

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
        $class = Clas::find($id);
        $class->delete();

        return redirect()->back();
    }

    public function AssignStudents($id)
    {
        if (Auth::user()->role != 1) {
            return response()->view('errors.403');
        }

        $class = Clas::find($id);
       // $classes = Clas::whereNotIn('id', [$class->id])->get() ;

        $classes = Clas::all();
        return view('classes.assign-students', compact('class', 'classes'));
    }

    public function saveClassStudents($id, Request $request)
    {
        if (Auth::user()->role != 1) {
            return response()->view('errors.403');
        }
        $class = Clas::find($id);
        $i = 0;
        foreach ($request->get('name') as $studentName){
            $student = new Student();
            $student->name = $studentName[0];
            $student->fname = $request->get('fname')[$i++][0];
            $student->save();

            $student->classes()->attach($class);
        }

        return redirect('classes');
    }
}
