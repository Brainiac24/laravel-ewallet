<?php

use Database\Seeds\BaseSeeder;
use Illuminate\Database\Seeder;
use App\Services\Common\Helpers\Currency;
use App\Services\Common\Helpers\OrderAccountType;
use App\Models\Order\OrderAccountTypeItem\OrderAccountTypeItem;
use App\Services\Common\Helpers\OrderAccountTypeItem as HelpersOrderAccountTypeItem;

class OrderAccountTypeItemsTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'id' => HelpersOrderAccountTypeItem::SBER_TJS,
                'code' => "SBER_TJS",
                'code_map' => null,
                'name' => "Сберегательный счёт TJS",
                'currency_id' => Currency::TJS,
                'order_account_type_id' => OrderAccountType::SBER,
                'position' => 1,
                'is_active' => 1,
            ],
            [
                'id' => HelpersOrderAccountTypeItem::SBER_USD,
                'code' => "SBER_USD",
                'code_map' => null,
                'name' => "Сберегательный счёт USD",
                'currency_id' => Currency::USD,
                'order_account_type_id' => OrderAccountType::SBER,
                'position' => 2,
                'is_active' => 1,
            ],
            [
                'id' => HelpersOrderAccountTypeItem::SBER_RUB,
                'code' => "SBER_RUB",
                'code_map' => null,
                'name' => "Сберегательный счёт RUB",
                'currency_id' => Currency::RUB,
                'order_account_type_id' => OrderAccountType::SBER,
                'position' => 3,
                'is_active' => 1,
            ],
            [
                'id' => HelpersOrderAccountTypeItem::SBER_EUR,
                'code' => "SBER_EUR",
                'code_map' => null,
                'name' => "Сберегательный счёт EUR",
                'currency_id' => Currency::EUR,
                'order_account_type_id' => OrderAccountType::SBER,
                'position' => 4,
                'is_active' => 1,
            ],
        ];

        foreach ($items as $item) {
            try {
                $res = OrderAccountTypeItem::create($item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
