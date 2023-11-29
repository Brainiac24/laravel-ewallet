<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 16:55
 */

namespace App\Services\Common\Helpers;


class Service
{
    const MOBILE_TCELL_TJ = '14f8e166-9fb5-11e8-904b-b06ebfbfa715';
    const MOBILE_MEGAFON_TJ = '2bec08d9-9fb5-11e8-904b-b06ebfbfa715';
    const MOBILE_BABILON_TJ = '0a3ecdcf-9fbb-11e8-904b-b06ebfbfa715';
    const MOBILE_BEELINE_TJ = 'fcbcd876-9fbb-11e8-904b-b06ebfbfa715';

    const COMMUNAL_BARKI_TOJIK_DUSHANBE = '4fac4515-1d85-48a5-9ac8-584a44a0286f';
    const COMMUNAL_BARKI_TOJIK_TURSUNZODA = 'db66ee26-dbaa-484c-bb76-8ab333c4e022';
    const COMMUNAL_BARKI_TOJIK_VAHDAT = '5534aebd-3b82-4420-8bb8-fd7998315dd5';
    const COMMUNAL_BARKI_TOJIK_NORAK = '731efbe9-4e8d-496b-8c0f-4a400dfab4ea';
    const COMMUNAL_BARKI_TOJIK_BOKHTAR = 'fdbc4145-45b4-4e39-92a9-dad3c9b2b3ce';
    const COMMUNAL_BARKI_TOJIK_ISFARA = 'eb081bf1-a5dd-4416-9394-c280fd19bbb2';
    const COMMUNAL_BARKI_TOJIK_BUSTON = '72d61c27-361c-49d7-adc3-2c528d3db3cd';
    const COMMUNAL_BARKI_TOJIK_HISOR = 'bff33a7e-c16c-4638-abec-35b7834b165c';
    const COMMUNAL_BARKI_TOJIK_KHUJAND = 'fe21275d-ed3b-4af9-b4b0-d7ce36e0367d';
    const COMMUNAL_BARKI_TOJIK_SOGDES = 'af79bd9b-6840-4ba1-8007-a87e44ad7801';
    const COMMUNAL_BARKI_TOJIK_ISTES = '92509116-8d3b-470d-b61a-d156e39d94b0';
    const COMMUNAL_BARKI_TOJIK_SARBAND = '21b64cbb-cd34-4532-b9c1-2d92307c503d';
    const COMMUNAL_BARKI_TOJIK_CHAYKHUN = '3ca7f16f-7e0c-4ee9-852c-d01b853fb2c9';
    const COMMUNAL_BARKI_TOJIK_VAKHSH = 'e2b5010d-3b0f-4487-adf0-61fe85185f44';
    const COMMUNAL_BARKI_TOJIK_DUSTI = '411f0276-a68c-4f25-85ae-832dd499e249';
    const COMMUNAL_BARKI_TOJIK_KUSHONIYON = '2dd5f017-6d5b-4ef9-91e1-b1829543e98c';
    const COMMUNAL_BARKI_TOJIK_ABDURAHMONI_JOMI = '1af39d78-f313-4848-8d60-c8a2ff333665';
    const COMMUNAL_BARKI_TOJIK_KUBODIYON = '259aa310-eda6-4dc0-bb6e-8aee065c5e5f';
    const COMMUNAL_BARKI_TOJIK_JALOLIDIN_BALKHI = '537e8fd2-c783-4137-8eea-37631b3623c0';
    const COMMUNAL_BARKI_TOJIK_PAHJ = '11589ee6-c796-4a16-bcd9-d25c7c084080';
    const COMMUNAL_BARKI_TOJIK_NOSIRI_KHISRAV = '01d243ef-8f13-4871-bfc7-e3c150097033';
    const COMMUNAL_BARKI_TOJIK_SHAHRITUS = '1263b2f8-3e37-46bc-a393-6ed1f46d6c19';
    const COMMUNAL_BARKI_TOJIK_KHURUSON = '8953d8c2-8b57-4082-ba58-aa350b3cf07d';
    const COMMUNAL_BARKI_TOJIK_FAYZOBOD = '8b58209f-f017-416e-bf49-4dd0547d6b2a';
    const COMMUNAL_BARKI_TOJIK_SHAHRINAV = 'e5c5c711-cba2-4ef9-b8f4-55fdd1fe7664';
    const COMMUNAL_BARKI_TOJIK_ROGUN = 'a00a3e10-e6de-4d9d-9bed-e6f335623604';
    const COMMUNAL_BARKI_TOJIK_VARZOB = '74d5a953-ebfe-40db-86e9-4f9797e651da';
    const COMMUNAL_BARKI_TOJIK_KULOB = 'e11620db-a418-4e63-bbb5-e23eabd0f2f3';
    const COMMUNAL_BARKI_TOJIK_RUDAKI = '01ab204b-1893-4983-bbca-06311f5bd2d5';
    const COMMUNAL_BARKI_TOJIK_RUDAKI_2 = 'ca4ea9de-da43-4b5b-83a1-257f87a4463c';
    const COMMUNAL_BARKI_TOJIK_TOJIKOBOD = '9a780b68-8456-4ea5-b559-1f6417e409c5';

