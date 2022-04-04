<?php

namespace App\Services;

use App\Models\Ad;

/**
 * Class AdService.
 */
class AdService
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($request)
    {
        $ads = Ad::with(['category', 'advertiser', 'tags']);
        if (isset($request['category'])) {
            $ads = $ads->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request['category'])->orWhere('id', $request['category']);
            });
        }
        if (isset($request['tag'])) {
            $ads = $ads->whereHas('tags', function ($q) use ($request) {
                $q->where('name', $request['tag'])->orWhere('tag_id', $request['tag']);
            });
        }
        $ads = $ads->paginate();
        return $ads;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreAdRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        $store = Ad::create($data);
        $store->tags()->sync($data['tags']);
        return $store;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateAdRequest $request
     * @param \App\Models\Ad $ad
     * @return \Illuminate\Http\Response
     */
    public function update($data, $ad)
    {
        $ad->update($data);
        $ad->tags()->sync($data['tags']);
        return $ad;
    }
}
