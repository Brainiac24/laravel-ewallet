@extends('adminlte::page')

@section('title', trans('cashback.backend.title'))

@section('content_header')
    <h1>{{ trans('cashbackItem.backend.title')}}</h1>
@stop

@section('content')
    @include('backend.errors.error')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.create') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
{{--            {!! Form::model($data, ['route' => ['admin.cashback.items.update', $cashback_id,$data->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-category']) !!}--}}

            {!! Form::open(['route' => ['admin.cashback.items.store',$id,null] ,'class'=>'form-horizontal','id'=>'form-category']) !!}
            @include('backend.cashback.cashbackItem.partials.create_fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default']) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-category']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop