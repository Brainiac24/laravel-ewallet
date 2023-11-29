<div class="form-group">
    {!! Form::label('payload_params_profile_fullname', 'ФИО содержит', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('payload_params_profile_fullname', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_user_id', 'Телефон содержит', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('from_user_id', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('payload_params_profile_inn', 'Инн', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('payload_params_profile_inn', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('payload_params_profile_passport_seria', 'Серия паспорта', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('payload_params_profile_passport_seria', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('payload_params_profile_passport_number', 'Номер паспорта', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('payload_params_profile_passport_number', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('processed_by_user_full_name', 'ФИО обработал', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('processed_by_user_full_name', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('order_status_id', 'Статус', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('order_status_id',  $filterOrderStatus, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('order_process_status_id', 'Статус оброботки', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('order_process_status_id',  $filterOrderProcessStatus, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_user_attestation_id', 'Аттестация', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('from_user_attestation_id',  $filterUserAttestations, ['class'=>'form-control']) !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('from_date', 'Дата создания:', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::date('from_created_at') !!} - {!! Form::date('to_created_at') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('update_date', 'Дата обработки:', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::date('from_updated_at') !!} - {!! Form::date('to_updated_at') !!}
    </div>
</div>
