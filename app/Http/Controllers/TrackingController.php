<?php

namespace App\Http\Controllers;

use App\Http\Resources\TrackingResource;
use App\Models\Tracking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function show($order_id):JsonResponse
    {
        $get_tracking = Tracking::whereId($order_id->with(['order'])->first();
        $data = TrackingResource::make($get_tracking)->withTracking(true);
        return $this->success($data, 'Tracking Details fetched successfully', 200);

    }
}
