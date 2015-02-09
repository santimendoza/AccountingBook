<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEarningsCategories extends Migration {

    public function up() {
        Schema::create('earningsCategories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            // @superior_cat : Null si no es subcategoría. Si es una subcategoria, el id de la categoria superior
            $table->integer('superior_cat')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('earningsCategories');
    }

}
