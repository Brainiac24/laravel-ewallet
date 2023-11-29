@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('transaction.backend.title') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.view') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            {{-- {!! Form::open($role, ['route' => ['roles.update', $role->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-roles']) !!} --}}
            @include('backend.transaction.transaction.partials.show_fields')


            {{-- {!! Form::close() !!} --}}
        </div><!-- /.box-body -->

        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.back'), ['class' => 'btn btn-default'], $secure = null) !!}
            @if(Auth::user()->ability('sadmin','transaction-can-resend'))
            {{--<a type="submit" class="btn" style="background: #407ee1; color: #FFFFFF" href="{!! route('admin.transactions.resend', [$transaction->id]) !!}"
               onclick="return confirm('{{ trans('alerts.general.confirm_resend') }}')">
                Заново отравить в очередь
            </a>
            {{-- <a type="submit" class="btn" style="background: #0070da; color: #FFFFFF" href="{!! route('admin.transactions.return', [$transaction->id]) !!}"
               onclick="return confirm('{{ trans('alerts.general.return') }}')">
                Ликвидация транзакции
            </a>--}}
            @endif
        </div><!-- box-footer -->
    </div><!-- /.box -->

    <div class="box box-solid">
        <div class="box-header with-border greenClass">
            <h3 class="box-title">{{ trans('transactionHistory.backend.title_current') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            {{-- {!! Form::open($role, ['route' => ['roles.update', $role->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-roles']) !!} --}}
            @include('backend.transaction.transaction.partials.show_history')
            {{-- {!! Form::close() !!} --}}
        </div><!-- /.box-body -->
    </div>
@stop