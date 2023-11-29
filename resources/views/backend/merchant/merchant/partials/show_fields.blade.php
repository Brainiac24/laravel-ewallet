<div class="merchant-section">
    <div class="merchant-section-title">Информация о мерчантах</div>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('name', trans('merchant.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->name }}</p>
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('merchant_category_id', trans('merchant.backend.merchant_category_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">
                        @foreach($merchant->categories as $category)
                            {{ $category->name }} <br/>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('organization', trans('merchant.backend.organization').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->organization }}</p>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('merchant_workday_id', trans('merchant.backend.merchant_workday_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->merchant_workday->name ?? ''}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('city_id', trans('merchant.backend.city_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->city->name }}</p>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('latitude', trans('merchant.backend.latitude').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->latitude ?? null}}</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('address', trans('merchant.backend.address').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->address }}</p>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('longtitude', trans('merchant.backend.longtitude').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->longtitude ?? null}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('phone', trans('merchant.backend.phone').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->phone }}</p>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('desc', trans('merchant.backend.desc').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->desc ?? ''}}</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('email', trans('merchant.backend.email').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->email }}</p>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('webhook_url', trans('merchant.backend.webhook_url').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->webhook_url }}</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('merchant_category_id', trans('merchant.backend.branch_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->branch->name ?? ""}}</p>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('login', trans('merchant.backend.login').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->login }}</p>
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
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('referral', trans('merchant.backend.referral').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->params_json['referral']??'' }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('is_qr_integrated', trans('merchant.backend.is_qr_integrated').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ trans('InterfaceTranses.verified.'.$merchant->is_qr_integrated??0 )}}</p>
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
                    <p class="form-control-static">{{ $merchant->bank->name ?? ''}}</p>
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('merchant_commission_id', trans('merchant.backend.merchant_commission_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->merchant_commission->name ?? ''}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('inn', trans('merchant.backend.inn').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->inn }}</p>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('account_number', trans('merchant.backend.account_number').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->account_number }}</p>
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
                    @if($merchant->img_ad != null)
                        <img src="{!! url('/imgs/cashback/1/'.$merchant->img_ad) !!}" alt="{{ $merchant->img_ad }}">
                    @else
                        {!! Form::label('img_ad_is_null', 'Картинка не установлено', ['class' => 'control-label col-sm-0']) !!}
                    @endif
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('position', trans('merchant.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->position ?? null}}</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('img_logo', trans('merchant.backend.img_logo').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    @if($merchant->img_logo != null)
                        <img src="{!! url('/imgs/cashback/1/'.$merchant->img_logo) !!}" alt="{{ $merchant->img_logo }}">
                    @else
                        {!! Form::label('img_logo_is_null', 'Картинка не установлено', ['class' => 'control-label col-sm-0']) !!}
                    @endif
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('is_active', trans('merchant.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$merchant->is_active) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('img_detail', trans('merchant.backend.img_detail').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    @if($merchant->img_detail != null)
                        <img src="{!! url('/imgs/cashback/1/'.$merchant->img_detail) !!}" alt="{{ $merchant->img_detail }}">
                    @else
                        {!! Form::label('img_detail_is_null', 'Картинка не установлено', ['class' => 'control-label col-sm-0']) !!}
                    @endif
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
                    <p class="form-control-static">{{ $merchant->merchant_cashback->name ?? ''}}</p>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('merchant_cashback_start_date', trans('cashback.backend.start_date').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ empty($merchant->merchant_cashback_start_date)?null:\Carbon\Carbon::parse($merchant->merchant_cashback_start_date)->format("d.m.Y H:i")}}</p>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('merchant_cashback_end_date', trans('cashback.backend.end_date').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ empty($merchant->merchant_cashback_end_date)?null:\Carbon\Carbon::parse($merchant->merchant_cashback_end_date)->format("d.m.Y H:i")}}</p>
                </div>
            </div>
        </div>

        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('bank_cashback_id', trans('merchant.backend.bank_cashback_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->bank_cashback->name ?? ''}}</p>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('merchant_cashback_start_date', trans('cashback.backend.start_date').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ empty($merchant->bank_cashback_start_date)?null:\Carbon\Carbon::parse($merchant->bank_cashback_start_date)->format("d.m.Y H:i")}}</p>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('merchant_cashback_end_date', trans('cashback.backend.end_date').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ empty($merchant->bank_cashback_end_date)?null:\Carbon\Carbon::parse($merchant->bank_cashback_end_date)->format("d.m.Y H:i")}}</p>
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
                    <p class="form-control-static">{{  trans('InterfaceTranses.verified.'.$merchant->generate_report??0)??'' }}</p>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('params_json.report.is_send_to_merchant', trans('merchant.backend.is_send_to_merchant').':', ['class' => 'control-label col-sm-4']) !!}
                <div class='col-sm-8'>
                    <p class="form-control-static">{{  trans('InterfaceTranses.verified.'.($merchant->params_json['report']['is_send_to_merchant']??0)) }}</p>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('params_json.report.is_send_to_all_merchant_item', trans('merchant.backend.is_send_to_all_merchant_item').':', ['class' => 'control-label col-sm-4']) !!}
                <div class='col-sm-8'>
                    <p class="form-control-static">{{  trans('InterfaceTranses.verified.'.($merchant->params_json['report']['is_send_to_all_mechant_item']??0)) }}</p>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('params_json.report.last_send', trans('merchant.backend.last_send').':', ['class' => 'control-label col-sm-4']) !!}
                <div class='col-sm-8'>
                    <p class="form-control-static">{{ !isset($merchant->params_json['report']['last_send'])?null:\Carbon\Carbon::parse($merchant->params_json['report']['last_send'])->format("d.m.Y")}}</p>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group required">
                {!! Form::label('params_json.report.merchant_items', trans('merchant.backend.merchant_items').':', ['class' => 'control-label col-sm-4']) !!}
                <div class='col-sm-8'>
                    <p class="form-control-static">{{ $merchant->merchantItemsName??'' }}</p>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('params_json.report.period', trans('merchant.backend.period'), ['class' => 'control-label col-sm-4']) !!}
                <div class='col-sm-8'>
                    <p class="form-control-static">{{ $merchant->params_json['report']['period']??'xx:xx:xxxx' }}</p>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('params_json.report.interval', trans('merchant.backend.interval'), ['class' => 'control-label col-sm-4']) !!}
                <div class='col-sm-8'>
                    <p class="form-control-static">{{ $merchant->params_json['report']['interval']??0 }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="merchant-section">
    <div class="merchant-section-title">Доп. инфо</div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('id', trans('merchant.backend.id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->id }}</p>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('id', trans('merchant.backend.table.contract_date_at').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->contract_date_at??'' }}</p>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group col-sm-12">
                {!! Form::label('transit_account_id', trans('merchant.backend.transit_account_id').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->transit_account->number ?? $merchant->transit_account_id }}</p>
                </div>
            </div>
            <div class="form-group col-sm-12">
                {!! Form::label('transit_account_balance', trans('merchant.backend.transit_account_balance').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">  {{ $merchant->transit_account->balance ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('desc', trans('merchant.backend.creted_user_name').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->created_user->username ?? ''}}</p>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('desc', trans('merchant.backend.updated_user_name').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ $merchant->updated_user->username ?? ''}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('created_at', trans('merchant.backend.created_at').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ empty($merchant->created_at)?null:\Carbon\Carbon::parse($merchant->created_at)->format("d.m.Y H:i:s") }}</p>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class="form-group">
                {!! Form::label('updated_at', trans('merchant.backend.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
                <div class='col-sm-9'>
                    <p class="form-control-static">{{ empty($merchant->updated_at)?null:\Carbon\Carbon::parse($merchant->updated_at)->format("d.m.Y H:i:s") }}</p>
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