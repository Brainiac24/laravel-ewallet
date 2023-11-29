<!-- code Field -->
<div class="form-group">
    {!! Form::label('id', trans('tempUsers.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('code_map', trans('tempUsers.backend.table.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->code_map }}</p>
    </div>
</div>

<!-- is_active Field -->
<div class="form-group">
    {!! Form::label('username', trans('tempUsers.backend.table.username').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->last_name }}  {{ $data->first_name }} {{ $data->middle_name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('msisdn', trans('tempUsers.backend.table.msisdn').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->msisdn }} </p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('contacts_json', trans('tempUsers.backend.table.contacts_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="{{ $data->contacts_json==null ?: 'json-params' }}">{{ json_encode($data->contacts_json, JSON_UNESCAPED_UNICODE) }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('country_born', trans('tempUsers.backend.table.country_born').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->country_born->name ?? "" }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('country', trans('tempUsers.backend.table.country').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->country->name ?? "" }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('region', trans('tempUsers.backend.table.region').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->region->name ?? "" }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('city', trans('tempUsers.backend.table.city').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->city->name ?? "" }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('document_type', trans('tempUsers.backend.table.document_type').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->document_type->name ?? "" }}</p>
    </div>
</div>

<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('orderStatus.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('orderStatus.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->updated_at }}</p>
    </div>
</div>