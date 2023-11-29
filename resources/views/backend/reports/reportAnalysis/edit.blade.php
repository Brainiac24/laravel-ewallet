@extends('adminlte::page')

@section('title', trans('reportAnalysis.backend.title'))

@section('content_header')
    <h1>{{ trans('reportAnalysis.backend.title')}}</h1>
@stop
@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::model($reportAnalysis , ['route' => ['admin.report_analysis.update', $reportAnalysis->id], 'method' => 'patch','class'=>'form-report_analysis','id'=>'form-report_analysis']) !!}
            @include('backend.reports.reportAnalysis.partials.fields')

            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-report_analysis']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop