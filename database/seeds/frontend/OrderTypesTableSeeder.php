<?php

use App\Models\Order\OrderTypes\OrderTypes;
use Illuminate\Database\Seeder;

class OrderTypesTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $items = [
                [
                    'id' => config('app_settings.order_types_credit'),
                    'code' => 'credit',
                    'name' => 'Заявка на - Кредит',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_types_deposit'),
                    'code' => 'deposit',
                    'name' => 'Заявка на - Депозит',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_types_block_account'),
                    'code' => 'block_account',
                    'name' => 'Заявка на - Блокирование карты/счёта',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_types_unlock_account'),
                    'code' => 'unlock_account',
                    'name' => 'Заявка на - Разблокирование карты/счёта',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_types_account_transactions'),
                    'code' => 'account_transactions',
                    'name' => 'Заявка на - Выписку по счетам',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_types_card_transactions'),
                    'code' => 'card_transactions',
                    'name' => 'Заявка на - Выписку по картам',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_types_credit_transactions'),
                    'code' => 'credit_transactions',
                    'name' => 'Заявка на - Выписку по кредитам',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_types_deposit_transactions'),
                    'code' => 'deposit_transactions',
                    'name' => 'Заявка на - Выписку по депозитам',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_types_transfer'),
                    'code' => 'transfer',
                    'name' => 'Заявка на - Получение перевода на карту',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_types_invoice'),
                    'code' => 'invoice',
                    'name' => 'Заявка на - Выставление счёта',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_types_credit_fact'),
                    'code' => 'credit_fact',
                    'name' => 'Заявка на - График погашения. Фактические платежи',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_types_credit_plan'),
                    'code' => 'credit_plan',
                    'name' => 'Заявка на - График погашения. Плановые платежи',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_types_order_card'),
                    'code' => 'order_card',
                    'name' => 'Заявка на - Заказ карты',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_types_remote_identification'),
                    'code' => 'remote_identification',
                    'name' => 'Заявка на - Удалённую идентификацию',
                    'is_active' => '1',
                ],
                [
                    'id' => "2ee823be-aaf7-4be6-9fe2-2d100da3fdce",
                    'code' => 'order_attach_business_account',
                    'name' => 'Заявка на - Прикрепление бизнес-счета',
                    'is_active' => '1',
                ],
                [
                    'id' => "2ee823be-aaf7-4be6-9fe2-2d100da4fdce",
                    'code' => 'order_detach_business_account',
                    'name' => 'Заявка на - Открепление бизнес-счета',
                    'is_active' => '1',
                ],
                [
                    'id' => "c74c622e-e717-4cf4-a9ad-62286e38c3a4",
                    'code' => 'order_account_type_item_create',
                    'name' => 'Заявка на - Открытие счета',
                    'is_active' => '1',
                ],
                [
                    'id' => "3684ac96-26f6-4d48-9950-92f0289fb228",
                    'code' => 'order_deposit_type_item_create',
                    'name' => 'Заявка на - Открытие депозита',
                    'is_active' => '1',
                ],
                [
                    'id' => "5528a230-f25b-4301-9b11-36a0983b8efe",
                    'code' => 'order_deposit_type_item_close',
                    'name' => 'Заявка на - Закрытие депозита',
                    'is_active' => '1',
                ],
            ];

            foreach ($items as $item) {
                try {
                    $cat = OrderTypes::create($item);
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                }
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
