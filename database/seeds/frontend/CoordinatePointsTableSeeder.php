<?php

use App\Models\CoordinatePoint\CoordinatePoint;
use Illuminate\Database\Seeder;

class CoordinatePointsTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vars = [
            [
                'id' =>'95a45340-ac42-11e8-904b-b06ebfbfa715',
                'name' => 'Головной Офис',
                'latitude' => '40.277372973579524',
                'longitude' => '69.64140057563783',
                'address' => 'г. Худжанд ул. Гагарина 135',
                'object_type' => '1',
                'is_active' => '1',
            ],
            [
                'id' =>'ab3a418b-ac42-11e8-904b-b06ebfbfa715',
                'name' => 'Головной Офис (Терминал)',
                'latitude' => '40.277593975866935',
                'longitude' => '69.64163124561311',
                'address' => 'г. Худжанд ул. Гагарина 135',
                'object_type' => '2',
                'is_active' => '1',
            ],
            [
                'id' =>'3affa86c-ac43-11e8-904b-b06ebfbfa715',
                'name' => 'Головной Офис (Банкомат)',
                'latitude' => '40.27767992100586',
                'longitude' => '69.64123964309694',
                'address' => 'г. Худжанд ул. Гагарина 135',
                'object_type' => '3',
                'is_active' => '1',
            ],
            [
                'id' =>'3fcd79e1-ac43-11e8-904b-b06ebfbfa715',
                'name' => 'Филиал Банка Эсхата (Стадион)',
                'latitude' => '40.27943563350354',
                'longitude' => '69.62653040885927',
                'address' => 'г. Худжанд ул. Исмоили Сомони 180',
                'object_type' => '1',
                'is_active' => '1',
            ],
            [
                'id' =>'4397f05c-ac43-11e8-904b-b06ebfbfa715',
                'name' => 'Филиал Банка Эсхата (Стадион)',
                'latitude' => '40.27943563350354',
                'longitude' => '69.62653040885927',
                'address' => 'г. Худжанд ул. Исмоили Сомони 180',
                'object_type' => '1',
                'is_active' => '1',
            ],
        ];

        foreach ($vars as $var) {
            try {
                //CoordinatePoint::create($var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
