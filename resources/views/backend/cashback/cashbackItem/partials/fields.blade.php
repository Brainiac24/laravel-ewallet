<div class="form-group required">
    {!! Form::label('name', trans('cashbackItem.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('min', trans('cashbackItem.backend.min').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('min', null, ['class' => 'form-control','readonly']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('max', trans('cashbackItem.backend.max').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('max', null, ['class' => 'form-control','readonly']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('value', trans('cashbackItem.backend.value').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('value', null, ['class' => 'form-control']) !!}
    </div>
</div>

{{--<div class="form-group">--}}
    {{--{!! Form::label('is_percentage', trans('cashbackItem.backend.is_percentage').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::text('is_percentage', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group required">
    {!! Form::label('is_percentage', trans('cashbackItem.backend.is_percentage').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_percentage',  trans('InterfaceTranses.yesno'),  $data->is_percentage??null    , ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('cashback_id', trans('cashbackItem.backend.cashback_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('cashback_id', $data->cashback->name ?? null, ['class' => 'form-control','readonly']) !!}
    </div>
</div>

{{--<div class="form-group required">--}}
    {{--{!! Form::label('is_active', trans('cashbackItem.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::select('is_active',  trans('InterfaceTranses.enabled'),  $data->is_active??null    , ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}