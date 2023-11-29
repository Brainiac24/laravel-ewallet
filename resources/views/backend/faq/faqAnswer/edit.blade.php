@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{ trans('faqAnswer.backend.title') }}</h1>
@stop

@section('content')
    <script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.edit') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::model($FAQAnswer , ['route' => ['admin.FAQQuestions.FAQAnswers.update',$FAQQuestion_id, $FAQAnswer->id ], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-faqAnswer']) !!}
            @include('backend.faq.faqAnswer.partials.fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default'], $secure = null) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-faqAnswer']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop