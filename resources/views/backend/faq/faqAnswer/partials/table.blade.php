@foreach($FAQAnswers as $item)
    {
    recid: '{{$item->id}}',
    faq_question_id: '{{$item->FAQQuestion->title}}',
    body: '{{str_replace("\r\n", '',$item->body)}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach