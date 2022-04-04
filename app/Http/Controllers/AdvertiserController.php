<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdvertiserResource;
use App\Services\AdvertiserService;

class AdvertiserController extends Controller
{

    protected $advertiserService;

    public function __construct(AdvertiserService $advertiserService)
    {
        $this->advertiserService = $advertiserService;
    }

    public function advertiserAds($advertiserId)
    {
        $advertiser = $this->advertiserService->advertiserAds($advertiserId);
        return new AdvertiserResource($advertiser);
    }
}
