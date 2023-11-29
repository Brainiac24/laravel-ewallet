<?php

use Illuminate\Database\Migrations\Migration;

class CreateProcedureReportEwalletWallet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "DELIMITER $$

DROP PROCEDURE IF EXISTS report_ewallet_to_ewallet $$
CREATE PROCEDURE report_ewallet_to_ewallet(IN from_date DATE, IN to_date DATE)
BEGIN
	SELECT 
  f_u.`msisdn` AS 'from_account',
  t_u.`msisdn` AS 'to_account',
  t.`created_at` AS 'created_at',
  t.`amount` AS 'from_acount',
  t.`from_currency_iso_name` AS 'from_currency',
  t.`converted_amount` AS 'to_amount',
  t.`to_currency_iso_name` AS 'to_currency',
  s.code AS 'service_code' 
FROM
  `transactions` t 
  INNER JOIN `accounts` f_a 
    ON t.`from_account_id` = f_a.`id` 
  INNER JOIN `accounts` t_a 
    ON t.`to_account_id` = t_a.`id` 
  INNER JOIN `users` f_u 
    ON f_a.`user_id` = f_u.`id` 
  INNER JOIN `users` t_u 
    ON t_a.`user_id` = t_u.`id` 
  INNER JOIN `services` s 
    ON s.`id` = t.`service_id` 
WHERE `service_id` = '96e8b785-b1b9-11e8-904b-b06ebfbfa715' 
  AND t.`created_at` >= from_date 
  AND t.`created_at` <= to_date; 
END$$";
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
