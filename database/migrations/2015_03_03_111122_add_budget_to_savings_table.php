<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBudgetToSavingsTable extends Migration {

    public function up() {
        Schema::table('savings', function($table) {
            $table->double('budget')->nullable()->default(0);
        });
    }

    public function down() {
        Schema::table('savings', function($table) {
            $table->dropColumn('budget');
        });
    }

}
