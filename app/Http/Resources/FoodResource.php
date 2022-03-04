<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * @var bool
     */
    private $withPrice;

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
            'name' => $this->name,
            'available' => (bool) $this->available,
            $this->mergeWhen($this->withPrice, [
                'price' => PriceResource::make($this->price)
            ])
        ];
    }

    public function withPrice($status = false): FoodResource
    {
        $this->withPrice = true;
        return $this;
    }
}
