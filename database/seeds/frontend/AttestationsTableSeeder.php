<?php

use App\Models\User\Attestation\Attestation;
use Illuminate\Database\Seeder;

class AttestationsTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $attestations = [
            [
                'id' => config('app_settings.default_attestation_id'),
                'code' => 'NOT_IDENTIFIED',
                'name' => 'Неидентифицированный',
                'params_json' => [
                    'day' => [
                        'limit'=>'2900'
                    ],
                    'week' => [
                        'limit'=>'2900'
                    ],
                    'month' => [
                        'limit'=>'2900'
                    ],
                    'balance' => [
                        'limit'=>'1160'
                    ],
                ],

                'info_params_json' =>
                    [
                        "name" => "Неидентифицированный",
                        'title' => 'Базовые возможности оплаты',
                        'icon' => 'noid_disable.png',
                        "code" => "NOT_IDENTIFIED",
                        "is_active" => false,
                        "header" => [
                            [
                                "title" => "Максимальная сумма в кошельке",
                                "content" => "{{BALANCE_LIMIT}} сомони"
                            ],
                            [
                                "title" => "Сумма платежей в месяц",
                                "content" => "{{MONTH_LIMIT}} сомони"
                            ]
                        ],
                        "body" => [
                            
                            [
                                "title" => "Возможность оплаты ЖКХ, Интернет и других услуг",
                                "available" => true
                            ],
                            [
                                "title" => "Оплата товаров и услуг по QR-коду",
                                "available" => true
                            ],
                            [
                                "title" => "Заказ карты онлайн из приложения",
                                "available" => false
                            ],
                            [
                                "title" => "Перевод денег на кошельки, счета и карты банков РТ",
                                "available" => false
                            ],
                            [
                                "title" => "Получение переводов из России и Казахстана",
                                "available" => false
                            ],
                            [
                                "title" => "Перевод и снятие наличных денег",
                                "available" => false
                            ],
                            [
                                "title" => "Продажа и покупка валют",
                                "available" => false
                            ],
                            [
                                "title" => "Управление и информация о вкладах и кредитах",
                                "available" => false
                            ],
    
                        ],
                        "footer" => [
                            [
                                "type" => "{{ELEMENT_TYPE}}", // button | lable
                                "title" => "{{ELEMENT_TEXT}}", // Ваша заявка на рассмотрении
                                "action" => "{{ELEMENT_ACTION}}" // GET_THIS_ATTESTATION | INCREASE_LIMITS | FIND_BRANCH_IN_MAP
                            ]
                        ]
                    ],
            ],
            [
                'id' => 'cf8d53eb-a078-11e8-904b-b06ebfbfa715',
                'code' => 'IDENTIFIED',
                'name' => 'Идентифицированный',
                'params_json' => [
                    'day' => [
                        'limit'=>'100000'
                    ],
                    'week' => [
                        'limit'=>'100000'
                    ],
                    'month' => [
                        'limit'=>'100000'
                    ],
                    'balance' => [
                        'limit'=>'100000'
                    ],
                ],
                'info_params_json' => [
                    "name" => "Идентифицированный",
                    'title' => 'Максимальный функционал',
                    'icon' => 'id_disable.png',
                    "code" => "IDENTIFIED",
                    "is_active" => false,
                    "header" => [
                        [
                            "title" => "Максимальная сумма в кошельке",
                            "content" => "{{BALANCE_LIMIT}} сомони"
                        ],
                        [
                            "title" => "Сумма платежей в месяц",
                            "content" => "{{MONTH_LIMIT}} сомони"
                        ]
                    ],
                    "body" => [
                        [
                            "title" => "Возможность оплаты ЖКХ, Интернет и других услуг",
                            "available" => true
                        ],
                        [
                            "title" => "Оплата товаров и услуг по QR-коду",
                            "available" => true
                        ],
                        [
                            "title" => "Заказ карты онлайн из приложения",
                            "available" => true
                        ],
                        [
                            "title" => "Перевод денег на кошельки, счета и карты банков РТ",
                            "available" => true
                        ],
                        [
                            "title" => "Получение переводов из России и Казахстана",
                            "available" => true
                        ],
                        [
                            "title" => "Перевод и снятие наличных денег",
                            "available" => true
                        ],
                        [
                            "title" => "Продажа и покупка валют",
                            "available" => true
                        ],
                        [
                            "title" => "Управление и информация о вкладах и кредитах",
                            "available" => true
                        ],

                    ],
                    "footer" => [
                        [
                            "type" => "{{ELEMENT_TYPE}}", // button | lable
                            "title" => "{{ELEMENT_TEXT}}", // Ваша заявка на рассмотрении
                            "action" => "{{ELEMENT_ACTION}}" // GET_THIS_ATTESTATION | INCREASE_LIMITS | FIND_BRANCH_IN_MAP
                        ]
                    ]
                ]
            ],
            [
                'id' => config('app_settings.legal_entity_attestation_id'),
                'code' => 'LEGAL_ENTITY',
                'name' => 'Юридическое лицо',
                'params_json' => [
                    'day' => [
                        'limit'=>'500000'
                    ],
                    'week' => [
                        'limit'=>'500000'
                    ],
                    'month' => [
                        'limit'=>'500000'
                    ],
                    'balance' => [
                        'limit'=>'101500'
                    ],
                ]
            ],
            [
                'id' => config('app_settings.personalized_attestation_id'),
                'code' => 'PERSONALIZED',
                'name' => 'Персональный',
                'params_json' => [
                    'day' => [
                        'limit'=>'11600'
                    ],
                    'week' => [
                        'limit'=>'11600'
                    ],
                    'month' => [
                        'limit'=>'11600'
                    ],
                    'balance' => [
                        'limit'=>'4640'
                    ],
                ],
                'info_params_json' => [

                    "name" => "Персональный",
                    'title' => 'Расширенные лимиты',
                    'icon' => 'personal_disable.png',
                    "code" => "PERSONALIZED",
                    "is_active" => true,

                    "header" => [
                        [
                            "title" => "Максимальная сумма в кошельке",
                            "content" => "{{BALANCE_LIMIT}} сомони"
                        ],
                        [
                            "title" => "Сумма платежей в месяц",
                            "content" => "{{MONTH_LIMIT}} сомони"
                        ]
                    ],
                    "body" => [
                        [
                            "title" => "Возможность оплаты ЖКХ, Интернет и других услуг",
                            "available" => true
                        ],
                        [
                            "title" => "Оплата товаров и услуг по QR-коду",
                            "available" => true
                        ],
                        [
                            "title" => "Заказ карты онлайн из приложения",
                            "available" => true
                        ],
                        [
                            "title" => "Перевод денег на кошельки, счета и карты банков РТ",
                            "available" => true
                        ],
                        [
                            "title" => "Получение переводов из России и Казахстана",
                            "available" => true
                        ],
                        [
                            "title" => "Перевод и снятие наличных денег",
                            "available" => true
                        ],
                        [
                            "title" => "Продажа и покупка валют",
                            "available" => false
                        ],
                        [
                            "title" => "Управление и информация о вкладах и кредитах",
                            "available" => false
                        ],

                    ],
                    "footer" => [
                        [
                            "type" => "{{ELEMENT_TYPE}}", // button | lable
                            "title" => "{{ELEMENT_TEXT}}", // Ваша заявка на рассмотрении
                            "action" => "{{ELEMENT_ACTION}}" // GET_THIS_ATTESTATION | INCREASE_LIMITS | FIND_BRANCH_IN_MAP
                        ]
                    ]



                ],
            ],

        ];

        foreach ($attestations as $attestation) {
            try {
                Attestation::create($attestation);
                //Attestation::updateOrCreate(['id' => $attestation['id']], $attestation);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
