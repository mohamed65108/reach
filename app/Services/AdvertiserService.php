<?php

namespace App\Services;

use App\Models\Advertiser;

/**
 * Class AdvertiserService.
 */
class AdvertiserService
{

    public function advertiserAds($advertiserId)
    {
        $advertiser = Advertiser::with('ads')->findOrFail($advertiserId);
        return $advertiser;
    }
}
