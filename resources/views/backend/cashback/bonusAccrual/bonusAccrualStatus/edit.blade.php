@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('bonusAccrualStatus.backend.title') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::model($data , ['route' => ['admin.bonusAccrualStatus.update', $data->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-bonusAccrualStatus']) !!}
            @include('backend.cashback.bonusAccrual.bonusAccrualStatus.partials.edit_fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-bonusAccrualStatus']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop