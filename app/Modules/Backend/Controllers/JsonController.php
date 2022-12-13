<?php

namespace App\Modules\Backend\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Backend\Requests\UpdateJsonRequest;
use App\Modules\Common\Models\Json;
use Illuminate\Http\Request;

class JsonController extends Controller
{
    public function index()
    {
        $json = Json::all();
        return $json;
    }

    public function delete($id)
    {
        Json::destroy($id);
        return response($id, 204);
    }

    public function update(UpdateJsonRequest $request)
    {
        $json = Json::find($request->id);
        $json->json = $request->json;
        $json->save();
        return response($json->id, 204);
    }
}
