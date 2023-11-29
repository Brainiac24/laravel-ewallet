<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 14.08.2017
 * Time: 11:33
 */

namespace App\Services\Common\Helpers;

use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

//use Laratrust\Laratrust;

class CustomMenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {


        if (isset($item['can']) && !Auth::user()->ability(['sadmin'], [$item['can']])) {
//            dd(Auth::user()->roles()->get());
            return false;
        }

        return $item;
    }

}