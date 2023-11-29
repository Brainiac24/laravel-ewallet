<?php


namespace App\Models\FAQ\FAQQuestion;


use App\Models\BaseModel;

class FAQQuestion extends BaseModel
{
    protected $fillable = [
        'title',
        'position',
        'parent_id',
        'is_active',
    ];

    protected $table='faq_questions';
}