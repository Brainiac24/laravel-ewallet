<?php

namespace Tests\v1\Frontend\User;

use App\Models\Account\Account;
use App\Models\User\User;
use App\Services\Backend\Api\User\UserService;
use Illuminate\Container\Container;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserFeatureTest extends TestCase
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

    public function testGetUserMainData()
    {
        $response = $this->actingAs($this->user)->get('/api/v1/users/main');
        $response->assertJson(
            [
                "code" => 0,
                "data" => [
                    "photo_url" => "image.jpg",
                    "msisdn" => "992927777777",
                    "first_name" => "TestName",
                    "last_name" => "TestLastName",
                    "middle_name" => "TestMiddleName",
                    "date_birth" => "1992-06-24",
                    "gender" => 1,
                    "username" => "992927777777",
                    "email" => "test@gmail.com",
                    "attestation_name" => "Неидентифицированный",
                    "qr_code" => "eyJzZXJ2aWNlX2lkIjoiOTZlOGI3ODUtYjFiOS0xMWU4LTkwNGItYjA2ZWJmYmZhNzE1IiwicGhvbmUiOiI5Mjc3Nzc3NzcifQ==",
                    "accounts" => [
                        [
                            "balance" => 500,
                            "number" => "1000000000000001",
                            "currency_iso_name" => "TJS",
                            "account_type_name" => "Эсхата Онлайн",
                        ],
                    ],
                ],
                "meta" => [
                    "menu_version" => "0",
                    "is_editable" => 1,
                ],
            ]
        );
    }

    public function testUpdateUserData()
    {
        Storage::fake('avatars');

        //$file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($this->user)->json('PUT', '/api/v1/users', [
            //"photo" =>  $file,
            "first_name" => "TestName2",
            "last_name" => "TestLastName2",
            "middle_name" => "TestMiddleName2",
            "date_birth" => "1993-07-25",
            "gender" => "1",
        ]);

        //Storage::disk('avatars')->assertExists($file->hashName());

        $response->assertJson(
            [
                'code' => 0,
            ]
        );


    }

    public function testCheckExistTempUser()
    {
        
        Container::getInstance()->make(UserService::class)->checkExistTempUser();

        $this->assertDatabaseHas('users', [
            'id' => '74016b8a-ba71-11e8-92b3-b06ebfbfa715',
            'code_map' => '14952689647',
        ]);
       
    }

}
