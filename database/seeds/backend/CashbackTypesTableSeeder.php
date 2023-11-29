<?php

use App\Models\Cashback\CashbackType\CashbackType as CashbackTypeModel;
use App\Services\Common\Helpers\CashbackType;
use Database\Seeds\BaseSeeder;
use Illuminate\Database\Seeder;

class CashbackTypesTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => CashbackType::CASHBACK,  'code' => 'CASHBACK',  'name' => 'Кэшбэк'],
            ['id' => CashbackType::BONUS, 'code' => 'BONUS', 'name' => 'Бонус'],
        ];

        foreach ($items as $item) {
            try {
                $res = CashbackTypeModel::create($item);
                //$res = DocApiCategory::create($item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
