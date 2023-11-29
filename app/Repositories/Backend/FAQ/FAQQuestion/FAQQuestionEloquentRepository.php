<?php


namespace App\Repositories\Backend\FAQ\FAQQuestion;


use App\Models\FAQ\FAQQuestion\FAQQuestion;

class FAQQuestionEloquentRepository implements FAQQuestionRepositoryContract
{
    private $FAQQuestion;

    public function __construct(FAQQuestion $FAQQuestion)
    {
        $this->FAQQuestion=$FAQQuestion;
    }

    public function all($columns = ['*'])
    {
        $FAQQuestion = $this->FAQQuestion->orderBy('created_at', 'desc')->get($columns)->sortBy('position');
        return $FAQQuestion;
    }

    public function findById($id)
    {
        return $this->FAQQuestion->findOrFail($id);
    }

    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->FAQQuestion->select($columns)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function update(array $data, $id)
    {
        $FAQQuestion=$this->FAQQuestion->findOrFail($id);
        $FAQQuestion->setOldAttributes($FAQQuestion->getAttributes());
        $FAQQuestion->update($data);
        return $FAQQuestion;
    }

    public function create(array $data)
    {
        return $this->FAQQuestion->create($data);
    }

    public function destroy($id)
    {
        $FAQQuestion=$this->FAQQuestion->findOrFail($id);
        $FAQQuestion->is_active=0;
        $FAQQuestion->save();
        return $FAQQuestion;
    }
}