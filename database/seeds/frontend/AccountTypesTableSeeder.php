<?php

use App\Models\Account\AccountType\AccountType;
use App\Services\Common\Helpers\AccountCategoryTypes;
use App\Services\Common\Helpers\AccountTypes;
use App\Services\Common\Helpers\Gateway;
use Illuminate\Database\Seeder;

class AccountTypesTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $items = [
                [
                    'id' => AccountTypes::EWALLET_ESKHATA,
                    'code' => 'EWALLET_ESKHATA',
                    'name' => 'Эсхата Онлайн',
                    'account_category_type_id' => config('app_settings.default_account_category_type_ewallet_id'),
                    'gateway_id' => Gateway::EWALLET,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => 'maincard_wallet.png',
                    'img_uncolored' => 'maincard_wallet.png'
                ],
                [
                    'id' => AccountTypes::LOCAL_CARD_ESKHATA,
                    'code' => 'LOCAL_CARD_ESKHATA',
                    'code_map' => config('app_settings.default_local_card_account_type_code_map'),
                    'name' => 'Локальная карта Эсхата',
                    'account_category_type_id' => config('app_settings.default_account_category_type_card_id'),
                    'gateway_id' => config('app_settings.default_rucard_id'),
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => 'maincard_localcard.png',
                    'img_uncolored' => 'maincard_localcard.png'
                ],
                [
                    'id' => AccountTypes::LOCAL_ZP_CARD_ESKHATA,
                    'code' => 'LOCAL_ZP_CARD_ESKHATA',
                    'code_map' => "14",
                    'name' => 'Локальная карта "Зарплатный проект"',
                    'account_category_type_id' => config('app_settings.default_account_category_type_card_id'),
                    'gateway_id' => config('app_settings.default_rucard_id'),
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => 'maincard_localcard.png',
                    'img_uncolored' => 'maincard_localcard.png'
                ],
                [
                    'id' => AccountTypes::VISA_CLASSIC,
                    'code' => 'VISA_CLASSIC',
                    'code_map' => config('app_settings.default_card_visa_classic_code_map'),
                    'name' => 'Visa Classic',
                    'account_category_type_id' => config('app_settings.default_account_category_type_card_id'),
                    'gateway_id' => config('app_settings.default_rucard_id'),
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => 'maincard_visaall.png',
                    'img_uncolored' => 'maincard_visaall.png'
                ],
                [
                    'id' => AccountTypes::VISA_GOLD,
                    'code' => 'VISA_GOLD',
                    'code_map' => config('app_settings.default_card_visa_gold_code_map'),
                    'name' => 'Visa Gold',
                    'account_category_type_id' => config('app_settings.default_account_category_type_card_id'),
                    'gateway_id' => config('app_settings.default_rucard_id'),
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => 'maincard_visaall.png',
                    'img_uncolored' => 'maincard_visaall.png'
                ],
                [
                    'id' => AccountTypes::VISA_ELECTRON,
                    'code' => 'VISA_ELECTRON',
                    'code_map' => config('app_settings.default_card_visa_electron_code_map'),
                    'name' => 'Visa Electron',
                    'account_category_type_id' => config('app_settings.default_account_category_type_card_id'),
                    'gateway_id' => config('app_settings.default_rucard_id'),
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => 'maincard_visaall.png',
                    'img_uncolored' => 'maincard_visaall.png'
                ],
                [
                    'id' => AccountTypes::MASTERCARD_CIRRIUS_MAESTRO,
                    'code' => 'MASTERCARD_CIRRIUS_MAESTRO',
                    'code_map' => config('app_settings.default_card_mastercard_code_map'),
                    'name' => 'MasterCard Cirrius\Maestro',
                    'account_category_type_id' => config('app_settings.default_account_category_type_card_id'),
                    'gateway_id' => config('app_settings.default_rucard_id'),
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::MASTERCARD_GOLD,
                    'code' => 'MASTERCARD_GOLD',
                    'code_map' => config('app_settings.default_card_mastercard_gold_code_map'),
                    'name' => 'MasterCard Gold',
                    'account_category_type_id' => config('app_settings.default_account_category_type_card_id'),
                    'gateway_id' => config('app_settings.default_rucard_id'),
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::MASTERCARD_BUSINESS,
                    'code' => 'MASTERCARD_BUSINESS',
                    'code_map' => config('app_settings.default_card_mastercard_business_code_map'),
                    'name' => 'MasterCard Business',
                    'account_category_type_id' => config('app_settings.default_account_category_type_card_id'),
                    'gateway_id' => config('app_settings.default_rucard_id'),
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::YGONA,
                    'code' => 'YGONA',
                    'code_map' => config('app_settings.default_card_ygona_code_map'),
                    'name' => 'Ягона',
                    'account_category_type_id' => config('app_settings.default_account_category_type_card_id'),
                    'gateway_id' => config('app_settings.default_rucard_id'),
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::UNIONPAY_CLASSIC,
                    'code' => 'UNIONPAY_CLASSIC',
                    'code_map' => config('app_settings.default_card_unionpay_classic_code_map'),
                    'name' => 'UnionPay Classic',
                    'account_category_type_id' => config('app_settings.default_account_category_type_card_id'),
                    'gateway_id' => config('app_settings.default_rucard_id'),
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => 'maincard_unionpay.png',
                    'img_uncolored' => 'maincard_unionpay.png'
                ],
                [
                    'id' => AccountTypes::UNIONPAY_GOLD,
                    'code' => 'UNIONPAY_GOLD',
                    'code_map' => config('app_settings.default_card_unionpay_gold_code_map'),
                    'name' => 'UnionPay Gold',
                    'account_category_type_id' => config('app_settings.default_account_category_type_card_id'),
                    'gateway_id' => config('app_settings.default_rucard_id'),
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => 'maincard_unionpay.png',
                    'img_uncolored' => 'maincard_unionpay.png'
                ],
                [
                    'id' => config('app_settings.default_card_korti_milli_nonpers_id'),
                    'code' => 'KORTI_MILLI_NON_PERS',
                    'code_map' => config('app_settings.default_card_korti_milli_nonpers_code_map'),
                    'name' => 'Корти милли Non-Pers',
                    'account_category_type_id' => config('app_settings.default_account_category_type_card_id'),
                    'gateway_id' => config('app_settings.default_rucard_id'),
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => 'maincard_korti_milli.png',
                    'img_uncolored' => 'maincard_korti_milli.png'
                ],
                [
                    'id' => config('app_settings.default_card_korti_milli_id'),
                    'code' => 'KORTI_MILLI',
                    'code_map' => config('app_settings.default_card_korti_milli_code_map'),
                    'name' => 'Корти милли',
                    'account_category_type_id' => config('app_settings.default_account_category_type_card_id'),
                    'gateway_id' => config('app_settings.default_rucard_id'),
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => 'maincard_korti_milli.png',
                    'img_uncolored' => 'maincard_korti_milli.png'
                ],
                [
                    'id' => config('app_settings.default_merchant_id'),
                    'code' => 'MERCHANT',
                    'code_map' => null,
                    'name' => 'Merchant',
                    'account_category_type_id' => AccountCategoryTypes::MERCHANT_ID,
                    'gateway_id' => Gateway::MERCHANT,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::EWALLET_BONUS,
                    'code' => 'EWALLET_BONUS',
                    'code_map' => null,
                    'name' => 'Бонусный счёт',
                    'account_category_type_id' => AccountCategoryTypes::EWALLET_ID,
                    'gateway_id' => Gateway::EWALLET_BONUS,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => 'maincard_wallet_bonus.png',
                    'img_uncolored' => 'maincard_wallet_bonus.png'
                ],
                [
                    'id' => AccountTypes::VIRTUAL_EXPENSE,
                    'code' => 'VIRTUAL_EXPENSE',
                    'code_map' => null,
                    'name' => 'Виртуальный расходный счёт Банка Эсхата',
                    'account_category_type_id' => AccountCategoryTypes::VIRTUAL_ID,
                    'gateway_id' => Gateway::DEFAULT,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::VIRTUAL_INCOME,
                    'code' => 'VIRTUAL_INCOME',
                    'code_map' => null,
                    'name' => 'Виртуальный доходный счёт Банка Эсхата',
                    'account_category_type_id' => AccountCategoryTypes::VIRTUAL_ID,
                    'gateway_id' => Gateway::DEFAULT,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::VIRTUAL_COMMON_BONUS,
                    'code' => 'VIRTUAL_COMMON_BONUS',
                    'code_map' => null,
                    'name' => 'Виртуальный бонусный счёт',
                    'account_category_type_id' => AccountCategoryTypes::VIRTUAL_ID,
                    'gateway_id' => Gateway::DEFAULT,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::VIRTUAL_MERCHANT,
                    'code' => 'VIRTUAL_MERCHANT',
                    'code_map' => null,
                    'name' => 'Виртуальный транзитный счёт мерчанта',
                    'account_category_type_id' => AccountCategoryTypes::VIRTUAL_ID,
                    'gateway_id' => Gateway::MERCHANT,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::TKB_MASTER_CARD,
                    'code' => 'TKB_MASTER_CARD',
                    'code_map' => 'MASTER',
                    'name' => 'Master Card',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::TKB,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::TKB_VISA_CARD,
                    'code' => 'TKB_VISA_CARD',
                    'code_map' => 'VISA',
                    'name' => 'Visa',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::TKB,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => 'maincard_visaall.png',
                    'img_uncolored' => 'maincard_visaall.png'
                ],
                [
                    'id' => AccountTypes::TKB_MIR_CARD,
                    'code' => 'TKB_MIR_CARD',
                    'code_map' => 'MIR',
                    'name' => 'МИР',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::TKB,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::TKB_UNKNOWN_CARD,
                    'code' => 'TKB_UNKNOWN_CARD',
                    'code_map' => 'UNKNOWN',
                    'name' => 'UNKNOWN',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::TKB,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::BUSINESS_ACCOUNT,
                    'code' => 'BUSINESS_ACCOUNT',
                    'code_map' => '2053594',
                    'name' => 'Бизнес-счёт',
                    'account_category_type_id' => AccountCategoryTypes::ACCOUNT_ID,
                    'gateway_id' => Gateway::ABS,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::NEW_OZOD,
                    'code' => 'NEW_OZOD',
                    'code_map' => '33655455545',
                    'name' => 'Озод',
                    'account_category_type_id' => AccountCategoryTypes::ACCOUNT_ID,
                    'gateway_id' => Gateway::ABS,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::NEW_TIMMED,
                    'code' => 'NEW_TIMMED',
                    'code_map' => '33655541869',
                    'name' => 'Срочный депозит',
                    'account_category_type_id' => AccountCategoryTypes::DEPOSIT_ID,
                    'gateway_id' => Gateway::ABS,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_OTHER,
                    'code' => 'KORTI_MILLI_OTHER',
                    'code_map' => 'KORTI_MILLI_OTHER',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_AMONATBANK,
                    'code' => 'KORTI_MILLI_AMONATBANK',
                    'code_map' => 'KORTI_MILLI_AMONATBANK',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_DC,
                    'code' => 'KORTI_MILLI_DC',
                    'code_map' => 'KORTI_MILLI_DC',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_MATIN,
                    'code' => 'KORTI_MILLI_MATIN',
                    'code_map' => 'KORTI_MILLI_MATIN',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_TAMVIL,
                    'code' => 'KORTI_MILLI_TAMVIL',
                    'code_map' => 'KORTI_MILLI_TAMVIL',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_HUMO,
                    'code' => 'KORTI_MILLI_HUMO',
                    'code_map' => 'KORTI_MILLI_HUMO',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_ALIF,
                    'code' => 'KORTI_MILLI_ALIF',
                    'code_map' => 'KORTI_MILLI_ALIF',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_BMP_POKISTON,
                    'code' => 'KORTI_MILLI_BMP_POKISTON',
                    'code_map' => 'KORTI_MILLI_BMP_POKISTON',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_COMMERCBANK,
                    'code' => 'KORTI_MILLI_COMMERCBANK',
                    'code_map' => 'KORTI_MILLI_COMMERCBANK',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_ORIENBANK,
                    'code' => 'KORTI_MILLI_ORIENBANK',
                    'code_map' => 'KORTI_MILLI_ORIENBANK',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_TAVHIDBANK,
                    'code' => 'KORTI_MILLI_TAVHIDBANK',
                    'code_map' => 'KORTI_MILLI_TAVHIDBANK',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_KAFOLATBANK,
                    'code' => 'KORTI_MILLI_KAFOLATBANK',
                    'code_map' => 'KORTI_MILLI_KAFOLATBANK',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_AVVALIN,
                    'code' => 'KORTI_MILLI_AVVALIN',
                    'code_map' => 'KORTI_MILLI_AVVALIN',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_BAINALMILALI,
                    'code' => 'KORTI_MILLI_BAINALMILALI',
                    'code_map' => 'KORTI_MILLI_BAINALMILALI',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_SPITAMENBANK,
                    'code' => 'KORTI_MILLI_SPITAMENBANK',
                    'code_map' => 'KORTI_MILLI_SPITAMENBANK',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
                [
                    'id' => AccountTypes::KORTI_MILLI_IMON,
                    'code' => 'KORTI_MILLI_IMON',
                    'code_map' => 'KORTI_MILLI_IMON',
                    'name' => 'Корти милли',
                    'account_category_type_id' => AccountCategoryTypes::CARD_ID,
                    'gateway_id' => Gateway::KORTI_MILLI,
                    'parent_id' => '00000000-0000-0000-0000-000000000000',
                    'is_autocheck_balance' => 0,
                    'img_colored' => null,
                    'img_uncolored' => null
                ],
            ];

            foreach ($items as $item) {
                try {
                    $cat = AccountType::create($item);
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                }
            }

            //AccountType::create($item);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
