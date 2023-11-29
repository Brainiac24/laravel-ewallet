<?php

namespace App\Http\Controllers\Frontend\Api\Service\Category;

use App\Exceptions\Frontend\Api\LogicException;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Service\Category\CategoryRepositoryContract;
use App\Services\Common\Helpers\Attestation;
use App\Services\Common\Helpers\Category;
use App\Services\Common\Helpers\Helper;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public $categoryRepository;

    public function __construct(CategoryRepositoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param null $size
     * @return mixed
     */
    public function getCategories($size = null)
    {
        $categories = $this->categoryRepository->allActive();

        

        if ($categories == null) {
            throw new LogicException(trans('category.errors.not_found'));
        }

        $code = '0';
        try {
            $data = $this->createStructure($categories);
        } catch (\Exception $e) {
            //dd($e);
            throw new LogicException(trans('category.errors.tree_build_failed'));
        }

        $meta = [
            'service_icons_url_host' => Helper::asset(config('app_settings.service_icons_url_host')), //. $this->getImageSize($size),
        ];
        //dd($data);
        return \response()->apiSuccess(compact('code', 'data', 'meta'));
    }

    public function createStructure($categories)
    {
        $arr = array();
        foreach ($categories as $cat) {
            if ($cat->id == config('app_settings.default_category_menu_id')) {
                $arr = $this->buildTree($categories, $cat->id);
            }
        }
        return $arr;
    }

    public function buildTree($categories, $cat_id)
    {

        $arr = array();
        foreach ($categories as $cat2) {
            if ($cat_id == $cat2->parent_id) {
                //\Log::info(print_r($arr));

                $type = config('app_settings.categories.type');
                switch ($cat2->id) {
                    case Category::CASHOUT_MENU:
                        $type = config('app_settings.categories.menu_cash');
                        break;
                    case Category::QR_MENU:
                        $type = config('app_settings.categories.menu_qr');
                        break;
                    case Category::MAP_MENU:
                        $type = config('app_settings.categories.menu_map');
                        break;
                    default:
                }
                //ХАРДКОД - Изменить на Many to many
                $enabled_cat = Auth::user()->attestation->id == Attestation::IDENTIFIED ? 1 : $cat2->is_enabled;

                $arr_temp = [
                    'id' => $cat2->id,
                    'name' => $cat2->name,
                    'code' => $cat2->code,
                    'type' => $type,
                    'icon' => $cat2->icon_url,
                    'enabled' => $enabled_cat,
                    //'child' => $this->buildTree($categories, $cat2->id),
                ];

                $child = $this->buildTree($categories, $cat2->id);
                if (count($child) > 0) {
                    $arr_temp['child'] = $child;
                }
                //dd($child);

                if ($cat2->services->count() > 0) {
                    foreach ($cat2->services as $service) {
                        //ХАРДКОД - Изменить на Many to many
                        $enabled_service = Auth::user()->attestation->id == Attestation::IDENTIFIED ? 1 : $service->is_enabled;

                        $arr_serv = [
                            'id' => $service->id,
                            'name' => $service->name,
                            'code' => $service->code,
                            'type' => config('app_settings.services.type'),
                            //'currency_iso' => $service->currency->iso_name,
                            'icon' => $service->icon_url,
                            'enabled' => $enabled_service,
                        ];

                        if (isset($arr_temp['child'])) {
                            array_push($arr_temp['child'], $arr_serv);
                        } else {
                            $arr_temp['child'][] = $arr_serv;
                        }
                    }
                }

                $arr[] = $arr_temp;

            }
        }
        return $arr;
    }

    public function getImageSize($size)
    {
        $res = '';
        switch ($size) {
            case 'hdpi':
                $res = '/hdpi/';
                break;
            case 'ldpi':
                $res = '/ldpi/';
                break;
            case 'mdpi':
                $res = '/mdpi/';
                break;
            case 'xhdpi':
                $res = '/xhdpi/';
                break;
            case 'xxhdpi':
                $res = '/xxhdpi/';
                break;
            case 'xxxhdpi':
                $res = '/xxxhdpi/';
                break;
            default:
                $res = '/xxxhdpi/';
        }
        return $res;
    }

}
