<?php

use Database\Seeds\BaseSeeder;
use Illuminate\Database\Seeder;
use App\Models\Order\OrderAccountType\OrderAccountType;
use App\Services\Common\Helpers\OrderAccountType as HelpersOrderAccountType;
use App\Services\Common\Helpers\Service;

class OrderAccountTypesTableSeeder extends BaseSeeder
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
                'id' => HelpersOrderAccountType::SBER,
                'code' => "SBER",
                'code_map' => "15444494",
                'name' => "Сберегательный депозит",
                'service_id' => Service::ORDER_ACCOUNT_SBER,
                'position' => 1,
                'is_active' => 1,
            ],
        ];

        foreach ($items as $item) {
            try {
                $res = OrderAccountType::create($item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
