<div class="form-group">
    {!! Form::label('id', trans('orderComment.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', trans('orderComment.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->name }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('id', trans('orderComment.backend.short_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->short_name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', trans('orderComment.backend.order_type_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->order_type->name }}</p>
    </div>
</div>

@if($data->order_type_id==\App\Services\Common\Helpers\OrderType::REMOTE_IDENTIFICATION)
<div class="form-group">
    {!! Form::label('name', trans('orderComment.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{$data->code=='photo'?'Фотография':($data->code=='call'?'Вызов':'')}}</p>
    </div>
</div>
@endif

<div class="form-group">
    {!! Form::label('is_active', trans('orderComment.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->is_active }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('orderComment.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->created_at }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('orderComment.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->updated_at }}</p>
    </div>
</div>