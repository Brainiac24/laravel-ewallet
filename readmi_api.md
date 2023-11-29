FORMAT: 1A
HOST: https://private-8fda18-apiwallerv2.apiary-mock.com/api/v1

# api-wallet

В RESTful API имеется несколько определенных HTTP методов:

`GET` — запрос на получение.

`POST` — запрос на создание.

`PUT` — запрос на изменение.

`DELETE` — запрос на удаление.

# Статусы ответов
- 200 `OK` - the request was successful.
- 400 `Bad Request` - client error (ошибка клиента).
- 404 `Not Found` - resource was not found.
- 429 `Too Many Requests` -  («слишком много запросов»)
- 500 `Internal Server Error` - («внутренняя ошибка сервера»)
- 503 `Service Unavailable` - («сервис недоступен»)


# Заметки

**1)** Версию API необходимо передавать при каждом запросе в строке адреса `api/v2/`. Например: `https://wallet.eskhata.com/api/v2/`

**2)** В HTTP заголовках необходимо сторого указывать: `User-Agent: MBE` иначее сервер сразу отбивает запрос с кодом ошибки `6` - Доступ запрещён

**3)** В HTTP заголовках необходимо сторого указывать: `X-Requested-With: XMLHttpRequest` иначее сервер сразу отбивает запрос с кодом ошибки `12` - Плохой, неверный запрос

**4)** Формат возвращаемых данных нужно описывать в HTTP заголовках: `ACCEPT: application/json`

**5)** Язык запрашиваемого контента указывается в HTTP заголовках. То есть, если язык клиентского приложения выбран `Русский`, тогда при каждом обращении на сервер, в заголовках необходимо указывать: `Accept-Language: ru` (в других случаях, в зависимости выбранного языка: `en` или `tj`)

Список поддерживаемых языков - ru, en, tj.

**6)** Для того чтобы узнать язык возвращаемого контента (response) необходимо прочитать параметр `Content-Language:` из HTTP заголовков ответа сервера. 

**7)** Организация токенов в проекте разделены 2 типами `temporary_token` и `access_token`

`temporary_token` - это временный токен. Этот токен используется только тогда, когда клиент производит первоначальную идентификацию приложения на своём смартфоне. 

После того как приложение идентифицировано, клиентскому приложению выдаётся `access_token` и дальнейшая связь с сервером происходит с этим токеном.

**8)** Вне зависимости от типа токена, для аутентификации, в HTTP заголовках указывается `token` с типом `Bearer`. 

Например:
`Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2xhcmF2ZWwtc3RvcmUtb25saW5lL3B1YmxpY19odG1sL2FwaS92MS9sb2dpbiIsImlhdCI6MTUxNDg2ODI0OCwiZXhwIjoxNTE0ODc1NDQ4LCJuYmYiOjE1MTQ4NjgyNDgsImp0aSI6IkVEeDlHR09ham9kV3VzZmkiLCJzdWIiOiIzYzc5OWY1NS0zZDRlLTQ5MWItYjUyMi1kNjkzZmNjN2I3NzQiLCJwcnYiOiI5NGRiZDk2MWFhZWYwZTNjZTY2YWQ3ZDUwZTY0NzcxNzYwOWRkYTI0In0.4cRj_ysVpj31oluXU5Lqci3vK_WcKpY-GuNTjwamxaQ`

# Success code - 200
Все успешные статусы передаются с кодом `200` в заголовках, и суб кодом `code` внутри тела ответа.

**Расшифровка кодов**:
|Код|Тип|
|----|----|
|0|Успешно|

# Error code - 400
Все статусы ошибок передаются с кодом `400` в заголовках, и суб кодом `code` внутри тела ответа.

|Код|Тип|
|----|----|
|1|Неизвестная ошибка|
|2|Сервис временно недуступен|
|3|Api не поддерживается|
|4|Ресурс не найден|
|5|Ошибка авторизации|
|6|Доступ запрещён|
|7|Срок токена истёк|
|8|Слишком много запросов|
|9|Необходимо обновление|
|10|Истекло время ожидания (Timeout)|
|11|Не истекло время ожидания (Waiting)|
|12|Плохой, неверный запрос (Ошибка валидации)|
|13|Повторная операция|
|14|Лимит исчерапан|



# Group 0. Примеры

## 0.1 Пример [/examples]

### 0.1.1 Общий пример формата запроса и ответа [GET /example]

При возвращении ответа из сервера, в случае возврата контента в формате `json` в верхней иерархии могут содержаться только указанные ветки:

|Название|Описание|
|----|----|
|`code`|указывается код ответа в формате Целого числа (Integer)|
|`message`|указывается сообщение относящееся к коду ответа (`code`) в формате Текста (String)|
|`data`|указывается основной контент относящийся к бизнес логике приложения, которая может содержать данные в форматах `Коллекции (Array[])`, `Объекта (JSON-object{})`, `Текста (String)`, `Целого числа (Integer)`, `Дробного числа (Double)` и `Логические (Tiny_Int(0,1))`|
|`meta`|указываются системные данные (meta parameters), значения которых могут быть применены приложением для валидации, ожидания определённого времени и другие данные которые необходимы для корректного функционирования приложения. Так же как и `data` может содержать в себе данные в форматах `Коллекции (Array[])`, `Объекта (JSON-object{})`, `Текста (String)`, `Целого числа (Integer)`, `Дробного числа (Double)` и `Логические (Tiny_Int(0,1))`|
|`pagination`|указываются данные для организации пагинации (нумерации страниц). Более подробно описано в разделе `Коллекция с пагинацией`|

+ Request Plain Text Message

    + Headers
    
            User-Agent: MBE
            X-Requested-With: XMLHttpRequest
            Accept: application/json
            Accept-Language: ru
            Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2xhcmF2ZWwtc3RvcmUtb25saW5lL3B1YmxpY19odG1sL2FwaS92MS9sb2dpbiIsImlhdCI6MTUxNDg2ODI0OCwiZXhwIjoxNTE0ODc1NDQ4LCJuYmYiOjE1MTQ4NjgyNDgsImp0aSI6IkVEeDlHR09ham9kV3VzZmkiLCJzdWIiOiIzYzc5OWY1NS0zZDRlLTQ5MWItYjUyMi1kNjkzZmNjN2I3NzQiLCJwcnYiOiI5NGRiZDk2MWFhZWYwZTNjZTY2YWQ3ZDUwZTY0NzcxNzYwOWRkYTI0In0.4cRj_ysVpj31oluXU5Lqci3vK_WcKpY-GuNTjwamxaQ

+ Response 200 (application/json ) 

    + Headers

            Content-Language: ru

    + Body
            
            {  
                "code": 0,
                "message": "Успешно",
                "data": "",
                "meta": "",
                "pagination": ""
            }
            

### 0.1.2 Коллекция [GET /example_collection]

+ Response 200 

    + Body
            
            {  
                "code": 0,
                "message": "",
                "data": [
                    {
                        "id": 1,
                        "name": "Eladio Schroeder Sr.",
                        "email": "therese28@example.com",
                        "roles": {
                            "id": "bb435e",
                            "name": "Администратор"
                        }
                    },
                    {
                        "id": 1,
                        "name": "Eladio Schroeder Sr.",
                        "email": "therese28@example.com",
                        "roles": {
                            "id": "bb435e",
                            "name": "Администратор"
                        }
                    }
                ]
            }
            

### 0.1.3 Коллекция с пагинацией [GET /example_collection{?page}]

+ Parameters

     + page: 1 (optional, Number) -

+ Response 200 
    + Body
            
            {  
                "code": 0,
                "message": "",
                "data": [
                    {
                        "id": 1,
                        "name": "Eladio Schroeder Sr.",
                        "email": "therese28@example.com",
                        "roles": {
                            "id": "bb435e",
                            "name": "Администратор"
                        }
                    },
                    {
                        "id": 1,
                        "name": "Eladio Schroeder Sr.",
                        "email": "therese28@example.com",
                        "roles": {
                            "id": "bb435e",
                            "name": "Администратор"
                        }
                    }
                ],
                "pagination": 
                    {
                        "current_page": 1,
                        "first_page_url": "http://host/api/v1/examples?page=1",
                        "last_page_url": "http://host/api/v1/examples?page=24",
                        "prev_page_url": null,
                        "next_page_url": "http://host/api/v1/examples?page=2",
                        "last_page": 24,
                        "per_page": 15,
                        "total": 346,
                        "first_item": 1,
                        "last_item": 15
                    }
            }  
            

### 0.1.4 Фильтрация [GET /example_collection{?page}{?name}{?email}]

+ Parameters

     + page: 1 (optional, Number) -  
     + name: Eladio (optional, String) -  
     + email: therese28@example.com (optional, String) -  

