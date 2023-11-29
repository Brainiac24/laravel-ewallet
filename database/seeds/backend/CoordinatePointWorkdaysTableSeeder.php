<?php

use Illuminate\Database\Seeder;

class CoordinatePointWorkdaysTableSeeder extends \Database\Seeds\BaseSeeder
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
                'id' => '282ec236-8239-490d-b508-9456e1e391fd',
                'name' => 'Круглосуточно 6 дней',
                'monday' => '00-23',
                'tuesday' => '00-23',
                'wednesday' => '00-23',
                'thursday' => '00-23',
                'friday' => '00-23',
                'saturday' => '00-23',
                'sunday' => '00-00',
                'is_active' => 1,

            ],
            [
                'id' => '2317a555-33a0-416f-9017-8db6fa58daa3',
                'name' => 'Круглосуточно 7 дней',
                'monday' => '00-23',
                'tuesday' => '00-23',
                'wednesday' => '00-23',
                'thursday' => '00-23',
                'friday' => '00-23',
                'saturday' => '00-23',
                'sunday' => '00-23',
                'is_active' => 1,

            ],
            [
                'id' => 'a3f2368b-e157-49da-8520-22fc5bf966bc',
                'name' => '5 Рабочий день',
                'monday' => '08-17',
                'tuesday' => '08-17',
                'wednesday' => '08-17',
                'thursday' => '08-17',
                'friday' => '08-17',
                'saturday' => '00-00',
                'sunday' => '00-00',
                'is_active' => 1,

            ],
            [
                'id' => 'd9f2d295-bb73-42ed-8a8b-b13163c79923',
                'name' => 'Рабочий день ЦБО',
                'monday' => '08-16',
                'tuesday' => '08-16',
                'wednesday' => '08-16',
                'thursday' => '08-16',
                'friday' => '08-16',
                'saturday' => '08-14',
                'sunday' => '00-00',
                'is_active' => 1,

            ],
        ];
        foreach ($items as $item) {
            try {
                $res = \App\Models\CoordinatePoint\CoordinatePointWorkday\CoordinatePointWorkday::create($item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
