<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.id')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->id }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.order_type')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->order_type->name }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.number')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->number }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.from_user')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->from_user->username ?? "" }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.to_user')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->to_user->username ?? "" }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.entity')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->entity_type ?? "" }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.entity_id')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->entity_id ?? "" }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.payload_param_json')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="{{ $data->payload_params_json==null ?: 'json-params' }}">{{ json_encode($data->payload_params_json, JSON_UNESCAPED_UNICODE) }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.response')}}:</p>
    </div>

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

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.order_status')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->order_status->name ?? "" }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.order_process_status_id')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->order_process_status->name ?? "" }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.is_queued')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{trans('InterfaceTranses.is_queied.'.$data->is_queued)}}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.created_at')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->created_at }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.updated_at')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->updated_at }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static"></p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static"></p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.send_to_processing')}}:</p>
    </div>
    <div class='col-sm-9'>
        {!! Form::hidden('send_to_processing', 0, ['class' => 'form-control']) !!}
        {!! Form::checkbox('send_to_processing', null, false) !!}
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('order.backend.table.order_process_status_id')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ Form::select('order_process_status_id', $orderProcessStatus, null, ['class' => 'form-control']) }}</p>
    </div>
</div>
