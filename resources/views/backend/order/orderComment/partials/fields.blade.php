<!-- code Field -->

<div class="form-group required">
    {!! Form::label('short_name', trans('orderComment.backend.short_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('short_name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('name', trans('orderComment.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('order_type_id', trans('orderComment.backend.order_type_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('order_type_id', $orderTypes , $data->order_type_id ?? null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required div_code"  {{(($data->order_type_id??'')!=\App\Services\Common\Helpers\OrderType::REMOTE_IDENTIFICATION)?'hidden':''}} >
    {!! Form::label('code', trans('orderComment.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('code', [''=>'','photo'=>'Фотография', 'call'=>'Вызов'] , $data->code ?? null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('is_active', trans('orderComment.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.is_active') , $data->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>