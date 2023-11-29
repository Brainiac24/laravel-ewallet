<?php

namespace App\Repositories\Backend\SplashScreen;

use App\Models\Setting\Setting;
use App\Services\Common\Image\ImageServiceContract;
use Ramsey\Uuid\Uuid;

class SplashScreenEloquentRepository implements SplashScreenRepositoryContract
{
    protected $setting;
    protected $imageService;

    public function __construct(ImageServiceContract $imageService,
                                Setting $setting)
    {
        $this->setting=$setting;
        $this->imageService=$imageService;
    }

    public function updateValue($value)
    {
        $splashScreen=$this->getOneSplashScreen();
        $splashScreen->setOldAttributes($splashScreen->getAttributes());
        $splashScreen->update(['value'=>$value]);

        return $splashScreen;
    }

    public function listAll()
    {
        return collect(\File::allFiles(public_path('/imgs/splash_screens/ldpi')))->mapWithKeys(function($item){
            return [basename($item)=>basename($item)];
        })->prepend('','');
    }

    public function saveImage($image)
    {
        $folder = '/imgs/splash_screens/';
        $image_format = 'png';
        $name = Uuid::uuid4();
        $this->imageService->saveWithParamAndWithPlatform($image, 270, 570, $folder, $name.".".$image_format, 'android', $image_format);
        $this->imageService->saveWithParamAndWithPlatform($image, 360, 760, $folder, $name.".".$image_format, 'ios', $image_format);
        $this->imageService->saveWithParamAndWithPlatform($image, 270, 570, $folder, $name.".".$image_format, 'web', $image_format);

        return $name.'.'.$image_format;
    }

    public function getOneSplashScreen()
    {
        return $this->setting->where('key','SPLASH_SCREEN')->first();
    }
}