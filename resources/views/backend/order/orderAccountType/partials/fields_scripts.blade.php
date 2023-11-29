 <script>
    $(function(){
        function formatState (state) {
            if (!state.id) {
                return state.text;
            }
            var baseUrl = '{!! url('/imgs/orders/accounts/ldpi/') !!}';
            var $state;

            if(state.element.value.toLowerCase() != "new") {
                $state = $(
                    '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" />  </span>'
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
            }else{
                $(".icon_select").show();
                $(".icon_file").hide();
            }
        });

        $(".icon_select .select2").change(function () {
            var $value = $(this).val();
            var $baseUrl = '{!! url('/imgs/accounts/3/all_') !!}';
            if($value != "")
            {
                $(".icon_file").val(null);
                $(".icons img").attr("src",$baseUrl+$value+".png");
            }else{
                $(".icons img").attr("src","{!! url('/imgs/accounts/no_photo.png') !!}");
            }
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
        })


        CKEDITOR.replace( 'contract_html-ckeditor', {});

    })
</script>