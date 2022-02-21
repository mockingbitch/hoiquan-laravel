<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('posts');
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('title')->unique();
            $table->unsignedBigInteger('tag');
            $table->foreign('tag')->references('id')->on('tags')->onDelete('cascade');
            $table->unsignedBigInteger('client');
            $table->foreign('client')->references('id')->on('clients')->onDelete('cascade');
            $table->text('content');
            $table->string('slug');
            $table->string('featured_image')->nullable();
            $table->integer('status')->default(1);
            $table->integer('cheers')->default(0);
            $table->timestamps();
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