    const COMMUNAL_VODOKANAL_DUSHANBE = '0e18dca0-e7e6-499d-b373-f93ac1686a75';
    const COMMUNAL_VODOKANAL_KHUJAND = '051b1c17-2067-45ca-b46e-2718f7ce5834';
    const COMMUNAL_PAMIR_ENERGY = '014097f4-5541-4cc9-9c03-d2424bbe6f4a';

    const INTERNET_TOJNET = '6fa752c7-a052-11e8-904b-b06ebfbfa715';
    const INTERNET_BABILON_T = '8e2a4fbf-9fbf-11e8-904b-b06ebfbfa715';
    const INTERNET_ISATEL = '53dd2baa-9fc0-11e8-904b-b06ebfbfa715';
    const INTERNET_TELECOM = 'b9dd97c1-9fc0-11e8-904b-b06ebfbfa715';

    const NGN_TELECOM = '88435ab5-9fc2-11e8-904b-b06ebfbfa715';
    const NGN_INTERCOM = '9c167c7a-9fc2-11e8-904b-b06ebfbfa715';
    const NGN_BABILON_T = 'c25f6661-9fc2-11e8-904b-b06ebfbfa715';
    const NGN_EASTERA = '21d02d48-9fc3-11e8-904b-b06ebfbfa715';
    const NGN_TAJIK_TELECOM = '2892c540-9fc3-11e8-904b-b06ebfbfa715';
    const NGN_SVYAZ_COMPLECT = '2c460259-9fc4-11e8-904b-b06ebfbfa715';

    const ABROAD_MOBILE_BEELINE_RU = '369990d7-9fc4-11e8-904b-b06ebfbfa715';
    const ABROAD_MOBILE_BEELINE_KZ = 'f9ce3025-9fc4-11e8-904b-b06ebfbfa715';
    const ABROAD_MOBILE_BEELINE_KG = '4aa4ac54-9fc5-11e8-904b-b06ebfbfa715';
    const ABROAD_MOBILE_BEELINE_UZ = '6251271e-9fc5-11e8-904b-b06ebfbfa715';
    const ABROAD_MOBILE_MTS_RU = '6fb6b859-9fc6-11e8-904b-b06ebfbfa715';
    const ABROAD_MOBILE_MEGAFON_RU = '758d6b8c-9fc6-11e8-904b-b06ebfbfa715';
    const ABROAD_MOBILE_MEGACOM_KG = '8539bfd7-9fc6-11e8-904b-b06ebfbfa715';
    const ABROAD_MOBILE_O_NURTELECOM_KG = 'afc4bac4-9fc6-11e8-904b-b06ebfbfa715';

    const ONLINE_ODNOKLASSNIKI = 'c53110be-a04b-11e8-904b-b06ebfbfa715';
    const ONLINE_SKYPE = '617f060e-a9e8-11e8-904b-b06ebfbfa715';
    const ONLINE_FORMULA = 'adf6a714-a04f-11e8-904b-b06ebfbfa715';
    const ONLINE_IRSOL = 'ccbe2c1b-a04f-11e8-904b-b06ebfbfa715';
    const ONLINE_OSON_SMS = '34d43e7b-a050-11e8-904b-b06ebfbfa715';
    const ONLINE_TAHSIL_INFO = '92ba5436-a051-11e8-904b-b06ebfbfa715';
    const ONLINE_FABERLIC = 'c993d997-a051-11e8-904b-b06ebfbfa715';
    const ONLINE_TAXI_ROH = 'd2ecbc05-a051-11e8-904b-b06ebfbfa715';
    const ONLINE_GET_TJ = '5b5ac735-a052-11e8-904b-b06ebfbfa715';
    const ONLINE_1XBET = '67f9c49a-1904-488f-adcc-bc5d540bfe46';
    const ONLINE_MAXIM = '4ac54ae3-1368-4832-ae4b-a452940507c6';

