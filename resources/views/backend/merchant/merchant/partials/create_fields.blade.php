<div class="merchant-section">
    <div class="merchant-section-title">Информация о мерчантах</div>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('name', trans('merchant.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('merchant_category_id', trans('merchant.backend.merchant_category_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('merchant_category_id', $merchantCategories, $selectedPerms??null, ['name' => 'merchant_category_ids[]', 'merchant_category_id' => 'select2_perms', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите категорию', 'multiple']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('organization', trans('merchant.backend.organization').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('organization', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('merchant_workday_id', trans('merchant.backend.merchant_workday_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('merchant_workday_id', $merchantWorkdays, $selectedMerchantWorkday??null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('city_id', trans('merchant.backend.city_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('city_id', $cities, $selectedCity??null, ['class' => 'form-control select2']) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('latitude', trans('merchant.backend.latitude').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('latitude', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('address', trans('merchant.backend.address').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('longtitude', trans('merchant.backend.longtitude').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('longtitude', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('phone', trans('merchant.backend.phone').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('email', trans('merchant.backend.email').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('branch_id', trans('merchant.backend.branch_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('branch_id', $branchs, $branchSelected, ['class' => 'form-control select2']) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('desc', trans('merchant.backend.desc').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::textarea('desc', null, ['class' => 'form-control', 'rows'=>4]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('webhook_url', trans('merchant.backend.webhook_url').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('webhook_url', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('is_qr_integrated', trans('merchant.backend.is_qr_integrated').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('is_qr_integrated',  trans('InterfaceTranses.verified'),  $merchant->is_qr_integrated??0 , ['class' => 'form-control','disabled'=>Auth::user()->ability('sadmin','merchant-is-qr-integrated')?null:true]) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('document', trans('merchant.backend.table.document').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::label('contract_file', 'Список документов пусто', ['class' => 'control-label col-sm-0']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('contract_file', ' ', ['class' => 'control-label col-sm-2']) !!}
                    <div class='col-sm-9'>
                        {!! Form::file('contract_file', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('referral', trans('merchant.backend.referral').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('params_json[referral]', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="merchant-section">
    <div class="merchant-section-title">Банковские реквизиты и коммисия мерчанта</div>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('bank_id', trans('merchant.backend.bank_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('bank_id', $banks, $selectedBank??null, ['class' => 'form-control select2']) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('merchant_commission_id', trans('merchant.backend.merchant_commission_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('merchant_commission_id', $merchantCommissions, $selectedMerchantComission??null, ['class' => 'form-control select2']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('inn', trans('merchant.backend.inn').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('inn', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('account_number', trans('merchant.backend.account_number').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('account_number', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

</div>

<div class="merchant-section">
    <div class="merchant-section-title">Настройки на главном экране</div>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('img_ad', trans('merchant.backend.img_ad').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::file('img_ad', ['class' => 'form-control', "accept"=>"image/*"]) !!}
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('position', trans('merchant.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('position', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('img_logo', trans('merchant.backend.img_logo').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::file('img_logo', ['class' => 'form-control', "accept"=>"image/*"]) !!}
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('is_active', trans('merchant.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    @ability('sadmin', 'merchant-can-change-is-verified')
                    {!! Form::select('is_active',  trans('InterfaceTranses.enabled'),  1, ['class' => 'form-control']) !!}
                    @else
                        {!! Form::select('disabled_is_active',  trans('InterfaceTranses.enabled'),  0, ['class' => 'form-control', 'disabled' => 'true']) !!}
                        {!! Form::hidden('is_active',  0) !!}
                    @endability
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('img_detail', trans('merchant.backend.img_detail').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::file('img_detail', ['class' => 'form-control', "accept"=>"image/*"]) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group ">
                {!! Form::label('is_verified', trans('merchant.backend.is_verified').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    @ability('sadmin', 'merchant-can-change-is-verified')
                    {!! Form::select('is_verified',  trans('InterfaceTranses.verified'),  0, ['class' => 'form-control']) !!}
                    @else
                    {!! Form::select('disabled_is_verified',  trans('InterfaceTranses.verified'),  $merchant->is_verified ?? 0 , ['class' => 'form-control', 'disabled' => true]) !!}
                        {!! Form::hidden('is_verified',  0) !!}
                    @endability
                </div>
            </div>
        </div>

    </div>
</div>

<div class="merchant-section">
    <div class="merchant-section-title">Кешбэк</div>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('merchant_cashback_id', trans('merchant.backend.merchant_cashback_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('merchant_cashback_id', $cashbacks, null, ['class' => 'form-control select2']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('merchant_cashback_start_date', trans('cashback.backend.start_date').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::datetimeLocal('merchant_cashback_start_date',null, ['class' => 'form-control col-sm-12'])!!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('merchant_cashback_end_date', trans('cashback.backend.end_date').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::datetimeLocal('merchant_cashback_end_date', null, ['class' => 'form-control col-sm-12'])!!}
                </div>
            </div>

        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('bank_cashback_id', trans('merchant.backend.bank_cashback_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('bank_cashback_id', $cashbacks, null, ['class' => 'form-control select2']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('bank_cashback_start_date', trans('cashback.backend.start_date').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::datetimeLocal('bank_cashback_start_date', null, ['class' => 'form-control col-sm-12'])!!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('bank_cashback_end_date', trans('cashback.backend.end_date').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::datetimeLocal('bank_cashback_end_date', null, ['class' => 'form-control col-sm-12'])!!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="merchant-section">
    <div class="merchant-section-title">Информация о сформирование отчета</div>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('generate_report', trans('merchant.backend.generate_report').':', ['class' => 'control-label col-sm-4']) !!}
                <div class='col-sm-8'>
                    {!! Form::select('generate_report',  trans('InterfaceTranses.verified'),  $merchant->generate_report??null    , ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('params_json{report][is_send_to_merchant]', trans('merchant.backend.is_send_to_merchant').':', ['class' => 'control-label col-sm-4']) !!}
                <div class='col-sm-8'>
                    {!! Form::select('params_json[report][is_send_to_merchant]',  trans('InterfaceTranses.verified'),  $merchant->params_json['report']['is_send_to_merchant']??null    , ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('params_json[report][is_send_to_all_merchant_item]', trans('merchant.backend.is_send_to_all_merchant_item').':', ['class' => 'control-label col-sm-4']) !!}
                <div class='col-sm-8'>
                    {!! Form::select('params_json[report][is_send_to_all_merchant_item]',  trans('InterfaceTranses.verified'),  $merchant->params_json['report']['is_send_to_all_merchant_item']??null    , ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('params_json[report][last_send]', trans('merchant.backend.last_send').':', ['class' => 'control-label col-sm-4']) !!}
                <div class='col-sm-8'>
                    {!! Form::date('params_json[report][last_send]', !isset($merchant->params_json['report']['last_send'])?null:\Carbon\Carbon::parse($merchant->params_json['report']['last_send'])->format("Y-m-d"), ['class' => 'form-control col-sm-12'])!!}
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('params_json[report][merchant_items]', trans('merchant.backend.merchant_items').':', ['class' => 'control-label col-sm-4']) !!}
                <div class='col-sm-8'>
                    {!! Form::select('params_json[report][merchant_items]', $merchantItems??[], $selectedMerchantItems??null, ['name' => 'params_json[report][merchant_items][]', 'params_json.report.merchant_items' => 'select2_perms', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите кассу', 'multiple']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('params_json[report][period]', trans('merchant.backend.period'), ['class' => 'control-label col-sm-4']) !!}
                <div class='col-sm-8'>
                    {!! Form::text('params_json[report][period]' , $merchant->params_json['report']['period']??'xx:xx:xxxx', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('params_json[report][interval]', trans('merchant.backend.interval'), ['class' => 'control-label col-sm-4']) !!}
                <div class='col-sm-8'>
                    {!! Form::number('params_json[report][interval]' , $merchant->params_json['report']['interval']??0, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .merchant-section
    {
        border: 1px solid silver;
        padding-top: 20px;
        position: relative;
        margin-bottom: 20px;
    }

    .merchant-section-title{
        position: absolute;
        top: -13px;
        left: 6px;
        background: white;
        font-size: 15px;
        font-weight: bold;
        padding-left: 10px;
        padding-right: 10px;
    }
    .merchant-section .row{
        margin-left: 20px;
    }
</style>