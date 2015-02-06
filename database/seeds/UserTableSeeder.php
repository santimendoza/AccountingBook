<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;

class UserTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->delete();

        User::create(array(
            'id' => 1,
            'email' => 'santiagomendozar@gmail.com',
            'username' => 'sanmen1593',
            'name' => 'Santiago',
            'lastname' => 'Mendoza Ramirez',
            'password' => Hash::make('sanmen'),
            'currency' => 1,
            'status' => 1,
            'premium' => 1,
        ));
    }

}
