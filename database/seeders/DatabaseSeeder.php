<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
        IncomeCategoriesSeeder::class,

        ExpenseSeeder::class,

        ExpenseCategorySeeder::class,

        UserSeeder::class,
        PaymentTypeSeeder::class,

        ]);

         \App\Models\User::factory(10)->create();
    }
}
