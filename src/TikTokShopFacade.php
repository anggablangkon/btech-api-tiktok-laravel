<?php

namespace BtechApi\TiktokLaravel;

use Illuminate\Support\Facades\Facade;

class TikTokShopFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TikTokShopService::class;
    }
}