<?php

use App\Models\Currency\CurrencyRateCategory\CurrencyRateCategory;
use App\Services\Common\Helpers\CurrencyRateCategory as CurrencyRateCategoryHelper;
use Illuminate\Database\Seeder;

class CurrencyRateCategoriesTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => CurrencyRateCategoryHelper::DEFAULT,
                'code' => 'DEFAULT',
                'code_map' => CurrencyRateCategoryHelper::DEFAULT_CODE_MAP,
                'name' => 'По умолчанию',
            ],
            [
                'id' => CurrencyRateCategoryHelper::TRANSFER,
                'code' => 'TRANSFER',
                'code_map' => CurrencyRateCategoryHelper::TRANSFER_CODE_MAP,
                'name' => 'Курс перевода',
            ],
        ];

        foreach ($vars as $var) {
            try {
                CurrencyRateCategory::create($var);
                //TransactionSyncRule::create($var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
