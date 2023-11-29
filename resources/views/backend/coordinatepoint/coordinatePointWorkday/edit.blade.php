@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('coordinatePointWorkday.backend.workday') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::model($coordinatePointWorkday , ['route' => ['admin.coordinatepointWorkdays.update', $coordinatePointWorkday->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-attestation']) !!}
            @include('backend.coordinatepoint.coordinatePointWorkday.partials.fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-attestation']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop