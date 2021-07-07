<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_grade_id');
            $table->unsignedBigInteger('course_section_id');
            $table->unsignedBigInteger('course_period_id');
            $table->unsignedBigInteger('user_teacher_id');
            $table->string('code', 10);
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->boolean('status');
            $table->foreign('course_grade_id')
                ->references('id')
                ->on('course_grade')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('course_section_id')
                ->references('id')
                ->on('course_section')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('course_period_id')
                ->references('id')
                ->on('course_period')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('user_teacher_id')
                ->references('id')
                ->on('user')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course');
    }
}
