<?php

use App\Models\Order\OrderComments\OrderComments;
use Illuminate\Database\Seeder;

class OrderCommentTableSeeder extends Seeder
{
    public function run()
    {
        //
        try {
            $items = [
                [
                    'id' => 'f877fc3b-0dd9-11eb-b655-e386f22e0db6',
                    'order_type_id' => '77a08406-fe27-4b26-a409-bdb8ff0a4dbb',
                    'name' => '- Данные анкеты и паспорта не совпадают.',
                    'short_name' => 'По умолчание 1',
                    'is_active' => 1
                ],
                [
                    'id' => '08feb39f-0dda-11eb-b655-e386f22e0db6',
                    'order_type_id' => '77a08406-fe27-4b26-a409-bdb8ff0a4dbb',
                    'name' => '- Низкое качество фотографии лицевой стороны паспорта.',
                    'short_name' => 'По умолчание 2',
                    'is_active' => 1
                ],
                [
                    'id' => '192ead3d-0dda-11eb-b655-e386f22e0db6',
                    'order_type_id' => '77a08406-fe27-4b26-a409-bdb8ff0a4dbb',
                    'name' => '- Низкое качество фотографии оборотной стороны паспорта.',
                    'short_name' => 'По умолчание 3',
                    'is_active' => 1
                ],
                [
                    'id' => '27b019aa-0dda-11eb-b655-e386f22e0db6',
                    'order_type_id' => '77a08406-fe27-4b26-a409-bdb8ff0a4dbb',
                    'name' => '- Низкое качество Вашей фотографии с паспортом.',
                    'short_name' => 'По умолчание 4',
                    'is_active' => 1
                ],
                [
                    'id' => '41ab6996-0dda-11eb-b655-e386f22e0db6',
                    'order_type_id' => '77a08406-fe27-4b26-a409-bdb8ff0a4dbb',
                    'name' => '- Низкое качество дополнительного документа.',
                    'short_name' => 'По умолчание 5',
                    'is_active' => 1
                ],
                [
                    'id' => '1c88a8eb-b107-4a67-a3f7-35874706ce60',
                    'order_type_id' => '77a08406-fe27-4b26-a409-bdb8ff0a4dbb',
                    'name' => '- Необходимо сфотографировать и отправить дополнительный документ',
                    'short_name' => 'По умолчанию 6',
                    'is_active' => 1
                ],
            ];

            foreach ($items as $item) {
                try {
                    OrderComments::create($item);
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}