<?php

namespace Tests\v1\Frontend\Transaction;

use App\Models\Account\Account;
use App\Models\User\User;
use App\Models\User\UserSession\UserSession;
use App\Repositories\Frontend\Transaction\TransactionRepositoryContract;
use App\Services\Common\Helpers\Attestation;
use App\Services\Frontend\Api\Transaction\TransactionServiceContract;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\App;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class TransactionConfirmFeatureTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    protected $transactionRepository;
    protected $transactionService;

    public function setUp()
    {
        parent::setUp();
        $this->transactionRepository = \App::make(TransactionRepositoryContract::class);
        $this->transactionService = \App::make(TransactionServiceContract::class);
    }

    public function testApi()
    {
        Carbon::setTestNow('2018-10-18 14:00');
        //-------------------------------------------------------------
        $user_arr = [
            'id' => Uuid::uuid4()->toString(),
            'attestation_id' => Attestation::NOT_IDENTIFIED,
            'username' => '992927771001',
            'msisdn' => '992927771001',
            'email' => 'test1@gmail.com',
        ];
        //-------------------------------------------------------------
        $account_arr = [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_arr['id'],
            'balance' => 1000,
            'number' => '1000000000001001',
        ];
        //-------------------------------------------------------------

        $user = factory(User::class)->create($user_arr);
        $account = factory(Account::class)->create($account_arr);
        $session = factory(UserSession::class)->create(['user_id' => $user->id]);

        //-------------------------------------------------------------
        $response_transaction_arr = [
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 100,
            'params' => [
                [
                    'key' => 'phone_number',
                    'value' => '928553004',
                ],
            ],
            'from_account_number' => $account->number,
            'commission' => 0.2,
            'add_to_favorite' => 1,
        ];
        $response_transaction = $this->actingAs($user)->json('POST', '/api/v1/transactions', $response_transaction_arr);

        //-------------------------------------------------------------
        $data = json_decode($response_transaction->getContent())->data;
        //dd($data->transaction_id);

        if (isset($data->transaction_id)) {

            $transaction = $this->transactionRepository->getByIdWithoutGlobalScopes($data->transaction_id);
            $response_confirm_arr = [
                'hash_code' => $this->transactionService->makeHash($transaction->user->user_session->access_token, $transaction->sms_code, $transaction->user->devices_json['id'], $transaction->user->devices_json['platform']), //Tcell
                'transaction_id' => $data->transaction_id,

            ];

            $response_confirm = $this->actingAs($user)->json('POST', '/api/v1/transactions/confirm', $response_confirm_arr);

            $assert_arr = [
                "code" => 0,
                "message" => "Транзакция принята на обработку.",
            ];
            $response_confirm->assertJson($assert_arr);

        }

        Carbon::setTestNow();
    }

    public function testApiStructure()
    {
        Carbon::setTestNow('2018-10-18 14:00');
        //-------------------------------------------------------------
        $user_arr = [
            'id' => Uuid::uuid4()->toString(),
            'attestation_id' => Attestation::NOT_IDENTIFIED,
            'username' => '992927771001',
            'msisdn' => '992927771001',
            'email' => 'test1@gmail.com',

        ];
        //-------------------------------------------------------------
        $account_arr = [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_arr['id'],
            'balance' => 2000,
            'number' => '1000000000001001',
        ];
        //-------------------------------------------------------------

        $user = factory(User::class)->create($user_arr);
        $account = factory(Account::class)->create($account_arr);
        $session = factory(UserSession::class)->create(['user_id' => $user->id]);

        //-------------------------------------------------------------
        $response_transaction_arr = [
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 100,
            'params' => [
                [
                    'key' => 'phone_number',
                    'value' => '928553004',
                ],
            ],
            'from_account_number' => $account->number,
            'commission' => 0.2,
            'add_to_favorite' => 1,
        ];
        $response_transaction = $this->actingAs($user)->json('POST', '/api/v1/transactions', $response_transaction_arr);

        //-------------------------------------------------------------
        $data = json_decode($response_transaction->getContent())->data;
        //dd($data->transaction_id);

        if (isset($data->transaction_id)) {

            $transaction = $this->transactionRepository->getByIdWithoutGlobalScopes($data->transaction_id);
            $response_confirm_arr = [
                'hash_code' => $this->transactionService->makeHash($transaction->user->user_session->access_token, $transaction->sms_code, $transaction->user->devices_json['id'], $transaction->user->devices_json['platform']), //Tcell
                'transaction_id' => $data->transaction_id,

            ];

            $response_confirm = $this->actingAs($user)->json('POST', '/api/v1/transactions/confirm', $response_confirm_arr);

            $assert_arr = [
                "code",
                "message",
                "data" => [
                    "balance",
                ],
            ];
            $response_confirm->assertJsonStructure($assert_arr);

        }

        Carbon::setTestNow();

    }

    public function testPaymentAccountBlockCheck()
    {
        Carbon::setTestNow('2018-10-18 14:00');
        //-------------------------------------------------------------
        $user_arr = [
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
                    "limit" => 500,
                    "updated_at" => Carbon::yesterday()->format('Y-m-d H:i:s'),
                ],
                "month" =>
                [
                    "limit" => 500,
                    "updated_at" => Carbon::yesterday()->format('Y-m-d H:i:s'),
                ],
            ],

        ];
        //-------------------------------------------------------------
        $account_arr = [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_arr['id'],
            'balance' => 1000,
            'number' => '1000000000001001',
        ];
        //-------------------------------------------------------------

        $user = factory(User::class)->create($user_arr);
        $account = factory(Account::class)->create($account_arr);
        $session = factory(UserSession::class)->create(['user_id' => $user->id]);

        //-------------------------------------------------------------
        $response_transaction_arr = [
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 100,
            'params' => [
                [
                    'key' => 'phone_number',
                    'value' => '928553004',
                ],
            ],
            'from_account_number' => $account->number,
            'commission' => 0.2,
            'add_to_favorite' => 1,
        ];
        $response_transaction = $this->actingAs($user)->json('POST', '/api/v1/transactions', $response_transaction_arr);

        //-------------------------------------------------------------
        $data = json_decode($response_transaction->getContent())->data;
        //dd($data->transaction_id);

        if (isset($data->transaction_id)) {

            $transaction = $this->transactionRepository->getByIdWithoutGlobalScopes($data->transaction_id);
            $response_confirm_arr = [
                'hash_code' => $this->transactionService->makeHash($transaction->user->user_session->access_token, $transaction->sms_code, $transaction->user->devices_json['id'], $transaction->user->devices_json['platform']), //Tcell
                'transaction_id' => $data->transaction_id,

            ];

            $response_confirm = $this->actingAs($user)->json('POST', '/api/v1/transactions/confirm', $response_confirm_arr);

            $this->assertDatabaseHas('accounts', [
                'id' => $account->id,
                'balance' => 1000,
                'blocked_balance' => 100,
            ]);

        }

        Carbon::setTestNow();
    }

    public function testEwalletAccountCalculateCheck()
    {
        Carbon::setTestNow('2018-10-18 14:00');
        //-------------------------------------------------------------
        $user_arr = [
            'id' => Uuid::uuid4()->toString(),
            'attestation_id' => Attestation::IDENTIFIED,
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
                    "limit" => 500,
                    "updated_at" => Carbon::yesterday()->format('Y-m-d H:i:s'),
                ],
                "month" =>
                [
                    "limit" => 500,
                    "updated_at" => Carbon::yesterday()->format('Y-m-d H:i:s'),
                ],
            ],

        ];

        $account_arr = [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_arr['id'],
            'balance' => 1000,
            'number' => '1000000000001001',
        ];
