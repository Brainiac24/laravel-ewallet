<div class="form-group">
    {!! Form::label('id', trans('faqQuestion.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $FAQQuestion->id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('title', trans('faqQuestion.backend.table.title').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $FAQQuestion->title }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('parent_id', trans('faqQuestion.backend.table.parent_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $FAQQuestionParent->title }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('position', trans('faqQuestion.backend.table.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $FAQQuestion->position }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('faqQuestion.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{trans('InterfaceTranses.is_active.'. $FAQQuestion->is_active )}}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('faqQuestion.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $FAQQuestion->created_at }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('faqQuestion.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $FAQQuestion->updated_at }}</p>
    </div>
</div>