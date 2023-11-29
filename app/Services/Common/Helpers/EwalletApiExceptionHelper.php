<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 08.09.2020
 * Time: 14:34
 */

namespace App\Services\Common\Helpers;

class EwalletApiExceptionHelper
{
    public static function getMessage(\GuzzleHttp\Exception\ClientException $e)
    {
        $e->getResponse()->getBody()->rewind();
        $contents = $e->getResponse()->getBody()->getContents();
        $data = json_decode($contents, true);
        if(isset($data["message"])) {
            return $data["message"]." ".$contents;
        }

        return $e->getMessage()." ".$contents;
    }

}