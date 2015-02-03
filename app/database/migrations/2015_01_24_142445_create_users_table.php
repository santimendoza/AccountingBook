<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('status')->default(0); // Status si ha confirmado la cuenta o no.
            $table->boolean('premium')->default(0); // Si es premium o no.
            $table->string('confirmation_code')->nullable(); // Codigo de confirmacion que se enviara para confirmar la cuenta.
            $table->integer('currency'); // 1. COP 2. USD 3. EUR
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }

}
