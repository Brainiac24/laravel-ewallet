<?php

use App\Models\Transaction\TransactionStatus\TransactionStatus;
use App\Services\Common\Helpers\TransactionStatus as TransactionStatic;
use App\Services\Common\Helpers\TransactionStatusGroup as TransactionStatusGroupStatic;
use Illuminate\Database\Seeder;

class TransactionStatusTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => config('app_settings.default_transaction_status_id'),
                'code' => 'NOT_VERIFIED',
                'name' => 'Неподтверждённая транзакция',
                'color' => '#ecf0f5',
                'transaction_status_group_id' => TransactionStatusGroupStatic::NOT_VERIFIED,
            ],
            [
                'id' => TransactionStatic::new,
                'code' => 'NEW',
                'name' => 'Новая транзакция',
                'color' => '#fcf8e3',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::PAY_IN_PROCESS,
                'code' => 'PAY_IN_PROCESS',
                'name' => 'В обработке(В процессе пополнения)',
                'color' => '#fcf8e3',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::PAY_ACCEPTED,
                'code' => 'PAY_ACCEPTED',
                'name' => 'Принят ПС(Пополнения принято)',
                'color' => '#fcf8e3',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::COMPLETED,
                'code' => 'COMPLETED',
                'name' => 'Завершён',
                'color' => '#dff0d8',
                'transaction_status_group_id' => TransactionStatusGroupStatic::COMPLETED,
            ],
            [
                'id' => TransactionStatic::REJECTED,
                'code' => 'REJECTED',
                'name' => 'Отказано',
                'color' => '#f2dede',
                'transaction_status_group_id' => TransactionStatusGroupStatic::REJECTED,
            ],
            [
                'id' => TransactionStatic::RETURNED,
                'code' => 'RETURNED',
                'name' => 'Возврат',
                'color' => '#dff0d8',
                'transaction_status_group_id' => TransactionStatusGroupStatic::RETURNED,
            ],
            [
                'id' => TransactionStatic::CONFIRM_UNKNOWN,
                'code' => 'CONFIRM_UNKNOWN',
                'name' => 'Подтверждения Неизвестная ошибка',
                'color' => '#d64242',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::BLOCK,
                'code' => 'BLOCK',
                'name' => 'Блокировка',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::BLOCKED,
                'code' => 'BLOCKED',
                'name' => 'Блокирован',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::CANCEL_UNKNOWN,
                'code' => 'CANCEL_UNKNOWN',
                'name' => 'Отмена неизвестная ошибка',
                'color' => '#d64242',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::BLOCK_IN_PROCESS,
                'code' => 'BLOCK_IN_PROCESS',
                'name' => 'В процессе блокировки',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::BLOCK_REJECTED,
                'code' => 'BLOCK_REJECTED',
                'name' => 'Блокировка отказано',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::PAY_CREATED,
                'code' => 'PAY_CREATED',
                'name' => 'Пополнения',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::PAY_COMPLETED,
                'code' => 'PAY_COMPLETED',
                'name' => 'Пополнения завершена',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::PAY_REJECTED,
                'code' => 'PAY_REJECTED',
                'name' => 'Пополнения отказано',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::CONFIRM,
                'code' => 'CONFIRM',
                'name' => 'Подтверждения',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::CONFIRM_IN_PROCESS,
                'code' => 'CONFIRM_IN_PROCESS',
                'name' => 'В процессе подтверждения',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::CONFIRMED,
                'code' => 'CONFIRMED',
                'name' => 'Подтверждена',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::CONFIRM_REJECTED,
                'code' => 'CONFIRM_REJECTED',
                'name' => 'Подтверждения отказано',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::UNKNOWN,
                'code' => 'UNKNOWN',
                'name' => 'Неизвестная ошибка',
                'color' => '#d64242',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::CANCEL,
                'code' => 'CANCEL',
                'name' => 'Отмена',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::CANCEL_IN_PROCESS,
                'code' => 'CANCEL_IN_PROCESS',
                'name' => 'В процессе отмены',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::CANCELED,
                'code' => 'CANCELED',
                'name' => 'Отменена',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::CANCEL_REJECTED,
                'code' => 'CANCEL_REJECTED',
                'name' => 'Отмена отказано',
                'color' => '',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::BLOCK_UNKNOWN,
                'code' => 'BLOCK_UNKNOWN',
                'name' => 'Блокировка Неизвестная ошибка',
                'color' => '#d64242',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],
            [
                'id' => TransactionStatic::PAY_UNKNOWN,
                'code' => 'PAY_UNKNOWN',
                'name' => 'Пополнения Неизвестная ошибка',
                'color' => '#d64242',
                'transaction_status_group_id' => TransactionStatusGroupStatic::IN_PROCESSING,
            ],

        ];

        foreach ($vars as $var) {
            try {
                //TransactionStatus::create($var);
                TransactionStatus::create(['id' => $var['id']], $var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }

    }
}
