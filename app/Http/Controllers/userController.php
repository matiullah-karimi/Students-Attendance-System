<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
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
            return Response::HTTP_FORBIDDEN;
        }

        $teachers = User::where('role', '=', 0)->get();

        return view('teacher/teacher')->with('teachers',$teachers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role != 1) {
            return Response::HTTP_FORBIDDEN;
        }
        return view('teacher/addTeacher');
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
            return Response::HTTP_FORBIDDEN;
        }
        $teacher = new User;

        $teacher->name = $request->get('name');
        $teacher->email = $request->get('email');
        $teacher->password = Hash::make($request->get('password'));
        $teacher->save();

        return redirect('users');
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
        $teacher = User::find($id);

        return view('teacher/editTeacher', compact('teacher'));
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

        $teacher = User::find($id);
        $teacher->name = $request->get('name');
        $teacher->email = $request->get('email');
        $teacher->password = Hash::make($request->get('password'));

        $teacher->update();

        return redirect('users');
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
        $teacher = User::find($id);
        $teacher->delete();

        return redirect('users');
    }

}
