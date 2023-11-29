<?php

use App\Models\Service\Workday\Workday;
use Illuminate\Database\Seeder;

class WorkdaysTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $items = [
                [

                    'id' => config('app_settings.default_workday_id'),
                    'name' => 'Рабочие дни',
                    'monday' => '0-23',
                    'tuesday' => '0-23',
                    'wednesday' => '0-23',
                    'thursday' => '0-23',
                    'friday' => '0-23',
                    'saturday' => '0-23',
                    'sunday' => '0-23',
                ],
                [
                    'id' => config('app_settings.exchange_workday_id'),
                    'name' => 'Курс валют',
                    'monday' => '8-16',
                    'tuesday' => '8-16',
                    'wednesday' => '8-16',
                    'thursday' => '8-16',
                    'friday' => '8-16',
                    'saturday' => '8-16',
                    'sunday' => '8-16',
                ],
            ];

            foreach ($items as $item) {
                try {
                    Workday::create(['id' => $item['id']], $item);
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                }
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }

       
    }
}
