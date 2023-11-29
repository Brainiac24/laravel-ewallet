<div class="form-group required">
    {!! Form::label('code', trans('orderAccountType.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('code_map', trans('orderAccountType.backend.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code_map', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('name', trans('orderAccountType.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('service_id', trans('orderAccountType.backend.service_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('service_id',$services, null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('position', trans('orderAccountType.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('position', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-check">
    <div class="col-sm-2"></div>
    <input class="form-check-input" type="radio" name="select_icon" id="select-icon" value="select" checked>
    <label class="form-check-label" for="select-icon">
        Выбрать из ранее загруженных
    </label>
</div>

<div class="form-check">
    <div class="col-sm-2"></div>
    <input class="form-check-input" type="radio" name="select_icon" id="select-new-icon" value="new">
    <label class="form-check-label" for="select-new-icon">
        Загрузить новую
    </label>
</div>

<div class="form-group">
    {!! Form::label('', '', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9 icons'>
       <div class='col-sm-12'>
           @if(isset($data))
                <img style="width: 164px" src="{!! url('/imgs/orders/accounts/3/'.$data->icon.".png") !!}" alt="{{ $data->icon }}">
           @else
                <img style="width: 164px" src="{!! url('/imgs/accounts/no_photo.png') !!}" alt="no_photo.png">
           @endif
       </div>
    </div>
</div>

<div class="form-group required">
    {!! Form::label('icon', trans('orderAccountType.backend.icon').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <div class="icon_select">
            {!! Form::select('icon', $icons,  null, ['class' => 'form-control select2']) !!}
        </div>
        {!! Form::file('icon_file', ['class' => 'form-control icon_file', "accept"=>"image/*","style" => "display:none"]) !!}
    </div>
</div>


<div class="form-group required">
    {!! Form::label('is_active', trans('orderAccountType.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans("InterfaceTranses.is_active") ,null) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('contract_html', trans('orderAccountType.backend.contract_html').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::textarea('contract_html', null, ['class' => 'form-control', 'id'=>'contract_html-ckeditor']) !!}
    </div>
</div>


