<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCourseHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_course_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_course_id');
            $table->unsignedBigInteger('course_hours_id');
            $table->boolean('status');
            $table->foreign('user_course_id')
                ->references('id')
                ->on('user_course')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('course_hours_id')
                ->references('id')
                ->on('course_hours')
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
        Schema::dropIfExists('user_course_hours');
    }
}
