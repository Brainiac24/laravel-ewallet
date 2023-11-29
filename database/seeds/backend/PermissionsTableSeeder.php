<?php

use App\Models\User\Permission\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PermissionsTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
//USERS
            ['name' => 'user-list', 'display_name' => 'Пользователи : Раздел\Список'],
            ['name' => 'user-show', 'display_name' => 'Пользователи : Просмотр'],
            ['name' => 'user-create', 'display_name' => 'Пользователи : Добавление'],
            ['name' => 'user-edit', 'display_name' => 'Пользователи : Редактирование'],
            ['name' => 'user-edit-admin', 'display_name' => 'Пользователи: Редактирование Администратора'],
            ['name' => 'user-edit-block', 'display_name' => 'Пользователи: Блокирование И Разблокирование'],
            ['name' => 'user-delete-email', 'display_name' => 'Пользователи: Удаление почты'],
            ['name' => 'user-unlock-manage', 'display_name' => 'Пользователи: Разблокировка'],
            ['name' => 'user-lock-manage', 'display_name' => 'Пользователи: Блокировка'],
//           , 'name' => 'user-delete', 'display_name' => 'Пользователи: Удаление'],

//CLIENTS
            ['name' => 'client-list', 'display_name' => 'Клиенты : Раздел\Список'],
            ['name' => 'client-lock-manage', 'display_name' => 'Клиенты : Блокирование'],
            ['name' => 'client-unlock-manage', 'display_name' => 'Клиенты : Разблокировка'],
            ['name' => 'client-delete-email', 'display_name' => 'Клиенты : Удаление Email'],
            ['name' => 'client-show', 'display_name' => 'Клиенты : Просмотр'],
            ['name' => 'client-create', 'display_name' => 'Клиенты : Добавление'],
            ['name' => 'client-edit', 'display_name' => 'Клиенты : Редактирование'],
            ['name' => 'client-identificate', 'display_name' => 'Клиенты : Идентификация'],
            ['name' => 'client-identificate-for-admin', 'display_name' => 'Клиенты : Идентификация (для администратора)'],
            ['name' => 'client-update-lite', 'display_name' => 'Клиенты : Изменить (Урезанная версия)'],
            ['name' => 'client-edit-admin', 'display_name' => 'Клиенты: Редактирование Администратора'],
            ['name' => 'client-addCodeMap', 'display_name' => 'Клиенты: Добавление ABS-код'],
            ['name' => 'client-histories', 'display_name' => 'Клиенты: История действий'],
            ['name' => 'client-deleteCodeMap', 'display_name' => 'Клиенты: Удаление ABS-код'],
            ['name' => 'client-resetPassword', 'display_name' => 'Клиенты: Сбросить пароль и секретное слово'],
            ['name' => 'client-delete-pin', 'display_name' => 'Клиенты : Удаление ПИН'],


//USERS_ROLES

//Dashboard
            ['name' => 'dashboard-list', 'display_name' => 'Dashboard : Раздел'],
//SETTINGS
            ['name' => 'settings', 'display_name' => 'Настройки : Управление'],
//USER_FAVORITES
            ['name' => 'user-favorite-list', 'display_name' => 'Пользователи -> Избранное : Раздел\Список'],
            ['name' => 'user-favorite-show', 'display_name' => 'Пользователи -> Избранное : Просмотр'],
            ['name' => 'user-favorite-create', 'display_name' => 'Пользователи -> Избранное : Добавление'],
            ['name' => 'user-favorite-delete', 'display_name' => 'Пользователи -> Избранное : Удаление'],
            ['name' => 'user-favorite-edit', 'display_name' => 'Пользователи -> Избранное : Редактирование'],
//USER_HISTORY
            ['name' => 'user-history-list', 'display_name' => 'Пользователи -> История : Раздел\Список'],
            ['name' => 'user-history-show', 'display_name' => 'Пользователи -> История : Просмотр'],
          //  ['name' => 'user-history-create', 'display_name' => 'Пользователи -> История : Добавление'],
          //  ['name' => 'user-history-delete', 'display_name' => 'Пользователи -> История : Удаление'],
          //  ['name' => 'user-history-edit', 'display_name' => 'Пользователи -> История : Редактирование'],
//USER_LIMITS
            ['name' => 'user-limit-list', 'display_name' => 'Пользователи -> Лимиты : Раздел\Список'],
            ['name' => 'user-limit-show', 'display_name' => 'Пользователи -> Лимиты : Просмотр'],
            ['name' => 'user-limit-create', 'display_name' => 'Пользователи -> Лимиты : Добавление'],
            ['name' => 'user-limit-delete', 'display_name' => 'Пользователи -> Лимиты : Удаление'],
            ['name' => 'user-limit-edit', 'display_name' => 'Пользователи -> Лимиты : Редактирование'],
//TRANSACTIONS
            ['name' => 'transaction-list', 'display_name' => 'Транзакции : Раздел\Список'],
            ['name' => 'transaction-show', 'display_name' => 'Транзакции : Просмотр'],
            ['name' => 'transaction-create', 'display_name' => 'Транзакции : Добавление'],
            ['name' => 'transaction-edit', 'display_name' => 'Транзакции : Редактирование'],
            ['name' => 'transaction-can-resend', 'display_name' => 'Транзакции : Перемешять в очередь'],
            ['name' => 'transaction-changeTransactionSyncStatus', 'display_name' => 'Транзакции : Редактирование статус синхронизации'],
//TRANSACTION_CONTINUERULE
            ['name' => 'transaction-continue-rule-list', 'display_name' => 'Правило для продолжения транзакции : Раздел\Список'],
            ['name' => 'transaction-continue-rule-show', 'display_name' => 'Правило для продолжения транзакции : Просмотр'],
            ['name' => 'transaction-continue-rule-create', 'display_name' => 'Правило для продолжения транзакции : Добавление'],
            ['name' => 'transaction-continue-rule-edit', 'display_name' => 'Правило для продолжения транзакции : Редактирование'],
            ['name' => 'transaction-continue-rule-delete', 'display_name' => 'Правило для продолжения транзакции : Удаление'],
//TRANSACTION_CONTINUERULEACCORANDCE
            ['name' => 'transaction-continue-rule-accordance-list', 'display_name' => 'Продложить соответсие правила для транзакции : Раздел\Список'],
            ['name' => 'transaction-continue-rule-accordance-show', 'display_name' => 'Продложить соответсие правила для транзакции : Просмотр'],
            ['name' => 'transaction-continue-rule-accordance-create', 'display_name' => 'Продложить соответсие правила для транзакции : Добавление'],
            ['name' => 'transaction-continue-rule-accordance-edit', 'display_name' => 'Продложить соответсие правила для транзакции : Редактирование'],
            ['name' => 'transaction-continue-rule-accordance-delete', 'display_name' => 'Продложить соответсие правила для транзакции : Удаление'],
//TRANSACTIONS_HISTORY
            ['name' => 'transaction-history-list', 'display_name' => 'Транзакции -> История : Раздел\Список '],
            ['name' => 'transaction-history-show', 'display_name' => 'Транзакции -> История : Просмотр'],
//TRANSACTION_TYPE
            ['name' => 'transaction-type-list', 'display_name' => 'Транзакции -> Типы : Раздел\Список'],
//TRANSACTION_STATUS
            ['name' => 'transaction-status-list', 'display_name' => 'Транзакции -> Статусы : Раздел\Список'],
//TRANSACTION_DETAIL_STATUS
            ['name' => 'transaction-status-detail-list', 'display_name' => 'Транзакции -> Детальные статусы : Раздел\Список'],

            ['name' => 'transaction-status-group-list', 'display_name' => 'Транзакции -> Группа статусов : Раздел\Список'],
            ['name' => 'transaction-status-group-show', 'display_name' => 'Транзакции -> Группа статусов : Просмотр'],

            ['name' => 'transaction-sync-status-list', 'display_name' => 'Транзакции -> Статус синхронизации : Раздел\Список'],
            ['name' => 'transaction-sync-status-show', 'display_name' => 'Транзакции -> Статус синхронизации : Просмотр'],

//SERVICES
            ['name' => 'service-list', 'display_name' => 'Сервисы : Раздел\Список'],
            ['name' => 'service-show', 'display_name' => 'Сервисы : Просмотр'],
            ['name' => 'service-create', 'display_name' => 'Сервисы : Добавление'],
            ['name' => 'service-edit', 'display_name' => 'Сервисы : Редактирование'],
            ['name' => 'service-delete', 'display_name' => 'Сервисы : Удаление'],
//SERVICES_MENU
            ['name' => 'service-menu-list', 'display_name' => 'Меню : Раздел\Список'],
            ['name' => 'service-menu-show', 'display_name' => 'Меню : Просмотр'],
            ['name' => 'service-menu-edit', 'display_name' => 'Меню : Редактирование'],
            ['name' => 'service-menu-delete', 'display_name' => 'Меню : Удаление'],
            ['name' => 'service-menu-create', 'display_name' => 'Меню : Добавление'],
//SERVICES_LIMITS
            ['name' => 'service-limit-list', 'display_name' => 'Сервисы -> Лимиты : Раздел\Список'],
            ['name' => 'service-limit-show', 'display_name' => 'Сервисы -> Лимиты : Просмотр'],
            ['name' => 'service-limit-edit', 'display_name' => 'Сервисы -> Лимиты : Редактирование'],
            ['name' => 'service-limit-delete', 'display_name' => 'Сервисы -> Лимиты : Удаление'],
            ['name' => 'service-limit-create', 'display_name' => 'Сервисы -> Лимиты : Добавление'],
//SERVICES_COMMISSIONS
            ['name' => 'service-commission-list', 'display_name' => 'Сервисы -> Комиссии : Раздел\Список'],
            ['name' => 'service-commission-show', 'display_name' => 'Сервисы -> Комиссии : Просмотр'],
            ['name' => 'service-commission-edit', 'display_name' => 'Сервисы -> Комиссии : Редактирование'],
            ['name' => 'service-commission-delete', 'display_name' => 'Сервисы -> Комиссии : Удаление'],
            ['name' => 'service-commission-create', 'display_name' => 'Сервисы -> Комиссии : Добавление'],
//SERVICES_WORKDAYS
            ['name' => 'service-workday-list', 'display_name' => 'Сервисы -> Рабочие дни : Раздел\Список'],
            ['name' => 'service-workday-show', 'display_name' => 'Сервисы -> Рабочие дни : Просмотр'],
            ['name' => 'service-workday-edit', 'display_name' => 'Сервисы -> Рабочие дни : Редактирование'],
            ['name' => 'service-workday-delete', 'display_name' => 'Сервисы -> Рабочие дни : Удаление'],
            ['name' => 'service-workday-create', 'display_name' => 'Сервисы -> Рабочие дни : Добавление'],
//SERVICES_CATEGORY
            ['name' => 'service-category-list', 'display_name' => 'Категории сервисов : Раздел\Список'],
            ['name' => 'service-category-show', 'display_name' => 'Категории сервисов : Просмотр'],
            ['name' => 'service-category-edit', 'display_name' => 'Категории сервисов : Редактирование'],
            ['name' => 'service-category-delete', 'display_name' => 'Категории сервисов : Удаление'],
            ['name' => 'service-category-create', 'display_name' => 'Категории сервисов : Добавление'],
//ACCOUNTS
            ['name' => 'account-list', 'display_name' => 'Счета : Раздел\Список'],
            ['name' => 'account-show', 'display_name' => 'Счета : Просмотр'],
            ['name' => 'account-edit', 'display_name' => 'Счета : Редактирование'],
//            ['name' => 'account-delete', 'display_name' => 'Счета : Удаление'],
            ['name' => 'account-create', 'display_name' => 'Счета : Добавление'],
//ACCOUNTS_HISTORY
            ['name' => 'account-history-list', 'display_name' => 'Счета -> Истории : Раздел\Список'],
            ['name' => 'account-history-show', 'display_name' => 'Счета -> Истории : Просмотр'],
//ACCOUNTS_TYPE
            ['name' => 'account-type-list', 'display_name' => 'Счета -> Типы : Раздел\Список'],
            ['name' => 'account-type-edit', 'display_name' => 'Счета -> Типы : Редактирование'],
            ['name' => 'account-type-delete', 'display_name' => 'Счета -> Типы : Удаление'],
            ['name' => 'account-type-create', 'display_name' => 'Счета -> Типы : Добавление'],
            ['name' => 'account-type-show', 'display_name' => 'Счета -> Типы : Просмотр'],
//CURRENCIES
            ['name' => 'currency-list', 'display_name' => 'Валюты : Раздел\Список'],
            ['name' => 'currency-show', 'display_name' => 'Валюты : Просмотр'],
            ['name' => 'currency-edit', 'display_name' => 'Валюты : Редактирование'],
            ['name' => 'currency-delete', 'display_name' => 'Валюты : Удаление'],
            ['name' => 'currency-create', 'display_name' => 'Валюты : Добавление'],
//CURRENCY_RATE
            ['name' => 'currency-rate-list', 'display_name' => 'Курсы валют : Раздел\Список'],
            ['name' => 'currency-rate-show', 'display_name' => 'Курсы валют : Просмотр'],
            ['name' => 'currency-rate-edit', 'display_name' => 'Курсы валют : Редактирование'],
            ['name' => 'currency-rate-delete', 'display_name' => 'Курсы валют : Удаление'],
            ['name' => 'currency-rate-create', 'display_name' => 'Курсы валют : Добавление'],
//CURRENCY_RATE_HISTORY
            ['name' => 'currency-rate-hist-list', 'display_name' => 'Курсы валют -> История : Раздел\Список'],
            ['name' => 'currency-rate-hist-show', 'display_name' => 'Курсы валют -> История : Просмотр'],
//            ['name' => 'currency-rate-hist-edit', 'display_name' => 'Курсы валют -> История : Редактирование'],
//            ['name' => 'currency-rate-hist-delete', 'display_name' => 'Курсы валют -> История : Удаление'],
//            ['name' => 'currency-rate-hist-create', 'display_name' => 'Курсы валют -> История : Добавление'],
//GATEWAY
            ['name' => 'gateways', 'display_name' => 'Шлюзы : Управление'],
//ATTESTATION
            ['name' => 'attestation-list', 'display_name' => 'Аттестации : Раздел\Список'],
//COORDINATES_POINT
            ['name' => 'coordinates-point-list', 'display_name' => 'Пункты обслуживания: Раздел\Список'],
            ['name' => 'coordinates-point-show', 'display_name' => 'Пункты обслуживания: Просмотр'],
            ['name' => 'coordinates-point-edit', 'display_name' => 'Пункты обслуживания: Редактирование'],
            ['name' => 'coordinates-point-delete', 'display_name' => 'Пункты обслуживания: Удаление'],
            ['name' => 'coordinates-point-create', 'display_name' => 'Пункты обслуживания: Добавление'],

            //COORDINATES_POINT_WORKDAY
            ['name' => 'coordinates-point-workday-list', 'display_name' => 'Пункты обслуживания Рабочие дни: Раздел\Список'],
            ['name' => 'coordinates-point-workday-show', 'display_name' => 'Пункты обслуживания Рабочие дни: Просмотр'],
            ['name' => 'coordinates-point-workday-edit', 'display_name' => 'Пункты обслуживания Рабочие дни: Редактирование'],
            ['name' => 'coordinates-point-workday-delete', 'display_name' => 'Пункты обслуживания Рабочие дни: Удаление'],
            ['name' => 'coordinates-point-workday-create', 'display_name' => 'Пункты обслуживания Рабочие дни: Добавление'],

            //COORDINATES_POINT_TYPE
            ['name' => 'coordinates-point-type-list', 'display_name' => 'Пункты обслуживания тип: Раздел\Список'],
            ['name' => 'coordinates-point-type-show', 'display_name' => 'Пункты обслуживания тип: Просмотр'],
            ['name' => 'coordinates-point-type-edit', 'display_name' => 'Пункты обслуживания тип: Редактирование'],
            ['name' => 'coordinates-point-type-delete', 'display_name' => 'Пункты обслуживания тип: Удаление'],
            ['name' => 'coordinates-point-type-create', 'display_name' => 'Пункты обслуживания тип: Добавление'],

            //COORDINATES_POINT_TYPE_SERVICE
            ['name' => 'coordinates-point-type-service-list', 'display_name' => 'Пункты обслуживания тип сервис: Раздел\Список'],
            ['name' => 'coordinates-point-type-service-show', 'display_name' => 'Пункты обслуживания тип сервис: Просмотр'],
            ['name' => 'coordinates-point-type-service-edit', 'display_name' => 'Пункты обслуживания тип сервис: Редактирование'],
            ['name' => 'coordinates-point-type-service-delete', 'display_name' => 'Пункты обслуживания тип сервис: Удаление'],
            ['name' => 'coordinates-point-type-service-create', 'display_name' => 'Пункты обслуживания тип сервис: Добавление'],

            //COORDINATES_POINT_SERVICE
            ['name' => 'coordinates-point-service-list', 'display_name' => 'Пункты обслуживания сервис: Раздел\Список'],
            ['name' => 'coordinates-point-service-show', 'display_name' => 'Пункты обслуживания сервис: Просмотр'],
            ['name' => 'coordinates-point-service-edit', 'display_name' => 'Пункты обслуживания сервис: Редактирование'],
            ['name' => 'coordinates-point-service-delete', 'display_name' => 'Пункты обслуживания сервис: Удаление'],
            ['name' => 'coordinates-point-service-create', 'display_name' => 'Пункты обслуживания сервис: Добавление'],

            //COORDINATES_POINT_CITY
            ['name' => 'coordinates-point-city-list', 'display_name' => 'Пункты обслуживания город: Раздел\Список'],
            ['name' => 'coordinates-point-city-show', 'display_name' => 'Пункты обслуживания город: Просмотр'],
            ['name' => 'coordinates-point-city-edit', 'display_name' => 'Пункты обслуживания город: Редактирование'],
            ['name' => 'coordinates-point-city-delete', 'display_name' => 'Пункты обслуживания город: Удаление'],
            ['name' => 'coordinates-point-city-create', 'display_name' => 'Пункты обслуживания город: Добавление'],

            //Country
            ['name' => 'country-list', 'display_name' => 'Страна : Раздел\Список'],
            ['name' => 'country-show', 'display_name' => 'Страна : Просмотр'],
            ['name' => 'country-edit', 'display_name' => 'Страна : Редактирование'],
            ['name' => 'country-delete', 'display_name' => 'Страна : Удаление'],
            ['name' => 'country-create', 'display_name' => 'Страна : Добавление'],

            //Region
            ['name' => 'region-list', 'display_name' => 'Регоин : Раздел\Список'],
            ['name' => 'region-show', 'display_name' => 'Регион : Просмотр'],
            ['name' => 'region-edit', 'display_name' => 'Регион : Редактирование'],
            ['name' => 'region-delete', 'display_name' => 'Регион : Удаление'],
            ['name' => 'region-create', 'display_name' => 'Регион : Добавление'],

            //Area
            ['name' => 'area-list', 'display_name' => 'Район : Раздел\Список'],
            ['name' => 'area-show', 'display_name' => 'Район : Просмотр'],
            ['name' => 'area-edit', 'display_name' => 'Район : Редактирование'],
            ['name' => 'area-delete', 'display_name' => 'Район : Удаление'],
            ['name' => 'area-create', 'display_name' => 'Район : Добавление'],

            //City
            ['name' => 'city-list', 'display_name' => 'Город : Раздел\Список'],
            ['name' => 'city-show', 'display_name' => 'Город : Просмотр'],
            ['name' => 'city-edit', 'display_name' => 'Город : Редактирование'],
            ['name' => 'city-delete', 'display_name' => 'Город : Удаление'],
            ['name' => 'city-create', 'display_name' => 'Город : Добавление'],

            //LicenseAgreement
            ['name' => 'license-show', 'display_name' => 'Оферта : Просмотр'],
            ['name' => 'license-edit', 'display_name' => 'Оферта : Редактирование'],

            // Registry
            ['name' => 'registries', 'display_name' => 'Реестр: Управление'],

            // DocApi
            ['name' => 'docapi-list', 'display_name' => 'API документация: Раздел\Список'],

            // AccountStatus
            ['name' => 'account-status-list', 'display_name' => 'Статус счета: Раздел\Список'],
            ['name' => 'account-status-show', 'display_name' => 'Статус счета : Просмотр'],
            ['name' => 'account-status-edit', 'display_name' => 'Статус счета : Редактирование'],
            ['name' => 'account-status-delete', 'display_name' => 'Статус счета : Удаление'],
            ['name' => 'account-status-create', 'display_name' => 'Статус счета : Добавление'],

            // JobLog
            ['name' => 'jobLog-list', 'display_name' => 'Журнал задач: Раздел\Список'],
            ['name' => 'jobLog-show', 'display_name' => 'Журнал задач: Просмотр'],

            // AccountCategoryType
            ['name' => 'account-categoryType-list', 'display_name' => 'Категория счетов: Раздел\Список'],
            ['name' => 'account-categoryType-show', 'display_name' => 'Категория счетов: Просмотр'],
            ['name' => 'account-categoryType-edit', 'display_name' => 'Категория счетов: Редактирование'],

            // Bank
            ['name' => 'bank-list', 'display_name' => 'Банк: Раздел\Список'],
            ['name' => 'bank-show', 'display_name' => 'Банк: Просмотр'],
            ['name' => 'bank-edit', 'display_name' => 'Банк: Редактирование'],
            ['name' => 'bank-delete', 'display_name' => 'Банк: Удаление'],
            ['name' => 'bank-create', 'display_name' => 'Банк: Добавление'],

            // Branch
            ['name' => 'branch-list', 'display_name' => 'Филиал: Раздел\Список'],
            ['name' => 'branch-show', 'display_name' => 'Филиал: Просмотр'],
            ['name' => 'branch-edit', 'display_name' => 'Филиал: Редактирование'],
            ['name' => 'branch-delete', 'display_name' => 'Филиал: Удаление'],
            ['name' => 'branch-create', 'display_name' => 'Филиал: Добавление'],

            //CategoryType
            ['name' => 'categoryType', 'display_name' => 'Тип категории : Управление'],

            //CategoryType
            ['name' => 'colors', 'display_name' => 'Цвет : Управление'],

            // documentType
            ['name' => 'documentType-list', 'display_name' => 'Тип документа: Раздел\Список'],
            ['name' => 'documentType-show', 'display_name' => 'Тип документа: Просмотр'],
            ['name' => 'documentType-edit', 'display_name' => 'Тип документа: Редактирование'],
            ['name' => 'documentType-delete', 'display_name' => 'Тип документа: Удаление'],
            ['name' => 'documentType-create', 'display_name' => 'Тип документа: Добавление'],

            //Event
            ['name' => 'events', 'display_name' => 'События : Управление'],

            // order
            ['name' => 'order-list', 'display_name' => 'Заявки: Раздел\Список'],
            ['name' => 'order-show', 'display_name' => 'Заявки: Просмотр'],
            ['name' => 'order-edit', 'display_name' => 'Заявки: Редактирование'],

            //remoteIdentification
            ['name' => 'remote-identification-list', 'display_name' => 'Идентификация: Раздел\Список'],
            ['name' => 'remote-identification-edit', 'display_name' => 'Идентификация: Редактирование'],
            ['name' => 'remote-identification-show', 'display_name' => 'Идентификация: Просмотр'],
            ['name' => 'remote-identification-update-status', 'display_name' => 'Идентификация: Отменить заявку'],

            // orderType
            ['name' => 'order-orderType-list', 'display_name' => 'Заявки -> Типы заявок: Раздел\Список'],
            ['name' => 'order-orderType-show', 'display_name' => 'Заявки -> Типы заявок: Просмотр'],

            // orderStatus
            ['name' => 'order-orderStatus-list', 'display_name' => 'Заявки -> Статус заявок: Раздел\Список'],
            ['name' => 'order-orderStatus-show', 'display_name' => 'Заявки -> Статус заявок: Просмотр'],

            // tempUser
            ['name' => 'user-tempUser-list', 'display_name' => 'Пользователи Temp: Раздел\Список'],
            ['name' => 'user-tempUser-show', 'display_name' => 'Пользователи Temp: Просмотр'],

            // purpose
            ['name' => 'purpose-list', 'display_name' => 'Назначение: Раздел\Список'],
            ['name' => 'purpose-show', 'display_name' => 'Назначение: Просмотр'],

            // transferList
            ['name' => 'transferList-list', 'display_name' => 'Система денежных переводов: Раздел\Список'],
            ['name' => 'transferList-show', 'display_name' => 'Система денежных переводов: Просмотр'],
            ['name' => 'transferList-edit', 'display_name' => 'Система денежных переводов: Редактирование'],
            ['name' => 'transferList-delete', 'display_name' => 'Система денежных переводов: Удаление'],
            ['name' => 'transferList-create', 'display_name' => 'Система денежных переводов: Добавление'],

            // unverifiedUser
            ['name' => 'user-unverifiedUser-list', 'display_name' => 'Неверифицированные клиенты: Раздел\Список'],
            ['name' => 'user-unverifiedUser-show', 'display_name' => 'Неверифицированные клиенты: Просмотр'],

            // userSessionCode
            ['name' => 'user-userSessionCode-list', 'display_name' => 'OTP код: Раздел\Список'],
            ['name' => 'user-userSessionCode-show', 'display_name' => 'OTP код: Просмотр'],

            //News
            ['name' => 'news-list', 'display_name' => 'Новости : Раздел\Список'],
            ['name' => 'news-show', 'display_name' => 'Новости : Просмотр'],
            ['name' => 'news-edit', 'display_name' => 'Новости : Редактирование'],
            ['name' => 'news-delete', 'display_name' => 'Новости : Удаление'],
            ['name' => 'news-create', 'display_name' => 'Новости : Добавление'],

            //SERVICES_OTP_LIMITS
            ['name' => 'service-otp-limit-list', 'display_name' => 'Сервисы -> Лимиты OTP: Раздел\Список'],
            ['name' => 'service-otp-limit-show', 'display_name' => 'Сервисы -> Лимиты OTP: Просмотр'],
            ['name' => 'service-otp-limit-edit', 'display_name' => 'Сервисы -> Лимиты OTP: Редактирование'],
            ['name' => 'service-otp-limit-delete', 'display_name' => 'Сервисы -> Лимиты OTP: Удаление'],
            ['name' => 'service-otp-limit-create', 'display_name' => 'Сервисы -> Лимиты OTP: Добавление'],

            //merchant
            ['name' => 'merchant-list', 'display_name' => 'Мерчант : Раздел\Список'],
            ['name' => 'merchant-show', 'display_name' => 'Мерчант : Просмотр'],
            ['name' => 'merchant-edit', 'display_name' => 'Мерчант : Редактирование'],
            ['name' => 'merchant-delete', 'display_name' => 'Мерчант : Удаление'],
            ['name' => 'merchant-delete-contract', 'display_name' => 'Мерчант : Удаление Контракт'],
            ['name' => 'merchant-create', 'display_name' => 'Мерчант : Добавление'],
            ['name' => 'merchant-is-qr-integrated', 'display_name' => 'Мерчант : Интеграция с QR'],

            //merchantItem
            ['name' => 'merchant-item-list', 'display_name' => 'Мерчант пункты: Раздел\Список'],
            ['name' => 'merchant-item-show', 'display_name' => 'Мерчант пункты: Просмотр'],
            ['name' => 'merchant-item-edit', 'display_name' => 'Мерчант пункты: Редактирование'],
            ['name' => 'merchant-item-delete', 'display_name' => 'Мерчант пункты: Удаление'],
            ['name' => 'merchant-item-create', 'display_name' => 'Мерчант пункты: Добавление'],
            ['name' => 'merchant-item-changeAccountNumber', 'display_name' => 'Мерчант пункты: Редактирование код/счет АБС'],

            //merchantCategory
            ['name' => 'merchant-category-list', 'display_name' => 'Мерчант -> Категория: Раздел\Список'],
            ['name' => 'merchant-category-show', 'display_name' => 'Мерчант -> Категория: Просмотр'],
            ['name' => 'merchant-category-edit', 'display_name' => 'Мерчант -> Категория: Редактирование'],
            ['name' => 'merchant-category-delete', 'display_name' => 'Мерчант -> Категория: Удаление'],
            ['name' => 'merchant-category-create', 'display_name' => 'Мерчант -> Категория: Добавление'],

            //merchantWorkdays
            ['name' => 'merchant-workdays-list', 'display_name' => 'Мерчант -> Рабочие дни: Раздел\Список'],
            ['name' => 'merchant-workdays-show', 'display_name' => 'Мерчант -> Рабочие дни: Просмотр'],
            ['name' => 'merchant-workdays-edit', 'display_name' => 'Мерчант -> Рабочие дни: Редактирование'],
//            ['name' => 'merchant-workdays-delete', 'display_name' => 'Мерчант -> Рабочие дни: Удаление'],
            ['name' => 'merchant-workdays-create', 'display_name' => 'Мерчант -> Рабочие дни: Добавление'],

            //merchantCommission
            ['name' => 'merchant-commission-list', 'display_name' => 'Мерчант -> Комиссия: Раздел\Список'],
            ['name' => 'merchant-commission-show', 'display_name' => 'Мерчант -> Комиссия: Просмотр'],
            ['name' => 'merchant-commission-edit', 'display_name' => 'Мерчант -> Комиссия: Редактирование'],
            ['name' => 'merchant-commission-delete', 'display_name' => 'Мерчант -> Комиссия: Удаление'],
            ['name' => 'merchant-commission-create', 'display_name' => 'Мерчант -> Комиссия: Добавление'],

            //merchantUser
            ['name' => 'merchant-user-list', 'display_name' => 'Мерчант -> Пользователя: Раздел\Список'],
            ['name' => 'merchant-user-show', 'display_name' => 'Мерчант -> Пользователя: Просмотр'],
            ['name' => 'merchant-user-edit', 'display_name' => 'Мерчант -> Пользователя: Редактирование'],
            ['name' => 'merchant-user-delete', 'display_name' => 'Мерчант -> Пользователя: Удаление'],

            //merchantCommissionItem
            ['name' => 'merchant-commission-item-list', 'display_name' => 'Мерчант -> Пункт комиссии: Раздел\Список'],
            ['name' => 'merchant-commission-item-show', 'display_name' => 'Мерчант -> Пункт комиссии: Просмотр'],
            ['name' => 'merchant-commission-item-edit', 'display_name' => 'Мерчант -> Пункт комиссии: Редактирование'],
            ['name' => 'merchant-commission-item-delete', 'display_name' => 'Мерчант -> Пункт комиссии: Удаление'],
            ['name' => 'merchant-commission-item-create', 'display_name' => 'Мерчант -> Пункт комиссии: Добавление'],
            ['name' => 'merchant-can-by-user-branch', 'display_name' => 'Мерчант -> Разрешить доступ для записи филиалов пользователя'],
            ['name' => 'merchant-can-all-branch', 'display_name' => 'Мерчант -> Разрешить доступ для записи всех филиалов'],
            ['name' => 'merchant-can-change-is-verified', 'display_name' => 'Мерчант -> Разрешить доступ для редактирование поле проверено'],
            ['name' => 'merchant-can-only-change-is-verified', 'display_name' => 'Мерчант -> Разрешить доступ только для редактирование поле проверено'],

            //cashback
            ['name' => 'cashback-list', 'display_name' => 'Кэшбэк: Раздел\Список'],
            ['name' => 'cashback-show', 'display_name' => 'Кэшбэк: Просмотр'],
            ['name' => 'cashback-edit', 'display_name' => 'Кэшбэк: Редактирование'],
            ['name' => 'cashback-delete', 'display_name' => 'Кэшбэк: Удаление'],
            ['name' => 'cashback-create', 'display_name' => 'Кэшбэк: Добавление'],

            //cashback item
            ['name' => 'cashback-item-list', 'display_name' => 'Кэшбэк элементы: Раздел\Список'],
            ['name' => 'cashback-item-show', 'display_name' => 'Кэшбэк элементы: Просмотр'],
            ['name' => 'cashback-item-edit', 'display_name' => 'Кэшбэк элементы: Редактирование'],
            ['name' => 'cashback-item-delete', 'display_name' => 'Кэшбэк элементы: Удаление'],
            ['name' => 'cashback-item-create', 'display_name' => 'Кэшбэк элементы: Добавление'],

            // Registry Withdraw
            ['name' => 'registries-withdraw-merchant', 'display_name' => 'Вывод средств Мерчантов: Управление'],

            // JobHistory
            ['name' => 'jobHistory-list', 'display_name' => 'Задачи Export: Раздел\Список'],
            ['name' => 'jobHistoryCommand-list', 'display_name' => 'Задачи Command: Раздел\Список'],
            ['name' => 'jobHistory-show', 'display_name' => 'Задачи: Просмотр'],
            ['name' => 'jobHistory-can-by-user', 'display_name' => 'Задачи -> Разрешить доступ для просмотра задачи пользователя(owner)'],
            ['name' => 'jobHistory-can-all', 'display_name' => 'Задачи -> Разрешить доступ для просмотра все задачи'],

            ['name' => 'reportMerchant-list', 'display_name' => 'Отчет мерчанта: Раздел\Список'],

            //OrderComments
            ['name' => 'order-comment-list', 'display_name' => 'Заявки(Коментария) : Раздел\Список'],
            ['name' => 'order-comment-show', 'display_name' => 'Заявки(Коментария) : Просмотр'],
            ['name' => 'order-comment-edit', 'display_name' => 'Заявки(Коментария) : Редактирование'],
            ['name' => 'order-comment-create', 'display_name' => 'Заявки(Коментария) : Добавление'],


            ['name' => 'reports-list', 'display_name' => 'Отчеты'],
            ['name' => 'report-type-BeetweenEwalletEskhataTransactions', 'display_name' => 'Отчет(Транзакция между кошельками)'],
            ['name' => 'report-type-MerchantQrTransactions', 'display_name' => 'Отчет(Мерчант(Транзакция по QR оплатам))'],
            ['name' => 'report-type-Clients', 'display_name' => 'Отчет(Клиенты)'],
            ['name' => 'report-type-Merchants', 'display_name' => 'Отчет(Список Мерчантов)'],
            ['name' => 'report-type-RemoteIdentifications', 'display_name' => 'Отчет(Список заявок на Удаленную Идентификации)'],
            ['name' => 'report-type-Transactions', 'display_name' => 'Отчет(Транзакция)'],
            ['name' => 'report-type-ReplenishmentEwalletEskhataTransactions', 'display_name' => 'Отчет(Пополнение Эсхата онлайн)'],
            ['name' => 'report-type-TransactionAnalysisEwalletEskhata', 'display_name' => 'Отчет(Электронный кошелек для анализа транзакций)'],
            ['name' => 'report-type-DepositOpeningOrders', 'display_name' => 'Отчет(Заявки на открытые депозита)'],
            ['name' => 'report-type-KortiMilliTransactions', 'display_name' => 'Отчет (Транзакции - Корти милли других банков)'],

            //OrderCardType
            ['name' => 'order-card-type-list', 'display_name' => 'Заявки(Тип карты) : Раздел\Список'],
            ['name' => 'order-card-type-edit', 'display_name' => 'Заявки(Тип карты) : Редактирование'],
            ['name' => 'order-card-type-create', 'display_name' => 'Заявки(Тип карты) : Добавление'],
            ['name' => 'order-card-type-delete', 'display_name' => 'Заявки(Тип карты): Удаление'],
            //OrderCardContractType
            ['name' => 'order-card-contract-type-list', 'display_name' => 'Заявки(Типы карточных счетов) : Раздел\Список'],
            ['name' => 'order-card-contract-type-edit', 'display_name' => 'Заявки(Типы карточных счетов) : Редактирование'],
            ['name' => 'order-card-contract-type-create', 'display_name' => 'Заявки(Типы карточных счетов) : Добавление'],
            ['name' => 'order-card-contract-type-delete', 'display_name' => 'Заявки(Типы карточных счетов): Удаление'],
            
            //OrderDepositType
            ['name' => 'order-deposit-type-list', 'display_name' => 'Заявки(Тип депозита) : Раздел\Список'],
            ['name' => 'order-deposit-type-edit', 'display_name' => 'Заявки(Тип депозита) : Редактирование'],
            ['name' => 'order-deposit-type-create', 'display_name' => 'Заявки(Тип депозита) : Добавление'],
            ['name' => 'order-deposit-type-delete', 'display_name' => 'Заявки(Тип депозита): Удаление'],
            
            //OrderDepositTypeItem
            ['name' => 'order-deposit-type-item-list', 'display_name' => 'Заявки(Подтип депозита) : Раздел\Список'],
            ['name' => 'order-deposit-type-item-edit', 'display_name' => 'Заявки(Подтип депозита) : Редактирование'],
            ['name' => 'order-deposit-type-item-create', 'display_name' => 'Заявки(Подтип депозита) : Добавление'],
            ['name' => 'order-deposit-type-item-delete', 'display_name' => 'Заявки(Подтип депозита): Удаление'],
            
            //OrderAccountType
            ['name' => 'order-account-type-list', 'display_name' => 'Заявки(Тип счёта) : Раздел\Список'],
            ['name' => 'order-account-type-edit', 'display_name' => 'Заявки(Тип счёта) : Редактирование'],
            ['name' => 'order-account-type-create', 'display_name' => 'Заявки(Тип счёта) : Добавление'],
            ['name' => 'order-account-type-delete', 'display_name' => 'Заявки(Тип счёта): Удаление'],
            
            //OrderAccountTypeItem
            ['name' => 'order-account-type-item-list', 'display_name' => 'Заявки(Подтип счёта) : Раздел\Список'],
            ['name' => 'order-account-type-item-edit', 'display_name' => 'Заявки(Подтип счёта) : Редактирование'],
            ['name' => 'order-account-type-item-create', 'display_name' => 'Заявки(Подтип счёта) : Добавление'],
            ['name' => 'order-account-type-item-delete', 'display_name' => 'Заявки(Подтип счёта): Удаление'],

            //cashback type
            ['name' => 'cachback-type-list', 'display_name' => 'Кэшбэк типы: Раздел\Список'],
            ['name' => 'cashback-type-show', 'display_name' => 'Кэшбэк типы: Просмотр'],
            ['name' => 'cachback-type-edit', 'display_name' => 'Кэшбэк типы: Редактирование'],
            ['name' => 'cashback-type-delete', 'display_name' => 'Кэшбэк типы: Удаление'],
            ['name' => 'cachback-type-create', 'display_name' => 'Кэшбэк типы: Добавление'],

            //BonusAccrualStatus
            ['name' => 'bonus-accrual-status-list', 'display_name' => 'Статус начисления бонусов: Раздел\Список'],
            ['name' => 'bonus-accrual-status-show', 'display_name' => 'Статус начисления бонусов: Просмотр'],
            ['name' => 'bonus-accrual-status-edit', 'display_name' => 'Статус начисления бонусов: Редактирование'],
            ['name' => 'bonus-accrual-status-delete', 'display_name' => 'Статус начисления бонусов: Удаление'],
            ['name' => 'bonus-accrual-status-create', 'display_name' => 'Статус начисления бонусов: Добавление'],

            //BonusAccrual
            ['name' => 'bonus-accrual-list', 'display_name' => 'Начисления бонусов: Раздел\Список'],
            ['name' => 'bonus-accrual-show', 'display_name' => 'Начисления бонусов: Просмотр'],

            //FAQAnswer
            ['name' => 'FAQAnswer-list', 'display_name' => 'FAQ ответы: Раздел\Список'],
            ['name' => 'FAQAnswer-show', 'display_name' => 'FAQ ответы: Просмотр'],
            ['name' => 'FAQAnswer-edit', 'display_name' => 'FAQ ответы: Редактирование'],
            ['name' => 'FAQAnswer-delete', 'display_name' => 'FAQ ответы: Удаление'],
            ['name' => 'FAQAnswer-create', 'display_name' => 'FAQ ответы: Добавление'],

            //FAQQuestion
            ['name' => 'FAQQuestion-list', 'display_name' => 'FAQ вопросы: Раздел\Список'],
            ['name' => 'FAQQuestion-show', 'display_name' => 'FAQ вопросы: Просмотр'],
            ['name' => 'FAQQuestion-edit', 'display_name' => 'FAQ вопросы: Редактирование'],
            ['name' => 'FAQQuestion-delete', 'display_name' => 'FAQ вопросы: Удаление'],
            ['name' => 'FAQQuestion-create', 'display_name' => 'FAQ вопросы: Добавление'],

            //Splash screen
            ['name' => 'splash-screen-show', 'display_name' => 'Splash screen: Просмотр'],
            ['name' => 'splash-screen-create', 'display_name' => 'Splash screen: Редактирование'],

            //ScheduleType
            ['name' => 'schedule-type-list', 'display_name' => 'Тип планировщик: Раздел\Список'],
            ['name' => 'schedule-type-show', 'display_name' => 'Тип планировщик: Просмотр'],

            //Schedule
            ['name' => 'schedule-list', 'display_name' => 'Тип планировщик: Раздел\Список'],
            ['name' => 'schedule-show', 'display_name' => 'Тип планировщик: Просмотр'],
            ['name' => 'schedule-edit', 'display_name' => 'Тип планировщик: Редактирование'],
            ['name' => 'schedule-delete', 'display_name' => 'Тип планировщик: Удаление'],
            ['name' => 'schedule-create', 'display_name' => 'Тип планировщик: Добавление'],

            //ScheduleJob
            ['name' => 'schedule-job-list', 'display_name' => 'Job: Раздел\Список'],
            ['name' => 'schedule-job-show', 'display_name' => 'Job: Просмотр'],
            ['name' => 'schedule-job-create', 'display_name' => 'Job: Добавление'],
            //FileManager
            ['name' => 'FileManager.can-list', 'display_name' => 'File Manager: Раздел\Список'],
            ['name' => 'FileManager.can-delete', 'display_name' => 'File Manager: Удаление'],
            ['name' => 'FileManager.can-store', 'display_name' => 'File Manager: Добавление'],
            ['name' => 'FileManager.can-download', 'display_name' => 'File Manager: Скачать'],
            ['name' => 'FileManager.can-edit', 'display_name' => 'File Manager: Редактирование'],

            //report_analysis
            ['name' => 'report_analysis-list', 'display_name' => 'Фильтр для анализ транзакции: Раздел\Список'],
            ['name' => 'report_analysis-edit', 'display_name' => 'Фильтр для анализ транзакции: Редактирование'],
            ['name' => 'report_analysis-delete', 'display_name' => 'Фильтр для анализ транзакции: Удаление'],
            ['name' => 'report_analysis-create', 'display_name' => 'Фильтр для анализ транзакции: Добавление'],

            //Splash screen
            ['name' => 'splash-screen-show', 'display_name' => 'Splash screen: Просмотр'],
            ['name' => 'splash-screen-create', 'display_name' => 'Splash screen: Редактирование'],

            // dwh rules
            ['name' => 'dwhRule-list', 'display_name' => 'Dwh правила: Раздел\Список'],
            ['name' => 'dwhRule-show', 'display_name' => 'Dwh правила: Просмотр'],
            ['name' => 'dwhRule-edit', 'display_name' => 'Dwh правила: Редактирование'],
            ['name' => 'dwhRule-create', 'display_name' => 'Dwh правила: Добавление'],
            ['name' => 'dwhRule-delete', 'display_name' => 'Dwh правила: Удаление'],

        ];

        foreach ($permissions as $permission) {
            try {
                Permission::create($permission);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
