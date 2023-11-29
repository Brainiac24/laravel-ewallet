<script id="hidden-template" type="text/x-custom-template">
    <div id="#formSrch" style="width: 500px; height: 150px">
        <form class="form-horizontal">
            <fieldset style="padding-top: 15px!important;" >
               <div class="row">
                    <div class="form-group"  >
                        <label class="col-md-4 control-label" for="msisdn">Номер Телефона</label>
                        <div class="col-md-5">
                            <input id="msisdn" name="msisdn" type="search" placeholder="№ Телефона" value="{{  old('msisdn') ?? $data['msisdn'] ?? null }}" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="searchinput">ФИО Содержит</label>
                        <div class="col-md-5">
                            <input name="full_name" type="search" placeholder="ФИО" value="{{ old('full_name') ?? $data['full_name'] ?? null }}" class="form-control input-md" >
                        </div>
                    </div>
                    <!-- Button -->
                    <div class="form-group" >
                        <label class="col-md-4 control-label" for="search"></label>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary" style="padding: 6px 12px!important;">Поиск</button>
                            {!! link_to(route('admin.clients.index'), 'Сбросить',['class' => 'btn btn-danger', 'style'=>'padding: 6px 12px!important;']) !!}
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</script>