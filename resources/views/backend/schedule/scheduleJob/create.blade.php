@extends('adminlte::page')

@section('title', trans('scheduleJob.backend.title'))

@section('content_header')
    <h1>{{ trans('scheduleJob.backend.title') }}</h1>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.create') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::open(['route' => 'admin.scheduleJobs.store','class'=>'form-horizontal','id'=>'form-scheduleTypes']) !!}
            @include('backend.schedule.scheduleJob.partials.create_fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default']) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-scheduleTypes']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop


@section('page_js')
    <script>
        $(function(){
            $("#schedule_type_id").change(function () {
                var $schedule_type_id = $(this).val();
                $.get( '{!!route("admin.scheduleJobs.generateView")!!}', { schedule_type_id: $schedule_type_id })
                    .done(function( data ) {
                        $("#generate-form").html(data);
                    });
            })
        })
    </script>
@stop