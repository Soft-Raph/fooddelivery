<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FoodController extends Controller
{
    use ApiResponseTrait;

    public function show($food)
    {
        $get_food = Food::whereId($food)->with(['price'])->first();
        $data = FoodResource::make($get_food)->withPrice(true);

        return $this->success($data,'Food fetched successfully');
    }
}
