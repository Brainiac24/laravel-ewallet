@extends('adminlte::page')

@section('title', trans('docApi.backend.title'))

@section('content_header')
    <h1>{{ trans('docApi.backend.title') }}</h1>
@stop

@section('content')


    @include('backend.errors.success')
    @include('backend.errors.error')
    
    <script src="{{asset('vendor/grid/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('css/style_2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/html.css') }}">
    <link rel="stylesheet" href="{{ asset('css/annotated.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script type='text/javascript' src="{{ asset('vendor/jsondiffpatch/dist/js/jsondiffpatch.umd.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('vendor/codemirror/3.21.0/js/codemirror.js')}}"></script>
    <script type="text/javascript" src="{{ asset('vendor/codemirror/3.21.0/mode/js/javascript.min.js')}}"></script>
    <script src="{{asset('js/jquery.json-editor.min.js')}}"></script>
    <script src="{{asset('js/jquery.json-viewer.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>



    <div class="top-1">
        <div class="middle-1">
            <div class="col-1">
                <div class="top-t-1 b-r-none">API - v1</div>
            </div>
            <div class="col-1">
                <div class="top-t-1 b-r-none">API - v2</div>
            </div>
            <div class="col-1">
                <div class="top-t-1 b-r-none">DIFF</div>
            </div>
        </div>
    </div>
    <div class="wrapper-2">

    
        @include('backend.docApis.partials.apis')


    </div>


    
@stop