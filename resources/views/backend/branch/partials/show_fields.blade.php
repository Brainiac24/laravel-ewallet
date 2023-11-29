<div class="form-group">
    {!! Form::label('id', trans('branch.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $branch->id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('code', trans('branch.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $branch->code }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('code_map', trans('branch.backend.table.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $branch->code_map }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', trans('branch.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $branch->name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('acc_number', trans('branch.backend.table.acc_number').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $branch->acc_number }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('address', trans('branch.backend.table.address').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $branch->address }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('city_name', trans('branch.backend.table.city_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $branch->city_name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('branch_user_id', trans('branch.backend.table.branch_user_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $branch->branch_user_id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('params_json', trans('branch.backend.params_json').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">
            <span class="json-params">
                {{ json_encode($branch->params_json, JSON_UNESCAPED_UNICODE) }}
            </span>
        </p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('branch.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ trans('InterfaceTranses.is_active.'.$branch->is_active) }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('branch.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $branch->created_at }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('branch.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $branch->updated_at }}</p>
    </div>
</div>