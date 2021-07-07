<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCoursePromTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_course_prom', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_course_id');
            $table->decimal('work_note1', 6, 2);
            $table->decimal('work_note2', 6, 2);
            $table->decimal('work_note3', 6, 2);
            $table->decimal('work_investigation', 6, 2);
            $table->decimal('final_exam', 6, 2);
            $table->decimal('prom_nt', 6, 2);
            $table->decimal('prom_ti', 6, 2);
            $table->decimal('prom_ef', 6, 2);
            $table->decimal('prom_final', 6, 2);
            $table->timestamps();
            $table->boolean('status');
            $table->foreign('user_course_id')
                ->references('id')
                ->on('user_course')
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
        Schema::dropIfExists('user_course_prom');
    }
}
