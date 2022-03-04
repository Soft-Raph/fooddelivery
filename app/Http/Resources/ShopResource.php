<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ShopResource extends JsonResource
{
    /**
     * @var bool|mixed
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
            'name'  => $this->name,
            'address' => $this->address,
            $this->mergeWhen($this->withFood, [
                'food' => FoodResource::collection($this->food)
            ])
        ];
    }

    public function withFood($status = false): ShopResource
    {
        $this->withFood = $status;
        return $this;
    }
}
