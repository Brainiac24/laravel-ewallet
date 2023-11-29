@extends('adminlte::page')

@section('title', 'AdminLTE ')

@section('content_header')
    <h1>{{ trans('coordinatePoint.backend.title') }}</h1>
@stop

@section('content')
    @include('backend.errors.success')

    @include('backend.coordinatepoint.partials.search_box')   {{--KAMOL--}}
    <link rel="stylesheet" href="{{asset('vendor/leaflet/leaflet.css')}}" />
    <script src="{{asset('vendor/leaflet/leaflet.js')}}"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        #map {
            width: 100%;
            height: 500px;
            margin-bottom:10px;
        }
        #addmarkerform {
            height: 0px;
            opacity:0 ;
            margin-bottom:10px;
            background: #ff793c;
            transition: all linear 0.2s;
        }
        #addmarkerform * {
            padding: 4px;
            border: 1px solid #CCC;
        }
    </style>
    <div id='map' style=""></div>



    <script>
        function addMarker(e){
            if (window.event.ctrlKey) {
                MarkersCount = MarkersCount +1;
                if (MarkersCount==1){
                    var newMarker = new L.marker(e.latlng,{draggable:'true'}).addTo(map);
                    newMarker.on('drag', function(event){
                        var marker = event.target;
                        var position = newMarker.getLatLng();
                        var lat = document.getElementById("latitude");
                        var lon = document.getElementById("longitude");
                        lat.value=position.lat;
                        lon.value= position.lng;
                    });
                    var position = newMarker.getLatLng();
                    var lat = document.getElementById("latitude");
                    var lon = document.getElementById("longitude");
                    lat.value=position.lat;
                    lon.value= position.lng;

                }
                document.getElementById("addmarkerform").setAttribute("style", " opacity:1 ; height:70px; padding: 20px; ");
                document.getElementById("hintText").setAttribute("style", "display:none");
            }
        };

        var map = L.map('map').setView([40.27747, 69.64125], 17);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: ''
        }).addTo(map);

        var LeafIcon = L.Icon.extend({
            options: {
                shadowUrl: '',
                iconSize:     [26,32],
                shadowSize:   [25, 32],
                iconAnchor:   [11, 47],
                shadowAnchor: [2, 31],
                popupAnchor:  [-3, -76]
            }
        });
        var terminalIcon = new LeafIcon({iconUrl:  '{{asset('/vendor/leaflet/images/terminal.png')}}'  }), mainOfficeIcon = new LeafIcon({iconUrl: '{{asset('/vendor/leaflet/images/mainoffice.png')}}'}), bancomats = new LeafIcon({iconUrl: '{{asset('vendor/leaflet/images/bankomat.png')}}' });
        @foreach($coordinatePoints as $item)
        L.marker([{{$item->latitude}}, {{$item->longitude}}], {icon: <?php echo config('coordinatepoint.icons')[$item->object_type];?> }  ).bindPopup("{{$item->name}} <br>{{$item->address}}<br><br><a href='{{route('admin.coordinatepoints.delete', [$item->id])}}'> Удалить  </a><br><a href='{{route('admin.coordinatepoints.edit', [$item->id])}}'> Редактировать  </a> ").addTo(map);
        @endforeach
        map.on('click', addMarker);
        var MarkersCount=0;
        //test for update CRUD
    </script>


    <script src="{{asset('vendor/grid/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/grid/w2ui.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/grid/w2ui.min.css')}}"/>
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
        <div id="grid" style="width: 100%; min-height: 700px; max-height: 1000px; height: 100%;"></div>
        <div class="box-footer">
            {{$coordinatePoints->render() }}
        </div><!-- box-footer -->
    </div><!-- /.box -->
    <script type="text/javascript">
        var currentUrl = 0 ;
        jQuery(function ($) {
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
                    toolbarEdit: false,
                },
                toolbar: {
                    onClick: function (event) {
                        if (event.target == 'append') window.open('{{url()->current()}}' + "/create", "_self");
                        if (event.target == 'show') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '', "_self");
                        if (event.target == 'edit') window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/edit', "_self");
                        if (event.target == 'delete')
                            w2confirm('Вы хотите заблокировать ?')
                                .yes(function () {
                                    window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/delete', "_self");
                                })
                                .no(function () {
                                    //No
                                });
                        if (event.target == 'unlock')
                            w2confirm('Вы хотите разблокировать?')
                                .yes(function () {
                                    window.open('{{url()->current()}}' + "/" + w2ui.grid.getSelection() + '/unlock', "_self");
                                })
                                .no(function () {
                                    //No
                                });
                    },
                    items: [
                        {type: 'button', id: 'append', text: 'Добавить', icon: 'w2ui-icon-plus', disabled: false},
                        {type: 'button', id: 'show', text: 'Детально', icon: 'w2ui-icon-check', disabled: true},
                        {
                            type: 'button',
                            id: 'edit',
                            text: 'Редактировать',
                            icon: 'w2ui-icon-pencil',
                            disabled: true
                        },
                        {type: 'button', id: 'delete', text: 'Отключить', icon: 'fa fa-eraser', disabled: true},
                        {type: 'break', id: 'break0'},
                    ]
                },
                columns: [
                    {field: 'recid', caption: 'ID', size: '50px', sortable: true, attr: 'align=left'},
                    {
                        field: 'name',
                        caption: '{{ trans("coordinatePoint.backend.table.name") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'address',
                        caption: '{{ trans("coordinatePoint.backend.table.address") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'longitude',
                        caption: '{{ trans("coordinatePoint.backend.table.longitude") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'latitude',
                        caption: '{{ trans("coordinatePoint.backend.table.latitude") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'object_type',
                        caption: '{{ trans("coordinatePoint.backend.table.object_type") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'coordinate_point_type_id',
                        caption: '{{ trans("coordinatePoint.backend.table.coordinate_point_type_id") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'coordinate_point_workday_id',
                        caption: '{{ trans("coordinatePoint.backend.table.coordinate_point_workday_id") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'coordinate_point_city_id',
                        caption: '{{ trans('coordinatePoint.backend.table.coordinate_point_city_id') }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'merchant_id',
                        caption: '{{ trans("coordinatePoint.backend.table.merchant_id") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },{
                        field: 'is_active',
                        caption: '{{ trans("coordinatePoint.backend.table.is_active") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'updated_at',
                        caption: '{{ trans("gateways.backend.table.updated_at") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                    {
                        field: 'created_at',
                        caption: '{{ trans("gateways.backend.table.created_at") }}',
                        size: '50%',
                        sortable: true,
                        attr: 'align=left'
                    },
                ],
                onSelect: function (event) {
                    this.toolbar.enable('edit');
                    this.toolbar.enable('show');
                    this.toolbar.enable('delete');
                },
                onUnselect: function (event) {
                    this.toolbar.disable('edit');
                    this.toolbar.disable('show');
                    this.toolbar.disable('delete');
                },
                records: [
                    @include('backend.coordinatepoint.partials.table')
                ]
            });
        });
    </script>
 @stop