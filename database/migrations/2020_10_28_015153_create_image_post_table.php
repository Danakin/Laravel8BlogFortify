<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('image_id')->index();
            $table
                ->foreign('image_id')
                ->references('id')
                ->on('images')
                ->onDelete('CASCADE');
            $table->unsignedBigInteger('post_id')->index();
            $table
                ->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('CASCADE');
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
        Schema::dropIfExists('image_post');
    }
}
