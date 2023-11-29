<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Эсхата Онлайн',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => 'Эсхата Онлайн',

    'logo_mini' => '<b>ЭО</b>',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'admin/dashboard',

    'logout_url' => 'admin/logout',

    'logout_method' => 'GET',

    'login_url' => 'admin/login',

    'register_url' => 'admin/register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'ОБСЛУЖИВАНИЕ',
        [
            'text' => 'Главная',
            'route' => 'admin.dashboard',
            'icon' => 'home',
            'label' => 4,
            'label_color' => 'success',
            'can' => 'dashboard-list'
        ],
        [
            'text' => 'Клиенты',
            'route' => 'admin.clients.index',
            'icon' => 'address-card',
            'can' => 'client-list'
        ],
        /*
                [
                    'text' => 'Отчеты',
                    //'route' => 'admin.reports.index',
                    'icon' => 'user',
                    'can' => 'report-list'
                ],
        */
        'АДМИНИСТРИРОВАНИЕ',
        [
            'text' => 'Пользователи',
            'route' => 'admin.users.index',
            'icon' => 'users',
            'label_color' => 'success',
            'can' => 'user-list'
        ],
        [
            'text' => 'Транзакции',
            'url' => 'admin/transactions?from_date='.(\Carbon\Carbon::now()->format('Y-m-d')),
            'icon' => 'exchange',
            'label_color' => 'success',
            'can' => 'transaction-list'
        ],
        [
            'text' => 'Счета',
            'route' => 'admin.accounts.index',
            'icon' => 'credit-card',
            'label_color' => 'success',
            'can' => 'account-list'
        ],
        [
            'text' => 'Курсы валют',
            'route' => 'admin.currencies.rates.index',
            'icon' => 'money',
            'label_color' => 'success',
            'can' => 'currency-rate-list'
        ],
        [
            'text' => 'Заявки',
            'route' => 'admin.orders.index',
            'icon' => 'list-alt',
            'label_color' => 'success',
            'can' => 'order-list'
        ],
        [
            'text' => 'Идентификация',
            'route' => 'admin.remoteIdentification.index',
            'icon' => 'bars',
            'label_color' => 'success',
            'can' => 'remote-identification-list'
        ],
        [
            'text' => 'Сервисы',
            'route' => 'admin.services.index',
            'icon' => 'bars',
            'label_color' => 'success',
            'can' => 'service-list'
        ],
        [
            'text' => 'Меню сервисов',
            'route' => 'admin.menu.index',
            'icon' => 'bars',
            'label_color' => 'success',
            'can' => 'service-menu-list'
        ],
        [
            'text' => 'Шлюзы',
            'route' => 'admin.gateways.index',
            'icon' => 'gg',
            'label_color' => 'success',
            'can' => 'gateways'
        ],
        [
            'text' => 'Конфигурация',
            'route' => 'admin.settings.index',
            'icon' => 'cogs',
            'label_color' => 'success',
            'can' => 'settings'
        ],
        [
            'text' => 'Реестр',
            'route' => 'admin.registries.index',
            'icon' => 'file-excel-o',
            'label_color' => 'success',
            'can' => 'registries'
        ],
        [
            'text' => 'Отчет мерчанта',
            'route' => 'admin.reportMerchant.index',
            'icon' => 'file-excel-o',
            'label_color' => 'success',
            'can' => 'reportMerchant-list'
        ],
        [
            'text' => 'Отчеты',
            'route' => 'admin.reports.index',
            'icon' => 'file-excel-o',
            'label_color' => 'success',
            'can' => 'reports-list'
        ],
        [
            'text' => 'Реестр Мерчанта',
            'route' => 'admin.withdraw_merchant.index',
            'icon' => 'file-excel-o',
            'label_color' => 'success',
            'can' => 'registries-withdraw-merchant'
        ],
        [
            'text' => 'API документация',
            'route' => 'admin.doc_api.index',
            'icon' => 'file-word-o',
            'label_color' => 'success',
            'can' => 'docapi-list'
        ],
        [
            'text' => 'Журнал задач',
            'route' => 'admin.jobLog.index',
            'icon' => 'tasks',
            'label_color' => 'success',
            'can' => 'jobLog-list'
        ],
        [
            'text' => 'Задачи Export',
            'route' => 'admin.jobHistory.index',
            'icon' => 'tasks',
            'label_color' => 'success',
            'can' => 'jobHistory-list'
        ],
        [
            'text' => 'Задачи Command',
            'route' => 'admin.job.jobHistory.command',
            'icon' => 'tasks',
            'label_color' => 'success',
            'can' => 'jobHistoryCommand-list'
        ],
        [
            'text' => 'Неверифицированнные клиенты',
            'route' => 'admin.users.unverifiedUser.index',
            'icon' => 'expeditedssl',
            'can' => 'user-unverifiedUser-list'
        ],
        [
            'text' => 'OTP код',
            'route' => 'admin.users.userSessionCode.index',
            'icon' => 'creative-commons',
            'label_color' => 'success',
            'can' => 'user-userSessionCode-list'
        ],
        [
            'text' => 'Новости',
            'route' => 'admin.news.index',
            'icon' => 'newspaper-o',
            'label_color' => 'success',
            'can' => 'news-list'
        ],
        [
            'text' => "Мерчант",
            'icon' => 'qrcode',
            'label_color' => 'success',
            'can' => 'merchant-list|merchant-item-list|merchant-category-list|merchant-workdays-list|merchant-commission-list|merchant-commission-item-list',
            'accordion' => false,
            'submenu' => [
                [
                    'text' => 'Мерчант',
                    'route' => 'admin.merchants.index',
                    'icon' => 'male',
                    'label_color' => 'success',
                    'can' => 'merchant-list'
                ],
//                [
//                    'text' => 'Мерчант пункты',
//                    'route' => 'admin.merchants.items.index',
//                    'icon' => 'street-view',
//                    'label_color' => 'success',
//                    'can' => 'merchant-item-list'
//                ],
                [
                    'text' => 'Мерчант категория',
                    'route' => 'admin.merchants.categories.index',
                    'icon' => 'male',
                    'label_color' => 'success',
                    'can' => 'merchant-category-list'
                ],
                [
                    'text' => 'Мерчант рабочие дни',
                    'route' => 'admin.merchants.merchantWorkdays.index',
                    'icon' => 'male',
                    'label_color' => 'success',
                    'can' => 'merchant-workdays-list'
                ],
                [
                    'text' => 'Мерчант комиссия',
                    'route' => 'admin.merchants.commissions.index',
                    'icon' => 'folder-o',
                    'label_color' => 'success',
                    'can' => 'merchant-commission-list'
                ],
                [
                    'text' => 'Мерчант пользователя',
                    'route' => 'admin.merchants.users.index',
                    'icon' => 'male',
                    'label_color' => 'success',
                    'can' => 'merchant-commission-list'
                ],
//                [
//                    'text' => 'Мерчант пункт комиссии',
//                    'route' => 'admin.merchants.commission.items.index',
//                    'icon' => 'folder-open-o',
//                    'label_color' => 'success',
//                    'can' => 'merchant-commission-item-list'
//                ],
//                [
//                    'text' => 'Кэшбэк',
//                    'route' => 'admin.merchant.index',
//                    'icon' => 'male',
//                    'label_color' => 'success',
//                    'can' => 'merchant-list'
//                ],
            ]
        ],
        [
            'text' => "Кэшбэк",
            'icon' => 'opencart',
            'label_color' => 'success',
            'can' => 'cashback-list',
            'accordion' => false,
            'submenu' => [
                [
                    'text' => 'Кэшбэк',
                    'route' => 'admin.cashbacks.index',
                    'icon' => 'object-ungroup',
                    'label_color' => 'success',
                    'can' => 'cashback-list'
                ],
//                [
//                    'text' => 'Кэшбэк элементы',
//                    'route' => 'admin.cashback.cashbackItem.index',
//                    'icon' => 'object-group',
//                    'label_color' => 'success',
//                    'can' => 'cashback-list'
//                ],
            ],
        ],
        [
            'text' => 'Начисленные бонусы',
            'route' => 'admin.bonusAccrual.index',
            'icon' => 'cc-paypal',
            'label_color' => 'success',
            'can' => 'bonus-accrual-list',
        ],
        'СПРАВОЧНИК',
        [
            'text' => 'Тип категории',
            'route' => 'admin.categoryTypes.index',
            'icon' => 'folder-o ',
            'label_color' => 'success',
            'can' => 'categoryType'
        ],
        [
            'text' => 'Роли и доступы',
            'route' => 'admin.roles.index',
            'icon' => 'user-secret',
            'label_color' => 'success',
            'can' => 'roles'
        ],
        [
            'text' => "Пункты обслуживания",
            'icon' => 'map',
            'label_color' => 'success',
            'can' => 'coordinates-point-list|coordinates-point-service-list|coordinates-point-type-list|coordinates-point-workday-list|coordinates-point-city-list',
            'accordion' => false,
            'submenu' => [
                [
                    'text' => 'Пункты обслуживания',
                    'route' => 'admin.coordinatepoints.index',
                    'icon' => 'map',
                    'label_color' => 'success',
                    'can' => 'coordinates-point-list'
                ],[
                    'text' => 'Рабочие дни',
                    'route' => 'admin.coordinatepointWorkdays.index',
                    'label_color' => 'success',
                    'can' => 'coordinates-point-workday-list'
                ],[
                    'text' => 'Типы',
                    'route' => 'admin.coordinatepointTypes.index',
                    'label_color' => 'success',
                    'can' => 'coordinates-point-type-list'
                ],[
                    'text' => 'Сервисы',
                    'route' => 'admin.coordinatepointServices.index',
                    'label_color' => 'success',
                    'can' => 'coordinates-point-service-list'
                ],[
                    'text' => 'Города',
                    'route' => 'admin.coordinatePointCities.index',
                    'label_color' => 'success',
                    'can' => 'coordinates-point-city-list'
                ],
            ],
        ],
        [
            'text' => "Транзакции",
            'icon' => 'exchange',
            'label_color' => 'success',
            'can' => 'transaction-type-list|transaction-status-list|transaction-status-detail-list|transaction-status-group-list|transaction-sync-status-list|transaction-continue-rule-list',
            'accordion' => false,
            'submenu' => [
                [
                    'text' => 'Типы',
                    'route' => 'admin.transactions.type.index',
//                    'icon' => 'code-fork',
                    'label_color' => 'success',
                    'can' => 'transaction-type-list'
                ],
                [
                    'text' => 'Статусы',
                    'route' => 'admin.transactions.status.index',
//                    'icon' => 'anchor',
                    'label_color' => 'success',
                    'can' => 'transaction-status-list'
                ],
                [
                    'text' => 'Детальные статусы',
                    'route' => 'admin.transactions.status-detail.index',
//                    'icon' => 'gavel',
                    'label_color' => 'success',
                    'can' => 'transaction-status-detail-list'
                ],
                [
                    'text' => 'Группа статусов',
                    'route' => 'admin.transactions.status-group.index',
//                    'icon' => 'gavel',
                    'label_color' => 'success',
                    'can' => 'transaction-status-group-list'
                ],
                [
                    'text' => 'Статус синхронизации',
                    'route' => 'admin.transactions.sync-status.index',
//                    'icon' => 'gavel',
                    'label_color' => 'success',
                    'can' => 'transaction-sync-status-list'
                ],
                [
                    'text' => 'Прав. продол. транзакции',
                    'route' => 'admin.transactions.continueRules.index',
//                    'icon' => 'gavel',
                    'label_color' => 'success',
                    'can' => 'transaction-continue-rule-list'
                ],
            ]
        ],
        [
            'text' => "Заявки",
            'icon' => 'list-alt',
            'label_color' => 'success',
            'can' => 'order-orderType-list|order-orderStatus-list|order-comment-list|order-card-type-list',
            'accordion' => false,
            'submenu' => [
                [
                    'text' => 'Типы',
                    'route' => 'admin.order.orderType.index',
                    'icon' => 'list-ul',
                    'label_color' => 'success',
                    'can' => 'order-orderType-list'
                ],
                [
                    'text' => 'Статусы',
                    'route' => 'admin.order.orderStatus.index',
                    'icon' => 'th-list',
                    'label_color' => 'success',
                    'can' => 'order-orderStatus-list'
                ],
                [
                    'text' => 'Коментарии',
                    'route' => 'admin.order.orderComment.index',
                    'icon' => 'th-list',
                    'label_color' => 'success',
                    'can' => 'order-comment-list'
                ],
                [
                    'text' => 'Тип карты',
                    'route' => 'admin.order.orderCardType.index',
                    'icon' => 'credit-card',
                    'label_color' => 'success',
                    'can' => 'order-card-type-list'
                ],
                [
                    'text' => 'Тип счетов',
                    'route' => 'admin.order.orderAccountType.index',
                    'icon' => 'credit-card',
                    'label_color' => 'success',
                    'can' => 'order-card-type-list'
                ],
                [
                    'text' => 'Подтип счетов',
                    'route' => 'admin.order.orderAccountTypeItem.index',
                    'icon' => 'credit-card',
                    'label_color' => 'success',
                    'can' => 'order-card-type-list'
                ],
                [
                    'text' => 'Тип депозитов',
                    'route' => 'admin.order.orderDepositType.index',
                    'icon' => 'credit-card',
                    'label_color' => 'success',
                    'can' => 'order-card-type-list'
                ],
                [
                    'text' => 'Подтип депозитов',
                    'route' => 'admin.order.orderDepositTypeItem.index',
                    'icon' => 'credit-card',
                    'label_color' => 'success',
                    'can' => 'order-card-type-list'
                ],
            ]
        ],
        [
            'text' => 'Валюты',
            'route' => 'admin.currencies.index',
            'icon' => 'money',
            'label_color' => 'success',
            'can' => 'currency-list'
        ],
        [
            'text' => 'Сервисы',
            'icon' => 'gg',
            'can' => 'service-limit-list|service-otp-limit-list|service-commission-list|service-workday-list|service-category-list',
            'submenu' => [
                [
                    'text' => 'Лимиты сервисов',
                    'route' => 'admin.limits.index',
//                    'icon' => 'map-signs',
                    'label_color' => 'success',
                    'can' => 'service-limit-list'
                ],
                [
                    'text' => 'Лимиты ОТП сервисов',
                    'route' => 'admin.serviceOtpLimits.index',
                    'icon' => 'sort-amount-asc',
                    'label_color' => 'success',
                    'can' => 'service-otp-limit-list'
                ],
                [
                    'text' => 'Коммиссии',
                    'route' => 'admin.services.commissions.index',
//                    'icon' => 'info',
                    'label_color' => 'success',
                    'can' => 'service-commission-list'
                ],
                [
                    'text' => 'Рабочие дни сервиса',
                    'route' => 'admin.workdays.index',
//                    'icon' => 'terminal',
                    'label_color' => 'success',
                    'can' => 'service-workday-list'
                ],
                [
                    'text' => 'Категории',
                    'route' => 'admin.categories.index',
//                    'icon' => 'random',
                    'label_color' => 'success',
                    'can' => 'service-category-list'
                ],
            ],
        ],
        [
            'text' => "Пользователи",
            'icon' => 'users',
            'label_color' => 'success',
            'can' => 'user-favorite-list|user-limit-list|attestation-list|license-show|events|user-tempUser-list',
            'submenu' => [
                [
                    'text' => 'Шаблоны',
                    'route' => 'admin.favorites.index',
//                    'icon' => 'sitemap',
                    'label_color' => 'success',
                    'can' => 'user-favorite-list'
                ],
                [
                    'text' => 'Оферта',
                    'route' => 'admin.license.edit',
//                    'icon' => 'sitemap',
                    'label_color' => 'success',
                    'can' => 'license-show'
                ], [
                    'text' => 'Аттестации',
                    'route' => 'admin.attestations.index',
//                    'icon' => 'sitemap',
                    'label_color' => 'success',
                    'can' => 'attestation-list'
                ],
                [
                    'text' => 'Лимиты сервисов',
                    'route' => 'admin.users.services.limits.index',
//                    'icon' => 'limit',
                    'label_color' => 'success',
                    'can' => 'user-limit-list'
                ],
                [
                    'text' => 'События',
                    'route' => 'admin.users.events.index',
                    'icon' => 'newspaper-o',
                    'label_color' => 'success',
                    'can' => 'events'
                ],
                [
                    'text' => 'Клиенты ИБ',
                    'route' => 'admin.users.tempUsers.index',
                    'icon' => 'external-link',
                    'label_color' => 'success',
                    'can' => 'user-tempUser-list'
                ],
            ]
        ],
        [
            'text' => 'Счета',
            'icon' => 'credit-card',
            'label_color' => 'success',
            'can' => 'account-type-list|account-status-list|account-categoryType-list',
            'submenu' => [
                [
                    'text' => 'Категория счетов',
                    'route' => 'admin.accounts.category.types.index',
                    'icon' => 'list',
                    'label_color' => 'success',
                    'can' => 'account-categoryType-list'
                ],
                [
                    'text' => 'Типы счетов',
                    'route' => 'admin.accounts.types.index',
//                    'icon' => 'map-signs',
                    'label_color' => 'success',
                    'can' => 'account-type-list'
                ],
                [
                    'text' => 'Статус счета',
                    'route' => 'admin.accounts.status.index',
                    'icon' => 'map-signs',
                    'label_color' => 'success',
                    'can' => 'account-status-list'
                ],
                [
                'text' => 'Типы карточных счетов',
                'route' => 'admin.order.cardContractType.index',
                'icon' => 'cc-visa',
                'label_color' => 'success',
                'can' => 'account-status-list'
            ]
            ]
        ],
        [
            'text' => 'Локализация',
            'icon' => 'location-arrow',
            'label_color' => 'success',
            'can' => 'country-list|region-list|area-list|city-list',
            'submenu' => [
                [
                    'text' => 'Страны',
                    'route' => 'admin.countries.index',
//                  'label_color' => 'success',
                    'can' => 'country-list'
                ],
                [
                    'text' => 'Регионы',
                    'route' => 'admin.regions.index',
//                  'label_color' => 'success',
                    'can' => 'region-list'
                ],
                [
                    'text' => 'Районы',
                    'route' => 'admin.areas.index',
//                  'label_color' => 'success',
                    'can' => 'region-list'
                ],
                [
                    'text' => 'Города',
                    'route' => 'admin.city.index',
//                  'label_color' => 'success',
                    'can' => 'city-list'
                ]
            ]
        ],
        [
            'text' => 'Планировщик',
            'icon' => ' fa-clock-o',
            'label_color' => 'success',
            'can' => 'schedule-type-list|schedule-list|schedule-job-list',
            'submenu' => [
                [
                    'text' => 'Тип планировщик',
                    'route' => 'admin.scheduleTypes.index',
                    'label_color' => 'success',
                    'can' => 'schedule-type-list'
                ],
                [
                    'text' => 'Планировщик',
                    'route' => 'admin.schedules.index',
                    'label_color' => 'success',
                    'can' => 'schedule-list'
                ],
                [
                    'text' => 'Задания (Job)',
                    'route' => 'admin.scheduleJobs.index',
                    'label_color' => 'success',
                    'can' => 'schedule-job-list'
                ],
            ]
        ],
        [
            'text' => 'Банк',
            'route' => 'admin.banks.index',
            'icon' => 'bank ',
            'label_color' => 'success',
            'can' => 'bank-list'
        ],
        [
            'text' => 'Филиал',
            'route' => 'admin.branches.index',
            'icon' => 'bank',
            'label_color' => 'success',
            'can' => 'branch-list'
        ],
        [
            'text' => 'Цвет',
            'route' => 'admin.colors.index',
            'icon' => 'paint-brush ',
            'label_color' => 'success',
            'can' => 'colors'
        ],
        [
            'text' => 'Тип документа',
            'route' => 'admin.documentTypes.index',
            'icon' => 'area-chart',
            'label_color' => 'success',
            'can' => 'documentType-list'
        ],
        [
            'text' => 'Назначение',
            'route' => 'admin.purposes.index',
            'icon' => '500px',
            'label_color' => 'success',
            'can' => 'purpose-list'
        ],
        [
            'text' => 'Системы денежных переводов',
            'route' => 'admin.transferList.index',
            'icon' => 'chrome',
            'label_color' => 'success',
            'can' => 'transferList-list'
        ],
        [
            'text' => 'Тип кэшбэка',
            'route' => 'admin.cashbackTypes.index',
            'icon' => 'object-ungroup',
            'label_color' => 'success',
            'can' => 'cachback-type-list'
        ],
        [
            'text' => 'Статусы начисления бонусов',
            'route' => 'admin.bonusAccrualStatus.index',
            'icon' => 'object-group',
            'label_color' => 'success',
            'can' => 'bonus-accrual-status-list'
        ],
        [
            'text' => 'FAQ вопросы',
            'icon' => 'question-circle',
            'route' => 'admin.FAQQuestions.index',
            'label_color' => 'success',
            'can' => 'FAQQuestion-list'
        ],
        [
            'text' => 'File Manager',
            'icon' => 'folder-o',
            'route' => 'admin.fileManager.index',
            'label_color' => 'success',
            'can' => 'FileManager.can-list'
        ],
        [
            'text' => 'Фильтр для отчета',
            'icon' => 'object-group',
            'route' => 'admin.report_analysis.index',
            'label_color' => 'success',
            'can' => 'report_analysis-list'

        ],
        [
            'text' => 'Splash screen',
            'icon' => 'image',
            'route' => 'admin.splashScreens.index',
            'label_color' => 'success',
            'can' => 'splash-screen-show' // must be compatible with permissions_table record
        ],
        [
            'text' => 'Dwh правила',
            'icon' => 'gavel',
            'route' => 'admin.DwhRule.index',
            'label_color' => 'success',
            'can' => 'DwhRule.can-show'
        ]
    ],

    'filters' => [
        \App\Services\Backend\Web\AdminLte\Filters\HrefFilter::class,
//        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
//        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        \App\Services\Backend\Web\AdminLte\Filters\ActiveFilter::class,
        \App\Services\Backend\Web\AdminLte\Filters\SubmenuFilter::class,
//        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
//        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        \App\Services\Backend\Web\AdminLte\Filters\ClassesFilter::class,
//        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        \App\Services\Common\Helpers\CustomMenuFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => false,
        'select2' => true,
        'chartjs' => false,
        'datepicker' => true,
    ],
];
