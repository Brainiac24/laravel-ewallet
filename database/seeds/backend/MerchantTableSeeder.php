<?php

use App\Models\Merchant\Merchant;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 04.11.2019
 * Time: 9:44
 */

class MerchantTableSeeder extends Database\Seeds\BaseSeeder
{
    public function run()
    {
        //
        try {
            $items = [
                [
                    'id' => 'fe96e1a3-d5a5-4866-b9d8-a8bde6d6bdc7',
                    'name' => 'Главная',
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_active' => '1',
                ],
            ];

            foreach ($items as $item) {
                try {
                    Merchant::create(['id' => $item['id']], $item);
                } catch (\Exception $e) {
                   $this->logger->error($e->getMessage());
                }
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}