<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 20.09.2018
 * Time: 14:31
 */

namespace App\Exceptions\Backend\Api;


class ResourceNotFoundException extends \Exception
{
    public function render()
    {
        $data['success'] = false;
        $data['message'] = $this->getMessage();


        return response()->json($data);
    }
}