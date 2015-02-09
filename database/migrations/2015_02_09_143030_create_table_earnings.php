<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEarnings extends Migration {

    public function up() {
        Schema::create('earnings', function(Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->text('description')->nullable();
            $table->string('date', 8);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('earningsCategory_id')->unsigned();
            $table->foreign('earningsCategory_id')->references('id')->on('earningsCategories');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('earnings');
    }

}
