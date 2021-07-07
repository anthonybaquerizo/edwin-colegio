<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_resource', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('resource_id');
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->string('file_path', 100);
            $table->timestamps();
            $table->boolean('status');
            $table->foreign('course_id')
                ->references('id')
                ->on('course')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('resource_id')
                ->references('id')
                ->on('course_resource')
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
        Schema::dropIfExists('course_resource');
    }
}
