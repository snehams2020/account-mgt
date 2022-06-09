<?php
 
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
 
class PassportAuthController 
{
   
    /**
     * Login Req
     *  @param  App\Http\Requests\LoginRequest $request
     * @return Illuminate\Http\JsonResponse
    */
    public function login(LoginRequest $request):JsonResponse

    {
        $response = ['status' => false, 'message' => 'Failed', 'data' => []];
        $statusCode = 200;
        
            $request->validated();
    
            $data = [
                'email' => $request->email,
                'password' => $request->password
            ];
    
         if (auth()->attempt($data)) {
            $response['status'] = true;
            $response['message'] = 'Success';
            $response['data']['user'] = auth()->user();

            $response['data']['token'] = auth()->user()->createToken('Laravel-9-Passport-Auth')->accessToken;;
        } elseif (empty($data)) {
            $response['status'] = true;
            $response['message'] = 'Not Able to login';
        }
        return response()->json($response, $statusCode);

        
    }
      /**
     * Get UserInfo by id
     *@return Illuminate\Http\JsonResponse
    */
 
    public function userInfo():JsonResponse
    {
 
     $user = auth()->user();
      
     return response()->json(['user' => $user], 200);
 
    }
}