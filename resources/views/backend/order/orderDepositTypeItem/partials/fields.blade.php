<div class="form-group required">
    {!! Form::label('code', trans('orderDepositTypeItem.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('code_map', trans('orderDepositTypeItem.backend.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code_map', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('name', trans('orderDepositTypeItem.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('min_amount', trans('orderDepositTypeItem.backend.min_amount').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('min_amount', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('max_amount', trans('orderDepositTypeItem.backend.max_amount').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('max_amount', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('day_from_count', trans('orderDepositTypeItem.backend.day_from_count').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('day_from_count', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('day_to_count', trans('orderDepositTypeItem.backend.day_to_count').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('day_to_count', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('percentage', trans('orderDepositTypeItem.backend.percentage').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('percentage', $data->percentage??null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('can_fill_until', trans('orderDepositTypeItem.backend.can_fill_until').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('can_fill_until', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('can_fill_until_is_persentage', trans('orderDepositTypeItem.backend.can_fill_until_is_persentage').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select ('can_fill_until_is_persentage',  trans('InterfaceTranses.yesno') , $data->can_fill_until_is_persentage??null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('currency_id', trans('orderDepositTypeItem.backend.currency_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('currency_id',$currencies, null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('order_deposit_type_id', trans('orderDepositTypeItem.backend.order_deposit_type_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('order_deposit_type_id',$order_deposit_types, null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('position', trans('orderDepositTypeItem.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('position', null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group required">
    {!! Form::label('is_fillable', trans('orderDepositTypeItem.backend.is_fillable').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select ('is_fillable',  trans('InterfaceTranses.yesno') , $data->is_fillable??null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('is_withdrawable', trans('orderDepositTypeItem.backend.is_withdrawable').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select ('is_withdrawable',  trans('InterfaceTranses.yesno') , $data->is_withdrawable??null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('is_active', trans('orderDepositTypeItem.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select ('is_active',  trans('InterfaceTranses.is_active') , $data->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>

