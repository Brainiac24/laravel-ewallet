@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:white; ">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>УПС!</strong> {{ trans('alerts.general.someproblems') }}<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif
