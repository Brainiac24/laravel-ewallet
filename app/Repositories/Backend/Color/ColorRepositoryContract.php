<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29.07.2019
 * Time: 16:07
 */

namespace App\Repositories\Backend\Color;


interface ColorRepositoryContract
{
    public function all($search);

    public function findById($id);

    public function update(array $data, $id);

    public function create(array $data);

    public function destroy($id);
}