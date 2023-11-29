<?php

namespace App\Repositories\Frontend\Service;

interface ServiceRepositoryContract
{
    public function all($columns = ['*']);
    public function getByCode($code, $columns = ['*']);
    public function getIdByCode($code);
    public function findById($id, $columns = ['*']);
    public function allActive($columns = ['*']);
    public function getById($id, $columns = ['*']);
    public function getByIdActive($id, $columns = ['*']);
    
}