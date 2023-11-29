<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 25.08.2021
 * Time: 21:58
 */

namespace App\Repositories\Backend\DwhRule;


interface DwhRuleRepositoryContract
{
    public function all($data);

    public function paginate($data, $perPage);

    public function findById($id);

    public function getAllByTable($table);

    public function destroy($id);

    public function create(array $dwhRule);

    public function update(array $dwhRule,$id);

   
}