<?php

use Illuminate\Database\Seeder;

class CoordinatePointTypesTableSeeder extends \Database\Seeds\BaseSeeder
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
                'id' => 'ece3dae7-294a-4f3d-9b04-6635bae07c2b',
                'name' => 'Банкомат',
                'code' => 'ATM',
                'position' => 4,
                'coordinate_point_workday_id' => '2317a555-33a0-416f-9017-8db6fa58daa3',
                'is_active' => 1,
                'is_show_for_filter' => 1,
            ],
            [
                'id' => '81c43e8e-9d8f-44f7-9409-91f2c7f71027',
                'name' => 'Банк',
                'code' => 'BANK',
                'position' => 1,
                'coordinate_point_workday_id' => 'a3f2368b-e157-49da-8520-22fc5bf966bc',
                'is_active' => 1,
                'is_show_for_filter' => 1,
            ],
            [
                'id' => '765afda3-4e5c-40df-9334-b02c671c79a1',
                'name' => 'Филиал',
                'code' => 'BRANCH',
                'position' => 1,
                'coordinate_point_workday_id' => 'a3f2368b-e157-49da-8520-22fc5bf966bc',
                'is_active' => 1,
                'is_show_for_filter' => 1,
            ],
            [
                'id' => '7f23bd28-5158-432c-9a71-22bd260648ad',
                'name' => 'ЦБО',
                'code' => 'CBO',
                'position' => 2,
                'coordinate_point_workday_id' => 'd9f2d295-bb73-42ed-8a8b-b13163c79923',
                'is_active' => 1,
                'is_show_for_filter' => 1,
            ],
            [
                'id' => '3c114efa-736f-40e3-9b77-643c5a376273',
                'name' => 'QR',
                'code' => 'QR',
                'position' => 3,
                'coordinate_point_workday_id' => 'a3f2368b-e157-49da-8520-22fc5bf966bc',
                'is_active' => 1,
                'is_show_for_filter' => 1,
            ],
            [
                'id' => '04609c1b-9a11-489d-9ec8-96be2949776f',
                'name' => 'Терминал',
                'code' => 'TERMINAL',
                'position' => 5,
                'coordinate_point_workday_id' => '2317a555-33a0-416f-9017-8db6fa58daa3',
                'is_active' => 1,
                'is_show_for_filter' => 1,
            ],
        ];
        foreach ($items as $item) {
            try {
                $res = \App\Models\CoordinatePoint\CoordiantePointType\CoordinatePointType::create($item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
