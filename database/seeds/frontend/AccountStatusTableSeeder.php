<?php

use App\Models\Account\AccountStatus\AccountStatus;
use Illuminate\Database\Seeder;

class AccountStatusTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        try {
            $items = [
                [
                    'id' => config('app_settings.default_account_status_work'),
                    'code' => 'WORKING',
                    'code_map' => '0',
                    'name' => 'Рабочая',
                    'is_active' => '1',
                ],
                [
                    'id' => '78a91e60-0370-48f7-8dc7-7dc9594f1ff8',
                    'code' => 'BLOCKED',
                    'code_map' => '1',
                    'name' => 'Блокирован',
                    'is_active' => '1',
                ],
                [
                    'id' => '7f228053-6915-4a19-a3a8-6d0dbe75813e',
                    'code' => 'CLOSED',
                    'code_map' => '3',
                    'name' => 'Закрыта',
                    'is_active' => '1',
                ],
                [
                    'id' => '56ae69fe-9d1b-4290-8a20-31147de5b7db',
                    'code' => 'CREATED',
                    'code_map' => '5',
                    'name' => 'Создан',
                    'is_active' => '1',
                ],
                [
                    'id' => '084cdcf8-8385-11e9-a015-b06ebfbfa722',
                    'code' => 'DETACHED',
                    'code_map' => '100',
                    'name' => 'Открепленный',
                    'is_active' => '1',
                ],

            ];

            foreach ($items as $item) {
                try {
                    $cat = AccountStatus::create(['id' => $item['id']], $item);
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                }
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
