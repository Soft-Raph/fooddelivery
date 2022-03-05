<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
   use ApiResponseTrait;

    public function index(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::guard('api')->user();
        $get_orders = $user->transactions()->get();
        $data = TransactionResource::collection($get_orders);
        return $this->success($data, 'Transactions returned successfully');
    }
    public function show($transaction)
    {
       $get_trans = Transaction::whereId($transaction)->first();
        $data = TransactionResource::make($get_trans);

        return $this->success($data,'individual Transaction fetched successfully');
    }



}
