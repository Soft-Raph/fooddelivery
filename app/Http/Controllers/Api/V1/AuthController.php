<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use Throwable;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
       try{
           $validate = Validator::make($request->all(), [
               'email' => 'required|string|email|max:255',
               'password' => 'required|string|min:6',
           ]);

           if ($validate->fails()){
               return $this->error(422, $validate->messages()->first());
           }

           $attr = $request->only('email', 'password');

           if (!Auth::attempt($attr)) {
               return $this->error(401, 'Login details invalid or does not exist');
           }

           return $this->token($this->getPersonalAccessToken(), 'Login successful');
       }
       catch (Exception $e){
           return $this->error($e->getCode(), $e->getMessage());
       }
    }

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validate = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone_number' => 'required|string|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            if ($validate->fails()) {
                return $this->error(422, $validate->messages()->first());
            }

            $attr = $request->only('first_name', 'last_name', 'phone_number', 'email', 'password');

            User::create([
                'first_name' => $attr['first_name'],
                'last_name' => $attr['last_name'],
                'phone_number' => $attr['phone_number'],
                'email' => $attr['email'],
                'password' => Hash::make($attr['password'])
            ]);

            Auth::attempt(['email' => $attr['email'], 'password' => $attr['password']]);
            return $this->token($this->getPersonalAccessToken(), 'Registration successful', 200);
        }
        catch (\Exception $e){
                return $this->error($e->getCode(), $e->getMessage());
        }
    }

    public function user(): \Illuminate\Http\JsonResponse
    {
        try {
            $user = Auth::guard('api')->user();
            return $this->success($user,'Profile information fetched successfully', 200);
        }
        catch (Exception $e){
            return $this->error($e->getCode(), $e->getMessage());
        }
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        try {
            Auth::guard('api')->user()->token()->revoke();
            return $this->success(null, 'Log out successful', 200);
        }
        catch (\Exception $e){
            return $this->error($e->getCode(), $e->getMessage());
        }
    }

    public function getPersonalAccessToken()
    {
        if (request()->remember_me === 'true')
            Passport::personalAccessTokensExpireIn(now()->addDays(15));

        return Auth::user()->createToken('Personal Access Token');
    }
}
