<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('post');
            $table->foreign('post')->references('id')->on('posts')->onDelete('cascade');
            $table->unsignedBigInteger('client');
            $table->foreign('client')->references('id')->on('clients')->onDelete('cascade');
            $table->text('content');
            $table->string('image')->nullable();
            $table->integer('parent_comment')->nullable();
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
        Schema::dropIfExists('comments');
    }
}
