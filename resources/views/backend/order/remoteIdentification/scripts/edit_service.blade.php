<script>
    var $remoteIdentificationService =
    {
        reject : function () {
            $('#form-remote-identification').attr("action","{{ route('admin.remoteIdentification.reject', ["id" => $data->id]) }}");
            $('#confirmRejectModal').modal('show');
        },

        update : function () {
            ajaxLoader.on();
            $.ajax({
                url: "{{ route('admin.remoteIdentification.update', ["id" => $data->id]) }}",
                data : $("#form-remote-identification").serialize(),
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    window.location.href = '{{route("admin.remoteIdentification.edit",["id" => $data->id,"url" => \Request::get("url")])}}'
                },
                error: function (data) {
                    errorModal(data);
                    ajaxLoader.off();
                }
            });
        },

        acceptCheckWithNalog : function () {
            ajaxLoader.on();
            $.ajax({
                url: "{{ route('admin.remoteIdentification.getInfoNalog', ["id" => $data->id]) }}",
                data : $("#form-remote-identification").serialize(),
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    if(response.code == "OK")
                    {
                        var template = $("template#check-nalog-inn-modal-body").html();
                            template =
                            template.replace("{ew-fio}",'{{$data->remote_identification_payload_params["profile"]["Items"]["full_name"] ?? ""}}')
                                    .replace("{ew-inn}", '{{ $data->remote_identification_payload_params["profile"]["Items"]["inn"] ?? null}}')
                                    .replace("{nalog-fio}", response.data.fullname)
                                    .replace("{nalog-inn}", response.data.inn);

                        $('#checkNalogInnModal .modal-body').html(template);
                        $("#checkNalogInnModal").modal("show");
                    }
                    ajaxLoader.off();
                },
                error: function (data) {
                    errorModal(data);
                    ajaxLoader.off();
                }
            });
        },

        accept : function () {
            ajaxLoader.on();
            $.ajax({
                url: "{{ route('admin.remoteIdentification.accept', ["id" => $data->id]) }}",
                data : $("#form-remote-identification").serialize(),
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    if(response.code == 0)
                    {
                        ajaxLoader.off();
                        $('#btn-accept').hide();
                        $('#btn-reject').hide();
                        $('#btn-search').removeAttr("disabled");
                        $('#btn-search').click();
                        $('#profile\\[inn\\]').attr("readonly",true);

                        if($("#checkNalogInnModal")!=undefined)
                        {
                            $('#btn-accept-check-nalog').hide();
                            $("#checkNalogInnModal").modal("hide");
                        }
                    }
                },
                error: function (data) {
                    ajaxLoader.off();
                    if($("#checkNalogInnModal")!=undefined) {
                        $("#checkNalogInnModal").modal("hide");
                    }
                    errorModal(data);
                }
            });
        },

        createClient: function () {
            ajaxLoader.on();
            $.ajax({
                url: "{{ route('admin.remoteIdentification.createClient', ["id" => $data->id]) }}",
                type: "GET",
                dataType: 'json',
                success: function (response) {
                    var jobId = response.data.job_id;
                    var interval =
                        setInterval(function () {
                            $.ajax({
                                data: {job_id:response.data.job_id,_token: "{{ csrf_token() }}"},
                                url: "{{ route('admin.remoteIdentification.checkJob', ["id" => $data->id]) }}",
                                type: "POST",
                                dataType: 'json',
                                success: function (response) {
                                    if(response.code != 0) {
                                        ajaxLoader.off();
                                        $('#createClientModal').modal('hide');

                                        $('#confirmCreateClientModal .message').text(response.message);
                                        $('#confirmCreateClientModal').modal('show');
                                        clearInterval(interval);
                                    }
                                },
                                error: function (data) {
                                    ajaxLoader.off();
                                    $('#createClientModal').modal('hide');
                                    clearInterval(interval);
                                    errorModal(data);
                                }
                            });
                        },2000);
                },
                error: function (data) {
                    ajaxLoader.off();
                    $('#createClientModal').modal('hide');
                    errorModal(data);
                }
            });
        },

        updateClient : function () {
            ajaxLoader.on();
            var $job_id = $("#form-remote-identification-confirm input[name=job_id]").val();
            $.ajax({
                url: "{{ route('admin.remoteIdentification.updateClient', ["id" => $data->id]) }}",
                data: {job_id:$job_id},
                type: "GET",
                dataType: 'json',
                success: function (response) {
                    var jobId = response.data.job_id;
                    var interval =
                        setInterval(function () {
                            $.ajax({
                                data: {job_id:response.data.job_id,_token: "{{ csrf_token() }}"},
                                url: "{{ route('admin.remoteIdentification.checkJob', ["id" => $data->id]) }}",
                                type: "POST",
                                dataType: 'json',
                                success: function (response) {
                                    if(response.code != 0) {
                                        ajaxLoader.off();
                                        $('#confirmSearchModal').modal('hide');
                                        $('#btn-search').click();
                                        clearInterval(interval);
                                    }
                                },
                                error: function (data) {
                                    ajaxLoader.off();
                                    $('#confirmSearchModal').modal('hide');
                                    clearInterval(interval);
                                    errorModal(data);
                                }
                            });
                        },2000);
                },
                error: function (data) {
                    ajaxLoader.off();
                    $('#confirmSearchModal').modal('hide');
                    errorModal(data);
                }
            });
        },
        
        fillRegions : function (countryId) {
            $.ajax({
                url: "{{ route('api.v1.regions')}}",
                data : {country_id : countryId},
                type: "GET",
                dataType: 'json',
                success: function (response) {
                    $("#profile\\[region_id\\]").children().remove().end();
                    $("#profile\\[district_id\\]").children().remove().end();
                    $("#profile\\[city_id\\]").children().remove().end();
                    $("#profile\\[region_id\\]")
                        .append('<option value=""></option>');
                    $.each(response.data.results, function (key, value) {
                        $("#profile\\[region_id\\]")
                            .append('<option value="'+value.id+'">'+ value.text +'</option>');
                    });

                    $("#profile\\[region_id\\]").select2().change();

                },
                error: function (data) {
                    errorModal(data);
                }
            });
        },

        fillAreas : function (regionId) {
            $.ajax({
                url: "{{ route('api.v1.areas')}}",
                data : {region_id : regionId},
                type: "GET",
                dataType: 'json',
                success: function (response) {
                    $("#profile\\[district_id\\]").children().remove().end();
                    $("#profile\\[city_id\\]").children().remove().end();
                    $("#profile\\[district_id\\]")
                        .append('<option value=""></option>');
                    $.each(response.data.results, function (key, value) {
                        $("#profile\\[district_id\\]")
                            .append('<option value="'+value.id+'">'+ value.text +'</option>');
                    });

                    $("#profile\\[district_id\\]").select2().change();

                },
                error: function (data) {
                    errorModal(data);
                }
            });
        },

        fillCities : function (districtId) {
            $.ajax({
                url: "{{ route('api.v1.cities')}}",
                data : {area_id : districtId},
                type: "GET",
                dataType: 'json',
                success: function (response) {
                    $("#profile\\[city_id\\]").children().remove().end();

                    $("#profile\\[city_id\\]")
                        .append('<option value=""></option>');
                    $.each(response.data.results, function (key, value) {
                        $("#profile\\[city_id\\]")
                            .append('<option value="'+value.id+'">'+ value.text +'</option>');
                    });

                    $("#profile\\[city_id\\]").select2();

                },
                error: function (data) {
                    errorModal(data);
                }
            });
        },

        searchClient : function ($selectorId, $attempt) {
            ajaxLoader.on();
            $.ajax({
                url: "{{ route('admin.remoteIdentification.search', ["id" => $data->id]) }}",
                data: {_token: "{{ csrf_token() }}", attempt : $attempt},
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    var jobId = response.data.job_id;
                    var interval =
                        setInterval(function () {
                            $.ajax({
                                data: {job_id:jobId, _token: "{{ csrf_token() }}"},
                                url: "{{ route('admin.remoteIdentification.checkJob', ["id" => $data->id]) }}",
                                type: "POST",
                                dataType: 'json',
                                success: function (response) {
                                    if(response.code != 0) {
                                        if($selectorId == "btn-search-pre-processing" && (response.code == 3 || response.code == 2)) {
                                            $('#confirmCreateClientModal .message').text("Пользователь не идентифицирован с другим номером, можете продолжать обработку");
                                            $('#confirmCreateClientModal').modal('show');
                                        } else if(response.code == 3) {
                                            if($attempt === 1){
                                                clearInterval(interval);
                                                return $remoteIdentificationService.searchClient($selectorId, 2);
                                            }else {
                                                $('#createClientModal .message').text(response.message);
                                                $('#createClientModal').modal('show');
                                            }
                                        }else if(response.code == 2){
                                            $remoteIdentificationService.showSearchResultModal(jobId, response);
                                        }else if(response.code == 1){
                                            $remoteIdentificationService.showSearchFoundManyClientModal(response);
                                        }
                                        ajaxLoader.off();
                                        clearInterval(interval);
                                    }
                                },
                                error: function (data) {
                                    ajaxLoader.off();
                                    clearInterval(interval);
                                    errorModal(data);
                                }
                            });
                        },3000);
                },
                error: function (data) {
                    ajaxLoader.off();
                    errorModal(data);
                }
            });
        },

        showSearchResultModal : function(jobId, response)
        {
            $('#confirmSearchModal input[name=job_id]').val(jobId);
            $('#confirmSearchModal .modal-header .modal-title').text(response.message);

            <?php
                $ew_date_birth = $data->remote_identification_payload_params["profile"]["Items"]["birth_date"] ?? "";
                if(!empty($ew_date_birth)){
                    $ew_date_birth = Carbon\Carbon::createFromFormat("Y-m-d", $ew_date_birth)->format("d-m-Y");
                }
            ?>

            var modalBodyTemplate = $("template#search-result-modal-body").html();
                modalBodyTemplate =
                modalBodyTemplate.replace("{abs_fullname}", response.data[0].last_name+" "+response.data[0].first_name+ " "+response.data[0].middle_name)
                    .replace("{abs_passport}", response.data[0].passport_seria+response.data[0].passport_number)
                    .replace("{abs_inn}", response.data[0].inn)
                    .replace("{abs_date_birth}", response.data[0].date_birth)

                    .replace("{ew_fullname}", '{{$data->remote_identification_payload_params["profile"]["Items"]["full_name"] ?? ""}}')
                    .replace("{ew_passport}", '{{$data->remote_identification_payload_params["profile"]["Items"]["passport_seria"] ?? ""}}{{ $data->remote_identification_payload_params["profile"]["Items"]["passport_number"]?? ""}}')
                    .replace("{ew_inn}", '{{$data->remote_identification_payload_params["profile"]["Items"]["inn"] ?? ""}}')
                    .replace("{ew_date_birth}", '{{$ew_date_birth}}')

                    .replace("{fullname_equal_icon}", $remoteIdentificationService.getSearchResultEqualIcon(response.full_name_equal))
                    .replace("{passport_equal_icon}", $remoteIdentificationService.getSearchResultEqualIcon(response.passport_seria_equal==true && response.passport_number_equal==true))
                    .replace("{inn_equal_icon}", $remoteIdentificationService.getSearchResultEqualIcon(response.inn_equal))
                    .replace("{date_birth_equal_icon}", $remoteIdentificationService.getSearchResultEqualIcon(response.date_birth_equal))
                ;

            $('#confirmSearchModal .modal-body').html(modalBodyTemplate);
            if(response.update_client == true) {
                $("#confirmSearchModal .btn-update-client").show();
            }else {
                $("#confirmSearchModal .btn-update-client").hide();
            }
            $('#confirmSearchModal').modal('show');
        },

        showSearchFoundManyClientModal : function(response)
        {
            $('#foundManyClientModal .modal-header .modal-title').text(response.message);
            $('#foundManyClientModal .modal-body').html('');
            var increment = 0;
            $.each(response.data, function (key, value) {
                var foundManyClientModalBodyTemplate = $("template#found-many-client-modal-body").html();
                    foundManyClientModalBodyTemplate =
                    foundManyClientModalBodyTemplate.replace("{increment}" , ++increment)
                                                    .replace("{fullname}", value.last_name + " " +value.first_name + " "+value.middle_name)
                                                    .replace("{passport}", value.passport_seria+value.passport_number)
                                                    .replace("{inn}", value.inn);

                $('#foundManyClientModal .modal-body').append(foundManyClientModalBodyTemplate);
            });

            $('#foundManyClientModal').modal('show');
        },

        getSearchResultEqualIcon : function(equal)
        {
            if(equal == true)
                return '<i style="color: green;" class="fa fa-check" aria-hidden="true"></i>';

            return '<i style="color: red;" class="fa fa-times" aria-hidden="true"></i>';
        },

        saveChangedImg : function(url, gradus, flip)
        {
            $.ajax({
                dataType: "json",
                url: url,
                data: {'gradus' : gradus, 'flip' : flip},
                success: function (response) {
                    if(response.code == 0){
                        $('#messageModal .modal-body').html("<h4>Фото успешно изменен! Через некоторые время будет пременено изменение</h4>");
                        $('#messageModal').modal('show');
                    }
                    ajaxLoader.off();
                },
                error: function (data) {
                    errorModal(data);
                    ajaxLoader.off();
                }
            });
        },

        fillAdressStr: function()
        {
            var adress_array = [];

            var country = $("#profile\\[country_id\\] option:selected").text();
            var region = $("#profile\\[region_id\\] option:selected").text();
            var district = $("#profile\\[district_id\\] option:selected").text();
            var city = $("#profile\\[city_id\\] option:selected").text();
            var street = $("#profile\\[street\\]").val();
            var house_number = $("#profile\\[house_number\\]").val();
            var housing = $("#profile\\[housing\\]").val();
            var room = $("#profile\\[room\\]").val();

            if(country != "")  adress_array.push(country);
            if(region != "")  adress_array.push(region);
            if(district != "")  adress_array.push(district);
            if(city != "")  adress_array.push(city);
            if(street != "")  adress_array.push(street);
            if(house_number != "")  adress_array.push(house_number);
            if(housing != "")  adress_array.push(housing);
            if(room != "") adress_array.push(room);

            $("#adress_str").val(adress_array.join(", "));
        }
    };

    var ajaxLoader = {
        on:function() {
            $('#ajaxLoaderModal').modal('show');
        },
        off:function () {
            $('#ajaxLoaderModal').modal('hide');
        }
    };

    function errorModal(data) {
        console.log('Error:', data);
        $('#alertModal .modal-body .alert').removeClass("alert-success").addClass("alert-danger");
        if(data.responseJSON.errors != undefined){
            var msErrors = "<ul>";
            $.each(data.responseJSON.errors, function (key, value) {
                msErrors += "<li>" + value + "</li>";
            });
            msErrors += "</ul>";
            $('#alertModal .modal-body .alert').html(msErrors);
        }else {
            $('#alertModal .modal-body .alert').html(data.responseJSON.message);
        }
        $('#alertModal').modal('show');
    }

