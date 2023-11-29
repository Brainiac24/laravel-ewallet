@extends('adminlte::page')

@section('title', trans('reportAnalysis.backend.title'))

@section('content_header')
    <h1>{{ trans('reportAnalysis.backend.title')}}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.create') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::open(['route' => 'admin.report_analysis.store','class'=>'form-horizontal','id'=>'form-report_analysis','enctype'=>"multipart/form-data"]) !!}
            @include('backend.reports.reportAnalysis.partials.fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default']) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-report_analysis']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop