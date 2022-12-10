<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getModules()
 * @method static array getRoutePath()
 * @method static void  setRoutes()
 * @method static void  setViewsFolder()
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
