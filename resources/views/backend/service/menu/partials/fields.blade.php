<div class="form-group required">
    {!! Form::label('service_id', trans('menu.backend.service_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('service_id', ($services->pluck('name','id')->prepend('','')), Route::is('admin.menu.create') ? null : $services->id,
        ['name' => 'service_id', 'id' => 'service_id', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите
        '. mb_strtolower (trans('menu.backend.service_name'))]) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('category_id', trans('menu.backend.category_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('category_id', [''=>''] + $menu, Route::is('admin.menu.create') ? null : $cat_id, ['name' => 'category_id',
        'id' => 'category_id', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите '. mb_strtolower (trans('menu.backend.category_name'))])
        !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('position', trans('menu.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('position', Route::is('admin.menu.create') ? null : $position, ['class' => 'form-control']) !!}
    </div>
</div>


{!! Form::hidden('old_category_id', Route::is('admin.menu.create') ? null : $cat_id ) !!}
