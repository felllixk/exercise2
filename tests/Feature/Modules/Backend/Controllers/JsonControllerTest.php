<?php

namespace Tests\Feature\Modules\Backend\Controllers;

use App\Modules\Common\Models\Json;
use App\Modules\Common\Models\User;
use Tests\TestCase;

class JsonControllerTest extends TestCase
{
    /**
     * Test post json without token
     *
     * @return void
     */
    public function test_index_json_objects()
    {
        $response = $this->get(route('backend-json-index'), [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200);
        $jsons = $response->getContent();
        $this->assertJson($jsons);
        $arrayOfJsons = json_decode($jsons, true);
        $this->assertIsArray($arrayOfJsons);
    }

    public function test_update_json_object()
    {
        $json = new Json();
        $json->json = json_encode(['value1' => 'test']);
        $json->save();

        $jsonToUpdate = json_encode(['value1' => 'value2']);
        $response = $this->put(route('backend-json-update', ['id' => $json->id]), [
            'json' => $jsonToUpdate
        ], [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(204);
        $updatedJson = Json::find($json->id);
        $this->assertTrue(json_decode($updatedJson->json, true)['value1'] == json_decode($jsonToUpdate, true)['value1']);
        Json::destroy($json->id);
    }

    public function test_delete_json_object()
    {
        $json = new Json();
        $json->json = json_encode(['value1' => 'test']);
        $json->save();

        $response = $this->delete(route('backend-json-delete', ['id' => $json->id]), [], [
            'Accept' => 'application/json'
        ]);
        $deletedJson = Json::find($json->id);
        $response->assertStatus(204);
        $this->assertNull($deletedJson);
        if ($deletedJson) {
            Json::destroy($deletedJson->id);
        }
    }
}
