<div class="box box-default form-horizontal @if($data==[])collapsed-box @endif">
    <div class="box-header with-border">
        <h3 class="box-title">Расширенный поиск</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                        class="fa fa-filter"></i><label></label></button>
            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        @if (isset($data))
            <form action="{{ url()->current() }}?{{ implode(',', $data) }}" method="GET">
                @endif
                @include('backend.user.event.partials.fields_search_box')
                <div class="form-group">
                    <div for="number" class="col-sm-5 control-label"></div>
                    {!! Form::submit('Поиск', ['class' => 'btn btn-primary','name'=>'search']) !!}<a type="submit"
                                                                                                     class="btn btn-danger"
                                                                                                     href="{!! route('admin.users.events.index') !!}"
                                                                                                     style="margin: 0 8px;">Сбросить</a>

                </div>
            </form>
            <!-- /.box-body -->
    </div>
</div>