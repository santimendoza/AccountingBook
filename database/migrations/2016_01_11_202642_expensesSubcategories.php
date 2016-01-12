<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpensesSubcategories extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('expensesSubcategories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->integer('expensesCategory_id')->unsigned();
            $table->foreign('expensesCategory_id')->references('id')->on('expensesCategories')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('expensesSubcategories');
    }

}