+ Response 200 (application/json)

    + Body
            
            {  
                "code": 0,
                "message": "",
                "data": [
                    {
                        "id": 1,
                        "name": "Eladio Schroeder Sr.",
                        "email": "therese28@example.com",
                        "roles": {
                            "id": "bb435e",
                            "name": "Администратор"
                        }
                    },
                    {
                        "id": 1,
                        "name": "Eladio Schroeder Sr.",
                        "email": "therese28@example.com",
                        "roles": {
                            "id": "bb435e",
                            "name": "Администратор"
                        }
                    }
                ],
                "pagination": 
                    {
                        "current_page": 1,
                        "first_page_url": "http://host/api/v1/examples?page=1",
                        "last_page_url": "http://host/api/v1/examples?page=24",
                        "prev_page_url": null,
                        "next_page_url": "http://host/api/v1/examples?page=2",
                        "last_page": 24,
                        "per_page": 15,
                        "total": 346,
                        "first_item": 1,
                        "last_item": 15
                    }
            }

### 0.1.5 Ошибка [POST /examples_errors?test={test}]

+ Parameters

     + test: Test ( String) -  

+ Response 400 (application/json)

    + Body
            
            {  
                "code": 7,
                "message": "Срок токена истек!"
            }

### 0.1.6 Ошибка при валидации [POST /examples_errors_validation?name={name}]

+ Parameters

     + name: Eladio ( String) -  

+ Response 400 (application/json)

    + Body
            
            {  
                "code": 12,
                "message": "Некоторые поля заполнены не верно!",
                "meta": {
                    "contractor_id": [
                        "Поле contractor id может содержать только буквы, цифры и дефис."
                    ],
                    "store_id": [
                        "Поле store id обязательно для заполнения."
                    ],
                    "items": [
                        "Поле items обязательно для заполнения."
                    ]
                }
            }


## 0.2 CRUD - Create, Read, Update, Delete [/examples_crud]

### 0.2.1 Создать (Create) [POST /examples_crud?name={name}&email={email}]

+ Parameters

     + name: Eladio ( String) -  
     + email: therese28@example.com (String) -  

+ Response 201 (application/json)

    + Body
            
            {  
                "code": 0,
                "message": "Example успешно создан",
                "data": 
                    {
                        "id": 1,
                        "name": "Eladio Schroeder Sr.",
                        "email": "therese28@example.com",
                        "roles": {
                            "id": "bb435e",
                            "name": "Администратор"
                        }
                    }
            }


### 0.2.2 Прочитать (Read) [GET /examples_crud/{id}]

+ Parameters

    + id: a636a577-a0c3-4380-a4f5-bb2fc268ed25 (Guid) -  

+ Response 200 (application/json)

    + Body
            
            {  
                "code": 0,
                "message": "",
                "data": 
                    {
                        "id": 1,
                        "name": "Eladio Schroeder Sr.",
                        "email": "therese28@example.com",
                        "roles": {
                            "id": "bb435e",
                            "name": "Администратор"
                        }
                    }
            }


### 0.2.3 Изменить (Update) [PUT /examples_crud/{id}?name={name}&email={email}]

+ Parameters

     + id: a636a577-a0c3-4380-a4f5-bb2fc268ed25 (Uuid) -  
     + name: Eladio ( String) -  
     + email: therese28@example.com (String) -  

+ Response 200 (application/json)

    + Body
            
            {  
                "message": "Example успешно изменен"
                "data": 
                    {
                        "id": 1,
                        "name": "Eladio Schroeder Sr.",
                        "email": "therese28@example.com",
                        "roles": {
                            "id": "bb435e",
                            "name": "Администратор"
                        }
                    }
            }

### 0.2.4 Удаление (Delete) [DELETE /examples_crud/{id}]

+ Parameters

     + id: a636a577-a0c3-4380-a4f5-bb2fc268ed25 (Uuid) -  

+ Response 200 (application/json)

    + Body
            
            {  
                "code": 0,
                "message": "Example успешно удалён"
            }

            
            
# Group 1. Регистрация

## 1.1 Регистрация/Авторизация [/auth]

### 1.1.1 Запрос при первоначальном запуске приложения [POST /auth/hello?device.id={device.id}&device.name={device.name}&device.model={device.model}&device.type={device.type}&device.appVersion={device.appVersion}&device.appMenuVersion={device.appMenuVersion}&device.os={device.os}&device.platform={device.platform}]

При первоначальном запросе передаётся временный токен `temporary_token`, который будет использоваться до получения основного токена `access_token`.

Расшифровка кодов обновеления приложения: `upgrade_app_status`

|Код|Тип|
|----|----|
|0|Обновление не требуется|
|1|Рекомендуется обновление|
|2|Необходимо обновление|