</script>


<template id="check-nalog-inn-modal-body">
    <h5><b>Данные Эсхата Онлайн:</b></h5>
    ФИО: <i>{ew-fio}</i>
    ИНН: <i>{ew-inn}</i>
    <h5 style="margin-top:10px"><b>Данные ИНН:</b></h5>
    ФИО: <i>{nalog-fio}</i>
    ИНН: <i>{nalog-inn}</i>
</template>


<template id="search-result-modal-body">

    <table class="table table-hover">
        <thead>
            <tr>
                <th></th>
                <th scope="col"></th>
                <th scope="col">Данные Эсхата Онлайн</th>
                <th scope="col">Данные с ABS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{fullname_equal_icon}</td>
                <td><b>ФИО</b></td>
                <td>{ew_fullname}</td>
                <td>{abs_fullname}</td>
                </tr>
            <tr>
                <td>{passport_equal_icon}</td>
                <td><b>Паспорт</b></td>
                <td>{ew_passport}</td>
                <td>{abs_passport}</td>
            </tr>
            <tr>
                <td>{inn_equal_icon}</td>
                <td><b>ИНН</b></td>
                <td>{ew_inn}</td>
                <td>{abs_inn}</td>
                </tr>
            <tr>
                <td>{date_birth_equal_icon}</td>
                <td><b>Дата рождения</b></td>
                <td>{ew_date_birth}</td>
                <td>{abs_date_birth}</td>
            </tr>
        </tbody>
    </table>
</template>

<template id="found-many-client-modal-body">
    <span>{increment}</span>)
    ФИО: <i>{fullname}</i>,
    Паспорт: <i>{passport}</i>,
    ИНН: <i>{inn}</i><br>
</template>