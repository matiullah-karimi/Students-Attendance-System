<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

        dd($request->ge);

    }
}
