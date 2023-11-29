<?php

namespace Tests\v1\Frontend\Transaction;

use App\Models\Account\Account;
use App\Models\Transaction\Transaction;
use App\Models\User\User;
use App\Services\Common\Gateway\Queue\QueueHashContract;
use App\Services\Common\Helpers\Attestation;
use App\Services\Common\Helpers\TransactionStatus;
use App\Services\Common\Helpers\TransactionStatusDetail;
use App\Services\Common\Helpers\TransactionType;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\App;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class TransactionChangeStatusFeatureTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    protected $hash;

    public function setUp()
    {
        parent::setUp();
        $this->hash = App::make(QueueHashContract::class);
    }

    public function testInProcessing()
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

        $account_arr = [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_arr['id'],
            'balance' => 500,
            'blocked_balance' => 5,
            'number' => '1000000000001001',
        ];

        //-------------------------------------------------------------

        $user = factory(User::class)->create($user_arr);
        $account = factory(Account::class)->create($account_arr);

        //-------------------------------------------------------------

        $transaction_arr = [

            'id' => Uuid::uuid4()->toString(),
            'from_account_id' => $account->id,
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 5,
            'params_json' => [
                [
                    "key" => "phone_number",
                    "value" => "992928553004",
                    "name" => "Номер получателя",
                ],
                [
                    "key" => "comment",
                    "value" => "ЦУ 123 qwe йцу",
                    "name" => "Комментарий",
                ],
            ],
            'session_number' => 999999999,
            'transaction_type_id' => TransactionType::PAYMENT, 
            'transaction_status_id' => TransactionStatus::new, 
            'transaction_status_detail_id' => TransactionStatusDetail::OK, 
            'add_to_favorite' => 1,
            'currency_iso_name' => 'TJS',
            'created_by_user_id' => $user->id,
            'is_queued' => 0,
            'session_in' => 0,

        ];

        $transaction = factory(Transaction::class)->create($transaction_arr);



        $datetime = Carbon::now()->format('ymdHis');

        $queue_arr_payload = [
            'transaction_id' => $transaction->id,
            'status_id' => TransactionStatus::PAY_IN_PROCESS,
            'status_detail_id' => TransactionStatusDetail::OK,
            'comment' => 'test',
        ];

        $queue_arr = [
            'payload' => $queue_arr_payload,
            'hash' => $this->hash->make($datetime, $queue_arr_payload),
            'datetime' => $datetime,
        ];

        $response_transaction = $this->actingAs($user)->json('POST', '/api/v1/transactions/status', $queue_arr);
       
        $this->assertDatabaseHas('accounts', [
            'id' => $account->id,
            'balance' => 500,
            'blocked_balance' => 5,
        ]);

        Carbon::setTestNow();
    }

    public function testAccepted()
    {
        //Carbon::setTestNow('2018-10-18 14:00');
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

        $account_arr = [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_arr['id'],
            'balance' => 500,
            'blocked_balance' => 5,
            'number' => '1000000000001001',
        ];

        //-------------------------------------------------------------

        $user = factory(User::class)->create($user_arr);
        $account = factory(Account::class)->create($account_arr);

        //-------------------------------------------------------------

        $transaction_arr = [

            'id' => Uuid::uuid4()->toString(),
            'from_account_id' => $account->id,
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 5,
            'params_json' => [
                [
                    "key" => "phone_number",
                    "value" => "992928553004",
                    "name" => "Номер получателя",
                ],
                [
                    "key" => "comment",
                    "value" => "ЦУ 123 qwe йцу",
                    "name" => "Комментарий",
                ],
            ],
            'session_number' => 999999999,
            'transaction_type_id' => TransactionType::PAYMENT, 
            'transaction_status_id' => TransactionStatus::new, 
            'transaction_status_detail_id' => TransactionStatusDetail::OK, 
            'add_to_favorite' => 1,
            'currency_iso_name' => 'TJS',
            'created_by_user_id' => $user->id,
            'is_queued' => 0,
            'session_in' => 0,

        ];

        $transaction = factory(Transaction::class)->create($transaction_arr);

//dd(Carbon::tomorrow()->format('ymdHis'));

        $datetime = Carbon::now()->format('ymdHis');

        $queue_arr_payload = [
            'transaction_id' => $transaction->id,
            'status_id' => TransactionStatus::PAY_ACCEPTED,
            'status_detail_id' => TransactionStatusDetail::OK,
            'comment' => 'test',
        ];

        $queue_arr = [
            'payload' => $queue_arr_payload,
            'hash' => $this->hash->make($datetime, $queue_arr_payload),
            'datetime' => $datetime,
        ];

        $response_transaction = $this->actingAs($user)->json('POST', '/api/v1/transactions/status', $queue_arr);

        $response_transaction->assertJson(
            [
                'success' => true,
                'errors' => null,
                'message' => 'Успешно',
            ]
        );
       
        $this->assertDatabaseHas('accounts', [
            'id' => $account->id,
            'balance' => 500,
            'blocked_balance' => 5,
        ]);

        //Carbon::setTestNow();
    }

    public function testCompleted()
    {
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

        $account_arr = [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_arr['id'],
            'balance' => 500,
            'blocked_balance' => 5.2,
            'number' => '1000000000001001',
        ];

        //-------------------------------------------------------------

        $user = factory(User::class)->create($user_arr);
        $account = factory(Account::class)->create($account_arr);

        //-------------------------------------------------------------

        $transaction_arr = [

            'id' => Uuid::uuid4()->toString(),
            'from_account_id' => $account->id,
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 5,
            'commission' => 0.2,
            'params_json' => [
                [
                    "key" => "phone_number",
                    "value" => "992928553004",
                    "name" => "Номер получателя",
                ],
                [
                    "key" => "comment",
                    "value" => "ЦУ 123 qwe йцу",
                    "name" => "Комментарий",
                ],
            ],
            'session_number' => 999999999,
            'transaction_type_id' => TransactionType::PAYMENT, 
            'transaction_status_id' => TransactionStatus::new, 
            'transaction_status_detail_id' => TransactionStatusDetail::OK, 
            'add_to_favorite' => 1,
            'currency_iso_name' => 'TJS',
            'created_by_user_id' => $user->id,
            'is_queued' => 0,
            'session_in' => 0,

        ];

        $transaction = factory(Transaction::class)->create($transaction_arr);

        $datetime = Carbon::now()->format('ymdHis');

        $queue_arr_payload = [
            'transaction_id' => $transaction->id,
            'status_id' => TransactionStatus::COMPLETED,
            'status_detail_id' => TransactionStatusDetail::OK,
            'comment' => 'test',
        ];

        $queue_arr = [
            'payload' => $queue_arr_payload,
            'hash' => $this->hash->make($datetime, $queue_arr_payload),
            'datetime' => $datetime,
        ];


        $response_transaction = $this->actingAs($user)->json('POST', '/api/v1/transactions/status', $queue_arr);

        $response_transaction->assertJson(
            [
                'success' => true,
                'errors' => null,
                'message' => 'Успешно',
            ]
        );
       
        $this->assertDatabaseHas('accounts', [
            'id' => $account->id,
            'balance' => 494.8,
            'blocked_balance' => 0,
        ]);

        //Carbon::setTestNow();
    }


    
    public function testRejected()
    {
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

        $account_arr = [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_arr['id'],
            'balance' => 500,
            'blocked_balance' => 5.2,
            'number' => '1000000000001001',
        ];

        //-------------------------------------------------------------

        $user = factory(User::class)->create($user_arr);
        $account = factory(Account::class)->create($account_arr);

        //-------------------------------------------------------------

        $transaction_arr = [

            'id' => Uuid::uuid4()->toString(),
            'from_account_id' => $account->id,
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 5,
            'params_json' => [
                [
                    "key" => "phone_number",
                    "value" => "992928553004",
                    "name" => "Номер получателя",
                ],
                [
                    "key" => "comment",
                    "value" => "ЦУ 123 qwe йцу",
                    "name" => "Комментарий",
                ],
            ],
            'session_number' => 999999999,
            'transaction_type_id' => TransactionType::PAYMENT, 
            'transaction_status_id' => TransactionStatus::new, 
            'transaction_status_detail_id' => TransactionStatusDetail::OK, 
            'add_to_favorite' => 1,
            'currency_iso_name' => 'TJS',
            'created_by_user_id' => $user->id,
            'is_queued' => 0,
            'session_in' => 0,

        ];

        $transaction = factory(Transaction::class)->create($transaction_arr);


        $datetime = Carbon::now()->format('ymdHis');

        $queue_arr_payload = [
            'transaction_id' => $transaction->id,
            'status_id' => TransactionStatus::REJECTED,
            'status_detail_id' => TransactionStatusDetail::OK,
            'comment' => 'test',
        ];

        $queue_arr = [
            'payload' => $queue_arr_payload,
            'hash' => $this->hash->make($datetime, $queue_arr_payload),
            'datetime' => $datetime,
        ];

        $response_transaction = $this->actingAs($user)->json('POST', '/api/v1/transactions/status', $queue_arr);

        $response_transaction->assertJson(
            [
                'success' => true,
                'errors' => null,
                'message' => 'Успешно',
            ]
        );
       
        $this->assertDatabaseHas('accounts', [
            'id' => $account->id,
            'balance' => 500,
            'blocked_balance' => 0,
        ]);

        //Carbon::setTestNow();
    }

    
    public function testNotAllowCompletedToRejected()
    {
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

        $account_arr = [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_arr['id'],
            'balance' => 500,
            'blocked_balance' => 0,
            'number' => '1000000000001001',
        ];

        //-------------------------------------------------------------

        $user = factory(User::class)->create($user_arr);
        $account = factory(Account::class)->create($account_arr);

        //-------------------------------------------------------------

        $transaction_arr = [

            'id' => Uuid::uuid4()->toString(),
            'from_account_id' => $account->id,
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 5,
            'params_json' => [
                [
                    "key" => "phone_number",
                    "value" => "992928553004",
                    "name" => "Номер получателя",
                ],
                [
                    "key" => "comment",
                    "value" => "ЦУ 123 qwe йцу",
                    "name" => "Комментарий",
                ],
            ],
            'session_number' => 999999999,
            'transaction_type_id' => TransactionType::PAYMENT, 
            'transaction_status_id' => TransactionStatus::COMPLETED, 
            'transaction_status_detail_id' => TransactionStatusDetail::OK, 
            'add_to_favorite' => 1,
            'currency_iso_name' => 'TJS',
            'created_by_user_id' => $user->id,
            'is_queued' => 0,
            'session_in' => 0,

        ];

        $transaction = factory(Transaction::class)->create($transaction_arr);


        $datetime = Carbon::now()->format('ymdHis');

        $queue_arr_payload = [
            'transaction_id' => $transaction->id,
            'status_id' => TransactionStatus::REJECTED,
            'status_detail_id' => TransactionStatusDetail::OK,
            'comment' => 'test',
        ];

        $queue_arr = [
            'payload' => $queue_arr_payload,
            'hash' => $this->hash->make($datetime, $queue_arr_payload),
            'datetime' => $datetime,
        ];

        $response_transaction = $this->actingAs($user)->json('POST', '/api/v1/transactions/status', $queue_arr);

        $response_transaction->assertJson(
            [
                'success' => false,
                'errors' => null,
                'message' => 'ERROR_STATUS_TRANSACTION_COMPLETED_CANNOT_BE_REJECTED',
            ]
        );
       
        $this->assertDatabaseHas('accounts', [
            'id' => $account->id,
            'balance' => 500,
            'blocked_balance' => 0,
        ]);

        //Carbon::setTestNow();
    }

    
    public function testNotAllowRejectedToCompleted()
    {
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

        $account_arr = [
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user_arr['id'],
            'balance' => 500,
            'blocked_balance' => 0,
            'number' => '1000000000001001',
        ];

        //-------------------------------------------------------------

        $user = factory(User::class)->create($user_arr);
        $account = factory(Account::class)->create($account_arr);

        //-------------------------------------------------------------

        $transaction_arr = [

            'id' => Uuid::uuid4()->toString(),
            'from_account_id' => $account->id,
            'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715', //Tcell
            'amount' => 5,
            'params_json' => [
                [
                    "key" => "phone_number",
                    "value" => "992928553004",
                    "name" => "Номер получателя",
                ],
                [
                    "key" => "comment",
                    "value" => "ЦУ 123 qwe йцу",
                    "name" => "Комментарий",
                ],
            ],
            'session_number' => 999999999,
            'transaction_type_id' => TransactionType::PAYMENT, 
            'transaction_status_id' => TransactionStatus::REJECTED, 
            'transaction_status_detail_id' => TransactionStatusDetail::OK, 
            'add_to_favorite' => 1,
            'currency_iso_name' => 'TJS',
            'created_by_user_id' => $user->id,
            'is_queued' => 0,
            'session_in' => 0,

        ];

        $transaction = factory(Transaction::class)->create($transaction_arr);


        $datetime = Carbon::now()->format('ymdHis');

        $queue_arr_payload = [
            'transaction_id' => $transaction->id,
            'status_id' => TransactionStatus::COMPLETED,
            'status_detail_id' => TransactionStatusDetail::OK,
            'comment' => 'test',
        ];

        $queue_arr = [
            'payload' => $queue_arr_payload,
            'hash' => $this->hash->make($datetime, $queue_arr_payload),
            'datetime' => $datetime,
        ];

        $response_transaction = $this->actingAs($user)->json('POST', '/api/v1/transactions/status', $queue_arr);

        $response_transaction->assertJson(
            [
                'success' => true,
                'errors' => null,
                'message' => 'ERROR_STATUS_TRANSACTION_IS_ALLREADY_COMPLETED',
            ]
        );
       
        $this->assertDatabaseHas('accounts', [
            'id' => $account->id,
            'balance' => 500,
            'blocked_balance' => 0,
        ]);

        //Carbon::setTestNow();
    }


    

}
