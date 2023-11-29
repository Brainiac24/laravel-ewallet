<?php

use App\Models\User\Event\Event;
use App\Services\Common\Helpers\Events;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => Events::TRANSACTION_CREATED,
                'code' => 'TRANSACTION_CREATED',
                'name' => 'Транзакция создана',
            ],
            [
                'id' => Events::TRANSACTION_CHANGED,
                'code' => 'TRANSACTION_CHANGED',
                'name' => 'Транзакция изменена',
            ],
            [
                'id' => Events::ACCOUNT_CREATED,
                'code' => 'ACCOUNT_CREATED',
                'name' => 'Счёт создан',
            ],
            [
                'id' => Events::ACCOUNT_CHANGED,
                'code' => 'ACCOUNT_CHANGED',
                'name' => 'Счёт изменён',
            ],
            [
                'id' => Events::USER_PROFILE_UPDATED,
                'code' => 'USER_PROFILE_UPDATED',
                'name' => 'Данные пользователя обновлены',
            ],
            [
                'id' => Events::USER_SETTINGS_NOTIFICATIONS_UPDATED,
                'code' => 'USER_SETTINGS_NOTIFICATIONS_UPDATED',
                'name' => 'Данные настроек уведомлений пользователя обновлены',
            ],
            [
                'id' => Events::FAVORITE_CREATED,
                'code' => 'FAVORITE_CREATED',
                'name' => 'Шаблон добавлен',
            ],
            [
                'id' => Events::FAVORITE_UPDATED,
                'code' => 'FAVORITE_UPDATED',
                'name' => 'Шаблон изменен',
            ],
            [
                'id' => Events::FAVORITE_DELETED,
                'code' => 'FAVORITE_DELETED',
                'name' => 'Шаблон удалён',
            ],
            [
                'id' => Events::USER_REGISTERING_PHONE,
                'code' => 'USER_REGISTERING_PHONE',
                'name' => 'Пользователь в процессе регистрации номера телефона',
            ],
            [
                'id' => Events::USER_REGISTERING_PHONE_RESEND_SMS,
                'code' => 'USER_REGISTERING_PHONE_RESEND_SMS',
                'name' => 'Отправить заново смс(Пользователь в процессе регистрации номера телефона)',
            ],
            [
                'id' => Events::USER_REGISTERED_PHONE,
                'code' => 'USER_REGISTERED_PHONE',
                'name' => 'Пользователь успешно зарегистрировал номера телефона',
            ],
            [
                'id' => Events::USER_REGISTERED_WITH_PIN,
                'code' => 'USER_REGISTERED_WITH_PIN',
                'name' => 'Пользователь успешно зарегистрирован с помощью Пин-кода',
            ],
            [
                'id' => Events::USER_AUTHENTICATED_WITH_PIN,
                'code' => 'USER_AUTHENTICATED_WITH_PIN',
                'name' => 'Пользователь успешно аутентифицирован с помощью Пин-кода',
            ],
            [
                'id' => Events::USER_CHANGING_PIN,
                'code' => 'USER_CHANGING_PIN',
                'name' => 'Пользователь в процессе смены Пин-кода',
            ],
            [
                'id' => Events::USER_CHANGED_PIN,
                'code' => 'USER_CHANGED_PIN',
                'name' => 'Пользователь сменил Пин-код',
            ],
            [
                'id' => Events::USER_CHANGE_PIN_LIMIT_IS_EXCEEDED,
                'code' => 'USER_CHANGE_PIN_LIMIT_IS_EXCEEDED',
                'name' => 'Количество ввода попыток исчерпан(смена Пин-код)',
            ],
            [
                'id' => Events::USER_RESETTING_PIN,
                'code' => 'USER_RESETTING_PIN',
                'name' => 'Пользователь в процессе сброса Пин-кода',
            ],
            [
                'id' => Events::USER_RESETTING_CONFIRMED_PIN,
                'code' => 'USER_RESETTING_CONFIRMED_PIN',
                'name' => 'Пользователь подтвердил попытку сброса Пин-кода',
            ],
            [
                'id' => Events::USER_RESET_PIN,
                'code' => 'USER_RESET_PIN',
                'name' => 'Пользователь успешно сбросил Пин-код',
            ],
            [
                'id' => Events::USER_REGISTERING_EMAIL,
                'code' => 'USER_REGISTERING_EMAIL',
                'name' => 'Пользователь в процессе регистрации Email-a',
            ],
            [
                'id' => Events::USER_REGISTERED_EMAIL,
                'code' => 'USER_REGISTERED_EMAIL',
                'name' => 'Пользователь успешно зарегистрировал Email',
            ],
            [
                'id' => Events::USER_SETTING_EMAIL_DETACHING,
                'code' => 'USER_SETTING_EMAIL_DETACHING',
                'name' => 'В процессе открепление Почты',
            ],
            [
                'id' => Events::USER_SETTING_EMAIL_DETACH_CONFIRMED,
                'code' => 'USER_SETTING_EMAIL_DETACH_CONFIRMED',
                'name' => 'Почта успешно отпреплена!',
            ],
            [
                'id' => Events::USER_SETTING_EMAIL_ATTACHING,
                'code' => 'USER_SETTING_EMAIL_ATTACHING',
                'name' => 'В процессе прикрепление Почты',
            ],
            [
                'id' => Events::USER_SETTING_EMAIL_ATTACH_CONFIRMED,
                'code' => 'USER_SETTING_EMAIL_ATTACH_CONFIRMED',
                'name' => 'Почта успешно прикреплена',
            ],
            [
                'id' => Events::REFRESHED_TOKEN,
                'code' => 'REFRESHED_TOKEN',
                'name' => 'Refresh Token был обновлен',
            ],
            [
                'id' => Events::USER_LOGOUT,
                'code' => 'USER_LOGOUT',
                'name' => 'Выход из аккаунта...',
            ],
            [
                'id' => Events::SET_PUSH_TOKEN,
                'code' => 'SET_PUSH_TOKEN',
                'name' => 'Новый токен для PUSH уведомлений установлен',
            ],
            [
                'id' => Events::USER_LIMITS_CHANGED,
                'code' => 'USER_LIMITS_CHANGED',
                'name' => 'Лимиты пользователя изменены',
            ],
            [
                'id' => Events::CREATED,
                'code' => 'CREATED',
                'name' => 'Создано',
            ],
            [
                'id' => Events::RESTORED,
                'code' => 'RESTORED',
                'name' => 'Востановлено',
            ],
            [
                'id' => Events::UPDATED,
                'code' => 'UPDATED',
                'name' => 'Изменено',
            ],
            [
                'id' => Events::DELETED,
                'code' => 'DELETED',
                'name' => 'Удалено',
            ],
            [
                'id' => Events::ATTESTATION_STATUS_CHANGED,
                'code' => 'ATTESTATION_STATUS_CHANGED',
                'name' => 'Аттестация пользователя подтверждена/отклонена',
            ],
            [
                'id' => Events::USER_TEMPORARY_BLOCK_FOR_AUTH_PIN,
                'code' => 'USER_TEMPORARY_BLOCK_FOR_AUTH_PIN',
                'name' => 'Пользователь ввёл неверный Pin-код. Аккаунт временно блокирован(Вход)',
            ],
            [
                'id' => Events::USER_TEMPORARY_BLOCK_FOR_AUTH_PASSWORD,
                'code' => 'USER_TEMPORARY_BLOCK_FOR_AUTH_PASSWORD',
                'name' => 'Пользователь ввёл неверный Пароль. Аккаунт временно блокирован(Вход)',
            ],
            [
                'id' => Events::USER_ACCOUNT_CARD_ATTACHING,
                'code' => 'USER_ACCOUNT_CARD_ATTACHING',
                'name' => 'Пользователь в процессе прикрепление карты',
            ],
            [
                'id' => Events::USER_ACCOUNT_CARD_DETACHING,
                'code' => 'USER_ACCOUNT_CARD_DETACHING',
                'name' => 'Пользователь открепил карту',
            ],
            [
                'id' => Events::USER_ACCOUNT_CARD_CONFIRMED,
                'code' => 'USER_ACCOUNT_CARD_CONFIRMED',
                'name' => 'Пользователь прикрепил карту',
            ],
            [
                'id' => Events::USER_ACCOUNT_CARD_BLOCKING,
                'code' => 'USER_ACCOUNT_CARD_BLOCKING',
                'name' => 'Карта в процессе блокировки',
            ],
            [
                'id' => Events::USER_ACCOUNT_CARD_BLOCKING_CONFIRMED,
                'code' => 'USER_ACCOUNT_CARD_BLOCKING_CONFIRMED',
                'name' => 'Пользователь подтвердил блокировки карты',
            ],
            [
                'id' => Events::USER_ACCOUNT_CARD_UNBLOCKING,
                'code' => 'USER_ACCOUNT_CARD_UNBLOCKING',
                'name' => 'Карта в процессе разблокировки',
            ],
            [
                'id' => Events::USER_ACCOUNT_CARD_UNBLOCKING_CONFIRMED,
                'code' => 'USER_ACCOUNT_CARD_UNBLOCKING_CONFIRMED',
                'name' => 'Пользователь подтвердил разблокировки карты',
            ],
            [
                'id' => Events::USER_REGISTER_PASSWORD_WITH_WEB,
                'code' => 'USER_REGISTER_PASSWORD_WITH_WEB',
                'name' => 'Пользователь успешно зарегистрировал Пароль на Web-сайте. Следующий шаг ввод секретного слово...',
            ],
            [
                'id' => Events::USER_REGISTERED_PASSWORD_AND_SECRET_WORD_WITH_WEB,
                'code' => 'USER_REGISTERED_PASSWORD_AND_SECRET_WORD_WITH_WEB',
                'name' => 'Пользователь успешно зарегистрирован с помощью Паролья и Секретного слово на Web-сайте.',
            ],
            [
                'id' => Events::USER_AUTHENTICATED_WITH_WEB,
                'code' => 'USER_AUTHENTICATED_WITH_WEB',
                'name' => 'Пользователь успешно аутентифицирован с помощью Пароля на Web-сайте',
            ],
            [
                'id' => Events::USER_AUTHENTICATION_ENTERED_PASSWORD,
                'code' => 'USER_AUTHENTICATION_ENTERED_PASSWORD',
                'name' => 'Пользователь успешно ввел Пароль для аутентификации',
            ],
            [
                'id' => Events::USER_PASSWORD_ADDED,
                'code' => 'USER_PASSWORD_ADDED',
                'name' => 'Пользователь успешно установил пароль через Настройки',
            ],
            [
                'id' => Events::USER_PASSWORD_CHANGED,
                'code' => 'USER_PASSWORD_CHANGED',
                'name' => 'Пользователь успешно изменил Пароль через Настройки',
            ],
            [
                'id' => Events::USER_ENTERED_WRONG_PASSWORD_FOR_CHANGE,
                'code' => 'USER_ENTERED_WRONG_PASSWORD_FOR_CHANGE',
                'name' => 'Пользователь несколько раз ввел неверный Пароль через Настройки. Выход из аккаунта...',
            ],
            [
                'id' => Events::USER_PASSWORD_RESETED,
                'code' => 'USER_PASSWORD_RESETED',
                'name' => 'Пользователь успешно сбросил пароль через Web',
            ],
            [
                'id' => Events::USER_ENTERED_WRONG_DATA_FOR_RESET,
                'code' => 'USER_ENTERED_WRONG_DATA_FOR_RESET',
                'name' => 'Пользователь несколько раз ввел неверные данные для Сброса Пароля. Блокировка аккаунта...',
            ],
            [
                'id' => Events::USER_PASSWORD_RESETING,
                'code' => 'USER_PASSWORD_RESETING',
                'name' => 'Пользователь в процессе сброса пароля(Данные были успешно введены)',
            ],
            [
                'id' => Events::USER_UPDATE_VIA_IDENTIFICATION_TRANSPORT,
                'code' => 'USER_UPDATE_VIA_IDENTIFICATION_TRANSPORT',
                'name' => 'Данные пользователя обновлены, через идентификация пользователей',
            ],
            [
                'id' => Events::USER_ACCOUNT_FOREIGN_CARD_ATTACHING,
                'code' => 'USER_ACCOUNT_FOREIGN_CARD_ATTACHING',
                'name' => 'Пользователь в процессе прикрепление внешней карты',
            ],
            [
                'id' => Events::USER_ACCOUNT_FOREIGN_CARD_ATTACH_SUCCEEDED,
                'code' => 'USER_ACCOUNT_FOREIGN_CARD_ATTACH_SUCCEEDED',
                'name' => 'Внешняя карта успешно прикреплена',
            ],
            [
                'id' => Events::USER_ACCOUNT_FOREIGN_CARD_ATTACH_FAILED,
                'code' => 'USER_ACCOUNT_FOREIGN_CARD_ATTACH_FAILED',
                'name' => 'Ошибка при прикреплении внешней карты',
            ],
            [
                'id' => Events::USER_ACCOUNT_FOREIGN_CARD_DETACHED,
                'code' => 'USER_ACCOUNT_FOREIGN_CARD_DETACHED',
                'name' => 'Пользователь открепил внешнюю карту',
            ],
            [
                'id' => Events::REMOTE_IDENTIFICATION_CHANGED_PROFILE,
                'code' => 'REMOTE_IDENTIFICATION_CHANGED_PROFILE',
                'name' => 'Удаленная идентификация, анкетные данные изменен',
            ],
            [
                'id' => Events::REMOTE_IDENTIFICATION_REJECTED,
                'code' => 'REMOTE_IDENTIFICATION_REJECTED',
                'name' => 'Удаленная идентификация, заявка отменен',
            ],
            [
                'id' => Events::REMOTE_IDENTIFICATION_ACCEPTED,
                'code' => 'REMOTE_IDENTIFICATION_ACCEPTED',
                'name' => 'Удаленная идентификация, заявка принято',
            ],
            [
                'id' => Events::REMOTE_IDENTIFICATION_SEARCHED_CLIENT,
                'code' => 'REMOTE_IDENTIFICATION_SEARCHED_CLIENT',
                'name' => 'Удаленная идентификация, поиск клиента',
            ],
            [
                'id' => Events::REMOTE_IDENTIFICATION_CREATED_CLIENT,
                'code' => 'REMOTE_IDENTIFICATION_CREATED_CLIENT',
                'name' => 'Удаленная идентификация, отправлен запрос для создание клиента',
            ],
            [
                'id' => Events::REMOTE_IDENTIFICATION_CONFIRMED,
                'code' => 'REMOTE_IDENTIFICATION_CONFIRMED',
                'name' => 'Удаленная идентификация, заявка подтверждено',
            ],
            [
                'id' => Events::REMOTE_IDENTIFICATION_CREATED_PROFILE,
                'code' => 'REMOTE_IDENTIFICATION_CREATED_PROFILE',
                'name' => 'Удаленная идентификация, Создана анкета',
            ],
            [
                'id' => Events::REMOTE_IDENTIFICATION_UPDATED_CLIENT,
                'code' => 'REMOTE_IDENTIFICATION_UPDATED_CLIENT',
                'name' => 'Удаленная идентификация, отправлен запрос для обновление клиента',
            ],

            [
                'id' => Events::REMOTE_IDENTIFICATION_REREGISTER,
                'code' => 'REMOTE_IDENTIFICATION_REREGISTER',
                'name' => 'Удаленная идентификация, отправлен запрос на повторную регистрацию клиента в АБС',
            ],
        ];

        foreach ($vars as $var) {
            try {
                $cat = Event::create($var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
