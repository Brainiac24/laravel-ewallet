@extends('adminlte::page')

@section('title',  "AdminLTE ")

@section('content_header')
    <h1>{{ trans('reports.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.errors')
    @include('backend.errors.error')
    @include('backend.reports.partials.search_box')
    <script src="{{asset('vendor/grid/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/grid/w2ui.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/grid/w2ui.min.css')}}"/>
@if ($type_code != "default")
    <div class="box box-solid">
        <style>
            .myPaddingClass {
                padding: 6px 12px;
            }
            .form-group {
                margin-bottom: 15px !important;
            }
            .control-label {
                padding-right: 15px !important;
            }
        </style>
        <div id="grid" style="width: 100%; min-height: 700px; max-height: 1000px;"></div>

        <div class="box-footer">
            @if(isset(${$type_code}))
                {{${$type_code}->render() }}
            @endif
        </div><!-- box-footer -->

        `
    </div><!-- /.box -->
    <script type="text/javascript">
        jQuery(function ($) {
            try {
                console.log(document.getElementsByTagName('template')[0]);
                $('#grid').w2grid({
                    name: 'grid',
                    multiSelect: false,
                    reorderColumns: true,
                    show: {
                        toolbar: true,
                        toolbarReload: false,
                        footer: true,
                        toolbarAdd: false,
                        toolbarDelete: false,
                        toolbarSearch: false,
                        toolbarInput: false,
                        toolbarEdit: false

                    },
                    toolbar: {

                    },
                    columns: [
                        @include('backend.reports.partials.columns.'.$type_code.'')
                    ],

                    records: [
                        @include('backend.reports.partials.tables.'.$type_code.'')
                    ]
                });
            } catch (e) {
                console.log(e)
            }


        });
    </script>
@endif
@stop

@section('page_js')
    <script>
        $(function(){
            $("#report_type_id").change(function () {
                var $report_type_id = $(this).val();
                $.get( '{!!route("admin.reports.searchFileds")!!}', { report_type_id: $report_type_id })
                    .done(function( data ) {
                        $("#serchbox-fields").html(data);
                });
            })
        })
    </script>
@stop

