<?php

return[
    "merchant_item_id"=> "",
    "login"=>"",
    "key"=> "",
    "host"=> "https://online.eskhata.tj:1444/api/v2.3",
    "version"=> "1.0",
    "check_payment"=>[
        "request_timeout_seconds"=> 10,
        "request_interval_seconds"=> 5,
        "process_timeout_seconds"=> 50,
        "loop_count"=> 15
    ],
    "confirm"=>[
        "request_timeout_seconds"=> 20,
        "request_interval_seconds"=> 6,
        "process_timeout_seconds"=> 50,
        "loop_count"=> 15
    ],
    "cancel"=>[
        "request_timeout_seconds"=> 20,
        "request_interval_seconds"=> 6,
        "process_timeout_seconds"=> 50,
        "loop_count"=> 15
    ],
    "show_window_timeout_seconds"=> 5,
    "is_info_logging_enabled"=> 1,
    "printer"=> [
        "is_print_enabled"=> true,
        "driver" => "AddIn.FPrnM45",
        "space" => 6,
        "model"=> 24,
        "port_number"=> 1,
        "baud_rate"=> 115200,
        "password"=> 30,
        "template"=> [
            "client_text"=> [
                "        ЗАО \"Шивер Таджикистан\"        ",
                "---------------------------------------",
                "ш.  Душанбе, куч. Дустии халкхо 47",
                "Тел: 488884000",
                "Касса: Касса №1",
                "---------------------------------------",
                "Дата         : __DATETIME__",
                "Плательщик   : __CLIENT_ACCOUNT__",
                "Номер сессии : __PAYMENT_NUMBER__",
                "Оплачено     : __AMOUNT__ __CURRENCY__",
                "---------------------------------------",
                "           СПАСИБО ЗА ПОКУПКУ,         ",
                "             СОХРАНЯЙТЕ ЧЕК            ",
                "************* Для клиента *************",
                "ОАО \"Банк Эсхата\"",
                "Тел.: 808"
            ],
            "cashier_text"=> [
                "        ЗАО \"Шивер Таджикистан\"        ",
                "---------------------------------------",
                "ш.  Душанбе, куч. Дустии халкхо 47",
                "Тел: 488884000",
                "Касса: Касса №1",
                "---------------------------------------",
                "Дата         : __DATETIME__",
                "Плательщик   : __CLIENT_ACCOUNT__",
                "Номер сессии : __PAYMENT_NUMBER__",
                "Оплачено     : __AMOUNT__ __CURRENCY__",
                "---------------------------------------",
                "           СПАСИБО ЗА ПОКУПКУ,         ",
                "             СОХРАНЯЙТЕ ЧЕК            ",
                "************* Для кассира *************",
                "ОАО \"Банк Эсхата\"",
                "Тел.: 808"
            ],
        ]
    ]
];
