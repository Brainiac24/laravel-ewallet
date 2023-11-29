<div class="form-group required">
    {!! Form::label('code', trans('city.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('code_map', trans('city.backend.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code_map', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('region.backend.country_id', trans('country.backend.title').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('country_id', $country, $selectedCountry??null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('region.backend.region_id', trans('region.backend.title').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('region_id',[''=>'--- Select region ---'],null,['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('area.backend.name', trans('area.backend.title').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('area_id',[''=>'--- Select area ---'],null,['class'=>'form-control']) !!}
    </div>
</div>

<!-- name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('city.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!--Desc Field -->
<div class="form-group required">
    {!! Form::label('desc', trans('city.backend.desc').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('desc', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('city.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled') , $city->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>

<script type="text/javascript">
   //console.log("before ajax");
   document.addEventListener('DOMContentLoaded', function() {
       $("select[name='country_id']").change(function () {

           var country_id = $(this).val();

           var token = $("input[name='_token']").val();

           $.ajax({

               url: "<?php echo route('admin.regions.getByCountyId') ?>",

               method: 'POST',

               data: {country_id: country_id, _token: token},

               success: function (data) {

                   $("select[name='region_id']").html('');
                   $("select[name='area_id']").html('');

                   $("select[name='region_id']").html(data.options);
               }

           });

       });

       $("select[name='region_id']").change(function () {

           var region_id = $(this).val();

           var token = $("input[name='_token']").val();

           $.ajax({

               url: "<?php echo route('admin.areas.getByRegionId') ?>",

               method: 'POST',

               data: {region_id: region_id, _token: token},

               success: function (data) {

                   $("select[name='area_id']").html('');

                   $("select[name='area_id']").html(data.options);
               }

           });

       });
   });
</script>