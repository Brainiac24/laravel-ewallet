@extends('adminlte::page')

@section('title', trans('orderCardContractType.backend.title'))

@section('content_header')
    <h1>{{ trans('orderCardContractType.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.error')
    @include('backend.errors.success')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::model($orderCardContractType , ['route' => ['admin.order.cardContractType.update', $orderCardContractType->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-card-contract-type']) !!}
            @include('backend.order.orderCardContractType.partials.fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-card-contract-type']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop
