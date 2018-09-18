<?php

namespace Alive2212\LaravelOnionPattern\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelOnionPattern extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelonionpattern';
    }
}
