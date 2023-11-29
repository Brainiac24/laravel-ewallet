@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('order.backend.title') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.view') }}</h3>
        </div>
        <div class="box-body">
            @include('backend.order.order.partials.show_fields')
        </div>
        <div class="box-footer">
            {!!  link_to(route('admin.orders.index'), trans('actions.general.back'), ['class' => 'btn btn-default'], $secure = null) !!}
        </div>
    </div>

    @include('backend.order.order.partials.show_fields_history')
@stop