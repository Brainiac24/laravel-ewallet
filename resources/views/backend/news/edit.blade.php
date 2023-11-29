@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('news.backend.title') }}</h1>
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
            {!! Form::model($news , ['route' => ['admin.news.update', $news->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-category','enctype'=>"multipart/form-data"]) !!}
            @include('backend.news.partials.fields')
            {!! Form::close() !!}
            {!! Form::model($news, ['route' => ['admin.news.deleteImage', $news->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-delete-image']) !!}
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-category']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop