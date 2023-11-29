<div class="row">
    <div class="col-sm-8">
        <div class="row">
            <div class='col-sm-2' style="text-decoration: underline;font-style: italic;">
                <p>Данные клиента:</p>
            </div>
        </div>

        <div class="form-group required">
            {!! Form::label('profile[last_name]', trans('remoteIdentification.backend.last_name').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-7'>
                {!! Form::text('profile[last_name]', $data->remote_identification_payload_params["profile"]["Items"]["last_name"] ?? null, ['class' => 'form-control','disabled' => 'disabled']) !!}
            </div>
        </div>

        <div class="form-group required">
            {!! Form::label('profile[first_name]', trans('remoteIdentification.backend.first_name').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-7'>
                {!! Form::text('profile[first_name]', $data->remote_identification_payload_params["profile"]["Items"]["first_name"] ?? null, ['class' => 'form-control','disabled' => 'disabled']) !!}
            </div>
        </div>


        <div class="form-group">
            {!! Form::label('profile[middle_name]', trans('remoteIdentification.backend.middle_name').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-7'>
                {!! Form::text('profile[middle_name]', $data->remote_identification_payload_params["profile"]["Items"]["middle_name"] ?? null, ['class' => 'form-control','disabled' => 'disabled']) !!}
            </div>
        </div>

        <div class="form-group required">
            {!! Form::label('msisdn', trans('remoteIdentification.backend.table.msisdn').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-7'>
                {!! Form::text('msisdn', $data->from_user->msisdn, ['class' => 'form-control', "disabled" => "disabled"]) !!}
            </div>
        </div>

        <div class="form-group required">
            {!! Form::label('profile[birth_date]', trans('remoteIdentification.backend.birth_date').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-3'>
                {!! Form::date('profile[birth_date]', $data->remote_identification_payload_params["profile"]["Items"]["birth_date"] ?? null, ['class' => 'form-control','disabled' => 'disabled']) !!}
            </div>

            {!! Form::label('profile[gender_id]', trans('remoteIdentification.backend.gender').':', ['class' => 'control-label col-sm-1']) !!}
            <div class='col-sm-2'>
                {!! Form::select('profile[gender_id]', trans('InterfaceTranses.gender_with_guid'), $data->remote_identification_payload_params["profile"]["Items"]["gender_id"] ?? null, ['class' => 'form-control','disabled' => 'disabled']) !!}
            </div>
        </div>

        <div class="form-group required">
            <div class='col-sm-4'></div>
            {!! Form::label('', '', ['class' => 'control-label']) !!}
            {!! Form::radio('profile[is_resident]', 1, ($data->remote_identification_payload_params["profile"]["Items"]["is_resident"] ?? null) === "0" ? false : true, ["class" => "form-check-input","id"=>"is_resident_1",'disabled' => 'disabled' ]) !!}
            {!! Form::label('is_resident_1', 'Резидент', ['class' => 'form-check-label']) !!}
            {!! Form::radio('profile[is_resident]', 0, ($data->remote_identification_payload_params["profile"]["Items"]["is_resident"] ?? null) === "0" ? true : false,["class" => "form-check-input","id" => "is_resident_0",'disabled' => 'disabled']) !!}
            {!! Form::label('is_resident_0', 'Не резидент', ['class' => 'form-check-label']) !!}
        </div>

        <div class="form-group required">
            {!! Form::label('profile[inn]', trans('remoteIdentification.backend.table.inn').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-2'>
                {!! Form::text('profile[inn]', $data->remote_identification_payload_params["profile"]["Items"]["inn"] ?? null, ['class' => 'form-control','disabled' => 'disabled']) !!}
            </div>

            {!! Form::label('profile[citizenship]', trans('remoteIdentification.backend.table.citizenship').':', ['class' => 'control-label col-sm-2']) !!}
            <div class='col-sm-4'>
                {!! Form::select('profile[citizenship_id]',$countries, $data->remote_identification_payload_params["profile"]["Items"]["citizenship_id"] ?? config("app_settings.default_country_id"), ['class' => 'form-control','style'=>'width: 97%;','disabled' => 'disabled']) !!}
            </div>
        </div>

        <div class="row">
            <div class='col-sm-3' style="text-decoration: underline;font-style: italic;">
               <p>Удостоверение личности:</p>
            </div>
        </div>

        <div class="form-group required">
            {!! Form::label('profile[document_type_id]', trans('remoteIdentification.backend.document_type').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-8'>
                {!! Form::select('profile[document_type_id]',$documentTypes, $data->remote_identification_payload_params["profile"]["Items"]["document_type_id"] ?? null, ['class' => 'form-control','style'=>'width: 98%;','disabled' => 'disabled']) !!}
            </div>
        </div>

        <div class="form-group required">
            {!! Form::label('', 'Паспортные данные:', ['class' => 'control-label col-sm-3']) !!}

            {!! Form::label('profile[passport_seria]', trans('remoteIdentification.backend.passport_seria'), ['class' => 'control-label col-sm-1','style'=>'text-align: left']) !!}
            <div class='col-sm-1'>
                {!! Form::text('profile[passport_seria]',$data->remote_identification_payload_params["profile"]["Items"]["passport_seria"] ?? null, ['class' => 'form-control','disabled' => 'disabled']) !!}
            </div>

            {!! Form::label('profile[passport_number]', trans('remoteIdentification.backend.passport_number'), ['class' => 'control-label col-sm-1','style'=>'text-align: left']) !!}
            <div class='col-sm-2'>
                {!! Form::text('profile[passport_number]',$data->remote_identification_payload_params["profile"]["Items"]["passport_number"] ?? null, ['class' => 'form-control','disabled' => 'disabled']) !!}
            </div>

            {!! Form::label('profile[passport_issue_date]', trans('remoteIdentification.backend.passport_issue_date'), ['class' => 'control-label col-sm-1','style'=>'text-align: left']) !!}
            <div class='col-sm-3'>
                {!! Form::date('profile[passport_issue_date]',$data->remote_identification_payload_params["profile"]["Items"]["passport_issue_date"] ?? null, ['class' => 'form-control','disabled' => 'disabled']) !!}
            </div>
        </div>

        <div class="form-group required">
            <div class='col-sm-2'></div>
            {!! Form::label('profile[document_expiration_date]', trans('remoteIdentification.backend.document_expiration_date'), ['class' => 'control-label col-sm-5']) !!}
            <div class='col-sm-3'>
                {!! Form::date('profile[document_expiration_date]',$data->remote_identification_payload_params["profile"]["Items"]["document_expiration_date"] ?? null, ['class' => 'form-control','disabled' => 'disabled']) !!}
            </div>

            {!! Form::hidden('profile[document_expiration_date_not]',0) !!}
            {!! Form::checkbox('profile[document_expiration_date_not]', 1, null, ["class" => "form-check-input","id"=>"profile[document_expiration_date_not]",'disabled' => 'disabled' ]) !!}
            {!! Form::label('profile[document_expiration_date_not]', 'Не имеется', ['class' => 'control-label']) !!}

        </div>

        <div class="form-group required">
            {!! Form::label('profile[passport_by_who]', trans('remoteIdentification.backend.passport_by_who'), ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-8'>
                {!! Form::text('profile[passport_by_who]',$data->remote_identification_payload_params["profile"]["Items"]["passport_by_who"] ?? null, ['class' => 'form-control','style' => 'width: 97%','disabled' => 'disabled']) !!}
            </div>
        </div>

        <div class="row">
            <div class='col-sm-3' style="text-decoration: underline;font-style: italic;">
                <p>Адрес:</p>
            </div>
        </div>

        <div class="form-group required">
            {!! Form::label('profile[country_id]', trans('remoteIdentification.backend.country_id').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-8'>
                {!! Form::select('profile[country_id]',$countries, $data->remote_identification_payload_params["profile"]["Items"]["country_id"] ?? config("app_settings.default_country_id"), ['class' => 'form-control adress_f select2','style'=>'width: 98%;','disabled' => 'disabled']) !!}
            </div>
        </div>

        <div class="form-group required">
            {!! Form::label('profile[region_id]', trans('remoteIdentification.backend.region_id').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-8'>
                {!! Form::select('profile[region_id]',$regions, $data->remote_identification_payload_params["profile"]["Items"]["region_id"] ?? null, ['class' => 'form-control adress_f select2','style'=>'width: 98%;','disabled' => 'disabled']) !!}
            </div>
        </div>

        <div class="form-group required">
            {!! Form::label('profile[district_id]', trans('remoteIdentification.backend.district_id').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-8'>
                {!! Form::select('profile[district_id]',$areas, $data->remote_identification_payload_params["profile"]["Items"]["district_id"] ?? null, ['class' => 'form-control adress_f select2','style'=>'width: 98%;','disabled' => 'disabled']) !!}
            </div>
        </div>

        <div class="form-group required">
            {!! Form::label('profile[city_id]', trans('remoteIdentification.backend.city_id').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-8'>
                {!! Form::select('profile[city_id]',$cities, $data->remote_identification_payload_params["profile"]["Items"]["city_id"] ?? null, ['class' => 'form-control adress_f select2','style'=>'width: 98%;','disabled' => 'disabled']) !!}
            </div>
        </div>

        <div class="form-group required">
            {!! Form::label('profile[street]', trans('remoteIdentification.backend.street').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-8'>
                {!! Form::text('profile[street]', $data->remote_identification_payload_params["profile"]["Items"]["street"] ?? null, ['class' => 'form-control adress_f','style'=>'width: 98%;','disabled' => 'disabled']) !!}
            </div>
        </div>


        <div class="form-group required">
            {!! Form::label('profile[house_number]', trans('remoteIdentification.backend.house_number').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-1'>
                {!! Form::text('profile[house_number]', $data->remote_identification_payload_params["profile"]["Items"]["house_number"] ?? null, ['class' => 'form-control adress_f','disabled' => 'disabled']) !!}
            </div>

            {!! Form::label('profile[housing]', trans('remoteIdentification.backend.housing').':', ['class' => 'control-label col-sm-1']) !!}
            <div class='col-sm-1'>
                {!! Form::text('profile[housing]', $data->remote_identification_payload_params["profile"]["Items"]["housing"] ?? null, ['class' => 'form-control adress_f','disabled' => 'disabled']) !!}
            </div>

            {!! Form::label('profile[room]', trans('remoteIdentification.backend.flat').':', ['class' => 'control-label col-sm-1',"style" => 'width: 9.333333%;']) !!}
            <div class='col-sm-1'>
                {!! Form::text('profile[room]',  $data->remote_identification_payload_params["profile"]["Items"]["room"] ?? null, ['class' => 'form-control adress_f','style'=>'width: 98%;','disabled' => 'disabled']) !!}
            </div>
        </div>
        <div class="form-group required">
            {!! Form::label('profile[registration_date]', trans('remoteIdentification.backend.registration_date').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-3'>
                {!! Form::date('profile[registration_date]',  $data->remote_identification_payload_params["profile"]["Items"]["registration_date"] ?? null, ['class' => 'form-control','style'=>'width: 98%;','disabled' => 'disabled']) !!}
            </div>
            {!! Form::hidden('profile[registration_date_not]', 0) !!}
            {!! Form::checkbox('profile[registration_date_not]', 1, null, ["class" => "form-check-input","id"=>"profile[registration_date_not]",'disabled' => 'disabled' ]) !!}
            {!! Form::label('profile[registration_date_not]', 'Нет', ['class' => 'control-label']) !!}

        </div>

        <div class="form-group">
            {!! Form::label('address', trans('remoteIdentification.backend.adress_str').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-8'>
                {!! Form::textarea('profile[address]',  $data->remote_identification_payload_params["profile"]["Items"]["address"] ?? null, ['class' => 'form-control','style'=>'width: 98%; height: 120px;','id' => 'adress_str','readonly' => true]) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('params_json', trans('remoteIdentification.backend.history_call').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-8'>
                <p class="form-control-static">
            <span class="json-params" id="json_history_call">
                {{ json_encode($data->history_call??null, JSON_UNESCAPED_UNICODE) }}
            </span>
                </p>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('history[comment]', trans('remoteIdentification.backend.comment').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-8'>
                {!! Form::textarea('history[comment]',  $data->remote_identification_payload_params["history"]["comment"] ?? null, ['class' => 'form-control','style'=>'width: 98%; height: 120px;','id' => 'history_comment']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('call_comment', trans('remoteIdentification.backend.call_comment').':', ['class' => 'control-label col-sm-4']) !!}
            <div class='col-sm-8'>
                {!! Form::select('call_comment',$orderCommentCalls,  null, ['class' => 'form-control call_comment','style'=>'width: 98%;']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <input id="remote_identification_history" class="btn btn-primary" form="form-remoteIdentification" type="button" value="Сохранить">
            </div>
        </div>

    </div>
    <div class="col-sm-4">
        <div class="row" style="background-color:#eee;margin-bottom: 10px">
            <div class="col-sm-12" style="padding: 0;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <p style="text-decoration: underline;font-style: italic;margin: 10px 0 5px 0px;">Лицевая сторона паспорта</p>
                        </div>
                    </div>
                </div>
                <div class="row ">
                        <p style="text-align: center">
                        <a data-title="Лицевая сторона паспорта" class="new-window-img" href="{{route("admin.remoteIdentification.image",["orderId"=>$data->id,"name" => $data->remote_identification_payload_params["front_photo"]["Item"]["img"]])}}">
                            <img id="front-photo-zoom-image" style="width: 350px; height: 270px;"
                                 src="{{route("admin.remoteIdentification.image",["orderId"=>$data->id,"name" => $data->remote_identification_payload_params["front_photo"]["Item"]["img"]])}}"
                                 data-zoom-image="{{route("admin.remoteIdentification.image",["orderId"=>$data->id,"name" => $data->remote_identification_payload_params["front_photo"]["Item"]["img"]])}}" alt="centered image" />
                            </a>
                        </p>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <span>Качество фото подходит для идентификации?</span><br>
                            {!! Form::radio('front_photo[status]', "1", old("front_photo.status") == "1" ? true : ($data->remote_identification_payload_params["front_photo"]["status"] == "ACCEPTED"),["class" => "form-check-input", "id" =>"front_photo_status_1",'disabled' => 'disabled']) !!}
                            {!! Form::label('front_photo_status_1', 'Да', ['class' => 'form-check-label']) !!}
                            {!! Form::radio('front_photo[status]', "0", old("front_photo.status") == "0" ? true : ($data->remote_identification_payload_params["front_photo"]["status"] == "REJECTED"),["class" => "form-check-input","id"=>"front_photo_status_0",'disabled' => 'disabled']) !!}
                            {!! Form::label('front_photo_status_0', 'Нет', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="background-color:#eee;margin-bottom: 10px">
            <div class="col-sm-12" style="padding: 0;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <p style="text-decoration: underline;font-style: italic;margin: 10px 0 5px 0px;">Оборотная сторона паспорта</p>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <p style="text-align: center">
                        <a data-title="Оборотная сторона паспорта" class="new-window-img" href="{{route("admin.remoteIdentification.image",["orderId"=>$data->id,"name" => $data->remote_identification_payload_params["back_photo"]["Item"]["img"]])}}">
                            <img id="back-photo-zoom-image" style="width: 350px; height: 270px;"
                                 src="{{route("admin.remoteIdentification.image",["orderId"=>$data->id,"name" => $data->remote_identification_payload_params["back_photo"]["Item"]["img"]])}}"
                                 data-zoom-image="{{route("admin.remoteIdentification.image",["orderId"=>$data->id,"name" => $data->remote_identification_payload_params["back_photo"]["Item"]["img"]])}}" alt="centered image" />
                        </a>
                    </p>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <span>Качество фото подходит для идентификации?</span><br>
                            {!! Form::radio('back_photo[status]', "1", old("back_photo.status") == "1" ? true : ($data->remote_identification_payload_params["back_photo"]["status"] == "ACCEPTED"),["class" => "form-check-input", "id"=>"back_photo_status_1",'disabled' => 'disabled']) !!}
                            {!! Form::label('back_photo_status_1', 'Да', ['class' => 'form-check-label']) !!}
                            {!! Form::radio('back_photo[status]', "0", old("back_photo.status") == "0" ? true : ($data->remote_identification_payload_params["back_photo"]["status"] == "REJECTED"),["class" => "form-check-input","id"=>"back_photo_status_0",'disabled' => 'disabled']) !!}
                            {!! Form::label('back_photo_status_0', 'Нет', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="background-color:#eee;margin-bottom: 10px">
            <div class="col-sm-12" style="padding: 0;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <p style="text-decoration: underline;font-style: italic;margin: 10px 0 5px 0px;">Фото с паспортом(селфи)</p>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <p style="text-align: center">
                        <a data-title="Фото с паспортом(селфи)" class="new-window-img" href="{{route("admin.remoteIdentification.image",["orderId"=>$data->id,"name" => $data->remote_identification_payload_params["selfie_photo"]["Item"]["img"]])}}">
                            <img id="selfie-photo-zoom-image" style="width: 350px; height: 270px;"
                                 src="{{route("admin.remoteIdentification.image",["orderId"=>$data->id,"name" => $data->remote_identification_payload_params["selfie_photo"]["Item"]["img"]])}}"
                                 data-zoom-image="{{route("admin.remoteIdentification.image",["orderId"=>$data->id,"name" => $data->remote_identification_payload_params["selfie_photo"]["Item"]["img"]])}}" alt="centered image" />
                        </a>
                    </p>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <span>Качество фото подходит для идентификации?</span><br>
                            {!! Form::radio('selfie_photo[status]', "1", old("selfie_photo.status") == "1" ? true : ($data->remote_identification_payload_params["selfie_photo"]["status"] == "ACCEPTED"),["class" => "form-check-input", "id"=>"selfie_photo_status_1",'disabled' => 'disabled']) !!}
                            {!! Form::label('selfie_photo_status_1', 'Да', ['class' => 'form-check-label']) !!}
                            {!! Form::radio('selfie_photo[status]', "0", old("selfie_photo.status") == "0" ? true : ($data->remote_identification_payload_params["selfie_photo"]["status"] == "REJECTED"),["class" => "form-check-input","id"=>"selfie_photo_status_0",'disabled' => 'disabled']) !!}
                            {!! Form::label('selfie_photo_status_0', 'Нет', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="background-color:#eee;margin-bottom: 10px">
            <div class="col-sm-12" style="padding: 0;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <span >Анкетные данные совподают с паспортными данными из фото?</span><br>
                            {!! Form::radio('profile[status]', "1", old("profile.status") == "1" ? true : ($data->remote_identification_payload_params["profile"]["status"] == "ACCEPTED"), ["class" => "form-check-input", "id"=>"profile_status_1",'disabled' => 'disabled']) !!}
                            {!! Form::label('profile_status_1', 'Да', ['class' => 'form-check-label']) !!}
                            {!! Form::radio('profile[status]', "0", old("profile.status") == "0" ? true : ($data->remote_identification_payload_params["profile"]["status"] == "REJECTED"),["class" => "form-check-input","id"=>"profile_status_0",'disabled' => 'disabled']) !!}
                            {!! Form::label('profile_status_0', 'Нет', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<style>
    label[for=profile\[room\]]:before,label[for=profile\[housing\]]:before,label[for=profile\[registration_date_not\]]:before,label[for=profile\[document_expiration_date_not\]]:before
    {
        display: none;
    }
</style>