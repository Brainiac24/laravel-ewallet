<?php

namespace App\Services\Common\Helpers;

class Helper
{
    public static function roundTo2dp($value_string)
    {
        return (double)number_format($value_string, 2, '.', '');
    }

    public static function generateSmsCode()
    {
        return self::generateCode();
    }

    public static function generateEmailCode()
    {
        return self::generateSmsCode('email');
    }

    private static function generateCode($config = 'sms')
    {
        $min_value = config("auth_api.{$config}.min_value");
        $max_value = config("auth_api.{$config}.max_value");
        $length = config("auth_api.{$config}.length");

        $code = rand($min_value, $max_value);

        if (\Auth::id() == config('app_settings.test_apple_client_id'))
            $code = config('app_settings.default_code_apple');

        return str_pad($code, $length, '0', STR_PAD_LEFT);
    }

    public static function generateQrCodeWithBase64($qr_text)
    {
        return base64_encode(\QrCode::size(200)->color(0, 35, 109)->generate($qr_text));
    }

    public static function asset($path = null)
    {
        return asset($path);
    }
}
