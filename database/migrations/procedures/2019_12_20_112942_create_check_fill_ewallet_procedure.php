<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckFillEwalletProcedure extends Migration
{

    public function up()
    {
        $function = "
        CREATE FUNCTION `check_fill_ewallet`(phone_number BIGINT, amount DOUBLE) RETURNS VARCHAR(255) CHARSET utf8
        BEGIN
          SET @check_status = '';
          
          IF LENGTH(phone_number) != 12 THEN
            SET @check_status = 'ERROR_VALIDATION_PHONE_NUMBER_MUST_BE_12_DIGITS';
            RETURN @check_status;
          END IF;
          
          SET @proc_is_enabled = '';
          SELECT `value` INTO @proc_is_enabled FROM settings WHERE `key` = 'PROCEDURE_IS_ENABLED';
          
          IF @proc_is_enabled != 1 THEN
            SET @check_status = 'ERROR_PROCEDURE_IS_DISSABLED';
            RETURN @check_status;
          END IF;
         
          SET @user_id = '';
          SET @user_fio = '';
          SET @user_is_active = '';
          SET @attestation_id = '';
          SET @balance_limit = '';
          SET @balance = '';
          SET @blocked_balance = '';
          
          
          SELECT `id`, 
            CONCAT(`first_name`, ' ', `last_name`, ' ', `middle_name`), 
            `is_active`, 
            `attestation_id`  
          INTO @user_id, 
            @user_fio, 
            @user_is_active, 
            @attestation_id 
          FROM users WHERE msisdn = phone_number;
          
          
          IF @user_id = '' THEN
            SET @check_status = 'ERROR_USER_NOT_FOUND';
            RETURN @check_status;
          END IF;
          
          IF @user_is_active = 0 THEN
            SET @check_status = 'ERROR_USER_NOT_ACTIVE';
            RETURN @check_status;
          END IF;
          
          IF @attestation_id = '0ee95dcb-a078-11e8-904b-b06ebfbfa715' THEN
            SET @check_status = 'ERROR_USER_NOT_FOUND';#SET @check_status = 'ERROR_USER_NOT_IDENTIFIED';
            RETURN @check_status;
          END IF;
          
          SELECT CAST(TRIM(BOTH '\"' FROM JSON_EXTRACT(`params_json`, '$[0].balance.limit')) AS UNSIGNED) INTO @balance_limit FROM attestations WHERE id = @attestation_id;
          
          SELECT balance, blocked_balance INTO @balance, @blocked_balance FROM accounts WHERE user_id = @user_id AND account_type_id = '05864267-a077-11e8-904b-b06ebfbfa715';
          
          IF (@balance + @blocked_balance + amount) > @balance_limit THEN
            SET @check_status = 'ERROR_BALANCE_LIMIT';
            RETURN @check_status;
          END IF;
          
          SET @check_status = @user_fio;
          
          RETURN @check_status;
          
         END;
        ";

//        DB::unprepared("DROP USER IF EXISTS 'abs_checker'@'%'");
//        DB::unprepared("CREATE USER 'abs_checker'@'%' IDENTIFIED BY '5NcMu5ppVB';");
//        DB::unprepared("DROP FUNCTION IF EXISTS check_fill_ewallet");
//        DB::unprepared($function);
//        DB::unprepared("GRANT EXECUTE ON FUNCTION es_wallet.check_fill_ewallet TO 'abs_checker'@'%';");
    }

    public function down()
    {
        DB::unprepared("DROP FUNCTION IF EXISTS check_fill_ewallet");
        DB::unprepared("DROP USER IF EXISTS 'abs_checker'@'%'");
    }
}
