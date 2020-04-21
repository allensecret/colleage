<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sn');
            $table->string('title');
            $table->string('separation');
            $table->integer('ep');
            $table->integer('start_ep');
            $table->integer('end_ep');
            $table->string('type');
            $table->string('teacher');
            $table->mediumText('introduction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_data');
    }
}
