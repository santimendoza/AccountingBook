<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExpensesCategories\ExpensesCategories;

class ExpensesCategoriesSeeder extends Seeder {

    public function run() {
        DB::table('expensesCategories')->delete();
        ExpensesCategories::create(array(
            'id' => 1,
            'slug' => 'Servicios Básicos',
        ));
        ExpensesCategories::create(array(
            'id' => 2,
            'slug' => 'Vivienda',
        ));
        ExpensesCategories::create(array(
            'id' => 3,
            'slug' => 'Alimentación',
        ));
        ExpensesCategories::create(array(
            'id' => 4,
            'slug' => 'Educación',
        ));
        ExpensesCategories::create(array(
            'id' => 5,
            'slug' => 'Salud',
        ));
        ExpensesCategories::create(array(
            'id' => 6,
            'slug' => 'Entretenimiento',
        ));
        ExpensesCategories::create(array(
            'id' => 7,
            'slug' => 'Transporte',
        ));
        ExpensesCategories::create(array(
            'id' => 8,
            'slug' => 'Créditos',
        ));
        ExpensesCategories::create(array(
            'id' => 9,
            'slug' => 'Iglesia',
        ));
        ExpensesCategories::create(array(
            'id' => 10,
            'slug' => 'Otros',
        ));
        ExpensesCategories::create(array(
            'id' => 11,
            'slug' => 'Ahorros',
        ));
    }

}
