<?php

namespace Tests\v1\Frontend\User\Attestation;

use App\Models\Account\Account;
use App\Models\User\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AttestationFeatureTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

        private $user;
        private $account;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->account = factory(Account::class)->create(['user_id' => $this->user->id]);
    }

    public function testGetAttestationTypes()
    {
        $response = $this->actingAs($this->user)->get('/api/v1/attestations');
        $response->assertJson(
            [
                "code" => 0,
                "data" => [
                    [
                        "name" => "Неидентифицированный",
                        "code" => "NOT_IDENTIFIED",
                        "day_limit" => 1000,
                        "week_limit" => 2500,
                        "month_limit" => 2500,
                        "balance_limit" => 1000,
                        "is_active" => 1,
                        "used_limit" => [
                            "day" =>
                            [
                                "limit" => 0,
                                "updated_at" => "2018-07-31 17:41:57",
                            ],
                            "week" =>
                            [
                                "limit" => 0,
                                "updated_at" => "2018-07-31 17:41:57",
                            ],
                            "month" =>
                            [
                                "limit" => 0,
                                "updated_at" => "2018-07-31 17:41:57",
                            ],
                        ],
                    ],
                    [
                        "name" => "Идентифицированный",
                        "code" => "IDENTIFIED",
                        "day_limit" => 25000,
                        "week_limit" => 25000,
                        "month_limit" => 25000,
                        "balance_limit" => 10000,
                    ],
                ],

            ]
        );
    }
}
