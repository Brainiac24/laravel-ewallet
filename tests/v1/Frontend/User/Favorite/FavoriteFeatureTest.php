<?php

namespace Tests\v1\Frontend\User\Favorite;

use App\Models\Favorite\Favorite;
use App\Models\User\User;
use App\Services\Common\Helpers\Service;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class FavoriteFeatureTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    private $user;
    private $favorite;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->favorite = factory(Favorite::class)->create(['user_id' => $this->user->id]);

    }

    public function testInsertFavorite()
    {
        $response = $this->actingAs($this->user)->json('POST', '/api/v1/favorites', [
            "name" => 'Оплата1',
            "service_id" => Service::MOBILE_TCELL_TJ,
            "amount" => 10,
            "params" => [
                1 => [
                    'key' => 'phone_number',
                    'value' => '992927777777',
                ],
                2 => [
                    'key' => 'card_number',
                    'value' => '1234567891234567',
                ],
            ],
        ]);

        $response->assertJson(
            [
                'code' => 0,
            ]
        );

    }

    public function testUpdateFavorite()
    {
        $response = $this->actingAs($this->user)->json('PUT', '/api/v1/favorites/'.$this->favorite->id, [
            "name" => 'Оплата2',
            "service_id" => Service::MOBILE_TCELL_TJ,
            "amount" => 5,
            "params" => [
                1 => [
                    'key' => 'phone_number',
                    'value' => '992920000000',
                ],
                2 => [
                    'key' => 'card_number',
                    'value' => '2134567891234567',
                ],
            ],
        ]);

        $response->assertJson(
            [
                'code' => 0,
            ]
        );
    }

    public function testDeleteFavorite()
    {
        $response = $this->actingAs($this->user)->json('DELETE', '/api/v1/favorites/'.$this->favorite->id);

        $response->assertJson(
            [
                'code' => 0,
            ]
        );
    }
}
