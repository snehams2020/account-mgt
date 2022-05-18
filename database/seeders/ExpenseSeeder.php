<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;

class ExpenseSeeder extends Seeder
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
                'expensecategory_id' => '1',
                'payment_type_id' => '1',
                'description' => 'Lorem Ipsum',
                'amount' => '200',
                'expense_date' => '2022-02-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'expensecategory_id' => '2',
                'payment_type_id' => '2',
                'description' => 'Lorem Ipsum',
                'amount' => '300',
                'expense_date' => '2022-04-22',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            
    ];

    $expense = Expense::insert($data);

    }
}
