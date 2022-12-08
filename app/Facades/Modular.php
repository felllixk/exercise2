<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getModules()
 * @method static array getRoutesPath()
 * @method static void  setRoutes()
 * 
 * @see \App\Modules\Modular
 */
class Modular extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'modular';
    }
}
