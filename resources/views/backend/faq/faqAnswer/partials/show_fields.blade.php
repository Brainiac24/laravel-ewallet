<div class="form-group">
    {!! Form::label('id', trans('faqAnswer.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $FAQAnswer->id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('faq_question_id', trans('faqAnswer.backend.table.faq_question_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $FAQAnswer->FAQQuestion->title }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('body', trans('faqAnswer.backend.table.faq_question_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $FAQAnswer->body }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('faqAnswer.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{trans('InterfaceTranses.is_active.'. $FAQAnswer->is_active )}}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('faqAnswer.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $FAQAnswer->created_at }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('faqAnswer.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $FAQAnswer->updated_at }}</p>
    </div>
</div>