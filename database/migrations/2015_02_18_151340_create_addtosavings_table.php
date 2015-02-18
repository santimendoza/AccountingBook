<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddtosavingsTable extends Migration {

    public function up() {
        Schema::create('addtosavings', function(Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->string('date', 8);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('savings_id')->unsigned();
            $table->foreign('savings_id')->references('id')->on('savings');
            $table->timestamps();
        });
    }

    public function down() {
        Schem::drop('addtosavings');
    }

}
