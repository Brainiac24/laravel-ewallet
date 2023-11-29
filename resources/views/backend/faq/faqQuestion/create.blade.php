@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('faqQuestion.backend.title') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::open(['route' => 'admin.FAQQuestions.store','class'=>'form-horizontal','id'=>'form-faqQuestion']) !!}
            @include('backend.faq.faqQuestion.partials.fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-faqQuestion']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop