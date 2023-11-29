@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('merchantItem.backend.title') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            @include('backend.errors.success')
            @include('backend.errors.error')
            {!! Form::model($merchantItem, ['route' => ['admin.merchants.items.update',$merchant_id, $merchantItem->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-category']) !!}
            @include('backend.merchant.merchantItem.partials.fields')
            {!! Form::close() !!}
            {{--{!! Form::model($merchantItem, ['route' => ['admin.merchants.items.changeAccCode', $merchantItem->id], 'method' => 'post','class'=>'form-horizontal','id'=>'form-change-accCode']) !!}--}}
            {{--@include('backend.merchant.merchantItem.partials.field_changeAccountNumber')--}}
            {{--{!! Form::close() !!}--}}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!!  link_to(route('admin.merchants.items.settingJson', ['merchant_id'=>$merchantItem->merchant_id, 'id'=>$merchantItem->id]), trans('merchantItem.buttons.downloadSettingsJson'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-category']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop