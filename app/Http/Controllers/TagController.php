<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\TagCollection;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate();
        return new TagCollection($tags);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreTagRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        $store = Tag::create($request->validated());
        if (!$store) {
            return response()->json(['created' => false], 422);
        }
        return new TagResource($store);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return new TagResource($tag);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateTagRequest $request
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $update = $tag->update($request->validated());
        if (!$update) {
            return response()->json(['updated' => false], 422);
        }
        return new TagResource($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $delete = $tag->delete();
        if (!$delete) {
            return response()->json(['deleted' => false], 422);
        }
        return response()->json(['deleted' => true], 200);
    }
}
