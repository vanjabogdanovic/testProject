<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration {

    public function up() {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->text('bio')->nullable();
            $table->string('img_url')->nullable();
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('profiles');
    }
}
