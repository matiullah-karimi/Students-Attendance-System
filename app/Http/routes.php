<?php



Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index');
    Route::resource('users', 'userController');
    Route::post('storeResult', 'HomeController@storeResult');
    Route::resource('subjects', 'subjectController');
    Route::get('subjects/assignStd/{id}', 'subjectController@assignStd');
    Route::post('subjects/saveStudents', 'subjectController@saveStudents');
    Route::resource('students', 'studentController');
    Route::get('students/filter/{id}', 'studentController@filterStudents');
    Route::get('students/filter2/{id}', 'studentController@filterStudents2');



});

Route::auth();