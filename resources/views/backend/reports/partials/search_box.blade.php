<div class="box box-default form-horizontal @if($data !=[] or $type_code === "default")  @else collapsed-box @endif">
    <div class="box-header with-border">
        <h3 class="box-title">Расширенный поиск</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-filter"></i><label></label>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        @if (isset($data))
            <form action="{{ url()->current() }}?{{ implode(',', $data) }}" method="GET">
                @endif
                <div class="form-group">
                    {!! Form::label('report_type_id', trans('reports.backend.table.report_type_id'), ['class' => 'col-sm-5 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::select ('report_type_id', \App\Models\ReportType\ReportType::listAll()->prepend("", ""), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div id="serchbox-fields">
                    @if ($type_code != "default")
                        @include('backend.reports.partials.fields_search_boxes.'.$type_code.'')
                    @endif
                </div>
                <div class="form-group">
                        <div for="number" class="col-sm-5 control-label"></div>
                        {!! Form::submit('Поиск', ['class' => 'btn btn-primary','name'=>'search']) !!}<a type="submit" class="btn btn-danger" href="{!! route('admin.reports.index') !!}" style="margin: 0 8px;">Сбросить</a>
                        {!! Form::submit('Экпортировать', ['class' => 'btn btn-primary','name'=>'export']) !!}

                    
                </div>
            </form>
            <!-- /.box-body -->
    </div>
</div>