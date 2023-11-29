<?php

use App\Models\CategoryType\CategoryType;
use App\Services\Common\Helpers\CategoryType as CATEGORYTYPES;
use Illuminate\Database\Seeder;

class CategoryTypeTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $category_types = [
            [
                'id' => CATEGORYTYPES::MENU_DEFAULT_ID,
                'code' => CATEGORYTYPES::MENU_DEFAULT_CODE,
                'name' => CATEGORYTYPES::MENU_DEFAULT_NAME,
                'is_active' => 0,
            ],
            [
                'id' => CATEGORYTYPES::MENU_PAYMENT_AND_TRANSFER_ID,
                'code' => CATEGORYTYPES::MENU_PAYMENT_AND_TRANSFER_CODE,
                'name' => CATEGORYTYPES::MENU_PAYMENT_AND_TRANSFER_NAME,
                'is_active' => 1,
            ],
            [
                'id' => CATEGORYTYPES::MENU_CURRENCY_RATE_ID,
                'code' => CATEGORYTYPES::MENU_CURRENCY_RATE_CODE,
                'name' => CATEGORYTYPES::MENU_CURRENCY_RATE_NAME,
                'is_active' => 1,
            ],
            [
                'id' => CATEGORYTYPES::MENU_QR_ID,
                'code' => CATEGORYTYPES::MENU_QR_CODE,
                'name' => CATEGORYTYPES::MENU_QR_NAME,
                'is_active' => 1,
            ],
            [
                'id' => CATEGORYTYPES::MENU_MAP_ID,
                'code' => CATEGORYTYPES::MENU_MAP_CODE,
                'name' => CATEGORYTYPES::MENU_MAP_NAME,
                'is_active' => 1,
            ],
            [
                'id' => CATEGORYTYPES::MENU_DEPOSIT_ID,
                'code' => CATEGORYTYPES::MENU_DEPOSIT_CODE,
                'name' => CATEGORYTYPES::MENU_DEPOSIT_NAME,
                'is_active' => 1,
            ],
            [
                'id' => CATEGORYTYPES::MENU_CREDIT_ID,
                'code' => CATEGORYTYPES::MENU_CREDIT_CODE,
                'name' => CATEGORYTYPES::MENU_CREDIT_NAME,
                'is_active' => 1,
            ],
            [
                'id' => CATEGORYTYPES::MENU_INVOICE_FOR_PAYMENT_ID,
                'code' => CATEGORYTYPES::MENU_INVOICE_FOR_PAYMENT_CODE,
                'name' => CATEGORYTYPES::MENU_INVOICE_FOR_PAYMENT_NAME,
                'is_active' => 1,
            ],
            [
                'id' => CATEGORYTYPES::MENU_CARD_AND_ACCOUNT_ID,
                'code' => CATEGORYTYPES::MENU_CARD_AND_ACCOUNT_CODE,
                'name' => CATEGORYTYPES::MENU_CARD_AND_ACCOUNT_NAME,
                'is_active' => 1,
            ],
            [
                'id' => CATEGORYTYPES::WEB_MAIN_MENU_ID,
                'code' => CATEGORYTYPES::WEB_MAIN_MENU_CODE,
                'name' => CATEGORYTYPES::WEB_MAIN_MENU_NAME,
                'is_active' => 1,
            ],
            [
                'id' => CATEGORYTYPES::WEB_MAIN_TRANSFER_ID,
                'code' => CATEGORYTYPES::WEB_MAIN_TRANSFER_CODE,
                'name' => CATEGORYTYPES::WEB_MAIN_TRANSFER_NAME,
                'is_active' => 1,
            ],
            [
                'id' => CATEGORYTYPES::WEB_MAIN_PAYMENT_ID,
                'code' => CATEGORYTYPES::WEB_MAIN_PAYMENT_CODE,
                'name' => CATEGORYTYPES::WEB_MAIN_PAYMENT_NAME,
                'is_active' => 1,
            ],
            [
                'id' => CATEGORYTYPES::WEB_MAIN_CURRENCY_RATE_ID,
                'code' => CATEGORYTYPES::WEB_MAIN_CURRENCY_RATE_CODE,
                'name' => CATEGORYTYPES::WEB_MAIN_CURRENCY_RATE_NAME,
                'is_active' => 1,
            ],
            [
                'id' => CATEGORYTYPES::WEB_MAIN_TEMPLATES_ID,
                'code' => CATEGORYTYPES::WEB_MAIN_TEMPLATES_CODE,
                'name' => CATEGORYTYPES::WEB_MAIN_TEMPLATES_NAME,
                'is_active' => 1,
            ],
            [
                'id' => CATEGORYTYPES::WEB_MAIN_ON_MAP_ID,
                'code' => CATEGORYTYPES::WEB_MAIN_ON_MAP_CODE,
                'name' => CATEGORYTYPES::WEB_MAIN_ON_MAP_NAME,
                'is_active' => 1,
            ],
        ];

        foreach ($category_types as $category_type) {
            try {
                $cat = CategoryType::create($category_type);
                //$cat = CategoryType::updateOrCreate(['id' => $category_type['id']], $category_type);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
