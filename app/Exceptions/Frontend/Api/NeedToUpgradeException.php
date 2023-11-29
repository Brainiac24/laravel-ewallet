<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2018
 * Time: 16:50
 */

namespace App\Exceptions\Frontend\Api;


use App\Services\Common\Helpers\HttpStatusCode;

class NeedToUpgradeException extends BaseException
{
    protected function getStatusCode()
    {
        return HttpStatusCode::NEED_TO_UPGRADE;
    }

    protected function getComment()
    {
        return trans('setting.errors.major_update');
    }

    public function render()
    {
        
        count($this->getAttribute()) === 0 ?: $data = $this->getAttribute();

        $data['message'] = ($this->getComment() == null) ? $this->getMessage() : $this->getComment();
        $data['code'] = $this->getStatusCode();
        $data['meta'] = [
            'upgrade_app_status' => 2
        ];

        return response()->apiError($data);
    }

}