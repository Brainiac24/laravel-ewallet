<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 16:55
 */

namespace App\Services\Common\Helpers;


class Category
{
    const MENU = '2be59d70-a07d-11e8-904b-b06ebfbfa715';
    const WEB = '935e09bb-7f3d-43b6-b1ef-8056f822f869';
//    const WEB_VERSION_2= 'f95e7f2b-b25e-4ec5-9b23-7b6af3230b75';

    const MOBILE = '9f92e40b-fb69-48d1-af18-8e51b9238cce';
    const MOBILE_VERSION_1 = '05a10403-b266-4420-93c9-aef3a25ce547';
    const MOBILE_VERSION_2 = 'dfe0dcf4-4628-412e-83c9-466aba9b62a8';

    //MOBILE VERSION_1
    const PAYMENT_MENU = 'c7ed81b8-b1b7-11e8-904b-b06ebfbfa715';
    const SEND_MENU = 'ced619fe-b1b7-11e8-904b-b06ebfbfa715';
    const INCOME_MENU = 'd1960b22-b1b7-11e8-904b-b06ebfbfa715';
    const CASHOUT_MENU = 'd40e3278-b1b7-11e8-904b-b06ebfbfa715';
    const QR_MENU = 'd694a6bd-b1b7-11e8-904b-b06ebfbfa715';
    const MAP_MENU = '1bf152e0-b1c4-11e8-904b-b06ebfbfa715';
    //ОПЛАТИТЬ
    const MOBILE_CONNECTION = '32c5b017-a07d-11e8-904b-b06ebfbfa715';
    const INTERNET = '355e3ac5-a07d-11e8-904b-b06ebfbfa715';
    const NGN = '3839a4c2-a07d-11e8-904b-b06ebfbfa715';
    const ABROAD_MOBILE = '3ad2aa43-a07d-11e8-904b-b06ebfbfa715';
    const ONLINE = '3d7946c4-a07d-11e8-904b-b06ebfbfa715';
    const SMI = '407fb978-a07d-11e8-904b-b06ebfbfa715';
    const EWALLET = '42ebbaf5-a07d-11e8-904b-b06ebfbfa715';
    const FOND = '452dd4b6-a07d-11e8-904b-b06ebfbfa715';
    const BANK = '475a51c0-a07d-11e8-904b-b06ebfbfa715';
    const BANK_IDENTIFIED = '20e3f84a-b815-11e8-91d1-b06ebfbfa715';
    const CARDS = '4a09f400-a07d-11e8-904b-b06ebfbfa715';
    const ACCOUNTS = '6c35c20b-ea59-11e8-91d8-b06ebfbfa715';

    //MOBILE VERSION_2
    const PAYMENT_AND_TRANSFER_MENU_V2 = '0136ec6d-7678-46fa-9bb0-d29730ecfb8c';
    const CURRENCY_RATE_MENU_V2 = '4184196f-425f-493d-99d2-39df2c6fbc7d';
    const QR_MENU_V2 = '1b2bdf71-27be-41cb-9d35-4658500c5a39';
    const MAP_MENU_V2 = '470b3b11-056e-4e95-a8ff-cc093f7dce2b';
    const DEPOSIT_MENU_V2 = 'f492089f-b0d0-4b52-99d5-65c068717cb4';
    const CREDIT_MENU_V2 = '5b1fbe5f-00c0-4b4c-8ecf-692455722e82';
    const INVOICE_MENU_V2 = '65aad43b-b937-4dc8-bda1-0e4db64b68c4';
    const TRANSFER_MENU_V2 = '0c6683e6-86c1-4694-b0e7-e7b0281a107a';
    const PAYMENT_MENU_V2 = 'efbe3145-13a1-4009-ab4c-72fc887c982b';
    const CARD_AND_ACCOUNT_V2 = '8700d983-11c2-11ea-8f22-309c2326bc93';

    //ПЕРЕВЕСТИ
    const BETWEEN_ACCOUNTS_V2 = '9d3197fd-4753-4ad4-845b-96de48822b40';
    const TO_CARDS_V2 = 'b39d735e-874a-4bf2-bb3a-0ca397bd3ccf';
    const TO_ACCOUNTS_V2 = 'a748dced-fb7c-44c9-ae78-649d971733d7';
    const TO_ACCOUNT_ESKHATA_ONLINE_V2 = '10e0f34e-1f3f-41cd-bbea-4c29426e30c1';
    const CONVERSION_CURRENCY_V2 = '2038f2d9-b848-4532-bd28-9a3e28b9cfbc';
    const TO_ACCOUNTS_ESKHATA_V2 = '361fd2e6-be18-4ff7-9bd0-260b311eab7a';
    const TO_ACCOUNTS_OTHER_V2 = '4c64171c-c37d-4f8f-9d4e-b1b796bbfbff';

