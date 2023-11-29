<?php

use App\Models\Currency\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => '2455e6c1-9fb8-11e8-904b-b06ebfbfa715',
                'code' => '972',
                'code_map' => '10600023',
                'name' => 'Сомони',
                'short_name' => 'смн',
                'iso_name' => 'TJS',
                'symbol_left' => 'C',
                'symbol_right' => 'C',
                'is_primary' => '1',
                'icon' => '',
                'is_active' => '1',
            ],
            [
                'id' => '9ec926cd-b0fc-11e8-904b-b06ebfbfa715',
                'code' => '840',
                'code_map' => '43379',
                'name' => 'Доллары США',
                'short_name' => 'usd',
                'iso_name' => 'USD',
                'symbol_left' => '$',
                'symbol_right' => '$',
                'is_primary' => '0',
                'icon' => 'usd.png',
                'is_active' => '1',
            ],
            [
                'id' => 'bc0d0c83-b0fc-11e8-904b-b06ebfbfa715',
                'code' => '643',
                'code_map' => '43353',
                'name' => 'Российский рубль',
                'short_name' => 'руб',
                'iso_name' => 'RUB',
                'symbol_left' => 'P',
                'symbol_right' => 'P',
                'is_primary' => '0',
                'icon' => 'rub.png',
                'is_active' => '1',
            ],
            [
                'id' => 'c1f7c2ab-b0fc-11e8-904b-b06ebfbfa715',
                'code' => '978',
                'code_map' => '43387',
                'name' => 'Евро',
                'short_name' => 'eur',
                'iso_name' => 'EUR',
                'symbol_left' => 'E',
                'symbol_right' => 'E',
                'is_primary' => '0',
                'icon' => 'eur.png',
                'is_active' => '1',
            ],
        ];

        foreach ($vars as $var) {
            try {
                Currency::create(['id' => $var['id']], $var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }

    }
}
