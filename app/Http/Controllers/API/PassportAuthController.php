<?php
 
namespace App\Http\Controllers\API;
 
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
 
class PassportAuthController 
{
    /**
     * Registration Req
     */
    // public function register(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required|min:4',
    //         'email' => 'required|email',
    //         'password' => 'required|min:8',
    //     ]);
  
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password)
    //     ]);
  
    //     $token = $user->createToken('Laravel-9-Passport-Auth')->accessToken;
  
    //     return response()->json(['token' => $token], 200);
    // }
  
    /**
     * Login Req
     */
    public function login(LoginRequest $request)
    {
        
            $request->validated();
      
            $data = [
                'email' => $request->email,
                'password' => $request->password
            ];
    
            if (auth()->attempt($data)) {
                $token = auth()->user()->createToken('Laravel-9-Passport-Auth')->accessToken;
                return response()->json(['token' => $token], 200);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        
    }
 
    public function userInfo() 
    {
 
     $user = auth()->user();
      
     return response()->json(['user' => $user], 200);
 
    }
}