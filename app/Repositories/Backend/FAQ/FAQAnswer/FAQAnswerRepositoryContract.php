<?php


namespace App\Repositories\Backend\FAQ\FAQAnswer;


interface FAQAnswerRepositoryContract
{
    public function all($columns = ['*']);

    public function findById($id);

    public function GetAllByFAQQuestionId($FAQQuestion_id);

    public function paginate($perPage = 30, $columns = ['*']);

    public function update(array $data, $id);

    public function create(array $data);

    public function destroy($id);
}