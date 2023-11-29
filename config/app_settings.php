<?php

use App\Services\Common\Helpers\Category;
use App\Services\Common\Helpers\TransactionStatus;
use App\Services\Common\Helpers\TransactionStatusDetail;
use App\Services\Common\Helpers\TransactionType;
use App\Services\Common\Helpers\Gateway;

return [

    'allowed_ips_for_change_rate' => ['192.168.88.42', '::1', '10.10.2.203', '10.10.2.201', '127.0.0.1', '10.10.2.205','10.10.2.67'],
    'allowed_ips_for_change_transaction_status' => ['192.168.88.42', '::1', '10.10.2.203', '127.0.0.1', '172.23.0.1', '10.10.2.205', '10.10.2.201'],
    'categories' => [
        'type' => 'category', // тип - для составления меню
        'menu_cash' => 'cash',
        'menu_qr' => 'qr',
        'menu_map' => 'map',
    ],
    'services' => [
        'type' => 'service', // тип - для составления меню
    ],

    'service_icons_url_host' => 'imgs/services', // secure_asset('/imgs/services');   'http://10.10.2.203/laravel-ewallet/public/imgs/services',

    'admin_id' => '46ff63db-a077-11e8-904b-b06ebfbfa715',
    'role_admin_id' => '7c6877df-bbfa-11e8-99d9-b06ebfbfa722',
    'test_apple_client_id' => 'a5314e7e-bbfb-11e8-99d9-b06ebfbfa722',
    'system_user_id' => 'd09550a6-bfaf-11e8-9676-b06ebfbfa715',
    'default_code_apple' => '5481',
    'default_transaction_type_id' => TransactionType::PAYMENT, // Оплата
    'default_transaction_status_id' => TransactionStatus::NOT_VERIFIED, // Статус по умолчанию для перевода между кошельками
    'default_transaction_status_detail_id' => TransactionStatusDetail::OK, // Детализированный статус по умолчанию для перевода между кошельками
    'default_wallet_account_type_id' => '05864267-a077-11e8-904b-b06ebfbfa715', //  Электронный кошелёк Эсхата

    //'default_wallet_card_local_id' => '8b9484fb-44b8-11e9-985c-b06ebfbfa722', //  Локальная карта Эсхата
    'default_account_category_type_accounts_id' => 'd916c424-fefd-4805-9157-7d83b801fe74', //Счета
    'default_service_limit_id' => 'cb31282f-9fb7-11e8-904b-b06ebfbfa715',
    'default_gateway_id' => Gateway::PS_ESKHATA,
    'default_workday_id' => '020d67b2-9fb8-11e8-904b-.b06ebfbfa715',
    'exchange_workday_id' => 'd313f173-cef4-11e9-9407-b06ebfbfa715',
    'default_commission_id' => '14cb3355-9fb8-11e8-904b-b06ebfbfa715',
    'default_currency_id' => '2455e6c1-9fb8-11e8-904b-b06ebfbfa715', //TJS
    'default_attestation_id' => '0ee95dcb-a078-11e8-904b-b06ebfbfa715', // Неидентифицированный
    'identified_attestation_id' => 'cf8d53eb-a078-11e8-904b-b06ebfbfa715', // Идентифицированный
    'legal_entity_attestation_id' => 'd5fbcd37-637b-455c-94be-8fbf11ad2b79', // Юридическое лицо - для мерчанта
    'personalized_attestation_id' => 'b35bf0b5-9412-4a6e-83ef-c1a491812f3d', // Персональный
    'default_category_menu_id' => Category::MOBILE_VERSION_1, // Меню
    'currency_id_tjs' => '2455e6c1-9fb8-11e8-904b-b06ebfbfa715', // TJS

    'default_rucard_id' => Gateway::RUCARD,
    'default_account_category_type_card_id' => 'e8618671-32a1-492d-b0d5-be0130cff79a', // Карта
    'default_account_category_type_ewallet_id' => 'a5eb8080-e525-4a9e-9408-21e73bcc3f0f', // Электронный кошелек

    'default_card_ewallet' => '12',

    'default_local_card_account_type_id' => '8b9484fb-44b8-11e9-985c-b06ebfbfa722', //  Тип карта
    'default_local_card_account_type_code_map' => '7',

    'default_card_visa_classic_id' => '74fd85c7-ea43-4793-85fd-40bd1b775772',
    'default_card_visa_classic_code_map' => '1',

    'default_card_visa_gold_id' => '30b516bb-9735-4f45-b3d7-68e0e0595c9b',
    'default_card_visa_gold_code_map' => '2',

    'default_card_visa_electron_id' => 'e649a753-a896-41cb-b4cb-eb98b28e8109',
    'default_card_visa_electron_code_map' => '8',

    'default_card_mastercard_id' => '936c1b42-4792-447c-be8e-788f29fff5cb',
    'default_card_mastercard_code_map' => '3',

    'default_card_mastercard_gold_id' => 'a01f20d8-2810-4e56-9a63-5db667a88770',
    'default_card_mastercard_gold_code_map' => '4',

    'default_card_mastercard_business_id' => '1dc883a7-b871-45cd-8959-2798d9d77a76',
    'default_card_mastercard_business_code_map' => '5',

    'default_card_ygona_id' => '2e6da967-ad0c-4ae0-b4fd-dc0543cf9032',
    'default_card_ygona_code_map' => '9',

    'default_card_unionpay_classic_id' => 'd23e74a4-9d5a-4288-ab43-07e3c9a1f269',
    'default_card_unionpay_classic_code_map' => '10',

    'default_card_unionpay_gold_id' => 'a2153416-b016-4018-a849-8a0d7c78c829',
    'default_card_unionpay_gold_code_map' => '11',

    'default_card_korti_milli_nonpers_id' => 'c4c82d7b-b078-4a28-9a37-fdc1888c4563',
    'default_card_korti_milli_nonpers_code_map' => '12',

    'default_card_korti_milli_id' => '5ca9a953-c8ce-4ddd-b16c-e02bfd66f0a7',
    'default_card_korti_milli_code_map' => '13',

    'default_account_status_work' => '26524e1d-2794-4a96-a97b-0632063ed2e0',

    'default_country_id' => '1b3f6684-0a20-4cca-9f4e-fd5744816e02',

    'system_login' => 'SYSTEM',

    'default_account_category_type_id' => '00000000-0000-0000-0000-000000000000',

    'order_types_credit' => '0ee823be-aaf7-4be6-9fe2-2d100da3fdce',
    'order_types_deposit' => '7a7c29d4-0905-40b5-8e8d-d90dd3dabd13',
    'order_types_block_account' => '92d9f777-a58f-4873-9f12-d9523ac40db0',
    'order_types_unlock_account' => '2e1561d0-0f2b-4a5c-b612-e2664c2a6650',
    'order_types_account_transactions' => 'a0f0aedc-a295-42fe-92dc-3f80c16db307',
    'order_types_credit_transactions' => 'fd0cdb2c-eef3-4e52-b064-2ff68b52b384',
    'order_types_card_transactions' => 'a6385416-8c35-4878-8bab-6dd6f47dca49',
    'order_types_deposit_transactions' => 'abef86a9-631c-4745-ab7e-9f63308478fa',
    'order_types_transfer' => 'da095968-5ff6-46ca-a782-dc74245f7a48',
    'order_types_invoice' => '12af7c81-f0c6-455f-a776-7994f7630f01',
    'order_types_credit_fact' => '6bb15c4c-6317-4caa-973b-bb0314a60a19',
    'order_types_credit_plan' => 'd900cc0c-f3e9-4231-adb6-26ff80260822',
    'order_types_order_card' => '629d0488-1b2d-11ea-8385-309c2326bc93',
    'order_types_remote_identification' => '77a08406-fe27-4b26-a409-bdb8ff0a4dbb',

    'order_status_not_verified' => '3da4937e-5832-437c-8aed-ee17f912ac5a',
    'order_status_new' => '24f47432-e967-427e-8dcb-22dffc25b983',
    'order_status_in_process' => '10c2ab3d-2ba2-419f-945a-1cf28333267a',
    'order_status_accepted' => 'db8a0374-23c5-4cda-9018-4d0c2101a38f',
    'order_status_completed' => '707f4a09-066b-48b0-8cdd-0e58eba0b887',
    'order_status_rejected' => 'd6cf5606-1b70-43fe-8836-e25d4a2513d2',
    'order_status_unknown' => 'ca655eb7-4ef3-11ea-81d3-b06ebfbfb012',

    'user_session_code_types_block_unlock_account' => '046a9be1-1948-4c1a-bb80-76eab17c95ed',
    'user_session_code_types_order_card' => 'f3a0aee9-2613-11ea-b9d3-309c2326bc93',

    'user_session_code_channel_sms' => 'f7113c9d-9605-45fa-960a-4e765fcedf53',
    'user_session_code_channel_email' => '4becd547-c06f-4932-967d-77e22cf0ccfb',
    'user_session_code_channel_push' => '1029e41b-685a-449b-851f-b7041ad4b386',
    'default_merchant_id' => '790eec57-296a-4100-9404-85fffbc7c638',
    'default_merchant_user_id' => 'accf0847-74b8-4db7-b9de-73d1cac95553',
    'default_contact_center_user_id' => '38e42916-2b29-4013-9309-b7e999d7e679',
    //'default_merchant_category_type' => '231c725c-d6cb-4188-8ff0-6a1fe9506c71',

    'default_merchant_category_id' => '813e67b2-1fdf-11ea-87d1-309c2326bc93',
    'merchant_popular_category_id' => '74a8e1c7-6510-11ea-807d-309c2326bc93',
    
    'transaction_sync_abs_purpose_text' => '{category}. Плательщик {fio}, получатель {service}, сумма {amount} {currency}, дата {date}. Данная операция не связана с осуществлением предпринимательской деятельности. {purpose}',

    'proc_user' => env('PROC_USER', "'tester'@'%'"),
    'proc_user_password' => env('PROC_USER_PASSWORD', "password"),
    
    'cache_minutes' => env('CACHE_MINUTES', 30),
    'widgets_days' => env('WIDGETS_DAYS', 3),
    
    'contact_center_email' => env('CONTACT_CENTER_EMAIL', 'td.brainiac@gmail.com'),
    
    'merchant_last_withdraw_interval' => env('MERCHANT_LAST_WITHDRAW_INTERVAL', '10'),

    'HAS_FAILED_TRANSACTIONS_TEXT' => 'У мерчанта имеется незавершённая транзакция. Нужно исправить эту транзакцию и повторить попытку вывода средств',
    'HAS_FAILED_WITHDRAW_TEXT' => 'Предыдущий запрос по выводу средств не был завершён успешно. Нужно исправить эту транзакцию и повторить попытку вывода средств',
    'HAS_FAILED_CREATE_WITHDRAW_TEXT' => 'Текущий запрос по выводу средств не был завершён успешно. Проблема может возникать из-за сединения или неправильных передаваемых данных. Нужно исправить эту ситуацию и повторить попытку вывода средств',
    'HAS_WAIT_FOR_COMPLETE_WITHDRAW_TEXT' => 'Предыдущий запрос по выводу средств в процессе обработки. Повторите потытку позже',
    'HAS_SUCCESS_WITHDRAW_TEXT' => 'Вывод средств произведен успешно',
    'NOT_NEED_TO_WITHDRAW_TEXT' => 'У мерчанта за выбранный период не имеется транзакций для произведения операции вывод средств',

    'transaction_sync_delay_minutes' => env('TRANSACTION_SYNC_DELAY_MINUTES', 20),

    'remote_indentification_requred_check_nalog' => true,

    'job_log_select_max_rows_for_dwh' => env('JOB_LOG_SELECT_MAX_ROWS_FOR_DWH'), //
    'user_history_select_max_rows_for_dwh' => env('USER_HISTORY_SELECT_MAX_ROWS_FOR_DWH'), //
    'transaction_history_select_max_rows_for_dwh' => env('TRANSACTION_HISTORY_SELECT_MAX_ROWS_FOR_DWH'), //
    'reports_select_limit' => env('REPORTS_SELECT_LIMIT',2500), //

];
