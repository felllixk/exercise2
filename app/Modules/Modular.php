<?php

namespace App\Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Facades\App\Contracts\Publisher;

class Modular
{
    /**
     * Return array of Modules
     * 
     * @return array
     */
    public function getModules(): array
    {
        return config('module.modules', []);
    }

    /**
     * Return array of Paths to Modules
     * 
     * @return array
     */
    public function getRoutesPath(): array
    {
        $modules = $this->getModules();
        $routeFiles = [];
        foreach ($modules as $module) {
            if (File::exists($path = config('module.path') . DIRECTORY_SEPARATOR . ucfirst($module) . DIRECTORY_SEPARATOR . 'Routes')) {
                $routeFiles[] = File::glob($path . DIRECTORY_SEPARATOR . '*.php');
            }
        }
        return $routeFiles;
    }
    
    /**
     * Setup routes of modules
     *
     * @return void
     */
    public function setRoutes(): void
    {
        $routesPath = $this->getRoutesPath();
        foreach ($routesPath as $path) {
            Route::group([], $path);
        }
    }
}
