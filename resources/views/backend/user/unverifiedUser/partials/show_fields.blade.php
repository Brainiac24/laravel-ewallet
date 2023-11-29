<!-- code Field -->
<div class="form-group">
    {!! Form::label('id', trans('unverifiedUser.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('msisdn', trans('unverifiedUser.backend.table.msisdn').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->msisdn }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('blocked_count', trans('unverifiedUser.backend.table.blocked_count').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->blocked_count }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('blocked_at', trans('unverifiedUser.backend.table.blocked_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->blocked_at }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('unblock_at', trans('unverifiedUser.backend.table.unblock_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->unblock_at }}</p>
    </div>
</div>


<div class="form-group">
    {!! Form::label('ip', trans('unverifiedUser.backend.table.ip').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->ip }}</p>
    </div>
</div>

<div class="form-group">
        {!! Form::label('devices_json', trans('unverifiedUser.backend.devices_json').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
               <p class="{{ $data->devices_json==null ?: 'json-params' }}">{{ json_encode($data->devices_json, JSON_UNESCAPED_UNICODE) }}</p>
        </div>
</div>

<div class="form-group">
    {!! Form::label('sms_params_json', trans('unverifiedUser.backend.sms_params_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        @if($data->sms_params_json===null)
            <p class="form-control-static"></p>
        @else
            <p class="form-control-static">{{$data->sms_params_json['code_sent_at']??""}}</p>,
        @endif </div>
</div>

<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('unverifiedUser.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('unverifiedUser.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->updated_at }}</p>
    </div>
</div>