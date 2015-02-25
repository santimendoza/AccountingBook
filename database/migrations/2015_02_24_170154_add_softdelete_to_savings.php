<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftdeleteToSavings extends Migration {

    public function up() {
        Schema::table('savings', function($table) {
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::table('savings', function($table) {
            $table->dropSoftDeletes();
        });
    }

}
