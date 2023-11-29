<?php

use Database\Seeds\BaseSeeder;
use Illuminate\Database\Seeder;
use App\Models\Order\OrderDepositType\OrderDepositType;
use App\Services\Common\Helpers\OrderDepositType as HelpersOrderDepositType;
use App\Services\Common\Helpers\Service;

class OrderDepositTypesTableSeeder extends BaseSeeder
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
                'id' => HelpersOrderDepositType::TIMMED_NEW,
                'code' => "TIMMED_NEW",
                'code_map' => "30943020828",
                'name' => "Срочный депозит",
                'icon' => "safe.png",
                'service_id' => Service::ORDER_DEPOSIT_TIMED_NEW,
                'position' => 1,
                'is_active' => 1,
            ],
            [
                'id' => HelpersOrderDepositType::OZOD,
                'code' => "OZOD",
                'code_map' => "1747776549",
                'name' => "Озод",
                'icon' => "baloon.png",
                'service_id' => Service::ORDER_DEPOSIT_OZOD,
                'position' => 1,
                'is_active' => 1,
            ],
        ];

        foreach ($items as $item) {
            try {
                $res = OrderDepositType::create($item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
