@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('cashback.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.error')
    @include('backend.errors.success')
    <script src="{{asset('vendor/grid/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/grid/w2ui.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/grid/w2ui.min.css')}}"/>
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.view') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.cashback.cashback.partials.show_fields')
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.back'), ['class' => 'btn btn-default'], $secure = null) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
    @include('backend.cashback.cashbackItem.partials.index_table')
@stop