@extends('adminlte::page')

@section('title', trans('orderComment.backend.title'))

@section('content_header')
    <h1>{{ trans('orderComment.backend.title')}}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.create') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::open(['route' => 'admin.order.orderComment.store','class'=>'form-horizontal','id'=>'form-category']) !!}
            @include('backend.order.orderComment.partials.fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default']) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-category']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop

@section('page_js')
    <script>
        var remote_identification='{{\App\Services\Common\Helpers\OrderType::REMOTE_IDENTIFICATION}}';
        $("#order_type_id").change(function () {
            if ($(this).val()==remote_identification){
                $('.div_code').show();
            } else {
                $('#code').val('');
                $('.div_code').hide();
            }
        });
    </script>
@stop