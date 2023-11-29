<div class="form-group">
    {!! Form::label('code', trans('accountCategoryType.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $accountCategoryTypes->code }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('name', trans('accountCategoryType.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $accountCategoryTypes->name }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('img_uncolored', trans('accountCategoryType.backend.table.img_uncolored').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $accountCategoryTypes->img_uncolored }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('img_colored', trans('accountCategoryType.backend.table.img_colored').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $accountCategoryTypes->img_colored }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('position', trans('accountCategoryType.backend.table.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $accountCategoryTypes->position }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('parent_id', trans('accountCategoryType.backend.table.parent_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $accountCategoryTypes->parent_id }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('params_json', trans('accountCategoryType.backend.table.params_json').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">
            <span class="json-params">
                {{ json_encode($accountCategoryTypes->params_json, JSON_UNESCAPED_UNICODE) }}
            </span>
        </p>
    </div>
</div>
<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('accountCategoryType.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $accountCategoryTypes->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('accountCategoryType.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $accountCategoryTypes->updated_at }}</p>
    </div>
</div>