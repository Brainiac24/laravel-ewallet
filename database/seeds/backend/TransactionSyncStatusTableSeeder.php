<?php

use App\Models\Transaction\TransactionSyncStatus\TransactionSyncStatus as TransactionSyncStatusModel;
use App\Services\Common\Helpers\TransactionSyncStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class TransactionSyncStatusTableSeeder extends Database\Seeds\BaseSeeder
{

    public function run()
    {
        $vars = [
            [
                'id' => TransactionSyncStatus::NOT_NEED_SYNC,
                'code' => 'NOT_NEED_SYNC',
                'name' => 'Не нуждается в синхронизации',
            ],
            [
                'id' => TransactionSyncStatus::NEED_TO_SYNC,
                'code' => 'NEED_TO_SYNC',
                'name' => 'Нуждается в синхронизации',
            ],
            [
                'id' => TransactionSyncStatus::IN_PROCESS_QUEUE,
                'code' => 'IN_PROCESS_QUEUE',
                'name' => 'В очереди',
            ],
            [
                'id' => TransactionSyncStatus::ERROR_QUEUE,
                'code' => 'ERROR_QUEUE',
                'name' => 'Ошибка обработки очереди',
            ],
            [
                'id' => TransactionSyncStatus::IN_PROCESS_BUS,
                'code' => 'IN_PROCESS_BUS',
                'name' => 'В процессе обработки Шины',
            ],
            [
                'id' => TransactionSyncStatus::ERROR_BUS,
                'code' => 'ERROR_BUS',
                'name' => 'Ошибка обработки Шины',
            ],
            [
                'id' => TransactionSyncStatus::COMPLETED_BUS,
                'code' => 'COMPLETED_BUS',
                'name' => 'Успешный ответ Шины',
            ],
        ];

        foreach ($vars as $var) {
            try {
                //TransactionStatus::create($var);
                TransactionSyncStatusModel::create($var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
