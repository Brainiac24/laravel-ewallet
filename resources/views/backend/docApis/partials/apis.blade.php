@foreach($apiCategories as $category)
<div class="middle-0">
    <div class="box-t-3">{{ $category->name }}</div>

   

    @php
        $old_group = 0;
    @endphp

    @foreach($category->apis as $api)
    


        @if ($api->group != $old_group)
        

            @if ($old_group != 0)

                </div>

            </div>
            
            @endif

        
            @php
                $old_group = (float)$api->group;
            @endphp    
                            
   
        
            <div class="middle-1">
                <div class="box-t-1">{{ $api->name }}</div>
                <div class="middle-cont">
        
        @endif



        @if ($api->version == 1)

        <div class="col-2">
            <div class="box-2">
                <div class="box-t-3">
                    <div class="rest-get">{{ $api->method }} - v{{ $api->version }}</div>
                    <a href="../../api/v1/test?url={{ $api->url_path }}"
                       class="box-t-2 url-1">..{{ $api->url_path }}</a>
                </div>
                <div class="box-t-4">
                    <div class="rest-params">PARAMS</div>
                    <pre class="params-cont par-1">{!!  $api->params !!}</pre>
                </div>

                <div class="json-cont">
                    <input type="hidden" class="json-input-1" value='{!! json_encode($api->response_success_json) !!}' />

                    <div class="rest-params">RESPONSE - 200</div>
                    <pre class="json-display-1"></pre>

                    <hr>

                    <input type="hidden" class="json-input-4" value='{!! json_encode($api->response_reject_json) !!}' />

                    <div class="rest-params">RESPONSE - 400</div>
                    <pre class="json-display-4"></pre>

                </div>
            </div>
        </div>


        @endif
        
        @if ($api->version == 2)
        
        <div class="col-2">
            <div class="box-2">
                <div class="box-t-3">
                    <div class="rest-get">{{ $api->method }} - v{{ $api->version }}</div>
                    <a href="../../api/v1/test?url={{ $api->url_path }}"
                       class="box-t-2 url-2">..{{ $api->url_path }}</a>
                </div>
                <div class="box-t-4">
                    <div class="rest-params">PARAMS</div>
                    <pre class="params-cont par-2">{!!  $api->params !!}</pre>
                </div>
                <div class="json-cont">
                    <input type="hidden" class="json-input-2" value='{!!  json_encode($api->response_success_json) !!}' />

                    <div class="rest-params">RESPONSE - 200</div>
                    <pre class="json-display-2"></pre>

                    <hr>

                    <input type="hidden" class="json-input-5" value='{!!  json_encode($api->response_reject_json) !!}' />

                    <div class="rest-params">RESPONSE - 400</div>
                    <pre class="json-display-5"></pre>
                </div>
            </div>
        </div>



        <div class="col-2">
            <div class="box-3">
                <div class="box-t-3">
                    <div class="rest-diff">DIFF</div>
                    <div class="box-t-2 url-3">Нет изменений</div>
                </div>
                <div class="box-t-4">
                    <div class="rest-params">PARAMS</div>
                    <pre class="params-cont par-3">
                    Нет изменений
                </pre>
                </div>
                <div class="rest-params-2">RESPONSE - 200</div>
                <div class="json-cont">
                    <div class="visual"></div>
                </div>

                <hr>

                <div class="rest-params-2">RESPONSE - 400</div>
                <div class="json-cont">
                    <div class="visual-2"></div>
                </div>
            </div>
        </div>

        @endif
                
                


      

    @endforeach

    @if ($old_group != 0)

            </div>

            </div>

    @endif

</div>
    
@endforeach

