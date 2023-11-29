<?php

use App\Models\OrderCardType\OrderCardType;
use App\Services\Common\Helpers\Currency;
use App\Services\Common\Helpers\OrderCardContractTypes;
use Illuminate\Database\Seeder;

class OrderCardTypesTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => 'a7c6ed06-d99a-4b7e-bca3-77bd3d56b583',
                'code' => 'VG_CHIP_DUAL_BankAgent_USD_1y',
                'code_map' => '12325627420',
                'name' => 'Visa Gold', // (доллар) - 1 года',
                'price' => '150',
                'insurance_price' => '1000',
                'code_ibank' => '2',
                'year' => '1',
                'icon' => 'card_visagold',
                'position' => '1',
                'is_active' => '1',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>карта Visa Gold?",
                            "description" => "Элитная карта Visa Gold принадлежит к сегменту премиальных карт платежной системы Visa.",
                            "img" => "all_card_visagold.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно платить<br>картой Visa Gold?",
                            "description" => "Карты Visa Gold в отличии от Classic имеет дополнительные скидки и привилегии в таких сферах, как путешествия, прокат автомобилей, покупки эксклюзивных товаров и услуг.",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>карту Visa Gold?",
                            "description" => "Пополнить карту можно с платежных терминалов и с мобильного банка. А управление картой и его баланс доступны и на мобильном банке \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::USD,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_USD,
            ],
            [
                'id' => '2cef938b-9be9-43fc-bdde-bcf7bced98b5',
                'code' => 'VG_CHIP_DUAL_BankAgent_USD_2y',
                'code_map' => '10277016658',
                'name' => 'Visa Gold', // (доллар) - 2 года',
                'price' => '200',
                'insurance_price' => '1000',
                'code_ibank' => '2',
                'year' => '2',
                'icon' => 'card_visagold',
                'position' => '2',
                'is_active' => '1',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>карта Visa Gold?",
                            "description" => "Элитная карта Visa Gold принадлежит к сегменту премиальных карт платежной системы Visa.",
                            "img" => "all_card_visagold.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно платить<br>картой Visa Gold?",
                            "description" => "Карты Visa Gold в отличии от Classic имеет дополнительные скидки и привилегии в таких сферах, как путешествия, прокат автомобилей, покупки эксклюзивных товаров и услуг.",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>карту Visa Gold?",
                            "description" => "Пополнить карту можно с платежных терминалов и с мобильного банка. А управление картой и его баланс доступны и на мобильном банке \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::USD,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_USD,
            ],
            [
                'id' => '3b51d2c2-1a9c-4835-9e23-afda330a0a62',
                'code' => 'VC_CHIP_DUAL_BankAgent_USD_1y',
                'code_map' => '12325627522',
                'name' => 'Visa Classic', // (доллар) - 1 года',
                'price' => '80',
                'insurance_price' => '0',
                'code_ibank' => '1',
                'year' => '1',
                'icon' => 'card_visaclassic',
                'position' => '3',
                'is_active' => '1',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>карта Visa Classic?",
                            "description" => "Visa Classic – это классическая карта международной платежной системы Visa. Карта отличается прекрасным соотношением цены и качества, что делает ее одной из самых популярных карт во всем мире.",
                            "img" => "all_card_visaclassic.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно платить<br>картой Visa Classic?",
                            "description" => "Карта со стандартным набором функций. Сюда входят платежи в большинстве торговых точек, принимающих карты, бронирование различных товаров и услуг в Интернете и многое другое.",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>карту Visa Classic?",
                            "description" => "Пополнить карту можно с платежных терминалов и с мобильного банка. А управление картой и его баланс доступны и на мобильном банке \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::USD,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_USD,
            ],
            [
                'id' => '1b0e58e9-a9f4-4821-b560-c4695bac08d6',
                'code' => 'VC_CHIP_DUAL_BankAgent_USD_2y',
                'code_map' => '10277016715',
                'name' => 'Visa Classic', // (доллар) - 2 года',
                'price' => '100',
                'insurance_price' => '0',
                'code_ibank' => '1',
                'year' => '2',
                'icon' => 'card_visaclassic',
                'position' => '4',
                'is_active' => '1',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>карта Visa Classic?",
                            "description" => "Visa Classic – это классическая карта международной платежной системы Visa. Карта отличается прекрасным соотношением цены и качества, что делает ее одной из самых популярных карт во всем мире.",
                            "img" => "all_card_visaclassic.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно платить<br>картой Visa Classic?",
                            "description" => "Карта со стандартным набором функций. Сюда входят платежи в большинстве торговых точек, принимающих карты, бронирование различных товаров и услуг в Интернете и многое другое.",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>карту Visa Classic?",
                            "description" => "Пополнить карту можно с платежных терминалов и с мобильного банка. А управление картой и его баланс доступны и на мобильном банке \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::USD,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_USD,
            ],
            [
                'id' => '7ea6587d-a87a-4c57-8a2f-740064fd6a02',
                'code' => 'Local_Cards_TJS_1y',
                'code_map' => '339458958',
                'name' => 'Локальная карта', // именная (сомони) - 1 год',
                'price' => '20',
                'insurance_price' => '0',
                'code_ibank' => '7',
                'year' => '1',
                'icon' => 'card_local',
                'position' => '5',
                'is_active' => '1',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>локальная карта?",
                            "description" => "Удобные и доступные карты для совершения операций в платежной системе банка.",
                            "img" => "all_card_local.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно платить<br>локальной картой?",
                            "description" => "Оплатить услугу/товары можно в ПОС-терминалах банка. А еще карту можно привязать к мобильном банку \"Эсхата Онлайн\" и оплатить все доступные услуги.",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>локальную карту?",
                            "description" => "Пополнить карту можно с платежных терминалов и с мобильного банка. А управление картой и его баланс доступны и на мобильном банке \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::TJS,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_TJS,
            ],
            [
                'id' => 'e54c0764-5752-4aca-98e3-09b543494a44',
                'code' => 'Local_Cards_TJS_2y',
                'code_map' => '339458913',
                'name' => 'Локальная карта', // именная (сомони) - 2 года',
                'price' => '25',
                'insurance_price' => '0',
                'code_ibank' => '7',
                'year' => '2',
                'icon' => 'card_local',
                'position' => '6',
                'is_active' => '1',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>локальная карта?",
                            "description" => "Удобные и доступные карты для совершения операций в платежной системе банка.",
                            "img" => "all_card_local.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно платить<br>локальной картой?",
                            "description" => "Оплатить услугу/товары можно в ПОС-терминалах банка. А еще карту можно привязать к мобильном банку \"Эсхата Онлайн\" и оплатить все доступные услуги.",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>локальную карту?",
                            "description" => "Пополнить карту можно с платежных терминалов и с мобильного банка. А управление картой и его баланс доступны и на мобильном банке \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::TJS,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_TJS,
            ],
            [
                'id' => '99edad97-dab1-4a06-b2e4-4023c804bc06',
                'code' => 'Local_Cards_TJS_3y',
                'code_map' => '339458868',
                'name' => 'Локальная карта', // именная(сомони) - 3 года',
                'price' => '30',
                'insurance_price' => '0',
                'code_ibank' => '7',
                'year' => '3',
                'icon' => 'card_local',
                'position' => '7',
                'is_active' => '1',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>локальная карта?",
                            "description" => "Удобные и доступные карты для совершения операций в платежной системе банка.",
                            "img" => "all_card_local.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно платить<br>локальной картой?",
                            "description" => "Оплатить услугу/товары можно в ПОС-терминалах банка. А еще карту можно привязать к мобильном банку \"Эсхата Онлайн\" и оплатить все доступные услуги.",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>локальную карту?",
                            "description" => "Пополнить карту можно с платежных терминалов и с мобильного банка. А управление картой и его баланс доступны и на мобильном банке \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::TJS,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_TJS,
            ],
            [
                'id' => 'ab1bc7ec-a770-4065-a692-8c9afabcfaef',
                'code' => 'Local_Cards_DP_Non_pers_TJS_18m',
                'code_map' => '19382949296',
                'name' => 'Карта "Ягона"', // (сомони) -  1,5 года',
                'price' => '20',
                'insurance_price' => '0',
                'code_ibank' => '7',
                'year' => '1.5',
                'icon' => 'card_local',
                'position' => '8',
                'is_active' => '0',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>карта Ягона?",
                            "description" => "Удобные и доступные карты для совершения операций в платежной системе банка.",
                            "img" => "all_card_local.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно платить<br>карта Ягона?",
                            "description" => "Оплатить услугу/товары можно в ПОС-терминалах банка. А еще карту можно привязать к мобильном банку \"Эсхата Онлайн\" и оплатить все доступные услуги.",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>карта Ягона?",
                            "description" => "Пополнить карту можно с платежных терминалов и с мобильного банка. А управление картой и его баланс доступны и на мобильном банке \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::TJS,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_TJS,
            ],
            [
                'id' => '94cb687b-2ad1-4e19-a3d0-acb230eaf7e5',
                'code' => 'Local_Cards_TJS_2y_D3',
                'code_map' => '10277017380',
                'name' => 'Локальная карта именная (сомони) - Дизайн от клиента',
                'price' => '40',
                'insurance_price' => '0',
                'code_ibank' => '7',
                'icon' => 'card_local',
                'year' => '2',
                'position' => '9',
                'is_active' => '0',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>локальная карта?",
                            "description" => "Удобные и доступные карты для совершения операций в платежной системе банка.",
                            "img" => "all_card_local.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно платить<br>локальной картой?",
                            "description" => "Оплатить услугу/товары можно в ПОС-терминалах банка. А еще карту можно привязать к мобильном банку \"Эсхата Онлайн\" и оплатить все доступные услуги.",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>локальную карту?",
                            "description" => "Пополнить карту можно с платежных терминалов и с мобильного банка. А управление картой и его баланс доступны и на мобильном банке \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::TJS,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_TJS,
            ],
            [
                'id' => 'e7257ec6-0f40-418d-8947-358414d20840',
                'code' => 'UPI_CHIP_DUAL_Gold_USD_3y',
                'code_map' => '12323663535',
                'name' => 'UnionPay Gold', //  (сомони) - 3 года',
                'price' => '100',
                'insurance_price' => '0',
                'code_ibank' => '11',
                'year' => '3',
                'icon' => 'card_unionpay',
                'position' => '10',
                'is_active' => '1',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>карта UnionPay Gold?",
                            "description" => "Это универсальный платежный инструмент, который принимается во всем мире, в любых точках, обозначенных логотипом UnionPay.",
                            "img" => "all_card_unionpay.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно платить<br>картой UnionPay Gold?",
                            "description" => "Эти карты незаменимы для любителей путешествовать. Карты платежной системы China UnionPay (CUP) обслуживаются более чем в 150 странах мира.",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>карту UnionPay Gold?",
                            "description" => "Пополнить карту можно с платежных терминалов и с мобильного банка. А управление картой и его баланс доступны и на мобильном банке \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::USD,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_TJS,
            ],
            [
                'id' => '921b9fb3-7ae4-4e18-890d-3665516600cd',
                'code' => 'UPI_CHIP_DUAL_Classic_USD_3y',
                'code_map' => '12323663491',
                'name' => 'UnionPay Classic', // (сомони) - 3 года',
                'price' => '50',
                'insurance_price' => '0',
                'code_ibank' => '10',
                'year' => '3',
                'position' => '11',
                'is_active' => '1',
                'icon' => 'card_unionpay',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>карта UnionPay Classic?",
                            "description" => "Это универсальный платежный инструмент, который принимается во всем мире, в любых точках, обозначенных логотипом UnionPay.",
                            "img" => "all_card_unionpay.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно платить<br>картой UnionPay Classic?",
                            "description" => "Эти карты незаменимы для любителей путешествовать. Карты платежной системы China UnionPay (CUP) обслуживаются более чем в 150 странах мира.",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>карту UnionPay Classic?",
                            "description" => "Пополнить карту можно с платежных терминалов и с мобильного банка. А управление картой и его баланс доступны и на мобильном банке \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::USD,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_TJS,
            ],
            [
                'id' => 'd531e9f7-beff-4f80-86f2-1f2fdaf45d38',
                'code' => 'Local_Cards_TJS_2y_D2',
                'code_map' => '7646258298',
                'name' => 'Локальная карта именная (сомони) - Дизайн из списка банка',
                'price' => '60',
                'insurance_price' => '0',
                'code_ibank' => '7',
                'icon' => 'card_local',
                'position' => '12',
                'is_active' => '0',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>локальная карта?",
                            "description" => "Удобные и доступные карты для совершения операций в платежной системе банка.",
                            "img" => "all_card_local.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно платить<br>локальной картой?",
                            "description" => "Оплатить услугу/товары можно в ПОС-терминалах банка. А еще карту можно привязать к мобильном банку \"Эсхата Онлайн\" и оплатить все доступные услуги.",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>локальную карту?",
                            "description" => "Пополнить карту можно с платежных терминалов и с мобильного банка. А управление картой и его баланс доступны и на мобильном банке \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::TJS,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_TJS,
            ],
            [
                'id' => '092c3a0d-382a-4aab-a62e-d707f461d483',
                'code' => 'Local_Cards_Non_pers_TJS_18m',
                'code_map' => '19382949251',
                'name' => 'Карта не персонифицированная', // (сомони) -  1,5 года',
                'price' => '30',
                'insurance_price' => '0',
                'code_ibank' => '7',
                'icon' => 'card_local',
                'year' => '1.5',
                'position' => '13',
                'is_active' => '0',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>локальная карта?",
                            "description" => "Удобные и доступные карты для совершения операций в платежной системе банка.",
                            "img" => "all_card_local.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно платить<br>локальной картой?",
                            "description" => "Оплатить услугу/товары можно в ПОС-терминалах банка. А еще карту можно привязать к мобильном банку \"Эсхата Онлайн\" и оплатить все доступные услуги.",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>локальную карту?",
                            "description" => "Пополнить карту можно с платежных терминалов и с мобильного банка. А управление картой и его баланс доступны и на мобильном банке \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::TJS,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_TJS,
            ],
            [
                'id' => '0b7870aa-0888-11eb-99d1-005056a37d1d',
                'code' => 'Korti_Milli_TJS_3y',
                'code_map' => '22429529790',
                'name' => 'Корти Милли', // (сомони) -  1,5 года',
                'price' => '10',
                'insurance_price' => '0',
                'code_ibank' => '13',
                'icon' => 'card_kortimilly',
                'year' => '3',
                'position' => '14',
                'is_active' => '0',
                'html_params_json' => [
                    "spa_info_blocks" => [
                        "about_card" => [
                            "title" => "Что такое<br>\"Корти Милли\"?",
                            "description" => "\"Корти Милли\" от Банка Эсхата - широкая доступность к безналичной оплате и снятию наличных средств!",
                            "img" => "all_card_kortimilly.png",
                        ],
                        "how_to_pay" => [
                            "title" => "Где можно произвести оплату с картой<br>\"Корти Милли\"?",
                            "description" => "Оплатить товары и услуги можно во всех точках приёма карт \"Корти милли\". Также, \"Корти милли\" можно добавить в мобильном приложении \"Эсхата Онлайн\" и оплачивать товары и услуги 24/7. ",
                            "img" => "card_pay.png",
                        ],
                        "how_to_fill" => [
                            "title" => "Как пополнить<br>\"Корти Милли?\"",
                            "description" => "Пополнить карту можно в кассах Банка Эсхата, через платежные терминалы и мобильное приложение \"Эсхата Онлайн\".",
                            "img" => "card_fill.png",
                        ],
                    ],
                ],
                'currency_id' => Currency::TJS,
                'order_card_contract_type_id' => OrderCardContractTypes::SBER_TJS,
            ],
        ];

        foreach ($vars as $var) {
            try {
                OrderCardType::create($var);
                //TransactionSyncRule::create($var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
