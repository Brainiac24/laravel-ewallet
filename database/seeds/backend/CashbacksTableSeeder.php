<?php

use App\Models\Cashback\Cashback;
use Database\Seeds\BaseSeeder;
use Illuminate\Database\Seeder;

class CashbacksTableSeeder extends BaseSeeder
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
                'id' => "6d3aaeb6-f164-4faf-8a54-59d59e2bd5d8",
                'name' => 'Бонус за прохождение Удаленной идентификаци (Персональный)',
                'start_date' => '2020-12-01 00:00:00',
                'end_date' => '2020-12-31 23:59:59'
            ],
        ];

        foreach ($items as $item) {
            try {
                $res = Cashback::create($item);
                //$res = DocApiCategory::create($item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
