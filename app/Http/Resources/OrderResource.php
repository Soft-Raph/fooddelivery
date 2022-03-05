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
     * @var bool
     */
    private $withTracking;


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
            ]),
            $this->mergeWhen($this->withTracking,[
                'tracking' => TrackingResource::make($this->tracking)
            ]),
        ];
    }

    public function withFood($status = false): OrderResource
    {
        $this->withFood = true;
        return $this;
    }
    public function withTracking($status = false): OrderResource
    {
        $this->withTracking = true;
        return $this;
    }
}
