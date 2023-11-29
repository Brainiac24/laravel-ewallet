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
<div class="form-group">
    {!! Form::label('tags', trans('news.backend.tags').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('tags', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('is_active', trans('documentType.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled') , $news->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('position', trans('news.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('position', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('image_name_text', trans('news.backend.image_name'), ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('image_name_text' , $news->image_name, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('image', trans('news.backend.image').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        @if($news->image_name != null)
            <div class='col-sm-12'><img src="{!! url('/imgs/news/ldpi/'.$news->image_name.'_big.jpg') !!}" alt="{{ $news->image_name }}"></div>
            {!! Form::submit(trans('actions.general.delete'), ['class' => 'btn btn-danger btn-margin-top-10','form'=>'form-delete-image']) !!}
        @else
            {!! Form::label('image_is_null', 'Картинка не установлено', ['class' => 'control-label col-sm-0']) !!}
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_push_notification', trans('news.backend.is_push_notification').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
{{--        По умолчанию отключен уведомления вовремя редактирование--}}
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