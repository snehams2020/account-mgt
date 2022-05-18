<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
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
                    'name' => 'Card',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Cash',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Upi',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
        ];

        $paymentType = PaymentType::insert($data);
      
    }
}
