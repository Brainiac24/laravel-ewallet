<?php

namespace App\Services\Backend\Api\Transaction;


interface TransactionServiceContract
{

    public function extractAccountNumberValue($transaction, $isFromAccount = true);

    public function extractAccountNumberValueWithServiceConditions($transaction);

    public function extrackToAccountValue($transaction);

}