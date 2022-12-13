<?php

namespace App\Modules\Frontend\Controllers;

use App\Modules\Common\Models\Json;
use App\Modules\Frontend\Requests\CreateJsonRequest;

class JsonController
{
    public function index()
    {
    }


    /**
     * Store json object into database
     *
     * @param  mixed $request
     * @return array|string
     */
    public function store(CreateJsonRequest $request)
    {
        $time_start = microtime(true);
        $json = new Json();
        $json->json = $request->json;
        $json->save();
        $time_end = microtime(true);
        return [
            'id' => $json->id,
            'memUsageMB' => (memory_get_peak_usage(true) / 1000000),
            'executionTimeSeconds' => ($time_end - $time_start) / 60
        ];
    }
}
