<?php

namespace Tests\Feature;

use App\Models\Url;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UrlApiTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A valid POST request made to the api.url.encodeUrl endpoint.
     */
    public function test_encode_url(): void
    {
        $response = $this->withHeaders([
            'Authorization' => self::bearerToken()
        ])->postJson('/api/encode_url',
            ['original_url' => 'https://atarim.io']
        );

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'original_url',
                    'short_url'
                ]
            ]);

    }

    /**
     * A valid GET request made to the api.url.decodeUrl endpoint.
     */
    public function test_decode_url(): void
    {
        $url = Url::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => self::bearerToken()
        ])->getJson("/api/decode_url/{$url->short_url}");

        $response
            ->assertStatus(200)
            ->assertJson([
                'decoded_url' => $url->original_url,
            ]);
    }

    /**
     * An invalid token GET request made to the api.url.decodeUrl endpoint.
     */
    public function test_invalid_token(): void
    {
        $url = Url::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'foo_bob'
        ])->getJson("/api/decode_url/{$url->short_url}");

        $response->assertStatus(401);
    }

    // Would be nice to create a custom helper e.g. bearer_token(), but this'll do
    // for brevity's sake.
    private static function bearerToken(): String
    {
        return 'Bearer ' . config('sanctum.api_token');
    }
}