    const SMI_ANT = '267771f6-a053-11e8-904b-b06ebfbfa715';
    const SMI_NTV = '881c1e56-a053-11e8-904b-b06ebfbfa715';
    const SMI_TIROZ = '53842245-a053-11e8-904b-b06ebfbfa715';

    const EWALLET_OSONPAY = '8b28942c-a055-11e8-904b-b06ebfbfa715';
    const EWALLET_SOMON_TJ = 'c7a27033-a055-11e8-904b-b06ebfbfa715';
    const EWALLET_IMKON = 'e4c9b712-a056-11e8-904b-b06ebfbfa715';
    const EWALLET_YANDEX = 'eb4e55ed-a056-11e8-904b-b06ebfbfa715';
    const EWALLET_ESKHATA = '96e8b785-b1b9-11e8-904b-b06ebfbfa715';
    //const EWALLET_QPAY = '55475cb1-116f-4365-b783-f3f753059cdc';

    const FOND_ORMON = '08d6caa7-a057-11e8-904b-b06ebfbfa715';
    const FOND_HILOLI_AHMAR = '6d2d2da7-a9e8-11e8-904b-b06ebfbfa715';
    const BANK_CREDIT = 'c80a488e-a062-11e8-904b-b06ebfbfa715';
    const BANK_OVERDRAFT = '1941928b-a064-11e8-904b-b06ebfbfa715';
    const BANK_TO_ACCOUNT = '009bf6ef-a6c0-11e9-a12f-b06ebfbfa715';
    const BANK_TO_ACCOUNT_YUR = '903915c7-af64-11e9-9dc7-b06ebfbfb012';
    const BANK_POPOLNENIE_YUR = '3c1f8192-a064-11e8-904b-b06ebfbfa715';
    const BANK_POPOLNENIE_YUR_OTHER = '9ee62ed4-61c3-11e9-9404-b06ebfbfa715';
    const BANK_POPOLNENIE = '8483bd16-a064-11e8-904b-b06ebfbfa715';
    const BANK_POPOLNENIE_OTHER = 'a36baae6-61c3-11e9-9404-b06ebfbfa715';
    const BANK_MDO_FINCA = 'f704fb63-a064-11e8-904b-b06ebfbfa715';
    const BANK_ALIF = '33519e5a-a068-11e8-904b-b06ebfbfa715';
    const BANK_KAFOLAT = 'd7d3d37c-a070-11e8-904b-b06ebfbfa715';
    const BANK_YASNO = '2277f8b2-a071-11e8-904b-b06ebfbfa715';
    const BANK_BAROR = '280af7f2-a071-11e8-904b-b06ebfbfa715';
    const BANK_ARVAND = '84c668eb-a071-11e8-904b-b06ebfbfa715';

    const CARDS_LOCAL_ESKHATA = '19f73774-a072-11e8-904b-b06ebfbfa715';
    const CARDS_AMONAT = '778cdbec-a9e8-11e8-904b-b06ebfbfa715';
    const CARDS_IMON = 'ca995c07-a072-11e8-904b-b06ebfbfa715';
    const CARDS_MATIN = '195f6321-a073-11e8-904b-b06ebfbfa715';
    const CARDS_SPITAMEN = '736ba12c-a073-11e8-904b-b06ebfbfa715';
    const CARDS_AVVALIN = 'a0d56b55-a073-11e8-904b-b06ebfbfa715';
    const CARDS_TOJIKSODIROT = '25f35503-a074-11e8-904b-b06ebfbfa715';
    const CARDS_FONON = '2c675f14-a074-11e8-904b-b06ebfbfa715';
    const CARDS_KAFOLAT = '35493faa-a074-11e8-904b-b06ebfbfa715';
    const CARDS_ALIF = '5f7691f9-a074-11e8-904b-b06ebfbfa715';
    const CARDS_FARDO = '7fcf320b-a074-11e8-904b-b06ebfbfa715';
    const CARDS_MILLI = '38be75bb-d8f3-405d-aa00-2ded1b832179';
    const CARDS_OSON = 'd6a8eb34-e972-419e-aedb-b3aa54eb1fc3';

