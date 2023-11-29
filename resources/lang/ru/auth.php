<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    'sign' => 'Войти',
    'remember' => 'Запомни меня',
    'access_forbidden' => 'Доступ запрещен!',
    'exist_email' => 'Email уже привязан.',
    'failed' => 'Имя пользователя или пароль не совпадают.',
    'bad_request' => 'Не правильный формат данных',
    'logic_error' => 'Логическая ошибка',
    'error' => 'Ошибка авторизации.',
    'temporary_blocked' => 'Слишком много попыток входа. Пожалуйста, попробуйте еще раз через :attribute.',
    'failed_sms_code_confirm' => 'Вы ввели неверный SMS-код',
    'failed_email_code_confirm' => 'Вы ввели неверный код',
    'blocked' => 'Ваш аккаунт заблокирован. Обратитесь в банк',
    'phone_not_found' => 'Номер телефона не зарегистрирован. Пожалуйста зарегистрируйтесь.',
    'device_not_found' => 'Идентификатор телефона не найден! Пожалуйста зарегистрируйтесь.',
    'timeout' => 'Истекло время ожидания!',
    'token_expired' => 'Срок токена истек или невалиден!',
    'limit_exceeded' => 'Лимит исчерпан!',
    'resource_not_found' => 'Данные не найдены!',
    'throttle' => 'Слишком много попыток входа. Пожалуйста, попробуйте еще раз через :seconds секунд.',
    'old_password_incorrectly' => 'Вы ввели неверный "Старый пароль".',

    'failed_pin_code_confirm' => 'Вы ввели неверный PIN-код. Осталось попыток: :attribute',
    'temporary_blocked_pin' => 'Вы ввели неверный PIN-код. Ваш аккаунт заблокирован. Попробуйте через :attribute.',
    'error_change_pin' => 'Ошибка при изменении PIN-кода!',
    'session_enter_pin_timeout' => 'Время действия ввода PIN-кода истекло. Пожалуйста, отправьте запрос заново.',

    'message_confirm_sms' => 'На Ваш номер отправлено SMS с кодом. Введите код из SMS.',
    'session_sms_timeout' => 'Время действия SMS-кода истекло. Пожалуйста, отправьте запрос заново.',
    'temporary_sms_blocked' => 'Повторная отправка SMS-кода доступна через :attribute.',
    'temporary_blocked_sms' => 'Вы ввели неверный SMS-код. Пожалуйста, попробуйте через :attribute.',

    'message_confirm_email' => 'На Ваш адрес :attribute было отправлено сообщение с кодом. Введите код.',
    'temporary_blocked_email' => 'Слишком много попыток ввода. Пожалуйста, попробуйте через :attribute.',
    'temporary_email_blocked' => 'Повторная отправка email кода доступна через :attribute.',
    'session_email_timeout' => 'Время действия кода для подтверждения истекло. Пожалуйста, отправьте запрос заново.',
    'sent_email' => 'На вашу электронную почту было отправлено сообщение с кодом. Введите код',
    'service_unavailable' => 'На сервере идет обновление... Пожалуйста попробуйте зайти позже.',
    'email_pinned_another_client' => 'Данная почта уже прикреплена другому аккаунту.',
    'tmp_email_not_exist' => 'Временная почта отсуствует',
];
