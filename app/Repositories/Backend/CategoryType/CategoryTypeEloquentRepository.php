<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.07.2019
 * Time: 17:58
 */

namespace App\Repositories\Backend\CategoryType;


use App\Models\CategoryType\CategoryType;
use App\Models\CategoryType\Filters\CategoryTypeFilter;

class CategoryTypeEloquentRepository implements CategoryTypeRepositoryContract
{
    /**
     * @var CategoryType
     */
    private $categoryType;

    /**
     * CategoryTypeEloquentRepository constructor.
     * @param CategoryType $categoryType
     */
    public function __construct(CategoryType $categoryType)
    {
        $this->categoryType = $categoryType;
    }

    public function all($columns = ['*'])
    {
        return $categoryType = $this->categoryType->get($columns);
    }

    public function findById($id)
    {
        return $this->categoryType->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $categoryType = $this->categoryType->findOrFail($id);
        $categoryType->setOldAttributes($categoryType->getAttributes());
        $categoryType->update($data);
        return $categoryType;
    }

    public function paginate($data = [], $perPage = 30, $columns = ['*'])
    {
        return $this->categoryType->select($columns)->filterBy(new CategoryTypeFilter($data))->orderBy('created_at', 'desc')->paginate($perPage);
    }
}