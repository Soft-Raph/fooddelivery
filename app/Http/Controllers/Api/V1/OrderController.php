<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::guard('api')->user();
        $get_orders = $user->orders()->with(['food'])->get();
        $data = OrderResource::collection($get_orders);
        return $this->success($data, 'Orders returned successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($order): \Illuminate\Http\JsonResponse
    {
        $get_order = Order::whereId($order)->with(['food','tracking'])->first();

        if (!$get_order){
            return $this->error(404,'This order does not exists');
        }

        if (Auth::guard('api')->user()->orders()->where('orders.id', $order)->doesntExist()) {
            return $this->error(404,'This order does not belong to you');
        }

        $data = OrderResource::make($get_order)->withFood(true)->withTracking(true);
        return $this->success($data, 'Order returned successfully');
    }

}
