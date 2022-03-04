<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{

    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $shops = Shop::all();
        if (count($shops) == 0)
        {
            return $this->error(404, 'No shop available now');
        }
        return $this->success($shops, 'All shops fetched successfully', 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'lat' => 'nullable|string',
            'long' => 'nullable|string',
            'address' => 'required|string',

        ]);
        if($validate->fails())
        {
            return $this->error(422, $validate->messages()->first());
        }

        $create = Shop::create($validate->validated());
        if (!$create)
        {
            return $this->error(500, 'shop not created');
        }

        return $this->success($create, 'Shop created successfully', 200);
    }




    /**
     * Display the specified resource.
     *
     * @param Shop $shop
     * @return JsonResponse
     */
    public function show(Shop $shop): JsonResponse
    {

        return $this->success($shop, 'The particular shop fetched successfully', 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Shop $shop
     * @return Response
     */
    public function edit(Shop $shop)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Shop $shop
     * @return JsonResponse
     */
    public function update(Request $request, Shop $shop): JsonResponse
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|string',
                'lat' => 'nullable|string',
                'long' => 'nullable|string',
                'address' => 'required|string',

            ]);
            if ($validate->fails()) {
                return $this->error(422, $validate->messages()->first());
            }

            $update = $shop->update($validate->validated());

            if (!$update) {
                return $this->error(500, 'Shop update failed');
            }

            return $this->success($shop, 'Shop updated successfully', 200);
        }
        catch (\Exception $e)
        {
            return $this->error($e->getCode(), $e->getMessage());
        }

}

    /**
     * Remove the specified resource from storage.
     *
     * @param Shop $shop
     * @return JsonResponse
     */
    public function destroy(shop $shop): JsonResponse
    {
        $delete = $shop->delete();

        if (!$delete){
            return $this->error(500, 'Shop remover failed');
        }

        return $this->success(null,'Shop remover successfully', 200);
    }


}
