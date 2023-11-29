<div class="form-group required">
    {!! Form::label('name', trans('cashback.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('start_date', trans('cashback.backend.start_date').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::datetimeLocal('start_date', empty($data->start_date)?null:\Carbon\Carbon::parse($data->start_date)->format("Y-m-d\TH:i"), ['class' => 'form-control col-sm-12'])!!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('end_date', trans('cashback.backend.end_date').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::datetimeLocal('end_date', empty($data->end_date)?null:\Carbon\Carbon::parse($data->end_date)->format("Y-m-d\TH:i"), ['class' => 'form-control col-sm-12'])!!}
    </div>
</div>

{{--<div class="form-group required">--}}
    {{--{!! Form::label('is_popular', trans('cashback.backend.to_do_is_popular').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::select('is_popular',  trans('InterfaceTranses.yesno'),  $data->is_popular??null    , ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group required">
    {!! Form::label('is_active', trans('merchant.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active',  trans('InterfaceTranses.enabled'),  $data->is_active??null    , ['class' => 'form-control']) !!}
    </div>
</div>