|params|regexp|
|---|---|
|device.id|regex:/^[A-Za-z0-9-]*$/|
|device.name|regex:/^[A-Za-z0-9- ]*$/|
|device.model|regex:/^[A-Za-z0-9- ]*$/|
|device.type|regex:/^[A-Za-z0-9]*$/|
|device.appVersion|regex:/^[A-Za-z0-9\.]*$/|
|device.appMenuVersion|regex:/^[A-Za-z0-9\.]*$/|
|device.os|regex:/^[A-Za-z0-9\.]*$/|
|device.platform|boolean|

+ Parameters
    
    + device.id: 550e8400e29b41d4a716446655440000  (DeviceUUID - string(30)) -  
    + device.name: Samsung G803T (DeviceName - string(30)) -  
    + device.model: Phone (DeviceType - string(30)) -  
    + device.type: 1.0.0 (AppVersion - string(30)) -  
    + device.appVersion: 1.0 (MenuIDVersion - string(30)) -  
    + device.appMenuVerion: 1.0 (OSVersion - string(30)) -  
    + device.os: 1.0 (OSVersion - string(30)) -  
    + device.platform: 0 (Platform (0-ios / 1-android)- string(30)) -  

+ Response 200

    + Body
            
            {  
                "code": 0,
                "meta": 
                    {
                        "phone" : {
                            "country_codes": ["992"],
                            "operator_codes":[ "92", "93", "98", "918"]
                        },
                        "temporary_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2xhcmF2ZWwtc3RvcmUtb25saW5lL3B1YmxpY19odG1sL2FwaS92MS9sb2dpbiIsImlhdCI6MTUxNDg2ODI0OCwiZXhwIjoxNTE0ODc1NDQ4LCJuYmYiOjE1MTQ4NjgyNDgsImp0aSI6IkVEeDlHR09ham9kV3VzZmkiLCJzdWIiOiIzYzc5OWY1NS0zZDRlLTQ5MWItYjUyMi1kNjkzZmNjN2I3NzQiLCJwcnYiOiI5NGRiZDk2MWFhZWYwZTNjZTY2YWQ3ZDUwZTY0NzcxNzYwOWRkYTI0In0.4cRj_ysVpj31oluXU5Lqci3vK_WcKpY-GuNTjwamxaQ",
                        "upgrade_app_status": 1,
                        "session_delay": 300,
                        "minimize_pin_lock_delay": 180,
                        "url_agreement": "url"
                        
                    }
            }

+ Response 400

    + Body
            
            {  
                "code": 9,
                "message":"Требуется обновление",
                "meta":
                    {
                        "upgrade_app_status": 2
                    }
            }


### 1.1.2 Отправка номера телефона для верификации и (запрос на повтор) отправки СМС кода [POST /auth/phone?msisdn={msisdn}]

+ Parameters

    + msisdn: 992927777777 (integer(12)) -  

+ Response 200

    + Body
            
            {  
                "code": 0,
                "meta":
                    {
                        "wait_seconds": 60,
                    }
            }


+ Response 400

    + Body
            
            {  
                "code": 11,
                "message":"Не истекло время ожидания",
                "meta":
                    {
                        "wait_seconds": 43,
                        "verify_phone_try_count": 2
                    }
            }


### 1.1.3 Отправка СМС-кода для подтверждения [POST /auth/phone/confirm?code={code}]


Если параметр `is_auth` является `false` необходимо предложить пользователю создать новый Пин-код, в противном случае необходимо ввести ранее созданный Пин-код

+ Parameters

    + code: 6328 (string(4)) -  

+ Response 200

    + Body
            
            {  
                "code": 0,
                "meta": 
                    {
                        "temporary_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2xhcmF2ZWwtc3RvcmUtb25saW5lL3B1YmxpY19odG1sL2FwaS92MS9sb2dpbiIsImlhdCI6MTUxNDg2ODI0OCwiZXhwIjoxNTE0ODc1NDQ4LCJuYmYiOjE1MTQ4NjgyNDgsImp0aSI6IkVEeDlHR09ham9kV3VzZmkiLCJzdWIiOiIzYzc5OWY1NS0zZDRlLTQ5MWItYjUyMi1kNjkzZmNjN2I3NzQiLCJwcnYiOiI5NGRiZDk2MWFhZWYwZTNjZTY2YWQ3ZDUwZTY0NzcxNzYwOWRkYTI0In0.4cRj_ysVpj31oluXU5Lqci3vK_WcKpY-GuNTjwamxaQ",
                        "is_auth": true
                    }
            }
        
+ Response 400

    + Body
            
            {  
                "code": 12,
                "message": "Ошибка верификации СМС-кода",
                "meta": 
                    {
                        "sms_confirm_try_count":1
                    }
            }

### 1.1.4 Отправка Пин-кода для регистрации [POST /register/pin?code={code}]

Дальнейщая связь между сервером происходит через `access_token`

После успешной регистрации, необходимо послать запрос на получение основных данных пользователя (для главного экрана) (3.1.1)

+ Parameters

    + code: 4455 (string(4)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"",
                "meta": {
                    "access_token": "uyruiy5nb7852q3tf578q3b54y78oq34btvqo3784qfvbp489vb7p23490qnpt78"
                }
            }

+ Response 400

    + Body
            
            {  
                "code": 5,
                "meta": 
                    {
                        "pin_confirm_try_count":1,
                        "wait_seconds": 60
                    }
            }


### 1.1.5 Отправка Пин-кода для авторизации [POST /auth/pin?code={code}]

+ Parameters

    + code: 4455 (string(4)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"",
                "data": 
                    {
                        "photo_url": "string", 
                        "first_name": "string",
                        "last_name": "string",
                        "middle_name": "string",
                        "attestation_name": "string",
                        "qr_code": "string",
                        "accounts": [
                            {
                                "balance": 1,
                                "number": "1231354556",
                                "currency_iso_name": "TJS",
                                "account_type_name": "ewallet"
                            }
                        ]
                    },
                "meta": {
                    "menu_version": 1,
                    "access_token": "uyruiy5nb7852q3tf578q3b54y78oq34btvqo3784qfvbp489vb7p23490qnpt78"
                }
            }


+ Response 400

    + Body
            
            {  
                "code": 5,
                "meta": 
                    {
                        "pin_confirm_try_count":1,
                        "wait_seconds": 60
                    }
            }


### 1.1.6 Запрос на восстановление Пин-кода [GET /reset/pin]

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":""
            }

+ Response 400

    + Body
            
            {  
                "code": 5,
                "meta": 
                    {
                        "pin_confirm_try_count":1,
                        "wait_seconds": 60
                    }
            }

### 1.1.7 Отправка СМС-кода для подтверждения для восстановления PIN-кода [POST /reset/pin/sms/verify?code={code}&msisdn={msisdn}]


Если параметр `user_exists` является `false` необходимо предложить пользователю создать новый Пин-код, в противном случае необходимо ввести ранее созданный Пин-код

+ Parameters

    + code: 6328 (string(4)) -  
    + msisdn: 992927777777 (string(12)) -  

+ Response 200

    + Body
            
            {  
                "code": 0,
                "meta": 
                    {
                        "temporary_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2xhcmF2ZWwtc3RvcmUtb25saW5lL3B1YmxpY19odG1sL2FwaS92MS9sb2dpbiIsImlhdCI6MTUxNDg2ODI0OCwiZXhwIjoxNTE0ODc1NDQ4LCJuYmYiOjE1MTQ4NjgyNDgsImp0aSI6IkVEeDlHR09ham9kV3VzZmkiLCJzdWIiOiIzYzc5OWY1NS0zZDRlLTQ5MWItYjUyMi1kNjkzZmNjN2I3NzQiLCJwcnYiOiI5NGRiZDk2MWFhZWYwZTNjZTY2YWQ3ZDUwZTY0NzcxNzYwOWRkYTI0In0.4cRj_ysVpj31oluXU5Lqci3vK_WcKpY-GuNTjwamxaQ",
                        "user_exists": true
                    }
            }
        
+ Response 400

    + Body
            
            {  
                "code": 12,
                "message": "Ошибка верификации СМС-кода",
                "meta": 
                    {
                        "sms_confirm_try_count":1
                    }
            }


### 1.1.8 Отправка Пин-кода для восстановления [POST /reset/pin?hash_code={hash_code}]

Пин-код будет шифроваться по алгоритму: DeviceID? + code + access_token.

+ Parameters

    + hash_code: w34f5893482734ynfp89234fyonu34ifnop34u9ryhq3 (string(255)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"",
                "data": 
                    {
                        "photo_url": "string", 
                        "first_name": "string",
                        "last_name": "string",
                        "middle_name": "string",
                        "menu_version": 1,
                        "attestation_name": "string",
                        "security_percentage":60, 
                        "qr_code": "string",
                        "accounts": [
                            {
                                "balance": 1,
                                "number": "1231354556",
                                "currency_iso_name": "TJS",
                                "account_type_name": "ewallet"
                            }
                        ]
                    },
                "meta": {
                    "access_token": "uyruiy5nb7852q3tf578q3b54y78oq34btvqo3784qfvbp489vb7p23490qnpt78"
                }
            }


+ Response 400

    + Body
            
            {  
                "code": 5,
                "meta": 
                    {
                        "pin_confirm_try_count":1,
                        "wait_seconds": 60
                    }
            }

