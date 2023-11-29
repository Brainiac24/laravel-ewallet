<?php

namespace App\Services\Common\Gateway\Queue;

class QueueHandlerEnum
{
    const PROCESSING = 'processing';
    const PROCESSING_GET_INFO = 'processing_get_info';
    const SMS_NOTIFICATION = 'sms_notification';
    const EMAIL_NOTIFICATION = 'email_notification';
    const PUSH_NOTIFICATION = 'push_notification';
    const ABS_CURRENCY_RATE = 'abs_currency_rate';
    const ABS_CARDS_SEARCH = 'abs_cards_search';
    const ABS_CARDS_LIST = 'abs_cards_list';
    const ABS_CARDS_ITEM_TRANSACTIONS = 'abs_cards_item_transactions';

    const BLOCK_AMOUNT = 'block';
    const FILL = 'fill';
    const ACCOUNT_TO_ACCOUNT = 'account_to_account';
    const ACCOUNT_TO_ACCOUNT_SYNC = 'account_to_account_sync';
    const ACCOUNT_TO_ACCOUNT_SYNC_V2 = 'account_to_account_sync_v2';
    const CONFIRM = 'confirm';
    const CANCEL = 'cancel';
    const BALANCE = 'balance';
    const ACCOUNTS_LIST = 'accounts_list';
    const ACCOUNTS_ITEM_TRANSACTIONS = 'accounts_item_transactions';
    const DEPOSITS_LIST = 'deposits_list';
    const DEPOSITS_ITEM_TRANSACTIONS = 'deposits_item_transactions';
    const ACCOUNTS_ITEM_TRANSACTIONS_ITEM_LIQUIDATE = 'accounts_item_transactions_item_liquidate';

    const CARD_LOCK_UNLOCK = 'card_lock_unlock';
    const CARD_TRANSACTIONS_LIST = 'card_transactions_list';
    const CARD_TRANSACTION_REFUND = 'card_transaction_refund';
    const TRANSFERS_LID = 'transfers_lid';
    const TRANSFERS_SONIYA = 'transfers_soniya';
}