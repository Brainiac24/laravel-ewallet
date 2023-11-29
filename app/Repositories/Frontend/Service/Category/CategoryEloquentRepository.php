<?php

namespace App\Repositories\Frontend\Service\Category;

use App\Models\Service\Category\Category;
use App\Repositories\Frontend\Service\Category\CategoryRepositoryContract;

class CategoryEloquentRepository implements CategoryRepositoryContract
{

    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function all($columns = ['*'])
    {
        return $this->category->select($columns)->with('services.currency')->get()->sortBy('position');
    }

    public function allActive($columns = ['*'])
    {
        return $this->category->select($columns)->with([
            'services' => function ($q) {
            $q->where('is_active', true)->orderBy('position');
        }
        , 'services.currency'])->where('is_active', true)->orderBy('position')->get();
    }

}
