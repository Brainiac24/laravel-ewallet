{!! Form::open(['route' => ['admin.services.commissions.storeCommissionData', $commission->id],'class'=>'form-horizontal','id'=>'form-commission-data']) !!}
<div class="form-group required">
    {!! Form::label('parameters', trans('commission.backend.params').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-6'>
        {!! Form::number('params[min]', null, ['class' => 'form-control','placeholder'=>'Мин', 'step'=>'0.01']) !!}
    </div>
</div>
<div class="form-group required">
    <div class='col-sm-2 text-right' style="line-height: 34px" >{{trans('commission.backend.max')}}</div>
    <div class='col-sm-6'>
        {!! Form::number('params[max]', null, ['class' => 'form-control','placeholder'=>'Макс', 'step'=>'0.01']) !!}
    </div>
</div>
<div class="form-group required">
    <div class='col-sm-2  text-right' style="line-height: 34px">{{trans('commission.backend.value')}}</div>
    <div class='col-sm-6'>
        {!! Form::number('params[value]', null, ['class' => 'form-control','placeholder'=>'Значание' , 'step'=>'0.01']) !!}
    </div>
</div>
<!-- Available Field -->
{!! Form::hidden('params[is_percentage]',0) !!}
<div class="form-group">
    <div class='col-sm-2'></div>
    <div class='col-sm-4'>
        <div class="checkbox">
            <label>{!! Form::checkbox('params[is_percentage]') !!} Процентный</label>
        </div>
    </div>
</div>
<div class="form-group">
    <div class='col-sm-2'></div>
    <div class='col-sm-4'>
        {!! Form::submit(trans('actions.general.create'), ['class' => 'btn btn-primary','form'=>'form-commission-data']) !!}
    </div>
</div>
{!! Form::close() !!}