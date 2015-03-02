<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBudgetAttrToExpensesCategories extends Migration {

    public function up() {
        Schema::table('expensesCategories', function($table) {
            $table->double('budget')->nullable()->default(0);
        });
    }

    public function down() {
        Schema::table('expensesCategories', function($table) {
            $table->dropColumn('budget');
        });
    }
}
