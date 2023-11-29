@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('fileManager.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')
    @include('backend.errors.error')
{{--    <script type="text/javascript" src="{{asset('vendor/grid/w2ui.min.js')}}"></script>--}}
    <div class="box box-solid">
        @include('backend.fileManager.partials.navbar')
        @include('backend.fileManager.partials.table')
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
            .selected-row{
                background-color: #C7E4E3;
            }
            table tr .fa{
                margin-right: 8px
            }

            table tr td {
                font-family: Verdana, Arial, sans-serif;
                font-size: 13px !important;
            }table tr th {
                 font-size: 14px !important;
                 font-family: Verdana, Arial, sans-serif;
             }
            .link {
                color: #696969;
                font-size: 14px;
            }
            .table-responsive{
                margin-left: 10px;
                margin-right: 10px;
            }.upload{
                 margin-left: 10px;
                 margin-right: 10px;
             }.newItem{
                  margin-left: 10px;
                  /*margin-right: 10px;*/
              }
            .box-header{
                font-size: 14px !important;
                font-family: Verdana, Arial, sans-serif;
                margin-right: 10px;
            }
        </style>
    </div><!-- /.box -->

@stop