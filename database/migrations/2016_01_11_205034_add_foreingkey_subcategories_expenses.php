<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingkeySubcategoriesExpenses extends Migration {

    public function up() {
        Schema::table('expenses', function($table) {
            $table->integer('expensesSubcategory_id')->unsigned()->nullable();
            $table->foreign('expensesSubcategory_id')->references('id')->on('expensesSubcategories');
        });
    }

    public function down() {
        Schema::table('expenses', function($table) {
            $table->dropColumn('expensesSubcategory_id');
        });
    }

}
