<div class="form-group required">
    {!! Form::label('name', trans('reportAnalysis.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('params_json[incomeServices]', trans('reportAnalysis.backend.incomeServices').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('params_json[incomeServices]', $services, Route::is('admin.report_analysis.create') ? null : $selectedIncomeServices, ['name' => 'params_json[incomeServices][]', 'id' => 'select2_perms', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите сервисы для доходов', 'multiple']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('params_json[expenseServices]', trans('reportAnalysis.backend.expenseServices').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('params_json[expenseServices]', $services, Route::is('admin.report_analysis.create') ? null : $selectedExpenseServices, ['name' => 'params_json[expenseServices][]', 'id' => 'select2_perms', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите сервисы для расходов', 'multiple']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('params_json[incomeAccountTypes]', trans('reportAnalysis.backend.incomeAccountTypes').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('params_json[incomeAccountTypes]', $accountTypes, Route::is('admin.report_analysis.create') ? null : $selectedIncomeAccountTypes, ['name' => 'params_json[incomeAccountTypes][]', 'id' => 'select2_perms', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите тип аккаунта для доходов', 'multiple']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('params_json[expenseAccountTypes]', trans('reportAnalysis.backend.expenseAccountTypes').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('params_json[expenseAccountTypes]', $accountTypes, Route::is('admin.report_analysis.create') ? null : $selectedExpenseAccountTypes, ['name' => 'params_json[expenseAccountTypes][]', 'id' => 'select2_perms', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите тип аккаунта для расходов', 'multiple']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('is_active', trans('reportAnalysis.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled') , $reportAnalysis->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>
