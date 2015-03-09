<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCourtDateToUsersTable extends Migration {

    public function up() {
        Schema::table('users', function($table) {
            $table->string('courtdate')->nullable()->default("01");
        });
    }

    public function down() {
        Schema::table('users', function($table) {
            $table->dropColumn('courtdate');
        });
    }

}
