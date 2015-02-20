<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAddedFounds extends Migration {

    public function up() {
        Schema::table('savings', function($table) {
            $table->boolean('addedfounds')->nullable()->default(false);
        });
    }

    public function down() {
        Schema::table('savings', function($table) {
             $table->dropColumn('addedfounds');
        });
    }

}
