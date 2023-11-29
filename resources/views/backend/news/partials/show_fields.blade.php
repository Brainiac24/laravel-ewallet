<div class="form-group">
    {!! Form::label('id', trans('news.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $news->id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('title', trans('news.backend.table.title').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $news->title }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('short_description', trans('news.backend.table.short_description').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $news->short_description }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('description', trans('news.backend.table.description').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $news->description }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('tags', trans('news.backend.table.tags').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $news->tags }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('news.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $news->is_active }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('position', trans('news.backend.table.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $news->position }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('image_name_text', trans('news.backend.image_name'), ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::label('image_name_text', $news->image_name ?? 'Картинка не установлено', ['class' => 'control-label col-sm-5']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('image', trans('news.backend.image').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        @if($news->image_name != null)
            <img src="{!! url('/imgs/news/ldpi/'.$news->image_name.'_big.jpg') !!}" alt="{{ $news->image_name }}">
        @else
            {!! Form::label('image_is_null', 'Картинка не установлено', ['class' => 'control-label col-sm-0']) !!}
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('news.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $news->created_at }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('news.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $news->updated_at }}</p>
    </div>
</div>