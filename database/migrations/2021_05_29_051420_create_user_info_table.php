<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();
            $table->string('dni', 8);
            $table->string('names');
            $table->string('last_name')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('photo_path', 100)->nullable();
            $table->char('gender', 1);
            $table->timestamps();
            $table->boolean('status')->default(1);
            $table->foreign('user_id')
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
        Schema::dropIfExists('user_info');
    }
}
