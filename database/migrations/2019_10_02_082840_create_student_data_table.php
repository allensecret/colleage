<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student');
            $table->string('name');
            $table->string('dharma_name')->nullable();
            $table->string('gender');
            $table->string('nationality');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('language')->nullable();
            $table->string('fax')->nullable();
            $table->string('job')->nullable();
            $table->string('skill')->nullable();
            $table->string('volunteer')->nullable();
            $table->integer('course_level');
            $table->integer('stay_in_school');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_data');
    }
}
