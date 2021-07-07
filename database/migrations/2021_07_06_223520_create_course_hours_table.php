<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->date('date');
            $table->time('hour_start');
            $table->time('hour_end');
            $table->boolean('status');
            $table->foreign('course_id')
                ->references('id')
                ->on('course')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_hours');
    }
}
