<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'amount' =>$this->amount,
            'status'=>$this->status,
            'type'=>$this->type,
            'description'=>$this->description,
            'old_balance'=>$this->old_balance,
            'new_balance'=>$this->new_balance
        ];
    }
}
