<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * @var bool
     */
    private $withFood;

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
            'status' => $this->status,
            'location' => $this->location,
            'tracking_code'=>$this->code,
            $this->mergeWhen($this->withFood,[
                'food' => FoodResource::collection($this->food)
            ])
        ];
    }

    public function withFood($status = false): OrderResource
    {
        $this->withFood = true;
        return $this;
    }
}
