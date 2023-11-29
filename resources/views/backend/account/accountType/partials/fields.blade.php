<!-- code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('accountType.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- code_map Field -->
<div class="form-group required">
    {!! Form::label('code_map', trans('accountType.backend.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code_map', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('accountType.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- name Parent_id -->
<div class="form-group required">
    {!! Form::label('parent_id', trans('accountTypeDetail.backend.parent_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('parent_id', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Gateway Field -->
<div class="form-group required">
    {!! Form::label('gateway_id', trans('accountType.backend.gateway_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('gateway_id', $gateways, Route::is('admin.accounts.types.create') ? null : $selectedGatewayId, ['name' => 'gateway_id', 'id' => 'gateway_id', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите шлюз']) !!}
    </div>
</div>

<!-- Account Category Type Field -->
<div class="form-group required">
    {!! Form::label('account_category_type_id', trans('accountType.backend.account_category_type_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('account_category_type_id', $accountCategoryTypes, null , [ 'class' => 'form-control', 'data-placeholder' => 'Выберите категорию']) !!}
    </div>
</div>

<!--  Is exclude for fill Field -->
<div class="form-group required">
    {!! Form::label('is_exclude_for_fill', trans('accountType.backend.is_exclude_for_fill').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_exclude_for_fill', trans("InterfaceTranses.yesno") ,null) !!}
    </div>
</div>
<!-- Show block unblock Field -->
<div class="form-group required">
    {!! Form::label('is_show_menu_block_unblock', trans('accountType.backend.is_show_menu_block_unblock').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_show_menu_block_unblock', trans('InterfaceTranses.yesno'), null , [ 'class' => 'form-control', 'data-placeholder' => '']) !!}

    </div>
</div>

<!-- Is Autocheck Balance Field -->
<div class="form-group required">
    {!! Form::label('is_autocheck_balance', trans('accountType.backend.is_autocheck_balance').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_autocheck_balance', trans('InterfaceTranses.yesno'), null , [ 'class' => 'form-control', 'data-placeholder' => '']) !!}

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
            @if(isset($accountTypes))
                <img style="width: 164px" src="{!! url('/imgs/services/3/'.$accountTypes->img_uncolored) !!}" alt="{{ $accountTypes->img_uncolored }}">
            @else
                <img style="width: 164px" src="{!! url('/imgs/accounts/no_photo.png') !!}" alt="no_photo.png">
            @endif
        </div>
    </div>
</div>

<div class="form-group required">
    {!! Form::label('icon', trans('orderCardType.backend.icon').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <div class="icon_select">
            {!! Form::select('img_uncolored', $imgsUncolored,  null, ['class' => 'form-control select2']) !!}
        </div>
        {!! Form::file('icon_file', ['class' => 'form-control icon_file', "accept"=>"image/*","style" => "display:none"]) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('params_json', trans('accountType.backend.params_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <div id="jsoneditor"></div>
        {!! Form::hidden('params_json',  Route::is('admin.accounts.types.create') ? null : json_encode($accountTypes->params_json), ['class' => 'form-control']) !!}
    </div>
</div>

@section('page_js')
    <script>
        $(function(){
            function formatState (state) {
                if (!state.id) {
                    return state.text;
                }
                var baseUrl = '{!! url('/imgs/services/ldpi') !!}';
                var $state;

                if(state.element.value.toLowerCase() != "new") {
                    $state = $(
                        '<span><img src="' + baseUrl + "/" + state.element.value.toLowerCase() + '" class="img-flag" />  </span>'
                    );
                }
                return $state;
            };

            $("select[name=img_uncolored]").select2({
                templateResult: formatState
            });

            $("input[name=select_icon]").change(function (e) {
                e.preventDefault();
                var $value = $(this).val();

                if($value == "new")
                {
                    $(".icon_select").hide();
                    $(".icon_file").show();
                }else{
                    $(".icon_select").show();
                    $(".icon_file").hide();
                }
            });

            $(".icon_select .select2").change(function () {
                var $value = $(this).val();
                var $baseUrl = '{!! url('/imgs/services/3') !!}';
                if($value != "")
                {
                    $(".icon_file").val(null);
                    $(".icons img").attr("src",$baseUrl+"/"+$value);
                }else{
                    $(".icons img").attr("src","{!! url('/imgs/accounts/no_photo.png') !!}");
                }
            });

            $(".icon_file").change(function (e) {
                var input = this;
                var url = $(this).val();
                if (input.files && input.files[0])
                {
                    $(".icon_select .select2").val("").trigger("change");
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.icons img').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
                else
                {
                    $(".icons img").attr("src","{!! url('/imgs/accounts/no_photo.png') !!}");
                }
            })
        })
    </script>
@stop