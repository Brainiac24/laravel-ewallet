<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 18.07.2018
 * Time: 15:10
 */

namespace App\Repositories\Backend\Favorite;


interface FavoriteRepositoryContract
{

    public function getForDataTable();

    public function all($columns = ['*']);

    public function paginate($data=[],$perPage = 30, $columns = ['*']);

    public function listsAll();

    public function create(array $data);

    public function findById($id, $columns = ['*']);

    public function update(array $data, $id);

    public function lastLoginUpdate($id);

    public function destroy($id);

    public function restore($id);
}