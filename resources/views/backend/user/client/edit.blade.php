@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('client.backend.title') }}</h1>
@stop

@section('content')
    <div class="row">
{{--! LEFT !--}}
        @include('backend.errors.errors')
        @include('backend.errors.success')
        @include('backend.errors.error')
        <div class="panel panel-default col-md-4  box-primary">
            @include('backend.user.client.partials.show_fields_left')
        </div>
{{--! RIGHT !--}}
        <div class="col-md-8" style="padding-left: 15px">
            <div class="">
                @include('backend.user.client.partials.show_fields_right')
            </div>

    </div>
        @include('backend.user.client.partials.clientHistory')

    </div>


@stop
