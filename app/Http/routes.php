<?php



Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index');
    Route::resource('teachers', 'teacherController');
    Route::resource('subjects', 'subjectController');
    Route::get('subjects/assignStd/{id}', 'subjectController@assignStd');
    Route::post('subjects/saveStudents', 'subjectController@saveStudents');


});

Route::auth();