<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use  Laravel\Passport\HasApiTokens;
use Laravel\Passport\Passport;
use Auth;
class ReportTest extends TestCase
{
    use HasApiTokens, HasFactory;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_expense_report()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
    ];
    
        Auth::attempt($user);
        $token = Auth::user()->createToken('nfce_client')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('GET', '/api/get-expense-report', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure(['status','statusCode',
            'expenseReport' => [
                '*' => [
                        'description',
                        'amount',
                        'expense_date',
                        'expenseCategory',
                        'paymentType'
                
                ]
                ],
                 "expenseReportCount"
              
        ]);
    }
    public function test_list_income_report()
    {
        $user = ['email' => 'admin@gmail.com',
        'password' => '123456'
        ];

            Auth::attempt($user);
            $token = Auth::user()->createToken('nfce_client')->accessToken;
            $headers = ['Authorization' => "Bearer $token"];
            $this->json('GET', '/api/get-income-report', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure(['status','statusCode',
            'incomeReport' => [
                '*' => [
                        'description',
                        'amount',
                        'income_date',
                        'incomeCategory',
                        'paymentType'
                
                ]
                ],
                 "incomeReportCount"
              
        ]);
                        
    }
    public function test_list_balance_sheet()
    {
        $user = ['email' => 'admin@gmail.com',
        'password' => '123456'
        ];

            Auth::attempt($user);
            $token = Auth::user()->createToken('nfce_client')->accessToken;
            $headers = ['Authorization' => "Bearer $token"];
            $this->json('GET', '/api/get-balance-sheet', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure(['status','statusCode',
            'balanceSheet' => [
                '*' => [
                        'date',
                        'category',
                        'credit',
                        'debit',
                        'paymentType'
                
                ]
                ],
                 "balanceSheetCount"
              
        ]);
                        
    }
    
}