    const FILL_EWALLET_ESKHATA = 'a19911d4-bd91-11e8-9676-b06ebfbfa715';
    const FILL_SBERBANK = '77fb7872-109d-4424-b442-bc3e28328b57';

    // V2
    const TRANSFER_BETWEEN_ACCOUNTS_V2 = 'b1b1a032-d18f-460d-9203-910cf1d62cc8';
    const TRANSFER_CARD_V2 = 'b5b3e27c-3a52-4f31-91a2-9a5f180d691b';
    const RECEIVE_TRANSFER_V2 = 'a1792a9c-61db-11e9-9404-b06ebfbfa715';
    const CURRENCY_EXCHANGE_V2 = '392f31a5-61de-11e9-9404-b06ebfbfa715';
    const TRANSFER_SONIYA_V2 = 'fa933465-70a1-11e9-a396-b06ebfbfa715';
    const TRANSFER_TO_CREDIT = '1ce5ec63-be8f-11e9-a12f-b06ebfbfa715';
    const TRANSFER_TO_DEPOSIT = '69c66328-be8f-11e9-a12f-b06ebfbfa715';

    const MERCHANT = 'f514d57e-9ee8-47ac-9c2d-a901d7ea0d91';
    const ORDER_CARD = '7e693482-11bd-11ea-8f22-309c2326bc93';
    const FILL_INSURANCE_DEPOSIT_ACCOUNT = '4d483da7-ddec-473d-ab44-c2a78b913ab7';
    const PAY_CARD_COST = 'ea693397-91e1-4921-ae4c-9309cdd855f5';

    const ORDER_CREDIT = '2f60621e-e4e3-45d3-a99c-dabeabd88aff';


//    const MOBILE_MEGAFON_TJ_V2 = '3ec8fbb9-90a2-45da-8c45-f684dc6d0db1';
//    const MOBILE_BABILON_TJ_V2 = '0a036b2b-9411-4d6b-9160-617065b49486';
//    const MOBILE_BEELINE_TJ_V2 = 'd647a249-67f8-431d-9cda-df33e6e1942f';

//    VIRTUALS

    const CASHBACK_FROM_MERCHANT = 'a3cbd891-5775-4ab3-8fb6-bb50ad7a5054';
    const CASHBACK_FROM_BANK = 'b6bf9c65-7827-4dae-8628-0132292f25d9';
    const BONUS_ACCRUAL = '18f3057a-e4e9-4a3a-9f22-d67fdc5dd30c';
    const BANK_COMMISSION = 'e9614331-ed9b-4819-a997-86c8a36800e5';
    const TRANSFER_FROM_TRANSIT_MERCHANT_TO_ACCOUNT_MERCHANT = 'be7cdeca-beba-4d43-932e-a03aecdd9bc7';
    const WITHDRAWAL_FUNDS_TO_LEGAL_ENTITY = '7669b943-5dba-4dc8-b88c-dbaf98571e54';
    const TRANSFER_FROM_RUSSIAN_CARD = 'b2269a0c-923b-42ca-a1f2-5dd26904fc16';
    
    
    const IDENTIFICATION_FORM = '494b76c6-364b-48f9-ad2f-35b0dcb7ce7d';
    const SAFE_CITY_30 = 'b6176e42-4c0c-4f57-a55d-976eb8ad27a1';
    const SAFE_CITY_60 = '7dadab6b-c29d-4331-870f-2f6acf8fffeb';
    const SAFE_CITY_100 = '03a7f17d-ab87-4b34-acb0-55144348e6ca';
    const SAFE_CITY_180 = 'ff23d889-4645-4d69-b57b-08efe178f2f8';

    const ORDER_DEPOSIT_TIMED_NEW = '1d676b38-3d0c-4908-ae23-d40c7d307ce1';
    const ORDER_DEPOSIT_OZOD = '0663244e-89cc-4f1c-9310-f1cfb360dd88';
    const ORDER_DEPOSIT_CLOSE = 'a34c5daa-098a-42d1-af9b-8c7142e9ce4b';
    const ORDER_ACCOUNT_SBER = '9aa68117-7a38-488d-a8c9-575bebd34133';

}