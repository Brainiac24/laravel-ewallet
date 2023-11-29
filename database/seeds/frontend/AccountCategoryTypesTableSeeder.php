<?php


use App\Models\AccountCategoryType\AccountCategoryType;
use App\Services\Common\Helpers\AccountCategoryTypes as AccountCategoryTypes;

use Illuminate\Database\Seeder;

class AccountCategoryTypesTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;
        $account_category_types = [
            [
                'id' => AccountCategoryTypes::EWALLET_ID,
                'code' => 'EWALLET',
                'name' => 'Электронный кошелек',
                'img_colored' => 'choose_wallet.png',
                'img_uncolored' => null,
                'position' => $i++,
                'parent_id' => config('app_settings.default_account_category_type_id'),
            ],
            [
                'id' => AccountCategoryTypes::CARD_ID,
                'code' => 'CARDS',
                'name' => 'Карты',
                'img_colored' => null,
                'img_uncolored' => null,
                'position' => $i++,
                'parent_id' => config('app_settings.default_account_category_type_id'),
            ],
            [
                'id' => AccountCategoryTypes::ACCOUNT_ID,
                'code' => 'ACCOUNTS',
                'name' => 'Счета',
                'img_colored' => 'choose_account.png',
                'img_uncolored' => null,
                'position' => $i++,
                'parent_id' => config('app_settings.default_account_category_type_id'),
            ],
            [
                'id' => AccountCategoryTypes::DEPOSIT_ID,
                'code' => 'DEPOSITS',
                'name' => 'Вклады',
                'img_colored' => 'choose_deposit.png',
                'img_uncolored' => null,
                'position' => $i++,
                'parent_id' => config('app_settings.default_account_category_type_id'),
            ],
            [
                'id' => AccountCategoryTypes::CREDIT_ID,
                'code' => 'CREDITS',
                'name' => 'Кредиты',
                'img_colored' => 'choose_credit.png',
                'img_uncolored' => null,
                'position' => $i,
                'parent_id' => config('app_settings.default_account_category_type_id'),
            ],
            [
                'id' => AccountCategoryTypes::MERCHANT_ID,
                'code' => 'MERCHANT',
                'name' => 'Мерчант',
                'img_colored' => null,
                'img_uncolored' => null,
                'position' => $i,
                'parent_id' => config('app_settings.default_account_category_type_id'),
            ],
            [
                'id' => AccountCategoryTypes::VIRTUAL_ID,
                'code' => 'VIRTUALS',
                'name' => 'Виртуальный',
                'img_colored' => null,
                'img_uncolored' => null,
                'position' => $i,
                'parent_id' => config('app_settings.default_account_category_type_id'),
            ],
        ];

//        foreach ($account_category_types as $account_category_type) {
//            try {
//                $cat = AccountCategoryType::create($account_category_type);
//            } catch (\Exception $e) {
//                $this->logger->error($e->getMessage());
//            }
//        }

        foreach ($account_category_types as $account_category_type) {
            try {
                $cat = AccountCategoryType::create(['id' => $account_category_type['id']], $account_category_type);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
