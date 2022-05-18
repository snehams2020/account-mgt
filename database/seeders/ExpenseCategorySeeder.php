<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExpenseCategory;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Food',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Accomodation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            
    ];

    $expenseCategory = ExpenseCategory::insert($data);

    }
}
