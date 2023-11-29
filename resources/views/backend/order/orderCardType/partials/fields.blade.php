<div class="form-group required">
    {!! Form::label('code', trans('orderCardType.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('code_map', trans('orderCardType.backend.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code_map', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('name', trans('orderCardType.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('price', trans('orderCardType.backend.price').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('price', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('insurance_price', trans('orderCardType.backend.insurance_price').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('insurance_price', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('code_ibank', trans('orderCardType.backend.code_ibank').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code_ibank', null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group required">
    {!! Form::label('year', trans('orderCardType.backend.year').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('year', null, ['class' => 'form-control']) !!}
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
                <img style="width: 164px" src="{!! url('/imgs/accounts/3/all_'.$data->icon.".png") !!}" alt="{{ $data->icon }}">
           @else
                <img style="width: 164px" src="{!! url('/imgs/accounts/no_photo.png') !!}" alt="no_photo.png">
           @endif
               <br><a href="#" id="delete_image" class="d-block" style="display: none;"> Удалить выбранное изображение</a>
       </div>
    </div>
</div>

<div class="form-group required">
    {!! Form::label('icon', trans('orderCardType.backend.icon').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <div class="icon_select">
            {!! Form::select('icon', $storageIcons,  null, ['class' => 'form-control select2']) !!}
        </div>
        {!! Form::file('icon_file', ['class' => 'form-control icon_file', "accept"=>"image/*","style" => "display:none"]) !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('information', trans('orderCardType.backend.information').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('information', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('detail', trans('orderCardType.backend.detail').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('detail', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    <!-- сделали params_json так как json_editor не работал с html_params_json -->
    {!! Form::label('params_json', trans('orderCardType.backend.params_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <div id="jsoneditor"></div>
        {!! Form::hidden('params_json',  isset($data->html_params_json) ? json_encode($data->html_params_json, JSON_UNESCAPED_UNICODE) : null, ['class' => 'form-control ']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('currency_id', trans('orderCardType.backend.currency_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('currency_id',$currencies, null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('order_card_contract_type_id', trans('orderCardType.backend.order_card_contract_type_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('order_card_contract_type_id',$orderCardContractTypes, null) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('position', trans('orderCardType.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('position', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('is_active', trans('orderCardType.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans("InterfaceTranses.is_active") ,null) !!}
    </div>
</div>

