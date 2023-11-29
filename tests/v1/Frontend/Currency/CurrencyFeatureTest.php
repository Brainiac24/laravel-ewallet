<?php

namespace Tests\v1\Frontend\Currency;

use App\Models\User\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CurrencyFeatureTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    private $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

    }

    public function testGetCurrency()
    {
        $response = $this->actingAs($this->user)->get('/api/v1/currencies');
        $response->assertJsonStructure(
            [
                "code",
                "data" => [
                    [
                        "iso_name",
                        "rate_buy",
                        "rate_sell"
                    ],
                    [
                        "iso_name",
                        "rate_buy",
                        "rate_sell"
                    ],
                    [
                        "iso_name",
                        "rate_buy",
                        "rate_sell"
                    ]

                ],

            ]

        );
    }
}
