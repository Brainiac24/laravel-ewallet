<?php
/**
 * Created by PhpStorm.
 * User: Kamol
 * Date: 14.11.2017
 * Time: 11:47
 */

namespace App\Services\Common\Image;


use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\File;

class ImageService implements ImageServiceContract
{

    

    public function save($path, $image, $size = 400)
    {
        if (method_exists($image, 'getClientOriginalName')) {

            $extension = $image->extension();
            $imageRealPath = $image->getRealPath();
            $name = $image->getClientOriginalName();
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s-u');
            $full_name = Uuid::uuid4(). '_' . $timestamp . '.jpg';
            // create image use Image Intervention package
            $img = \Image::make($imageRealPath)->encode('jpg', 75);

            // resize image to width and aspect radio
            $img->resize(intval($size), null, function ($constraint) {
                $constraint->aspectRatio();
            });

            if (!\File::exists($path)) {
                \File::makeDirectory($path, 0777, true);
            }

            return $img->save($path . DIRECTORY_SEPARATOR . $full_name);
        }
    }

    public function delete($path, $filename)
    {
        $full_path = $path . DIRECTORY_SEPARATOR . $filename;

        if (\File::exists($full_path)) {
            return \File::delete($full_path);
        }
    }

    /**
     * @param $image
     * @param $width
     * @param $height
     * @param $folder
     * @param $name
     * @param $platform
     * @param string $image_format
     */
    public function saveWithParamAndWithPlatform($image, $width, $height, $folder, $name, $platform, $image_format='jpg'){
        $path = public_path(str_replace('/',DIRECTORY_SEPARATOR, $folder));

        if ($platform=='android')
        {
            $this->saveWithParam($path.'ldpi',$image,$width,$height,$name, $image_format);
            $this->saveWithParam($path.'mdpi',$image,$width*1.33,$height*1.33,$name, $image_format);
            $this->saveWithParam($path.'hdpi',$image,$width*2,$height*2,$name, $image_format);
            $this->saveWithParam($path.'xhdpi',$image,$width*2.66,$height*2.66,$name, $image_format);
            $this->saveWithParam($path.'xxhdpi',$image,$width*4,$height*4,$name, $image_format);
            $this->saveWithParam($path.'xxxhdpi',$image,$width*5.33,$height*5.33,$name, $image_format);
        }
        else if ($platform=='ios')
        {
            $this->saveWithParam($path.'1',$image,$width,$height,$name, $image_format);
            $this->saveWithParam($path.'2',$image,$width*2,$height*2,$name, $image_format);
            $this->saveWithParam($path.'3',$image,$width*3,$height*3,$name, $image_format);
        }
        else if ($platform=='web')
        {
            $this->saveWithParam($path.'web',$image,$width*5.33,$height*5.33,$name, $image_format);
        }
        else
        {
            dd('error platform');
        }
    }

    public function saveWithParam($path, $image, $width, $height, $name, $image_format='jpg')
    {
        ini_set('max_execution_time', '90'); //90 seconds = 1,5 minutes

        if (method_exists($image, 'getClientOriginalName')) {

            $image->extension();
            $imageRealPath = $image->getRealPath();
            $image->getClientOriginalName();

            // create image use Image Intervention package
            $img = \Image::make($imageRealPath)->encode($image_format, 100);

            // resize image to width and aspect radio
            $img->resize(intval($width), intval($height), function ($constraint) {
                $constraint->aspectRatio();
            });

            if (!\File::exists($path)) {
                \File::makeDirectory($path, 0777, true);
            }

            return $img->save($path . DIRECTORY_SEPARATOR . $name,60);
        }
    }

    public function getIconsFromStorage($path)
    {
        $files = File::files($path,0);
        $icons = [];
        foreach ($files as $file) {

            if(strpos($file->getFilename(), 'all_')!== false){
                $basename = str_replace('all_','',$file->getFilename());
                $icons[$basename]  = $basename;
            }
        }

        return $icons;
    }

    public function markUsedIcons($dbIcons, $storageIcons)
    {
        $usedIcons = [];

        foreach ($storageIcons as $icon){
            $iconTrimmed = trim($icon, '.png');

            if(in_array($iconTrimmed, $dbIcons)){
                $usedIcons[$icon] = 'used';
            }else{
                $usedIcons[$icon] = 'not_used';
            }
        }

        return $usedIcons;
    }
}