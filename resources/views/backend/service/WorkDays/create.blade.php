@extends('adminlte::page')

@section('title', trans('attestations.backend.attestation'))

@section('content_header')
    <h1>{{ trans('serviceworkdays.backend.workday')}}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.create') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::open(['route' => 'admin.workdays.store','class'=>'form-horizontal','id'=>'form-roles']) !!}
            @include('backend.service.WorkDays.partials.fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default']) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-roles']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop