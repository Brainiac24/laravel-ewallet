@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('accountCategoryType.backend.title') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::model($accountCategoryTypes , ['route' => ['admin.accounts.category.types.update', $accountCategoryTypes->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-category']) !!}
            @include('backend.account.accountCategoryType.partials.fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-category']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop