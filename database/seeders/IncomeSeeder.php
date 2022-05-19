<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Income;

class IncomeSeeder extends Seeder
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
                'incomecategory_id' => '1',
                'payment_type_id' => '1',
                'description' => 'Lorem Ipsum',
                'amount' => '200',
                'income_date' => '2022-02-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'incomecategory_id' => '2',
                'payment_type_id' => '2',
                'description' => 'Lorem Ipsum',
                'amount' => '300',
                'income_date' => '2022-04-22',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        $income = Income::insert($data);

            
        
    }
}
