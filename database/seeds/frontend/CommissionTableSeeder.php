<?php

use App\Models\Service\Commission\Commission;
use Illuminate\Database\Seeder;

class CommissionTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => config('app_settings.default_commission_id'),
                'name' => 'Коммиссия 0.5%',
                'params_json' => [
                    [
                        'id' => 'e3fa06c5-d395-11e8-9eb4-b06ebfbfa715',
                        "min" => 1,
                        "max" => 100000,
                        "is_percentage" => 1,
                        "value" => 0.5,
                    ],
                ],
            ],
            [
                'id' => '5f8772cc-2dce-409b-bcd2-2594c9836dca',
                'name' => 'Коммиссия "Сония"',
                'params_json' => [
                    [
                        'id' => 'dfea1614-a0ea-4aa2-b40a-d99b92e360f3',
                        "min" => 0,
                        "max" => 500.00,
                        "is_percentage" => 0,
                        "value" => 5.00,
                    ],
                    [
                        'id' => 'd2e15b25-f4f6-4b3d-99b1-c1ffa54b90bb',
                        "min" => 500.01,
                        "max" => 850.00,
                        "is_percentage" => 0,
                        "value" => 7.00,
                    ],
                    [
                        'id' => 'ec29209c-26aa-463b-a0f7-6c34fa1fba00',
                        "min" => 850.01,
                        "max" => 1000.00,
                        "is_percentage" => 0,
                        "value" => 8.00,
                    ],
                    [
                        'id' => 'd5668f1d-63cf-4374-9bf3-5ab2114ded27',
                        "min" => 1000.01,
                        "max" => 1500.00,
                        "is_percentage" => 0,
                        "value" => 10.00,
                    ],
                    [
                        'id' => '48ab1454-27a1-4377-8c8e-f429e2214496',
                        "min" => 1500.01,
                        "max" => 2000.00,
                        "is_percentage" => 0,
                        "value" => 12.00,
                    ],
                    [
                        'id' => '797b848f-0078-45e3-a455-08cd802b054c',
                        "min" => 2000.01,
                        "max" => 2500.00,
                        "is_percentage" => 0,
                        "value" => 14.00,
                    ],
                    [
                        'id' => 'a511a878-8def-464d-99c9-77a32ad80560',
                        "min" => 2500.01,
                        "max" => 3000.00,
                        "is_percentage" => 0,
                        "value" => 16.00,
                    ],
                    [
                        'id' => '2c96de9b-6544-4708-980c-4dc1e986618b',
                        "min" => 3000.01,
                        "max" => 3500.00,
                        "is_percentage" => 0,
                        "value" => 17.00,
                    ],
                    [
                        'id' => '7afa512e-831d-448b-bb7e-286b40fd1e40',
                        "min" => 3500.01,
                        "max" => 4000.00,
                        "is_percentage" => 0,
                        "value" => 18.00,
                    ],
                    [
                        'id' => 'f31b6f23-b4fd-44e7-a7b2-1f026343fd8d',
                        "min" => 4000.01,
                        "max" => 4500.00,
                        "is_percentage" => 0,
                        "value" => 20.00,
                    ],
                    [
                        'id' => 'c1424137-a85d-4209-955b-9fbb16e52ca8',
                        "min" => 4500.01,
                        "max" => 5000.00,
                        "is_percentage" => 0,
                        "value" => 22.00,
                    ],
                    [
                        'id' => 'be5d8123-8586-4c14-9a6b-296c220ac026',
                        "min" => 5000.01,
                        "max" => 5500.00,
                        "is_percentage" => 0,
                        "value" => 24.00,
                    ],
                    [
                        'id' => '2527b54e-c70e-4ef5-a9ce-89d986bbc0c3',
                        "min" => 5500.01,
                        "max" => 6000.00,
                        "is_percentage" => 0,
                        "value" => 26.00,
                    ],
                    [
                        'id' => '42fb7194-b055-46df-a4ba-05910921756c',
                        "min" => 6000.01,
                        "max" => 6500.00,
                        "is_percentage" => 0,
                        "value" => 27.00,
                    ],
                    [
                        'id' => '0abeab56-e20f-486f-9d18-83a1ca15909f',
                        "min" => 6500.01,
                        "max" => 7000.00,
                        "is_percentage" => 0,
                        "value" => 28.00,
                    ],
                    [
                        'id' => 'bc153883-66df-413d-a148-5649d86a6a28',
                        "min" => 7000.01,
                        "max" => 7500.00,
                        "is_percentage" => 0,
                        "value" => 29.00,
                    ],
                    [
                        'id' => '14a3d472-b660-4820-a335-df52e25fbf9e',
                        "min" => 7500.01,
                        "max" => 8000.00,
                        "is_percentage" => 0,
                        "value" => 30.00,
                    ],
                    [
                        'id' => '324e08d1-4ec7-472e-816d-f6a62cceea55',
                        "min" => 8000.01,
                        "max" => 8500.00,
                        "is_percentage" => 0,
                        "value" => 31.00,
                    ],
                    [
                        'id' => '6d466102-4fb1-4e8e-a613-bed607452424',
                        "min" => 8500.01,
                        "max" => 9000.00,
                        "is_percentage" => 0,
                        "value" => 32.00,
                    ],
                    [
                        'id' => '1d29f6c4-a5f7-4789-8883-e18990e525ba',
                        "min" => 9000.01,
                        "max" => 10000.00,
                        "is_percentage" => 0,
                        "value" => 33.00,
                    ],
                ],
            ],
        ];

        foreach ($vars as $var) {
            try {
                //Commission::updateOrCreate(['id' => $var['id']], $var);
                Commission::create($var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
