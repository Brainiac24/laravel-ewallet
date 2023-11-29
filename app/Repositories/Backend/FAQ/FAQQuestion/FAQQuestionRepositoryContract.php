<?php


namespace App\Repositories\Backend\FAQ\FAQQuestion;


interface FAQQuestionRepositoryContract
{
    public function all($columns = ['*']);

    public function findById($id);

    public function paginate($perPage = 30, $columns = ['*']);

    public function update(array $data, $id);

    public function create(array $data);

    public function destroy($id);
}