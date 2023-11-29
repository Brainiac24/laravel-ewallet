<!-- code Field -->
<div class="form-group required">
    {!! Form::label('title', trans('news.backend.title').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('short_description', trans('news.backend.short_description').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('short_description', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('description', trans('news.backend.description').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- name Field -->
<div class="form-group">
    {!! Form::label('tags', trans('news.backend.tags').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('tags', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">

    {!! Form::label('is_active', trans('news.backend.is_active'), ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.is_active'), true, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('position', trans('news.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('position', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_push_notification', trans('news.backend.is_push_notification').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::hidden('is_push_notification', 0, ['class' => 'form-control']) !!}
        {!! Form::checkbox('is_push_notification', 1, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('image_name', trans('news.backend.image').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::file('image_name', ['class' => 'form-control', "accept"=>"image/*"]) !!}
    </div>
</div>