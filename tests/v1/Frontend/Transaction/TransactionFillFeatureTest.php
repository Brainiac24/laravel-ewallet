<?php

namespace Tests\v1\Frontend\Transaction;

use App\Models\Account\Account;
use App\Models\User\User;
use App\Models\User\UserSession\UserSession;
use App\Services\Common\Helpers\Attestation;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class TransactionFillFeatureTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

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
            'number' => '1000000000001001',
        ];

        //-------------------------------------------------------------

        $user = factory(User::class)->create($user_arr);
        $account = factory(Account::class)->create($account_arr);

        //-------------------------------------------------------------
        
        $response_transaction = $this->get('/api/v1/consolidator?type=2&provid=06092018&contractid='.$user->msisdn.'&summa=10&prove_num=1111&date=11092018091400&tranzid=110918091400273352&key=793f8cd3feed777ff57e9157c19e89cb');

        
        $data = $response_transaction->getContent();
        //dd($response_transaction);
        //-------------------------------------------------------------


        $response_transaction->assertSeeText('TRANSACTION CREATED. REGISTERED ID');


        $this->assertDatabaseHas('accounts', [
            'id' => $account->id,
            'balance' => 510,
            'blocked_balance' => 0,
        ]);

        Carbon::setTestNow();
    }
    

}
