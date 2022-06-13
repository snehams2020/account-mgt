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
class PaymentTypeTest extends TestCase
{
    use HasApiTokens, HasFactory;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_payment_type()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
    ];
    
        Auth::attempt($user);
        $token = Auth::user()->createToken('nfce_client')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('GET', '/api/get-payment-type', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure(['status','statusCode',
            'paymentType' => [
                '*' => [
                        'id',
                        'name',
                        'createdAt',
                        'updatedAt'
                
                ]
            ]
              
        ]);
    }
    public function test_require_name_add_payment_type()
    {
        $user = ['email' => 'admin@gmail.com',
        'password' => '123456'
        ];

            Auth::attempt($user);
            $token = Auth::user()->createToken('nfce_client')->accessToken;
            $headers = ['Authorization' => "Bearer $token"];
            $this->json('POST', '/api/add-payment-type', [], $headers)
            ->assertStatus(422)                
            ->assertJsonStructure(['success','message',
            'data' => ['name']
              
        ]);
                        
    }
    public function test_add_payment_type()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
    ];
    
        Auth::attempt($user);
        $token = Auth::user()->createToken('nfce_client')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $data = ['name' => 'test user'];
        $this->json('POST', '/api/add-payment-type', $data , $headers)
            ->assertStatus(201)
            ->assertValid(['name'])
            ->assertJsonStructure([
            'paymentType' => [
                        'id',
                        'name',
                        'createdAt',
                        'updatedAt'
                ],
                'status',
                'statusCode',
              
        ]);
    }
    public function test_require_name_update_payment_type()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
                ];

            Auth::attempt($user);
            $token = Auth::user()->createToken('nfce_client')->accessToken;
            $headers = ['Authorization' => "Bearer $token"];
            $this->json('put', '/api/update-payment-type', [], $headers)
            ->assertStatus(422)                
            ->assertJsonStructure(['success','message',
            'data' => ['id']
              
        ]);
                        
    }
    public function test_update_payment_type()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
    ];
    
        Auth::attempt($user);
        $token = Auth::user()->createToken('nfce_client')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $data = ['id'=>'1','name' => 'test user'];
        $this->json('PUT', '/api/update-payment-type', $data , $headers)
            ->assertStatus(200)
            ->assertValid(['id'])
            ->assertJsonStructure([
            'paymentType' => [
                        'id',
                        'name',
                        'createdAt',
                        'updatedAt'
                ],
                'status',
                'statusCode',
              
        ]);
    }
    public function test_delete_payment_type()
    {
        $user = ['email' => 'admin@gmail.com',
                'password' => '123456'
                ];
    
        Auth::attempt($user);
        $token = Auth::user()->createToken('nfce_client')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $data = ['id'=>'1'];
        $this->json('DELETE', '/api/delete-payment-type', $data , $headers)
            ->assertStatus(200)
            ->assertValid(['id'])
            ->assertJsonStructure([
                'status',
                'message',
             ]);
    }
}
