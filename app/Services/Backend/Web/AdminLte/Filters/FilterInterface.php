<?php

namespace App\Services\Backend\Web\AdminLte\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Builder;

interface FilterInterface
{
    public function transform($item, Builder $builder);
}
