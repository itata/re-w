<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('post_title');
            $table->string('post_type');
            $table->longtext('post_content')->nullable();
            $table->text('post_image')->nullable();
            $table->string('post_status');
            $table->integer('post_author')->unsigned();
            $table->integer('categoryID')->unsigned();
            $table->timestamps();
            $table->foreign('post_author')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('categoryID')->references('id')->on('categoires')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
