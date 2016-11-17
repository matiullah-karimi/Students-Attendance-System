<?php

Route::group(['middleware' => ['auth']], function () {
Route::get('language/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect()->back();
});

    Route::group(['middleware' => \App\Http\Middleware\SetLocale::class], function(){
        Route::get('/home', 'HomeController@index');

        Route::resource('classes', 'classController');
        Route::get('classes/destroy/{id}', 'classController@destroy');
        Route::get('classes/assignStudents/{id}', 'classController@assignStudents');
        Route::post('classes/saveClassStudents/{id}', 'classController@saveClassStudents');

        Route::resource('users', 'userController');
        Route::get('users/assignClasses/{id}', 'userController@assignClasses');
        Route::post('users/saveTeacherClasses/{id}', 'userController@saveTeacherClasses');
        Route::post('storeResult', 'HomeController@storeResult');
        Route::get('users/destroy/{id}', 'userController@destroy');
        Route::get('users/profile/{id}', 'userController@profile');
        Route::post('users/updateProfile/{id}', 'userController@updateProfile');
        Route::get('users/remove-classes/{cId}/{tId}', 'userController@removeTeacherClasses');

        Route::resource('subjects', 'subjectController');
        Route::get('subjects/assignTeacher/{id}', 'subjectController@assignTeacher');
        Route::post('subjects/saveSubjectTeacher', 'subjectController@saveSubjectTeacher');
        Route::get('subjects/filterSubject/{id}', 'subjectController@filterSubjects');
        Route::get('subjects/destroy/{id}', 'subjectController@destroy');
        Route::get('subjects/remove-teacher/{sid}/{tid}', 'subjectController@removeSubjectTeacher');
        Route::get('subjects/remove-class/{sid}/{cid}', 'subjectController@removeSubjectClass');

        Route::resource('students', 'studentController');
        Route::get('students/filter/{id}', 'studentController@filterStudents');
        Route::get('students/filter/preStudents/{id}/{class_id}', 'studentController@preStudents');
        Route::post('students/assign/preStudents/{id}', 'studentController@assignPreStudents');
        Route::get('students/filter2/{id}', 'studentController@filterStudents2');
        Route::get('student/filter3/{id}', 'studentController@filterStudentsAttendance');
        Route::get('student/attendance', 'studentController@studentsAttendance');
        Route::get('students/destroy/{id}', 'studentController@destroy');
        Route::get('students/date/filter/{id}/{sid}', 'studentController@filterByDate');
        Route::get('students/filter-preStudents-by-date/{sid}', 'studentController@filterPreStudentsByDate');
        Route::get('edit-students-attendance/{cId}/{sId}', 'HomeController@editStudentsAttendance');


        Route::get('showChart', 'HomeController@showChart');

    });
});


Route::auth();

Route::group(['namespace' => 'Api', 'prefix' => 'api'], function()
{
    Route::group(['middleware' => ['jwt.auth']], function(){
        Route::get('teacher', 'apiController@index');
        Route::get('teacher/classSubjects/{id}', 'apiController@teacherClassSubjects');
        Route::get('teacher/classStudents/{id}', 'apiController@classStudents');
        Route::post('teacher/saveResult/{id}/{subjec_id}', 'apiController@saveResult');
        Route::get('teacher/classes', 'apiController@TeacherClasses');
        Route::get('teacher/subjects', 'apiController@TeacherSubjects');
    });

    Route::post('teacher/login', 'apiController@authenticate');
});
