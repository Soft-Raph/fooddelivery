<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
   use ApiResponseTrait;
    public function show($transaction)
    {
       $get_trans = Transaction::whereId($transaction)->first();
        $data = TransactionResource::make($get_trans);

        return $this->success($data,'Transactions fetched successfully');
    }



}
