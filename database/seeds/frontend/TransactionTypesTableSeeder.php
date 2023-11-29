<?php

use App\Models\Transaction\TransactionType\TransactionType;
use App\Services\Common\Helpers\TransactionType as TransactionStatic;
use Illuminate\Database\Seeder;

class TransactionTypesTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => config('app_settings.default_transaction_type_id'),
                'code' => 'PAYMENT',
                'name' => 'Оплата',
            ],
            [
                'id' => TransactionStatic::FILL,
                'code' => 'FILL',
                'name' => 'Пополнение',
            ],
            [
                'id' => TransactionStatic::RETURN,
                'code' => 'RETURN',
                'name' => 'Возврат',
            ],
        ];

        foreach ($vars as $var) {
            try {
                TransactionType::create($var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
