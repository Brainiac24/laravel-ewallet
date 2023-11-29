<?php

use Illuminate\Database\Seeder;
use App\Models\DocApiCategory\DocApiCategory;

class DocApiCategoriesTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 'e1c5b222-2f7f-11e9-96f3-b06ebfbfa715', 'name' => '0. Примеры'],
            ['id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715', 'name' => '1. Регистрация'],
            ['id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715', 'name' => '2. Пользователи'],
            ['id' => 'ef649d84-2f7f-11e9-96f3-b06ebfbfa715', 'name' => '3. Операторы услуг'],
            ['id' => 'f3bb9f2a-2f7f-11e9-96f3-b06ebfbfa715', 'name' => '4. Транзакции'],
            ['id' => 'f79fae79-2f7f-11e9-96f3-b06ebfbfa715', 'name' => '5. Шаблоны'],
            ['id' => 'ff448d87-2f7f-11e9-96f3-b06ebfbfa715', 'name' => '6. Прочие API'],
            ['id' => '8bd27482-4623-11e9-9335-b06ebfbfa715', 'name' => '7. Карты, Счета, Депозиты, Кредиты'],
        ];

        foreach ($items as $item) {
            try {
                $res = DocApiCategory::create(['id' => $item['id']], $item);
                //$res = DocApiCategory::create($item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }

    }
}
