<?php


namespace App\Repositories\Backend\FAQ\FAQAnswer;


use App\Models\FAQ\FAQAnswer\FAQAnswer;

class FAQAnswerEloquentRepository implements FAQAnswerRepositoryContract
{
    private $FAQAnswer;

    public function __construct(FAQAnswer $FAQAnswer)
    {
        $this->FAQAnswer=$FAQAnswer;
    }

    public function all($columns = ['*'])
    {
        $FAQQuestion = $this->FAQAnswer->orderBy('created_at', 'desc')->get($columns);
        return $FAQQuestion;
    }

    public function findById($id)
    {
        return $this->FAQAnswer
            ->where('id', $id)
            ->with('FAQQuestion')
            ->first();
    }

    public function GetAllByFAQQuestionId($FAQQuestion_id)
    {
        return $this
            ->FAQAnswer
            ->where('faq_question_id',$FAQQuestion_id)
            //->with('merchant')
            ->orderBy('created_at')
            ->get();
    }
    public function paginate($perPage = 30, $columns = ['*'])
    {
        return $this->FAQAnswer
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->with('FAQQuestion')
            ->paginate($perPage);
    }

    public function update(array $data, $id)
    {
        $data['body']=str_replace("\r\n", '',$data['body']);
        $FAQAnswer=$this->FAQAnswer->findOrFail($id);
        $FAQAnswer->setOldAttributes($FAQAnswer->getAttributes());
        $FAQAnswer->update($data);
        return $FAQAnswer;
    }

    public function create(array $data)
    {
        $data['body']=str_replace("\r\n", '',$data['body']);
        return $this->FAQAnswer->create($data);
    }

    public function destroy($id)
    {
        $FAQAnswer=$this->FAQAnswer->findOrFail($id);
        $FAQAnswer->is_active=0;
        $FAQAnswer->save();
        return $FAQAnswer;
    }
}