<script>
    const usedIcons = {!! json_encode($usedIcons) !!};
    console.log(usedIcons);
    $(function(){
        function formatState (state) {
            console.log(state);
            if (!state.id) {
                return state.text;
            }
            var baseUrl = '{!! url('/imgs/accounts/ldpi/all_') !!}';
            var $state;

            if(state.element.value.toLowerCase() != "new") {
                $state = $(
                    '<span><img src="' + baseUrl + state.element.value.toLowerCase() + '" class="img-flag" />  '+state.text +'</a>'
                );
            }
            return $state;
        };

        $("select[name=icon]").select2({
            templateResult: formatState
        });

        $("input[name=select_icon]").change(function (e) {
            e.preventDefault();

            var $value = $(this).val();

            if($value == "new")
            {
                $(".icon_select").hide();
                $(".icon_file").show();
                $('#delete_image').hide();
            }else{
                $(".icon_select").show();
                $(".icon_file").hide();
            }
        });

        $(".icon_select .select2").change(function () {
            var $value = $(this).val();
            console.log($value);
            console.log(usedIcons[$value]);
            var $baseUrl = '{!! url('/imgs/accounts/3/all_') !!}';
            if($value != "")
            {
                $(".icon_file").val(null);
                $(".icons img").attr("src",$baseUrl+$value+"");

                if(usedIcons[$value]!=undefined && usedIcons[$value] =='used'){
                    $('#delete_image').hide();
                    alert('used');
                }else{
                    $('#delete_image').html('Удалить выбранную иконку(<span class="text-success">Эта иконка не используется</span>)').show();
                }
                $('#delete_image').data('image',$value);

            }else{
                $(".icons img").attr("src","{!! url('/imgs/accounts/no_photo.png') !!}");
            }
            $()
        });

        $(".icon_file").change(function (e) {
            var input = this;
            var url = $(this).val();
            if (input.files && input.files[0])
            {
                $(".icon_select .select2").val("").trigger("change");
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.icons img').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
            else
            {
                $(".icons img").attr("src","{!! url('/imgs/accounts/no_photo.png') !!}");
            }
        });

        $('#delete_image').click(function (event) {
            const deleteBtn = $(this);
            event.preventDefault();
            const icon = $(this).data('image');
            console.log(icon);
            const trimed = icon.replace('.png','');
            console.log(trimed);

           if(icon.length){
                $.get({
                    url: '/admin/orderCardType/icon/'+icon+ '/delete',
                    success(response){
                        console.log(response);
                        if(response.success == true){
                            $(".icons img").attr("src","{!! url('/imgs/accounts/no_photo.png') !!}");
                            console.log($(".select2 option[value^="+trimed+"]"));
                            $(".select2 option[value^="+trimed+"]").remove();
                            deleteBtn.hide();
                        }

                    }
                });
            }
        });
    })
</script>