<!-- NAME Field -->
<div class="form-group required">
    {!! Form::label('name', trans('favorite.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- value Field -->
<div class="form-group required">
    {!! Form::label('value', trans('favorite.backend.table.value').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('value', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- params_json Field -->
<div class="form-group required">
    {!! Form::label('params_json', trans('favorite.backend.table.params_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        @if(isset($favorite))
        {!! Form::text('params_json', json_encode($favorite->params_json)??null, ['class' => 'form-control']) !!}
        @else
            {!! Form::text('params_json', '', ['class' => 'form-control']) !!}
        @endif
    </div>
</div>
<!-- service_id Field -->
<div class="form-group required">
    {!! Form::label('service_id', trans('favorite.backend.table.service_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        @if(isset($favorite))
            {!! Form::select ('service_id', $services , $favorite->service_id??null, ['class' => 'form-control']) !!}
        @else
            {!! Form::select ('service_id', $services , null, ['class' => 'form-control']) !!}
        @endif

    </div>
</div>
<!-- user_id Field -->
<div class="form-group required">
    {!! Form::label('user_id', trans('favorite.backend.user_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('user_id', $users, Route::is('admin.favorites.create') ? null : $selectedUsers, ['name' => 'user_id', 'id' => 'user_id', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите Пользователя']) !!}
    </div>
</div>