@extends('adminlte::page')

@section('title', trans('splashScreen.backend.title'))

@section('content_header')
    <h1>{{ trans('splashScreen.backend.title') }}</h1>
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
            {!! Form::open(['route' => 'admin.splashScreens.store','class'=>'form-horizontal','id'=>'form-category','enctype'=>"multipart/form-data"]) !!}
            @include('backend.splashScreen.partials.fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-category']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop

@section('page_js')
    @include('backend.splashScreen.partials.fields_scripts')
@stop