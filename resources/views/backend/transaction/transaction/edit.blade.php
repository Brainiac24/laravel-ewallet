@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('transaction.backend.title') }}</h1>
@stop

{{--@section('content')--}}
    {{--<div class="box box-solid">--}}
        {{--<div class="box-header with-border">--}}
            {{--<h3 class="box-title">{{ trans('actions.general.edit') }}</h3>--}}
        {{--</div><!-- /.box-header -->--}}
        {{--<div class="box-body">--}}
            {{--@include('backend.errors.errors')--}}
            {{--{!! Form::model($transactionsStatusRepository , ['route' => ['admin.transactions.status.update', $transactionsStatusRepository->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-category']) !!}--}}
            {{--@include('backend.transaction.transactionStatus.partials.fields')--}}
            {{--{!! Form::close() !!}--}}
        {{--</div><!-- /.box-body -->--}}
        {{--<div class="box-footer">--}}
            {{--{!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}--}}
            {{--{!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-category']) !!}--}}
        {{--</div><!-- box-footer -->--}}
    {{--</div><!-- /.box -->--}}
{{--@stop--}}

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::model($transaction , ['route' => ['admin.transactions.update', $transaction->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-category','enctype'=>"multipart/form-data"]) !!}
            @include('backend.transaction.transaction.partials.fields')
            {!! Form::close() !!}
            {!! Form::model($transaction, ['route' => ['admin.transactions.changeTransactionSyncStatus', $transaction->id], 'method' => 'post','class'=>'form-horizontal','id'=>'form-change-transaction_sync_status']) !!}
            @include('backend.transaction.transaction.partials.field_sync_status')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop
@section('js')
<script type="text/javascript">
    const continueRuleMessages = {!! $transactionStatusMessages  !!};
            console.log(continueRuleMessages);
            console.log(continueRuleMessages['1a49f5cd-4a2c-11e9-9335-b06ebfbfa715']);
            const transactionStatusId = $('#transaction_status_id');
            console.log(transactionStatusId);
            transactionStatusId.on('change', (ev)=>{
                const selected = ev.target.value;

                if(continueRuleMessages[selected]!= undefined){
                    const messageBox = $('#continue_rule_message');
                    messageBox.html(continueRuleMessages[selected]);
                }

            });
</script>
@endsection
