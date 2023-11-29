
    @if($client->attestation_id == \App\Services\Common\Helpers\Attestation::IDENTIFIED && in_array($client->verification_params_json['is_verified'],[1,2]) && !Auth::user()->can('client-identificate-for-admin'))
        <?php $readonly = true;?>
    @else
        <?php $readonly = false;?>
    @endif

    @if($client->attestation_id == \App\Services\Common\Helpers\Attestation::IDENTIFIED && in_array($client->verification_params_json['is_verified'],[1,2]) && !Auth::user()->can('client-update-lite'))
        <?php $readonlyLite = true;?>
    @else
        <?php $readonlyLite = false;?>
    @endif

<div class="panel-body box-primary">
    <div class="col-md-12 text-center">
        <img src="{{$client->photo??"http://www.appmat.ru/wp-content/uploads/2015/07/no-avatar.jpg"}}"
             width="100" height="100" style="border-radius: 100%">
    </div>
    <div class="col-md-12" style="margin-top:10px">
        {!! Form::model($client , ['route' => ['admin.clients.identificate',$client->id], 'method' => 'patch','class'=>'form-horizontal','id'=>'form-attestation']) !!}
        <table class="table">
            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.id"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{{$client->username}}</td>
            </tr>
            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.last_name"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::text('last_name', null, ['class' => 'form-control required',$readonly==true?'readonly':'']) !!}</td>
            </tr>
            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.first_name"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::text('first_name', null, ['class' => 'form-control required',$readonly==true?'readonly':'']) !!}</td>
            </tr>
            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.middle_name"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::text('middle_name', null, ['class' => 'form-control required',$readonly==true?'readonly':'']) !!}</td>
            </tr>

            <tr>
                <td>
                    <div class="form-group">{!! Form::label('value', trans("client.backend.table.msisdn"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>+{{$client->msisdn }}</td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">{!! Form::label('value', trans("client.backend.table.email"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{{$client->email}}</td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">{!! Form::label('value', trans("client.backend.table.inn"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::text('contacts_json[inn]', null, ['class' => 'form-control',$readonly==true?'readonly':'']) !!}</td>
            </tr>
            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.documentType"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::select('document_type_id', $document_type, [$client->document_type_id??null], ['class' => 'form-control',$readonly==true?'readonly':'']) !!}</td>
            </tr>
            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.dateOfBirth"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::date("contacts_json[date_birth]", (isset($client->contacts_json['date_birth'])?\Carbon\Carbon::parse($client->contacts_json['date_birth'])->format('Y-m-d'):null), ['class' => 'form-control col-sm-12',$readonly==true?'readonly':'']) !!}</td>
            </tr>
            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.gender"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::select('contacts_json[gender]', ["-1"=>"",1=>'Мужской', 0=>'Женский'], [$client->contacts_json["gender"]??null] ,['class' => 'form-control',$readonly==true?'readonly':'']) !!}</td>
            </tr>
            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.passport"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::text('contacts_json[passport]', null, ['class' => 'form-control',$readonly==true?'readonly':'']) !!}</td>
            </tr>
            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.passport_issued_by"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::text('contacts_json[passport_issued_by]', null, ['class' => 'form-control',$readonly==true?'readonly':'']) !!}</td>
            </tr>
        </table>

        <table class="table" style="border: 1px solid #eaeaea;">
            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.citizenship"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::select('country_id', $country, [$client->country_id??null], ['class' => 'form-control',($readonly==true && $readonlyLite == true)?'readonly':'']) !!}</td>
            </tr>
            {{--<tr>--}}
            {{--<td>--}}
            {{--<div class="form-group required">{!! Form::label('value', trans("client.backend.table.region"), ['class' => 'control-label']) !!}</div>--}}
            {{--</td>--}}
            {{--<td>{!! Form::select('region_id', $client->region_id!=null?[$client->region_id => $client->region->name]:[], [$client->region_id??null], ['class' => 'form-control locations-select',$readonly==true?'readonly':'', 'data-url'=> route('regions')]) !!}</td>--}}
            {{--</tr>--}}
            <tr>
                <td>
                    <div class="form-group required">
                        {!! Form::label('region.backend.region_id', trans('region.backend.title').':', ['class' => 'control-label col-sm-2']) !!}

                    </div>
                </td>
                <td>
                    {!! Form::select('region_id', $region , $selectedRegion??null ,['class' => 'form-control']) !!}
                </td>
            </tr>
            {{--<tr>--}}
            {{--<td>--}}
            {{--<div class="form-group required">{!! Form::label('value', trans("client.backend.table.area"), ['class' => 'control-label']) !!}</div>--}}
            {{--</td>--}}
            {{--<td>{!! Form::select('area_id', $client->area_id!=null?[$client->area_id => $client->area->name]:[], [$client->area_id??null], ['class' => 'form-control locations-select',$readonly==true?'readonly':'', 'data-url'=> route('areas')]) !!}</td>--}}
            {{--</tr>--}}
            <tr>
                <td>
                    <div class="form-group required">
                        {!! Form::label('area.backend.area_id', trans('area.backend.title').':', ['class' => 'control-label col-sm-2']) !!}

                    </div>
                </td>
                <td>
                    {!! Form::select('area_id', $area , $selectedArea??null ,['class' => 'form-control']) !!}
                </td>
            </tr>
            {{--<tr>--}}
            {{--<td>--}}
            {{--<div class="form-group required">{!! Form::label('value', trans("client.backend.table.city"), ['class' => 'control-label']) !!}</div>--}}
            {{--</td>--}}
            {{--<td>{!! Form::select('city_id', $client->city_id!=null?[$client->city_id => $client->city->name]:[], [$client->city_id??null], ['class' => 'form-control locations-select2',$readonly==true?'readonly':'', 'data-url'=> route('city')]) !!}</td>--}}
            {{--</tr>--}}
            <tr>
                <td>
                    <div class="form-group required">
                        {!! Form::label('cities.backend.city_id', trans('city.backend.title').':', ['class' => 'control-label col-sm-2']) !!}

                    </div>
                </td>
                <td>
                    {!! Form::select('city_id', $city , $selectedCity??null ,['class' => 'form-control']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.street"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::text('contacts_json[street]', null, ['class' => 'form-control',($readonly==true && $readonlyLite == true)?'readonly':'']) !!}</td>
            </tr>
            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.house"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::text('contacts_json[house]', null, ['class' => 'form-control',($readonly==true && $readonlyLite == true)?'readonly':'']) !!}</td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">{!! Form::label('value', trans("client.backend.table.flat"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::text('contacts_json[flat]', null, ['class' => 'form-control',($readonly==true && $readonlyLite == true)?'readonly':'']) !!}</td>
            </tr>

            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.placeOfBirth"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::select('country_born_id', $country_born, [$client->country_born_id??null], ['class' => 'form-control',($readonly==true && $readonlyLite == true)?'readonly':'']) !!}</td>
            </tr>
            <tr>
                <td>
                    <div class="form-group required">{!! Form::label('value', trans("client.backend.table.documentCreateDate"), ['class' => 'control-label']) !!}</div>
                </td>
                <td>{!! Form::date('contacts_json[documentCreateDate]',$documentCreateDate , ['class' => 'form-control',($readonly==true && $readonlyLite == true)?'readonly':'']) !!}</td>
            </tr>
            <tr>
                <td colspan="2">
                    @if(Auth::user()->can('client-update-lite'))
                        <button class="btn col-md-12" id="identificateEditLiteSubmit" style="background: #00a65a; color:#FFFFFF">Сохранить</button>
                    @endif
                </td>
            </tr>
        </table>

    </div>

    @if($client->attestation_id == \App\Services\Common\Helpers\Attestation::NOT_IDENTIFIED  && ($client->verification_params_json['is_verified'] == 0) )
        @if(Auth::user()->ability('sadmin','client-identificate'))
            <button type="submit" class="btn col-md-12" style="background: #26C6DA; color:#FFFFFF">Идентифицировать
            </button>
        @endif
        
    @else   
        @if(Auth::user()->can('client-identificate-for-admin'))
            <button type="submit" class="btn col-md-12" style="background: #0080FF; color:#FFFFFF">Редактировать
            </button>
        @endif
    @endif
    {!! Form::close() !!}
</div>

    <script type="text/javascript">

        document.addEventListener('DOMContentLoaded', function(){
            // Select Area By Region Change
            $("select[name='region_id']").change(function () {
                // console.log("hello 2");

                var region_id = $(this).val();

                var token = $("input[name='_token']").val();

                $.ajax({

                    url: "<?php echo route('admin.areas.getByRegionId') ?>",

                    method: 'POST',

                    data: {region_id: region_id, _token: token},

                    success: function (data) {

                        $("select[name='area_id']").html('');
                        $("select[name='city_id']").html('');

                        $("select[name='area_id']").html(data.options);
                    }

                });
            });

            // Select City By Area Change
            $("select[name='area_id']").change(function () {

                var area_id = $(this).val();

                var token = $("input[name='_token']").val();

                $.ajax({

                    url: "<?php echo route('admin.cities.getByAreaId') ?>",

                    method: 'POST',

                    data: {area_id: area_id, _token: token},

                    success: function (data) {

                        $("select[name='city_id']").html('');

                        $("select[name='city_id']").html(data.options);
                    }

                });
            });

            $("#identificateEditLiteSubmit").click(function (e) {
                e.preventDefault();
                $("form#form-attestation")
                    .attr("action",'{!! route("admin.clients.updateLite",["id" => $client->id]) !!}')
                    .submit();
            });
        });

    </script>

        <style>
            .form-horizontal .form-group {
                margin-right: 0px;
                margin-left: 0px;
            }
        </style>