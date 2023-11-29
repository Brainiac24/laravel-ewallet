<?php

namespace Tests\v1\Frontend\Account;

use App\Models\Account\Account;
use App\Models\User\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AccountFeatureTest extends TestCase
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

    public function testGetBalanceApi()
    {
        //$this->assertTrue(false);

        $response = $this->actingAs($this->user)->get('/api/v1/accounts/summary/' . $this->account->number);
        $response->assertJson(
            [
                "code" => "0",
                "data" => [
                    "balance" => 500,
                    "number" => $this->account->number,
                    "currency_iso_name" => "TJS",
                    "account_type_name" => "Эсхата Онлайн",
                ],
            ]
        );

    }

    public function testGetBalanceWithLimitsApi()
    {
        //$this->assertTrue(false);

        $response = $this->actingAs($this->user)->get('/api/v1/accounts/' . $this->account->number);
        $response->assertJson(
            [
                "code" => "0",
                "data" => [
                    "balance" => 500,
                    "number" => $this->account->number,
                    "currency_iso_name" => "TJS",
                    "account_type_name" => "Эсхата Онлайн",
                    "current_limits" => [
                        "day_limit" => 1000,
                        "week_limit" => 2500,
                        "month_limit" => 2500,
                        "balance_limit" => 500,
                    ],
                ],
            ]
        );

    }
}
