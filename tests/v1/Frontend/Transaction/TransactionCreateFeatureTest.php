<?php

namespace Tests\v1\Frontend\Transaction;

use App\Models\Account\Account;
use App\Models\User\User;
use App\Services\Common\Helpers\Attestation;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class TransactionCreateFeatureTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    private $user;
    private $user_identified;
    private $account;
    private $counter = 1000;
    private $transaction_id = null;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->user_identified = factory(User::class)->create([
            'id' => 'b10f05c4-cbb1-11e8-993a-b06ebfbfa715',
            'attestation_id' => Attestation::IDENTIFIED,
            'username' => '99292777' . $this->counter,
            'msisdn' => '99292777' . $this->counter,
            'email' => 'test' . $this->counter . '@gmail.com',
        ]);
        $this->account = factory(Account::class)->create([
            'user_id' => $this->user->id,
        ]);
        $this->account_identified = factory(Account::class)->create([
            'user_id' => $this->user_identified->id,
            'balance' => 5000,
            'id' => '8917981b-cd19-11e8-993a-b06ebfbfa715',
            'number' => '1000000000000' . $this->counter,
        ]);
    }

    public function testApi()
    {
        $response = $this->actingAs($this->user)->json('POST', '/api/v1/transactions', [
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 5,
            'params' => [
                [
                    'key' => 'phone_number',
                    'value' => '928553004',
                ],
            ],
            'from_account_number' => $this->account->number,
            'commission' => 0.2,
            'add_to_favorite' => 1,
        ]);

        //$res = json_decode($response->getContent());
        //dd($res->data->transaction_id);
        //$this->transaction_id = $res->data->transaction_id;
        

        $response->assertJson(
            [
                'code' => 0,
            ]
        );

    }

    public function testApiStructure()
    {
        $response = $this->actingAs($this->user)->json('POST', '/api/v1/transactions', [
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 5,
            'params' => [
                [
                    'key' => 'phone_number',
                    'value' => '928553004',
                ],
            ],
            'from_account_number' => $this->account->number,
            'commission' => 0.2,
            'add_to_favorite' => 1,
        ]);

        //dd($this->transaction_id);

        $response->assertJsonStructure(
            [
                'code',
                "data" => [
                    "transaction_id",
                ],
            ]
        );

    }

    

    public function testServiceNotExistOrNotActive()
    {
        $response = $this->actingAs($this->user)->json('POST', '/api/v1/transactions', [
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa7151', //Tcell - last char added '1'
            'amount' => 5,
            'params' => [
                [
                    'key' => 'phone_number',
                    'value' => '928553004',
                ],
            ],
            'from_account_number' => $this->account->number,
            'commission' => 0.2,
            'add_to_favorite' => 1,
        ]);

        $response->assertJson(
            [
                'code' => 12,
                'message' => trans('service.errors.code_not_found'),
            ]
        );

    }

    public function testServiceMaxAmount()
    {
        $old_balance = $this->account->balance;
        $this->account->balance = 100000;
        $this->account->save();
        $response = $this->actingAs($this->user)->json('POST', '/api/v1/transactions', [
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 100000, //max amount is 5000
            'params' => [
                [
                    'key' => 'phone_number',
                    'value' => '928553004',
                ],
            ],
            'from_account_number' => $this->account->number,
            'commission' => 0.2,
            'add_to_favorite' => 1,
        ]);

        $response->assertJson(
            [
                'code' => 12,
                'message' => trans('service.errors.min_max_ammount_not_match'),
            ]
        );

        $this->account->balance = $old_balance;

    }

    public function testCheckDayLimits()
    {
        $this->counter++;
        $user_temp = factory(User::class)->create([
            'id' => Uuid::uuid4()->toString(),
            'attestation_id' => Attestation::NOT_IDENTIFIED,
            'username' => '99292777' . $this->counter,
            'msisdn' => '99292777' . $this->counter,
            'email' => 'test' . $this->counter . '@gmail.com',
            'limits_json' => [
                "day" =>
                [
                    "limit" => 500,
                    "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                "week" =>
                [
                    "limit" => 500,
                    "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                "month" =>
                [
                    "limit" => 500,
                    "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ],
        ]);

        $account_temp = factory(Account::class)->create([
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_temp->id,
            'balance' => 900,
            'number' => '100000000000' . $this->counter,
        ]);

        //dd($account_temp->balance);

        $response = $this->actingAs($user_temp)->json('POST', '/api/v1/transactions', [
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 700,
            'params' => [
                [
                    'key' => 'phone_number',
                    'value' => '928553004',
                ],
            ],
            'from_account_number' => $account_temp->number,
            'commission' => 0.2,
            'add_to_favorite' => 1,
        ]);

        $response->assertJson(
            [
                'code' => 14,
                'message' => 'Достигнут дневной лимит операции. Доступный лимит: 500.',
            ]
        );

    }

    public function testCheckWeekLimits()
    {
         
        Carbon::setTestNow('2018-10-18 14:00');

        $this->counter++;
        $user_temp = factory(User::class)->create([
            'id' => Uuid::uuid4()->toString(),
            'attestation_id' => Attestation::NOT_IDENTIFIED,
            'username' => '99292777' . $this->counter,
            'msisdn' => '99292777' . $this->counter,
            'email' => 'test' . $this->counter . '@gmail.com',
            'limits_json' => [
                "day" =>
                [
                    "limit" => 500,
                    "updated_at" => Carbon::yesterday()->format('Y-m-d H:i:s'),
                ],
                "week" =>
                [
                    "limit" => 2400,
                    "updated_at" => Carbon::yesterday()->format('Y-m-d H:i:s'),
                ],
                "month" =>
                [
                    "limit" => 500,
                    "updated_at" => Carbon::yesterday()->format('Y-m-d H:i:s'),
                ],
            ],
        ]);

        $account_temp = factory(Account::class)->create([
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_temp->id,
            'balance' => 1000,
            'number' => '100000000000' . $this->counter,
        ]);

        $response = $this->actingAs($user_temp)->json('POST', '/api/v1/transactions', [
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 600,
            'params' => [
                [
                    'key' => 'phone_number',
                    'value' => '928553004',
                ],
            ],
            'from_account_number' => $account_temp->number,
            'commission' => 0.2,
            'add_to_favorite' => 1,
        ]);

        $response->assertJson(
            [
                'code' => 14,
                'message' => 'Достигнут недельный лимит операции. Доступный лимит: 100.',
            ]
        );

        Carbon::setTestNow();

    }

    public function testCheckMonthLimits()
    {
        Carbon::setTestNow('2018-10-18 14:00');
       
        $user_temp = factory(User::class)->create([
            'id' => Uuid::uuid4()->toString(),
            'attestation_id' => Attestation::NOT_IDENTIFIED,
            'username' => '992927771001',
            'msisdn' => '992927771001',
            'email' => 'test1@gmail.com',
            'limits_json' => [
                "day" =>
                [
                    "limit" => 500,
                    "updated_at" => Carbon::yesterday()->format('Y-m-d H:i:s'),
                ],
                "week" =>
                [
                    "limit" => 1000,
                    "updated_at" => Carbon::yesterday()->format('Y-m-d H:i:s'),
                ],
                "month" =>
                [
                    "limit" => 2400,
                    "updated_at" => Carbon::yesterday()->format('Y-m-d H:i:s'),
                ],
            ],
        ]);

        $account_temp = factory(Account::class)->create([
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_temp->id,
            'balance' => 2000,
            'number' => '1000000000001001',
        ]);

        $response = $this->actingAs($user_temp)->json('POST', '/api/v1/transactions', [
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 600,
            'params' => [
                [
                    'key' => 'phone_number',
                    'value' => '928553004',
                ],
            ],
            'from_account_number' => $account_temp->number,
            'commission' => 0.2,
            'add_to_favorite' => 1,
        ]);

        $response->assertJson(
            [
                'code' => 14,
                'message' => 'Достигнут месячный лимит операции. Доступный лимит: 100.',
            ]
        );

        Carbon::setTestNow();

    }
    
    
}
