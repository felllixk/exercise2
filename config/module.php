<?php

return [
    'path'              =>  base_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Modules',
    'base_namespace'    =>  'App\Modules',

    /**
     * Modules
     */
    "modules" => [
        "Common",
        "Backend",
        "Frontend"
    ]
];
