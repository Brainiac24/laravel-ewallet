<div class="form-group">
    {!! Form::label('attestation_id', trans('client.backend.table.attestation'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select ('report_analysis_id', $reportAnalysisFilters, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_created_at', 'Дата создание:', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::date('from_created_at') !!} - {!! Form::date('to_created_at') !!}
    </div>
</div>

