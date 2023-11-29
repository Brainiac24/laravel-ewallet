<?php


namespace App\Repositories\Backend\Schedule;


interface ScheduleRepositoryContract
{
    public function all($search = '');

    public function paginate($perPage = 30, $columns = ['*']);

    public function findById($id);

    public function update(array $data, $id);

    public function destroy($id);

    public function create(array $data);
}