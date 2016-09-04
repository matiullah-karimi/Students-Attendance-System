<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_student', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attendance_id')->unsigned()->nullable();
            $table->integer('student_id')->unsigned()->nullable();
            $table->timestamps();
            $table->tinyInteger('status');

            $table->foreign('attendance_id')->references('id')->on('attendances')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attendance_student');
    }
}
