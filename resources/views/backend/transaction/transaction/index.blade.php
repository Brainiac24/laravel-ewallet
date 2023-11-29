@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('transaction.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.error')
    @include('backend.errors.errors')
    @include('backend.transaction.transaction.partials.search_box')   {{--KAMOL--}}
    @include('backend.transaction.transaction.partials.table')   {{--KAMOL--}}
@stop