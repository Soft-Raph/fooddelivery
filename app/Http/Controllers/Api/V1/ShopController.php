<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShopResource;
use App\Models\Shop;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{

    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $get_shops = Shop::all();
        $shops = ShopResource::collection($get_shops);
        return $this->success($shops, 'All shops fetched successfully', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param $shop
     * @return JsonResponse
     */
    public function show($shop): JsonResponse
    {
        $get_shop = Shop::whereId($shop)->with(['food'])->first();
        $data = ShopResource::make($get_shop)->withFood(true);
        return $this->success($data, 'Shop fetched successfully', 200);
    }

}
