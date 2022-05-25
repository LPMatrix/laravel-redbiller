<?php

namespace LPMatrix\Redbiller\Facades;

use Illuminate\Support\Facades\Facade;


class Redbiller extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-redbiller';
    }
}
