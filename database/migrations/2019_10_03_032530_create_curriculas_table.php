<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('level');
            $table->integer('course_data');
            $table->integer('report');
            $table->integer('compulsory');
            $table->dateTime('deadline');
            $table->mediumText('remark');
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
        Schema::dropIfExists('curriculas');
    }
}
