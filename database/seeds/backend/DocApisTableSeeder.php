<?php

use App\Models\DocApi\DocApi;
use Illuminate\Database\Seeder;

class DocApisTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $items = [
            [
                'id' => '2d50763d-3042-11e9-96f3-b06ebfbfa715',
                'name' => '0.1 Общий пример формата запроса и ответа',
                'url_path' => '/api/v1/example111',
                'method' => 'GET',
                'params' => 'При возвращении ответа из сервера, в случае возврата контента в формате <b>json</b> в верхней иерархии могут содержаться только указанные ветки:

                <b>code</b>	- указывается код ответа в формате Целого числа (Integer)
                <b>message</b> - указывается сообщение относящееся к коду ответа (code) в формате Текста (String)
                <b>data</b> - указывается основной контент относящийся к бизнес логике приложения, которая может содержать данные в форматах Коллекции (Array[]), Объекта (JSON-object{}), Текста (String), Целого числа (Integer), Дробного числа (Double) и Логические (Tiny_Int(0,1))
                <b>meta</b> - указываются системные данные (meta parameters), значения которых могут быть применены приложением для валидации, ожидания определённого времени и другие данные которые необходимы для корректного функционирования приложения. Так же как и data может содержать в себе данные в форматах Коллекции (Array[]), Объекта (JSON-object{}), Текста (String), Целого числа (Integer), Дробного числа (Double) и Логические (Tiny_Int(0,1))
                <b>pagination</b> - указываются данные для организации пагинации (нумерации страниц). Более подробно описано в разделе Коллекция с пагинацией
                ',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "Успешно",
                    "data" => "",
                    "meta" => "",
                    "pagination" => "",
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '1',
                'doc_api_category_id' => 'e1c5b222-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '21fa4d87-3042-11e9-96f3-b06ebfbfa715',
                'name' => '0.1 Общий пример формата запроса и ответа',
                'url_path' => '/api/v2/example222',
                'method' => 'GET',
                'params' => 'При dвозвращении ответа из сервера, в случае возврата контента в формате <b>json</b> в верхней иерархии могут содержаться только указанные ветки:

                <b>code</b>	- указывается код ответа в формате Целого числа (Integer)
                <b>message</b> - указывается сообщение относящееся к коду ответа (code) в формате Текста (String)
                <b>data</b> - указывается основной контент относящийся к бизнес логике приложения, которая может содержать данные в форматах Коллекции (Array[]), Объекта (JSON-object{}), Текста (String), Целого числа (Integer), Дробного числа (Double) и Логические (Tiny_Int(0,1))
                <b>meta</b> - указываются системные данные (meta parameters), значения которых могут быть применены приложением для валидации, ожидания определённого времени и другие данные которые необходимы для корректного функционирования приложения. Так же как и data может содержать в себе данные в форматах Коллекции (Array[]), Объекта (JSON-object{}), Текста (String), Целого числа (Integer), Дробного числа (Double) и Логические (Tiny_Int(0,1))
                <b>pagination</b> - указываются данные для организации пагинации (нумерации страниц). Более подробно описано в разделе Коллекция с пагинацией
                ',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "Успешно",
                    "data" => "",
                    "meta" => "",
                    "pagination" => "",
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '1',
                'doc_api_category_id' => 'e1c5b222-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '7ff86de9-304a-11e9-96f3-b06ebfbfa715',
                'name' => '0.2 Коллекция',
                'url_path' => '/api/v1/example_collection',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "",
                    "data" => [
                        [
                            "id" => 1,
                            "name" => "Eladio Schroeder Sr.",
                            "email" => "therese28@example.com",
                            "roles" => [
                                "id" => "bb435e",
                                "name" => "Администратор",
                            ],
                        ],
                        [
                            "id" => 1,
                            "name" => "Eladio Schroeder Sr.",
                            "email" => "therese28@example.com",
                            "roles" => [
                                "id" => "bb435e",
                                "name" => "Администратор",
                            ],
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '2',
                'doc_api_category_id' => 'e1c5b222-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '52a0e9fc-311f-11e9-96f3-b06ebfbfa715',
                'name' => '0.3 Коллекция с пагинацией',
                'url_path' => '/api/v1/example_collection?page=1',
                'method' => 'GET',
                'params' => '<b>page</b> - Number',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "",
                    "data" => [
                        [
                            "id" => 1,
                            "name" => "Eladio Schroeder Sr.",
                            "email" => "therese28@example.com",
                            "roles" => [
                                "id" => "bb435e",
                                "name" => "Администратор",
                            ],
                        ],
                        [
                            "id" => 1,
                            "name" => "Eladio Schroeder Sr.",
                            "email" => "therese28@example.com",
                            "roles" => [
                                "id" => "bb435e",
                                "name" => "Администратор",
                            ],
                        ],
                    ],
                    "pagination" => [
                        "current_page" => 1,
                        "last_page" => 2,
                        "per_page" => 10,
                        "total" => 11,
                        "first_item" => 1,
                        "last_item" => 10,
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '3',
                'doc_api_category_id' => 'e1c5b222-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'fe91719d-3122-11e9-96f3-b06ebfbfa715',
                'name' => '0.4 Фильтрация',
                'url_path' => '/api/v1/example_collection?page=1&name=Eladio&email=therese28%40example.com',
                'method' => 'GET',
                'params' => '<b>page</b> - Number
                <b>name</b> - String
                <b>email</b> - String',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "",
                    "data" => [
                        [
                            "id" => 1,
                            "name" => "Eladio Schroeder Sr.",
                            "email" => "therese28@example.com",
                            "roles" => [
                                "id" => "bb435e",
                                "name" => "Администратор",
                            ],
                        ],
                        [
                            "id" => 1,
                            "name" => "Eladio Schroeder Sr.",
                            "email" => "therese28@example.com",
                            "roles" => [
                                "id" => "bb435e",
                                "name" => "Администратор",
                            ],
                        ],
                    ],
                    "pagination" => [
                        "current_page" => 1,
                        "last_page" => 2,
                        "per_page" => 10,
                        "total" => 11,
                        "first_item" => 1,
                        "last_item" => 10,
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '4',
                'doc_api_category_id' => 'e1c5b222-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '54993d96-3334-11e9-96f3-b06ebfbfa715',
                'name' => '0.5 Ошибка',
                'url_path' => '/api/v1/examples_errors',
                'method' => 'POST',
                'params' => '
                <b>test</b> - String
                ',
                'response_success_json' => '',
                'response_reject_json' => [
                    "code" => 7,
                    "message" => "Срок токена истек!",
                ],
                'version' => '1',
                'group' => '5',
                'doc_api_category_id' => 'e1c5b222-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '04cf0e39-3335-11e9-96f3-b06ebfbfa715',
                'name' => '0.6 Ошибка при валидации',
                'url_path' => '/api/v1/examples_errors_validation',
                'method' => 'POST',
                'params' => '
                <b>name</b> - String
                ',
                'response_success_json' => '',
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Некоторые поля заполнены не верно!",
                    "meta" => [
                        "contractor_id" => [
                            "Поле contractor id может содержать только буквы, цифры и дефис.",
                        ],
                        "store_id" => [
                            "Поле store id обязательно для заполнения.",
                        ],
                        "items" => [
                            "Поле items обязательно для заполнения.",
                        ],
                    ],
                ],
                'version' => '1',
                'group' => '6',
                'doc_api_category_id' => 'e1c5b222-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'cca78ab0-3336-11e9-96f3-b06ebfbfa715',
                'name' => '0.7 Создать (Create)',
                'url_path' => '/api/v1/examples_crud',
                'method' => 'POST',
                'params' => '
                <b>name</b> - String
                <b>email</b> - String
                ',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "Example успешно создан",
                    "data" => [
                        "id" => 1,
                        "name" => "Eladio Schroeder Sr.",
                        "email" => "therese28@example.com",
                        "roles" => [
                            "id" => "bb435e",
                            "name" => "Администратор",
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '7',
                'doc_api_category_id' => 'e1c5b222-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '76235d60-3337-11e9-96f3-b06ebfbfa715',
                'name' => '0.8 Прочитать (Read)',
                'url_path' => '/api/v1/examples_crud/id',
                'method' => 'GET',
                'params' => '
                <b>id</b> - UUID
                ',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "Example успешно создан",
                    "data" => [
                        "id" => 1,
                        "name" => "Eladio Schroeder Sr.",
                        "email" => "therese28@example.com",
                        "roles" => [
                            "id" => "bb435e",
                            "name" => "Администратор",
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '8',
                'doc_api_category_id' => 'e1c5b222-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '066ae5b6-3338-11e9-96f3-b06ebfbfa715',
                'name' => '0.9 Изменить (Update)',
                'url_path' => '/api/v1/examples_crud/id',
                'method' => 'PUT',
                'params' => '
                <b>id</b> - UUID
                <b>name</b> - String
                <b>email</b> - String
                ',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "Example успешно создан",
                    "data" => [
                        "id" => 1,
                        "name" => "Eladio Schroeder Sr.",
                        "email" => "therese28@example.com",
                        "roles" => [
                            "id" => "bb435e",
                            "name" => "Администратор",
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '9',
                'doc_api_category_id' => 'e1c5b222-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '11d6714f-3338-11e9-96f3-b06ebfbfa715',
                'name' => '0.10 Удаление (Delete)',
                'url_path' => '/api/v1/examples_crud/id',
                'method' => 'DELETE',
                'params' => '
                <b>id</b> - UUID
                ',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "Example успешно удалён",
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '10',
                'doc_api_category_id' => 'e1c5b222-2f7f-11e9-96f3-b06ebfbfa715',
            ],

            [
                'id' => '1724791e-3339-11e9-96f3-b06ebfbfa715',
                'name' => '1.1 Запрос при первоначальном запуске приложения',
                'url_path' => '/api/v1/auth/hello',
                'method' => 'POST',
                'params' => 'При первоначальном запросе передаётся временный токен <b>temporary_token</b>, который будет использоваться до получения основного токена <b>access_token</b>.

                <b>device[id]</b> - {1724791e-3339-11e9-96f3-b06ebfbfa715} - DeviceUUID - string(30) - regex:/^[A-Za-z0-9-]*$/
                <b>device[name]</b> - {Samsung G803T} - DeviceName - string(30) - regex:/^[A-Za-z0-9- ]*$/
                <b>device[model]</b> - {Phone} - DeviceModel - string(30) - regex:/^[A-Za-z0-9- ]*$/
                <b>device[type]</b> - {1.0.0} - DeviceType - string(30) - regex:/^[A-Za-z0-9]*$/
                <b>device[appVersion]</b> - {1.0} - AppVersion - string(30) - regex:/^[A-Za-z0-9.]*$/
                <b>device[appMenuVersion]</b> - {1.0} - MenuIDVersion - string(30) - regex:/^[A-Za-z0-9.]*$/
                <b>device[os]</b> - {1.0} - OSVersion - string(30) - regex:/^[A-Za-z0-9.]*$/
                <b>device[platform]</b> - {0} - Platform (0-ios / 1-android) - boolean
                ',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "temporary_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbE16U0ZZemMwdE1jVEp1VEd0dE9GTnJjMlZXU1hjOVBTSXNJblpoYkhWbElqb2lVazFDUnpaUVptTTBTMDQzWWxsS1hDOXhVakoyWjNoYVlqVldZbGRpTUhsRFJFZFhTbUpYUmtGRVRqQnRkVmhMYlhaclJEbGtaRmhNTld0ak5GSlJOVFYzV1U1UFduVjRjV0ZPYmxsRVRWWm9iRE5hVFVvMWJVMXFVME0wTldaM09FSjFSRlo0VFUxVFZFaGhPWGh4Um1kUmVGZDBOazVCYWx3dmMzUTFOR2w0ZDFsUlEyWm1NbEE0VmxZeGIxWlpkMWRhWkVoc2NFMXJjMG93ZG5SemRqTXhhaXRoTW5acGJtSnFlSFJCVldzM1puUlZhbkJsTkdaTU9WVTRZV2xOYUhkRldGQlBjM2hQZVRoaU5qRk9RbmRaWkdaQk5FOU5SVTF6ZHpoaFptbzBNbFIyYzFKclVuTldhWFI2WmsxVGNUaGpNazFjTDNwTldYWnZPRWwwWldWSk5FMU1SSFpJUTJWdlZubHJiVFpyUlZkMFkwNVlTa00yVmxSek5rUnNXWGxVTjBvMlIyTlZSV0pGSzA0NVltZHNiVTF0UmtaeVQxcDJSa0paYzA5b1pUaHJaemxQYkdWYVJVSnhNVk5rTm1kNFpqVXdZMmhxZEhkTmVUWllhR0p4Ym5Cc0t6RTRVM2RuTUVWU1ZsWXdPU3REVmpGV1JrZHhSblZCYVhwa2VrWnlJaXdpYldGaklqb2lPVFV6Wm1OaU5XRTNZemt3TUdZek1qUTJORFEyWWpReVpqUXhObUprTlRWa1pXTTNZek00TlRNd1lXVTFPREV3TlRRME1USTRPV1ZqTkRWbU5XTTVaQ0o5IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NDkwMjI1NDIsInN1YiI6IiIsImF1ZCI6IiJ9.beIwnkcvioUDQh5yscTr-GBhkzLuQncYX0SQcdB3wcw",
                        "phone" => [
                            "country_codes" => [
                                "992",
                            ],
                            "operator_codes" => [
                                "92",
                                "50",
                                "55",
                                "77",
                                "93",
                                "98",
                                "918",
                                "90",
                                "88",
                                "91",
                            ],
                        ],
                    ],

                ],
                'response_reject_json' => [
                    "code" => 9,
                    "message" => "Требуется обновление",
                    "meta" => [
                        "upgrade_app_status" => 2,
                    ],
                ],
                'version' => '1',
                'group' => '11',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '1907132f-35c2-11e9-96f3-b06ebfbfa715',
                'name' => '1.1 Запрос при первоначальном запуске приложения',
                'url_path' => '/api/v2/auth/hello',
                'method' => 'POST',
                'params' => 'При первоначальном запросе передаётся временный токен <b>temporary_token</b>, который будет использоваться до получения основного токена <b>access_token</b>.

                <b>device[id]</b> - {1724791e-3339-11e9-96f3-b06ebfbfa715} - DeviceUUID - string(30) - regex:/^[A-Za-z0-9-]*$/
                <b>device[name]</b> - {Samsung G803T} - DeviceName - string(30) - regex:/^[A-Za-z0-9- ]*$/
                <b>device[model]</b> - {Phone} - DeviceModel - string(30) - regex:/^[A-Za-z0-9- ]*$/
                <b>device[type]</b> - {1.0.0} - DeviceType - string(30) - regex:/^[A-Za-z0-9]*$/
                <b>device[appVersion]</b> - {1.0} - AppVersion - string(30) - regex:/^[A-Za-z0-9.]*$/
                <b>device[appMenuVersion]</b> - {1.0} - MenuIDVersion - string(30) - regex:/^[A-Za-z0-9.]*$/
                <b>device[os]</b> - {1.0} - OSVersion - string(30) - regex:/^[A-Za-z0-9.]*$/
                <b>device[platform]</b> - {0} - Platform (0-ios / 1-android) - boolean

                Пример
                {
                    "device":{
                        "id":"41DC2FA0-9688-4DBF-AFF0-494774476B4112",
                        "name":"iphone 20",
                        "model":"iphone 10",
                        "type":"iphone",
                        "appVersion":"1.2.0",
                        "appMenuVersion":"0.1.1",
                        "platform":0,
                        "os":"IOS"
                    }
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "temporary_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbE16U0ZZemMwdE1jVEp1VEd0dE9GTnJjMlZXU1hjOVBTSXNJblpoYkhWbElqb2lVazFDUnpaUVptTTBTMDQzWWxsS1hDOXhVakoyWjNoYVlqVldZbGRpTUhsRFJFZFhTbUpYUmtGRVRqQnRkVmhMYlhaclJEbGtaRmhNTld0ak5GSlJOVFYzV1U1UFduVjRjV0ZPYmxsRVRWWm9iRE5hVFVvMWJVMXFVME0wTldaM09FSjFSRlo0VFUxVFZFaGhPWGh4Um1kUmVGZDBOazVCYWx3dmMzUTFOR2w0ZDFsUlEyWm1NbEE0VmxZeGIxWlpkMWRhWkVoc2NFMXJjMG93ZG5SemRqTXhhaXRoTW5acGJtSnFlSFJCVldzM1puUlZhbkJsTkdaTU9WVTRZV2xOYUhkRldGQlBjM2hQZVRoaU5qRk9RbmRaWkdaQk5FOU5SVTF6ZHpoaFptbzBNbFIyYzFKclVuTldhWFI2WmsxVGNUaGpNazFjTDNwTldYWnZPRWwwWldWSk5FMU1SSFpJUTJWdlZubHJiVFpyUlZkMFkwNVlTa00yVmxSek5rUnNXWGxVTjBvMlIyTlZSV0pGSzA0NVltZHNiVTF0UmtaeVQxcDJSa0paYzA5b1pUaHJaemxQYkdWYVJVSnhNVk5rTm1kNFpqVXdZMmhxZEhkTmVUWllhR0p4Ym5Cc0t6RTRVM2RuTUVWU1ZsWXdPU3REVmpGV1JrZHhSblZCYVhwa2VrWnlJaXdpYldGaklqb2lPVFV6Wm1OaU5XRTNZemt3TUdZek1qUTJORFEyWWpReVpqUXhObUprTlRWa1pXTTNZek00TlRNd1lXVTFPREV3TlRRME1USTRPV1ZqTkRWbU5XTTVaQ0o5IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NDkwMjI1NDIsInN1YiI6IiIsImF1ZCI6IiJ9.beIwnkcvioUDQh5yscTr-GBhkzLuQncYX0SQcdB3wcw",
                        "phone" => [
                            "country_codes" => [
                                "992",
                            ],
                            "operator_codes" => [
                                "92",
                                "50",
                                "55",
                                "77",
                                "93",
                                "98",
                                "918",
                                "90",
                                "88",
                                "91",
                            ],
                        ],
                    ],
                ],
                'response_reject_json' => [
                    "code" => 9,
                    "message" => "Требуется обновление",
                    "meta" => [
                        "upgrade_app_status" => 2,
                    ],
                ],
                'version' => '2',
                'group' => '11',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'd9093bf9-333c-11e9-96f3-b06ebfbfa715',
                'name' => '1.2 Отправка номера телефона для верификации и (запрос на повтор) отправки СМС кода',
                'url_path' => '/api/v1/auth/phone',
                'method' => 'POST',
                'params' => '
                <b>msisdn</b> - {992921112233} - BigInteger(12)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "temporary_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbEZJTkVjeFlsTlJTM2tyY2tSY0wyMVVLMmhuWEM5Ulp6MDlJaXdpZG1Gc2RXVWlPaUp0SzFKaFYxWnZSRWRHWEM5T09WVkdUblJzUlhkNVRrWkJORkIwVDA5T2JuWkJPWEJsYUdsWk1Gd3ZUM1ZhVkdsS2ExZG1aa1p0TXl0SlMwZHpVak15UTAxRGQxQkRjMjFYVDBoclRXWjBkSG94TUVSUU5FSlVZemhLWTNKbFlsVm1PRkkxZW1ONVlrVmhSVWRtVWt4WFZreFdNRzgxU21OSU9YQm5VMmhYU0ZSb1lVWmNMMlZZWEM5RGJIVnhSekZyWVZOcWFsaEpSMHR2WkdzeVpVcDZlbXA1ZUhkV04xZEdaRnd2Y3poVWVXaGlVVE5MV0RKV1ZtUlJkRFEwVFc1dE5HRm5LMkZyYUdGc1lXZFFORWgxUzBKSE5tRkVjRmgyVDNaRFN6UlhiVFUxV0VGVWFURmpiazVtVHpoVVRXbGljM05CY0dkb1JrcEdkbU50WXpFMVdUQmxlVWczWlRORllXcGpURFZWYUdJNWQxbHJXa0ZGU213clFsUktUSEJYZHpkbFIzZFBhV3AxUjBOY0wxSm1PREZYVm0xeGRFSlBNMk5IYlVocVVsUjZiMVpLZEhCcU1XVkpNbnBDZFZwMlhDOW1Tamw0YUV0SGNWVkJOaXMwWkdocGJWaHNjVFpqWlhocVZUSjJUemRxTVdZMmNYZHFOM05oZWpSUlhDOWtUVUZ4YkZoTGJrdDJORkpQUmtsb01qSmFkV1o0WVhWRlprUjRXblo2YVRJMWR6TllTMmNyUkVsdlhDOWxNMkowVTB3d1BTSXNJbTFoWXlJNkltRTNZV015T0RNek1qTmlaVGxpTVRZNVpUSTFPVFV6TUdFd01UQXlZVFl3WW1OaU1EQTVabU14WW1JME0yTmxNbVF4T1RabE5XVXlaV00yTmprNFlqRWlmUT09IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NDkwMjM0MzEsInN1YiI6IiIsImF1ZCI6IiJ9.JcuudJRKjEJkN11Or-LAeoPd5p7xbomQyamSBA-s6pY",
                        "wait_settings" => 60,
                        "timeout_confirm_code" => 240,
                    ],

                ],
                'response_reject_json' => [
                    "code" => 11,
                    "message" => "Не истекло время ожидания",
                    "meta" => [
                        "wait_seconds" => 43,
                        "timeout_confirm_code" => 240,
                        "verify_phone_try_count" => 2,
                    ],
                ],
                'version' => '1',
                'group' => '12',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'e3252f6a-35c5-11e9-96f3-b06ebfbfa715',
                'name' => '1.2 Отправка номера телефона для верификации и (запрос на повтор) отправки СМС кода',
                'url_path' => '/api/v2/auth/phone',
                'method' => 'POST',
                'params' => '
                <b>msisdn</b> - {992921112233} - BigInteger(12)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "temporary_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbEZJTkVjeFlsTlJTM2tyY2tSY0wyMVVLMmhuWEM5Ulp6MDlJaXdpZG1Gc2RXVWlPaUp0SzFKaFYxWnZSRWRHWEM5T09WVkdUblJzUlhkNVRrWkJORkIwVDA5T2JuWkJPWEJsYUdsWk1Gd3ZUM1ZhVkdsS2ExZG1aa1p0TXl0SlMwZHpVak15UTAxRGQxQkRjMjFYVDBoclRXWjBkSG94TUVSUU5FSlVZemhLWTNKbFlsVm1PRkkxZW1ONVlrVmhSVWRtVWt4WFZreFdNRzgxU21OSU9YQm5VMmhYU0ZSb1lVWmNMMlZZWEM5RGJIVnhSekZyWVZOcWFsaEpSMHR2WkdzeVpVcDZlbXA1ZUhkV04xZEdaRnd2Y3poVWVXaGlVVE5MV0RKV1ZtUlJkRFEwVFc1dE5HRm5LMkZyYUdGc1lXZFFORWgxUzBKSE5tRkVjRmgyVDNaRFN6UlhiVFUxV0VGVWFURmpiazVtVHpoVVRXbGljM05CY0dkb1JrcEdkbU50WXpFMVdUQmxlVWczWlRORllXcGpURFZWYUdJNWQxbHJXa0ZGU213clFsUktUSEJYZHpkbFIzZFBhV3AxUjBOY0wxSm1PREZYVm0xeGRFSlBNMk5IYlVocVVsUjZiMVpLZEhCcU1XVkpNbnBDZFZwMlhDOW1Tamw0YUV0SGNWVkJOaXMwWkdocGJWaHNjVFpqWlhocVZUSjJUemRxTVdZMmNYZHFOM05oZWpSUlhDOWtUVUZ4YkZoTGJrdDJORkpQUmtsb01qSmFkV1o0WVhWRlprUjRXblo2YVRJMWR6TllTMmNyUkVsdlhDOWxNMkowVTB3d1BTSXNJbTFoWXlJNkltRTNZV015T0RNek1qTmlaVGxpTVRZNVpUSTFPVFV6TUdFd01UQXlZVFl3WW1OaU1EQTVabU14WW1JME0yTmxNbVF4T1RabE5XVXlaV00yTmprNFlqRWlmUT09IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NDkwMjM0MzEsInN1YiI6IiIsImF1ZCI6IiJ9.JcuudJRKjEJkN11Or-LAeoPd5p7xbomQyamSBA-s6pY",
                        "wait_settings" => 60,
                        "timeout_confirm_code" => 240,
                    ],
                ],
                'response_reject_json' => [
                    "code" => 11,
                    "message" => "Не истекло время ожидания",
                    "meta" => [
                        "wait_seconds" => 43,
                        "timeout_confirm_code" => 240,
                        "verify_phone_try_count" => 2,
                    ],
                ],
                'version' => '2',
                'group' => '12',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'b8a32c0c-335c-11e9-96f3-b06ebfbfa715',
                'name' => '1.3 Отправка СМС-кода для подтверждения',
                'url_path' => '/api/v1/auth/phone/confirm',
                'method' => 'POST',
                'params' => 'Если параметр is_auth является false необходимо предложить пользователю создать новый Пин-код, в противном случае необходимо ввести ранее созданный Пин-код

                <b>hash_code</b> - {23d7623gd47q234723874dg2834drh87346} - String(32)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "temporary_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJa2xoU2xSb1VqUnhSbFl6T0VwWFFWSklTalJKUVhjOVBTSXNJblpoYkhWbElqb2llRkEwUTAxM1oyRmpOM1k0VVhaeE1ESkhhVVZTZWxsUk1sZDNRMFpMT0hRNFZVTnZaRzgyU1V3M2RrOXBZbHd2UlVKeFdFUmtlV1J2T0ZSdlptOVRYQzlYUW5oR1hDODRhM0YwVWtad2RteE1hVEpTYVhwVk0zaExWa05YVlZFelRGZE9UbVF5TVVoeU5XeFpOMVpIWlhBNFExWmtaR1ZoZW5GT1R6UnhSVGgyV25rMFEwMWhSbUZFV0hVMWFYWmxOMGxoWEM5dlVHWk9TbGg0TkRWR1MwbExVazQwVmxWbVFXaDBSR0ZsWkhCWU5GcFRRakI2WEM5WVVrdExTMkpCUW5SbVdtaEZUV2wxVFhOTlkyWTBkV2x2YjBZeFQzRmNMM1EyVFdaYU0yOVljSGR6T0U4M1dtUmtjVFJNY2xadFExQmFSak5UZGxaSloyTlhVbWhLYTNWM1UxQm1PRUp6Y2xaSGQySlVXU3QxYkRkSWNHUkJZazF6Ym5VclVraGNMM1JzZHpsT1ZWUm5VRXA2Tmt4SlZtaFNNSFpxUzFWNFJWcHVhV3BITjBWeU1qWk9aV2hzV2xCU1lWZDZaVlUwUjJaTFJGcEJOMGsyVEdkNEt6Uk9TekpNYVRCRE56ZExTMHN3UWxGSFZIQndVMFJLSzBOSGVtVlBjbGR6V1VjM1ZXUlpiMXd2V0ZORWIydFNNR05OTnpGVk1IaGxabWxSYUhJMWMzSjNQVDBpTENKdFlXTWlPaUl3WXprek16aG1ZbU0yTlRVM09HSm1aalF6TVdOa05qQTBaall5TmpReE9EbGtNRGN6Tm1JeE5XWTROak5sTnpZNFlXSXpaalJtTmpGaU5EQTFPVEpsSW4wPSIsImlzcyI6ImVza2hhdGEuY29tIiwiZXhwIjoxNTQ5MDE4NjMzLCJzdWIiOiIiLCJhdWQiOiIifQ.gjFvULv9rhg3xlPQUhDnIJfCFX5fQlkab1tTj0yG1iw",
                        "is_auth" => false,
                        "timeout_to_enter_pin" => 300,
                    ],

                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Ошибка верификации СМС-кода",
                    "meta" => [
                        "sms_confirm_try_count" => 1,
                    ],
                ],
                'version' => '1',
                'group' => '13',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'dcca862e-35c5-11e9-96f3-b06ebfbfa715',
                'name' => '1.3 Отправка СМС-кода для подтверждения',
                'url_path' => '/api/v2/auth/phone/confirm',
                'method' => 'POST',
                'params' => 'Если параметр is_auth является false необходимо предложить пользователю создать новый Пин-код, в противном случае необходимо ввести ранее созданный Пин-код

                <b>hash_code</b> - {23d7623gd47q234723874dg2834drh87346} - String(32)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "temporary_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJa2xoU2xSb1VqUnhSbFl6T0VwWFFWSklTalJKUVhjOVBTSXNJblpoYkhWbElqb2llRkEwUTAxM1oyRmpOM1k0VVhaeE1ESkhhVVZTZWxsUk1sZDNRMFpMT0hRNFZVTnZaRzgyU1V3M2RrOXBZbHd2UlVKeFdFUmtlV1J2T0ZSdlptOVRYQzlYUW5oR1hDODRhM0YwVWtad2RteE1hVEpTYVhwVk0zaExWa05YVlZFelRGZE9UbVF5TVVoeU5XeFpOMVpIWlhBNFExWmtaR1ZoZW5GT1R6UnhSVGgyV25rMFEwMWhSbUZFV0hVMWFYWmxOMGxoWEM5dlVHWk9TbGg0TkRWR1MwbExVazQwVmxWbVFXaDBSR0ZsWkhCWU5GcFRRakI2WEM5WVVrdExTMkpCUW5SbVdtaEZUV2wxVFhOTlkyWTBkV2x2YjBZeFQzRmNMM1EyVFdaYU0yOVljSGR6T0U4M1dtUmtjVFJNY2xadFExQmFSak5UZGxaSloyTlhVbWhLYTNWM1UxQm1PRUp6Y2xaSGQySlVXU3QxYkRkSWNHUkJZazF6Ym5VclVraGNMM1JzZHpsT1ZWUm5VRXA2Tmt4SlZtaFNNSFpxUzFWNFJWcHVhV3BITjBWeU1qWk9aV2hzV2xCU1lWZDZaVlUwUjJaTFJGcEJOMGsyVEdkNEt6Uk9TekpNYVRCRE56ZExTMHN3UWxGSFZIQndVMFJLSzBOSGVtVlBjbGR6V1VjM1ZXUlpiMXd2V0ZORWIydFNNR05OTnpGVk1IaGxabWxSYUhJMWMzSjNQVDBpTENKdFlXTWlPaUl3WXprek16aG1ZbU0yTlRVM09HSm1aalF6TVdOa05qQTBaall5TmpReE9EbGtNRGN6Tm1JeE5XWTROak5sTnpZNFlXSXpaalJtTmpGaU5EQTFPVEpsSW4wPSIsImlzcyI6ImVza2hhdGEuY29tIiwiZXhwIjoxNTQ5MDE4NjMzLCJzdWIiOiIiLCJhdWQiOiIifQ.gjFvULv9rhg3xlPQUhDnIJfCFX5fQlkab1tTj0yG1iw",
                        "next_step" => 4,
                    ],

                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Ошибка верификации СМС-кода",
                    "meta" => [
                        "sms_confirm_try_count" => 1,
                    ],
                ],
                'version' => '2',
                'group' => '13',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '1ff36fcb-336e-11e9-96f3-b06ebfbfa715',
                'name' => '1.4 Отправка Пин-кода для регистрации',
                'url_path' => '/api/v1/register/pin',
                'method' => 'POST',
                'params' => 'Дальнейщая связь между сервером происходит через access_tokenПосле успешной регистрации, необходимо послать запрос на получение основных данных пользователя (для главного экрана) (3.1.1)

                <b>code</b> - {4455} - String(4)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "photo_url" => "url",
                        "msisdn" => 992921234567,
                        "first_name" => "Test",
                        "last_name" => "Test2",
                        "middle_name" => "Test3",
                        "date_birth" => "2019-02-01",
                        "gender" => -1,
                        "username" => "992921234567",
                        "email" => "test@gmail.com",
                        "attestation_name" => "Неидентифицированный",
                        "qr_code" => "eyJzZXJ2aWNlX2lkIjoiOTZlOGI3ODUtYjFiOS0xMWU4LTkwNGItYjA2ZWJmYmZhNzE1IiwicGhvbmUiOiI5MjEyMzQ1NjcifQ==",
                        "accounts" => [
                            [
                                "balance" => 0,
                                "number" => "5100200010000179",
                                "currency_iso_name" => "TJS",
                                "account_type_name" => "Эсхата Онлайн",
                            ],
                        ],
                    ],
                    "meta" => [
                        "is_editable" => 1,
                        "menu_version" => "19",
                        "push_token" => "d41d8cd98f00b204e9800998ecf8427e",
                        "access_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbXhxZVZoTFUwczJSM2w0UzJ0d1NEZHBUbXh1Tm1jOVBTSXNJblpoYkhWbElqb2lUM2hFZWpCR2NrbE9XRFowYzBWamVtUlNla0ZSUkVWMFRESkxTbTVVVDBKUmVYQXdYQzl2UTI4eE9VcDZjMjl0YVhrd1lsQmpabXBFYWtwc1pUY3JkMEZGYVdKT2RERTJNM2N4TUZwWmExcG9kbTVHUjFVd1JFczNkVzkwUlRKUlNWbDZTRkZDYzNOV2JYaDFiRWx2WjJjNEsxZFpXbWRtWWxCWFRUZDZZVU5hWkZabGFtZENTREpyVTNWS01FUTVPSHBKVDJaemR6MDlJaXdpYldGaklqb2lNMkkxTlRnM1pqQmhNREJrWW1Wak9Ua3dZVE5pT0dZM05EQmpNV0ZsTVRJMU5tUTROekkyWmpSaE5tSXpOekZoTUdJeE9XTmhNR1ExTlRVMlltUXpOQ0o5IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NDkwMTkzMTgsInN1YiI6IiIsImF1ZCI6IiJ9.v6rirHkKIdOO8GMn8wDHwEnx55xKYC7f1Gh8-F7GNsc",
                        "refresh_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbXhxZVZoTFUwczJSM2w0UzJ0d1NEZHBUbXh1Tm1jOVBTSXNJblpoYkhWbElqb2lUM2hFZWpCR2NrbE9XRFowYzBWamVtUlNla0ZSUkVWMFRESkxTbTVVVDBKUmVYQXdYQzl2UTI4eE9VcDZjMjl0YVhrd1lsQmpabXBFYWtwc1pUY3JkMEZGYVdKT2RERTJNM2N4TUZwWmExcG9kbTVHUjFVd1JFczNkVzkwUlRKUlNWbDZTRkZDYzNOV2JYaDFiRWx2WjJjNEsxZFpXbWRtWWxCWFRUZDZZVU5hWkZabGFtZENTREpyVTNWS01FUTVPSHBKVDJaemR6MDlJaXdpYldGaklqb2lNMkkxTlRnM1pqQmhNREJrWW1Wak9Ua3dZVE5pT0dZM05EQmpNV0ZsTVRJMU5tUTROekkyWmpSaE5tSXpOekZoTUdJeE9XTmhNR1ExTlRVMlltUXpOQ0o5IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NTE3ODMwOTgsInN1YiI6IiIsImF1ZCI6IiJ9.ci-KKSWNUdr85hwCivoR1DUypGDRjC6d71Cs5UAZ4FQ",
                        "expire_in" => 16,
                    ],

                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '14',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '5fd604a4-35c7-11e9-96f3-b06ebfbfa715',
                'name' => '1.4 Отправка Пин-кода для регистрации',
                'url_path' => '/api/v2/register/pin',
                'method' => 'POST',
                'params' => 'Дальнейщая связь между сервером происходит через access_tokenПосле успешной регистрации, необходимо послать запрос на получение основных данных пользователя (для главного экрана) (3.1.1)

                <b>code</b> - {4455} - String(4)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "photo_url" => "url",
                        "msisdn" => 992921234567,
                        "first_name" => "Test",
                        "last_name" => "Test2",
                        "middle_name" => "Test3",
                        "date_birth" => "2019-02-01",
                        "gender" => -1,
                        "username" => "992921234567",
                        "email" => "test@gmail.com",
                        "attestation_name" => "Неидентифицированный",
                        "qr_code" => "eyJzZXJ2aWNlX2lkIjoiOTZlOGI3ODUtYjFiOS0xMWU4LTkwNGItYjA2ZWJmYmZhNzE1IiwicGhvbmUiOiI5MjEyMzQ1NjcifQ==",
                        "accounts" => [
                            [
                                "balance" => 0,
                                "number" => 5100200010000179,
                                "currency_iso_name" => "TJS",
                                "account_type_name" => "Эсхата Онлайн",
                            ],
                        ],
                    ],
                    "meta" => [
                        "is_editable" => 1,
                        "menu_version" => "19",
                        "push_token" => "d41d8cd98f00b204e9800998ecf8427e",
                        "access_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbXhxZVZoTFUwczJSM2w0UzJ0d1NEZHBUbXh1Tm1jOVBTSXNJblpoYkhWbElqb2lUM2hFZWpCR2NrbE9XRFowYzBWamVtUlNla0ZSUkVWMFRESkxTbTVVVDBKUmVYQXdYQzl2UTI4eE9VcDZjMjl0YVhrd1lsQmpabXBFYWtwc1pUY3JkMEZGYVdKT2RERTJNM2N4TUZwWmExcG9kbTVHUjFVd1JFczNkVzkwUlRKUlNWbDZTRkZDYzNOV2JYaDFiRWx2WjJjNEsxZFpXbWRtWWxCWFRUZDZZVU5hWkZabGFtZENTREpyVTNWS01FUTVPSHBKVDJaemR6MDlJaXdpYldGaklqb2lNMkkxTlRnM1pqQmhNREJrWW1Wak9Ua3dZVE5pT0dZM05EQmpNV0ZsTVRJMU5tUTROekkyWmpSaE5tSXpOekZoTUdJeE9XTmhNR1ExTlRVMlltUXpOQ0o5IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NDkwMTkzMTgsInN1YiI6IiIsImF1ZCI6IiJ9.v6rirHkKIdOO8GMn8wDHwEnx55xKYC7f1Gh8-F7GNsc",
                        "refresh_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbXhxZVZoTFUwczJSM2w0UzJ0d1NEZHBUbXh1Tm1jOVBTSXNJblpoYkhWbElqb2lUM2hFZWpCR2NrbE9XRFowYzBWamVtUlNla0ZSUkVWMFRESkxTbTVVVDBKUmVYQXdYQzl2UTI4eE9VcDZjMjl0YVhrd1lsQmpabXBFYWtwc1pUY3JkMEZGYVdKT2RERTJNM2N4TUZwWmExcG9kbTVHUjFVd1JFczNkVzkwUlRKUlNWbDZTRkZDYzNOV2JYaDFiRWx2WjJjNEsxZFpXbWRtWWxCWFRUZDZZVU5hWkZabGFtZENTREpyVTNWS01FUTVPSHBKVDJaemR6MDlJaXdpYldGaklqb2lNMkkxTlRnM1pqQmhNREJrWW1Wak9Ua3dZVE5pT0dZM05EQmpNV0ZsTVRJMU5tUTROekkyWmpSaE5tSXpOekZoTUdJeE9XTmhNR1ExTlRVMlltUXpOQ0o5IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NTE3ODMwOTgsInN1YiI6IiIsImF1ZCI6IiJ9.ci-KKSWNUdr85hwCivoR1DUypGDRjC6d71Cs5UAZ4FQ",
                    ],

                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '14',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '3c8547b1-336f-11e9-96f3-b06ebfbfa715',
                'name' => '1.5 Отправка Пин-кода для авторизации',
                'url_path' => '/api/v1/auth/pin',
                'method' => 'POST',
                'params' => '
                <b>hash_code</b> - {12dq234f234f234f234f5234f5234f5} - String(32)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "photo_url" => "https://domain/imgs/users/400x/d85e8876-b47c-4327-a87e-e32dfaf4cd2c_2018-11-16_20-27-14-450556.jpg",
                        "msisdn" => 992920000000,
                        "first_name" => "Тест",
                        "last_name" => "Тест",
                        "middle_name" => "Тест",
                        "date_birth" => "1990-01-01",
                        "gender" => 1,
                        "username" => "992920000000",
                        "email" => "test@gmail.com",
                        "attestation_name" => "Идентифицированный",
                        "qr_code" => "qaJzZXJ2aWNlX2lkIjoiOTZlOGI3ODUtYjFiOS0xMWU4LTkwNGItYjA2ZWJmYmZhNzE1IiwicGhvbmUiOiI5MjYxNjQ0MzYifQ==",
                        "accounts" => [
                            [
                                "balance" => 2.5,
                                "number" => "5100200010000001",
                                "currency_iso_name" => "TJS",
                                "account_type_name" => "Эсхата Онлайн",
                            ],
                        ],
                    ],
                    "meta" => [
                        "is_editable" => 0,
                        "menu_version" => "19",
                        "push_token" => "d41d8cd98f00b204e9800998ecf8427e",
                        "access_token" => "ghJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJa1pSWEM5SU9HVm5SVk5hTnpKM1JWTTNNbWN4ZVZ3dmR6MDlJaXdpZG1Gc2RXVWlPaUpRT1hKSE9FZDNTREZvVm1ocVZYWlRWM2xvTVN0VVZESTJkMnhUWm1KeU5sd3ZURFZjTDNSbmNWQTFSa3R1YUZNMVIwWnhLMUZUZFVnMFVWWkRkazV3TUZSSVUzZElYQzlsTVVzMWJFWndhSEJuVTFJcmFGZEhTMmxjTHpGeGJGSnlUM1k1U21sTk16WmlWVUo1SzNBeWNFOUthR1oyU1hjNVpqQjVTWFYxZDFselJUZDNUelJTZVVsR05qSlJWbFpOU0RCdlRHWk9NVUZSUFQwaUxDSnRZV01pT2lJME5HWTJZbVV4T1RJM05XTmxNekF4TkRJMVlUazJZamt3TTJFMlpEUmhPVE5rTmpReE1UVm1PRE5tTm1FM01UUmtNRGsxWWpNNU56RmtPV000TnpBMkluMD0iLCJpc3MiOiJlc2toYXRhLmNvbSIsImV4cCI6MTU0OTI4MDA2OCwic3ViIjoiIiwiYXVkIjoiIn0.-r8jLTGV7oNT4sG_grdkEz80QPt8_PB9QgC_Av_CQBY",
                        "refresh_token" => "weJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJa1pSWEM5SU9HVm5SVk5hTnpKM1JWTTNNbWN4ZVZ3dmR6MDlJaXdpZG1Gc2RXVWlPaUpRT1hKSE9FZDNTREZvVm1ocVZYWlRWM2xvTVN0VVZESTJkMnhUWm1KeU5sd3ZURFZjTDNSbmNWQTFSa3R1YUZNMVIwWnhLMUZUZFVnMFVWWkRkazV3TUZSSVUzZElYQzlsTVVzMWJFWndhSEJuVTFJcmFGZEhTMmxjTHpGeGJGSnlUM1k1U21sTk16WmlWVUo1SzNBeWNFOUthR1oyU1hjNVpqQjVTWFYxZDFselJUZDNUelJTZVVsR05qSlJWbFpOU0RCdlRHWk9NVUZSUFQwaUxDSnRZV01pT2lJME5HWTJZbVV4T1RJM05XTmxNekF4TkRJMVlUazJZamt3TTJFMlpEUmhPVE5rTmpReE1UVm1PRE5tTm1FM01UUmtNRGsxWWpNNU56RmtPV000TnpBMkluMD0iLCJpc3MiOiJlc2toYXRhLmNvbSIsImV4cCI6MTU1MjA0Mzg0OCwic3ViIjoiIiwiYXVkIjoiIn0.LHoK4Wr5wfOLP0tnpczwCO5GwSNBWHcgXghPguIBEvM",
                        "expire_in" => 16,
                    ],
                ],
                'response_reject_json' => [
                    "code" => 5,
                    "meta" => [
                        "pin_confirm_try_count" => 1,
                        "wait_seconds" => 60,
                    ],
                ],
                'version' => '1',
                'group' => '15',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '3d772e29-35cb-11e9-96f3-b06ebfbfa715',
                'name' => '1.5 Отправка Пин-кода для авторизации',
                'url_path' => '/api/v2/auth/pin',
                'method' => 'POST',
                'params' => '
                <b>hash_code</b> - {12dq234f234f234f234f5234f5234f5} - String(32)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "photo_url" => "https://domain/imgs/users/400x/d85e8876-b47c-4327-a87e-e32dfaf4cd2c_2018-11-16_20-27-14-450556.jpg",
                        "msisdn" => 992920000000,
                        "first_name" => "Тест",
                        "last_name" => "Тест",
                        "middle_name" => "Тест",
                        "date_birth" => "1990-01-01",
                        "gender" => 1,
                        "username" => "992920000000",
                        "email" => "test@gmail.com",
                        "attestation_name" => "Идентифицированный",
                        "qr_code" => "qaJzZXJ2aWNlX2lkIjoiOTZlOGI3ODUtYjFiOS0xMWU4LTkwNGItYjA2ZWJmYmZhNzE1IiwicGhvbmUiOiI5MjYxNjQ0MzYifQ==",
                        "accounts" => [
                            [
                                "balance" => 2.5,
                                "number" => 5100200010000001,
                                "currency_iso_name" => "TJS",
                                "account_type_name" => "Эсхата Онлайн",
                            ],
                        ],
                    ],
                    "meta" => [
                        "is_editable" => 0,
                        "menu_version" => "19",
                        "push_token" => "d41d8cd98f00b204e9800998ecf8427e",
                        "access_token" => "ghJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJa1pSWEM5SU9HVm5SVk5hTnpKM1JWTTNNbWN4ZVZ3dmR6MDlJaXdpZG1Gc2RXVWlPaUpRT1hKSE9FZDNTREZvVm1ocVZYWlRWM2xvTVN0VVZESTJkMnhUWm1KeU5sd3ZURFZjTDNSbmNWQTFSa3R1YUZNMVIwWnhLMUZUZFVnMFVWWkRkazV3TUZSSVUzZElYQzlsTVVzMWJFWndhSEJuVTFJcmFGZEhTMmxjTHpGeGJGSnlUM1k1U21sTk16WmlWVUo1SzNBeWNFOUthR1oyU1hjNVpqQjVTWFYxZDFselJUZDNUelJTZVVsR05qSlJWbFpOU0RCdlRHWk9NVUZSUFQwaUxDSnRZV01pT2lJME5HWTJZbVV4T1RJM05XTmxNekF4TkRJMVlUazJZamt3TTJFMlpEUmhPVE5rTmpReE1UVm1PRE5tTm1FM01UUmtNRGsxWWpNNU56RmtPV000TnpBMkluMD0iLCJpc3MiOiJlc2toYXRhLmNvbSIsImV4cCI6MTU0OTI4MDA2OCwic3ViIjoiIiwiYXVkIjoiIn0.-r8jLTGV7oNT4sG_grdkEz80QPt8_PB9QgC_Av_CQBY",
                        "refresh_token" => "weJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJa1pSWEM5SU9HVm5SVk5hTnpKM1JWTTNNbWN4ZVZ3dmR6MDlJaXdpZG1Gc2RXVWlPaUpRT1hKSE9FZDNTREZvVm1ocVZYWlRWM2xvTVN0VVZESTJkMnhUWm1KeU5sd3ZURFZjTDNSbmNWQTFSa3R1YUZNMVIwWnhLMUZUZFVnMFVWWkRkazV3TUZSSVUzZElYQzlsTVVzMWJFWndhSEJuVTFJcmFGZEhTMmxjTHpGeGJGSnlUM1k1U21sTk16WmlWVUo1SzNBeWNFOUthR1oyU1hjNVpqQjVTWFYxZDFselJUZDNUelJTZVVsR05qSlJWbFpOU0RCdlRHWk9NVUZSUFQwaUxDSnRZV01pT2lJME5HWTJZbVV4T1RJM05XTmxNekF4TkRJMVlUazJZamt3TTJFMlpEUmhPVE5rTmpReE1UVm1PRE5tTm1FM01UUmtNRGsxWWpNNU56RmtPV000TnpBMkluMD0iLCJpc3MiOiJlc2toYXRhLmNvbSIsImV4cCI6MTU1MjA0Mzg0OCwic3ViIjoiIiwiYXVkIjoiIn0.LHoK4Wr5wfOLP0tnpczwCO5GwSNBWHcgXghPguIBEvM",
                    ],
                ],
                'response_reject_json' => [
                    "code" => 5,
                    "meta" => [
                        "pin_confirm_try_count" => 1,
                        "wait_seconds" => 60,
                    ],
                ],
                'version' => '2',
                'group' => '15',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            
            [
                'id' => 'f5e0ffea-3371-11e9-96f3-b06ebfbfa715',
                'name' => '1.6 Запрос на восстановление Пин-кода',
                'url_path' => '/api/v1/reset/pin',
                'method' => 'GET',
                'params' => '
                <b>hash_code</b> - {12dq234f234f234f234f5234f5234f5} - String(32)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "На Ваш номер отправлено SMS с кодом. Введите код из SMS.",
                    "meta" => [
                        "temporary_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbkpvU2tVNWJtZG1LM1ZwWTBVMlFXZE1VV3QzWW1jOVBTSXNJblpoYkhWbElqb2lOM0ZtYUdKMlltcHphbFpvVHprMWNYcEJOVE5wWjBVNGVrVXlWMGxJZUVkVGJWd3ZOMWxMZUhod1dEa3daa2xoWEM4elVWd3ZlVFJYYkdoQ09Gd3ZhMjFCUmtOd1YyeEtZak5OZFhrck5qTkpTWGtyWTJKS1ZXaGxYQzljTDJWVWJXNW1ZVzByUlhCemJHazNRbEF3YjBKa2VqZHpjbkJaUzFCV04yZEZNSEJyVXpsdVRtRTNRbFJSY3pSRVQzWXlPSEZ5TXpoMVowVm5VMlJoVVc5UmNtWkNVRTlQT0drclhDOXBjSGREVjBFM1ZWa3pTbWQyV2tSb1NGTjVjbEZRWVhWVk1EQXhTR3BGVkRKcVNHSmFXbEp5U1c1bk5tdHJZMnczWm04MGNqSkJaRmQ1ZGpSSVQwdFNLelF4WWtvNWNsbHlSRGw1U2xwTE9FeFpUVmRoVVU5d2FrdFVWVEp1VDFFM1JGSm9Rbk5aWm5KeFNYRlJPRXBhWEM5Q1VYZHplbUY2SzAxV1UwZE9VelZhTVVoQ2JGVXpWM0pRTUdKRWRtdFlkMjlXY0hGMWVrazRXV1ZrVXpjMVhDOHljMHBuUkRKTGIyVnNkMEZ1UjI0eVlYWmxhWEZqWVVvMlNVcDNPVGxEYjJsUFFXb3pTbHd2SzJZeGVIWTVVMjByYzJ0elpsd3ZNbEo1VG1WNVptaFFVWE4zWkZJclRtMXpRazE2U1dOUE1WY3JOSEpCUFQwaUxDSnRZV01pT2lKa1pHWmhNRGc1WXpabE16TmhOamMxT0dVNE1UTmlOR1ZtTjJKaVpUZzFZamxpWW1NelptVTNOalk1T1dGbU5qSXpaR05pTXpSa016VXhaREJqTnpJd0luMD0iLCJpc3MiOiJlc2toYXRhLmNvbSIsImV4cCI6MTU0OTAxODg2Nywic3ViIjoiIiwiYXVkIjoiIn0.86YaUMITlwUVJeBB_kVl2ImBOmmFGSZ8ckZWZGye5LU",
                        "wait_settings" => 60,
                        "timeout_confirm_code" => 240,
                    ],
                ],
                'response_reject_json' => [
                    "code" => 5,
                    "meta" => [
                        "temporary_token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2xhcmF2ZWwtc3RvcmUtb25saW5lL3B1YmxpY19odG1sL2FwaS92MS9sb2dpbiIsImlhdCI6MTUxNDg2ODI0OCwiZXhwIjoxNTE0ODc1NDQ4LCJuYmYiOjE1MTQ4NjgyNDgsImp0aSI6IkVEeDlHR09ham9kV3VzZmkiLCJzdWIiOiIzYzc5OWY1NS0zZDRlLTQ5MWItYjUyMi1kNjkzZmNjN2I3NzQiLCJwcnYiOiI5NGRiZDk2MWFhZWYwZTNjZTY2YWQ3ZDUwZTY0NzcxNzYwOWRkYTI0In0.4cRj_ysVpj31oluXU5Lqci3vK_WcKpY-GuNTjwamxaQ",
                        "wait_seconds" => 60,
                        "timeout_confirm_code" => 300,
                    ],
                ],
                'version' => '1',
                'group' => '16',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '929673bf-c236-11e9-a12f-b06ebfbfa715',
                'name' => '1.6 Запрос на восстановление Пин-кода',
                'url_path' => '/api/v2/reset/pin',
                'method' => 'GET',
                'params' => '
                <b>hash_code</b> - {12dq234f234f234f234f5234f5234f5} - String(32)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "На Ваш номер отправлено SMS с кодом. Введите код из SMS.",
                    "meta" => [
                        "temporary_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbkpvU2tVNWJtZG1LM1ZwWTBVMlFXZE1VV3QzWW1jOVBTSXNJblpoYkhWbElqb2lOM0ZtYUdKMlltcHphbFpvVHprMWNYcEJOVE5wWjBVNGVrVXlWMGxJZUVkVGJWd3ZOMWxMZUhod1dEa3daa2xoWEM4elVWd3ZlVFJYYkdoQ09Gd3ZhMjFCUmtOd1YyeEtZak5OZFhrck5qTkpTWGtyWTJKS1ZXaGxYQzljTDJWVWJXNW1ZVzByUlhCemJHazNRbEF3YjBKa2VqZHpjbkJaUzFCV04yZEZNSEJyVXpsdVRtRTNRbFJSY3pSRVQzWXlPSEZ5TXpoMVowVm5VMlJoVVc5UmNtWkNVRTlQT0drclhDOXBjSGREVjBFM1ZWa3pTbWQyV2tSb1NGTjVjbEZRWVhWVk1EQXhTR3BGVkRKcVNHSmFXbEp5U1c1bk5tdHJZMnczWm04MGNqSkJaRmQ1ZGpSSVQwdFNLelF4WWtvNWNsbHlSRGw1U2xwTE9FeFpUVmRoVVU5d2FrdFVWVEp1VDFFM1JGSm9Rbk5aWm5KeFNYRlJPRXBhWEM5Q1VYZHplbUY2SzAxV1UwZE9VelZhTVVoQ2JGVXpWM0pRTUdKRWRtdFlkMjlXY0hGMWVrazRXV1ZrVXpjMVhDOHljMHBuUkRKTGIyVnNkMEZ1UjI0eVlYWmxhWEZqWVVvMlNVcDNPVGxEYjJsUFFXb3pTbHd2SzJZeGVIWTVVMjByYzJ0elpsd3ZNbEo1VG1WNVptaFFVWE4zWkZJclRtMXpRazE2U1dOUE1WY3JOSEpCUFQwaUxDSnRZV01pT2lKa1pHWmhNRGc1WXpabE16TmhOamMxT0dVNE1UTmlOR1ZtTjJKaVpUZzFZamxpWW1NelptVTNOalk1T1dGbU5qSXpaR05pTXpSa016VXhaREJqTnpJd0luMD0iLCJpc3MiOiJlc2toYXRhLmNvbSIsImV4cCI6MTU0OTAxODg2Nywic3ViIjoiIiwiYXVkIjoiIn0.86YaUMITlwUVJeBB_kVl2ImBOmmFGSZ8ckZWZGye5LU",
                        "wait_settings" => 60,
                        "timeout_confirm_code" => 240,
                    ],
                ],
                'response_reject_json' => [
                    "code" => 5,
                    "meta" => [
                        "temporary_token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2xhcmF2ZWwtc3RvcmUtb25saW5lL3B1YmxpY19odG1sL2FwaS92MS9sb2dpbiIsImlhdCI6MTUxNDg2ODI0OCwiZXhwIjoxNTE0ODc1NDQ4LCJuYmYiOjE1MTQ4NjgyNDgsImp0aSI6IkVEeDlHR09ham9kV3VzZmkiLCJzdWIiOiIzYzc5OWY1NS0zZDRlLTQ5MWItYjUyMi1kNjkzZmNjN2I3NzQiLCJwcnYiOiI5NGRiZDk2MWFhZWYwZTNjZTY2YWQ3ZDUwZTY0NzcxNzYwOWRkYTI0In0.4cRj_ysVpj31oluXU5Lqci3vK_WcKpY-GuNTjwamxaQ",
                        "wait_seconds" => 60,
                        "timeout_confirm_code" => 300,
                    ],
                ],
                'version' => '2',
                'group' => '16',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '80d0ea2e-3375-11e9-96f3-b06ebfbfa715',
                'name' => '1.7 Отправка СМС-кода для подтверждения для восстановления PIN-кода',
                'url_path' => '/api/v1/reset/pin/confirm',
                'method' => 'POST',
                'params' => '
                <b>hash_code</b> - {12dq234f234f234f234f5234f5234f5} - String(32)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "temporary_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJamhZY0Vwb2QyUkJURFpuWmt4dlUwOUdVM0YxWWxFOVBTSXNJblpoYkhWbElqb2lUR1ZqY2xScGRHUlFRbkp4UzJKNFRIcFlSbWNyU1cxTWRHNDRNa2xsVDJGdk1XWjFWRU5KV25CdVFYQXdhVkJKVVROemNIQkZaRUpUVGtwcmIzUlJLMWN3WTNCQ2JVSnRlREpYUjFOM2MzcEdTR05VUm1wQ1JVUTJlR3BoYkVNNE1VZHdSRmROWldOTmFDdFVVREZqUTBORk1YUXpLM014U2psaVVsTkJjVmMzWmtKNlZrZDJTVU51YTI5WmRuaFZXVEp2YkdGUVdsWnNhRVZsYzFOdVNtZGhaVzltWWpjME9GTnVWV0p0WWxvMFR6Vmplbk5ZU2psS1N6QktibWx6VlRKclFWTnFjMkpaYmpsQk5VZFRkVGd5ZFdWT1hDOWpSMXBVWEM5T1hDOUxaVk5uVm1sNk0ySmhNRnd2Wkc4ekszSkJVeXN5VlhWdlIyVkdkMUJtWVZaU1kydHhibVpOYVU1RVJVWjJNM1ZLUkdsMlIxWlROVlV6YVdNelZrUlRiV2xuUlVWWE1TdHNXVnd2YkhKR1hDOTVObHd2WWxJckt6WlpRV1ZzWmxRNWQxZGhNRFJCV21oeVNYVlNSWFJJVVdzNE5sVm5SRVJJV0d0eU5YaDNjRVJvZUhOQ0sxcDNVMnhCVHl0bk1XZHpUV0Z2WTBvNVdqazJWV2xMZG10U1EyTkVRbHd2VERrM01tVllaMUptYWpCc2NXUldOSGsxZEhSeVV6bFJQVDBpTENKdFlXTWlPaUkwTWpKaE9EVXpOREk1TURRMlpEUTNOVFV3T1RsallqWXdaakZrWW1WaVpUWXpaVEkyTUdJeU16RTVObUpqWWpGbU4yRXhabUV3TXpGa056UTJOVFk0SW4wPSIsImlzcyI6ImVza2hhdGEuY29tIiwiZXhwIjoxNTQ5MDE4ODgxLCJzdWIiOiIiLCJhdWQiOiIifQ.KG9p8wV4ipjPscv-cj3Zux6Ad8G0yUozJptBVDrB3kk",
                        "timeout_to_enter_pin" => 300,
                    ],
                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Ошибка верификации СМС-кода",
                    "meta" => [
                        "sms_confirm_try_count" => 1,
                    ],
                ],
                'version' => '1',
                'group' => '17',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '9fc46fc1-c236-11e9-a12f-b06ebfbfa715',
                'name' => '1.7 Отправка СМС-кода для подтверждения для восстановления PIN-кода',
                'url_path' => '/api/v2/reset/pin/confirm',
                'method' => 'POST',
                'params' => '
                <b>hash_code</b> - {12dq234f234f234f234f5234f5234f5} - String(32)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "temporary_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJamhZY0Vwb2QyUkJURFpuWmt4dlUwOUdVM0YxWWxFOVBTSXNJblpoYkhWbElqb2lUR1ZqY2xScGRHUlFRbkp4UzJKNFRIcFlSbWNyU1cxTWRHNDRNa2xsVDJGdk1XWjFWRU5KV25CdVFYQXdhVkJKVVROemNIQkZaRUpUVGtwcmIzUlJLMWN3WTNCQ2JVSnRlREpYUjFOM2MzcEdTR05VUm1wQ1JVUTJlR3BoYkVNNE1VZHdSRmROWldOTmFDdFVVREZqUTBORk1YUXpLM014U2psaVVsTkJjVmMzWmtKNlZrZDJTVU51YTI5WmRuaFZXVEp2YkdGUVdsWnNhRVZsYzFOdVNtZGhaVzltWWpjME9GTnVWV0p0WWxvMFR6Vmplbk5ZU2psS1N6QktibWx6VlRKclFWTnFjMkpaYmpsQk5VZFRkVGd5ZFdWT1hDOWpSMXBVWEM5T1hDOUxaVk5uVm1sNk0ySmhNRnd2Wkc4ekszSkJVeXN5VlhWdlIyVkdkMUJtWVZaU1kydHhibVpOYVU1RVJVWjJNM1ZLUkdsMlIxWlROVlV6YVdNelZrUlRiV2xuUlVWWE1TdHNXVnd2YkhKR1hDOTVObHd2WWxJckt6WlpRV1ZzWmxRNWQxZGhNRFJCV21oeVNYVlNSWFJJVVdzNE5sVm5SRVJJV0d0eU5YaDNjRVJvZUhOQ0sxcDNVMnhCVHl0bk1XZHpUV0Z2WTBvNVdqazJWV2xMZG10U1EyTkVRbHd2VERrM01tVllaMUptYWpCc2NXUldOSGsxZEhSeVV6bFJQVDBpTENKdFlXTWlPaUkwTWpKaE9EVXpOREk1TURRMlpEUTNOVFV3T1RsallqWXdaakZrWW1WaVpUWXpaVEkyTUdJeU16RTVObUpqWWpGbU4yRXhabUV3TXpGa056UTJOVFk0SW4wPSIsImlzcyI6ImVza2hhdGEuY29tIiwiZXhwIjoxNTQ5MDE4ODgxLCJzdWIiOiIiLCJhdWQiOiIifQ.KG9p8wV4ipjPscv-cj3Zux6Ad8G0yUozJptBVDrB3kk",
                        "timeout_to_enter_pin" => 300,
                    ],
                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Ошибка верификации СМС-кода",
                    "meta" => [
                        "sms_confirm_try_count" => 1,
                    ],
                ],
                'version' => '2',
                'group' => '17',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '19137340-3376-11e9-96f3-b06ebfbfa715',
                'name' => '1.8 Отправка Пин-кода для восстановления',
                'url_path' => '/api/v1/reset/pin/register',
                'method' => 'POST',
                'params' => '
                <b>code</b> - {1234} - Integer(4)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "photo_url" => null,
                        "msisdn" => 992921234567,
                        "first_name" => null,
                        "last_name" => null,
                        "middle_name" => null,
                        "date_birth" => null,
                        "gender" => -1,
                        "username" => "992921234567",
                        "email" => null,
                        "attestation_name" => "Неидентифицированный",
                        "qr_code" => "eyJzZXJ2aWNlX2lkIjoiOTZlOGI3ODUtYjFiOS0xMWU4LTkwNGItYjA2ZWJmYmZhNzE1IiwicGhvbmUiOiI5MjEyMzQ1NjcifQ==",
                        "accounts" => [
                            [
                                "balance" => 0,
                                "number" => "5100200010000179",
                                "currency_iso_name" => "TJS",
                                "account_type_name" => "Эсхата Онлайн",
                            ],
                        ],
                    ],
                    "meta" => [
                        "menu_version" => "19",
                        "push_token" => "d41d8cd98f00b204e9800998ecf8427e",
                        "access_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJazlVVkhWUFRETkdiM3BPVjFOeldVaEtRa1pvWjFFOVBTSXNJblpoYkhWbElqb2llV3BsUmpSSVNqUm1UMmhYVWxnM1lXSlFlVnd2UTFkd1lXMVBkRnd2WEM5MVJteFdiMjlvTTFwdFJXMUZObVZTWm1Sb2VuUnRkVkpvY1RaaGVreHhRVW80VUc1TmJVMDRRVWRWTlhWaFFVNXhZMWxUUWpaMVF6SjJaVFZpVGxob1JUQmtOMVEzV0Rad05HMVJNakJzUzBablZFdHJVVXR0Ym1NeVFYTjFXVU5FTkhCa1owTlhiekIyTjNBNWVVeDZUREpKVm5WVGJHZG5QVDBpTENKdFlXTWlPaUpsWmpNeE9EUmxZamxpWWpkalpUQm1OakUzTlRrMVlqZGpNMlZtWXpReE9ETTNNek16TmpjMU5qQXpZbUprWTJWaFpHWXhNVGMyWVRZNE9XVmxaV016SW4wPSIsImlzcyI6ImVza2hhdGEuY29tIiwiZXhwIjoxNTQ5MDE5NTQ1LCJzdWIiOiIiLCJhdWQiOiIifQ.x3HoiCFJm33JjJwyt3IwTgkUdXi7rAhZPyELs36EYnM",
                        "refresh_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJazlVVkhWUFRETkdiM3BPVjFOeldVaEtRa1pvWjFFOVBTSXNJblpoYkhWbElqb2llV3BsUmpSSVNqUm1UMmhYVWxnM1lXSlFlVnd2UTFkd1lXMVBkRnd2WEM5MVJteFdiMjlvTTFwdFJXMUZObVZTWm1Sb2VuUnRkVkpvY1RaaGVreHhRVW80VUc1TmJVMDRRVWRWTlhWaFFVNXhZMWxUUWpaMVF6SjJaVFZpVGxob1JUQmtOMVEzV0Rad05HMVJNakJzUzBablZFdHJVVXR0Ym1NeVFYTjFXVU5FTkhCa1owTlhiekIyTjNBNWVVeDZUREpKVm5WVGJHZG5QVDBpTENKdFlXTWlPaUpsWmpNeE9EUmxZamxpWWpkalpUQm1OakUzTlRrMVlqZGpNMlZtWXpReE9ETTNNek16TmpjMU5qQXpZbUprWTJWaFpHWXhNVGMyWVRZNE9XVmxaV016SW4wPSIsImlzcyI6ImVza2hhdGEuY29tIiwiZXhwIjoxNTUxNzgzMzI1LCJzdWIiOiIiLCJhdWQiOiIifQ.WM6HAVk-9HWyhZu3CN8wDWHGB1Ju_XBg1lk1krBXsVM",
                        "expire_in" => 16,
                        "is_editable" => 1,
                    ],
                ],
                'response_reject_json' => [
                    "code" => 5,
                    "meta" => [
                        "pin_confirm_try_count" => 1,
                        "wait_seconds" => 60,
                    ],
                ],
                'version' => '1',
                'group' => '18',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'b4722ae1-c236-11e9-a12f-b06ebfbfa715',
                'name' => '1.8 Отправка Пин-кода для восстановления',
                'url_path' => '/api/v2/reset/pin/register',
                'method' => 'POST',
                'params' => '
                <b>code</b> - {1234} - Integer(4)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "photo_url" => null,
                        "msisdn" => 992921234567,
                        "first_name" => null,
                        "last_name" => null,
                        "middle_name" => null,
                        "date_birth" => null,
                        "gender" => -1,
                        "username" => "992921234567",
                        "email" => null,
                        "attestation_name" => "Неидентифицированный",
                        "qr_code" => "eyJzZXJ2aWNlX2lkIjoiOTZlOGI3ODUtYjFiOS0xMWU4LTkwNGItYjA2ZWJmYmZhNzE1IiwicGhvbmUiOiI5MjEyMzQ1NjcifQ==",
                        "accounts" => [
                            [
                                "balance" => 0,
                                "number" => "5100200010000179",
                                "currency_iso_name" => "TJS",
                                "account_type_name" => "Эсхата Онлайн",
                            ],
                        ],
                    ],
                    "meta" => [
                        "menu_version" => "19",
                        "push_token" => "d41d8cd98f00b204e9800998ecf8427e",
                        "access_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJazlVVkhWUFRETkdiM3BPVjFOeldVaEtRa1pvWjFFOVBTSXNJblpoYkhWbElqb2llV3BsUmpSSVNqUm1UMmhYVWxnM1lXSlFlVnd2UTFkd1lXMVBkRnd2WEM5MVJteFdiMjlvTTFwdFJXMUZObVZTWm1Sb2VuUnRkVkpvY1RaaGVreHhRVW80VUc1TmJVMDRRVWRWTlhWaFFVNXhZMWxUUWpaMVF6SjJaVFZpVGxob1JUQmtOMVEzV0Rad05HMVJNakJzUzBablZFdHJVVXR0Ym1NeVFYTjFXVU5FTkhCa1owTlhiekIyTjNBNWVVeDZUREpKVm5WVGJHZG5QVDBpTENKdFlXTWlPaUpsWmpNeE9EUmxZamxpWWpkalpUQm1OakUzTlRrMVlqZGpNMlZtWXpReE9ETTNNek16TmpjMU5qQXpZbUprWTJWaFpHWXhNVGMyWVRZNE9XVmxaV016SW4wPSIsImlzcyI6ImVza2hhdGEuY29tIiwiZXhwIjoxNTQ5MDE5NTQ1LCJzdWIiOiIiLCJhdWQiOiIifQ.x3HoiCFJm33JjJwyt3IwTgkUdXi7rAhZPyELs36EYnM",
                        "refresh_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJazlVVkhWUFRETkdiM3BPVjFOeldVaEtRa1pvWjFFOVBTSXNJblpoYkhWbElqb2llV3BsUmpSSVNqUm1UMmhYVWxnM1lXSlFlVnd2UTFkd1lXMVBkRnd2WEM5MVJteFdiMjlvTTFwdFJXMUZObVZTWm1Sb2VuUnRkVkpvY1RaaGVreHhRVW80VUc1TmJVMDRRVWRWTlhWaFFVNXhZMWxUUWpaMVF6SjJaVFZpVGxob1JUQmtOMVEzV0Rad05HMVJNakJzUzBablZFdHJVVXR0Ym1NeVFYTjFXVU5FTkhCa1owTlhiekIyTjNBNWVVeDZUREpKVm5WVGJHZG5QVDBpTENKdFlXTWlPaUpsWmpNeE9EUmxZamxpWWpkalpUQm1OakUzTlRrMVlqZGpNMlZtWXpReE9ETTNNek16TmpjMU5qQXpZbUprWTJWaFpHWXhNVGMyWVRZNE9XVmxaV016SW4wPSIsImlzcyI6ImVza2hhdGEuY29tIiwiZXhwIjoxNTUxNzgzMzI1LCJzdWIiOiIiLCJhdWQiOiIifQ.WM6HAVk-9HWyhZu3CN8wDWHGB1Ju_XBg1lk1krBXsVM",
                        "expire_in" => 16,
                        "is_editable" => 1,
                    ],
                ],
                'response_reject_json' => [
                    "code" => 5,
                    "meta" => [
                        "pin_confirm_try_count" => 1,
                        "wait_seconds" => 60,
                    ],
                ],
                'version' => '2',
                'group' => '18',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'fa2b9de3-3376-11e9-96f3-b06ebfbfa715',
                'name' => '1.9 Запрос на получение нового токена',
                'url_path' => '/api/v1/refresh',
                'method' => 'POST',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "push_token" => "9dff58531505c5862ad920db23ad719d",
                        "access_token" => "qaJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJblJZTUhWelVXSmxTVmxaVVU1Sksxb3liVUV5UW1jOVBTSXNJblpoYkhWbElqb2lOVzFWZUVaeVJYWmxjVWRaUkdSTGVrVjJlVlkwVVZ3dlJtOTBRVEZLZDJJNVVucFhWVGMyY1hrMGNrOHdkalZXTUVrM1pHNHlOVWhxTkV0RFpVaFJXa3hHTlhkVk5GTkxhMHdyWjNCa1dVazVNa3Q2VlhKU2JWVnpTSGxoYkhRek1WbE5aMUpwUkRKUlRVbFFaRmw0Y1ZOaFZGSlVNVUUwV0RadlExSk5hblZDZEVGRFJ6TjJVR2wzUkhodVIzUlVlRzFXVVVKc2R6MDlJaXdpYldGaklqb2lZMkppT0RjeE5qSXdaVFZrTm1Zd00yUTFaVE5qTkRJMk5XWXhOams1WkdJMU1UZzRNMkZrWVRsbVltSmlNalF3TldNd1pXVXhabUppTmprME5EUTFOeUo5IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NDkyODA1NzEsInN1YiI6IiIsImF1ZCI6IiJ9.5qFJDPEAiyJ470Gkq5U_XhVGFJ3y_vpCa9auaTc_UyY",
                        "refresh_token" => "qaJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJblJZTUhWelVXSmxTVmxaVVU1Sksxb3liVUV5UW1jOVBTSXNJblpoYkhWbElqb2lOVzFWZUVaeVJYWmxjVWRaUkdSTGVrVjJlVlkwVVZ3dlJtOTBRVEZLZDJJNVVucFhWVGMyY1hrMGNrOHdkalZXTUVrM1pHNHlOVWhxTkV0RFpVaFJXa3hHTlhkVk5GTkxhMHdyWjNCa1dVazVNa3Q2VlhKU2JWVnpTSGxoYkhRek1WbE5aMUpwUkRKUlRVbFFaRmw0Y1ZOaFZGSlVNVUUwV0RadlExSk5hblZDZEVGRFJ6TjJVR2wzUkhodVIzUlVlRzFXVVVKc2R6MDlJaXdpYldGaklqb2lZMkppT0RjeE5qSXdaVFZrTm1Zd00yUTFaVE5qTkRJMk5XWXhOams1WkdJMU1UZzRNMkZrWVRsbVltSmlNalF3TldNd1pXVXhabUppTmprME5EUTFOeUo5IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NTIwNDQzNTEsInN1YiI6IiIsImF1ZCI6IiJ9.4ob-RpRCvUk45DmKfSuJu9it1dlS901uMdWE1gFrNc8",
                        "expire_in" => 16,
                    ],
                ],
                'response_reject_json' => [
                    "code" => 5,
                    "message" => "Ошибка авторизации",
                ],
                'version' => '1',
                'group' => '19',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '05cfc25f-35d1-11e9-96f3-b06ebfbfa715',
                'name' => '1.9 Запрос на получение нового токена',
                'url_path' => '/api/v2/refresh',
                'method' => 'POST',
                'params' => '
                {
                    "device":{
                        "id":"41DC2FA0-9688-4DBF-AFF0-494774476B4112",
                        "name":"iphone 20",
                        "model":"iphone 10",
                        "type":"iphone",
                        "appVersion":"1.2.0",
                        "appMenuVersion":"0.1.1",
                        "platform":0,
                        "os":"IOS"
                    }
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "push_token" => "9dff58531505c5862ad920db23ad719d",
                        "access_token" => "qaJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJblJZTUhWelVXSmxTVmxaVVU1Sksxb3liVUV5UW1jOVBTSXNJblpoYkhWbElqb2lOVzFWZUVaeVJYWmxjVWRaUkdSTGVrVjJlVlkwVVZ3dlJtOTBRVEZLZDJJNVVucFhWVGMyY1hrMGNrOHdkalZXTUVrM1pHNHlOVWhxTkV0RFpVaFJXa3hHTlhkVk5GTkxhMHdyWjNCa1dVazVNa3Q2VlhKU2JWVnpTSGxoYkhRek1WbE5aMUpwUkRKUlRVbFFaRmw0Y1ZOaFZGSlVNVUUwV0RadlExSk5hblZDZEVGRFJ6TjJVR2wzUkhodVIzUlVlRzFXVVVKc2R6MDlJaXdpYldGaklqb2lZMkppT0RjeE5qSXdaVFZrTm1Zd00yUTFaVE5qTkRJMk5XWXhOams1WkdJMU1UZzRNMkZrWVRsbVltSmlNalF3TldNd1pXVXhabUppTmprME5EUTFOeUo5IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NDkyODA1NzEsInN1YiI6IiIsImF1ZCI6IiJ9.5qFJDPEAiyJ470Gkq5U_XhVGFJ3y_vpCa9auaTc_UyY",
                        "refresh_token" => "qaJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJblJZTUhWelVXSmxTVmxaVVU1Sksxb3liVUV5UW1jOVBTSXNJblpoYkhWbElqb2lOVzFWZUVaeVJYWmxjVWRaUkdSTGVrVjJlVlkwVVZ3dlJtOTBRVEZLZDJJNVVucFhWVGMyY1hrMGNrOHdkalZXTUVrM1pHNHlOVWhxTkV0RFpVaFJXa3hHTlhkVk5GTkxhMHdyWjNCa1dVazVNa3Q2VlhKU2JWVnpTSGxoYkhRek1WbE5aMUpwUkRKUlRVbFFaRmw0Y1ZOaFZGSlVNVUUwV0RadlExSk5hblZDZEVGRFJ6TjJVR2wzUkhodVIzUlVlRzFXVVVKc2R6MDlJaXdpYldGaklqb2lZMkppT0RjeE5qSXdaVFZrTm1Zd00yUTFaVE5qTkRJMk5XWXhOams1WkdJMU1UZzRNMkZrWVRsbVltSmlNalF3TldNd1pXVXhabUppTmprME5EUTFOeUo5IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NTIwNDQzNTEsInN1YiI6IiIsImF1ZCI6IiJ9.4ob-RpRCvUk45DmKfSuJu9it1dlS901uMdWE1gFrNc8",
                    ],
                ],
                'response_reject_json' => [
                    "code" => 16,
                    "message" => "Срок токена истек!",
                ],
                'version' => '2',
                'group' => '19',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '5bf85e55-3379-11e9-96f3-b06ebfbfa715',
                'name' => '1.10 Выход из приложения',
                'url_path' => '/api/v1/logout',
                'method' => 'POST',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '20',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '64d17d07-35d3-11e9-96f3-b06ebfbfa715',
                'name' => '1.10 Выход из приложения',
                'url_path' => '/api/v2/logout',
                'method' => 'POST',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '20',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'e7387103-3379-11e9-96f3-b06ebfbfa715',
                'name' => '1.11 Установка токена для push - уведомлений',
                'url_path' => '/api/v1/push/token',
                'method' => 'POST',
                'params' => '
                <b>token</b> - String',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '21',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '47582589-35d3-11e9-96f3-b06ebfbfa715',
                'name' => '1.11 Установка токена для push - уведомлений',
                'url_path' => '/api/v2/push/token',
                'method' => 'POST',
                'params' => '
                <b>token</b> - String

                Пример
                {
                    "token": "emLEToXkVSw:APA91bGydxOu6CQOpXWdkdUrXmV_DcoLagTSyp5gVB_JU1LDEVL20j-80i4MHCnBi9tHzmzX_xLMqEQJ3CYVw6IA_PNTg-MAzPQLg_qdt4xPaL5UEHL5q5BuahPrZWA5lp2hwdAHyaNd123456"
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '21',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '98266d32-bf4b-11e9-a12f-b06ebfbfa715',
                'name' => '1.12 Отправка Пароля для регистрации (для веба)',
                'url_path' => '/api/v2/register/password',
                'method' => 'POST',
                'params' => 'Дальнейшая связь между сервером происходит через access_token. 

                <b>password</b> - {123456Aa} - String(8,30)

                ПРИМЕР:

                {
                    password:"Test1234"
                }

                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "photo_url" => "url",
                        "msisdn" => 992921234567,
                        "first_name" => "Test",
                        "last_name" => "Test2",
                        "middle_name" => "Test3",
                        "date_birth" => "2019-02-01",
                        "gender" => -1,
                        "username" => "992921234567",
                        "email" => "test@gmail.com",
                        "attestation_name" => "Неидентифицированный",
                        "qr_code" => "eyJzZXJ2aWNlX2lkIjoiOTZlOGI3ODUtYjFiOS0xMWU4LTkwNGItYjA2ZWJmYmZhNzE1IiwicGhvbmUiOiI5MjEyMzQ1NjcifQ==",
                        "accounts" => [
                            [
                                "balance" => 0,
                                "number" => 5100200010000179,
                                "currency_iso_name" => "TJS",
                                "account_type_name" => "Эсхата Онлайн",
                            ],
                        ],
                    ],
                    "meta" => [
                        "is_editable" => 1,
                        "menu_version" => "19",
                        "push_token" => "d41d8cd98f00b204e9800998ecf8427e",
                        "access_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbXhxZVZoTFUwczJSM2w0UzJ0d1NEZHBUbXh1Tm1jOVBTSXNJblpoYkhWbElqb2lUM2hFZWpCR2NrbE9XRFowYzBWamVtUlNla0ZSUkVWMFRESkxTbTVVVDBKUmVYQXdYQzl2UTI4eE9VcDZjMjl0YVhrd1lsQmpabXBFYWtwc1pUY3JkMEZGYVdKT2RERTJNM2N4TUZwWmExcG9kbTVHUjFVd1JFczNkVzkwUlRKUlNWbDZTRkZDYzNOV2JYaDFiRWx2WjJjNEsxZFpXbWRtWWxCWFRUZDZZVU5hWkZabGFtZENTREpyVTNWS01FUTVPSHBKVDJaemR6MDlJaXdpYldGaklqb2lNMkkxTlRnM1pqQmhNREJrWW1Wak9Ua3dZVE5pT0dZM05EQmpNV0ZsTVRJMU5tUTROekkyWmpSaE5tSXpOekZoTUdJeE9XTmhNR1ExTlRVMlltUXpOQ0o5IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NDkwMTkzMTgsInN1YiI6IiIsImF1ZCI6IiJ9.v6rirHkKIdOO8GMn8wDHwEnx55xKYC7f1Gh8-F7GNsc",
                        "refresh_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJbXhxZVZoTFUwczJSM2w0UzJ0d1NEZHBUbXh1Tm1jOVBTSXNJblpoYkhWbElqb2lUM2hFZWpCR2NrbE9XRFowYzBWamVtUlNla0ZSUkVWMFRESkxTbTVVVDBKUmVYQXdYQzl2UTI4eE9VcDZjMjl0YVhrd1lsQmpabXBFYWtwc1pUY3JkMEZGYVdKT2RERTJNM2N4TUZwWmExcG9kbTVHUjFVd1JFczNkVzkwUlRKUlNWbDZTRkZDYzNOV2JYaDFiRWx2WjJjNEsxZFpXbWRtWWxCWFRUZDZZVU5hWkZabGFtZENTREpyVTNWS01FUTVPSHBKVDJaemR6MDlJaXdpYldGaklqb2lNMkkxTlRnM1pqQmhNREJrWW1Wak9Ua3dZVE5pT0dZM05EQmpNV0ZsTVRJMU5tUTROekkyWmpSaE5tSXpOekZoTUdJeE9XTmhNR1ExTlRVMlltUXpOQ0o5IiwiaXNzIjoiZXNraGF0YS5jb20iLCJleHAiOjE1NTE3ODMwOTgsInN1YiI6IiIsImF1ZCI6IiJ9.ci-KKSWNUdr85hwCivoR1DUypGDRjC6d71Cs5UAZ4FQ",
                    ],

                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '21.1',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'bbd9c29c-bf4b-11e9-a12f-b06ebfbfa715',
                'name' => '1.13 Отправка Пароля для авторизации (для веба)',
                'url_path' => '/api/v2/auth/password',
                'method' => 'POST',
                'params' => '
                <b>password</b> - {Test1234} - String(8,30)

                ПРИМЕР:

                {
                    "password":"Test1234"
                }

                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "photo_url" => "https://domain/imgs/users/400x/d85e8876-b47c-4327-a87e-e32dfaf4cd2c_2018-11-16_20-27-14-450556.jpg",
                        "msisdn" => 992920000000,
                        "first_name" => "Тест",
                        "last_name" => "Тест",
                        "middle_name" => "Тест",
                        "date_birth" => "1990-01-01",
                        "gender" => 1,
                        "username" => "992920000000",
                        "email" => "test@gmail.com",
                        "attestation_name" => "Идентифицированный",
                        "qr_code" => "qaJzZXJ2aWNlX2lkIjoiOTZlOGI3ODUtYjFiOS0xMWU4LTkwNGItYjA2ZWJmYmZhNzE1IiwicGhvbmUiOiI5MjYxNjQ0MzYifQ==",
                        "accounts" => [
                            [
                                "balance" => 2.5,
                                "number" => 5100200010000001,
                                "currency_iso_name" => "TJS",
                                "account_type_name" => "Эсхата Онлайн",
                            ],
                        ],
                    ],
                    "meta" => [
                        "is_editable" => 0,
                        "menu_version" => "19",
                        "push_token" => "d41d8cd98f00b204e9800998ecf8427e",
                        "access_token" => "ghJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJa1pSWEM5SU9HVm5SVk5hTnpKM1JWTTNNbWN4ZVZ3dmR6MDlJaXdpZG1Gc2RXVWlPaUpRT1hKSE9FZDNTREZvVm1ocVZYWlRWM2xvTVN0VVZESTJkMnhUWm1KeU5sd3ZURFZjTDNSbmNWQTFSa3R1YUZNMVIwWnhLMUZUZFVnMFVWWkRkazV3TUZSSVUzZElYQzlsTVVzMWJFWndhSEJuVTFJcmFGZEhTMmxjTHpGeGJGSnlUM1k1U21sTk16WmlWVUo1SzNBeWNFOUthR1oyU1hjNVpqQjVTWFYxZDFselJUZDNUelJTZVVsR05qSlJWbFpOU0RCdlRHWk9NVUZSUFQwaUxDSnRZV01pT2lJME5HWTJZbVV4T1RJM05XTmxNekF4TkRJMVlUazJZamt3TTJFMlpEUmhPVE5rTmpReE1UVm1PRE5tTm1FM01UUmtNRGsxWWpNNU56RmtPV000TnpBMkluMD0iLCJpc3MiOiJlc2toYXRhLmNvbSIsImV4cCI6MTU0OTI4MDA2OCwic3ViIjoiIiwiYXVkIjoiIn0.-r8jLTGV7oNT4sG_grdkEz80QPt8_PB9QgC_Av_CQBY",
                        "refresh_token" => "weJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJa1pSWEM5SU9HVm5SVk5hTnpKM1JWTTNNbWN4ZVZ3dmR6MDlJaXdpZG1Gc2RXVWlPaUpRT1hKSE9FZDNTREZvVm1ocVZYWlRWM2xvTVN0VVZESTJkMnhUWm1KeU5sd3ZURFZjTDNSbmNWQTFSa3R1YUZNMVIwWnhLMUZUZFVnMFVWWkRkazV3TUZSSVUzZElYQzlsTVVzMWJFWndhSEJuVTFJcmFGZEhTMmxjTHpGeGJGSnlUM1k1U21sTk16WmlWVUo1SzNBeWNFOUthR1oyU1hjNVpqQjVTWFYxZDFselJUZDNUelJTZVVsR05qSlJWbFpOU0RCdlRHWk9NVUZSUFQwaUxDSnRZV01pT2lJME5HWTJZbVV4T1RJM05XTmxNekF4TkRJMVlUazJZamt3TTJFMlpEUmhPVE5rTmpReE1UVm1PRE5tTm1FM01UUmtNRGsxWWpNNU56RmtPV000TnpBMkluMD0iLCJpc3MiOiJlc2toYXRhLmNvbSIsImV4cCI6MTU1MjA0Mzg0OCwic3ViIjoiIiwiYXVkIjoiIn0.LHoK4Wr5wfOLP0tnpczwCO5GwSNBWHcgXghPguIBEvM",
                    ],
                ],
                'response_reject_json' => [
                    "code" => 5,
                    "meta" => [
                        "pin_confirm_try_count" => 1,
                        "wait_seconds" => 60,
                    ],
                ],
                'version' => '2',
                'group' => '21.2',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],

            [
                'id' => '6442313a-bf4e-11e9-a12f-b06ebfbfa715',
                'name' => '1.14 Отправка Пароля для авторизации',
                'url_path' => '/api/v2/auth/password',
                'method' => 'POST',
                'params' => '
                <b>password</b> - {Test1234} - String(8,30)

                ПРИМЕР:

                {
                    "password":"Test1234"
                }

                ',
                'response_success_json' => [
                    "code" => 0,
                    
                    "meta" => [
                        "temporary_token" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiUTJaRVNqaE1XV3BYUm1aQ2VVbGtTSE5MUzJwZk9GcDFVM0F5WDJsdFltOXhibDgyUkhVMk1UZERPVGxoYVVKcWFqTkVNR3BsZEhsVVFrZEdXVUZwY1VFNGVFcFliakZQUjJFMFJYWm1YM2hPTkZNNFNVbDJURGhyYkhsb2VtbGxWR3gyUWpGa2RraE9XSHBXT1hkalQyNXdiR2h3TkhCZlMwRkpWSFZ3TVdoeldteHhObmc0VFVOSk1GbFlVa1l0YXpORlpsVXlTVjlCVXpkNVFVMURPSEUzV1RWWmNWWjVjRE53VGtRNGJ5MW9XRVkxY1UxMlZXbzNZM0J0UTNsVVNUVnlaa0pSVTFNNU5saHBNVlF3ZUhCUmRFMTJVMVYzVlVWS1duVmllR3c0ZEdKUVJGaHhiVzlSY2xCU1dFWndTbG8xYjFWUFFqRjBVbGRQU1MxVGVrWTBWMVpVUW05amIweHdVSEl0TjBSb1UyVTVhVmRuVFZwSGNXVkdWbWc1VVVkbFlUTm1jVkpUU25WeFVISlJPR2xmV2xwcmRsQlBaazF0Y2xSVFoxQmpXakZYVFhsaGJrbFpRVFZpU0hkQlNHd3hiRmRoYlU5V1JUSnpTMlZxYVZsbU9UTnRka2t3VWxGUlFtdEZlVUo1YWxSQ2JXeEphV3haYlhaclVWY3RVVEJCVlVwMlpFWndVVWxoYjJwWlkzaENXR2RoY1VOcE5WSnIiLCJleHAiOjE1NjY2MzkzNDAsImlzcyI6ImVza2hhdGEuY29tIn0.Z2OOTpH7mhvjeqrDDjgrCDDaNmreU6VuGOBagAcYDpM",
                        "next_step" => 5
                    ],
                ],
                'response_reject_json' => [
                    "code" => 5,
                    "meta" => [
                        "pin_confirm_try_count" => 1,
                        "wait_seconds" => 60,
                    ],
                ],
                'version' => '2',
                'group' => '21.3',
                'doc_api_category_id' => 'e732c08d-2f7f-11e9-96f3-b06ebfbfa715',
            ],



            [
                'id' => '1f3e025e-337a-11e9-96f3-b06ebfbfa715',
                'name' => '2.1 Запрос основных данных пользователя',
                'url_path' => '/api/v1/users/main',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "photo_url" => null,
                        "msisdn" => 992928553004,
                        "first_name" => "TEST_NAME_CLIENT_2",
                        "last_name" => "TEST_LASTNAME_CLIENT_2",
                        "middle_name" => "123",
                        "date_birth" => "2019-01-12",
                        "gender" => 1,
                        "username" => "992928553004",
                        "email" => "td.brainiac@gmail.com",
                        "attestation_name" => "Идентифицированный",
                        "qr_code" => "eyJzZXJ2aWNlX2lkIjoiOTZlOGI3ODUtYjFiOS0xMWU4LTkwNGItYjA2ZWJmYmZhNzE1IiwicGhvbmUiOiI5Mjg1NTMwMDQifQ==",
                        "accounts" => [
                            [
                                "balance" => 1000,
                                "number" => "2222222222222222",
                                "currency_iso_name" => "TJS",
                                "account_type_name" => "Эсхата Онлайн",
                            ],
                        ],
                    ],
                    "meta" => [
                        "menu_version" => "18",
                        "app_version" => "1.0.0",
                        "is_editable" => 0,
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '22',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '851a65da-34ea-11e9-96f3-b06ebfbfa715',
                'name' => '2.1 Запрос основных данных пользователя',
                'url_path' => '/api/v2/users/main',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" =>  0,
                    "data" =>  [
                        "photo_url" =>  null,
                        "msisdn" =>  992922000000,
                        "first_name" =>  "Тест",
                        "last_name" =>  "Тестов",
                        "middle_name" =>  "Тестович",
                        "date_birth" =>  "1992-01-01",
                        "gender" =>  1,
                        "username" =>  "992922000000",
                        "email" =>  null,
                        "attestation_name" =>  "Идентифицированный",
                        "qr_code" =>  "eyJzZXJ2aWNlX2lkIjoiOTZlOGI3ODUtYjFiOS0xMWU4LTkwNGItYjA2ZWJmYmZhNzE1IiwicGhvbmUiOiI5MjIwMDU1NDQifQ==",
                        "accounts" =>  [
                            [
                                "id" =>  "337bdffb-bb4f-4141-ab02-89d8892b829a",
                                "name" =>  null,
                                "balance" =>  0.0000,
                                "number" =>  "992922000000",
                                "currency_iso_name" =>  "TJS",
                                "account_type_name" =>  "Эсхата Онлайн",
                                "account_category_type_code" =>  "EWALLET",
                                "account_status_name" =>  "Рабочая",
                                "account_status_code" =>  "WORKING",
                                "is_own" =>  true,
                                "is_sync" =>  false,
                                "back_color" =>  "#FFFFFF",
                                "font_color" =>  "#003661",
                                "img" =>  "maincard_wallet.png",
                                "header" =>  null,
                                "percentage" =>  null
                            ]
                        ]
                    ],
                    "meta" =>  [
                        "is_editable" =>  0,
                        "menu_version" =>  "223",
                        "app_version" =>  "1.0.0",
                        "sync_params" =>  [
                            "try_interval" =>  3,
                            "job_id" =>  "3b21e65a-aab7-450b-9141-f290b55154b7"
                        ]
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '22',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '75871369-337a-11e9-96f3-b06ebfbfa715',
                'name' => '2.2 Отправка данных пользователя для изменения',
                'url_path' => '/api/v1/users',
                'method' => 'PUT',
                'params' => '
                <b>first_name</b> - String(30)
                <b>last_name</b> - String(30)
                <b>middle_name</b> - String(30)
                <b>date_birth</b> - String(30)
                <b>gender</b> - Integer(1)
                <b>photo</b> - File
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "photo_url" => "http://localhost/laravel-ewallet/public/imgs/users/400x/048050db-0625-42ea-8520-4746bb50a847_2019-02-01_17-33-21-605798.jpg",
                        "msisdn" => 992928553004,
                        "first_name" => "123",
                        "last_name" => "123",
                        "middle_name" => "123",
                        "date_birth" => "1992-06-25",
                        "gender" => 1,
                        "username" => "992928553004",
                        "email" => "test@gmail.com",
                        "attestation_name" => "Неидентифицированный",
                        "qr_code" => "eyJzZXJ2aWNlX2lkIjoiOTZlOGI3ODUtYjFiOS0xMWU4LTkwNGItYjA2ZWJmYmZhNzE1IiwicGhvbmUiOiI5Mjg1NTMwMDQifQ==",
                        "accounts" => [
                            [
                                "balance" => 1000,
                                "number" => "2222222222222222",
                                "currency_iso_name" => "TJS",
                                "account_type_name" => "Эсхата Онлайн",
                            ],
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '23',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '6220ca2b-34f2-11e9-96f3-b06ebfbfa715',
                'name' => '2.2 Отправка данных пользователя для изменения',
                'url_path' => '/api/v2/users',
                'method' => 'POST',
                'params' => '
                <b>first_name</b> - String(30)
                <b>last_name</b> - String(30)
                <b>middle_name</b> - String(30)
                <b>date_birth</b> - String(30)
                <b>gender</b> - Integer(1)
                <b>photo</b> - File

                Пример:
                {
                    "first_name": "Имя",
                    "last_name": "Фамилия",
                    "middle_name": "Отчество",
                    "date_birth": "1992-06-24",
                    "gender": "1",
                    "photo": "",
                }
                ',
                'response_success_json' => [
                    "code" =>  0,
                    "data" =>  [
                        "photo_url" =>  "http://10.10.2.201/imgs/users/400x/d02cd8fe-c25b-43d9-bad1-3fa88e0fc76a_2019-08-18_17-37-45.274452.png",
                        "msisdn" =>  992922000000,
                        "first_name" =>  "123",
                        "last_name" =>  "123",
                        "middle_name" =>  "123",
                        "date_birth" =>  "1992-01-10",
                        "gender" =>  0,
                        "username" =>  "992922000000",
                        "email" =>  null,
                        "attestation_name" =>  "Неидентифицированный",
                        "qr_code" =>  "eyJzZXJ2aWNlX2lkIjoiOTZlOGI3ODUtYjFiOS0xMWU4LTkwNGItYjA2ZWJmYmZhNzE1IiwicGhvbmUiOiI5MjIwMDU1NDQifQ==",
                        "accounts" =>  [
                            [
                                "id" =>  "337bdffb-bb4f-4141-ab02-89d8892b829a",
                                "name" =>  null,
                                "balance" =>  0.0000,
                                "number" =>  "992922000000",
                                "currency_iso_name" =>  "TJS",
                                "account_type_name" =>  "Эсхата Онлайн",
                                "account_category_type_code" =>  "EWALLET",
                                "account_status_name" =>  "Рабочая",
                                "account_status_code" =>  "WORKING",
                                "is_own" =>  true,
                                "is_sync" =>  false,
                                "back_color" =>  "#FFFFFF",
                                "font_color" =>  "#003661",
                                "img" =>  "maincard_wallet.png",
                                "header" =>  null,
                                "percentage" =>  null
                            ],
                            
                        ]
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '23',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '935f2e61-337c-11e9-96f3-b06ebfbfa715',
                'name' => '2.3 Запрос текущего баланса - (Не используется)',
                'url_path' => '/api/v1/accounts/summary/{account_number}',
                'method' => 'GET',
                'params' => '
                <b>account_number</b> - String(30)
                ',
                'response_success_json' => [
                    "code" => "0",
                    "data" => [
                        "balance" => 1000,
                        "number" => "2222222222222222",
                        "currency_iso_name" => "TJS",
                        "account_type_name" => "Эсхата Онлайн",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '24',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'f4391c6f-3697-11e9-96f3-b06ebfbfa715',
                'name' => '2.3 Запрос текущего баланса - (Не используется)',
                'url_path' => '/api/v2/accounts/summary/{account_number}',
                'method' => 'GET',
                'params' => '
                <b>account_number</b> - String(30)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "balance" => 1000,
                            "number" => 2222222222222222,
                            "currency_iso_name" => "TJS",
                            "account_type_name" => "Эсхата Онлайн",
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '24',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'ec2bd759-337c-11e9-96f3-b06ebfbfa715',
                'name' => '2.4 Запрос текущего баланса с текущими состояниями лимитов - (Не используется)',
                'url_path' => '/api/v1/accounts/{account_number}',
                'method' => 'GET',
                'params' => '
                <b>account_number</b> - String(30)
                ',
                'response_success_json' => [
                    "code" => "0",
                    "data" => [
                        "balance" => 1000,
                        "number" => "2222222222222222",
                        "currency_iso_name" => "TJS",
                        "account_type_name" => "Эсхата Онлайн",
                        "current_limits" => [
                            "day_limit" => 1000,
                            "week_limit" => 2500,
                            "month_limit" => 2500,
                            "balance_limit" => 0,
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '25',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'ea90be71-3698-11e9-96f3-b06ebfbfa715',
                'name' => '2.4 Запрос текущего баланса с текущими состояниями лимитов - (Не используется)',
                'url_path' => '/api/v2/accounts/{account_number}',
                'method' => 'GET',
                'params' => '
                <b>account_number</b> - String(30)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "balance" => 1000,
                            "number" => 2222222222222222,
                            "currency_iso_name" => "TJS",
                            "account_type_name" => "Эсхата Онлайн",
                            "current_limits" => [
                                "day_limit" => 1000,
                                "week_limit" => 2500,
                                "month_limit" => 2500,
                                "balance_limit" => 0,
                            ],
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '25',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '28aae3dc-340b-11e9-96f3-b06ebfbfa715',
                'name' => '2.5 Запрос списка типов аттестата',
                'url_path' => '/api/v1/attestations',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" =>  0,
                    "data" =>  [
                        [
                            "name" =>  "Неидентифицированный",
                            "code" =>  "NOT_IDENTIFIED",
                            "day_limit" =>  1100.0,
                            "week_limit" =>  2750.0,
                            "month_limit" =>  2750.0,
                            "balance_limit" =>  1100.0,
                            "is_active" =>  true,
                            "used_limit" =>  [
                                "day" =>  [
                                    "limit" =>  0.0,
                                    "updated_at" =>  "0001-01-01 00:00:00"
                                ],
                                "week" =>  [
                                    "limit" =>  0.0,
                                    "updated_at" =>  "0001-01-01 00:00:00"
                                ],
                                "month" =>  [
                                    "limit" =>  0.0,
                                    "updated_at" =>  "0001-01-01 00:00:00"
                                ]
                            ]
                        ],
                        [
                            "name" =>  "Идентифицированный",
                            "code" =>  "IDENTIFIED",
                            "day_limit" =>  25000.0,
                            "week_limit" =>  25000.0,
                            "month_limit" =>  25000.0,
                            "balance_limit" =>  10000.0,
                            "is_active" =>  false,
                            "used_limit" =>  null
                        ]
                    ]
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '26',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'c687f9f6-34e6-11e9-96f3-b06ebfbfa715',
                'name' => '2.5 Запрос списка типов аттестата',
                'url_path' => '/api/v2/attestations',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "name" => "Неидентифицированный",
                            "code" => "NOT_IDENTIFIED",
                            "day_limit" => 1000,
                            "week_limit" => 2500,
                            "month_limit" => 2500,
                            "balance_limit" => 1000,
                            "is_active" => true,
                            "used_limit" => [
                                "day" => [
                                    "limit" => 10,
                                    "updated_at" => "2019-02-04 11:33:49",
                                ],
                                "week" => [
                                    "limit" => 10,
                                    "updated_at" => "2019-02-04 11:33:49",
                                ],
                                "month" => [
                                    "limit" => 10,
                                    "updated_at" => "2019-02-04 11:33:49",
                                ],
                            ],
                        ],
                        [
                            "name" => "Идентифицированный",
                            "code" => "IDENTIFIED",
                            "day_limit" => 25000,
                            "week_limit" => 25000,
                            "month_limit" => 25000,
                            "balance_limit" => 10000,
                            "is_active" => false,
                            "used_limit" => null,
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '26',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '69d1a9e0-340b-11e9-96f3-b06ebfbfa715',
                'name' => '2.6 Подтверждение данных аттестации',
                'url_path' => '/api/v1/attestations/confirmation',
                'method' => 'POST',
                'params' => '
                <b>id</b> - String(32)
                <b>confirm</b> - Integer(1)
                ',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '27',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'f8e605b2-34e9-11e9-96f3-b06ebfbfa715',
                'name' => '2.6 Подтверждение данных аттестации',
                'url_path' => '/api/v2/attestations/confirmation',
                'method' => 'POST',
                'params' => '
                <b>id</b> - String(32)
                <b>confirm</b> - Integer(1)
                ',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '27',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'ca7a4543-340b-11e9-96f3-b06ebfbfa715',
                'name' => '2.7 Изменение Пин-кода',
                'url_path' => '/api/v1/settings/pin/change',
                'method' => 'PUT',
                'params' => '
                <b>old_pin_hash</b> - String(32)
                <b>new_pin</b> - String(4)
                ',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '28',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'a4bb7ce2-35d3-11e9-96f3-b06ebfbfa715',
                'name' => '2.7 Изменение Пин-кода',
                'url_path' => '/api/v2/settings/pin/change',
                'method' => 'POST',
                'params' => '
                <b>old_pin_hash</b> - String(32)
                <b>new_pin</b> - String(4)

                Пример
                {
                    "old_hash_code":"F45F6760AAB9D413B6EA16A3800EE04EA55639A2344E7BCE5572CB294DBAF7EF",
                    "new_code":"1234"
                }

                ',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "wait_settings" => 60,
                        "timeout_confirm_code" => 180,
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '28',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '80517bbf-3429-11e9-96f3-b06ebfbfa715',
                'name' => '2.8 Запрос списка типов оповещения',
                'url_path' => '/api/v1/settings/notifications',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "name" => "Push уведомление",
                            "code" => "push",
                            "comment" => "",
                            "is_active" => "1",
                        ],
                        [
                            "name" => "Email уведомление",
                            "code" => "email",
                            "comment" => "",
                            "is_active" => "0",
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '29',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '31c18316-34fd-11e9-96f3-b06ebfbfa715',
                'name' => '2.8 Запрос списка типов оповещения',
                'url_path' => '/api/v2/settings/notifications',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "name" => "Push уведомление",
                            "code" => "push",
                            "comment" => "",
                            "is_active" => true,
                        ],
                        [
                            "name" => "Email уведомление",
                            "code" => "email",
                            "comment" => "",
                            "is_active" => false,
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '29',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'db8e6940-3429-11e9-96f3-b06ebfbfa715',
                'name' => '2.9 Изменение типа оповещения',
                'url_path' => '/api/v1/settings/notifications',
                'method' => 'POST',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '30',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '4d318889-35c2-11e9-96f3-b06ebfbfa715',
                'name' => '2.9 Изменение типа оповещения',
                'url_path' => '/api/v2/settings/notifications',
                'method' => 'POST',
                'params' => '

                Пример:
                {
                    "code": "sms",
                    "is_active": true
                }',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '30',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'f8cce1cf-3429-11e9-96f3-b06ebfbfa715',
                'name' => '2.10 Email для регистрации/смены',
                'url_path' => '/api/v1/settings/email',
                'method' => 'POST',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "На вашу электронную почту было отправлено сообщение с кодом. Введите код",
                    "meta" => [
                        "timeout_confirm_code" => 300,
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '31',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '1a3adf89-342e-11e9-96f3-b06ebfbfa715',
                'name' => '2.11 Отправка Email кода для подтверждения',
                'url_path' => '/api/v1/settings/email/confirm',
                'method' => 'POST',
                'params' => '
                <b>hash_code</b> - String(32)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "",
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '32',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'dae5eb63-35b8-11e9-96f3-b06ebfbfa715',
                'name' => '2.12 Запрос всех данных пользователя',
                'url_path' => '/api/v1/users/full',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "is_verified" => "false",
                        "verify_id" => "968bd8dc-f122-44b5-845e-30aaa04c8999",
                        "verify_date" => "2019-01-22 13:05:40",
                        "verify_by_system" => "Admin Panel",
                        "document" => [
                            [
                                "Номер телефона",
                                "992928553004",
                            ],
                            [
                                "Имя",
                                "Тест",
                            ],
                            [
                                "Отчество",
                                "Тестович",
                            ],
                            [
                                "Фамилия",
                                "Тестов",
                            ],
                            [
                                "№ ИНН",
                                "123456789",
                            ],
                            [
                                "Е-Майл",
                                "test@gmail.com",
                            ],
                            [
                                "Тип документа",
                                "Вид",
                            ],
                            [
                                "Дата рождения",
                                "1992-06-25",
                            ],
                            [
                                "Пол",
                                "Мужской",
                            ],
                            [
                                "Серия",
                                "A01423216",
                            ],
                            [
                                "Кем выдан",
                                "123",
                            ],
                            [
                                "Гражданство",
                                "CONGO, THE DEMOCRATIC REPUBLIC OF THE",
                            ],
                            [
                                "Регион",
                                "Вилояти Хатлон",
                            ],
                            [
                                "Район",
                                "Аштский район",
                            ],
                            [
                                "Город",
                                "DUSHANBE",
                            ],
                            [
                                "Улица",
                                "Рифат Ходжиева",
                            ],
                            [
                                "Дом",
                                "2",
                            ],
                            [
                                "Квартира",
                                "54",
                            ],
                            [
                                "Место рождения",
                                "АЛЖИР",
                            ],
                            [
                                "Когда выдан",
                                "2019-01-10",
                            ],
                        ],
                    ],
                    "meta" => [
                        "menu_version" => "23",
                        "app_version" => "1.0.0",
                        "is_editable" => 0,
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '32.1',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '4a7e8aa1-35be-11e9-96f3-b06ebfbfa715',
                'name' => '2.12 Запрос всех данных пользователя',
                'url_path' => '/api/v2/users/full',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "is_verified" => "false",
                        "verify_id" => "968bd8dc-f122-44b5-845e-30aaa04c8999",
                        "verify_date" => "2019-01-22 13:05:40",
                        "verify_by_system" => "Admin Panel",
                        "document" => [
                            [
                                "key" => "Номер телефона",
                                "value" => "992928553004",
                            ],
                            [
                                "key" => "Имя",
                                "value" => "Тест",
                            ],
                            [
                                "key" => "Отчество",
                                "value" => "Тестович",
                            ],
                            [
                                "key" => "Фамилия",
                                "value" => "Тестов",
                            ],
                            [
                                "key" => "№ ИНН",
                                "value" => "123456789",
                            ],
                            [
                                "key" => "Е-Майл",
                                "value" => "test@gmail.com",
                            ],
                            [
                                "key" => "Тип документа",
                                "value" => "Вид",
                            ],
                            [
                                "key" => "Дата рождения",
                                "value" => "1992-06-25",
                            ],
                            [
                                "key" => "Пол",
                                "value" => "Мужской",
                            ],
                            [
                                "key" => "Серия",
                                "value" => "A01423216",
                            ],
                            [
                                "key" => "Кем выдан",
                                "value" => "123",
                            ],
                            [
                                "key" => "Гражданство",
                                "value" => "CONGO, THE DEMOCRATIC REPUBLIC OF THE",
                            ],
                            [
                                "key" => "Регион",
                                "value" => "Вилояти Хатлон",
                            ],
                            [
                                "key" => "Район",
                                "value" => "Аштский район",
                            ],
                            [
                                "key" => "Город",
                                "value" => "DUSHANBE",
                            ],
                            [
                                "key" => "Улица",
                                "value" => "Рифат Ходжиева",
                            ],
                            [
                                "key" => "Дом",
                                "value" => "2",
                            ],
                            [
                                "key" => "Квартира",
                                "value" => "54",
                            ],
                            [
                                "key" => "Место рождения",
                                "value" => "АЛЖИР",
                            ],
                            [
                                "key" => "Когда выдан",
                                "value" => "2019-01-10",
                            ],
                        ],
                    ],
                    "meta" => [
                        "is_editable" => 1,
                        "menu_version" => "25",
                        "app_version" => "1.0.0",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '32.1',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '11ce8af6-35d4-11e9-96f3-b06ebfbfa715',
                'name' => '2.13 Подтверждение изменения Пин-кода',
                'url_path' => '/api/v2/settings/pin/confirm',
                'method' => 'POST',
                'params' => '
                <b>hash_code</b> - String(32)

                Пример
                {
                    "hash_code":"331053F03FB2CB8A7F260D700359D364F2433E97D4CC9C254D4B00ED1A0039741"
                }

                ',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '32.2',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '68ee3301-38f0-11e9-96f3-b06ebfbfa715',
                'name' => '2.14 Запрос прикрепления Email-a',
                'url_path' => '/api/v2/settings/email/attach',
                'method' => 'POST',
                'params' => '
                <b>email</b> - String(32)

                Пример
                {
                    "email":"test1@gmail.com"
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "wait_settings" => 60,
                        "timeout_confirm_code" => 300,
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '32.3',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '5ee4e5dd-38f1-11e9-96f3-b06ebfbfa715',
                'name' => '2.15 Отправка кода для подтверждения прикрепления Email-a',
                'url_path' => '/api/v2/settings/email/attach/confirm',
                'method' => 'POST',
                'params' => '
                <b>hash_code</b> - String

                Пример
                {
                    "hash_code":"9365F9C559A715E382CDF062FCB7656C3ED9FBAAB4B7F03DF5450EBAD13278F1"
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Неверный код. Осталось попыток: 4",
                ],
                'version' => '2',
                'group' => '32.4',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '6f6cd90c-38f1-11e9-96f3-b06ebfbfa715',
                'name' => '2.16 Запрос открепления Email-a',
                'url_path' => '/api/v2/settings/email/detach',
                'method' => 'POST',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "wait_settings" => 60,
                        "timeout_confirm_code" => 300,
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '32.5',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'f935a0f2-38f1-11e9-96f3-b06ebfbfa715',
                'name' => '2.17 Отправка кода для подтверждения открепления Email-a',
                'url_path' => '/api/v2/settings/email/detach/confirm',
                'method' => 'POST',
                'params' => '
                <b>hash_code</b> - String

                Пример
                {
                    "hash_code":"CC6DBCEC6059A2FCFFA8D0F625E4BA5DE69540E8F19DEDBBD6210A9FE715F9E5"
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Неверный код. Осталось попыток: 4",
                ],
                'version' => '2',
                'group' => '32.6',
                'doc_api_category_id' => 'ebac6320-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '2cdfaf0a-342e-11e9-96f3-b06ebfbfa715',
                'name' => '3.1 Запрос списка названий всех сервисов оплаты с иерархией категорий',
                'url_path' => '/api/v1/categories',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" => "0",
                    "data" => [
                        [
                            "id" => "c7ed81b8-b1b7-11e8-904b-b06ebfbfa715",
                            "name" => "Оплатить услуги",
                            "code" => "PAYMENT_MENU",
                            "type" => "category",
                            "icon" => "services.png",
                            "enabled" => 1,
                            "child" => [
                                [
                                    "id" => "32c5b017-a07d-11e8-904b-b06ebfbfa715",
                                    "name" => "Мобильная связь",
                                    "code" => "MOBILE",
                                    "type" => "category",
                                    "icon" => "mobile.png",
                                    "enabled" => 1,
                                    "child" => [
                                        [
                                            "id" => "14f8e166-9fb5-11e8-904b-b06ebfbfa715",
                                            "name" => "Tcell",
                                            "code" => "MOBILE_TCELL_TJ",
                                            "type" => "service",
                                            "icon" => "tcell.png",
                                            "enabled" => 1,
                                        ],
                                        [
                                            "id" => "2bec08d9-9fb5-11e8-904b-b06ebfbfa715",
                                            "name" => "Мегафон",
                                            "code" => "MOBILE_MEGAFON_TJ",
                                            "type" => "service",
                                            "icon" => "megafon.png",
                                            "enabled" => 1,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            "id" => "ced619fe-b1b7-11e8-904b-b06ebfbfa715",
                            "name" => "Переводы",
                            "code" => "SEND_MENU",
                            "type" => "category",
                            "icon" => "send.png",
                            "enabled" => 1,
                            "child" => [],
                        ],
                        [
                            "id" => "d1960b22-b1b7-11e8-904b-b06ebfbfa715",
                            "name" => "Пополнить счёт",
                            "code" => "INCOME_MENU",
                            "type" => "category",
                            "icon" => "fill.png",
                            "enabled" => 1,
                            "child" => [
                                [
                                    "id" => "1bf152e0-b1c4-11e8-904b-b06ebfbfa715",
                                    "name" => "Найти терминал на карте",
                                    "code" => "MAP_MENU",
                                    "type" => "map",
                                    "icon" => "location.png",
                                    "enabled" => 1,
                                ],
                            ],
                        ],
                        [
                            "id" => "d40e3278-b1b7-11e8-904b-b06ebfbfa715",
                            "name" => "Обналичить",
                            "code" => "CASHOUT_MENU",
                            "type" => "cash",
                            "icon" => "cash.png",
                            "enabled" => 1,
                        ],
                        [
                            "id" => "d694a6bd-b1b7-11e8-904b-b06ebfbfa715",
                            "name" => "Оплатить по QR",
                            "code" => "QR_MENU",
                            "type" => "qr",
                            "icon" => "qr.png",
                            "enabled" => 0,
                        ],
                    ],
                    "meta" => [
                        "service_icons_url_host" => "http://localhost/laravel-ewallet/public/imgs/services",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '33',
                'doc_api_category_id' => 'ef649d84-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '8914dbff-34fc-11e9-96f3-b06ebfbfa715',
                'name' => '3.1 Запрос списка названий всех сервисов оплаты с иерархией категорий',
                'url_path' => '/api/v2/categories',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" => "0",
                    "data" => [
                        [
                            "id" => "c7ed81b8-b1b7-11e8-904b-b06ebfbfa715",
                            "name" => "Оплатить услуги",
                            "code" => "PAYMENT_MENU",
                            "type" => "category",
                            "icon" => "services.png",
                            "enabled" => true,
                            "child" => [
                                [
                                    "id" => "32c5b017-a07d-11e8-904b-b06ebfbfa715",
                                    "name" => "Мобильная связь",
                                    "code" => "MOBILE",
                                    "type" => "category",
                                    "icon" => "mobile.png",
                                    "enabled" => true,
                                    "child" => [
                                        [
                                            "id" => "14f8e166-9fb5-11e8-904b-b06ebfbfa715",
                                            "name" => "Tcell",
                                            "code" => "MOBILE_TCELL_TJ",
                                            "type" => "service",
                                            "icon" => "tcell.png",
                                            "enabled" => true,
                                            "child" => [],
                                        ],
                                        [
                                            "id" => "2bec08d9-9fb5-11e8-904b-b06ebfbfa715",
                                            "name" => "Мегафон",
                                            "code" => "MOBILE_MEGAFON_TJ",
                                            "type" => "service",
                                            "icon" => "megafon.png",
                                            "enabled" => true,
                                            "child" => [],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            "id" => "ced619fe-b1b7-11e8-904b-b06ebfbfa715",
                            "name" => "Переводы",
                            "code" => "SEND_MENU",
                            "type" => "category",
                            "icon" => "send.png",
                            "enabled" => true,
                            "child" => [],
                        ],
                        [
                            "id" => "d1960b22-b1b7-11e8-904b-b06ebfbfa715",
                            "name" => "Пополнить счёт",
                            "code" => "INCOME_MENU",
                            "type" => "category",
                            "icon" => "fill.png",
                            "enabled" => true,
                            "child" => [
                                [
                                    "id" => "1bf152e0-b1c4-11e8-904b-b06ebfbfa715",
                                    "name" => "Найти терминал на карте",
                                    "code" => "MAP_MENU",
                                    "type" => "map",
                                    "icon" => "location.png",
                                    "enabled" => true,
                                    "child" => [],
                                ],
                            ],
                        ],
                        [
                            "id" => "d40e3278-b1b7-11e8-904b-b06ebfbfa715",
                            "name" => "Обналичить",
                            "code" => "CASHOUT_MENU",
                            "type" => "cash",
                            "icon" => "cash.png",
                            "enabled" => true,
                            "child" => [],
                        ],
                        [
                            "id" => "d694a6bd-b1b7-11e8-904b-b06ebfbfa715",
                            "name" => "Оплатить по QR",
                            "code" => "QR_MENU",
                            "type" => "qr",
                            "icon" => "qr.png",
                            "enabled" => false,
                            "child" => [],
                        ],
                    ],
                    "meta" => [
                        "service_icons_url_host" => "http://localhost/laravel-ewallet/public/imgs/services",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '33',
                'doc_api_category_id' => 'ef649d84-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'a50d6dd7-342e-11e9-96f3-b06ebfbfa715',
                'name' => '3.2 Запрос всех данных указанного оператора',
                'url_path' => '/api/v1/services/{id}',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" => "0",
                    "data" => [
                        "name" => "Tojnet",
                        "code" => "INTERNET_TOJNET",
                        "type" => "service",
                        "currency_iso" => "TJS",
                        "min_amount" => 1,
                        "max_amount" => 3000,
                        "is_requestable_balance" => 1,
                        "commissions" => null,
                        "params" => [
                            [
                                "input_placeholder" => "Логин",
                                "input_name" => "login",
                                "input_type" => "number",
                                "keyboard_type" => "number",
                                "icon_url" => "tojnet.png",
                                "regexp" => "\\d{3,5}",
                                "chars_mask" => null,
                                "min_length" => 3,
                                "max_length" => 5,
                            ],
                        ],
                        "accounts" => [
                            [
                                "balance" => 1000,
                                "number" => "2222222222222222",
                                "currency_iso_name" => "TJS",
                                "account_type_name" => "Эсхата Онлайн",
                            ],
                        ],
                        "current_limits" => [
                            "day_limit" => 1000,
                            "week_limit" => 2500,
                            "month_limit" => 2500,
                            "balance_limit" => 0,
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '34',
                'doc_api_category_id' => 'ef649d84-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '93da4d9f-77be-11e9-94dd-b06ebfbfa715',
                'name' => '3.2 Запрос всех данных указанного оператора',
                'url_path' => '/api/v2/services/{id}',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" =>  0,
                    "data" =>  [
                        "name" =>  "Tcell",
                        "code" =>  "MOBILE_TCELL_TJ",
                        "type" =>  "service",
                        "currency_iso" =>  "TJS",
                        "min_amount" =>  1.0000,
                        "max_amount" =>  5000.0000,
                        "is_requestable_balance" =>  0,
                        "currencies" =>  [],
                        "commissions" =>  [],
                        "params" =>  [
                            [
                                "input_placeholder" =>  "Номер телефона",
                                "input_name" =>  "to_account",
                                "input_type" =>  "number_contacts",
                                "keyboard_type" =>  "phone",
                                "icon_url" =>  "form_mobile.png",
                                "regexp" =>  "(92|93|50|77)[1]\\d[7]",
                                "chars_mask" =>  "__ ___ __ __",
                                "min_length" =>  9,
                                "max_length" =>  9,
                                "value" =>  null,
                                "prefix" =>  null
                            ],
                            [
                                "input_placeholder" =>  "Сумма",
                                "input_name" =>  "amount",
                                "input_type" =>  "amount",
                                "keyboard_type" =>  "number",
                                "icon_url" =>  "form_summ.png",
                                "regexp" =>  "[0-9]+([\\.]?[0-9]+)?",
                                "chars_mask" =>  null,
                                "min_length" =>  1,
                                "max_length" =>  9,
                                "value" =>  [
                                    "type" =>  "root",
                                    "link" =>  "commissions",
                                    "display" =>  "none",
                                    "dependencies" =>  [
                                        [
                                            "item_property" =>  "",
                                            "input_name" =>  "total"
                                        ]
                                    ],
                                    "items" =>  null
                                ],
                                "prefix" =>  null
                            ],
                            [
                                "input_placeholder" =>  "Счёт списания",
                                "input_name" =>  "from_account_id",
                                "input_type" =>  "select_accounts",
                                "keyboard_type" =>  "none",
                                "icon_url" =>  "form_payfrom.png",
                                "regexp" =>  "([0-9A-Fa-f][8][-][0-9A-Fa-f][4][-][0-9A-Fa-f][4][-][0-9A-Fa-f][4][-][0-9A-Fa-f][12])",
                                "chars_mask" =>  null,
                                "min_length" =>  36,
                                "max_length" =>  36,
                                "value" =>  [
                                    "type" =>  "default",
                                    "link" =>  "accounts",
                                    "display" =>  "dropup",
                                    "dependencies" =>  [],
                                    "items" =>  [
                                        [
                                            "id" =>  "337bdffb-bb4f-4141-ab02-89d8892b829a",
                                            "balance" =>  0.0000,
                                            "number" =>  "992922005544",
                                            "currency_iso_name" =>  "TJS",
                                            "account_type_name" =>  "Эсхата Онлайн",
                                            "account_category_type_code" =>  "EWALLET",
                                            "is_own" =>  true,
                                            "img" =>  "choose_wallet.png"
                                        ],
                                        [
                                            "id" =>  "b7006d47-ed3f-4195-a768-c9ba160040c6",
                                            "balance" =>  12.5000,
                                            "number" =>  "6374600000000591484",
                                            "currency_iso_name" =>  "TJS",
                                            "account_type_name" =>  "Локальная карта Эсхата",
                                            "account_category_type_code" =>  "CARDS",
                                            "is_own" =>  true,
                                            "img" =>  "choose_localcard.png"
                                        ],
                                        [
                                            "id" =>  "2481266d-2c9f-4464-af06-1f040b6c00ef",
                                            "balance" =>  10.0000,
                                            "number" =>  "20216972901000000807",
                                            "currency_iso_name" =>  "TJS",
                                            "account_type_name" =>  "Сберегательные депозиты",
                                            "account_category_type_code" =>  "ACCOUNTS",
                                            "is_own" =>  true,
                                            "img" =>  "choose_account.png"
                                        ],
                                        [
                                            "id" =>  "c2ecb0f7-98d3-4904-a765-6472806459cd",
                                            "balance" =>  27.5000,
                                            "number" =>  "20216972601000037057",
                                            "currency_iso_name" =>  "TJS",
                                            "account_type_name" =>  "Сберегательные депозиты",
                                            "account_category_type_code" =>  "ACCOUNTS",
                                            "is_own" =>  true,
                                            "img" =>  "choose_account.png"
                                        ]
                                    ]
                                ],
                                "prefix" =>  null
                            ],
                            [
                                "input_placeholder" =>  "Итого к оплате",
                                "input_name" =>  "total",
                                "input_type" =>  "total",
                                "keyboard_type" =>  "number",
                                "icon_url" =>  "form_total.png",
                                "regexp" =>  "[0-9]+([\\.]?[0-9]+)?",
                                "chars_mask" =>  null,
                                "min_length" =>  1,
                                "max_length" =>  9,
                                "value" =>  null,
                                "prefix" =>  null
                            ]
                        ],
                        "current_limits" =>  [
                            "day_limit" =>  25000.0,
                            "week_limit" =>  25000.0,
                            "month_limit" =>  25000.0,
                            "balance_limit" =>  10000.0000
                        ]
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '34',
                'doc_api_category_id' => 'ef649d84-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '2d3c774d-342f-11e9-96f3-b06ebfbfa715',
                'name' => '3.3 Запрос остатка баланса услуги',
                'url_path' => '/api/v1/transactions/balance',
                'method' => 'GET',
                'params' => '
                <b>service_id</b> - String(36)
                <b>number</b> - String(100)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "comment" => "Тестов Тест <br>Ваш баланс: 100",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '35',
                'doc_api_category_id' => 'ef649d84-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '65d29c5d-3699-11e9-96f3-b06ebfbfa715',
                'name' => '3.3 Запрос остатка баланса услуги',
                'url_path' => '/api/v2/services/balance',
                'method' => 'GET',
                'params' => '
                <b>service_id</b> - String(36)
                <b>number</b> - String(100)

                Пример
                {
                    "service_id": 65d29c5d-3699-11e9-96f3-b06ebfbfa715,
                    "number": 111222333,
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "comment" => "Тестов Тест <br>Ваш баланс: 100",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '35',
                'doc_api_category_id' => 'ef649d84-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'ad14951e-342f-11e9-96f3-b06ebfbfa715',
                'name' => '4.1 Создать документ по переводу между кошельками или оплате услуг',
                'url_path' => '/api/v1/transactions',
                'method' => 'POST',
                'params' => '
                <b>service_id</b> - String(36)
                <b>amount</b> - Double
                <b>commission</b> - Double
                <b>params</b> - String(JSON)
                <b>from_account_number</b> - String(36)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "transaction_id" => "faa0d3ee-11bc-4b68-a3ca-4209b1a47183",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '36',
                'doc_api_category_id' => 'f3bb9f2a-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '6ec81771-369f-11e9-96f3-b06ebfbfa715',
                'name' => '4.1 Создать документ по переводу между кошельками или оплате услуг',
                'url_path' => '/api/v2/transactions',
                'method' => 'POST',
                'params' => '
                <b>service_id</b> - String(36)
                <b>amount</b> - Double
                <b>commission</b> - Double
                <b>params</b> - JSON
                <b>add_to_favorite</b> - Boolean
                <b>from_account_number</b> - String(36)

                Пример
                {
                    "service_id" : "96e8b785-b1b9-11e8-904b-b06ebfbfa715",
                    "commission" : 0,
                    "params":[
                        {
                            "key": "to_account",
                            "value": "992927777777"
                        },
                        {
                            "key": "amount",
                            "value": 10
                        },
                        {
                            "key": "from_account_id",
                            "value": "337bdffb-bb4f-4141-ab02-89d8892b829a"
                        },
                        {
                            "key": "total",
                            "value": 10
                        },
                        {
                            "key": "comment",
                            "value": "123"
                        }
                    ]
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "transaction_id" => "faa0d3ee-11bc-4b68-a3ca-4209b1a47183",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '36',
                'doc_api_category_id' => 'f3bb9f2a-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '5d0674a0-3430-11e9-96f3-b06ebfbfa715',
                'name' => '4.2 Подтвердить по СМС коду созданный документ по переводу между кошельками или оплате услуг',
                'url_path' => '/api/v1/transactions/confirm',
                'method' => 'POST',
                'params' => '
                <b>hash_code</b> - String(SHA256)
                <b>transaction_id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "Транзакция принята на обработку.",
                    "data" => [
                        "balance" => 990,
                    ],
                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Транзакция уже подтверждалась ранее.",
                ],
                'version' => '1',
                'group' => '37',
                'doc_api_category_id' => 'f3bb9f2a-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'f95d47ee-36a4-11e9-96f3-b06ebfbfa715',
                'name' => '4.2 Подтвердить по СМС коду созданный документ по переводу между кошельками или оплате услуг',
                'url_path' => '/api/v2/transactions/confirm',
                'method' => 'POST',
                'params' => '
                <b>hash_code</b> - String(SHA256)
                <b>transaction_id</b> - String(36)

                Пример
                {
                    "hash_code" : "0499D7EEEAWDKLHAHDJKLAAJDKLHADDCC812FA87",
                    "transaction_id" : "0a13461d-6a67-42ef-b6a9-4c6829bd9973"
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "Транзакция принята на обработку.",
                    "data" => [
                        "balance" => 990,
                    ],
                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Транзакция уже подтверждалась ранее.",
                ],
                'version' => '2',
                'group' => '37',
                'doc_api_category_id' => 'f3bb9f2a-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '0b55e83d-3431-11e9-96f3-b06ebfbfa715',
                'name' => '4.3 Повторный запрос СМС кода для подтверждения транзакции',
                'url_path' => '/api/v1/transactions/confirm/retry/{transaction_id}',
                'method' => 'GET',
                'params' => '
                <b>transaction_id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "Транзакция принята на обработку.",
                    "data" => [
                        "balance" => 990,
                    ],
                ],
                'response_reject_json' => [
                    "code" => 11,
                    "message" => "Повторная отправка SMS-кода доступна через 50 секунд.",
                    "meta" => [
                        "wait_seconds" => 50,
                    ],
                ],
                'version' => '1',
                'group' => '38',
                'doc_api_category_id' => 'f3bb9f2a-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '422b0b5d-36a6-11e9-96f3-b06ebfbfa715',
                'name' => '4.3 Повторный запрос СМС кода для подтверждения транзакции',
                'url_path' => '/api/v2/transactions/confirm/retry/{transaction_id}',
                'method' => 'GET',
                'params' => '
                <b>transaction_id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "message" => "Транзакция принята на обработку.",
                    "data" => [
                        "balance" => 990,
                    ],
                ],
                'response_reject_json' => [
                    "code" => 11,
                    "message" => "Повторная отправка SMS-кода доступна через 50 секунд.",
                    "meta" => [
                        "wait_seconds" => 50,
                    ],
                ],
                'version' => '2',
                'group' => '38',
                'doc_api_category_id' => 'f3bb9f2a-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'b2c06410-3432-11e9-96f3-b06ebfbfa715',
                'name' => '4.4 Запрос детальных данных документа по переводу или оплате',
                'url_path' => '/api/v1/transactions/{id}',
                'method' => 'GET',
                'params' => '
                <b>id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "date" => "04.02.2019, 14:02",
                        "category_name" => "Мобильная связь",
                        "category_icon" => "mobile.png",
                        "service_name" => "Tcell",
                        "service_id" => "14f8e166-9fb5-11e8-904b-b06ebfbfa715",
                        "service_icon" => "mobile.png",
                        "amount_all" => -10,
                        "amount" => -10,
                        "commission" => 0,
                        "currency" => "TJS",
                        "params" => [
                            [
                                "key" => "phone_number",
                                "value" => "928553004",
                                "name" => "Номер телефона",
                                "icon_url" => "tcell.png",
                            ],
                        ],
                        "transaction_type" => [
                            "code" => "PAYMENT",
                        ],
                        "session_number" => 329,
                        "transaction_status" => [
                            "code" => "IN_PROCESSING",
                            "name" => "В обработке",
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '39',
                'doc_api_category_id' => 'f3bb9f2a-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'a5d18743-36a6-11e9-96f3-b06ebfbfa715',
                'name' => '4.4 Запрос детальных данных документа по переводу или оплате',
                'url_path' => '/api/v2/transactions/{id}',
                'method' => 'GET',
                'params' => '
                <b>id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" =>  0,
                    "data" =>  [
                        "date" =>  "08.07.2019, 22:26",
                        "category_name" =>  "Перевод на карту",
                        "category_icon" =>  "paysend_tocard.png",
                        "service_name" =>  "Локальные карты Эсхата",
                        "service_id" =>  "19f73774-a072-11e8-904b-b06ebfbfa715",
                        "service_icon" =>  "paysend_tocard.png",
                        "amount_all" =>  -27.0000,
                        "amount" =>  -27.0000,
                        "commission" =>  0.0000,
                        "currency" =>  "TJS",
                        "params" =>  [
                            [
                                "key" =>  "to_account",
                                "value" =>  "6374600000000000000",
                                "label" =>  "6374600000000000000",
                                "name" =>  "Номер карты",
                                "icon_url" =>  "form_misc.png"
                            ],
                            [
                                "key" =>  "from_account_id",
                                "value" =>  "337bdffb-bb4f-4141-ab02-89d8892b829a",
                                "label" =>  "Кошелек",
                                "name" =>  "Счёт списания",
                                "icon_url" =>  "payfrom.png"
                            ],
                            [
                                "key" =>  "amount",
                                "value" =>  "27.00",
                                "label" =>  "27.00",
                                "name" =>  "Сумма",
                                "icon_url" =>  "summ.png"
                            ],
                            [
                                "key" =>  "total",
                                "value" =>  "27.00",
                                "label" =>  "27.00",
                                "name" =>  "Итого к оплате",
                                "icon_url" =>  "total.png"
                            ]
                        ],
                        "transaction_type" =>  [
                            "code" =>  "PAYMENT"
                        ],
                        "session_number" =>  8850,
                        "transaction_status" =>  [
                            "code" =>  "COMPLETED",
                            "name" =>  "Исполнено"
                        ]
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '39',
                'doc_api_category_id' => 'f3bb9f2a-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '3915311b-3433-11e9-96f3-b06ebfbfa715',
                'name' => '4.5 Запрос списка платежного документа',
                'url_path' => '/api/v1/transactions/histories',
                'method' => 'POST',
                'params' => '
                <b>id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "date" => "04.02.2019",
                            "header" => "11:33, Мобильная связь",
                            "content" => "Tcell, 928553004",
                            "footer" => "-10 TJS",
                            "transaction_id" => "bbf09404-9f7b-46cc-9353-642209734a06",
                            "session_number" => "328",
                            "service_icon" => "tcell.png",
                            "transaction_type" => [
                                "code" => "PAYMENT",
                            ],
                            "transaction_status" => [
                                "code" => "IN_PROCESSING",
                                "name" => "В обработке",
                            ],
                        ],
                        [
                            "date" => "04.02.2019",
                            "header" => "11:33, Мобильная связь",
                            "content" => "Tcell, 928553004",
                            "footer" => "-10 TJS",
                            "transaction_id" => "bbf09404-9f7b-46cc-9353-642209734a06",
                            "session_number" => "328",
                            "service_icon" => "tcell.png",
                            "transaction_type" => [
                                "code" => "PAYMENT",
                            ],
                            "transaction_status" => [
                                "code" => "IN_PROCESSING",
                                "name" => "В обработке",
                            ],
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '40',
                'doc_api_category_id' => 'f3bb9f2a-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '3f30e390-36a8-11e9-96f3-b06ebfbfa715',
                'name' => '4.5 Запрос списка платежного документа',
                'url_path' => '/api/v2/transactions/histories',
                'method' => 'POST',
                'params' => '
                <b>id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" =>  0,
                    "data" =>  [
                        [
                            "date" =>  "8 июля, Понедельник",
                            "header" =>  "Локальные карты Эсхата",
                            "content" =>  "6374600000000680535",
                            "footer" =>  "27,00 TJS",
                            "transaction_id" =>  "35768064-5beb-4b21-872b-340d63a0c67d",
                            "session_number" =>  "8850",
                            "service_icon" =>  "service_eskhata.png",
                            "transaction_type" =>  [
                                "code" =>  "PAYMENT"
                            ],
                            "transaction_status" =>  [
                                "code" =>  "COMPLETED",
                                "name" =>  "Исполнено"
                            ]
                        ]
                        
                    ],
                    "pagination" =>  [
                        "current_page" =>  1,
                        "last_page" =>  6,
                        "per_page" =>  10,
                        "total" =>  58,
                        "first_item" =>  1,
                        "last_item" =>  10
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '40',
                'doc_api_category_id' => 'f3bb9f2a-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '9a09097e-7953-11e9-94dd-b06ebfbfa715',
                'name' => '4.6 Запрос получения чека',
                'url_path' => '/api/v2/transactions/receipt/{id}',
                'method' => 'POST',
                'params' => '
                <b>id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "Номер сессии",
                            532,
                        ],
                        [
                            "Сумма перевода",
                            1,
                        ],
                        [
                            "Коммиссия",
                            0,
                        ],
                        [
                            "Валюта",
                            "TJS",
                        ],
                        [
                            "Имя сервиса",
                            "Эсхата Oнлайн",
                        ],
                        [
                            "Тип транзакции",
                            "Оплата",
                        ],
                        [
                            "Номер Отправителя",
                            992928970070,
                        ],
                        [
                            "Способ оплаты",
                            "Эсхата Онлайн",
                        ],
                        [
                            "Плательщик",
                            "Test Умедчонович Камолчон",
                        ],
                        [
                            "Дата транзакции",
                            "2019-02-04 14:46:31",
                        ],
                        [
                            "Номер телефона",
                            "992926164436",
                        ],

                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '40.1',
                'doc_api_category_id' => 'f3bb9f2a-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '9261893a-3433-11e9-96f3-b06ebfbfa715',
                'name' => '5.1 Запрос списка шаблонов пользователя',
                'url_path' => '/api/v1/favorites',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "id" => "aaea2a9a-2d00-4fda-8bb6-4c99e0c4209a",
                            "name" => "123",
                            "currency_iso" => "TJS",
                            "service_name" => "Tcell",
                            "service_id" => "14f8e166-9fb5-11e8-904b-b06ebfbfa715",
                            "service_icon" => "tcell.png",
                            "from_account_id" => "29f8b10c-bbc8-11e8-92b3-b06ebfbfa715",
                            "value" => 10,
                            "params" => [
                                [
                                    "key" => "phone_number",
                                    "value" => "992927777777",
                                ],
                            ],
                        ],
                        [
                            "id" => "ef564f2e-250e-42aa-92bf-a9d0eb43a8bb",
                            "name" => "123",
                            "currency_iso" => "TJS",
                            "service_name" => "Tcell",
                            "service_id" => "14f8e166-9fb5-11e8-904b-b06ebfbfa715",
                            "service_icon" => "tcell.png",
                            "from_account_id" => "29f8b10c-bbc8-11e8-92b3-b06ebfbfa715",
                            "value" => 10,
                            "params" => [
                                [
                                    "key" => "phone_number",
                                    "value" => "992927777777",
                                ],
                            ],
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '41',
                'doc_api_category_id' => 'f79fae79-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'd4176391-36aa-11e9-96f3-b06ebfbfa715',
                'name' => '5.1 Запрос списка шаблонов пользователя',
                'url_path' => '/api/v2/favorites',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" =>  0,
                    "data" =>  [
                        [
                            "id" =>  "04a6ef3b-5ff3-4d41-8dff-aaff1c2b17fa",
                            "name" =>  "Тест",
                            "currency_iso" =>  "TJS",
                            "service_name" =>  "Tcell",
                            "service_id" =>  "14f8e166-9fb5-11e8-904b-b06ebfbfa715",
                            "service_icon" =>  "service_tcell.png",
                            "value" =>  5.0000,
                            "params" =>  [
                                [
                                    "key" =>  "to_account",
                                    "value" =>  "920000000"
                                ],
                                [
                                    "key" =>  "from_account_id",
                                    "value" =>  "337bdffb-bb4f-4141-ab02-89d8892b829a"
                                ]
                            ]
                        ]
                    ],
                    "pagination" =>  [
                        "current_page" =>  1,
                        "last_page" =>  1,
                        "per_page" =>  10,
                        "total" =>  10,
                        "first_item" =>  1,
                        "last_item" =>  10
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '41',
                'doc_api_category_id' => 'f79fae79-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '4d687a42-3434-11e9-96f3-b06ebfbfa715',
                'name' => '5.2 Запрос данных указанного шаблона пользователя',
                'url_path' => '/api/v1/favorites/favorite_id',
                'method' => 'GET',
                'params' => '
                <b>favorite_id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "name" => "Оплата Tcell3322",
                        "value" => 10,
                        "params" => [
                            [
                                "key" => "phone_number",
                                "value" => "992927777777",
                            ],
                        ],
                        "service" => [
                            "name" => "Tcell",
                            "code" => "MOBILE_TCELL_TJ",
                            "type" => "service",
                            "currency_iso" => "TJS",
                            "min_amount" => 1,
                            "max_amount" => 5000,
                            "is_requestable_balance" => 0,
                            "commissions" => null,
                            "params" => [
                                [
                                    "input_placeholder" => "Номер телефона",
                                    "input_name" => "phone_number",
                                    "input_type" => "number",
                                    "keyboard_type" => "phone",
                                    "icon_url" => "tcell.png",
                                    "regexp" => "(92|93|50|77){1}\\d{7}",
                                    "chars_mask" => "__ ___ __ __",
                                    "min_length" => 9,
                                    "max_length" => 9,
                                ],
                            ],
                            "accounts" => [
                                [
                                    "balance" => 990,
                                    "number" => "2222222222222222",
                                    "currency_iso_name" => "TJS",
                                    "account_type_name" => "Эсхата Онлайн",
                                ],
                            ],
                            "current_limits" => [
                                "day_limit" => 990,
                                "week_limit" => 2490,
                                "month_limit" => 2490,
                                "balance_limit" => 0,
                            ],
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '42',
                'doc_api_category_id' => 'f79fae79-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'd7849ed7-36a8-11e9-96f3-b06ebfbfa715',
                'name' => '5.2 Запрос данных указанного шаблона пользователя',
                'url_path' => '/api/v2/favorites/favorite_id',
                'method' => 'GET',
                'params' => '
                <b>favorite_id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" =>  0,
                    "data" =>  [
                        "name" =>  "Шахзода",
                        "value" =>  5.0000,
                        "params" =>  [
                            [
                                "key" =>  "to_account",
                                "value" =>  "928679559"
                            ],
                            [
                                "key" =>  "from_account_id",
                                "value" =>  "337bdffb-bb4f-4141-ab02-89d8892b829a"
                            ]
                        ],
                        "service" =>  [
                            "name" =>  "Tcell",
                            "code" =>  "MOBILE_TCELL_TJ",
                            "type" =>  "service",
                            "currency_iso" =>  "TJS",
                            "min_amount" =>  1.0000,
                            "max_amount" =>  5000.0000,
                            "is_requestable_balance" =>  0,
                            "currencies" =>  [],
                            "commissions" =>  [],
                            "params" =>  [
                                [
                                    "input_placeholder" =>  "Номер телефона",
                                    "input_name" =>  "to_account",
                                    "input_type" =>  "number_contacts",
                                    "keyboard_type" =>  "phone",
                                    "icon_url" =>  "form_mobile.png",
                                    "regexp" =>  "(92|93|50|77)[1]\\d[7]",
                                    "chars_mask" =>  "__ ___ __ __",
                                    "min_length" =>  9,
                                    "max_length" =>  9,
                                    "value" =>  null,
                                    "prefix" =>  null
                                ],
                                [
                                    "input_placeholder" =>  "Сумма",
                                    "input_name" =>  "amount",
                                    "input_type" =>  "amount",
                                    "keyboard_type" =>  "number",
                                    "icon_url" =>  "form_summ.png",
                                    "regexp" =>  "[0-9]+([\\.]?[0-9]+)?",
                                    "chars_mask" =>  null,
                                    "min_length" =>  1,
                                    "max_length" =>  9,
                                    "value" =>  [
                                        "type" =>  "root",
                                        "link" =>  "commissions",
                                        "display" =>  "none",
                                        "dependencies" =>  [
                                            [
                                                "item_property" =>  "",
                                                "input_name" =>  "total"
                                            ]
                                        ],
                                        "items" =>  null
                                    ],
                                    "prefix" =>  null
                                ],
                                [
                                    "input_placeholder" =>  "Счёт списания",
                                    "input_name" =>  "from_account_id",
                                    "input_type" =>  "select_accounts",
                                    "keyboard_type" =>  "none",
                                    "icon_url" =>  "form_payfrom.png",
                                    "regexp" =>  "([0-9A-Fa-f][8][-][0-9A-Fa-f][4][-][0-9A-Fa-f][4][-][0-9A-Fa-f][4][-][0-9A-Fa-f][12])",
                                    "chars_mask" =>  null,
                                    "min_length" =>  36,
                                    "max_length" =>  36,
                                    "value" =>  [
                                        "type" =>  "default",
                                        "link" =>  "accounts",
                                        "display" =>  "dropup",
                                        "dependencies" =>  [],
                                        "items" =>  [
                                            [
                                                "id" =>  "337bdffb-bb4f-4141-ab02-89d8892b829a",
                                                "balance" =>  0.0000,
                                                "number" =>  "992922005544",
                                                "currency_iso_name" =>  "TJS",
                                                "account_type_name" =>  "Эсхата Онлайн",
                                                "account_category_type_code" =>  "EWALLET",
                                                "is_own" =>  true,
                                                "img" =>  "choose_wallet.png"
                                            ],
                                            [
                                                "id" =>  "b7006d47-ed3f-4195-a768-c9ba160040c6",
                                                "balance" =>  12.5000,
                                                "number" =>  "6374600000000591484",
                                                "currency_iso_name" =>  "TJS",
                                                "account_type_name" =>  "Локальная карта Эсхата",
                                                "account_category_type_code" =>  "CARDS",
                                                "is_own" =>  true,
                                                "img" =>  "choose_localcard.png"
                                            ]
                                        ]
                                    ],
                                    "prefix" =>  null
                                ],
                                [
                                    "input_placeholder" =>  "Итого к оплате",
                                    "input_name" =>  "total",
                                    "input_type" =>  "total",
                                    "keyboard_type" =>  "number",
                                    "icon_url" =>  "form_total.png",
                                    "regexp" =>  "[0-9]+([\\.]?[0-9]+)?",
                                    "chars_mask" =>  null,
                                    "min_length" =>  1,
                                    "max_length" =>  9,
                                    "value" =>  null,
                                    "prefix" =>  null
                                ]
                            ],
                            "current_limits" =>  [
                                "day_limit" =>  25000.0,
                                "week_limit" =>  25000.0,
                                "month_limit" =>  25000.0,
                                "balance_limit" =>  10000.0000
                            ]
                        ]
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '42',
                'doc_api_category_id' => 'f79fae79-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '9897d4ef-3434-11e9-96f3-b06ebfbfa715',
                'name' => '5.3 Добавление шаблона',
                'url_path' => '/api/v1/favorites',
                'method' => 'POST',
                'params' => '
                <b>name</b> - String(150)
                <b>service_code</b> - String(30)
                <b>amount</b> - Double
                <b>params</b> - String(JSON)

                Пример формата значения параметра params для отправки на сервер:

                params[0]["input_name"] = "card_number"
                params[0]["input_value"] = "2642657237894612378412"
                params[1]["input_name"] = "phone_number"
                params[1]["input_value"] = "992927777777"
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "OK",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '43',
                'doc_api_category_id' => 'f79fae79-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '1a877482-36a9-11e9-96f3-b06ebfbfa715',
                'name' => '5.3 Добавление шаблона',
                'url_path' => '/api/v2/favorites/add',
                'method' => 'POST',
                'params' => '
                <b>name</b> - String(150)
                <b>transaction_id</b> - String(30)

                Пример:

                {
                  "transaction_id": 41527a99-e620-4656-9579-02523a94f500,
                  "favorite_name": "Шаблон 1"  
                }

                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "OK",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '43',
                'doc_api_category_id' => 'f79fae79-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '95f43340-3435-11e9-96f3-b06ebfbfa715',
                'name' => '5.4 Изменение шаблона',
                'url_path' => '/api/v1/favorites',
                'method' => 'POST',
                'params' => '
                <b>favorite_id</b> - String(36)
                <b>name</b> - String(150)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "OK",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '44',
                'doc_api_category_id' => 'f79fae79-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'b0f1d613-36a9-11e9-96f3-b06ebfbfa715',
                'name' => '5.4 Изменение шаблона',
                'url_path' => '/api/v2/favorites/{favorite_id}/edit',
                'method' => 'POST',
                'params' => '
                <b>favorite_id</b> - String(36)
                <b>name</b> - String(150)

                Пример
                {
                    "name": "Тестовый Шаблон1",
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "OK",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '44',
                'doc_api_category_id' => 'f79fae79-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'f6abd377-3435-11e9-96f3-b06ebfbfa715',
                'name' => '5.5 Удаление шаблона',
                'url_path' => '/api/v1/favorites/{id}',
                'method' => 'DELETE',
                'params' => '
                <b>id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "OK",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '45',
                'doc_api_category_id' => 'f79fae79-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'f18b2c54-36a9-11e9-96f3-b06ebfbfa715',
                'name' => '5.5 Удаление шаблона',
                'url_path' => '/api/v2/favorites/{favorite_id}/delete',
                'method' => 'POST',
                'params' => '
                <b>favorite_id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "OK",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '45',
                'doc_api_category_id' => 'f79fae79-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '1351a7f5-3436-11e9-96f3-b06ebfbfa715',
                'name' => '6.1 Запрос курсов валют на текущий момент',
                'url_path' => '/api/v1/currencies',
                'method' => 'POST',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "iso_name" => "USD",
                            "rate_buy" => "9.4350",
                            "rate_sell" => "9.4400",
                        ],
                        [
                            "iso_name" => "RUB",
                            "rate_buy" => "0.1395",
                            "rate_sell" => "0.1405",
                        ],
                        [
                            "iso_name" => "EUR",
                            "rate_buy" => "10.7600",
                            "rate_sell" => "10.8100",
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '1',
                'group' => '45',
                'doc_api_category_id' => 'ff448d87-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '9c8616f4-34fa-11e9-96f3-b06ebfbfa715',
                'name' => '6.1 Запрос курсов валют на текущий момент',
                'url_path' => '/api/v2/currencies',
                'method' => 'POST',
                'params' => '',
                'response_success_json' => [
                    "code" =>  0,
                    "data" =>  [
                        [
                            "iso_name" =>  "USD",
                            "rate_buy" =>  0.0000,
                            "rate_sell" =>  0.0000,
                            "icon" =>  "usd.png"
                        ],
                        [
                            "iso_name" =>  "RUB",
                            "rate_buy" =>  0.0000,
                            "rate_sell" =>  0.0000,
                            "icon" =>  "rub.png"
                        ],
                        [
                            "iso_name" =>  "EUR",
                            "rate_buy" =>  0.0000,
                            "rate_sell" =>  0.0000,
                            "icon" =>  "eur.png"
                        ]
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '45',
                'doc_api_category_id' => 'ff448d87-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '64f31624-3436-11e9-96f3-b06ebfbfa715',
                'name' => '6.2 Запрос описания уловия оферты',
                'url_path' => '/api/v1/license',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => 'Политика конфиденциальности ...',
                'response_reject_json' => '',
                'version' => '1',
                'group' => '46',
                'doc_api_category_id' => 'ff448d87-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '4449ed49-34fc-11e9-96f3-b06ebfbfa715',
                'name' => '6.2 Запрос описания уловия оферты',
                'url_path' => '/api/v2/license',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => 'Политика конфиденциальности ...',
                'response_reject_json' => '',
                'version' => '2',
                'group' => '46',
                'doc_api_category_id' => 'ff448d87-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '79d032dd-3444-11e9-96f3-b06ebfbfa715',
                'name' => '6.3 Запрос списка новостей - (Не реализовано)',
                'url_path' => '/api/v2/news',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "title" => "Акция",
                            "description" => "What is a GUID?\r\nGUID (or UUID) is an acronym for &#39;Globally Unique Identifier&#39; (or &#39;Universally Unique Identifier&#39;). It is a 128-bit integer number used to identify resources. The term GUID is generally used by developers working with Microsoft technologies, while UUID is used everywhere else.\r\n\r\nHow unique is a GUID?\r\n128-bits is big enough and the generation algorithm is unique enough that if 1,000,000,000 GUIDs per second were generated for 1 year the probability of a duplicate would be only 50%. Or if every human on Earth generated 600,000,000 GUIDs there would only be a 50% probability of a duplicate.\r\n\r\nHow are GUIDs used?\r\nGUIDs are used in enterprise software development in C#, Java, and C++ as database keys, component identifiers, or just about anywhere else a truly unique identifier is required. GUIDs are also used to identify all interfaces and objects in COM programming.\r\n\r\nMore Information About GUIDs\r\nGlobally Unique Identifier - Wikipedia, the free encyclopedia \r\nGUID Structure - Microsoft.com\r\nRFC 4122\r\n",
                            "created_at" => "03.12.2018 17:01:28",
                        ],
                        [
                            "title" => "10006",
                            "description" => "таблица новостей \"(id, заголовок, контент (обязательно для поля типа text гуглим barracuda mysql, либо вообще текст в виде файлов), id автора) ,\r\nтаблица категорий id, название, описание(если надо),вязывающая таблица ( id новости, id категории, primary key (id -новость,id категория))\r\nтаблица авторов (id автора, имя, прочая инфа))",
                            "created_at" => "04.12.2018 18:01:28",
                        ],
                        [
                            "title" => "10009",
                            "description" => "ewrerqwr",
                            "created_at" => "05.12.2018 19:01:28",
                        ],

                    ],
                    "pagination" => [
                        "current_page" => 1,
                        "last_page" => 2,
                        "per_page" => 10,
                        "total" => 13,
                        "first_item" => 1,
                        "last_item" => 10,
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '47',
                'doc_api_category_id' => 'ff448d87-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'd63f7aad-3444-11e9-96f3-b06ebfbfa715',
                'name' => '6.4 Запрос новости по указанному ID - (Не реализовано)',
                'url_path' => '/api/v2/news/{id}',
                'method' => 'GET',
                'params' => '
                <b>id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "title" => "Акция",
                        "description" => "What is a GUID?\r\nGUID (or UUID) is an acronym for &#39;Globally Unique Identifier&#39; (or &#39;Universally Unique Identifier&#39;). It is a 128-bit integer number used to identify resources. The term GUID is generally used by developers working with Microsoft technologies, while UUID is used everywhere else.\r\n\r\nHow unique is a GUID?\r\n128-bits is big enough and the generation algorithm is unique enough that if 1,000,000,000 GUIDs per second were generated for 1 year the probability of a duplicate would be only 50%. Or if every human on Earth generated 600,000,000 GUIDs there would only be a 50% probability of a duplicate.\r\n\r\nHow are GUIDs used?\r\nGUIDs are used in enterprise software development in C#, Java, and C++ as database keys, component identifiers, or just about anywhere else a truly unique identifier is required. GUIDs are also used to identify all interfaces and objects in COM programming.\r\n\r\nMore Information About GUIDs\r\nGlobally Unique Identifier - Wikipedia, the free encyclopedia \r\nGUID Structure - Microsoft.com\r\nRFC 4122\r\n",
                        "created_at" => "03.12.2018 17:01:28",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '48',
                'doc_api_category_id' => 'ff448d87-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '46bfce75-35a1-11e9-96f3-b06ebfbfa715',
                'name' => '6.5 Запрос списка координатов',
                'url_path' => '/api/v2/news/{id}',
                'method' => 'GET',
                'params' => '
                <b>id</b> - String(36)
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "name" => "000062",
                            "lat" => "40.27718880445491",
                            "lon" => "69.64120209217073",
                            "addr" => "Гагарина 135(Дирам)",
                            "objt" => 2,
                        ],
                        [
                            "name" => "В здании Банка",
                            "lat" => "40.277450733725985",
                            "lon" => "69.64126646518709",
                            "addr" => "Гагарина 135",
                            "objt" => 2,
                        ],
                        [
                            "name" => "В здании Головного офиса Банка",
                            "lat" => "40.277090580716646",
                            "lon" => "69.64165806770326",
                            "addr" => "Гагарина 135",
                            "objt" => 2,
                        ],
                        [
                            "name" => "У входа Самбусаи 33",
                            "lat" => "40.273390716001465",
                            "lon" => "69.64191555976869",
                            "addr" => "Гагарина ...",
                            "objt" => 2,
                        ],
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '49',
                'doc_api_category_id' => 'ff448d87-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '4c7e310f-35a5-11e9-96f3-b06ebfbfa715',
                'name' => '6.5 Запрос на запись данных ошибок',
                'url_path' => '/api/v2/buglog',
                'method' => 'POST',
                'params' => '
                Пример
                {
                    "tag": "MYoS",
                    "link": "https://online.eskhata.tj:1443/api/v1/favorites",
                    "response": "{&#34;code&#34;:0,&#34;data&#34;:[{&#34;id&#34;:&#34;d7e64da2-1c3a-422d-a15e-87edf59af3a9&#34;,&#34;name&#34;:&#34;интернет точнет&#34;,&#34;currency_iso&#34;:&#34;TJS&#34;,&#34;service_name&#34;:&#34;Tojnet&#34;,&#34;service_id&#34;:&#34;6fa752c7-a052-11e8-904b-b06ebfbfa715&#34;,&#34;service_icon&#34;:&#34;tojnet.png&#34;,&#34;from_account_id&#34;:&#34;6e0df7f5-0f39-4700-9ca0-0cc223fa506a&#34;,&#34;value&#34;:-60.01,&#34;params&#34;:[{&#34;key&#34;:&#34;login&#34;,&#34;value&#34;:&#34;16288&#34;}]},{&#34;id&#34;:&#34;f4acc8d0-e512-425f-a46a-6daa985dbba9&#34;,&#34;name&#34;:&#34;АНТ хона&#34;,&#34;currency_iso&#34;:&#34;TJS&#34;,&#34;service_name&#34;:&#34;АНТ TJ&#34;,&#34;service_id&#34;:&#34;267771f6-a053-11e8-904b-b06ebfbfa715&#34;,&#34;service_icon&#34;:&#34;ant.png&#34;,&#34;from_account_id&#34;:&#34;6e0df7f5-0f39-4700-9ca0-0cc223fa506a&#34;,&#34;value&#34;:-25,&#34;params&#34;:[{&#34;key&#34;:&#34;login&#34;,&#34;value&#34;:&#34;201005813&#34;}]},{&#34;id&#34;:&#34;d9b4f5c7-7f49-46aa-87d8-b6bba95337db&#34;,&#34;name&#34;:&#34;интернет точнет&#34;,&#34;currency_iso&#34;:&#34;TJS&#34;,&#34;service_name&#34;:&#34;Tojnet&#34;,&#34;service_id&#34;:&#34;6fa752c7-a052-11e8-904b-b06ebfbfa715&#34;,&#34;service_icon&#34;:&#34;tojnet.png&#34;,&#34;from_account_id&#34;:&#34;6e0df7f5-0f39-4700-9ca0-0cc223fa506a&#34;,&#34;value&#34;:-60.01,&#34;params&#34;:[{&#34;key&#34;:&#34;login&#34;,&#34;value&#34;:&#34;16288&#34;}]}]}",
                    "error": "The data couldn’t be read because it isn’t in the correct format.",
                    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjoiZXlKcGRpSTZJakk0U1RkWmNYQnlObU5NVVRJNU1VVkdRVEZRWTNjOVBTSXNJblpoYkhWbElqb2libnBVV25kd1ptWjBiakUzWEM5RmJWVTVjVmc1VGxveFJVaEViR2RoYjBrMlMyOXNVVUp0YzFOa1drNWNMM0o1VFdaNFFtbGpVRzE2ZUVoS2RHbDZSRTUwUVVGNlNVWldhMVp4YkdsdlpFTlJNRFYwTlhoa2EwRlJUbWxsTldveGRGd3ZZbTEzY0dKWlZGbFJlRFZ3VVUxcU1XbEVNR1V3U1ZWeE5GWnJZMnhCYldSMVJHOWpjMWhjTDBKR2EwdFRNMjVEVmpSdFdHSmNMelJUYTFNM09VbGtjbkZVS3paVVMzaGhiRVI1ZDFrOUlpd2liV0ZqSWpvaU5UTmlNamhqTVRobVl6WXdZVFkxTVdFeE9UYzFNVGM1Tm1NM01EYzVNRFZpWmpCaFl6YzNOemcwTW1ZMVlUWmxPRFl3WTJGbE56bGtNR0UxT0RrME9DSjkiLCJpc3MiOiJlc2toYXRhLmNvbSIsImV4cCI6MTU0MzgxOTQ0OSwic3ViIjoiIiwiYXVkIjoiIn0.jm7BmEBVgUHYXoP4Zu0Eu62VeePvqJYpP1iHMa28OyM.Mjc3YmNiNTU2Mjk2ZGUwMzQwYjc4MWE2ZGFmZWQ0YjU5ODk1OWRiODNkMzhjZWVkODZjNzc2NTNlZDZjMzc1Mg==",
                    "Os": "10.3.2",
                    "version": "10.1010",
                    "msisdn":"Номер"
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "id" => "17e64da2-1c3a-422d-a15e-87edf59af3a9",
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '50',
                'doc_api_category_id' => 'ff448d87-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => 'c03d723a-35d1-11e9-96f3-b06ebfbfa715',
                'name' => '6.6 Список уведомлений - (Не реализовано)',
                'url_path' => '/api/v2/notifications',
                'method' => 'GET',
                'params' => '',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "date" => "2019-02-21",
                            "time" => "09:33",
                            "icon" => "url",
                            "title" => "Тест",
                            "body" => "Тест Тест",
                        ],
                        [
                            "date" => "2019-02-20",
                            "time" => "09:33",
                            "icon" => "url",
                            "title" => "Тест",
                            "body" => "Тест Тест",
                        ],
                        [
                            "date" => "2019-02-19",
                            "time" => "09:33",
                            "icon" => "url",
                            "title" => "Тест",
                            "body" => "Тест Тест",
                        ],

                    ],
                    "pagination" => [
                        "current_page" => 1,
                        "last_page" => 2,
                        "per_page" => 10,
                        "total" => 11,
                        "first_item" => 1,
                        "last_item" => 10,
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '51',
                'doc_api_category_id' => 'ff448d87-2f7f-11e9-96f3-b06ebfbfa715',
            ],
            [
                'id' => '1d256b24-4624-11e9-9335-b06ebfbfa715',
                'name' => '7.1 Запрос прикрепления карты',
                'url_path' => '/api/v2/accounts/cards/attach',
                'method' => 'POST',
                'params' => '
                Пример:
                
                <b>pan</b> - PAN номер карты: 6374600000000337292
                <b>date_exp</b> - Срок карты

                Пример:
                {
                    "pan":"6374600000000337292",
                    "date_exp":"12/18"
                }

                ',
                'response_success_json' => [
                    "code" => 0,
                    "meta" => [
                        "sync_params" => [
                            "try_interval" => 3,
                            "job_id" => "179d5748-7f30-4048-967b-508d8cd4ea5a"
                        ]
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '52',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],
            [
                'id' => '5724c50d-4625-11e9-9335-b06ebfbfa715',
                'name' => '7.2 Запрос попытки прикрепления карты',
                'url_path' => '/api/v2/accounts/cards/attach/retry',
                'method' => 'POST',
                'params' => '
                Пример:
                {
                    "job_id" => "2609ed0d-c791-47ef-a39c-10f777cd10a3"
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => "f159b667-c1ab-4639-a46a-279b240395b2",
                    "meta" => [
                        "wait_settings" => 55,
                        "timeout_confirm_code" => 175,
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '53',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],
            [
                'id' => '1455bc90-4626-11e9-9335-b06ebfbfa715',
                'name' => '7.3 Подтверждение прикрепления карты',
                'url_path' => '/api/v2/accounts/cards/attach/confirm',
                'method' => 'POST',
                'params' => '
                Пример:
                {
                    "job_id":"f159b667-c1ab-4639-a46a-279b240395b2",
	                "hash_code":"6DBCEC6059A2FCFFA8D0F625E4BA5DE69540E8F19DEDBBD6210A9FE715F9E5"
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => [
                    "code" => 10,
                    "message" => "Время действия SMS-кода истекло. Пожалуйста, отправьте запрос заново.",
                ],
                'version' => '2',
                'group' => '54',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],
            [
                'id' => '22db4324-4626-11e9-9335-b06ebfbfa715',
                'name' => '7.4 Открепление карты',
                'url_path' => '/api/v2/accounts/cards/detach/{account_id}',
                'method' => 'GET',
                'params' => '
                <b>account_id</b> - uuid карты
                ',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Карта не найдена!",
                ],
                'version' => '2',
                'group' => '55',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],
            [
                'id' => '48751623-4628-11e9-9335-b06ebfbfa715',
                'name' => '7.5 Запрос статуса при прикреплении карты',
                'url_path' => '/api/v2/jobs/check',
                'method' => 'GET',
                'params' => '
Статусы:
                <b>-1</b> - FAILED
                <b>0</b> -  WAITING
                <b>1</b> - SUCCESSED

                request:
{
    "ids":[
        "179d5748-7f30-4048-967b-508d8cd4ea5a",
    ]
}
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "id" => "179d5748-7f30-4048-967b-508d8cd4ea5a",
                            "status" => 1,
                            "message" => null,
                            "data" => null
                        ]
                    ]
                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Карта не найдена!",
                ],
                'version' => '2',
                'group' => '56',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],
            [
                'id' => '6af8ca36-7950-11e9-94dd-b06ebfbfa715',
                'name' => '7.6 Блокировка/Разблокировка карты',
                'url_path' => '/api/v2/accounts/cards/block',
                'method' => 'POST',
                'params' => '

                <b>account_id</b> - UUID карты
                <b>block</b> - true - блокировать, false - разблокировать

                Пример :
                {
                    "account_id":"00598ef8-73f4-47fc-8d38-756682fa2d3b",
                    "block":true
                }
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "order_id" => '0c689b10-cac5-4ce8-afa2-5c3d4b684157',
                    ],
                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Карта не найдена!",
                ],
                'version' => '2',
                'group' => '57',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],
            [
                'id' => '0b6b98d8-7951-11e9-94dd-b06ebfbfa715',
                'name' => '7.7 Подтверждение блокировки/разблокирровки карты ',
                'url_path' => '/api/v2/accounts/cards/block/confirm',
                'method' => 'POST',
                'params' => '

                <b>hash_code</b> - HASH code СМС
                <b>order_id</b> - UUID заявки на блокировку

                Пример :
                {
                    "hash_code":"1378955B6AE079AB035EA479CA89E77A7C1D0A422D6D0BF68E4B0CF7828039B5",
                    "order_id":"0c689b10-cac5-4ce8-afa2-5c3d4b684157"
                 }
                ',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Карта не найдена!",
                ],
                'version' => '2',
                'group' => '58',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],
            [
                'id' => 'aef2a637-7bb3-11e9-94dd-b06ebfbfa715',
                'name' => '7.8 Информация о карте ',
                'url_path' => '/api/v2/accounts/{account_id}/info',
                'method' => 'GET',
                'params' => '

                <b>account_id</b> - UUID карты 463d0e4c-437e-4a22-961d-b658582ad41d

                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        "document" =>  [
                            [
                                "key" => "name_holder",
                                "value" => "Test Test Test",
                            ],
                            [
                                "key" => "account_type",
                                "value" => "Эсхата Онлайн",
                            ],
                            [
                                "key" => "account_number",
                                "value" => 0,
                            ],
                            [
                                "key" => "exp_date",
                                "value" => "01/01",
                            ],
                            [
                                "key" => "bank_name",
                                "value" => null,
                            ],
                            [
                                "key" => "bank_bic",
                                "value" => null,
                            ],
                            [
                                "key" => "bank_corr_ac",
                                "value" => null,
                            ],
                            [
                                "key" => "account",
                                "value" => null,
                            ],
                        ]
                    ]
                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Карта не найдена!",
                ],
                'version' => '2',
                'group' => '59',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],
            [
                'id' => '4dfe38b0-7bb4-11e9-94dd-b06ebfbfa715',
                'name' => '7.9 Список цветов для карт ',
                'url_path' => '/api/v2/colors',
                'method' => 'GET',
                'params' => '

                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "color" => "#9850C9"
                        ],
                        [
                            "color" => "#61BE40"
                        ],
                        [
                            "color" => "#00E59F"
                        ],
                        [
                            "color" => "#00B0E8"
                        ],
                        [
                            "color" => "#FF7F2A"
                        ],
                        [
                            "color" => "#B2BECA"
                        ],
                        [
                            "color" => "#FFCB1E"
                        ],
                        [
                            "color" => "#00A9C4"
                        ],
                        [
                            "color" => "#00D5DC"
                        ],
                        [
                            "color" => "#F90052"
                        ],
                        [
                            "color" => "#FFFFFF"
                        ]
                    ]
                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Карта не найдена!",
                ],
                'version' => '2',
                'group' => '60',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],
            [
                'id' => 'ac52bcbc-7bc4-11e9-94dd-b06ebfbfa715',
                'name' => '7.10 Переименование/Изменение цвета карты',
                'url_path' => '/api/v2/accounts/{account_id}/edit',
                'method' => 'POST',
                'params' => '

                <b>account_id</b> - UUID карты 463d0e4c-437e-4a22-961d-b658582ad41d

                Пример изменения названия:
                {
                    "name":"New"
                }

                Пример изменения цвета:
                {
                    "color":"#FFFFFF"
                }

                * HASH ЦВЕТА РЕГИСТРОЗАВИСИМЫЙ. Необходимо передавать значение цвета строго ЗАГЛАВНЫМИ буквами (если таковые имеются).
                ',
                'response_success_json' => [
                    "code" => 0,
                ],
                'response_reject_json' => [
                    "code" => 12,
                    "message" => "Карта не найдена!",
                ],
                'version' => '2',
                'group' => '61',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],

            [
                'id' => '5fc0914e-bfee-11e9-a12f-b06ebfbfa715',
                'name' => '7.11 Получить (кешированные) списки Карт, Счетов, Депозитов, Кредитов',
                'url_path' => '/api/v2/accounts?type={CARDS}',
                'method' => 'GET',
                'params' => '

                <b>type</b> - CARDS, ACCOUNTS, DEPOSITS, CREDITS
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "id" => "b7006d47-ed3f-4195-a768-c9ba160040c6",
                            "name" => null,
                            "balance" => 12.5000,
                            "number" => "6374600000000000000",
                            "currency_iso_name" => "TJS",
                            "account_type_name" => "Локальная карта Эсхата",
                            "account_category_type_code" => "CARDS",
                            "account_status_name" => "Рабочая",
                            "account_status_code" => "WORKING",
                            "is_own" => true,
                            "is_sync" => true,
                            "back_color" => "#FFFFFF",
                            "font_color" => "#003661",
                            "img" => "maincard_localcard.png",
                            "header" => null,
                            "percentage" => null
                        ]
                    ],
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '62',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],
            [
                'id' => '652b2e4e-bfee-11e9-a12f-b06ebfbfa715',
                'name' => '7.12 Заявка на получение обновлённых данных списка Депозитов и Кредитов из системы Эсхата',
                'url_path' => '/api/v2/accounts?type={DEPOSITS}&sync=true',
                'method' => 'GET',
                'params' => '

                <b>type</b> - DEPOSITS, CREDITS
                <b>sync</b> - true, false

                После отправки запроса для получения обновлений данных, генерируется <b>job_id</b> который необходимо отправлять с указанным интервалом <b>try_interval</b> на адрес "./api/v2/jobs/check" для того чтобы узнать статус запроса.
                ',
                'response_success_json' => [
                    "code" => 0,
                    "data" => [
                        [
                            "id" => "b71f2b4b-7a09-4e36-8dd7-f5bf053174f9",
                            "name" => null,
                            "balance" => 100.1800,
                            "number" => "20222978900000000000",
                            "currency_iso_name" => "EUR",
                            "account_type_name" => "Детский",
                            "account_category_type_code" => "DEPOSITS",
                            "account_status_name" => "Рабочая",
                            "account_status_code" => "WORKING",
                            "is_own" => true,
                            "is_sync" => true,
                            "back_color" => "#FFFFFF",
                            "font_color" => "#003661",
                            "img" => null,
                            "header" => "25.06.2007 (18.0% годовых)",
                            "percentage" => "18.0"
                        ]
                    ],
                    "meta" => [
                        "sync_params" => [
                            "try_interval" => 3,
                            "job_id" => "9e73e684-c3bc-4e9d-ad04-eb6b8c05bedb"
                            ]
                        ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '63',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],

            [
                'id' => '13cd944c-bff2-11e9-a12f-b06ebfbfa715',
                'name' => '7.13 Получение (кешированной) выписки указанной(го) Карты, Счёта, Депозита',
                'url_path' => '/api/v2/orders/accounts/{id}/transactions?page=1',
                'method' => 'GET',
                'params' => '

                <b>id</b> - b7006d47-ed3f-4195-a768-c9ba160040c6
                <b>page</b> - 1 (Числовой)

                ',
                'response_success_json' => [
                    "code" =>  0,
                    "data" =>  [
                        "status" =>  "completed",
                        "message" =>  "Завершен",
                        "data" =>  [
                            [
                                "doc_datetime" =>  "09 Янв. 2018",
                                "amount" =>  "4 152,65 TJS",
                                "icon" =>  "history_income.png",
                                "cont_name" =>  "Сберегательные депозиты резидентов - национальная валюта",
                                "type" =>  "D",
                                "data" =>  [
                                    [
                                        "key" =>  "Дата документа",
                                        "value" =>  "09.01.18 0:00:00",
                                        "icon" =>  "form_done.png",
                                        "color_key" =>  "#61BE40",
                                        "color_value" =>  "#212121"
                                    ],
                                    [
                                        "key" =>  "Номер документа",
                                        "value" =>  "12940048673",
                                        "icon" =>  "form_mobile.png",
                                        "color_key" =>  "#6B7C8D",
                                        "color_value" =>  "#212121"
                                    ],
                                    [
                                        "key" =>  "Счёт зачисления",
                                        "value" =>  "20216972101000025064",
                                        "icon" =>  "form_payfrom.png",
                                        "color_key" =>  "#6B7C8D",
                                        "color_value" =>  "#212121"
                                    ],
                                    [
                                        "key" =>  "Сумма",
                                        "value" =>  "4 152,65 TJS",
                                        "icon" =>  "form_summ.png",
                                        "color_key" =>  "#6B7C8D",
                                        "color_value" =>  "#61BE40"
                                    ],
                                    [
                                        "key" =>  "Назначение",
                                        "value" =>  "Ворид ба пасандоз ",
                                        "icon" =>  "form_misc.png",
                                        "color_key" =>  "#6B7C8D",
                                        "color_value" =>  "#212121"
                                    ]
                                ]
                            ],
                        ]
                    ],
                    "pagination" =>  [
                        "current_page" =>  1,
                        "last_page" =>  1,
                        "per_page" =>  10,
                        "total" =>  5,
                        "first_item" =>  1,
                        "last_item" =>  5
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '64',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],

            [
                'id' => '6bc101f1-c00d-11e9-a12f-b06ebfbfa715',
                'name' => '7.14 Заявка на получение обновлённых данных выписки Карт и Депозитов из системы Эсхата',
                'url_path' => '/api/v2/orders/accounts/transactions/',
                'method' => 'POST',
                'params' => '

                <b>account_id</b> - id счёта
                <b>date_start</b> - Дата начала
                <b>date_end</b> - Дата конца

                {
                    "account_id":"57d4f230-2139-479c-8597-016862df3cb2",
                    "date_start":"2018-01-01",
                    "date_end":"2018-01-31"
                 }

                После отправки запроса для получения обновлений данных, генерируется <b>job_id</b> который необходимо отправлять с указанным интервалом <b>try_interval</b> на адрес "./api/v2/jobs/check" для того чтобы узнать статус запроса.
                ',
                'response_success_json' => [
                    "code" =>  11,
                    "data" =>  [
                        "status" =>  "in_process",
                        "message" =>  "В обработке",
                        "data" =>  []
                    ],
                    "meta" =>  [
                        "sync_params" =>  [
                            "try_interval" =>  3,
                            "job_id" =>  "8fcea7e2-37ed-41e3-aa95-60a30a888384"
                        ]
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '65',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],

            [
                'id' => '1f7625a9-c00e-11e9-a12f-b06ebfbfa715',
                'name' => '7.15 Получение (кешированной) выписки указанного Кредита',
                'url_path' => '/api/v2/orders/credits/{id}/transactions?page=1&type=plan',
                'method' => 'GET',
                'params' => '

                <b>id</b> - b7006d47-ed3f-4195-a768-c9ba160040c6
                <b>page</b> - 1 (Числовой)
                <b>type</b> - "plan" = Плановые платежи, "fact" = Фактические платежи

                ',
                'response_success_json' => [
                    "code" =>  0,
                    "data" =>  [
                        "status" =>  "completed",
                        "message" =>  "Завершен",
                        "data" =>  [
                            [
                                "doc_datetime" =>  "01.05.2016",
                                "curr_iso_name" =>  "TJS",
                                "amount" =>  279.06,
                                "amount_percentage" =>  108.49,
                                "amount_overdue" =>  0,
                                "amount_all" =>  387.55,
                                "balance_all" =>  20814.70,
                                "data" =>  [
                                    [
                                        "key" =>  "Дата",
                                        "value" =>  "01.05.2016",
                                    ],
                                    [
                                        "key" =>  "Сумма платежа",
                                        "value" =>  387.55,
                                    ],
                                    [
                                        "key" =>  "Валюта",
                                        "value" =>  "TJS",
                                    ],
                                    [
                                        "key" =>  "Погашение основной суммы кредита",
                                        "value" =>  279.06,
                                    ],
                                    [
                                        "key" =>  "Погашение процентов",
                                        "value" =>  108.49,
                                    ],
                                    [
                                        "key" =>  "Другие начисленные проценты",
                                        "value" =>  0,
                                    ],
                                    [
                                        "key" =>  "Остаток задолженности",
                                        "value" =>  20814.70,
                                    ],
                                ]
                            ],
                        ]
                    ],
                    "pagination" =>  [
                        "current_page" =>  1,
                        "last_page" =>  6,
                        "per_page" =>  10,
                        "total" =>  60,
                        "first_item" =>  1,
                        "last_item" =>  10
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '66',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],

            [
                'id' => 'a77360be-c013-11e9-a12f-b06ebfbfa715',
                'name' => '7.16 Заявка на получение обновлённых данных Плановых и Фактических платежей по указанному Кредиту ',
                'url_path' => '/api/v2/orders/credits/transactions/',
                'method' => 'POST',
                'params' => '

                <b>account_id</b> - id счёта
                <b>type</b> - "plan" = Плановые платежи, "fact" = Фактические платежи

                {
                    "account_id":"57d4f230-2139-479c-8597-016862df3cb2",
                    "type":"plan",
                 }

                После отправки запроса для получения обновлений данных, генерируется <b>job_id</b> который необходимо отправлять с указанным интервалом <b>try_interval</b> на адрес "./api/v2/jobs/check" для того чтобы узнать статус запроса.
                ',
                'response_success_json' => [
                    "code" =>  11,
                    "data" =>  [
                        "status" =>  "in_process",
                        "message" =>  "В обработке",
                        "data" =>  []
                    ],
                    "meta" =>  [
                        "sync_params" =>  [
                            "try_interval" =>  3,
                            "job_id" =>  "8fcea7e2-37ed-41e3-aa95-60a30a888384"
                        ]
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '67',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],

            [
                'id' => '5c3aa856-c3d5-11e9-a12f-b06ebfbfa715',
                'name' => '7.17 Заявка на получение перевода на карту',
                'url_path' => '/api/v2/orders/transfers/',
                'method' => 'POST',
                'params' => '

                <b>from_account</b> - Код денежного перевода
                <b>transfer_list_id</b> - Система переводов
                <b>amount</b> - Сумма
                <b>to_account_id</b> - Счёт зачисления
                <b>currency_id</b> - Валюта перевода
                <b>purpose_list_id</b> - Назначение платежа
                <b>total</b> - Итого к оплате

                Пример:

                {
                    "service_id" : "a1792a9c-61db-11e9-9404-b06ebfbfa715",
                    "params":[
                         {
                             "key": "from_account",
                             "value": "101010"
                         },
                         {
                             "key": "transfer_list_id",
                             "value": "1d4b7866-540a-4973-a2e9-c433972f4c36"
                         },
                         {
                             "key": "amount",
                             "value": "12"
                         },
                         {
                             "key": "to_account_id",
                             "value": "b7006d47-ed3f-4195-a768-c9ba160040c6"
                         },
                         {
                             "key": "currency_id",
                             "value": "bc0d0c83-b0fc-11e8-904b-b06ebfbfa715"
                         },
                         {
                             "key": "purpose_list_id",
                             "value": "1837e74b-b41a-4b7f-bd38-c5dfa7352261"
                         },
                         {
                             "key": "total",
                             "value": "15"
                         }
                    ]
                 }

                После отправки запроса для получения обновлений данных, генерируется <b>job_id</b> который необходимо отправлять с указанным интервалом <b>try_interval</b> на адрес "./api/v2/jobs/check" для того чтобы узнать статус запроса.
                ',
                'response_success_json' => [
                    "code" =>  11,
                    "data" =>  [
                        "status" =>  "in_process",
                        "message" =>  "В обработке",
                        "data" =>  []
                    ],
                    "meta" =>  [
                        "sync_params" =>  [
                            "try_interval" =>  3,
                            "job_id" =>  "8fcea7e2-37ed-41e3-aa95-60a30a888384"
                        ]
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '68',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],
            [
                'id' => '6cfa145b-c3d5-11e9-a12f-b06ebfbfa715',
                'name' => '7.18 Получение списка заявок для перевода на карту',
                'url_path' => '/api/v2/orders/transfers/',
                'method' => 'GET',
                'params' => '

                ',
                'response_success_json' => [
                    "code" =>  0,
                    "data" =>  [
                        [
                            "id" =>  "69ec6333-591f-45d4-aa5f-44d33d2ed0c8",
                            "doc_datetime" =>  "21 Авг. 2019",
                            "name" =>  "Мигом",
                            "image" =>  null,
                            "icon" =>  "form_inprogress.png",
                            "amount" =>  12.0
                        ],
                        [
                            "id" =>  "817d8954-fe42-412c-a6e3-aeb3ef4e35ce",
                            "doc_datetime" =>  "21 Авг. 2019",
                            "name" =>  "Мигом",
                            "image" =>  null,
                            "icon" =>  "form_done.png",
                            "amount" =>  12.0
                        ]
                    ],
                    "pagination" =>  [
                        "current_page" =>  1,
                        "last_page" =>  2,
                        "per_page" =>  10,
                        "total" =>  11,
                        "first_item" =>  1,
                        "last_item" =>  10
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '69',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],
            [
                'id' => 'c2f62593-c3d5-11e9-a12f-b06ebfbfa715',
                'name' => '7.19 Получение детальных данных заявки для перевода на карту',
                'url_path' => '/api/v2/orders/transfers/{id}',
                'method' => 'GET',
                'params' => '

                <b>id</b> - id заявки

                ',
                'response_success_json' => [
                    "code" =>  0,
                    "data" =>  [
                        [
                            "key" =>  "Завершен",
                            "value" =>  "21.08.2019, 09:37",
                            "icon" =>  "form_done.png",
                            "color_key" =>  "#61BE40",
                            "color_value" =>  "#212121"
                        ],
                        [
                            "key" =>  "Код денежного перевода",
                            "value" =>  "101010",
                            "icon" =>  "form_misc.png",
                            "color_key" =>  "#6B7C8D",
                            "color_value" =>  "#212121"
                        ],
                        [
                            "key" =>  "Система перевода",
                            "value" =>  "Мигом",
                            "icon" =>  "form_misc.png",
                            "color_key" =>  "#6B7C8D",
                            "color_value" =>  "#212121"
                        ],
                        [
                            "key" =>  "Валюта перевода",
                            "value" =>  "Российский рубль",
                            "icon" =>  "form_misc.png",
                            "color_key" =>  "#6B7C8D",
                            "color_value" =>  "#212121"
                        ],
                        [
                            "key" =>  "Сумма перевода",
                            "value" =>  "12,00 RUB",
                            "icon" =>  "form_summ.png",
                            "color_key" =>  "#6B7C8D",
                            "color_value" =>  "#212121"
                        ],
                        [
                            "key" =>  "Курс",
                            "value" =>  "2.0000",
                            "icon" =>  "form_xchange.png",
                            "color_key" =>  "#6B7C8D",
                            "color_value" =>  "#212121"
                        ],
                        [
                            "key" =>  "Назначение платежа",
                            "value" =>  "Бозгашти маблаги интиколгардида",
                            "icon" =>  "form_message.png",
                            "color_key" =>  "#6B7C8D",
                            "color_value" =>  "#212121"
                        ],
                        [
                            "key" =>  "К зачислению",
                            "value" =>  "24,00 TJS",
                            "icon" =>  "form_sendcash.png",
                            "color_key" =>  "#6B7C8D",
                            "color_value" =>  "#212121"
                        ],
                        [
                            "key" =>  "Счет зачисления",
                            "value" =>  "Локальная карта Эсхата *0000",
                            "icon" =>  "maincard_localcard.png",
                            "color_key" =>  "#6B7C8D",
                            "color_value" =>  "#212121"
                        ]
                    ]
                ],
                'response_reject_json' => '',
                'version' => '2',
                'group' => '70',
                'doc_api_category_id' => '8bd27482-4623-11e9-9335-b06ebfbfa715',
            ],

            
            
        ];

        foreach ($items as $item) {
            try {
                //$res = DocApi::create($item);
                DocApi::create(['id' => $item['id']], $item);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
