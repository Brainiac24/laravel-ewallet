<?php

use Illuminate\Database\Seeder;
use App\Models\Order\OrderStatus\OrderStatus;

class OrderStatusTableSeeder extends Database\Seeds\BaseSeeder
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
                    'id' => config('app_settings.order_status_not_verified'),
                    'code' => 'no_verified',
                    'name' => 'Не верифицирован',
                    'color' => '#f5f5f5',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_status_new'),
                    'code' => 'new',
                    'name' => 'Новая',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_status_in_process'),
                    'code' => 'in_process',
                    'name' => 'В обработке',
                    'color' => '#fcf8e3',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_status_accepted'),
                    'code' => 'accepted',
                    'name' => 'Принят',
                    'color' => '#fcf8e3',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_status_completed'),
                    'code' => 'completed',
                    'name' => 'Завершен',
                    'color' => '#dff0d8',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_status_rejected'),
                    'code' => 'rejected',
                    'name' => 'Отказано',
                    'color' => '#f2dede',
                    'is_active' => '1',
                ],
                [
                    'id' => config('app_settings.order_status_unknown'),
                    'code' => 'unknown',
                    'name' => 'Неизвестная ошибка',
                    'color' => '#f2dede',
                    'is_active' => '1',
                ],
                [
                    'id' => "634697f4-0945-479e-a0c9-9b1e3bff5266",
                    'code' => 'canceled',
                    'name' => 'Отменён',
                    'color' => '#979797',
                    'is_active' => '1',
                ],
            ];

            foreach ($items as $item) {
                try {
                    $cat = OrderStatus::create($item);
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                }
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
