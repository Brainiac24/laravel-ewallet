<!-- service_id Field -->
<div class="form-group required">
    {!! Form::label('service_id', trans('userServiceLimit.backend.table.service_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select ('service_id', $services , $serviceLimit->service_id??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- user_id Field -->
<div class="form-group required">
    {!! Form::label('user_id', trans('userServiceLimit.backend.user_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('user_id', $users, Route::is('admin.users.services.limits.create') ? null : $selectedUsers, ['name' => 'user_id', 'id' => 'user_id', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите Пользователя']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('params_json', trans('service.backend.params_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <div id="jsoneditor"></div>
        {!! Form::hidden('params_json',  Route::is('admin.limits.create') ? null : json_encode($userServiceLimit->params_json), ['class' => 'form-control']) !!}
    </div>
</div>

<!-- params_json Field -->
{{--<div class="form-group required">--}}
    {{--{!! Form::label('params_json', trans('userServiceLimit.backend.table.params_json').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::textarea('params_json', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}