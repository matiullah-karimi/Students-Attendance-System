<?php

namespace App\Http\Controllers\Api;

use App\Clas;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class apiController extends Controller
{

    public function index(){
        $teacher = User::find(Auth::user()->id);
        $classes = $teacher->classes;

        return response()->json($classes);
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
        return response()->json(compact('token'));
    }

    public function teacherClassSubjects($id)
    {
        $teacher = User::find(Auth::user()->id);
        $class = Clas::find($id);
        $subjects = $class->subjects;
        $teacherSubjects = array();
        foreach ($subjects as $subject)
        {
            $subject_user = $teacher->subjects()->where('subject_id', $subject->id)->get();
            $teacherSubjects[] = $subject_user;
        }


        return response()->json($teacherSubjects);
    }

    public function classStudents ($id)
    {
        $class = Clas::find($id);
        $students = $class->students;

        return response()->json($students);
    }

}
