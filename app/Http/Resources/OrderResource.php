<?php

namespace App\Http\Resources;

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
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'location' => $this->location,
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
