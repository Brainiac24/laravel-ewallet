<?php

namespace App\Services\Backend\Api\Transaction;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\JobLog\JobLog;
use App\Services\Common\Helpers\Gateway;
use GuzzleHttp\Exception\ConnectException;
use App\Services\Common\Helpers\Logger\Logger;
use App\Exceptions\Frontend\Api\LogicException;
use App\Services\Common\Helpers\TransactionStatus;
use App\Repositories\Backend\Transaction\TransactionRepositoryContract;
use App\Services\Backend\Api\Transaction\TransactionServiceContract;

class TransactionService implements TransactionServiceContract
{

    public function extractAccountNumberValue($transaction, $isFromAccount = true)
    {

        if ($isFromAccount) {
            $accountFromOrTo = $transaction->from_account_without_g_scopes;
        } else {
            $accountFromOrTo = $transaction->to_account_without_g_scopes;
        }

        $fromOrToValue = "";
        if ($accountFromOrTo != null) {
            if ($accountFromOrTo->account_type->gateway_id == Gateway::RUCARD || $accountFromOrTo->account_type->gateway_id == Gateway::BPC_MTM || $accountFromOrTo->account_type->gateway_id == Gateway::BPC_VISA || $accountFromOrTo->account_type->gateway_id == Gateway::ABS) {
                $fromOrToValue = $accountFromOrTo->number;
            } elseif ($accountFromOrTo->account_type->gateway_id == Gateway::EWALLET || $accountFromOrTo->account_type->gateway_id == Gateway::EWALLET_BONUS) {
                $fromOrToValue = $accountFromOrTo->user->msisdn;
            } elseif ($accountFromOrTo->account_type->gateway_id == Gateway::TKB || $accountFromOrTo->account_type->gateway_id == Gateway::MERCHANT) {
                $contCurCode = $accountFromOrTo->currency->code;
                $fromOrToValue = $accountFromOrTo->account_type->gateway->debet_json[$contCurCode];
            } elseif ($accountFromOrTo->account_type->gateway_id == Gateway::DEFAULT) {
                $fromOrToValue = $accountFromOrTo->params_json['acc_code'];
            }
        }

        return $fromOrToValue;
    }

    public function extractAccountNumberValueWithServiceConditions($transaction)
    {

        $toAccountValue = "";

        if ($transaction->service->gateway_id == Gateway::PS_ESKHATA) {
            $toAccountValue = $transaction->service->code_map;
        } elseif ($transaction->service->gateway_id == Gateway::SONIYA) {
            $toAccountValue = $transaction->service->gateway->debet_json[$transaction->service->currency->code];
        } elseif (
            $transaction->service->gateway_id == Gateway::RUCARD ||
            $transaction->service->gateway_id == Gateway::BPC_MTM ||
            $transaction->service->gateway_id == Gateway::BPC_VISA ||
            $transaction->service->gateway_id == Gateway::ABS ||
            $transaction->service->gateway_id == Gateway::EWALLET ||
            $transaction->service->gateway_id == Gateway::TRANSFER_FROM_RU
        ) {
            $toAccountValue = $this->extrackToAccountValue($transaction);
        } elseif ($transaction->service->gateway_id == Gateway::MERCHANT) {
            $contCurCode = $transaction->to_account_without_g_scopes->currency->code;
            $toAccountValue = $transaction->to_account_without_g_scopes->account_type->gateway->debet_json[$contCurCode];
        } elseif ($transaction->service->gateway_id == Gateway::DEPENDS_TO_ACCOUNT) {
            $toAccountValue = $this->extractAccountNumberValue($transaction, false);
        }

        return $toAccountValue;
    }

    public function extrackToAccountValue($transaction)
    {
        $toAccount = "";
        foreach ($transaction->params_json as $item) {
            if ($item['key'] == 'to_account') {
                $toAccount = $item['value'];
                break;
            }
        }
        return $toAccount;
    }


}