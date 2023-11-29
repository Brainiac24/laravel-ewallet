<?php
/**
 * Created by PhpStorm.
 * User: Kamol
 * Date: 14.11.2017
 * Time: 11:49
 */
namespace App\Services\Common\Image;

interface ImageServiceContract
{
    public function save($path, $image, $size = 400);

    public function saveWithParam($path, $image, $width, $height, $name);

    public function saveWithParamAndWithPlatform($image, $widthStart, $heightStart, $folder, $name, $platform, $image_format);

    public function delete($path, $filename);

    public function getIconsFromStorage($path);

    public function markUsedIcons($dbIcons, $storageIcons);

}