### 1.1.9 (2 этап проекта) Отправка Секретного пароля для регистрации/авторизации/восстановления (ссылка на профиль пользователя) (через смс и почту - Клиент банка/ через почту - Идентифицированный / через смс - Неидентифицированный) [POST /auth/pass?secret_pass={secret_pass}]

+ Parameters

    + secret_pass: Abc1254 (string(8-30)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"",
                "data": 
                    {
                        "first_name": "string",
                        "last_name": "string",
                        "middle_name": "string",
                        "menu_version": 1,
                        "accounts": [
                            {
                                "balance": 1,
                                "account_number": "1231354556"
                            }
                        ]
                    }
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "meta": 
                    {
                        "password_confirm_try_count":1,
                        "wait_seconds": 60
                    }
            }

### 1.1.10 (2 этап проекта) Запроc на восстановление Секретного пароля[GET /auth/restore_pass]

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":""
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "meta": 
                    {
                        "password_confirm_try_count":1,
                        "wait_seconds": 60
                    }
            }

### 1.1.11 Запрос на получение нового токена [POST /auth/token/refresh]


+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"",
                "meta": {
                    "access_token": "uyruiy5nb7852q3tf578q3b54y78oq34btvqo3784qfvbp489vb7p23490qnpt78"
                }
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":"Ошибка авторизации"
            }



# Group 2. Пользователи

## 2.1 Профиль [/user]

### 2.1.1 Запрос основных данных пользователя [GET /users/main]

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"",
                "data": 
                    {
                        "photo_url": "string", 
                        "first_name": "string",
                        "last_name": "string",
                        "middle_name": "string",
                        "date_birth": "string",
                        "gender": 1,
                        "username": "string",
                        "email": "string",
                        "attestation_name": "string",
                        "qr_code": "string",
                        "accounts": [
                            {
                                "balance": 1,
                                "number": "1231354556",
                                "currency_iso_name": "TJS",
                                "account_type_name": "ewallet"
                            }
                        ]
                    },
                "meta":
                    {
                        "menu_version": 1,
                        "is_editable": 1
                    }
            }

        
+ Response 400

    + Body
            
            {  
                "code": 5,
                "message":"Ошибка авторизации"
            }


### 2.1.2 Отправка данных пользователя для изменения [PUT /users/profile?first_name={first_name}&last_name={last_name}&middle_name={middle_name}&date_birth={date_birth}&gender={gender}&photo={photo}]

+ Parameters

    + first_name: Текст (string(30)) -  
    + last_name: Текст (string(30)) -  
    + middle_name: Текст (string(30)) -  
    + date_birth: Текст (string(30)) -  
    + gender: 1 (int(1)) -  
    + photo: image (file) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":""
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }
        

## 2.2 Счета [/accounts]

### 2.2.1 Запрос текущего баланса [GET /accounts/summary/{account_number}]

+ Parameters

    + account_number: 123456789987654 (string(30)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message": "",
                "data" : {
                    "balance": 1,
                    "number": "1231354556",
                    "currency_iso_name": "TJS",
                    "account_type_name": "ewallet"
                    
                }
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }

### 2.2.2 Запрос текущего баланса с текущими состояниями лимитов [GET /accounts/{account_number}]

+ Parameters

    
    + account_number: 123456789987654 (string(30)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message": "",
                "data" : {
                    "balance": 1,
                    "number": "1231354556",
                    "currency_iso_name": "TJS",
                    "account_type_name": "ewallet",
                    "current_limit":{
                        "day_limit": 1000,
                        "week_limit": 5000,
                        "month_limit": 10000
                    }
                }
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }



## 2.3 Аттестация [/attestations]

### 2.3.1 Запрос списка типов аттестата [GET /attestations]

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message": "",
                "data" : [
                    {
                        "name": "Неидентифицированный",
                        "day_limit": 1000,
                        "week_limit": 5000,
                        "month_limit": 10000,
                        "is_active": true,
                        "used_limit": {
                            "day_limit": 100,
                            "week_limit": 500,
                            "month_limit": 1000
                        }
                    },
                    {
                        "name": "Идентифицированный",
                        "day_limit": 1000,
                        "week_limit": 5000,
                        "month_limit": 10000
                    },
                    {
                        "name": "Клиент банка",
                        "day_limit": 1000,
                        "week_limit": 5000,
                        "month_limit": 10000
                    }
                ]
            }
               

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }


## 2.4 Настройки [/settings]

### 2.4.1 Изменение Пин-кода [PUT /settings/pin?old_pin_hash={old_pin_hash}&new_pin={new_pin}]

