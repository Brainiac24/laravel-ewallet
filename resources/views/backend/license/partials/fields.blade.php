<link rel="stylesheet" type="text/css" href="{{asset('vendor/html5editor/bootstrap.min.css')}}"></link>
<link rel="stylesheet" type="text/css" href="{{asset('vendor/html5editor/bootstrap-theme.min.css')}}"></link>
<link rel="stylesheet" type="text/css" href="{{asset('vendor/html5editor/bootstrap3-wysihtml5.min.css')}}"></link>
<style type="text/css" media="screen">
    .btn.jumbo {
        font-size: 20px;
        font-weight: normal;
        padding: 14px 24px;
        margin-right: 10px;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
    }
</style>
{!! Form::textarea('license_text',$license,  ['placeholder'=>'Адрес обьекта','class'=>'textarea','style'=>"width: 100%; height: 500px; font-size: 14px; line-height: 18px;margin-top:0px"]) !!}
<script src="{{asset('vendor/html5editor/wysihtml5x-toolbar.min.js')}}"></script>
<script src="{{asset('vendor/html5editor/jquery.min.js')}}"></script>
<script src="{{asset('vendor/html5editor/handlebars.runtime.min.js')}}"></script>
<script src="{{asset('vendor/html5editor/bootstrap3-wysihtml5.min.js')}}"></script>
<script> $('.textarea').wysihtml5({toolbar: {fa: true}}); </script>