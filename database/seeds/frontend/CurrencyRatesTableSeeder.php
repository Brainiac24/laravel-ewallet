<?php

use App\Models\Currency\CurrencyRate\CurrencyRate;
use App\Services\Common\Helpers\CurrencyRateCategory;
use Illuminate\Database\Seeder;

class CurrencyRatesTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => 'a02fec0d-a079-11e8-904b-b06ebfbfa715',
                'value_buy' => '1',
                'value_sell' => '1',
                'currency_id' => config('app_settings.default_currency_id'),
                'currency_rate_category_id' => CurrencyRateCategory::DEFAULT,
            ],
            [
                'id' => 'ec79751c-b0fd-11e8-904b-b06ebfbfa715', //USD
                'value_buy' => '0',
                'value_sell' => '0',
                'currency_id' => '9ec926cd-b0fc-11e8-904b-b06ebfbfa715',
                'currency_rate_category_id' => CurrencyRateCategory::DEFAULT,
            ],
            [
                'id' => 'ef74524c-b0fd-11e8-904b-b06ebfbfa715', //RUR
                'value_buy' => '0',
                'value_sell' => '0',
                'currency_id' => 'bc0d0c83-b0fc-11e8-904b-b06ebfbfa715',
                'currency_rate_category_id' => CurrencyRateCategory::DEFAULT,
            ],
            [
                'id' => 'f2ca6d76-b0fd-11e8-904b-b06ebfbfa715', //EUR
                'value_buy' => '0',
                'value_sell' => '0',
                'currency_id' => 'c1f7c2ab-b0fc-11e8-904b-b06ebfbfa715',
                'currency_rate_category_id' => CurrencyRateCategory::DEFAULT,
            ],
            [
                'id' => '66bbe49c-d6db-4d2e-b3ef-08e480cc14bf',
                'value_buy' => '1',
                'value_sell' => '1',
                'currency_id' => config('app_settings.default_currency_id'),
                'currency_rate_category_id' => CurrencyRateCategory::TRANSFER,
            ],
        ];

        foreach ($vars as $var) {
            try {
                CurrencyRate::create($var);
                //CurrencyRate::updateOrCreate(['id' => $var['id']], $var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