+ Parameters

    + old_pin_hash: 3jghc4u2yt34ui3ueq (string(30)) -  
    + new_pin: 4567 (string(4)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message": "",
                "meta": {
                    "access_token": "ui4ti76tfibuyrtbwcfi76rtfvbi7oq784brtg8tb4o987ebt"
                }
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }

### 2.4.2 Запрос списка типов оповещения [GET /settings/notifications]

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message": "",
                "data":{
                    
                    "notifications":[
                        {
                            "name" : "SMS уведомления",
                            "code": "sms",
                            "is_active": "false",
                            "comment": "5 смн в месяц"
                        },
                        {
                            "name" : "Push уведомления",
                            "code": "push",
                            "is_active": "true"
                            
                        },
                        {
                            "name" : "Email уведомления",
                            "code": "emailnt",
                            "is_active": "true",
                             "comment": "Не привязано"
                        }
                    ],
                    
                    "email":  {
                        "is_active": "true",
                        "value": "aganemnam@mail.ru"
                    }
                    
                }
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }

### 2.4.3 Изменение типа оповещения [PUT /settings/notifications?code={code}&is_active={is_active}]

+ Parameters
   + is_active: 1  (boolean)
   + code (enum[string])

       code of a notification type

       + Members
           + `sms`
           + `push`
           + `email`

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message": ""
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }

### 2.4.4 Email для регистрации/смены [POST /settings/email?email={email}]

+ Parameters

    + email: mail@eskhata.com (string(30)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"На вашу почту было отправлено письмо с сылкой для подтверждения."
            }

+ Response 400

    + Body
    
            {  
                "code": 12,
                "message":"Ошибка валидации"
                
            }

### 2.4.5 Отправка Email кода для подтверждения [POST /settings/email/verify?hash_code={hash_code}]

+ Parameters

    + hash_code: "fgdhvn234tholbkspgjkslrigsvjrgermg" (string(30)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":""
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }

# Group 3. Операторы услуг

## 3.1 Операторы услуг [/services]

