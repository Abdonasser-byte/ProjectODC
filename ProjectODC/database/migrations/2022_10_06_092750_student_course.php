<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StudentCourse', function (Blueprint $table) {
            $table->unsignedBigInteger('courseid');
            $table->unsignedBigInteger('studentid');
            $table->integer('taskdeleiverd');
            $table->integer('attendes');
            $table->boolean('finshed');
            $table->foreign('courseid')->references('IdCourses')->on('courses');
            $table->foreign('studentid')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
