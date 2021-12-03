<?php

namespace Jecar\Core\Facades;

use Illuminate\Support\Facades\Facade;

class MediaFile extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jecar-media';
    }

}
