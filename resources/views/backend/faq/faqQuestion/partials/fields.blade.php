<!-- title Field -->
<div class="form-group required">
    {!! Form::label('title', trans('faqQuestion.backend.title').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- parent_id Field -->
<div class="form-group required">
    {!! Form::label('parent_id', trans('faqQuestion.backend.parent_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('parent_id', $FAQQuestionList,$FAQQuestion->parent_id??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('faqQuestion.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled'),$FAQQuestion->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- position Field -->
<div class="form-group required">
    {!! Form::label('position', trans('faqQuestion.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::number('position', null, ['class' => 'form-control']) !!}
    </div>
</div>

