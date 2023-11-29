@extends('adminlte::page')

@section('title', trans('alerts.general.access_forbidden'))

@section('content')
    <div class="error-page">
        <h3 class="headline text-yellow" style="margin-top: -30px"> 403</h3>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i>  {{ trans('alerts.general.access_forbidden') }}.</h3>
            <p>
                <a href='{{ route('admin.dashboard') }}'>{{ trans('alerts.general.return_to_dashboard') }}</a>
            </p>
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
@stop