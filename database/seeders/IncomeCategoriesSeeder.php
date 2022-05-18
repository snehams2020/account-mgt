<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IncomeCategory;

class IncomeCategoriesSeeder extends Seeder
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
                'name' => 'Salary',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rent',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
            $incomeCategory = IncomeCategory::insert($data);

            
       
    }
}
