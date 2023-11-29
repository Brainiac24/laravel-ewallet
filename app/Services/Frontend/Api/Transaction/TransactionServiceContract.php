<?php

namespace App\Services\Frontend\Api\Transaction;

interface TransactionServiceContract
{
    const ERROR_SERVICE_NOT_FOUND = 'error_service_not_found';
    const ERROR_NOT_IDENTIFIED_SERVICE_ACCESS_DENIED = 'error_not_identified_service_access_denied';
    const ERROR_TO_ACCOUNT_PHONE_NOT_FOUND = 'error_to_account_phone_not_found';
    const ERROR_TO_ACCOUNT_GET_BY_PHONE_NOT_FOUND = 'error_to_account_get_by_phone_not_found';
    const ERROR_SERVICE_PARAMS_VALIDATION = 'error_service_params_validation';
    const ERROR_SERVICE_IS_NOT_ACTIVE = 'error_service_is_not_active';
    const ERROR_SERVICE_IS_NOT_ACTIVE_IN_THIS_WORKDAY = 'error_service_is_not_active_in_this_workday';
    const ERROR_SESSION_SMS_TIMEOUT = 'error_session_sms_timeout';
    const ERROR_FAILED_HASH_CODE_CONFIRM = 'error_failed_hash_code_confirm';
    const ERROR_TEMPORARY_BLOCKED_SMS = 'error_temporary_blocked_sms';
    const ERROR_APP_KEY_LENGTH_INCORRECT = 'error_app_key_length_incorrect';
    const ERROR_USER_BY_PHONE_NOT_FOUND = 'error_user_by_phone_not_found';
    const ERROR_TO_ACCOUNT_NOT_FOUND = 'error_to_account_not_found';
    const ERROR_FROM_ACCOUNT_NOT_FOUND = 'error_from_account_not_found';
    const ERROR_TO_USER_NOT_FOUND = 'error_to_user_not_found';
    const ERROR_TO_USER_IS_NOT_ACTIVE = 'error_to_user_is_not_active';
    const ERROR_IS_ALREADY_VERIFIED = 'error_is_already_verified';
    const ERROR_TRANSACTION_NOT_FOUND = 'error_transaction_not_found';
    const ERROR_STATUS_TRANSACTION_IS_ALLREADY_COMPLETED = 'error_status_transaction_is_allready_completed';
    const ERROR_STATUS_TRANSACTION_COMPLETED_CANNOT_BE_REJECTED = 'error_status_transaction_completed_cannot_be_rejected';
    const ERROR_STATUS_TRANSACTION_IS_NOT_COMPLETED = 'error_status_transaction_is_not_completed';
    const ERROR_TRANSACTION_IS_ALREADY_EXIST = 'error_transaction_is_already_exist';
    const ERROR_AMMOUNT_NOT_IN_SERVICE_MIN_MAX_VALUE = 'error_ammount_not_in_service_min_max_value';
    const ERROR_SELF_PAYMENT_NOT_ALLOWED = 'error_self_payment_not_allowed';
    const ERROR_NOT_VERIFIED_USER_NOT_ALLOWED = 'error_not_verified_user_not_allowed';
    const ERROR_IS_ALREADY_VERIFIED_WHERE_RETRY_SMS = 'error_is_already_verified_where_retry_sms';
    const WARNING_ON_CHANGE_STATUS_CHAIN = 'warning_on_change_status_chain';
    const ERROR_TRANSACTION_STATUS_NOT_FOUND = 'error_transaction_status_not_found';
    const ERROR_SERVICE_PARAMS_EMPTY = 'error_service_params_empty';

    const ERROR_BALANCE_NOT_ENOUGH = 'error_balance_not_enough';
    const ERROR_BALANCE_LIMIT_IS_REACHED = 'error_balance_limit_is_reached';
    const ERROR_DAY_LIMIT_IS_REACHED = 'error_day_limit_is_reached';
    const ERROR_WEEK_LIMIT_IS_REACHED = 'error_week_limit_is_reached';
    const ERROR_MONTH_LIMIT_IS_REACHED = 'error_month_limit_is_reached';

    const ERROR_COMMISSION_DOES_NOT_MATCH = 'error_commission_does_not_match';

    

    public function create($request);

    public function fill($request);

    public function checkBalanceFromProcessing($service_id, $number);

    public function ConfirmSmsAndChangeStatus($request);
}
