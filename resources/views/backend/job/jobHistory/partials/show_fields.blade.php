<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobHistory.backend.table.id')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobHistory->id }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobHistory.backend.table.name')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobHistory->name }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobHistory.backend.table.payload')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="{{ $jobHistory->payload==null ?: 'json-params' }}">{{$jobHistory->payload }}</p>
    </div>
</div>


<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobHistory.backend.error_message')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobHistory->error_message }}</p>
    </div>
</div>



<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobHistory.backend.table.created_user')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobHistory->createdBy->username??''}}</p>
    </div>
</div>



<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobHistory.backend.table.created_at')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ \Carbon\Carbon::parse($jobHistory->created_at)->format("d.m.Y H:i:s") }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobHistory.backend.table.updated_at')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ \Carbon\Carbon::parse($jobHistory->updated_at)->format("d.m.Y H:i:s") }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobHistory.backend.table.processed_at')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ \Carbon\Carbon::parse($jobHistory->processed_at)->format("d.m.Y H:i:s") }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobHistory.backend.table.finished_at')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ \Carbon\Carbon::parse($jobHistory->finished_at)->format("d.m.Y H:i:s") }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobHistory.backend.table.status')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobHistory->status}}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobHistory.backend.filename')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobHistory->filename}}</p>
    </div>
</div>