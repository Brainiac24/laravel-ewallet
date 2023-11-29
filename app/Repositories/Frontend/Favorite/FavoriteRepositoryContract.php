<?php

namespace App\Repositories\Frontend\Favorite;

interface FavoriteRepositoryContract
{
    public function all($columns = ['*']);

    public function paginate($perPage = 30, $columns = ['*']);

    public function getById($id, $columns = ['*']);

    public function save($data);

    public function update($id, $data);

    public function delete($id);

    public function setIsMainParam($favorites_params, $service_params);

}