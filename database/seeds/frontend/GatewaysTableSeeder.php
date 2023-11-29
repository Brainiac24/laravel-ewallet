<?php

use App\Models\Gateway\Gateway as GatewayModel;
use App\Services\Common\Helpers\Gateway;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class GatewaysTableSeeder extends Database\Seeds\BaseSeeder
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
                'id' => Gateway::PS_ESKHATA,
                'code' =>  Gateway::PS_ESKHATA_CODE,
                'name' => 'Платёжная система Эсхата',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => '',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => '',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],

            ],
            [
                'id' => Gateway::RUCARD,
                'code' => Gateway::RUCARD_CODE,
                'name' => 'Рукард',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => 'VPOS_WCARD',
                    '840' => 'VPOS_WCARD_USD',
                    '643' => '',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => 'VPOS_EWALLET',
                    '840' => 'VPOS_EWALLET_USD',
                    '643' => '',
                    '978' => '',
                ],
            ],
            [
                'id' => Gateway::ABS,
                'code' => Gateway::ABS_CODE,
                'name' => 'ЦФТ',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => '',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => '',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
            ],
            [
                'id' => Gateway::EWALLET,
                'code' => Gateway::EWALLET_CODE,
                'name' => 'Кошелек Эсхата Онлайн',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => '300005',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => '300005',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
            ],
            [
                'id' => Gateway::DEPENDS_TO_ACCOUNT,
                'code' => Gateway::DEPENDS_TO_ACCOUNT_CODE,
                'name' => 'Зависит от аккаунта получателя',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => '',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => '',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
            ],
            [
                'id' => Gateway::SONIYA,
                'code' => Gateway::SONIYA_CODE,
                'name' => 'Сония',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => 'Soniya',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => 'Soniya',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
            ],
            [
                'id' => Gateway::MERCHANT,
                'code' => Gateway::MERCHANT_CODE,
                'name' => 'Мерчант',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => 'EWALLET_MERCHANT',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => 'EWALLET_MERCHANT',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
            ],
            [
                'id' => Gateway::EWALLET_BONUS,
                'code' => Gateway::EWALLET_BONUS_CODE,
                'name' => 'Бонусный счёт',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => 'BONUS',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => 'BONUS',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
            ],
            [
                'id' => Gateway::DEFAULT,
                'code' => Gateway::DEFAULT_CODE,
                'name' => 'По умолчанию',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => '',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => '',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
            ],
            [
                'id' => Gateway::TKB,
                'code' => Gateway::TKB_CODE,
                'name' => 'Транс Капитал Банк',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => '',
                    '840' => '',
                    '643' => 'TKB',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => '',
                    '840' => '',
                    '643' => 'TKB',
                    '978' => '',
                ],
            ],
            [
                'id' => Gateway::TRANSFER_FROM_RU,
                'code' => Gateway::TRANSFER_FROM_RU_CODE,
                'name' => 'Перевод из РФ',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => '',
                    '840' => '',
                    '643' => 'TRANSFER_FROM_RU',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => '',
                    '840' => '',
                    '643' => 'TRANSFER_FROM_RU',
                    '978' => '',
                ],
            ],
            [
                'id' => Gateway::BPC_MTM,
                'code' => Gateway::BPC_MTM_CODE,
                'name' => 'Карточный процессинг MTM',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => 'MTM_TJS_DEBET',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => 'MTM_TJS_CREDIT',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
            ],
            [
                'id' => Gateway::BPC_VISA,
                'code' => Gateway::BPC_VISA_CODE,
                'name' => 'Карточный процессинг BPC(VISA)',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => '',
                    '840' => 'BPC_VISA_USD_DEBET',
                    '643' => '',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => '',
                    '840' => 'BPC_VISA_USD_CREDIT',
                    '643' => '',
                    '978' => '',
                ],
            ],
            [
                'id' => Gateway::KORTI_MILLI,
                'code' => Gateway::KORTI_MILLI_CODE,
                'name' => 'Карточный процессинг Корти Милли',
                'is_active' => '1',
                'is_enabled_for_account' => '1',
                'is_enabled_for_service' => '1',
                'debet_json' => [
                    '972' => 'KORTI_MILLI_DEBET',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
                'credit_json' => [
                    '972' => 'KORTI_MILLI_CREDIT',
                    '840' => '',
                    '643' => '',
                    '978' => '',
                ],
            ],
        ];

        foreach ($vars as $var) {
            try {
                GatewayModel::create($var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
