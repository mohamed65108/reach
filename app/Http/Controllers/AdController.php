<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Http\Resources\AdCollection;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use App\Services\AdService;
use Illuminate\Http\Request;

class AdController extends Controller
{

    protected $adService;

    public function __construct(AdService $adService)
    {
        $this->adService = $adService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ads = $this->adService->index($request);
        return new AdCollection($ads);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreAdRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdRequest $request)
    {
        $store = $this->adService->store($request->validated());
        if (!$store) {
            return response()->json(['created' => false], 422);
        }
        return new AdResource($store);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Ad $ad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Ad::with(['category', 'advertiser', 'tags'])->findOrFail($id);
        return new AdResource($ad);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateAdRequest $request
     * @param \App\Models\Ad $ad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdRequest $request, Ad $ad)
    {
        $update = $this->adService->update($request->validated(), $ad);

        if (!$update) {
            return response()->json(['updated' => false], 422);
        }
        return new AdResource($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Ad $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        $delete = $ad->delete();
        if (!$delete) {
            return response()->json(['deleted' => false], 422);
        }
        return response()->json(['deleted' => true], 200);
    }
}
