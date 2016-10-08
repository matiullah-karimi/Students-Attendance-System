<?php

namespace App\Http\Controllers;

use App\Clas;
use Faker\Provider\Image;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            return response()->view('errors.403');
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
            return response()->view('errors.403');
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

    public function assignClasses($id)
    {
        $teacher = User::find($id);

        $teacherClasses = DB::table('users')
            ->join('class_user', 'users.id', '=', 'class_user.user_id')
            ->join('classes', 'class_user.class_id', '=', 'classes.id')
            ->where('users.id', '=', $teacher->id)
            ->select('classes.id')->lists('id');

        $classes = Clas::whereNotIn('id', $teacherClasses)->get();

        $allClasses = Clas::whereIn('id', $teacherClasses)->get();


        return view('teacher.assign-classes', compact('teacher', 'classes', 'allClasses'));
    }

    public function saveTeacherClasses($id, Request $request)
    {

//        $this->validate($request, [
//            'class' => 'required|not_in:None selected',
//        ]);
        $teacher = User::find($id);

        $classes = $request->get('classes');
        if (!empty($classes) && is_array($classes)) {
            foreach ($classes as $classId){
                $class = Clas::find($classId);
                $class->teachers()->attach($teacher);
            }
        }

        return redirect('users');
    }

    public function profile($id)
    {
        return view('teacher/profile');
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);
        $name = $request->get('name');
        $email = $request->get('email');
        $password = \Hash::make($request->get('password'));

        $image = $request->file('image');
        $filename  = time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/images/' . $filename);
        Image::make($image->getRealPath())->resize(200, 200)->save($path);
        
        $user = User::find($id);
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->image = $filename;
        $user->update();

    }
}
