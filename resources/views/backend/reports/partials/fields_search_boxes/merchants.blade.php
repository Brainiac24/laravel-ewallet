<div class="form-group">
    {!! Form::label('id', trans('ID'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('id', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('name', trans('merchant.backend.name'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', trans('merchant.backend.organization'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('organization', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('branch_id', 'Филиал', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('branch_id', $branchs, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_verified', trans('merchant.backend.is_verified'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('is_verified', trans('InterfaceTranses.verified_for_filter'), ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('merchant.backend.is_active'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('is_active', trans('InterfaceTranses.enabled'), ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_date', 'Дата регистрации', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::date('from_created_at') !!} - {!! Form::date('to_created_at') !!}
    </div>
</div>

{{--<div class="form-group">--}}
    {{--{!! Form::label('account_type_id', 'Тип счета', ['class' => 'col-sm-5 control-label']) !!}--}}
    {{--<div class="col-sm-3">--}}
        {{--{!! Form::select('account_type_id', [''=>'']+ $filterAccountTypes, ['class'=>'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}
