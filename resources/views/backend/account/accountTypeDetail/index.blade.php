@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('accountTypeDetail.backend.title') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        {{-- @ability('sadmin', 'role-operation-create') --}}
        <div class="box-header with-border">
            <h3 class="box-title"><a href="{{ route('admin.accounts.types-detail.create') }}"
                                     class="btn btn-primary">{{ trans('actions.general.create') }}</a></h3>
        </div>
        {{-- @endability --}}
        <div class="box-body">
            @include('backend.errors.success')
            @include('backend.errors.error')
            @include('backend.account.accountTypeDetail.partials.table')
        </div><!-- /.box-body -->
        <div class="box-footer">
            {{ $accountTypeDetails->render() }}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop