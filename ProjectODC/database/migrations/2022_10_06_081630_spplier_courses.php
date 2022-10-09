<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Nette\Schema\Schema as SchemaSchema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SpplierCourses', function (Blueprint $table) {
            $table->unsignedBigInteger('supplierid');
            $table->unsignedBigInteger('CourseId');
            $table->integer('PriceOfCourse');
            $table->integer('ODCpaid');
            $table->foreign('supplierid')->references('IdSuppliers')->on('suppliers');
            $table->foreign('CourseId')->references('IdCourses')->on('courses');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