### 3.1.1 Запрос списка названий всех сервисов оплаты с иерархией категорий [GET /services]

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"",
                "data":[
                    {
                        "name_ru": "Оплата услуг",
                        "name_en": "Paying services",
                        "name_tj": "Пардохти хизматрасонихо",
                        "code":"pay_service",
                        "type":"category",
                        "icon":"URL",
                        "is_active":1,
                        "child":[
                            {
                                "name":"Мобильная связь",
                                "code":"pay_service",
                                "icon":"URL",
                                "type":"category",
                                "is_active":1,
                                "child":[
                                    {
                                        "name":"Tcell",
                                        "code":"10",
                                        "icon":"URL",
                                        "type":"service",
                                        "currency_iso":"TJS",
                                        "is_active":1
                                    },
                                    {
                                        "name":"Babilon",
                                        "code":"11",
                                        "icon":"URL",
                                        "type":"service",
                                        "currency_iso":"TJS",
                                        "is_active":1
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }

### 3.1.2 Запрос всех данных указанного оператора [GET /services/{code}]


+ Parameters

    + code: 10 (string(36)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"",
                "data":{
                    "name":"Tcell",
                    "code":"10",
                    "icon":"URL",
                    "type":"service",
                    "currency_iso":"TJS",
                    "is_requestable_balance": 0,
                    "min_amount":"1",
                    "max_amount":"10",
                    "is_active":1,
                    "workdays": {
                            "w1": "0-23",
                            "w2": "0-23",
                            "w3": "0-23",
                            "w4": "0-23",
                            "w5": "0-23",
                            "w6": "0-23",
                            "w7": "0-23"
                    },
                    "comission":[
                        {
                            "min":1,
                            "max":2.99,
                            "is_percentage":0,
                            "value": 0.1
                        },
                        {
                            "min":3,
                            "max":40,
                            "is_percentage":1,
                            "value": 3
                        },
                        {
                            "min":40,
                            "max":99999999,
                            "is_percentage":0,
                            "value": 0
                        }
                    ],
                    "params":[
                            {   
                                "input_placeholder": "Номер телефона",
                                "input_name": "phone_number",
                                "input_type": "text",
                                "chars_mask": "** *** ** **",
                                "keyboard_type":"phone",
                                "regexp":"234i5uh2krnasdfjksdkfl",
                                "icon_url": "URL"
                                
                            }
                        ]
                    }
                
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }





### 3.1.3 Запрос остатка баланса услуги [GET /services/{code}/balance?params={params}]


+ Parameters

    + code: 10 (string(36)) -  
    + params: array (string) -
    
+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"",
                "data":{
                    "comment":"Ваш остаток равен 201 сомони"
                }
                
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }





# Group 4. Транзакции

## 4.1 Перевод между кошельками и оплата услуг [/transactions]

### 4.1.1 Создать документ по переводу между кошельками или оплате услуг [POST /transactions?service_id={service_id}&amount={amount}&commission={commission}&params={params}&transaction_type={transaction_type}&from_account_number={from_account_number}]

+ Parameters

    + service_id: sdfw3rci23y54f3y473v54fv3 (string(36)) -  
    + amount: 100 (double) -  
    + commission: json (string) -
    + params: json (string) -  
    + transaction_type: name (string) - 
    + from_account_number: number (string) -
    
+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":""
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }

### 4.1.2 Запрос детальных данных документа по переводу или оплате [GET /transactions/{id}]

+ Parameters

    + id: rtsdfw3rci23y54f3y473v54fv3 (string(36)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"",
                "data": {
                    "service_name": "string",
                    "amount": 1.0,
                    "commission": 1.0,
                    "amount_all": 1.0,
                    "params": "json_array",
                    "transaction_type": "string",
                    "comment": "string",
                    "currency_rate_value": 1.0,
                    "currency_iso_name": "string",
                    "created_at": "",
                    "account_number": 1.0,
                    "session_number": 1,
                    "transactions_status":{
                        "code": 1,
                        "name": "string",
                        "color": "string"
                    },
                    "transactions_status_detail":{
                        "code": 1,
                        "name": "string",
                        "color": "string"
                    }
                }
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }


## 4.2 История [/templates2]

### 4.2.1 Запрос списка платежного документа [POST /transactions/histories]

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"",
                "data": [
                    {
                        "category_name": "string",
                        "service_name": "string",
                        "service_icon": "url",
                        "amount_all": 1.0,
                        "params":  {
                            "input_name": "phone_number",
                            "input_value": "2131414515"
                        },
                        "transaction_type_code": "string",
                        "currency_iso_name": "string",
                        "created_at": "2018-06-09 13:01:43",
                        "transactions_status":{
                            "code": 1,
                            "name": "string",
                            "color": "string"
                        }
                    }
                ]
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }


# Group 5. Шаблоны

## 5.1 Шаблоны/Избранные [/templates]

### 5.1.1 Запрос списка шаблонов пользователя [GET /templates]

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"",
                "data":[
                    {
                        "id": "550e8400-e29b-41d4-a716-446655440000",
                        "name": "string",
                        "service_id": "string",
                        "service_icon": "url",
                        "amount": 1,
                        "params": [ 
                            {
                                "input_name": "phone_number",
                                "input_value": "2131414515"
                            }
                        ]
                    }
                ]
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }

### 5.1.2 Добавление шаблона [POST /templates?name={name}&service_id={service_id}&amount={amount}&params={params}]


**Пример формата значения параметра `params` для отправки на сервер**

params[0]["input_name"] = "card_number"

params[0]["input_value"] = "2642657237894612378412"

params[1]["input_name"] = "phone_number"

params[1]["input_value"] = "992927777777"


+ Parameters

    + name: текст (string(30)) -  
    + service_id: текст (char(36)) -  
    + amount: 1 (double) -  
    + params: текст (string(30)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":""
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }
            

### 5.1.3 Изменение шаблона [PUT /templates/{id}?name={name}&service_id={service_id}&amount={amount}&params={params}]

+ Parameters

    + id: 550e8400-e29b-41d4-a716-446655440000 (string(36)) -  
    + name: текст (string(30)) -  
    + service_id: текст (char(36)) -  
    + amount: 1 (double) -  
    + params: текст (string(30)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":""
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }

### 5.1.4 Удаление шаблона [DELETE /templates/{id}]

+ Parameters

    + id: 550e8400-e29b-41d4-a716-446655440000 (char(36)) -  

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":""
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }




# Group 6. Прочие API 

##  6. Прочие API [/others]

### 6.1.1 Запрос курсов валют на текущий момент [POST /currencies]

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"2018-06-09 13:01:43",
                "data": [
                    {
                        "name": "string",
                        "short_name": "string",
                        "iso_name": "string",
                        "symbol_left": "string",
                        "symbol_right": "string",
                        "rate_buy": 1.0,
                        "rate_sell": 1.0
                    }
                ]
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }



### 6.1.2 Запрос описания уловия оферты [POST /agreement]

+ Response 200 

    + Body 
    
            {  
                "code": 0,
                "message":"",
                "data": {
                    "url": "string"
                }
            }

+ Response 400

    + Body
    
            {  
                "code": 5,
                "message":""
            }