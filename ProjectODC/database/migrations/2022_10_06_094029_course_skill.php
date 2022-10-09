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
        Schema::create('CourseSkill', function (Blueprint $table) {
            $table->unsignedBigInteger('courseid');
            $table->unsignedBigInteger('skillid');
            $table->foreign('courseid')->references('IdCourses')->on('courses');
            $table->foreign('skillid')->references('IdSkills')->on('skills');
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
