<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEarningsCategories extends Migration {

    public function up() {
        Schema::create('earningsCategories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('earningsCategories');
    }

}
