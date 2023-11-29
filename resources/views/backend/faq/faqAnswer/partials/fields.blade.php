<!-- faq_question_id Field -->
<div class="form-group required">
    {!! Form::label('faq_question_id', trans('faqAnswer.backend.faq_question_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('faq_question_title', $FAQQuestion_name??$FAQAnswer->FAQQuestion->title??null, ['class' => 'form-control', 'readonly']) !!}
        {!! Form::hidden('faq_question_id', $FAQQuestion_id??$FAQAnswer->faq_question_id, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<!-- body Field -->
<div class="form-group required">
    {!! Form::label('body', trans('faqAnswer.backend.body').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
        {!! Form::textarea('body', null, ['class' => 'form-control', 'id'=>'body-ckeditor']) !!}
    </div>
</div>

<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('faqAnswer.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled'),$FAQAnswer->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>
<script>
    CKEDITOR.replace( 'body-ckeditor',  {
        tabSpaces: 4,
        filebrowserUploadUrl: "{{route('admin.FAQQuestions.FAQAnswers.upload', ['_token' => csrf_token(), 'FAQQuestion_id'=>$FAQQuestion_id])}}",
        filebrowserUploadMethod: "form"});
</script>

