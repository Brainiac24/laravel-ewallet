<?php

use App\Services\Common\Helpers\Gateway;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction\TransactionSyncRule\TransactionSyncRule;

class TransactionSyncRulesTableSeeder extends Database\Seeds\BaseSeeder
{
    public function run()
    {
        $vars = [
            /*[
                'id' => '4855f106-6041-11e9-9404-b06ebfbfa715',
                'from_gateway_id' => Gateway::RUCARD,
                'to_gateway_id' => Gateway::RUCARD,
            ],*/
            [
                'id' => 'a37c45bb-6047-11e9-9404-b06ebfbfa715',
                'from_gateway_id' => Gateway::RUCARD,
                'to_gateway_id' => Gateway::PS_ESKHATA,
            ],
            [
                'id' => '84e854c3-60d5-11e9-9404-b06ebfbfa715',
                'from_gateway_id' => Gateway::EWALLET,
                'to_gateway_id' => Gateway::PS_ESKHATA,
            ],
            [
                'id' => '7d1a68e6-60d5-11e9-9404-b06ebfbfa715',
                'from_gateway_id' => Gateway::RUCARD,
                'to_gateway_id' => Gateway::EWALLET,
            ],
            [
                'id' => '80b3ce21-60d5-11e9-9404-b06ebfbfa715',
                'from_gateway_id' => Gateway::EWALLET,
                'to_gateway_id' => Gateway::RUCARD,
            ],
            [
                'id' => '9af6acb1-ac85-11e9-a12f-b06ebfbfa715',
                'from_gateway_id' => Gateway::EWALLET,
                'to_gateway_id' => Gateway::SONIYA,
            ],
            [
                'id' => 'aa7c6fd0-ac85-11e9-a12f-b06ebfbfa715',
                'from_gateway_id' => Gateway::RUCARD,
                'to_gateway_id' => Gateway::SONIYA,
            ],
            [
                'id' => '8de7b634-c3f2-11e9-a12f-b06ebfbfa715',
                'from_gateway_id' => Gateway::RUCARD,
                'to_gateway_id' => Gateway::RUCARD,
            ],
            [
                'id' => 'd79ac1a3-4c69-4c7a-8e0d-244bb0b9e091',
                'from_gateway_id' => Gateway::EWALLET,
                'to_gateway_id' => Gateway::MERCHANT,
            ],
            [
                'id' => '221e3527-8862-48a3-a01a-165f0c712802',
                'from_gateway_id' => Gateway::RUCARD,
                'to_gateway_id' => Gateway::MERCHANT,
            ],

            [
                'id' => '7e33758f-129e-4036-a233-83190cd93e82',
                'from_gateway_id' => Gateway::MERCHANT,
                'to_gateway_id' => Gateway::DEFAULT,
            ],
            [
                'id' => '3dd3b999-55be-4535-a500-d94b8219a3aa',
                'from_gateway_id' => Gateway::DEFAULT,
                'to_gateway_id' => Gateway::DEFAULT,
            ],
            [
                'id' => 'b96475a1-711b-4952-97f7-b7952eac5ac2',
                'from_gateway_id' => Gateway::DEFAULT,
                'to_gateway_id' => Gateway::EWALLET_BONUS,
            ],

            [
                'id' => 'a728b826-5dc1-4d21-9ef4-c52720387626',
                'from_gateway_id' => Gateway::EWALLET_BONUS,
                'to_gateway_id' => Gateway::PS_ESKHATA,
            ],
            [
                'id' => '6ef28590-fa4d-4891-91e3-071172b925a4',
                'from_gateway_id' => Gateway::EWALLET_BONUS,
                'to_gateway_id' => Gateway::RUCARD,
            ],
            [
                'id' => '7ad2d3ec-f9ef-4ae9-8086-82735d37c702',
                'from_gateway_id' => Gateway::EWALLET_BONUS,
                'to_gateway_id' => Gateway::SONIYA,
            ],
            [
                'id' => '3f93fc3c-ca30-4fbd-9a84-6f977ad2c9c6',
                'from_gateway_id' => Gateway::EWALLET_BONUS,
                'to_gateway_id' => Gateway::MERCHANT,
            ],
            [
                'id' => '0e9f80b8-8d07-4fe2-9523-a82c15c55a07',
                'from_gateway_id' => Gateway::EWALLET_BONUS,
                'to_gateway_id' => Gateway::EWALLET,
            ],
            [
                'id' => 'e8b52b9b-07bc-446d-9954-7b2b16293531',
                'from_gateway_id' => Gateway::BPC_MTM,
                'to_gateway_id' => Gateway::EWALLET,
            ],
            [
                'id' => 'baeb06ff-b974-4b90-9025-b88718714a41',
                'from_gateway_id' => Gateway::BPC_MTM,
                'to_gateway_id' => Gateway::MERCHANT,
            ],
            [
                'id' => 'ebd0cbfe-8c1d-493e-a63b-49f2835c8c24',
                'from_gateway_id' => Gateway::BPC_MTM,
                'to_gateway_id' => Gateway::PS_ESKHATA,
            ],
            [
                'id' => '29eaca7a-5704-4430-b74a-e51bc747e024',
                'from_gateway_id' => Gateway::BPC_MTM,
                'to_gateway_id' => Gateway::SONIYA,
            ],
            [
                'id' => '3e7f846c-bd5e-47c5-82b7-46a89094dc1f',
                'from_gateway_id' => Gateway::EWALLET,
                'to_gateway_id' => Gateway::BPC_MTM,
            ],
            [
                'id' => '63bdad08-f857-4db5-9618-59b64f40ae2f',
                'from_gateway_id' => Gateway::EWALLET_BONUS,
                'to_gateway_id' => Gateway::BPC_MTM,
            ],
            [
                'id' => '56dc3795-ceff-40dc-a5ad-200956bb25ce',
                'from_gateway_id' => Gateway::BPC_VISA,
                'to_gateway_id' => Gateway::BPC_MTM,
            ],
            [
                'id' => '8685c064-32c4-46a1-9933-5c1bdd8b5f42',
                'from_gateway_id' => Gateway::BPC_MTM,
                'to_gateway_id' => Gateway::BPC_VISA,
            ],
            [
                'id' => '9275d738-0771-4cdd-9981-538ca10002bc',
                'from_gateway_id' => Gateway::BPC_VISA,
                'to_gateway_id' => Gateway::EWALLET,
            ],
            [
                'id' => 'd080e7a7-d9cd-492b-9bda-4901a14668d3',
                'from_gateway_id' => Gateway::EWALLET,
                'to_gateway_id' => Gateway::BPC_VISA,
            ],
            [
                'id' => '531cc311-214a-486a-94b1-7f67810a5b77',
                'from_gateway_id' => Gateway::EWALLET_BONUS,
                'to_gateway_id' => Gateway::BPC_VISA,
            ],
            [
                'id' => '8de47aa0-85ec-4caf-9eff-0ce2010a6781',
                'from_gateway_id' => Gateway::BPC_VISA,
                'to_gateway_id' => Gateway::BPC_VISA,
            ],
            [
                'id' => '8b04f88a-327d-4747-9474-baa21ac4df35',
                'from_gateway_id' => Gateway::BPC_VISA,
                'to_gateway_id' => Gateway::SONIYA,
            ],
            [
                'id' => '546e5c79-60a0-4964-81c0-1b86e8a646ea',
                'from_gateway_id' => Gateway::BPC_VISA,
                'to_gateway_id' => Gateway::PS_ESKHATA,
            ],
            [
                'id' => 'bfa26837-bf80-4e48-8fb5-94e304677cfb',
                'from_gateway_id' => Gateway::BPC_VISA,
                'to_gateway_id' => Gateway::MERCHANT,
            ],
            //korti milli
            [
                'id' => '1a536e9a-5e52-42cc-be99-f404ec74bc62',
                'from_gateway_id' => Gateway::KORTI_MILLI,
                'to_gateway_id' => Gateway::EWALLET,
            ],
            [
                'id' => '886e5721-858c-4200-b197-f04c3580f620',
                'from_gateway_id' => Gateway::KORTI_MILLI,
                'to_gateway_id' => Gateway::MERCHANT,
            ],
            [
                'id' => 'c054672b-f1a7-42c4-a2ea-ddf376949c00',
                'from_gateway_id' => Gateway::KORTI_MILLI,
                'to_gateway_id' => Gateway::PS_ESKHATA,
            ],
            [
                'id' => '1d65290c-66cc-4075-bf18-1ff688d80224',
                'from_gateway_id' => Gateway::KORTI_MILLI,
                'to_gateway_id' => Gateway::SONIYA,
            ],
            [
                'id' => '6a43ed5a-d641-4473-9cd7-9878959b0180',
                'from_gateway_id' => Gateway::KORTI_MILLI,
                'to_gateway_id' => Gateway::BPC_VISA,
            ],
            [
                'id' => '3e5a6dc8-9eab-411a-ac08-4fd089fa5858',
                'from_gateway_id' => Gateway::KORTI_MILLI,
                'to_gateway_id' => Gateway::BPC_MTM,
            ],
            [
                'id' => 'bc9c7856-1ca6-4334-ad43-bf8cac9166bf',
                'from_gateway_id' => Gateway::EWALLET,
                'to_gateway_id' => Gateway::KORTI_MILLI,
            ],
            [
                'id' => 'd95d0f71-19f6-431b-8a19-866ed807ed41',
                'from_gateway_id' => Gateway::EWALLET_BONUS,
                'to_gateway_id' => Gateway::KORTI_MILLI,
            ],
            [
                'id' => 'dbf4cf88-c091-40ec-99dd-a17fe6a0fba0',
                'from_gateway_id' => Gateway::BPC_VISA,
                'to_gateway_id' => Gateway::KORTI_MILLI,
            ],
            [
                'id' => '80c53a1a-164c-440d-833b-0061dfe80376',
                'from_gateway_id' => Gateway::BPC_MTM,
                'to_gateway_id' => Gateway::KORTI_MILLI,
            ],

        ];

        foreach ($vars as $var) {
            try {
                // WRONG TransactionSyncRule::create(['id' => $var['id']], $var);
                TransactionSyncRule::create($var);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }
}
