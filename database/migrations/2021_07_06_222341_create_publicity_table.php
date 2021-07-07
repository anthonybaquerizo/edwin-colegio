<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_create_id');
            $table->string('name', 100);
            $table->string('file_path', 100);
            $table->timestamps();
            $table->boolean('status');
            $table->foreign('user_create_id')
                ->references('id')
                ->on('user')
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
        Schema::dropIfExists('publicity');
    }
}
