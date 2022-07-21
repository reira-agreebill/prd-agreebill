<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;

use App\Models\Customer;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
class CustomerAuthApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer_api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login()
    {

        $credentials = request(['email', 'password']);
        config()->set( 'auth.defaults.guard', 'customer_api' );
        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                "success"=> false,
                "status"=>"error",
                "error"=>["code"=>401,
                    "type"=>"Unauthorized",
                    "message"=>"Invalid email or password"
                ],
            ], 401);
        }

        return $this->respondWithToken($token);
    }
    public function register(Request $request){
        $data = Validator::make($request->all(), [
            'customer_name'=>'required',
            'email'=>['required',Rule::unique('stores','email')],
            'password'=>'required',
            'customer_phone'=>'required',
            'address'=>'',
        ]);
        if ($data->fails()) {
            return response()->json([
                "success" => false,
                "status" => "success",
                "payload" => [
                    'data' =>  $data->errors(),

                ]
            ], 400);
        }
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $response = Customer::create($data);
        if($response){
            return response()->json([
                "success" => true,
                "status" => "success",
                "payload" => [
                    'user' =>  $response,
                ]
            ], 200);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        $response = Auth::user();
        return response()->json([
            "success" => true,
            "status" => "success",
            "payload" => [
                'user' => $response,
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => '',
            ]
        ], 200);
    }

}
