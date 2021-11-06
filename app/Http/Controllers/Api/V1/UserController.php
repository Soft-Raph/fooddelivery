<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validate = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone_number' => 'required|string'
            ]);

            if ($validate->fails())
            {
                return $this->error(422, $validate->messages()->first());
            }

            $attr = $request->only('first_name','last_name', 'phone_number');

            $user = Auth::guard('api')->user();
            $update = $user->update($attr);

            if (!$update){
                return $this->error(500, 'Profile update failed');
            }

            return $this->success($user, 'Profile updated successfully', 200);
        }
        catch (\Exception $e)
        {
            return $this->error($e->getCode(), $e->getMessage());
        }

    }
}
