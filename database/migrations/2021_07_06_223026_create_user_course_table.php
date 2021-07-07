<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->decimal('prom_1', 6,2);
            $table->decimal('prom_2', 6,2);
            $table->decimal('prom_3', 6,2);
            $table->decimal('prom_final', 6,2);
            $table->timestamps();
            $table->boolean('status');
            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('user_course');
    }
}
