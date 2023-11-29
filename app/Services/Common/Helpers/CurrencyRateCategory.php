<?php

namespace App\Services\Common\Helpers;

class CurrencyRateCategory
{

    const DEFAULT = 'ee740875-e0e3-4233-9ef2-5536b5759969';
    const TRANSFER = '2b550a6a-979f-4480-bdbb-7403bed04cc3';

    const DEFAULT_CODE_MAP = 'esh';
    const TRANSFER_CODE_MAP = 'esh_transfer';

    const UUID = [
        self::DEFAULT_CODE_MAP => self::DEFAULT,
        self::TRANSFER_CODE_MAP => self::TRANSFER,
    ];
}