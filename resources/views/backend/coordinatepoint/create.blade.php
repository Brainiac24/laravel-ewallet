@extends('adminlte::page')

@section('title', trans('attestations.backend.attestation'))

@section('content_header')
    <h1>{{ trans('coordinatePoint.backend.title') }}</h1>
    <link rel="stylesheet" href="{{asset('vendor/leaflet/leaflet.css')}}" />
    <script src="{{asset('vendor/leaflet/leaflet.js')}}"></script>
@stop

@section('content')
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        #map {
            width: 100%;
            height: 400px;
        }
    </style>
    <div id='map'></div>
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
            }
        };

        var map = L.map('map').setView([ {{40.277466}}, {{69.641392}}], 17);
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
        var mainOfficeIcon = new LeafIcon({iconUrl: '{{asset('/vendor/leaflet/images/marker-icon.png')}}'});
        marker2 = L.marker([ {{40.277466}}, {{69.641392}}], {icon: mainOfficeIcon , draggable:true}).bindPopup("{{''}} ").addTo(map);
        marker2.on('drag', function(event){
            var position = marker2.getLatLng();
            var lat = document.getElementById("latitude");
            var lon = document.getElementById("longitude");
            lat.value=position.lat;
            lon.value= position.lng;
        });
    </script>
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('actions.general.create') }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('backend.errors.errors')
            {!! Form::open(['route' => 'admin.coordinatepoints.store','class'=>'form-horizontal','id'=>'form-category']) !!}
            @include('backend.coordinatepoint.partials.fields')
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
            {!!  link_to(URL::previous(), trans('actions.general.cancel'), ['class' => 'btn btn-default']) !!}
            {!! Form::submit(trans('actions.general.save'), ['class' => 'btn btn-primary','form'=>'form-category']) !!}
        </div><!-- box-footer -->
    </div><!-- /.box -->
@stop