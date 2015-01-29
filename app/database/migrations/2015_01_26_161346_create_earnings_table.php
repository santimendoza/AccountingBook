<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEarningsTable extends Migration {

    public function up() {
        Schema::create('earnings', function(Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->text('description')->nullable();
            $table->string('category');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('earnings');
    }

}
