<?php

use App\Models\Merchant\MerchantCategory\MerchantCategory;

/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 16.12.2019
 * Time: 13:30
 */

class MerchantCategoryTableSeeder extends Database\Seeds\BaseSeeder
{
    public function run()
    {
        try {
            $items = [
                [
                    'id' => config('app_settings.default_merchant_category_id'),
                    'name' => 'Продуктовый магазин',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.merchant_popular_category_id'),
                    'name' => 'Популярные',
                    'is_active' => '1',
                ],
            ];

            foreach ($items as $item) {
                try {
                    $cat = MerchantCategory::create(['id' => $item['id']], $item);
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                }
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}