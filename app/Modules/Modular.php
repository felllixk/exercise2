<?php

namespace App\Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Facades\App\Contracts\Publisher;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class Modular
{

    /**
     * Return array of modules
     * 
     * @return array
     */
    public function getModules(): array
    {
        $modules = [];
        foreach (config('module.modules', []) as $key => $value) {
            if (!is_array($value)) {
                $modules[$value] = [];
            }
            $modules[$key] = $value;
        }
        return $modules;
    }

    /**
     * Return Module Path
     * 
     * @return array
     */
    public function getRoutePath(string $moduleName): array
    {
        $routeFiles = [];
        $path = config('module.path') . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'Routes';
        if (File::exists($path)) {
            $routeFiles = File::glob($path . DIRECTORY_SEPARATOR . '*.php');
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
        foreach ($this->getModules() as $moduleName => $data) {
            // $moduleMiddleware = $this->getMiddleware($moduleName); Support attribute set.
            $routePath = $this->getRoutePath($moduleName);
            Route::group([], $routePath);
        }
    }

    /**
     * Set view folders for Modules
     *
     * @return void
     */
    public function setViewsFolder()
    {
        $moduleNames = array_keys($this->getModules());
        foreach ($moduleNames as $module) {
            if (is_dir($path = app_path('Modules' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'Views'))) {
                View::addNamespace(strtolower($module), $path);
            }
        }
    }


    /**
     * Get module middleware
     *
     * @param  string $moduleName
     * @return array
     */
    public function getMiddleware(string $moduleName): array
    {
        $middleware = config('module.modules.' . $moduleName . '.middleware');
        return (is_array($middleware)) ? $middleware : [$middleware];
    }
}
