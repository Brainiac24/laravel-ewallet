<?php

use App\Models\Order\OrderProcessStatus\OrderProcessStatus;
use App\Services\Common\Helpers\OrderProcessStatus as OrderProcessStatusStatic;
use Illuminate\Database\Seeder;

class OrderProcessStatusTableSeeder extends Database\Seeds\BaseSeeder
{
    public function run()
    {
        try {
            $items = [
                [
                    'id' => OrderProcessStatusStatic::NEW,
                    'code' => 'NEW',
                    'name' => 'Новая',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_DEPOSIT_STARTED,
                    'code' => 'CREATE_DEPOSIT_STARTED',
                    'name' => 'Создание депозита начата',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_DEPOSIT_INPROCESS,
                    'code' => 'CREATE_DEPOSIT_INPROCESS',
                    'name' => 'Создание депозита в процессе обработки',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_DEPOSIT_COMPLETED,
                    'code' => 'CREATE_DEPOSIT_COMPLETED',
                    'name' => 'Создание депозита успешно завершено',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_DEPOSIT_UNKNOWN,
                    'code' => 'CREATE_DEPOSIT_UNKNOWN',
                    'name' => 'Создание депозита Неизвестная ошибка',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_DEPOSIT_REJEECTED,
                    'code' => 'CREATE_DEPOSIT_REJEECTED',
                    'name' => 'Создание депозита отказано',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::FILL_DEPOSIT_STARTED,
                    'code' => 'FILL_DEPOSIT_STARTED',
                    'name' => 'Пополнения депозита начата',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::FILL_DEPOSIT_INPROCESS,
                    'code' => 'FILL_DEPOSIT_INPROCESS',
                    'name' => 'Пополнения Депозита в процессе обработки',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::FILL_DEPOSIT_COMPLETED,
                    'code' => 'FILL_DEPOSIT_COMPLETED',
                    'name' => 'Пополнения Депозита успешно завершено',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::FILL_DEPOSIT_UNKNOWN,
                    'code' => 'FILL_DEPOSIT_UNKNOWN',
                    'name' => 'Пополнения Депозита Неизвестная ошибка',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::FILL_DEPOSIT_REJECTED,
                    'code' => 'FILL_DEPOSIT_REJECTED',
                    'name' => 'Пополнения Депозита Отказано',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                   'id' => OrderProcessStatusStatic::PAY_CARD_SERVICE_STARTED,
                    'code' => 'PAY_CARD_SERVICE_STARTED',
                    'name' => 'Оплата стоимость карты начата',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::PAY_CARD_SERVICE_INPROCESS,
                    'code' => 'PAY_CARD_SERVICE_INPROCESS',
                    'name' => 'Оплата стоимость карты в процессе обработки',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::PAY_CARD_SERVICE_COMPLETED,
                    'code' => 'PAY_CARD_SERVICE_COMPLETED',
                    'name' => 'Оплата стоимость карты успешно завершена',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::PAY_CARD_SERVICE_UNKNOWN,
                    'code' => 'PAY_CARD_SERVICE_UNKNOWN',
                    'name' => 'Оплата стоимость карты неизвестная ошибка',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::PAY_CARD_SERVICE_REJECTED,
                    'code' => 'PAY_CARD_SERVICE_REJECTED',
                    'name' => 'Оплата стоимость карты отказано',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_CARD_STARTED,
                    'code' => 'CREATE_CARD_STARTED',
                    'name' => 'Создание карты(карточного договора) начата',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_CARD_INPROCESS,
                    'code' => 'CREATE_CARD_INPROCESS',
                    'name' => 'Создание карты(карточного договора) в процессе обработки',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_CARD_COMPLETED,
                    'code' => 'CREATE_CARD_COMPLETED',
                    'name' => 'Создание карты(карточного договора) успешно завершена',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_CARD_UNKNOWN,
                    'code' => 'CREATE_CARD_UNKNOWN',
                    'name' => 'Создание карты(карточного договора) неизвестная ошибка',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::REJECTED,
                    'code' => 'REJECTED',
                    'name' => 'Отказано',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::COMPLETED,
                    'code' => 'COMPLETED',
                    'name' => 'Завершено',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::NOT_ACCEPTED,
                    'code' => 'NOT_ACCEPTED',
                    'name' => 'Не принят',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::ACCEPTED,
                    'code' => 'ACCEPTED',
                    'name' => 'Принят',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::WAITING_CLIENT_CONFIRMATION,
                    'code' => 'WAITING_CLIENT_CONFIRMATION',
                    'name' => 'Ожидание подтверждения клиентом',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CLIENT_IDENTIFICATION_CONFIRMED,
                    'code' => 'CLIENT_IDENTIFICATION_CONFIRMED',
                    'name' => 'Идентификация подтверждена клиентом',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CLIENT_IDENTIFICATION_REJECTED,
                    'code' => 'CLIENT_IDENTIFICATION_REJECTED',
                    'name' => 'Идентификация отклонена клиентом',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CLOSE_DEPOSIT_STARTED,
                    'code' => 'CLOSE_DEPOSIT_STARTED',
                    'name' => 'Начало - закрытие депозита',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CLOSE_DEPOSIT_INPROCESS,
                    'code' => 'CLOSE_DEPOSIT_INPROCESS',
                    'name' => 'В процессе - закрытие депозита',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CLOSE_DEPOSIT_COMPLETED,
                    'code' => 'CLOSE_DEPOSIT_COMPLETED',
                    'name' => 'Завершено - закрытие депозита',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CLOSE_DEPOSIT_UNKNOWN,
                    'code' => 'CLOSE_DEPOSIT_COMPLETED',
                    'name' => 'Неизвестно - закрытие депозита',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CLOSE_DEPOSIT_REJECTED,
                    'code' => 'CLOSE_DEPOSIT_REJECTED',
                    'name' => 'Отказано - закрытие депозита',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_ACCOUNT_STARTED,
                    'code' => 'CREATE_ACCOUNT_STARTED',
                    'name' => 'Начало - открытие счёта',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_ACCOUNT_INPROCESS,
                    'code' => 'CREATE_ACCOUNT_INPROCESS',
                    'name' => 'В процессе - открытие счёта',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_ACCOUNT_COMPLETED,
                    'code' => 'CREATE_ACCOUNT_COMPLETED',
                    'name' => 'Завершено - открытие счёта',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_ACCOUNT_UNKNOWN,
                    'code' => 'CREATE_ACCOUNT_UNKNOWN',
                    'name' => 'Неизвестно - открытие счёта',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],
                [
                    'id' => OrderProcessStatusStatic::CREATE_ACCOUNT_REJECTED,
                    'code' => 'CREATE_ACCOUNT_REJECTED',
                    'name' => 'Отказано - открытие счёта',
                    'color' => '#ffffff',
                    'is_active' => '1',
                ],

            ];

            foreach ($items as $item) {
                try {
                   OrderProcessStatus::create($item);
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                }
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }

}