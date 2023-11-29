@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('serviceLimits.backend.serviceLimit') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.view') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            {{-- {!! Form::open($role, ['route' => ['roles.update', $role->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-roles']) !!} --}}
            @include('backend.serviceLimits.partials.show_fields')
            {{-- {!! Form::close() !!} --}}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.back'), ['class' => 'btn btn-default'], $secure = null) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop