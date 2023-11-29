<?php

use App\Models\Service\Category\Category;
use App\Services\Common\Helpers\Category as CATEGORIES;
use App\Services\Common\Helpers\CategoryType as CATEGORYTYPES;
use App\Services\Common\Helpers\Service as SERVICES;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $k = 1;
        $categories = [
            ['id' => CATEGORIES::MENU, 'code' => 'Menu', 'name' => 'Меню', 'parent_id' => '00000000-0000-0000-0000-000000000000', 'category_type_id' => '00000000-0000-0000-0000-000000000000', 'icon_url' => '', 'position' => $k++],
            ['id' => CATEGORIES::WEB, 'code' => 'WEB', 'name' => 'Веб версия', 'parent_id' => CATEGORIES::MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => '', 'position' => $k++],
            ['id' => CATEGORIES::MOBILE, 'code' => 'MOBILE', 'name' => 'Мобильная версия', 'parent_id' => CATEGORIES::MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => '', 'position' => $k++],
            ['id' => CATEGORIES::MOBILE_VERSION_1, 'code' => 'MOBILE_VERSION_1', 'name' => 'Версия 1', 'parent_id' => CATEGORIES::MOBILE, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => '', 'position' => $k++],
            ['id' => CATEGORIES::MOBILE_VERSION_2, 'code' => 'MOBILE_VERSION_2', 'name' => 'Версия 2', 'parent_id' => CATEGORIES::MOBILE, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => '', 'position' => $k++],

            //Мобильная версия 1
            ['id' => CATEGORIES::PAYMENT_MENU, 'code' => 'PAYMENT_MENU', 'name' => 'Оплатить услуги', 'parent_id' => CATEGORIES::MOBILE_VERSION_1, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'main_wallet.png', 'position' => $k++],
            ['id' => CATEGORIES::SEND_MENU, 'code' => 'SEND_MENU', 'name' => 'Переводы', 'parent_id' => CATEGORIES::MOBILE_VERSION_1, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'main_send.png', 'position' => $k++],
            ['id' => CATEGORIES::INCOME_MENU, 'code' => 'INCOME_MENU', 'name' => 'Пополнить счёт', 'parent_id' => CATEGORIES::MOBILE_VERSION_1, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'main_fill.png', 'position' => $k++],
            ['id' => CATEGORIES::CASHOUT_MENU, 'code' => 'CASHOUT_MENU', 'name' => 'Обналичить', 'parent_id' => CATEGORIES::MOBILE_VERSION_1, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'main_cash.png', 'position' => $k++],
            ['id' => CATEGORIES::QR_MENU, 'code' => 'QR_MENU', 'name' => 'QR оплата', 'parent_id' => CATEGORIES::MOBILE_VERSION_1, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'main_qr.png', 'position' => $k++, 'is_enabled' => 0],
            ['id' => CATEGORIES::MAP_MENU, 'code' => 'MAP_MENU', 'name' => 'Найти терминал на карте', 'parent_id' => CATEGORIES::INCOME_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'location.png', 'position' => $k++],
            ['id' => CATEGORIES::MOBILE_CONNECTION, 'code' => 'MOBILE_CONNECTION', 'name' => 'Мобильная связь', 'parent_id' => CATEGORIES::PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_mobile.png', 'position' => $k++],
            ['id' => CATEGORIES::INTERNET, 'code' => 'INTERNET', 'name' => 'Интернет и IP телефония', 'parent_id' => CATEGORIES::PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_internet.png', 'position' => $k++],
            ['id' => CATEGORIES::NGN, 'code' => 'NGN', 'name' => 'NGN и городская связь', 'parent_id' => CATEGORIES::PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_landline.png', 'position' => $k++],
            ['id' => CATEGORIES::ABROAD_MOBILE, 'code' => 'ABROAD_MOBILE', 'name' => 'Международные операторы', 'parent_id' => CATEGORIES::PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_international.png', 'position' => $k++],
            ['id' => CATEGORIES::ONLINE, 'code' => 'ONLINE', 'name' => 'Игры и Online равлечения', 'parent_id' => CATEGORIES::PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_games.png', 'position' => $k++],
            ['id' => CATEGORIES::SMI, 'code' => 'SMI', 'name' => 'ТВ и Радио', 'parent_id' => CATEGORIES::PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_tvradio.png', 'position' => $k++],
            ['id' => CATEGORIES::EWALLET, 'code' => 'EWALLET', 'name' => 'Электронный кошелек', 'parent_id' => CATEGORIES::PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_ewallet.png', 'position' => $k++],
            ['id' => CATEGORIES::FOND, 'code' => 'FOND', 'name' => 'Благотворительные фонды', 'parent_id' => CATEGORIES::PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_charity.png', 'position' => $k++],
            ['id' => CATEGORIES::BANK, 'code' => 'BANK', 'name' => 'Банковские услуги', 'parent_id' => CATEGORIES::PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_bankservices.png', 'position' => $k++],
            //['id' => CATEGORIES::BANK_IDENTIFIED, 'code' => 'BANK_IDENTIFIED', 'name' => 'Банковские услуги', 'parent_id' => CATEGORIES::SEND_MENU, 'icon_url' => 'bank.png', 'position'=>$k++],
            ['id' => CATEGORIES::CARDS, 'code' => 'CARDS', 'name' => 'Перевод на карту', 'parent_id' => CATEGORIES::SEND_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_tocard.png', 'position' => $k++],
            ['id' => CATEGORIES::ACCOUNTS, 'code' => 'ACCOUNTS', 'name' => 'Перевод на счёт', 'parent_id' => CATEGORIES::SEND_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_toaccount.png', 'position' => $k++],

            //Мобильная версия 2
            ['id' => CATEGORIES::PAYMENT_AND_TRANSFER_MENU_V2, 'code' => 'MENU_PAYMENT_AND_TRANSFER', 'name' => 'Платежи и переводы', 'parent_id' => CATEGORIES::MOBILE_VERSION_2, 'category_type_id' => CATEGORYTYPES::MENU_PAYMENT_AND_TRANSFER_ID, 'icon_url' => 'services.png', 'is_enabled' => 1, 'position' => $k++],
            ['id' => CATEGORIES::CURRENCY_RATE_MENU_V2, 'code' => 'MENU_CURRENCY_RATE', 'name' => 'Курсы', 'parent_id' => CATEGORIES::MOBILE_VERSION_2, 'category_type_id' => CATEGORYTYPES::MENU_CURRENCY_RATE_ID, 'icon_url' => 'main_rates.png', 'position' => $k++],
            ['id' => CATEGORIES::QR_MENU_V2, 'code' => 'MENU_QR', 'name' => 'QR оплата', 'parent_id' => CATEGORIES::MOBILE_VERSION_2, 'category_type_id' => CATEGORYTYPES::MENU_QR_ID, 'icon_url' => 'main_qr.png', 'position' => $k++],
            ['id' => CATEGORIES::MAP_MENU_V2, 'code' => 'MENU_MAP', 'name' => 'На карте', 'parent_id' => CATEGORIES::MOBILE_VERSION_2, 'category_type_id' => CATEGORYTYPES::MENU_MAP_ID, 'icon_url' => 'main_map.png', 'position' => $k++],
            ['id' => CATEGORIES::DEPOSIT_MENU_V2, 'code' => 'MENU_DEPOSIT', 'name' => 'Вклады', 'parent_id' => CATEGORIES::MOBILE_VERSION_2, 'category_type_id' => CATEGORYTYPES::MENU_DEPOSIT_ID, 'icon_url' => 'main_deposit.png', 'position' => $k++],
            ['id' => CATEGORIES::CREDIT_MENU_V2, 'code' => 'MENU_CREDIT', 'name' => 'Кредиты', 'parent_id' => CATEGORIES::MOBILE_VERSION_2, 'category_type_id' => CATEGORYTYPES::MENU_CREDIT_ID, 'icon_url' => 'main_credit.png', 'position' => $k++],
            ['id' => CATEGORIES::INVOICE_MENU_V2, 'code' => 'MENU_INVOICE', 'name' => 'Счета к оплате', 'parent_id' => CATEGORIES::MOBILE_VERSION_2, 'category_type_id' => CATEGORYTYPES::MENU_INVOICE_FOR_PAYMENT_ID, 'icon_url' => 'main_askcash.png', 'is_active' => 0, 'is_enabled' => 0, 'position' => $k++],
            ['id' => CATEGORIES::CARD_AND_ACCOUNT_V2, 'code' => CATEGORYTYPES::MENU_CARD_AND_ACCOUNT_CODE, 'name' => CATEGORYTYPES::MENU_CARD_AND_ACCOUNT_NAME, 'parent_id' => CATEGORIES::MOBILE_VERSION_2, 'category_type_id' => CATEGORYTYPES::MENU_CARD_AND_ACCOUNT_ID, 'icon_url' => 'main_card_and_account.png', 'is_active' => 1, 'is_enabled' => 1, 'position' => $k++],

            //PAYMENT_AND_TRANSFER_MENU_V2
            ['id' => CATEGORIES::TRANSFER_MENU_V2, 'code' => 'TRANSFER_MENU_V2', 'name' => 'ПЕРЕВЕСТИ', 'parent_id' => CATEGORIES::PAYMENT_AND_TRANSFER_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => '', 'position' => $k++],
            ['id' => CATEGORIES::PAYMENT_MENU_V2, 'code' => 'PAYMENT_MENU_V2', 'name' => 'ОПЛАТИТЬ', 'parent_id' => CATEGORIES::PAYMENT_AND_TRANSFER_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => '', 'position' => $k++],

            //['id' => CATEGORIES::TO_ACCOUNTS_V2, 'code' => 'TO_ACCOUNTS_V2', 'name' => 'На счет', 'parent_id' => CATEGORIES::TRANSFER_MENU_V2, 'category_type_id'=>CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'pay_toaccount.png', 'is_enabled' => 0, 'position' => $k++],
            ['id' => CATEGORIES::CONVERSION_CURRENCY_V2, 'code' => 'CONVERSION_CURRENCY_V2', 'name' => 'Купить/продать валюту', 'parent_id' => CATEGORIES::TRANSFER_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_xchange.png', 'is_active' => 0, 'is_enabled' => 0, 'position' => $k++],

            ['id' => CATEGORIES::TO_ACCOUNTS_ESKHATA_V2, 'code' => 'TO_ACCOUNTS_ESKHATA_V2', 'name' => 'Клиенту банка «Эсхата»', 'parent_id' => CATEGORIES::TO_ACCOUNTS_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'eskhatabank.png', 'position' => $k++],
            ['id' => CATEGORIES::TO_ACCOUNTS_OTHER_V2, 'code' => 'TO_ACCOUNTS_OTHER_V2', 'name' => 'В другой банк', 'parent_id' => CATEGORIES::TO_ACCOUNTS_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'otherbank.png', 'is_active' => 1, 'is_enabled' => 1, 'position' => $k++],

            ['id' => CATEGORIES::MOBILE_CONNECTION_V2, 'code' => 'MOBILE_CONNECTION_V2', 'name' => 'Мобильная связь', 'parent_id' => CATEGORIES::PAYMENT_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_mobile.png', 'position' => $k++],
            ['id' => CATEGORIES::COMMUNAL_V2, 'code' => 'COMMUNAL_V2', 'name' => 'Коммунальные услуги', 'parent_id' => CATEGORIES::PAYMENT_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_utilities.png', 'position' => $k++],
            ['id' => CATEGORIES::INTERNET_IP_V2, 'code' => 'INTERNET_IP_V2', 'name' => 'Интернет и IP телефония', 'parent_id' => CATEGORIES::PAYMENT_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_internet.png', 'position' => $k++],
            ['id' => CATEGORIES::ABROAD_MOBILE_V2, 'code' => 'ABROAD_MOBILE_V2', 'name' => 'Международные операторы', 'parent_id' => CATEGORIES::PAYMENT_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_international.png', 'position' => $k++],
            ['id' => CATEGORIES::BANK_V2, 'code' => 'BANK_V2', 'name' => 'Погашение кредита', 'parent_id' => CATEGORIES::PAYMENT_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_credit.png', 'position' => $k++],
            ['id' => CATEGORIES::ONLINE_GAME_V2, 'code' => 'ONLINE_GAME_V2', 'name' => 'Игры и Онлайн сервисы', 'parent_id' => CATEGORIES::PAYMENT_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_games.png', 'position' => $k++],
            ['id' => CATEGORIES::SMI_V2, 'code' => 'SMI_V2', 'name' => 'ТВ и Радио', 'parent_id' => CATEGORIES::PAYMENT_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_tvradio.png', 'position' => $k++],
            ['id' => CATEGORIES::EWALLET_V2, 'code' => 'EWALLET_V2', 'name' => 'Электронные кошельки', 'parent_id' => CATEGORIES::PAYMENT_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_ewallet.png', 'position' => $k++],
            ['id' => CATEGORIES::NGN_V2, 'code' => 'NGN_V2', 'name' => 'Городская и NGN связь', 'parent_id' => CATEGORIES::PAYMENT_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_landline.png', 'position' => $k++],
            ['id' => CATEGORIES::FOND_V2, 'code' => 'FOND_V2', 'name' => 'Благотворительные фонды', 'parent_id' => CATEGORIES::PAYMENT_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'paysend_charity.png', 'position' => $k++],
            ['id' => CATEGORIES::SAFE_CITY, 'code' => 'SAFE_CITY', 'name' => 'Шахри бехатар', 'parent_id' => CATEGORIES::PAYMENT_MENU_V2, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'shahri_behatar.png', 'position' => $k++],


            //ВЕБ версия
//            ['id' => CATEGORIES::CURRENCY_RATE_MENU_WEB, 'code' => 'MENU_CURRENCY_RATE_WEB', 'name' => 'Курсы', 'parent_id' => CATEGORIES::WEB, 'category_type_id' => CATEGORYTYPES::MENU_CURRENCY_RATE_ID, 'icon_url' => 'change.png', 'position' => $k++],
//            ['id' => CATEGORIES::QR_MENU_WEB, 'code' => 'MENU_QR_WEB', 'name' => 'QR оплата', 'parent_id' => CATEGORIES::WEB, 'category_type_id' => CATEGORYTYPES::MENU_QR_ID, 'icon_url' => 'qr.png', 'position' => $k++],
//            ['id' => CATEGORIES::MAP_MENU_WEB, 'code' => 'MENU_MAP_WEB', 'name' => 'На карте', 'parent_id' => CATEGORIES::WEB, 'category_type_id' => CATEGORYTYPES::MENU_MAP_ID, 'icon_url' => 'map.png', 'position' => $k++],
//            ['id' => CATEGORIES::DEPOSIT_MENU_WEB, 'code' => 'MENU_DEPOSIT_WEB', 'name' => 'Вклады', 'parent_id' => CATEGORIES::WEB, 'category_type_id' => CATEGORYTYPES::MENU_DEPOSIT_ID, 'icon_url' => 'deposit.png', 'position' => $k++],
//            ['id' => CATEGORIES::CREDIT_MENU_WEB, 'code' => 'MENU_CREDIT_WEB', 'name' => 'Кредиты', 'parent_id' => CATEGORIES::WEB, 'category_type_id' => CATEGORYTYPES::MENU_CREDIT_ID, 'icon_url' => 'credit.png', 'position' => $k++],
//            ['id' => CATEGORIES::INVOICE_MENU_WEB, 'code' => 'MENU_INVOICE_WEB', 'name' => 'Счета к оплате', 'parent_id' => CATEGORIES::WEB, 'category_type_id' => CATEGORYTYPES::MENU_INVOICE_FOR_PAYMENT_ID, 'icon_url' => 'account.png', 'position' => $k++],

            ['id' => CATEGORIES::WEB_MAIN_MENU, 'code' => CATEGORYTYPES::WEB_MAIN_MENU_CODE, 'name' => CATEGORYTYPES::WEB_MAIN_MENU_NAME, 'parent_id' => CATEGORIES::WEB, 'category_type_id' => CATEGORYTYPES::WEB_MAIN_MENU_ID, 'icon_url' => '', 'position' => $k++],
            ['id' => CATEGORIES::WEB_TRANSFER_MENU, 'code' => CATEGORYTYPES::WEB_MAIN_TRANSFER_CODE, 'name' => CATEGORYTYPES::WEB_MAIN_TRANSFER_NAME, 'parent_id' => CATEGORIES::WEB, 'category_type_id' => CATEGORYTYPES::WEB_MAIN_TRANSFER_ID, 'icon_url' => '', 'position' => $k++],
            ['id' => CATEGORIES::WEB_PAYMENT_MENU, 'code' => CATEGORYTYPES::WEB_MAIN_PAYMENT_CODE, 'name' => CATEGORYTYPES::WEB_MAIN_PAYMENT_NAME, 'parent_id' => CATEGORIES::WEB, 'category_type_id' => CATEGORYTYPES::WEB_MAIN_PAYMENT_ID, 'icon_url' => '', 'position' => $k++],
            ['id' => CATEGORIES::WEB_MAIN_MENU_CURRENCY_RATE, 'code' => CATEGORYTYPES::WEB_MAIN_CURRENCY_RATE_CODE, 'name' => CATEGORYTYPES::WEB_MAIN_CURRENCY_RATE_NAME, 'parent_id' => CATEGORIES::WEB, 'category_type_id' => CATEGORYTYPES::WEB_MAIN_CURRENCY_RATE_ID, 'icon_url' => '', 'position' => $k++],
            ['id' => CATEGORIES::WEB_MAIN_MENU_TEMPLATE, 'code' => CATEGORYTYPES::WEB_MAIN_TEMPLATES_CODE, 'name' => CATEGORYTYPES::WEB_MAIN_TEMPLATES_NAME, 'parent_id' => CATEGORIES::WEB, 'category_type_id' => CATEGORYTYPES::WEB_MAIN_TEMPLATES_ID, 'icon_url' => 'map.png', 'position' => $k++],
            ['id' => CATEGORIES::WEB_MAIN_MENU_ON_MAP, 'code' => CATEGORYTYPES::WEB_MAIN_ON_MAP_CODE, 'name' => CATEGORYTYPES::WEB_MAIN_ON_MAP_NAME, 'parent_id' => CATEGORIES::WEB, 'category_type_id' => CATEGORYTYPES::WEB_MAIN_ON_MAP_ID, 'icon_url' => 'deposit.png', 'position' => $k++],

//            ['id' => CATEGORIES::TO_ACCOUNTS_WEB, 'code' => 'TO_ACCOUNTS_WEB', 'name' => 'На свой счет', 'parent_id' => CATEGORIES::TRANSFER_MENU_WEB, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'pay_toaccount.png', 'position' => $k++],
//            ['id' => CATEGORIES::CONVERSION_CURRENCY_WEB, 'code' => 'CONVERSION_CURRENCY_WEB', 'name' => 'Купить/продать валюту', 'parent_id' => CATEGORIES::TRANSFER_MENU_WEB, 'category_type_id'=>CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'pay_change2.png', 'is_active' => 0, 'is_enabled' => 0, 'position' => $k++],

            ['id' => CATEGORIES::TO_ACCOUNTS_ESKHATA_WEB, 'code' => 'TO_ACCOUNTS_ESKHATA_WEB', 'name' => 'Клиенту "Эсхата Банка"', 'parent_id' => CATEGORIES::TO_ACCOUNTS_WEB, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => '', 'position' => $k++],
            ['id' => CATEGORIES::TO_ACCOUNTS_OTHER_WEB, 'code' => 'TO_ACCOUNTS_OTHER_WEB', 'name' => 'В другой банк', 'parent_id' => CATEGORIES::TO_ACCOUNTS_WEB, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => '', 'position' => $k++],

            ['id' => CATEGORIES::MOBILE_CONNECTION_WEB, 'code' => 'MOBILE_CONNECTION_WEB', 'name' => 'Мобильная связь', 'parent_id' => CATEGORIES::WEB_PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'pay_mobile.png', 'position' => $k++],
            ['id' => CATEGORIES::COMMUNAL_WEB, 'code' => 'COMMUNAL_WEB', 'name' => 'Коммунальные услуги', 'parent_id' => CATEGORIES::WEB_PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'communal.png', 'position' => $k++],
            ['id' => CATEGORIES::INTERNET_IP_WEB, 'code' => 'INTERNET_IP_WEB', 'name' => 'Интернет и IP телефония', 'parent_id' => CATEGORIES::WEB_PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'pay_internet.png', 'position' => $k++],
            ['id' => CATEGORIES::NGN_WEB, 'code' => 'NGN_WEB', 'name' => 'Городская и NGN связь', 'parent_id' => CATEGORIES::WEB_PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'pay_landline.png', 'position' => $k++],
            ['id' => CATEGORIES::ABROAD_MOBILE_WEB, 'code' => 'ABROAD_MOBILE_WEB', 'name' => 'Международные операторы', 'parent_id' => CATEGORIES::WEB_PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'pay_international.png', 'position' => $k++],
            ['id' => CATEGORIES::ONLINE_GAME_WEB, 'code' => 'ONLINE_GAME_WEB', 'name' => 'Игры и Онлайн сервисы', 'parent_id' => CATEGORIES::WEB_PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'account.png', 'position' => $k++],
            ['id' => CATEGORIES::SMI_WEB, 'code' => 'SMI_WEB', 'name' => 'ТВ и Радио', 'parent_id' => CATEGORIES::WEB_PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'pay_games.png', 'position' => $k++],
            ['id' => CATEGORIES::EWALLET_WEB, 'code' => 'EWALLET_WEB', 'name' => 'Электронные кошельки', 'parent_id' => CATEGORIES::WEB_PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'pay_tvradio.png', 'position' => $k++],
            ['id' => CATEGORIES::FOND_WEB, 'code' => 'FOND_WEB', 'name' => 'Благотворительные фонды', 'parent_id' => CATEGORIES::WEB_PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'pay_charity.png', 'position' => $k++],
            ['id' => CATEGORIES::BANK_WEB, 'code' => 'BANK_WEB', 'name' => 'Банковские услуги', 'parent_id' => CATEGORIES::WEB_PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'pay_bank.png', 'position' => $k++],
            ['id' => CATEGORIES::SAFE_CITY, 'code' => 'SAFE_CITY', 'name' => 'Шахри бехатар', 'parent_id' => CATEGORIES::WEB_PAYMENT_MENU, 'category_type_id' => CATEGORYTYPES::MENU_DEFAULT_ID, 'icon_url' => 'shahri_behatar.png', 'position' => $k++],

        ];

        $i = 1;
        $services = [
            CATEGORIES::MOBILE_CONNECTION => [
                SERVICES::MOBILE_TCELL_TJ => ['position' => $i++],
                SERVICES::MOBILE_MEGAFON_TJ => ['position' => $i++],
                SERVICES::MOBILE_BABILON_TJ => ['position' => $i++],
                SERVICES::MOBILE_BEELINE_TJ => ['position' => $i++],
                //SERVICES::MOBILE_TJ_MOBILE => ['position' => $i++],
            ],
            CATEGORIES::INTERNET => [
                SERVICES::INTERNET_BABILON_T => ['position' => $i++],
                SERVICES::INTERNET_TELECOM => ['position' => $i++],
                SERVICES::INTERNET_ISATEL => ['position' => $i++],
                SERVICES::INTERNET_TOJNET => ['position' => $i++],
            ],
            CATEGORIES::NGN => [
                SERVICES::NGN_TAJIK_TELECOM => ['position' => $i++],
                SERVICES::NGN_INTERCOM => ['position' => $i++],
                SERVICES::NGN_BABILON_T => ['position' => $i++],
                SERVICES::NGN_TELECOM => ['position' => $i++],
                SERVICES::NGN_EASTERA => ['position' => $i++],
            ],
            CATEGORIES::ABROAD_MOBILE => [
                SERVICES::ABROAD_MOBILE_MTS_RU => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_MEGAFON_RU => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_BEELINE_RU => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_BEELINE_KZ => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_BEELINE_UZ => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_BEELINE_KG => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_MEGACOM_KG => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_O_NURTELECOM_KG => ['position' => $i++],
            ],
            CATEGORIES::ONLINE => [
                SERVICES::ONLINE_ODNOKLASSNIKI => ['position' => $i++],
                SERVICES::ONLINE_SKYPE => ['position' => $i++],
                SERVICES::ONLINE_FORMULA => ['position' => $i++],
                SERVICES::ONLINE_IRSOL => ['position' => $i++],
                SERVICES::ONLINE_OSON_SMS => ['position' => $i++],
                SERVICES::ONLINE_TAHSIL_INFO => ['position' => $i++],
                SERVICES::ONLINE_FABERLIC => ['position' => $i++],
                SERVICES::ONLINE_TAXI_ROH => ['position' => $i++],
                SERVICES::ONLINE_GET_TJ => ['position' => $i++],
            ],
            CATEGORIES::SMI => [
                SERVICES::SMI_ANT => ['position' => $i++],
                SERVICES::SMI_NTV => ['position' => $i++],
                SERVICES::SMI_TIROZ => ['position' => $i++],
            ],
            CATEGORIES::EWALLET => [
                SERVICES::EWALLET_OSONPAY => ['position' => $i++],
                SERVICES::EWALLET_SOMON_TJ => ['position' => $i++],
                SERVICES::EWALLET_IMKON => ['position' => $i++],
                //SERVICES::EWALLET_YANDEX => ['position' => $i++],
            ],
            CATEGORIES::FOND => [
                SERVICES::FOND_ORMON => ['position' => $i++],
                SERVICES::FOND_HILOLI_AHMAR => ['position' => $i++],
            ],
            CATEGORIES::BANK => [
                SERVICES::BANK_CREDIT => ['position' => $i++],
                SERVICES::BANK_OVERDRAFT => ['position' => $i++],
                SERVICES::BANK_ALIF => ['position' => $i++],
                SERVICES::BANK_ARVAND => ['position' => $i++],
                SERVICES::BANK_MDO_FINCA => ['position' => $i++],
                SERVICES::BANK_BAROR => ['position' => $i++],
                SERVICES::BANK_YASNO => ['position' => $i++],
                SERVICES::BANK_KAFOLAT => ['position' => $i++],
            ],
            CATEGORIES::SEND_MENU => [
                SERVICES::EWALLET_ESKHATA => ['position' => $i++],
            ],
            CATEGORIES::CARDS => [
                SERVICES::CARDS_LOCAL_ESKHATA => ['position' => $i++],
                SERVICES::CARDS_AMONAT => ['position' => $i++],
                SERVICES::CARDS_IMON => ['position' => $i++],
                SERVICES::CARDS_MATIN => ['position' => $i++],
                SERVICES::CARDS_SPITAMEN => ['position' => $i++],
                SERVICES::CARDS_AVVALIN => ['position' => $i++],
                SERVICES::CARDS_TOJIKSODIROT => ['position' => $i++],
                SERVICES::CARDS_FONON => ['position' => $i++],
                SERVICES::CARDS_KAFOLAT => ['position' => $i++],
                SERVICES::CARDS_ALIF => ['position' => $i++],
                SERVICES::CARDS_FARDO => ['position' => $i++],
            ],
            CATEGORIES::ACCOUNTS => [
                SERVICES::BANK_POPOLNENIE_YUR => ['position' => $i++],
                SERVICES::BANK_POPOLNENIE => ['position' => $i++],
            ],

            //V2 -----------------------------------------------------------

            CATEGORIES::MOBILE_CONNECTION_V2 => [
                SERVICES::MOBILE_TCELL_TJ => ['position' => $i++],
                SERVICES::MOBILE_MEGAFON_TJ => ['position' => $i++],
                SERVICES::MOBILE_BABILON_TJ => ['position' => $i++],
                SERVICES::MOBILE_BEELINE_TJ => ['position' => $i++],
                //SERVICES::MOBILE_TJ_MOBILE => ['position' => $i++],
            ],

//            CATEGORIES::MOBILE_VERSION_2 => [
//            SERVICES::RECEIVE_TRANSFER_V2 => ['position' => $i++],
//            ],

            CATEGORIES::COMMUNAL_V2 => [
                SERVICES::COMMUNAL_BARKI_TOJIK_DUSHANBE => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_KHUJAND => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_TURSUNZODA => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_VAHDAT => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_NORAK => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_BOKHTAR => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_ISFARA => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_SOGDES => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_ISTES => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_BUSTON => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_HISOR => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_SARBAND => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_CHAYKHUN => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_VAKHSH => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_DUSTI => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_KUSHONIYON => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_ABDURAHMONI_JOMI => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_KUBODIYON => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_JALOLIDIN_BALKHI => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_PAHJ => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_NOSIRI_KHISRAV => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_SHAHRITUS => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_KHURUSON => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_FAYZOBOD => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_SHAHRINAV => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_ROGUN => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_VARZOB => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_KULOB => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_RUDAKI => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_RUDAKI_2 => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_TOJIKOBOD => ['position' => $i++],
                SERVICES::COMMUNAL_PAMIR_ENERGY => ['position' => $i++],
                SERVICES::COMMUNAL_VODOKANAL_DUSHANBE => ['position' => $i++],
                SERVICES::COMMUNAL_VODOKANAL_KHUJAND => ['position' => $i++],
            ],
            CATEGORIES::INTERNET_IP_V2 => [
                SERVICES::INTERNET_BABILON_T => ['position' => $i++],
                SERVICES::INTERNET_TELECOM => ['position' => $i++],
                SERVICES::INTERNET_ISATEL => ['position' => $i++],
                SERVICES::INTERNET_TOJNET => ['position' => $i++],
            ],
            CATEGORIES::NGN_V2 => [
                SERVICES::NGN_TAJIK_TELECOM => ['position' => $i++],
                SERVICES::NGN_INTERCOM => ['position' => $i++],
                SERVICES::NGN_BABILON_T => ['position' => $i++],
                SERVICES::NGN_TELECOM => ['position' => $i++],
                SERVICES::NGN_EASTERA => ['position' => $i++],
            ],
            CATEGORIES::ABROAD_MOBILE_V2 => [
                SERVICES::ABROAD_MOBILE_MTS_RU => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_MEGAFON_RU => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_BEELINE_RU => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_BEELINE_KZ => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_BEELINE_UZ => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_BEELINE_KG => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_MEGACOM_KG => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_O_NURTELECOM_KG => ['position' => $i++],
            ],
            CATEGORIES::ONLINE_GAME_V2 => [
                SERVICES::ONLINE_ODNOKLASSNIKI => ['position' => $i++],
                SERVICES::ONLINE_SKYPE => ['position' => $i++],
                SERVICES::ONLINE_FORMULA => ['position' => $i++],
                SERVICES::ONLINE_IRSOL => ['position' => $i++],
                SERVICES::ONLINE_OSON_SMS => ['position' => $i++],
                SERVICES::ONLINE_TAHSIL_INFO => ['position' => $i++],
                SERVICES::ONLINE_FABERLIC => ['position' => $i++],
                SERVICES::ONLINE_TAXI_ROH => ['position' => $i++],
                SERVICES::ONLINE_GET_TJ => ['position' => $i++],
                SERVICES::ONLINE_1XBET => ['position' => $i++],
                SERVICES::ONLINE_MAXIM => ['position' => $i++],
            ],
            CATEGORIES::SMI_V2 => [
                SERVICES::SMI_ANT => ['position' => $i++],
                SERVICES::SMI_NTV => ['position' => $i++],
                SERVICES::SMI_TIROZ => ['position' => $i++],
            ],
            CATEGORIES::EWALLET_V2 => [
                SERVICES::EWALLET_OSONPAY => ['position' => $i++],
                SERVICES::EWALLET_SOMON_TJ => ['position' => $i++],
                SERVICES::EWALLET_IMKON => ['position' => $i++],
                //SERVICES::EWALLET_QPAY=> ['position' => $i++],
                //SERVICES::EWALLET_YANDEX => ['position' => $i++],
            ],
            CATEGORIES::FOND_V2 => [
                SERVICES::FOND_ORMON => ['position' => $i++],
                SERVICES::FOND_HILOLI_AHMAR => ['position' => $i++],
            ],

            //Перевести
            CATEGORIES::TRANSFER_MENU_V2 => [
                SERVICES::TRANSFER_BETWEEN_ACCOUNTS_V2 => ['position' => $i++],
                SERVICES::TRANSFER_CARD_V2 => ['position' => $i++],
                SERVICES::EWALLET_ESKHATA => ['position' => $i++],
                SERVICES::BANK_TO_ACCOUNT => ['position' => $i++],
                SERVICES::BANK_TO_ACCOUNT_YUR => ['position' => $i++],
                SERVICES::RECEIVE_TRANSFER_V2 => ['position' => $i++],
                SERVICES::TRANSFER_SONIYA_V2 => ['position' => $i++],
                SERVICES::CURRENCY_EXCHANGE_V2 => ['position' => $i++],
            ],
            CATEGORIES::TO_ACCOUNTS_ESKHATA_V2 => [
                SERVICES::BANK_POPOLNENIE_YUR => ['position' => $i++],
                SERVICES::BANK_POPOLNENIE => ['position' => $i++],
            ],
            CATEGORIES::TO_ACCOUNTS_OTHER_V2 => [
                SERVICES::BANK_POPOLNENIE_YUR_OTHER => ['position' => $i++],
                SERVICES::BANK_POPOLNENIE_OTHER => ['position' => $i++],
            ],
            CATEGORIES::TO_ACCOUNT_ESKHATA_ONLINE_V2 => [
                SERVICES::EWALLET_ESKHATA => ['position' => $i++],
            ],
            CATEGORIES::BANK_V2 => [

                //SERVICES::BANK_CREDIT => ['position' => $i++],
                //SERVICES::BANK_OVERDRAFT => ['position' => $i++],
                SERVICES::BANK_ALIF => ['position' => $i++],
                SERVICES::BANK_ARVAND => ['position' => $i++],
                SERVICES::BANK_MDO_FINCA => ['position' => $i++],
                SERVICES::BANK_BAROR => ['position' => $i++],
                SERVICES::BANK_YASNO => ['position' => $i++],
                SERVICES::BANK_KAFOLAT => ['position' => $i++],
            ],
            CATEGORIES::SAFE_CITY => [
                SERVICES::SAFE_CITY_30 => ['position' => $i++],
                SERVICES::SAFE_CITY_60 => ['position' => $i++],
                SERVICES::SAFE_CITY_100 => ['position' => $i++],
                SERVICES::SAFE_CITY_180 => ['position' => $i++],
            ],
//            CATEGORIES::SEND_MENU => [
            //                SERVICES::EWALLET_ESKHATA => ['position' => $i++],
            //            ],
            //            CATEGORIES::TO_CARDS_V2 => [
            //                SERVICES::CARDS_LOCAL_ESKHATA => ['position' => $i++],
            //                SERVICES::CARDS_AMONAT => ['position' => $i++],
            //                SERVICES::CARDS_IMON => ['position' => $i++],
            //                SERVICES::CARDS_MATIN => ['position' => $i++],
            //                SERVICES::CARDS_SPITAMEN => ['position' => $i++],
            //                SERVICES::CARDS_AVVALIN => ['position' => $i++],
            //                SERVICES::CARDS_TOJIKSODIROT => ['position' => $i++],
            //                SERVICES::CARDS_FONON => ['position' => $i++],
            //                SERVICES::CARDS_KAFOLAT => ['position' => $i++],
            //                SERVICES::CARDS_ALIF => ['position' => $i++],
            //                SERVICES::CARDS_FARDO => ['position' => $i++],
            //                SERVICES::CARDS_MILLI=> ['position' => $i++],
            //                SERVICES::CARDS_OSON => ['position' => $i++],
            //            ],


            //WEB -----------------------------------------------------------

            CATEGORIES::MOBILE_CONNECTION_WEB => [
                SERVICES::MOBILE_TCELL_TJ => ['position' => $i++],
                SERVICES::MOBILE_MEGAFON_TJ => ['position' => $i++],
                SERVICES::MOBILE_BABILON_TJ => ['position' => $i++],
                SERVICES::MOBILE_BEELINE_TJ => ['position' => $i++],
                //SERVICES::MOBILE_TJ_MOBILE => ['position' => $i++],
            ],
            CATEGORIES::COMMUNAL_WEB => [
                SERVICES::COMMUNAL_BARKI_TOJIK_DUSHANBE => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_KHUJAND => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_TURSUNZODA => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_VAHDAT => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_NORAK => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_BOKHTAR => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_ISFARA => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_SOGDES => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_ISTES => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_BUSTON => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_HISOR => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_SARBAND => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_CHAYKHUN => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_VAKHSH => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_DUSTI => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_KUSHONIYON => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_ABDURAHMONI_JOMI => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_KUBODIYON => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_JALOLIDIN_BALKHI => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_PAHJ => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_NOSIRI_KHISRAV => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_SHAHRITUS => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_KHURUSON => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_FAYZOBOD => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_SHAHRINAV => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_ROGUN => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_VARZOB => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_KULOB => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_RUDAKI => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_RUDAKI_2 => ['position' => $i++],
                SERVICES::COMMUNAL_BARKI_TOJIK_TOJIKOBOD => ['position' => $i++],
                SERVICES::COMMUNAL_PAMIR_ENERGY => ['position' => $i++],
                SERVICES::COMMUNAL_VODOKANAL_DUSHANBE => ['position' => $i++],
                SERVICES::COMMUNAL_VODOKANAL_KHUJAND => ['position' => $i++],
            ],
            CATEGORIES::INTERNET_IP_WEB => [
                SERVICES::INTERNET_BABILON_T => ['position' => $i++],
                SERVICES::INTERNET_TELECOM => ['position' => $i++],
                SERVICES::INTERNET_ISATEL => ['position' => $i++],
                SERVICES::INTERNET_TOJNET => ['position' => $i++],
            ],
            CATEGORIES::NGN_WEB => [
                SERVICES::NGN_TAJIK_TELECOM => ['position' => $i++],
                SERVICES::NGN_INTERCOM => ['position' => $i++],
                SERVICES::NGN_BABILON_T => ['position' => $i++],
                SERVICES::NGN_TELECOM => ['position' => $i++],
                SERVICES::NGN_EASTERA => ['position' => $i++],
            ],
            CATEGORIES::ABROAD_MOBILE_WEB => [
                SERVICES::ABROAD_MOBILE_MTS_RU => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_MEGAFON_RU => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_BEELINE_RU => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_BEELINE_KZ => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_BEELINE_UZ => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_BEELINE_KG => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_MEGACOM_KG => ['position' => $i++],
                SERVICES::ABROAD_MOBILE_O_NURTELECOM_KG => ['position' => $i++],
            ],
            CATEGORIES::ONLINE_GAME_WEB => [
                SERVICES::ONLINE_ODNOKLASSNIKI => ['position' => $i++],
                SERVICES::ONLINE_SKYPE => ['position' => $i++],
                SERVICES::ONLINE_FORMULA => ['position' => $i++],
                SERVICES::ONLINE_IRSOL => ['position' => $i++],
                SERVICES::ONLINE_OSON_SMS => ['position' => $i++],
                SERVICES::ONLINE_TAHSIL_INFO => ['position' => $i++],
                SERVICES::ONLINE_FABERLIC => ['position' => $i++],
                SERVICES::ONLINE_TAXI_ROH => ['position' => $i++],
                SERVICES::ONLINE_GET_TJ => ['position' => $i++],
                SERVICES::ONLINE_1XBET => ['position' => $i++],
                SERVICES::ONLINE_MAXIM => ['position' => $i++],
            ],
            CATEGORIES::SMI_WEB => [
                SERVICES::SMI_ANT => ['position' => $i++],
                SERVICES::SMI_NTV => ['position' => $i++],
                SERVICES::SMI_TIROZ => ['position' => $i++],
            ],
            CATEGORIES::EWALLET_WEB => [
                SERVICES::EWALLET_OSONPAY => ['position' => $i++],
                SERVICES::EWALLET_SOMON_TJ => ['position' => $i++],
                SERVICES::EWALLET_IMKON => ['position' => $i++],
                //SERVICES::EWALLET_QPAY=> ['position' => $i++],
                //SERVICES::EWALLET_YANDEX => ['position' => $i++],
            ],
            CATEGORIES::FOND_WEB => [
                SERVICES::FOND_ORMON => ['position' => $i++],
                SERVICES::FOND_HILOLI_AHMAR => ['position' => $i++],
            ],

            //Перевести
            CATEGORIES::WEB_TRANSFER_MENU => [
                SERVICES::TRANSFER_BETWEEN_ACCOUNTS_V2 => ['position' => $i++],
                SERVICES::TRANSFER_CARD_V2 => ['position' => $i++],
                SERVICES::EWALLET_ESKHATA => ['position' => $i++],
                SERVICES::RECEIVE_TRANSFER_V2 => ['position' => $i++],
                SERVICES::TRANSFER_SONIYA_V2 => ['position' => $i++],
                SERVICES::CURRENCY_EXCHANGE_V2 => ['position' => $i++],
                SERVICES::TRANSFER_FROM_RUSSIAN_CARD => ['position' => $i++],
            ],
            CATEGORIES::TO_ACCOUNTS_ESKHATA_WEB => [
                SERVICES::BANK_POPOLNENIE_YUR => ['position' => $i++],
                SERVICES::BANK_POPOLNENIE => ['position' => $i++],
            ],
            CATEGORIES::TO_ACCOUNTS_OTHER_WEB => [
                SERVICES::BANK_POPOLNENIE_YUR_OTHER => ['position' => $i++],
                SERVICES::BANK_POPOLNENIE_OTHER => ['position' => $i++],
            ],
            CATEGORIES::TO_ACCOUNT_ESKHATA_ONLINE_WEB => [
                SERVICES::EWALLET_ESKHATA => ['position' => $i++],
            ],
            CATEGORIES::BANK_WEB => [
                SERVICES::BANK_CREDIT => ['position' => $i++],
                SERVICES::BANK_OVERDRAFT => ['position' => $i++],
                SERVICES::BANK_ALIF => ['position' => $i++],
                SERVICES::BANK_ARVAND => ['position' => $i++],
                SERVICES::BANK_MDO_FINCA => ['position' => $i++],
                SERVICES::BANK_BAROR => ['position' => $i++],
                SERVICES::BANK_YASNO => ['position' => $i++],
                SERVICES::BANK_KAFOLAT => ['position' => $i++],
            ],
            CATEGORIES::SAFE_CITY => [
                SERVICES::SAFE_CITY_30 => ['position' => $i++],
                SERVICES::SAFE_CITY_60 => ['position' => $i++],
                SERVICES::SAFE_CITY_100 => ['position' => $i++],
                SERVICES::SAFE_CITY_180 => ['position' => $i++],
            ],
        ];

        foreach ($categories as $category) {
            try {

                //$cat = Category::updateOrCreate(['id' => $category['id']], $category);
                $cat = Category::create($category);
                //$this->logger->error($services[$category['id']]);
                //$cat->services()->sync(isset($services[$category['id']]) ? $services[$category['id']] : []);

            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }

    }
}
