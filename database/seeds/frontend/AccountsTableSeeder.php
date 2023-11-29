<?php

use App\Models\Account\Account;
use App\Services\Common\Helpers\AccountTypes;
use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $accounts = [
            [
                'id' => 'e5d67c25-a078-11e8-904b-b06ebfbfa715',
                'number' => '1111111111111111',
                'balance' => '1000',
                'account_type_id' => config('app_settings.default_wallet_account_type_id'),
                'user_id' => 'aa3df392-a077-11e8-904b-b06ebfbfa715',
                'currency_id' => config('app_settings.default_currency_id')
            ],
            [
                'id' => '29f8b10c-bbc8-11e8-92b3-b06ebfbfa715',
                'number' => '2222222222222222',
                'balance' => '1000',
                'account_type_id' => config('app_settings.default_wallet_account_type_id'),
                'user_id' => '74016b8a-ba71-11e8-92b3-b06ebfbfa715',
                'currency_id' => config('app_settings.default_currency_id')
            ],
            [
                'id' => '39f8b10c-bbc8-11e8-92b3-b06ebfbfa716',
                'number' => '3333333333333333',
                'balance' => '50',
                'account_type_id' => config('app_settings.default_wallet_account_type_id'),
                'user_id' => config('app_settings.test_apple_client_id'),
                'currency_id' => config('app_settings.default_currency_id')
            ],
            [
                'id' => 'f85ee00e-bde8-4a1b-a8be-41b7f45be118',
                'number' => '5100100010000001',
                'balance' => '0',
                'account_type_id' => AccountTypes::VIRTUAL_COMMON_BONUS,
                'user_id' => config('app_settings.system_user_id'),
                'currency_id' => config('app_settings.default_currency_id'),
                'params_json' => [
                    'acc_code' => 'TRANS_BONUS'
                ]
            ],
            [
                'id' => 'adb4664d-0757-470f-ba1b-a10b73327ff4',
                'number' => '5100100010000002',
                'balance' => '0',
                'account_type_id' => AccountTypes::VIRTUAL_EXPENSE,
                'user_id' => config('app_settings.system_user_id'),
                'currency_id' => config('app_settings.default_currency_id'),
                'params_json' => [
                    'acc_code' => 'EXP_BANK_CASHBACK'
                ]
            ],
            [
                'id' => '8cc069b7-03ff-4f6b-9c13-4ee05fda902e',
                'number' => '5100100010000003',
                'balance' => '0',
                'account_type_id' => AccountTypes::VIRTUAL_INCOME,
                'user_id' => config('app_settings.system_user_id'),
                'currency_id' => config('app_settings.default_currency_id'),
                'params_json' => [
                    'acc_code' => 'INCOME_MERCHANT'
                ]
            ],

        ];

        foreach ($accounts as $account) {
            try {
                $cat = Account::create($account);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }


    }
}
