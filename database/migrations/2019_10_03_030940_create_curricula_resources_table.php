<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculaResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curricula_resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_data');
            $table->integer('media');
            $table->integer('ep');
            $table->string('type');
            $table->string('attr');
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
        Schema::dropIfExists('curricula_resources');
    }
}
