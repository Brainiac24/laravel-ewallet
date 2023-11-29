<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.json-viewer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jsoneditor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom2.css') }}">

    <!-- Photoviewer  -->
    <link rel="stylesheet" href="{{ asset('vendor/photoviewer/css/photoviewer.min.css') }}" rel="stylesheet">

@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
        <link rel="stylesheet" href="{{asset('vendor/select2/4.0.3/css/select2.css')}} ">
@endif

@if(config('adminlte.plugins.datepicker'))
    <!-- Select2 -->
        <link rel="stylesheet" href="{{asset('vendor/select2/4.0.3/css/select2.css')}}">
@endif

<!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->
        <link rel="stylesheet" href="{{asset('vendor/datatables/1.10.15/css/jquery.dataTables.min.css')}}">
    @endif

    @yield('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="{{asset('vendor/html5shiv/3.7.3/js/html5shiv.min.js')}}"></script>
    <!--[if lt IE 9]>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.json-viewer.js') }}"></script>
<script src="{{ asset('js/jsoneditor-minimalist.min.js') }}"></script>

<!-- Photoviewer  -->
<script src="{{ asset('vendor/photoviewer/js/photoviewer.min.js') }}"></script>

@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
    <script src="{{asset('vendor/select2/4.0.3/js/select2.min.js')}}"></script>
@endif

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->
    <script src="{{asset('vendor/datatables/1.10.15/js/jquery.dataTables.min.js')}} "></script>
@endif

@if(config('adminlte.plugins.chartjs'))
    <!-- ChartJS -->
    <script src="{{asset('vendor/chart/2.7.0/Chart.bundle.min.js')}}"></script>
@endif

@if(config('adminlte.plugins.datepicker'))
    <!-- Select2 -->
    <script src="{{asset('vendor/select2/4.0.3/js/select2.min.js')}}"></script>
@endif
<script>
    $(document).ready(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        // $('.locations-select2').select2({
        //     ajax: {
        //       url: function(){
        //             return $(this).data('url');
        //         },
        //       dataType: 'json',
        //       data: function (params) {
        //
        //         if($(this).attr('name') == 'region_id'){
        //
        //
        //
        //         }else if($(this).attr('name') == 'area_id'){
        //
        //         }
        //
        //         var query = {
        //           search: params.term,
        //         }
        //
        //         // Query parameters will be ?search=[term]
        //         return query;
        //       },
        //       processResults: function (res) {
        //         // Tranforms the top-level key of the response object from 'items' to 'results'
        //        //alert(JSON.stringify(res));
        //
        //         return {
        //           results: res.data.results
        //         };
        //       }
        //     }
        //   });

        $('[data-toggle="popover"]').popover();

        var options = {
            collapsed: true,
            withQuotes: false
        };

        $('.json-params').each(function () {
            try {
                if ($(this).html() != null) {
                    var input = eval('(' + $(this).html() + ')');
                    $(this).jsonViewer(input, options);
                }
            }  catch (error) {
                return alert($(this).html() + " \nCannot eval JSON: " + error);
            }
        });

        var options2 = {
            collapsed: false,
            withQuotes: false
        };
        $('.json-params-uncollapsed').each(function () {
            try {
                if ($(this).html() != null) {
                    var input = eval('(' + $(this).html() + ')');
                    $(this).jsonViewer(input, options2);
                }
            } catch (error) {
                return alert($(this).html() + " \nCannot eval JSON: " + error);
            }
        });


        var container = document.getElementById('jsoneditor');
        var json = null;

        try {
            json = JSON.parse($('input[name="params_json"]').val());
        } catch (e) {

        }
        var editor = null;
        var options2 = {
            mode: 'tree',
            modes: ['code', 'form', 'text', 'tree', 'view'], // allowed modes
            onError: function (err) {
                alert(err.toString());
            },
            onChange: function (data) {
                $('input[name="params_json"]').val(editor.getText());
            }
        };

        var editor = new JSONEditor(container, options2, json);


       


    })
</script>
@yield('adminlte_js')
@yield('page_js')

</body>
</html>
