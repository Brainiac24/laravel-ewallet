@extends('adminlte::page')

@section('title', trans('service.backend.name'))

@section('content_header')
    <h1>{{ trans('service.backend.name') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::model($service , ['route' => ['admin.services.update', $service->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-attestation','enctype'=>"multipart/form-data"]) !!}
            @include('backend.service.partials.fields')
            {!! Form::close() !!}
            {!! Form::model($service, ['route' => ['admin.service.deleteImageIconUrl', $service->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-delete-image-icon-url']) !!}
            {!! Form::close() !!}
            {!! Form::model($service, ['route' => ['admin.service.deleteImageInIconUrl', $service->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-delete-image-in-icon-url']) !!}
            {!! Form::close() !!}
            {!! Form::model($service, ['route' => ['admin.service.deleteImageOutIconUrl', $service->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-delete-image-out-icon-url']) !!}
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-attestation']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop