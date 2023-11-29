<?php

use Database\Seeds\BaseSeeder;
use Illuminate\Database\Seeder;
use App\Models\Cashback\BonusAccrual\BonusAccrualStatus\BonusAccrualStatus;

class BonusAccrualStatusTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => "cbbc0cfe-6599-4f10-bec4-2b8b9df5e44b",  'code' => 'NEW',  'name' => 'Новая'],
            ['id' => "82dc5727-3965-4d5c-bb1e-0987121c0e40",  'code' => 'IN_PROCESS',  'name' => 'В обработке'],
            ['id' => "64aa85a0-8ef7-47cd-8882-a7bb4bc87e17",  'code' => 'COMPLETED',  'name' => 'Завершён'],
        ];

        foreach ($items as $item) {
            try {
                $res = BonusAccrualStatus::create($item);
                //$res = DocApiCategory::create($item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