//-------------------------------------------------------------
        $user_arr_2 = [
            'id' => Uuid::uuid4()->toString(),
            'attestation_id' => Attestation::IDENTIFIED,
            'username' => '992927771002',
            'msisdn' => '992927771002',
            'email' => 'test2@gmail.com',
            'limits_json' => [
                "day" =>
                [
                    "limit" => 500,
                    "updated_at" => Carbon::yesterday()->format('Y-m-d H:i:s'),
                ],
                "week" =>
                [
                    "limit" => 500,
                    "updated_at" => Carbon::yesterday()->format('Y-m-d H:i:s'),
                ],
                "month" =>
                [
                    "limit" => 500,
                    "updated_at" => Carbon::yesterday()->format('Y-m-d H:i:s'),
                ],
            ],

        ];

        $account_arr_2 = [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_arr_2['id'],
            'balance' => 0,
            'number' => '1000000000001002',
        ];
        //-------------------------------------------------------------

        $user = factory(User::class)->create($user_arr);
        $user_2 = factory(User::class)->create($user_arr_2);
        $account = factory(Account::class)->create($account_arr);
        $account_2 = factory(Account::class)->create($account_arr_2);
        $session = factory(UserSession::class)->create(['user_id' => $user->id]);

        //-------------------------------------------------------------
        $response_transaction_arr = [
            'service_id' => '96e8b785-b1b9-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 100,
            'params' => [
                [
                    'key' => 'phone_number',
                    'value' => '992927771002',
                ],
            ],
            'from_account_number' => $account->number,
            'commission' => 0.2,
            'add_to_favorite' => 1,
        ];
        $response_transaction = $this->actingAs($user)->json('POST', '/api/v1/transactions', $response_transaction_arr);

        //-------------------------------------------------------------
        $data = json_decode($response_transaction->getContent())->data;
        //dd($data->transaction_id);

        if (isset($data->transaction_id)) {

            $transaction = $this->transactionRepository->getByIdWithoutGlobalScopes($data->transaction_id);
            $response_confirm_arr = [
                'hash_code' => $this->transactionService->makeHash($transaction->user->user_session->access_token, $transaction->sms_code, $transaction->user->devices_json['id'], $transaction->user->devices_json['platform']), //Tcell
                'transaction_id' => $data->transaction_id,

            ];

            $response_confirm = $this->actingAs($user)->json('POST', '/api/v1/transactions/confirm', $response_confirm_arr);

            $assert_arr = [
                "code" => 0,
                "message" => "Транзакция принята на обработку.",
            ];
            $response_confirm->assertJson($assert_arr);

            $this->assertDatabaseHas('accounts', [
                'id' => $account->id,
                'balance' => 900,
                'blocked_balance' => 0,
            ]);

            $this->assertDatabaseHas('accounts', [
                'id' => $account_2->id,
                'balance' => 100,
                'blocked_balance' => 0,
            ]);

        }

        Carbon::setTestNow();
    }

    public function testRetrySendSms()
    {
        Carbon::setTestNow('2018-10-18 14:00');
        //-------------------------------------------------------------
        $user_arr = [
            'id' => Uuid::uuid4()->toString(),
            'attestation_id' => Attestation::NOT_IDENTIFIED,
            'username' => '992927771001',
            'msisdn' => '992927771001',
            'email' => 'test1@gmail.com',
        ];
        //-------------------------------------------------------------
        $account_arr = [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_arr['id'],
            'balance' => 1000,
            'number' => '1000000000001001',
        ];
        //-------------------------------------------------------------

        $user = factory(User::class)->create($user_arr);
        $account = factory(Account::class)->create($account_arr);
        $session = factory(UserSession::class)->create(['user_id' => $user->id]);

        //-------------------------------------------------------------
        $response_transaction_arr = [
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 100,
            'params' => [
                [
                    'key' => 'phone_number',
                    'value' => '928553004',
                ],
            ],
            'from_account_number' => $account->number,
            'commission' => 0.2,
            'add_to_favorite' => 1,
        ];
        $response_transaction = $this->actingAs($user)->json('POST', '/api/v1/transactions', $response_transaction_arr);

        //-------------------------------------------------------------
        $data = json_decode($response_transaction->getContent())->data;
        //dd($data->transaction_id);

        if (isset($data->transaction_id)) {

            $transaction = $this->transactionRepository->getByIdWithoutGlobalScopes($data->transaction_id);
            $response_confirm_arr = [
                'hash_code' => $this->transactionService->makeHash($transaction->user->user_session->access_token, $transaction->sms_code, $transaction->user->devices_json['id'], $transaction->user->devices_json['platform']), //Tcell
                'transaction_id' => $data->transaction_id,

            ];

            Carbon::setTestNow('2018-10-18 14:01:05');

            $response_confirm = $this->actingAs($user)->get('/api/v1/transactions/confirm/retry/' . $data->transaction_id);

            $assert_arr = [
                "code" => 0,
            ];
            $response_confirm->assertJson($assert_arr);

        }

        Carbon::setTestNow();
    }

}