    //ОПЛАТИТЬ
    const MOBILE_CONNECTION_V2 = '70af7126-df99-4779-8421-2977145ede37';
    const INTERNET_IP_V2 = 'c4cdc797-6121-4873-8c3a-4cdbfc650326';
    const COMMUNAL_V2 = 'adbef962-ce5b-4e52-a182-468e6918c3a0';
    const NGN_V2 = '55f05bf1-30ea-4635-a03b-3677732ed655';
    const ABROAD_MOBILE_V2 = '2292b4d9-67df-4e63-b85f-ca2a53ebe1c6';
    const ONLINE_GAME_V2 = '75cb3ec6-c70c-40cf-8df4-bd22af340113';
    const SMI_V2 = 'e09ca53f-5126-4d11-8030-59a362f47b9e';
    const EWALLET_V2 = '6d01da92-4d16-4e3e-b4d7-451c5d9d9bd6';
    const FOND_V2 = '18581a0b-0bea-4bb7-9578-e13170a9508a';
    const BANK_V2 = '24393035-0375-487a-99a5-b6eebaaab88d';

    //WEB VERSION_1
    const WEB_MAIN_MENU = '1f7e225b-8c31-11e9-9c0b-b06ebfbfa715';
    const WEB_TRANSFER_MENU = 'ac204650-8c31-11e9-9c0b-b06ebfbfa715';
    const WEB_PAYMENT_MENU = 'ae44b5fc-8c31-11e9-9c0b-b06ebfbfa715';
    const WEB_MAIN_MENU_CURRENCY_RATE = '90fb025d-8c31-11e9-9c0b-b06ebfbfa715';
    const WEB_MAIN_MENU_TEMPLATE = '933ec955-8c31-11e9-9c0b-b06ebfbfa715';
    const WEB_MAIN_MENU_ON_MAP = '9cfbcc59-8c31-11e9-9c0b-b06ebfbfa715';
    //const DEPOSIT_MENU_WEB='9f77ed61-8c31-11e9-9c0b-b06ebfbfa715';
    //const CREDIT_MENU_WEB='a3c6a939-8c31-11e9-9c0b-b06ebfbfa715';
    //const INVOICE_MENU_WEB='a730d9ce-8c31-11e9-9c0b-b06ebfbfa715';

    //ПЕРЕВЕСТИ
    const BETWEEN_ACCOUNTS_WEB = 'b0c20f20-8c31-11e9-9c0b-b06ebfbfa715';
    const TO_CARDS_WEB = 'b3b3b026-8c31-11e9-9c0b-b06ebfbfa715';
    const TO_ACCOUNTS_WEB = 'b624a461-8c31-11e9-9c0b-b06ebfbfa715';
    const TO_ACCOUNT_ESKHATA_ONLINE_WEB = 'b93f0880-8c31-11e9-9c0b-b06ebfbfa715';
    const CONVERSION_CURRENCY_WEB = 'bb4ae72c-8c31-11e9-9c0b-b06ebfbfa715';
    const TO_ACCOUNTS_ESKHATA_WEB = 'bda452e8-8c31-11e9-9c0b-b06ebfbfa715';
    const TO_ACCOUNTS_OTHER_WEB = 'bfb4682b-8c31-11e9-9c0b-b06ebfbfa715';
    //ОПЛАТИТЬ
    const MOBILE_CONNECTION_WEB = 'c2234de7-8c31-11e9-9c0b-b06ebfbfa715';
    const INTERNET_IP_WEB = 'c431ee24-8c31-11e9-9c0b-b06ebfbfa715';
    const COMMUNAL_WEB = 'c685b093-8c31-11e9-9c0b-b06ebfbfa715';
    const NGN_WEB = 'c8a8db7e-8c31-11e9-9c0b-b06ebfbfa715';
    const ABROAD_MOBILE_WEB = 'cb3df447-8c31-11e9-9c0b-b06ebfbfa715';
    const ONLINE_GAME_WEB = 'cd98048b-8c31-11e9-9c0b-b06ebfbfa715';
    const SMI_WEB = 'cfea0b94-8c31-11e9-9c0b-b06ebfbfa715';
    const EWALLET_WEB = 'd3bf541b-8c31-11e9-9c0b-b06ebfbfa715';
    const FOND_WEB = 'd7254eb8-8c31-11e9-9c0b-b06ebfbfa715';
    const BANK_WEB = 'da1533e9-8c31-11e9-9c0b-b06ebfbfa715';
    const SAFE_CITY = 'd4a194d1-9659-4c1c-9d70-4ff2f314543c';
}