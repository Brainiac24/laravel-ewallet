<!-- code Field -->
<div class="form-group">
    {!! Form::label('id', trans('userSessionCode.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('value', trans('userSessionCode.backend.table.value').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->value }}</p>
    </div>
</div>

<!-- is_active Field -->
<div class="form-group">
    {!! Form::label('code', trans('userSessionCode.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->sms_code }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('unblock_at', trans('userSessionCode.backend.table.unblock_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->unblock_at }} </p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('blocked_at', trans('userSessionCode.backend.table.blocked_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->blocked_at }} </p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('code_sent_at', trans('userSessionCode.backend.table.code_sent_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->code_sent_at }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('user_session_code_type_id', trans('userSessionCode.backend.table.user_session_code_type_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->user_session_code_type->name ?? "" }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('entity_type', trans('userSessionCode.backend.table.entity_type').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->entity_type }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('entity_id', trans('userSessionCode.backend.table.entity_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->entity_id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_by_user_id', trans('userSessionCode.backend.table.created_by_user_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->user->last_name??"" }} {{ $data->user->first_name??"" }} {{ $data->user->middle_name??"" }}</p>
    </div>
</div>

<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('userSessionCode.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('userSessionCode.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->updated_at }}</p>
    </div>
</div>