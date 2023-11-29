@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('merchant.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.error')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::model($merchant , ['route' => ['admin.merchants.update', $merchant->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-category','enctype'=>"multipart/form-data"]) !!}
            @include('backend.merchant.merchant.partials.fields')
            {!! Form::close() !!}
            {!! Form::model($merchant, ['route' => ['admin.merchants.deleteImageLogo', $merchant->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-delete-image-logo']) !!}
            {!! Form::close() !!}
            {!! Form::model($merchant, ['route' => ['admin.merchants.deleteImageAd', $merchant->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-delete-image-ad']) !!}
            {!! Form::close() !!}
            {!! Form::model($merchant, ['route' => ['admin.merchants.deleteImageDetail', $merchant->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-delete-image-detail']) !!}
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-category']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop