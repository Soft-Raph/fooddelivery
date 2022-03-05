<?php

namespace App\Http\Resources;

use App\Models\Tracking;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'preparing'=> (bool)$this->preparing,
            'picked'=> (bool)$this->picked,
            'delivered'=> (bool)$this->delivered
        ];

    }
}
