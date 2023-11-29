<?php

namespace App\Listeners\Frontend\Account\AccountHistory;

use App\Events\Frontend\Account\AccountHistory\AccountModifiedEvent;
use App\Exceptions\Frontend\Api\LogicException;
use App\Models\Account\AccountHistory\AccountHistory;
use App\Services\Common\Helpers\TransactionStatus;
use App\Services\Common\Helpers\TransactionType;
use Illuminate\Support\Facades\Auth;

class AccountModifiedListener
{

    public function __construct()
    {
        //
    }

    public function handle(AccountModifiedEvent $event)
    {
        $user_id = config('app_settings.system_user_id');
        if (Auth::check()) {
            $user = Auth::user();
            $user_id = $user->id;
        }
        $accountHistory = new AccountHistory();
        $accountHistory->account_id = $event->account->id;
        $accountHistory->number = $event->account->number;
        $accountHistory->balance = $event->account->balance;
        $accountHistory->blocked_balance = $event->account->blocked_balance;
        $accountHistory->account_type_id = $event->account->account_type_id;
        $accountHistory->created_by_user_id = $user_id;
        $accountHistory->currency_id = $event->account->currency_id;
        if (!empty($event->transaction)) {

            $mathOperator = 1;

            if ($event->transaction->transaction_type_id == TransactionType::PAYMENT) {
                if ($event->transaction->transaction_status_id == TransactionStatus::REJECTED || $event->transaction->transaction_status_id == TransactionStatus::RETURNED) {
                    if ($event->account->id == $event->transaction->to_account_id) {
                        $mathOperator = -1;
                    } else {
                        $mathOperator = 1;
                    }
                } else {
                    if ($event->account->id == $event->transaction->to_account_id) {
                        $mathOperator = 1;
                    } else {
                        $mathOperator = -1;
                    }
                }
            } elseif ($event->transaction->transaction_type_id == TransactionType::FILL) {
                if ($event->transaction->transaction_status_id == TransactionStatus::REJECTED || $event->transaction->transaction_status_id == TransactionStatus::RETURNED) {
                    if ($event->account->id == $event->transaction->to_account_id) {
                        $mathOperator = -1;
                    } else {
                        throw (new LogicException(trans('accounts.errors.unreachable_logic_case')));
                    }
                } else {
                    if ($event->account->id == $event->transaction->to_account_id) {
                        $mathOperator = 1;
                    } else {
                        throw (new LogicException(trans('accounts.errors.unreachable_logic_case')));
                    }
                }
            }

            $accountHistory->amount = $mathOperator * $event->transaction->amount;
            $accountHistory->commission = $mathOperator * $event->transaction->commission;
            if ($event->account->id == $event->transaction->to_account_id) {
                if ($event->transaction->transaction_type_id == TransactionType::PAYMENT) {
                    $accountHistory->transaction_type_id = TransactionType::FILL;
                } elseif ($event->transaction->transaction_type_id == TransactionType::FILL) {
                    $accountHistory->transaction_type_id = $event->transaction->transaction_type_id;
                }
            } else {
                $accountHistory->transaction_type_id = $event->transaction->transaction_type_id;
            }
            $accountHistory->transaction_status_id = $event->transaction->transaction_status_id;
            $accountHistory->transaction_id = $event->transaction->id;
            $accountHistory->currency_rate_value = $event->transaction->currency_rate_value;
        }

        $accountHistory->save();
    }
}
