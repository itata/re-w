<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnjoysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enjoys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('enjoy_name');
            $table->string('enjoy_address');
            $table->string('enjoy_phone');
            $table->bigInteger('enjoy_damge');
            $table->integer('postID')->unsigned();
            $table->integer('userID')->unsigned();
            $table->timestamps();
            $table->foreign('postID')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enjoys');
    }
}
