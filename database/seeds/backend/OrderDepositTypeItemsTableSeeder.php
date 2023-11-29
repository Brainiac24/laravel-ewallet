<?php

use Database\Seeds\BaseSeeder;
use Illuminate\Database\Seeder;
use App\Services\Common\Helpers\Currency;
use App\Services\Common\Helpers\OrderDepositType;
use App\Models\Order\OrderDepositTypeItem\OrderDepositTypeItem;
use App\Services\Common\Helpers\OrderDepositTypeItem as HelpersOrderDepositTypeItem;

class OrderDepositTypeItemsTableSeeder extends BaseSeeder
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
                'id' => HelpersOrderDepositTypeItem::TIMMED_NEW_TJS_1,
                'code' => "TIMMED_NEW_TJS_1",
                'code_map' => null,
                'name' => "Срочный депозит TJS 1",
                'min_amount' => "5000",
                'max_amount' => "10000000",
                'day_from_count' => "180",
                'day_to_count' => "365",
                'percentage' => "12",
                'can_fill_until' => "0.5",
                'can_fill_until_is_persentage' => "1",
                'currency_id' => Currency::TJS,
                'order_deposit_type_id' => OrderDepositType::TIMMED_NEW,
                'position' => 1,
                'is_fillable' => 1,
                'is_withdrawable' => 0,
                'is_active' => 1,
            ],
            [
                'id' => HelpersOrderDepositTypeItem::TIMMED_NEW_TJS_2,
                'code' => "TIMMED_NEW_TJS_2",
                'code_map' => null,
                'name' => "Срочный депозит TJS 2",
                'min_amount' => "5000",
                'max_amount' => "10000000",
                'day_from_count' => "366",
                'day_to_count' => "731",
                'percentage' => "15",
                'can_fill_until' => "0.5",
                'can_fill_until_is_persentage' => "1",
                'currency_id' => Currency::TJS,
                'order_deposit_type_id' => OrderDepositType::TIMMED_NEW,
                'position' => 2,
                'is_fillable' => 1,
                'is_withdrawable' => 0,
                'is_active' => 1,
            ],
            [
                'id' => HelpersOrderDepositTypeItem::TIMMED_NEW_USD_1,
                'code' => "TIMMED_NEW_USD_1",
                'code_map' => null,
                'name' => "Срочный депозит USD 1",
                'min_amount' => "500",
                'max_amount' => "10000000",
                'day_from_count' => "180",
                'day_to_count' => "365",
                'percentage' => "2",
                'can_fill_until' => "0.5",
                'can_fill_until_is_persentage' => "1",
                'currency_id' => Currency::USD,
                'order_deposit_type_id' => OrderDepositType::TIMMED_NEW,
                'position' => 3,
                'is_fillable' => 1,
                'is_withdrawable' => 0,
                'is_active' => 1,
            ],
            [
                'id' => HelpersOrderDepositTypeItem::TIMMED_NEW_USD_2,
                'code' => "TIMMED_NEW_USD_2",
                'code_map' => null,
                'name' => "Срочный депозит USD 2",
                'min_amount' => "500",
                'max_amount' => "10000000",
                'day_from_count' => "366",
                'day_to_count' => "731",
                'percentage' => "4",
                'can_fill_until' => "0.5",
                'can_fill_until_is_persentage' => "1",
                'currency_id' => Currency::USD,
                'order_deposit_type_id' => OrderDepositType::TIMMED_NEW,
                'position' => 4,
                'is_fillable' => 1,
                'is_withdrawable' => 0,
                'is_active' => 1,
            ],
            [
                'id' => HelpersOrderDepositTypeItem::OZOD_TJS,
                'code' => "OZOD_TJS",
                'code_map' => null,
                'name' => "Озод",
                'min_amount' => "10",
                'max_amount' => "10000000",
                'day_from_count' => "0",
                'day_to_count' => "0",
                'percentage' => "8",
                'can_fill_until' => "1",
                'can_fill_until_is_persentage' => "1",
                'currency_id' => Currency::TJS,
                'order_deposit_type_id' => OrderDepositType::OZOD,
                'position' => 1,
                'is_fillable' => 1,
                'is_withdrawable' => 1,
                'is_active' => 1,
            ],
        ];

        foreach ($items as $item) {
            try {
                $res = OrderDepositTypeItem::create($item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
