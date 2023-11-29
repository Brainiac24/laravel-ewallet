<?php

use App\models\user\UserSessionCodeType\UserSessionCodeType;
use Illuminate\Database\Seeder;

class UserSessionCodeTypeTableSeeder extends Database\Seeds\BaseSeeder
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
                    'id' => config('app_settings.user_session_code_types_block_unlock_account'),
                    'code' => 'block_unlock_account',
                    'name' => 'Заявка на - Блокирование/Разблокирование карты/счёта',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.user_session_code_types_order_card'),
                    'code' => 'order_card',
                    'name' => 'Заявка на - Заказ карты',
                    'is_active' => '1',
                ],
                [
                    'id' => 'da5097e6-56ff-11ea-95c5-b06ebfbfa715',
                    'code' => 'order_credit',
                    'name' => 'Заявка на - Кредит',
                    'is_active' => '1',
                ],
                [
                    'id' => 'ae85d6b2-0a16-4288-bfa7-48ce49769cf4',
                    'code' => 'order_invoice',
                    'name' => 'Заявка на - Выписать счёт',
                    'is_active' => '1',
                ],
                [
                    'id' => 'dcf34b23-b6c9-11eb-b22f-005056a37d1d',
                    'code' => 'order_deposit',
                    'name' => 'Заявка на - Создание депозита',
                    'is_active' => '1',
                ]
            ];

            foreach ($items as $item) {
                try {
                    $cat = UserSessionCodeType::create($item);
                } catch (Exception $e) {
                    $this->logger->error($e->getMessage());
                }
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
