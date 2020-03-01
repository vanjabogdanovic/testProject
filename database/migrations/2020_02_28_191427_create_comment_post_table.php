<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentPostTable extends Migration {

    public function up() {
        Schema::create('comment_post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('post_id');
            $table->integer('category_id');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('comment_post');
    }
}
