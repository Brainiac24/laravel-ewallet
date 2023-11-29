<?php

use App\Models\Cashback\CashbackItem\CashbackItem;
use Database\Seeds\BaseSeeder;
use Illuminate\Database\Seeder;

class CashbackItemsTableSeeder extends BaseSeeder
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
                'id' => "98c31a00-9788-42d0-9a4b-3ab096b6d328",
                'name' => 'Бонус за прохождение Удаленной идентификаци (Персональный)',
                'min' => '0',
                'max' => '5',
                'value' => '5',
                'is_percentage' => '0',
                'cashback_id' => '6d3aaeb6-f164-4faf-8a54-59d59e2bd5d8'
            ],
        ];

        foreach ($items as $item) {
            try {
                $res = CashbackItem::create($item);
                //$res = DocApiCategory::create($item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
