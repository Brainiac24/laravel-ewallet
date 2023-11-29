<!-- code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('category.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('category.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- parent_id Field -->
<div class="form-group required">
    {!! Form::label('parent_id', trans('category.backend.parent_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('parent_id', $categoryList,$category->parent_id??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('category.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled'),$category->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('is_enabled', trans('category.backend.is_enabled').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_enabled', trans('InterfaceTranses.is_enabled'),$category->is_enabled??null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- position Field -->
<div class="form-group required">
    {!! Form::label('position', trans('category.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('position', null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group required">
    {!! Form::label('icon_url', trans('category.backend.icon_url').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('icon_url', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('is_searchable', trans('category.backend.is_searchable').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_searchable', trans('InterfaceTranses.enabled'),$category->is_searchable??null, ['class' => 'form-control']) !!}
    </div>
</div>
