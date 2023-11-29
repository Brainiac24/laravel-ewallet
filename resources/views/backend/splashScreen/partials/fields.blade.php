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
            @if(isset($splashScreen->value))
                <img style="width: 164px; height: 164px" src="{!! url('/imgs/splash_screens/ldpi/'.$splashScreen->value) !!}" alt="{{ $splashScreen->value }}">
            @else
                <img style="width: 164px; height: 164px" src="{!! url('/imgs/splash_screens/no_photo.png') !!}" alt="no_photo.png">
            @endif
        </div>
    </div>
</div>

<div class="form-group required">
    {!! Form::label('icon', trans('splashScreen.backend.icon').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <div class="icon_select">
            {!! Form::select('icon', $splashScreens,  $splashScreen->value??null, ['class' => 'form-control select2']) !!}
        </div>
        {!! Form::file('icon_file', ['class' => 'form-control icon_file', "accept"=>"image/*","style" => "display:none"]) !!}
    </div>
</div>