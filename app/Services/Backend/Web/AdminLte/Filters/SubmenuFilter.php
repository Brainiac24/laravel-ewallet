<?php

namespace App\Services\Backend\Web\AdminLte\Filters;

use App\Services\Backend\Web\AdminLte\ActiveChecker;
use JeroenNoten\LaravelAdminLte\Menu\Builder;

class SubmenuFilter implements FilterInterface
{
    private $activeChecker;

    public function __construct(ActiveChecker $activeChecker)
    {
        $this->activeChecker = $activeChecker;
    }

    public function transform($item, Builder $builder)
    {
        if (isset($item['submenu'])) {
            $item['submenu'] = $builder->transformItems($item['submenu']);
            $item['submenu_open'] = $this->activeChecker->isActive($item);
            $item['submenu_classes'] = $this->makeSubmenuClasses();
            $item['submenu_class'] = implode(' ', $item['submenu_classes']);
        }

        return $item;
    }

    protected function makeSubmenuClasses()
    {
        $classes = ['treeview-menu'];

        return $classes;
    }
}
