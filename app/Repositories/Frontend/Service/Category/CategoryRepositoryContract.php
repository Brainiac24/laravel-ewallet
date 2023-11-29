<?php

namespace App\Repositories\Frontend\Service\Category;

interface CategoryRepositoryContract
{
    public function all($columns = ['*']);
    public function allActive($columns = ['*']);
}