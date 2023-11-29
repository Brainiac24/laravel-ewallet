<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('dwhRule.backend.table.id')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $dwhRule->id }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('dwhRule.backend.table.table')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $dwhRule->table }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('dwhRule.backend.table.job_log_type')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ config('job_log_type_helper.types')[$dwhRule->job_log_type] }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('dwhRule.backend.table.to_dwh_days')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $dwhRule->to_dwh_days }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('dwhRule.backend.table.delete_from_dwh_days')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{$dwhRule->delete_from_dwh_days }}</p>
    </div>
</div>



