@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('area.backend.title') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div>
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::model($area, ['route' => ['admin.areas.update', $area->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-category']) !!}
            @include('backend.area.partials.edit_fields')
            {!! Form::close() !!}
        </div>
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-category']) !!}
        </div>
    </div>
@stop