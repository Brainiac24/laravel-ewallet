<div class="merchant-section">
    <div class="merchant-section-title">Информация о мерчантах</div>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('name', trans('merchant.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('name', null, ['class' => 'form-control', "readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null ]) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('merchant_category_id', trans('merchant.backend.merchant_category_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('merchant_category_id', $merchantCategories, $selectedPerms??null, ['name' => 'merchant_category_ids[]', 'merchant_category_id' => 'select2_perms', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите категорию', 'multiple',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('organization', trans('merchant.backend.organization').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('organization', null, ['class' => 'form-control',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('merchant_workday_id', trans('merchant.backend.merchant_workday_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('merchant_workday_id', $merchantWorkdays, $selectedMerchantWorkday??null, ['class' => 'form-control',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('city_id', trans('merchant.backend.city_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('city_id', $cities, $selectedCity??null, ['class' => 'form-control select2',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('latitude', trans('merchant.backend.latitude').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('latitude', null, ['class' => 'form-control',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('address', trans('merchant.backend.address').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('address', null, ['class' => 'form-control',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('longtitude', trans('merchant.backend.longtitude').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('longtitude', null, ['class' => 'form-control',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('phone', trans('merchant.backend.phone').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('phone', null, ['class' => 'form-control',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('email', trans('merchant.backend.email').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('email', null, ['class' => 'form-control',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('branch_id', trans('merchant.backend.branch_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('branch_id', $branchs, null, ['class' => 'form-control select2',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
                <div class="form-group">
                    {!! Form::label('is_qr_integrated', trans('merchant.backend.is_qr_integrated').':', ['class' => 'control-label col-sm-2']) !!}
                    <div class='col-sm-9'>
                        {!! Form::select('is_qr_integrated',  trans('InterfaceTranses.verified'),  $merchant->is_qr_integrated??0 , ['class' => 'form-control', 'disabled'=>Auth::user()->ability('sadmin','merchant-is-qr-integrated')?null:true]) !!}
                    </div>
                </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('desc', trans('merchant.backend.desc').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::textarea('desc', null, ['class' => 'form-control', 'rows'=>4, "readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('webhook_url', trans('merchant.backend.webhook_url').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('webhook_url', null, ['class' => 'form-control',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('login', trans('merchant.backend.login').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! empty($merchant->login)?link_to(route('admin.merchants.generateLogin', ['id'=>$merchant->id]), trans('merchant.buttons.generatLogin'), ['class' => 'btn btn-default'], $secure = null):'<p class="form-control-static">'.$merchant->login.'</p>'!!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('document', trans('merchant.backend.table.document').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    @if(isset($merchant->params_json['contracts']) && count($merchant->params_json['contracts'])>0)
                        <div class="card">
                            <div class="card-header" id="headingDocuments">
                                <h5 class="mb-0">
                                    <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseDocuments" aria-expanded="false" aria-controls="collapseDocuments">
                                        Список документов
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseDocuments" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    @foreach($merchant->params_json['contracts'] as $contract)
                                        <div>
                                            <a href="{{route('admin.merchants.downloadContract', ['id' => $merchant->id, 'file' => $contract])}}">{{$contract}}</a>
                                            <a href="{{route('admin.merchants.deleteContract', ['id' => $merchant->id, 'file' => $contract])}}">Удалить</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        {!! Form::label('contract_file', 'Список документов пусто', ['class' => 'control-label col-sm-0']) !!}
                    @endif
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
                    {!! Form::select('bank_id', $banks, $selectedBank??null, ['class' => 'form-control select2',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('merchant_commission_id', trans('merchant.backend.merchant_commission_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('merchant_commission_id', $merchantCommissions, $selectedMerchantComission??null, ['class' => 'form-control select2',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('inn', trans('merchant.backend.inn').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('inn', null, ['class' => 'form-control',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('account_number', trans('merchant.backend.account_number').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('account_number', null, ['class' => 'form-control',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
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
                {!! Form::label('img_ad_text', trans('merchant.backend.img_ad'), ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('img_ad_text' , $merchant->img_ad, ['class' => 'form-control','readonly' => 'true']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('img_ad_lb', trans('news.backend.image').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    @if($merchant->img_ad != null)
                        <div class='col-sm-12'><img src="{!! url('/imgs/cashback/1/'.$merchant->img_ad) !!}" alt="{{ $merchant->img_ad }}"></div>
                        {!! Form::submit(trans('actions.general.delete'), ['class' => 'btn btn-danger btn-margin-top-10','form'=>'form-delete-image-ad',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                    @else
                        {!! Form::label('img_ad_is_null', 'Картинка не установлено', ['class' => 'control-label col-sm-0']) !!}
                    @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('img_ad', ' ', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::file('img_ad', ['class' => 'form-control', "accept"=>"image/*","readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('position', trans('merchant.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('position', null, ['class' => 'form-control',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('img_logo_text', trans('merchant.backend.img_logo'), ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('img_logo_text' , $merchant->img_logo, ['class' => 'form-control','readonly' => 'true']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('img_logo_lb', trans('news.backend.image').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    @if($merchant->img_logo != null)
                        <div class='col-sm-12'><img src="{!! url('/imgs/cashback/1/'.$merchant->img_logo) !!}" alt="{{ $merchant->img_logo }}"></div>
                        {!! Form::submit(trans('actions.general.delete'), ['class' => 'btn btn-danger btn-margin-top-10','form'=>'form-delete-image-logo',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                    @else
                        {!! Form::label('img_logo_is_null', 'Картинка не установлено', ['class' => 'control-label col-sm-0']) !!}
                    @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('img_logo', ' ', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::file('img_logo', ['class' => 'form-control', "accept"=>"image/*","readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('is_active', trans('merchant.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    @ability('sadmin', ['merchant-can-change-is-verified','merchant-can-only-change-is-verified'])
                    {!! Form::select('is_active',  trans('InterfaceTranses.enabled'),  $merchant->is_active??null    , ['class' => 'form-control']) !!}
                    @else
                    {!! Form::select('is_active',  trans('InterfaceTranses.enabled'),  $merchant->is_active??null    , ['class' => 'form-control', 'readonly' => true]) !!}
                    @endability
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('img_detail_text', trans('merchant.backend.img_detail'), ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('img_detail_text' , $merchant->img_detail, ['class' => 'form-control','readonly' => 'true']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('img_detail_lb', trans('merchant.backend.img_detail').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    @if($merchant->img_detail != null)
                        <div class='col-sm-12'><img src="{!! url('/imgs/cashback/1/'.$merchant->img_detail) !!}" alt="{{ $merchant->img_detail }}"></div>
                        {!! Form::submit(trans('actions.general.delete'), ['class' => 'btn btn-danger btn-margin-top-10','form'=>'form-delete-image-detail',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                    @else
                        {!! Form::label('img_detail_is_null', 'Картинка не установлено', ['class' => 'control-label col-sm-0']) !!}
                    @endif
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('img_detail', ' ', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::file('img_detail', ['class' => 'form-control', "accept"=>"image/*","readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>
        </div>


        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('is_verified', trans('merchant.backend.is_verified').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    @ability('sadmin', ['merchant-can-change-is-verified','merchant-can-only-change-is-verified'])
                    {!! Form::select('is_verified',  trans('InterfaceTranses.verified'),  $merchant->is_verified??0 , ['class' => 'form-control']) !!}
                    @else
                    {!! Form::select('is_verified',  trans('InterfaceTranses.verified'),  $merchant->is_verified??0 , ['class' => 'form-control', 'readonly' => true]) !!}
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
                    {!! Form::select('merchant_cashback_id', $cashbacks, $selectedMerchantCashback??null, ['class' => 'form-control select2',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('merchant_cashback_start_date', trans('cashback.backend.start_date').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::datetimeLocal('merchant_cashback_start_date', empty($merchant->merchant_cashback_start_date)?null:\Carbon\Carbon::parse($merchant->merchant_cashback_start_date)->format("Y-m-d\TH:i"), ['class' => 'form-control col-sm-12',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null])!!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('merchant_cashback_end_date', trans('cashback.backend.end_date').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::datetimeLocal('merchant_cashback_end_date', empty($merchant->merchant_cashback_end_date)?null:\Carbon\Carbon::parse($merchant->merchant_cashback_end_date)->format("Y-m-d\TH:i"), ['class' => 'form-control col-sm-12',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null])!!}
                </div>
            </div>

        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('bank_cashback_id', trans('merchant.backend.bank_cashback_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('bank_cashback_id', $bankCashbacks, $selectedBankCashback??null, ['class' => 'form-control select2',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('bank_cashback_start_date', trans('cashback.backend.start_date').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::datetimeLocal('bank_cashback_start_date', empty($merchant->bank_cashback_start_date)?null:\Carbon\Carbon::parse($merchant->bank_cashback_start_date)->format("Y-m-d\TH:i"), ['class' => 'form-control col-sm-12',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null])!!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('bank_cashback_end_date', trans('cashback.backend.end_date').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    {!! Form::datetimeLocal('bank_cashback_end_date', empty($merchant->bank_cashback_end_date)?null:\Carbon\Carbon::parse($merchant->bank_cashback_end_date)->format("Y-m-d\TH:i"), ['class' => 'form-control col-sm-12',"readonly" => auth()->user()->can('merchant-can-only-change-is-verified') ? true : null])!!}
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

    select[readonly], select[readonly].select2-hidden-accessible + .select2-container {
        pointer-events: none;
        touch-action: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
        background: #eee;
        box-shadow: none;
    }

    .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
        display: none;
    }

</style>