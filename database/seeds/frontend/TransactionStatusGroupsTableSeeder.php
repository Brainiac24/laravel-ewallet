<?php

use App\Models\Transaction\TransactionStatusGroup\TransactionStatusGroup;
use App\Services\Common\Helpers\TransactionStatusGroup as TransactionStatusGroupStatic;
use Illuminate\Database\Seeder;

class TransactionStatusGroupsTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => TransactionStatusGroupStatic::IN_PROCESSING,
                'code' => 'IN_PROCESSING',
                'name' => 'В обработке',
            ],
            [
                'id' => TransactionStatusGroupStatic::COMPLETED,
                'code' => 'COMPLETED',
                'name' => 'Исполнено',
            ],
            [
                'id' => TransactionStatusGroupStatic::REJECTED,
                'code' => 'REJECTED',
                'name' => 'Отказано',
            ],
            [
                'id' => TransactionStatusGroupStatic::RETURNED,
                'code' => 'RETURNED',
                'name' => 'Возврат',
            ],
            [
                'id' => TransactionStatusGroupStatic::NOT_VERIFIED,
                'code' => 'NOT_VERIFIED',
                'name' => 'Неподтверждённая',
            ],
        ];

        foreach ($vars as $var) {
            try {
                TransactionStatusGroup::create($var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
