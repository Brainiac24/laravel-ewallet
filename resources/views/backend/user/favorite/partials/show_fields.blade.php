<!-- name Field -->
<div class="form-group">
    {!! Form::label('name', trans('favorite.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $favorite->name }}</p>
    </div>
</div>
<!-- VALUE Field -->
<div class="form-group">
    {!! Form::label('VALUE', trans('favorite.backend.table.value').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $favorite->value }}</p>
    </div>
</div>
<!-- params_json Field -->
<div class="form-group">
    {!! Form::label('params_json', trans('favorite.backend.table.params_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>

        <p class="form-control-static"><div class="{{ $favorite->params_json==null ?: 'json-params' }}">{{ json_encode($favorite->params_json, JSON_UNESCAPED_UNICODE) }}</div></p>
    </div>
</div>
<!-- service_id Field -->
<div class="form-group">
    {!! Form::label('service_id', trans('favorite.backend.table.service_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $favorite->service->name??null }}</p>
    </div>
</div>
<!-- user_id Field -->
<div class="form-group">
    {!! Form::label('user_id', trans('favorite.backend.table.user_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $favorite->user->msisdn??null }}</p>
    </div>
</div>
<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('favorite.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $favorite->created_at }}</p>
    </div>
</div>

<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('favorite.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $favorite->updated_at }}</p>
    </div>
</div>