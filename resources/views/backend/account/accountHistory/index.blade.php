@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('accountHistory.backend.title') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        {{-- @ability('sadmin', 'role-operation-create') --}}

        {{-- @endability --}}
        <div class="box-body">
            @include('backend.errors.success')
            @include('backend.errors.error')
            @include('backend.account.accountHistory.partials.table')
        </div><!-- /.box-body -->
        <div class="box-footer">
            {{ $accountHistory->render() }}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop