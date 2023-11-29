<?php


namespace App\Models\FAQ\FAQAnswer;


use App\Models\BaseModel;
use App\Models\FAQ\FAQQuestion\FAQQuestion;

class FAQAnswer extends BaseModel
{
    protected $fillable = [
        'body',
        'faq_question_id',
        'is_active',
    ];

    protected $table='faq_answers';

    public function FAQQuestion()
    {
        return $this->belongsTo(FAQQuestion::class, 'faq_question_id');
    }
}