<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthtokenToUserTable extends Migration {

    public function up() {
        Schema::table('users', function($table) {
            $table->string('authtoken')->nullable();
        });
    }

    public function down() {
        Schema::table('users', function($table) {
            $table->dropColumn('authtoken');
        });
    }

}
