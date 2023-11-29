<?php

namespace Tests\v1\Frontend\Service;

use App\Models\Account\Account;
use App\Models\User\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ServiceFeatureTest extends TestCase
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

    public function testGetCategories()
    {
        $response = $this->actingAs($this->user)->get('/api/v1/categories');
        $response->assertJsonStructure(
            [
                "code",
                "data" => [
                    [
                        "id",
                        "code",
                        "name",
                        "type",
                        "icon",
                        "child",
                    ],
                ],
            ]

        );
    }

    public function testCheckCategoriesService()
    {
        $response = $this->actingAs($this->user)->get('/api/v1/categories');
        $response->assertJsonFragment(
            [

                "id" => "14f8e166-9fb5-11e8-904b-b06ebfbfa715",
                "name" => "Tcell",
                "code" => "MOBILE_TCELL_TJ",
                "type" => "service",

            ]
        );
    }

    public function testGetServiceById()
    {
        $response = $this->actingAs($this->user)->get('/api/v1/services/14f8e166-9fb5-11e8-904b-b06ebfbfa715');
        $response->assertJson(
            [
                "code" => "0",
                "data" => [
                    "name" => "Tcell",
                    "code" => "MOBILE_TCELL_TJ",
                    "type" => "service",
                    "currency_iso" => "TJS",
                    "min_amount" => 1,
                    "max_amount" => 5000,
                    "is_requestable_balance" => 0,
                    "params" => [
                        [
                            "input_placeholder" => "Номер телефона",
                            "input_name" => "phone_number",
                            "input_type" => "number",
                            "keyboard_type" => "phone",
                            "icon_url" => "tcell.png",
                            "regexp" => "(92|93|50|77){1}\\d{7}",
                            "chars_mask" => "__ ___ __ __",
                            "min_length" => 9,
                            "max_length" => 9
                        ]
                    ],
                    "accounts" => [
                        [
                            "balance" => 500,
                            "number" => "1000000000000001",
                            "currency_iso_name" => "TJS",
                            "account_type_name" => "Эсхата Онлайн"
                        ]
                    ],
                    "current_limits" => [
                        "day_limit" => 1000,
                        "week_limit" => 2500,
                        "month_limit" => 2500,
                        "balance_limit" => 500
                    ]
                ],
            ]

        );
    }
}
