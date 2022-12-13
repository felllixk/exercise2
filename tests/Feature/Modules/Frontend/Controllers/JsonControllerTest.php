<?php

namespace Tests\Feature\Modules\Frontend\Controllers;

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
    public function test_post_json_without_token()
    {
        $response = $this->post(route('frontend-json-store'), [
            'json' => json_encode(["as" => 12])
        ]);

        $response->assertStatus(401);
    }

    /**
     * Test post json with token
     *
     * @return void
     */
    public function test_post_json_with_token()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authToken')->accessToken;
        $response = $this->post(
            route('frontend-json-store'),
            [
                'json' => json_encode(["as" => 12]),
            ],
            [
                'Authorization' => 'Bearer ' . $token
            ]
        );

        $response->assertStatus(200);
        $json = $response->getContent();
        $this->assertJson($json);
        $data = json_decode($json, true);
        $this->assertIsInt($data['id']);
        Json::destroy($data['id']);
        $user->delete();
        $this->assertTrue(true);
    }

    /**
     * Test post json with token
     *
     * @return void
     */
    public function test_get_json_with_token()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authToken')->accessToken;
        $response = $this->get(
            route('frontend-json-store', ['json' => json_encode(['test' => 'test'])]),
            [
                'Authorization' => 'Bearer ' . $token
            ]
        );

        $response->assertStatus(200);
        $json = $response->getContent();
        $this->assertJson($json);
        $data = json_decode($json, true);
        $this->assertIsInt($data['id']);
        Json::destroy($data['id']);
        $user->delete();
        $this->assertTrue(true);
    }

    public function test_not_valid_json()
    {
        $user = User::factory()->create();
        $token = $user->createToken('authToken')->accessToken;
        $response = $this->post(
            route('frontend-json-store'),
            [
                'json' => "{'a1':1}]",
            ],
            [
                'Authorization' => 'Bearer ' . $token
            ]
        );
        $response->assertStatus(302);
        $user->delete();
        $this->assertTrue(true);
    }
}
