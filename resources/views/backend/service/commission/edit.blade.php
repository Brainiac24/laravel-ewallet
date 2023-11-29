@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('commission.backend.title') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::model($commission , ['route' => ['admin.services.commissions.update', $commission->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-commission']) !!}
            @include('backend.service.commission.partials.fields')
            {!! Form::close() !!}
            @include('backend.service.commission.partials.commission_data_fields')
            @include('backend.service.commission.partials.edit_table')
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-commission']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop