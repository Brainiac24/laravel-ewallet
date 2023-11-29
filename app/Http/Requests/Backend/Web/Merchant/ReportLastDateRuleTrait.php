<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 10.08.2021
 * Time: 16:16
 */

namespace App\Http\Requests\Backend\Web\Merchant;

use Carbon\Carbon;

trait ReportLastDateRuleTrait
{
    public function isValidDate()
    {

        if ($this->generate_report && !is_null($this->params_json['report']['last_send']))
            try {
                Carbon::parse($this->params_json['report']['last_send']);
            } catch (\Exception $e0) {
                return false;
            }

        return false;

    }


}