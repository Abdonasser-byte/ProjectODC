<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{


public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('Fname');
            $table->string('Lname');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('admin');
            $table->boolean('adminadmin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
