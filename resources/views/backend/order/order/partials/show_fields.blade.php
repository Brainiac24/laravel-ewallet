<div class="form-group">
    {!! Form::label('id', trans('event.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('order_type', trans('order.backend.table.order_type').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->order_type->name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('number', trans('order.backend.table.number').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->number }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('form_user', trans('order.backend.table.from_user').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->from_user->username ?? ""}}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('to_user', trans('order.backend.table.to_user').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->to_user->username ?? "" }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('entity', trans('order.backend.table.entity').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->entity_type ?? "" }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('entity_id', trans('order.backend.table.entity_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->entity_id ?? "" }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('payload_param_json', trans('order.backend.table.payload_param_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="{{ $data->payload_params_json==null ?: 'json-params' }}">{{ json_encode($data->payload_params_json, JSON_UNESCAPED_UNICODE) }}</p>
    </div>
</div>

@if ($orderCardType != null)
    <div class="form-group">
        {!! Form::label('entity_id', "Тип карты".':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            <p class="form-control-static">{{ $orderCardType->name ?? "" }}</p>
        </div>
    </div>
@endif

<div class="form-group">
    {!! Form::label('response', trans('order.backend.table.response').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="{{ $data->response==null ?: 'json-params' }}">{{ json_encode($data->response, JSON_UNESCAPED_UNICODE) }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static"></p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static"><a href="{{route('admin.jobLog.index')}}?search=Поиск&order_id={{$data->id}}" target="_blank"> Перейти в Журнал задач</a></p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static"></p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static"><a href="{{route('admin.transactions.index')}}?search=Поиск&order_id={{$data->id}}" target="_blank"> Перейти в транзакцию</a></p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('order_status', trans('order.backend.table.order_status').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->order_status->name ?? "" }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('order_process_status_id', trans('order.backend.table.order_process_status_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->order_process_status->name ?? "" }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('event.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->created_at }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('event.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->updated_at }}</p>
    </div>
</div>