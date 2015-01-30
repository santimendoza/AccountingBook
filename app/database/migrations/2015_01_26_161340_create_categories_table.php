<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

    public function up() {
        Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            // @superior_cat : Null si no es subcategoría. Si es una subcategoria, el id de la categoria superior
            $table->integer('superior_cat')->nullable();
            $table->integer('type'); // @type : 0. Earnings 1. Expenses
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('categories');
    }

}
