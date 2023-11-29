<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">ID:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $scheduleJob->id }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">Job:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{$scheduleTypes[$scheduleJob->displayName]->name??$scheduleJob->displayName }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('scheduleJob.backend.payload')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="{{ $scheduleJob->payload==null ?: 'json-params' }}">{{json_encode($scheduleJob->payload) }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('scheduleJob.backend.queue')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $scheduleJob->queue }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('scheduleJob.backend.available_at')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $scheduleJob->available_at }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('scheduleJob.backend.created_at')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $scheduleJob->created_at }}</p>
    </div>
</div>

