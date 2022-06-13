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
class IncomeTest extends TestCase
{
    use HasApiTokens, HasFactory;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_income()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
    ];
    
        Auth::attempt($user);
        $token = Auth::user()->createToken('nfce_client')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('GET', '/api/get-income', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure(['status','statusCode',
            'income' => [
                '*' => [
                    "id",
                    "description",
                    "amount",
                    "income_date",
                    "created_at",
                    "incomeCategory",
                    "paymentType"
              
                
                ]
            ]
              
        ]);
    }
    public function test_require_add_income()
    {
        $user = ['email' => 'admin@gmail.com',
        'password' => '123456'
        ];

            Auth::attempt($user);
            $token = Auth::user()->createToken('nfce_client')->accessToken;
            $headers = ['Authorization' => "Bearer $token"];
            $this->json('POST', '/api/add-income', [], $headers)
            ->assertStatus(422)                
            ->assertJsonStructure(['success','message',
            'data' => ['amount','payment_type_id','incomecategory_id']
              
              
        ]);
                        
    }
    public function test_add_income()
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
            "income_date"=>"2022-07-12",
            "incomecategory_id"=>1,
            "payment_type_id"=>1

        ];
        $this->json('POST', '/api/add-income', $data , $headers)
            ->assertStatus(201)
           // ->assertValid(['name'])
            ->assertJsonStructure([
                'income' => [  
                    "id",
                    "incomecategory_id",
                    "payment_type_id",
                    "description",
                    "amount",
                    "income_date",
                    "createdAt",
                    "updatedAt"
               
                    ],
        "status",
        "statusCode"
              
        ]);
    }
    public function test_require_update_income()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
                ];

            Auth::attempt($user);
            $token = Auth::user()->createToken('nfce_client')->accessToken;
            $headers = ['Authorization' => "Bearer $token"];
            $this->json('put', '/api/update-income', [], $headers)
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
                "income_date"=>"2022-07-12",
                "incomecategory_id"=>1,
                "payment_type_id"=>1
        ];
        $this->json('PUT', '/api/update-income', $data , $headers)
            ->assertStatus(200)
            ->assertValid(['id'])
            ->assertJsonStructure([
                'income' => [  
                    "id",
                    "incomecategory_id",
                    "payment_type_id",
                    "description",
                    "amount",
                    "income_date",
                    "updatedAt"
                    ],
        "status",
        "statusCode"
              
        ]);
    }
    public function test_delete_income()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
                ];
    
        Auth::attempt($user);
        $token = Auth::user()->createToken('nfce_client')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $data = ['id'=>'1'];
        $this->json('DELETE', '/api/delete-income', $data , $headers)
            ->assertStatus(200)
            ->assertValid(['id'])
            ->assertJsonStructure([
                'status',
                'message',
             ]);
    }
}
