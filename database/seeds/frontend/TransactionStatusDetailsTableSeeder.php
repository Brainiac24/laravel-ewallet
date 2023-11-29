<?php

use App\Models\Transaction\TransactionStatusDetail\TransactionStatusDetail;
use App\Services\Common\Helpers\TransactionStatusDetail as TransactionStatic;
use Illuminate\Database\Seeder;

class TransactionStatusDetailsTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => config('app_settings.default_transaction_status_detail_id'),
                'code' => 'OK',
                'name' => 'OK',
            ],
            [
                'id' => TransactionStatic::ERROR_PS,
                'code' => 'ERROR_PS',
                'name' => 'Ошибка ПС',
            ],
            [
                'id' => TransactionStatic::ERROR_AUTH,
                'code' => 'ERROR_AUTH',
                'name' => 'Ошибка авторизации',
            ],
            [
                'id' => TransactionStatic::ERROR_UNKNOWN,
                'code' => 'ERROR_UNKNOWN',
                'name' => 'Неизвестная ошибка',
            ],
            [
                'id' => TransactionStatic::ACCOUNT_EXIST,
                'code' => 'ACCOUNT_EXIST',
                'name' => 'Аккаунт/номер существует',
            ],
            [
                'id' => TransactionStatic::ERROR_ACCOUNT_NOT_EXIST,
                'code' => 'ERROR_ACCOUNT_NOT_EXIST',
                'name' => 'Аккаунт/номер не существует',
            ],
            [
                'id' => TransactionStatic::ERROR_DUPLICATION,
                'code' => 'ERROR_DUPLICATION',
                'name' => 'Дублирование платежа',
            ],
            [
                'id' => TransactionStatic::ERROR_NOT_FOUND,
                'code' => 'ERROR_NOT_FOUND',
                'name' => 'Транзакция не найдена в базе данных',
            ],
            [
                'id' => TransactionStatic::ERROR_DIALER_NOT_FOUND,
                'code' => 'ERROR_DIALER_NOT_FOUND',
                'name' => 'Дилер не найден',
            ],
            [
                'id' => TransactionStatic::SHORTAGE_OF_FUNDS,
                'code' => 'SHORTAGE_OF_FUNDS',
                'name' => 'Нехватка средств на счете',
            ],
            [
                'id' => TransactionStatic::ERROR_CAN_NOT_CANCEL,
                'code' => 'ERROR_CAN_NOT_CANCEL',
                'name' => 'Отмена платежа невозможна',
            ],
            [
                'id' => TransactionStatic::ERROR_AMOUNT_IS_LESS,
                'code' => 'ERROR_AMOUNT_IS_LESS',
                'name' => 'Сумма слишком мала',
            ],
            [
                'id' => TransactionStatic::ERROR_AMOUNT_IS_GREATER,
                'code' => 'ERROR_AMOUNT_IS_GREATER',
                'name' => 'Сумма слишком велика',
            ],
            [
                'id' => TransactionStatic::ERROR_AMOUNT,
                'code' => 'ERROR_AMOUNT',
                'name' => 'Неверная сумма',
            ],
            [
                'id' => TransactionStatic::ERROR_ACCESS_DENIED_IP,
                'code' => 'ERROR_ACCESS_DENIED_IP',
                'name' => 'Запрос с данного IP запрещен',
            ],
            [
                'id' => TransactionStatic::ERROR_ACCOUNT_FORMAT,
                'code' => 'ERROR_ACCOUNT_FORMAT',
                'name' => 'Неверный формат счета/телефона',
            ],
            [
                'id' => TransactionStatic::ERROR_DAILY_LIMIT_EXCEEDED,
                'code' => 'ERROR_DAILY_LIMIT_EXCEEDED',
                'name' => 'Превышен дневной лимит',
            ],
            [
                'id' => TransactionStatic::ERROR_WEEKLY_LIMIT_EXCEEDED,
                'code' => 'ERROR_WEEKLY_LIMIT_EXCEEDED',
                'name' => 'Превышен недельный лимит',
            ],
            [
                'id' => TransactionStatic::ERROR_MONTHLY_LIMIT_EXCEEDED,
                'code' => 'ERROR_MONTHLY_LIMIT_EXCEEDED',
                'name' => 'Превышен месячный лимит',
            ],
            [
                'id' => TransactionStatic::ERROR_WALLET_LIMIT_EXCEEDED,
                'code' => 'ERROR_WALLET_LIMIT_EXCEEDED',
                'name' => 'Превышен баланс кошелька',
            ],
            [
                'id' => TransactionStatic::ERROR_PROVIDER_TEMPORARILY_UNAVAILABLE,
                'code' => 'ERROR_PROVIDER_TEMPORARILY_UNAVAILABLE',
                'name' => 'Провайдер временно недоступен',
            ],
            [
                'id' => TransactionStatic::ERROR_REQUEST,
                'code' => 'ERROR_REQUEST',
                'name' => 'Неверный запрос',
            ],
            [
                'id' => TransactionStatic::ERROR_CURRENCY_IS_INCORRECT,
                'code' => 'ERROR_CURRENCY_IS_INCORRECT',
                'name' => 'Валюта указано некорректно или временно не производит операции в указанной валюте',
            ],
            [
                'id' => TransactionStatic::ERROR_LIMIT_IS_EXCEEDED,
                'code' => 'ERROR_LIMIT_IS_EXCEEDED',
                'name' => 'Превышен лимит',
            ],
            [
                'id' => TransactionStatic::ERROR_ACCEPTED_IS_FORBIDDEN,
                'code' => 'ERROR_ACCEPTED_IS_FORBIDDEN',
                'name' => 'Прием платежа запрещен провайдером',
            ],
            [
                'id' => TransactionStatic::ERROR_ACCOUNT_IS_NOT_ACTIVE,
                'code' => 'ERROR_ACCOUNT_IS_NOT_ACTIVE',
                'name' => 'Счет абонента не активен',
            ],
            [
                'id' => TransactionStatic::IN_PROCESSING,
                'code' => 'IN_PROCESSING',
                'name' => 'Проведение платежа неокончено',
            ],
            [
                'id' => TransactionStatic::ERROR_NOT_ACCEPTED,
                'code' => 'ERROR_NOT_ACCEPTED',
                'name' => 'Платеж не проведен',
            ],
            [
                'id' => TransactionStatic::ERROR_CONTACT_YOUR_EMITENT,
                'code' => 'ERROR_CONTACT_YOUR_EMITENT',
                'name' => 'Отказ. Обратитесь к эмитенту',
            ],
            [
                'id' => TransactionStatic::ERROR_DIALER_UNAVAILABLE,
                'code' => 'ERROR_DIALER_UNAVAILABLE',
                'name' => 'Дилер/Эмитент отключен',
            ],
            [
                'id' => TransactionStatic::ERROR_CARD_EXPIRED,
                'code' => 'ERROR_CARD_EXPIRED',
                'name' => 'Истек срок действия карты',
            ],
            [
                'id' => TransactionStatic::ERROR_TRANSACTION_IS_PROHIBITED_FOR_CARD,
                'code' => 'ERROR_TRANSACTION_IS_PROHIBITED_FOR_CARD',
                'name' => 'Транзакция запрещена для карты',
            ],
            [
                'id' => TransactionStatic::ERROR_TRANSACTION_IS_NOT_AVAILABLE_FOR_TERMINAL,
                'code' => 'ERROR_TRANSACTION_IS_NOT_AVAILABLE_FOR_TERMINAL',
                'name' => 'Транзакция запрещена для терминала',
            ],
            [
                'id' => TransactionStatic::TRANSACTION_ALREADY_CANCELED,
                'code' => 'TRANSACTION_ALREADY_CANCELED',
                'name' => 'Транзакция уже отменена',
            ],
            [
                'id' => TransactionStatic::ERROR_CARD_TEMPORARILY_BLOCKED,
                'code' => 'ERROR_CARD_TEMPORARILY_BLOCKED',
                'name' => 'Карта временно блокирована',
            ],
            
        ];

        foreach ($vars as $var) {
            try {
                TransactionStatusDetail::create($var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
