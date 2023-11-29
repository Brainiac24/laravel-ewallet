<?php

use App\Models\Region\Region;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => '3a3c02a3-0e82-11e9-91d8-b06ebfbfa715', 'code' => '1', 'code_map' => '17683114', 'name' => 'Варзобский район', 'desc' => ''],
            ['id' => '3a3c0315-0e82-11e9-91d8-b06ebfbfa715', 'code' => '2', 'code_map' => '17683110', 'name' => 'Вахдат', 'desc' => ''],
            ['id' => '3a3c0365-0e82-11e9-91d8-b06ebfbfa715', 'code' => '3', 'code_map' => '17683254', 'name' => 'Вахдатский район', 'desc' => ''],
            ['id' => '3a3c038f-0e82-11e9-91d8-b06ebfbfa715', 'code' => '4', 'code_map' => '17682384', 'name' => 'Вилояти Сугд', 'desc' => 'обл'],
            ['id' => '3a3c03bd-0e82-11e9-91d8-b06ebfbfa715', 'code' => '5', 'code_map' => '17682710', 'name' => 'Вилояти Хатлон', 'desc' => 'обл'],
            ['id' => '3a3c03e8-0e82-11e9-91d8-b06ebfbfa715', 'code' => '6', 'code_map' => '17683358', 'name' => 'ВМКБ', 'desc' => 'Аобл'],
            ['id' => '3a3c0412-0e82-11e9-91d8-b06ebfbfa715', 'code' => '7', 'code_map' => '17683158', 'name' => 'Гиссарский район', 'desc' => ''],
            ['id' => '3a3c0440-0e82-11e9-91d8-b06ebfbfa715', 'code' => '8', 'code_map' => '17683108', 'name' => 'города республиканского подчинения Респ', 'desc' => ''],
            ['id' => '3a3c047e-0e82-11e9-91d8-b06ebfbfa715', 'code' => '9', 'code_map' => '17683184', 'name' => 'Джиргатальский район', 'desc' => ''],
            ['id' => '3a3c04a9-0e82-11e9-91d8-b06ebfbfa715', 'code' => '10', 'code_map' => '17682371', 'name' => 'Душанбе', 'desc' => 'г'],
            ['id' => '3a3c04d4-0e82-11e9-91d8-b06ebfbfa715', 'code' => '11', 'code_map' => '75901504', 'name' => 'Ленинградская область', 'desc' => 'обл'],
            ['id' => '3a3c04fe-0e82-11e9-91d8-b06ebfbfa715', 'code' => '12', 'code_map' => '61316627', 'name' => 'Москва', 'desc' => 'г'],
            ['id' => '3a3c052c-0e82-11e9-91d8-b06ebfbfa715', 'code' => '13', 'code_map' => '61047200', 'name' => 'Московская область', 'desc' => 'обл'],
            ['id' => '3a3c0554-0e82-11e9-91d8-b06ebfbfa715', 'code' => '14', 'code_map' => '732586354', 'name' => 'Новосибирская область', 'desc' => 'обл'],
            ['id' => '3a3c057c-0e82-11e9-91d8-b06ebfbfa715', 'code' => '15', 'code_map' => '17683106', 'name' => 'Нохияхои тобеи Чумхури', 'desc' => 'обл'],
            ['id' => '3a3c05a3-0e82-11e9-91d8-b06ebfbfa715', 'code' => '16', 'code_map' => '17683202', 'name' => 'Нурабадский район', 'desc' => ''],
            ['id' => '3a3c05cb-0e82-11e9-91d8-b06ebfbfa715', 'code' => '17', 'code_map' => '17683220', 'name' => 'Район Рудаки', 'desc' => ''],
            ['id' => '3a3c05f6-0e82-11e9-91d8-b06ebfbfa715', 'code' => '18', 'code_map' => '17683132', 'name' => 'Раштский район', 'desc' => ''],
            ['id' => '3a3c061e-0e82-11e9-91d8-b06ebfbfa715', 'code' => '19', 'code_map' => '17683276', 'name' => 'Рогунский район', 'desc' => ''],
            ['id' => '3a3c0648-0e82-11e9-91d8-b06ebfbfa715', 'code' => '20', 'code_map' => '17683286', 'name' => 'Тавилдаринский район', 'desc' => ''],
            ['id' => '3a3c0670-0e82-11e9-91d8-b06ebfbfa715', 'code' => '21', 'code_map' => '17683294', 'name' => 'Тоджикободский район', 'desc' => ''],
            ['id' => '3a3c0698-0e82-11e9-91d8-b06ebfbfa715', 'code' => '22', 'code_map' => '17683112', 'name' => 'Турсун-Заде', 'desc' => ''],
            ['id' => '3a3c06c0-0e82-11e9-91d8-b06ebfbfa715', 'code' => '23', 'code_map' => '17683304', 'name' => 'Турсунзадевский район', 'desc' => ''],
            ['id' => '3a3c06ea-0e82-11e9-91d8-b06ebfbfa715', 'code' => '24', 'code_map' => '17683324', 'name' => 'Файзабадский район', 'desc' => ''],
            ['id' => '3a3c0715-0e82-11e9-91d8-b06ebfbfa715', 'code' => '25', 'code_map' => '17683340', 'name' => 'Шахринавский район', 'desc' => ''],

        ];

        /*foreach ($items as $item) {
            try {
                $res = Region::create($item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }*/
    }
}
