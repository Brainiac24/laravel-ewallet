<?php

namespace Tests\v1\Frontend\Setting;

use App\Models\User\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class SettingFeatureTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    private $user;

    public function setUp()
    {
        parent::setUp();
        
        $this->user = factory(User::class)->create();
    }

    public function testGetNotifications()
    {
        $response = $this->actingAs($this->user)->get('/api/v1/settings/notifications');
        $response->assertJson(
            [
                "code" => 0,
                "data" => [
                    [
                        "name" => "Push уведомление",
                        "code" => "push",
                        "comment" => "",
                    ],
                    [
                        "name" => "Email уведомление",
                        "code" => "email",
                        "comment" => "",
                    ],
                ],

            ]
        );
    }

    public function testUpdateUserData()
    {
        
        $response = $this->actingAs($this->user)->json('PUT', '/api/v1/settings/notifications', [
            "code" => 'push',
            "is_active" => "0",
        ]);

        $response->assertJson(
            [
                'code' => 0,
            ]
        );
    }

}
