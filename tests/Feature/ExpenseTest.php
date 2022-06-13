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
class ExpenseTest extends TestCase
{
    use HasApiTokens, HasFactory;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_expense()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
    ];
    
        Auth::attempt($user);
        $token = Auth::user()->createToken('nfce_client')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('GET', '/api/get-expense', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure(['status','statusCode',
            'expense' => [
                '*' => [
                    "id",
                    "description",
                    "amount",
                    "expense_date",
                    "created_at",
                    "expenseCategory",
                    "paymentType"
              
                
                ]
            ]
              
        ]);
    }
    public function test_require_add_expense()
    {
        $user = ['email' => 'admin@gmail.com',
        'password' => '123456'
        ];

            Auth::attempt($user);
            $token = Auth::user()->createToken('nfce_client')->accessToken;
            $headers = ['Authorization' => "Bearer $token"];
            $this->json('POST', '/api/add-expense', [], $headers)
            ->assertStatus(422)                
            ->assertJsonStructure(['success','message',
            'data' => ['amount','payment_type_id','expensecategory_id']
              
              
        ]);
                        
    }
    public function test_add_expense()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
    ];
    
        Auth::attempt($user);
        $token = Auth::user()->createToken('nfce_client')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $data = [
            "description"=>"rtertetbmnbmn",
            "amount"=>"500",
            "expense_date"=>"2022-07-12",
            "expensecategory_id"=>1,
            "payment_type_id"=>1

        ];
        $this->json('POST', '/api/add-expense', $data , $headers)
            ->assertStatus(201)
           // ->assertValid(['name'])
            ->assertJsonStructure([
                'expense' => [  
                    "id",
                    "expensecategory_id",
                    "payment_type_id",
                    "description",
                    "amount",
                    "expense_date",
                    "createdAt",
                    "updatedAt"
               
                    ],
        "status",
        "statusCode"
              
        ]);
    }
    public function test_require_update_expense()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
                ];

            Auth::attempt($user);
            $token = Auth::user()->createToken('nfce_client')->accessToken;
            $headers = ['Authorization' => "Bearer $token"];
            $this->json('put', '/api/update-expense', [], $headers)
            ->assertStatus(422)                
            ->assertJsonStructure(['success','message',
            'data' => ['id']
              
        ]);
                        
    }
    public function test_update_expense()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
    ];
    
        Auth::attempt($user);
        $token = Auth::user()->createToken('nfce_client')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $data = ['id'=>'1', 
                "description"=>"rtertetbmnbmn",
                "amount"=>"500",
                "expense_date"=>"2022-07-12",
                "expensecategory_id"=>1,
                "payment_type_id"=>1
        ];
        $this->json('PUT', '/api/update-expense', $data , $headers)
            ->assertStatus(200)
            ->assertValid(['id'])
            ->assertJsonStructure([
                'expense' => [  
                    "id",
                    "expensecategory_id",
                    "payment_type_id",
                    "description",
                    "amount",
                    "expense_date",
                    "updatedAt"
                    ],
        "status",
        "statusCode"
              
        ]);
    }
    public function test_delete_expense()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
                ];
    
        Auth::attempt($user);
        $token = Auth::user()->createToken('nfce_client')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $data = ['id'=>'1'];
        $this->json('DELETE', '/api/delete-expense', $data , $headers)
            ->assertStatus(200)
            ->assertValid(['id'])
            ->assertJsonStructure([
                'status',
                'message',
             ]);
    }
}
