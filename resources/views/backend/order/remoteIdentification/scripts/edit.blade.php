@include('backend.order.remoteIdentification.scripts.edit_service')
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btn-reject').click(function (e) {
            e.preventDefault();
            $remoteIdentificationService.reject();
        });

        $('#btn-update').click(function (e) {
            e.preventDefault();
            $remoteIdentificationService.update();
        });

        $("#confirmRejectModal .ok").click(function () {
            $('#form-remote-identification').submit();
        });

        $("#confirmCreateClientModal .ok").click(function () {
            $("#confirmCreateClientModal").modal('hide');
            $('#btn-search').click();
        });

        $('.adress_f').change(function () {
            $remoteIdentificationService.fillAdressStr();
        });

        $("#form-remote-identification .form-control, #is_resident_1").change(function (e) {
            $(".box-footer input").hide();
            $(".box-footer input#btn-update").show();
            $(".box-footer .message").text("Другие действие недоступны, сначало сохраните анкету");
        });

        $('#btn-accept-check-nalog').click(function (e) {
            e.preventDefault();
            $remoteIdentificationService.acceptCheckWithNalog();
        });

        $('#btn-accept').click(function (e) {
            e.preventDefault();
            $remoteIdentificationService.accept();
        });

        $('#btn-search, #btn-search-pre-processing').click(function (e) {
            e.preventDefault();
            var $selectorId = $(this).attr("id");
            var $attempt = 1;
            $remoteIdentificationService.searchClient($selectorId, $attempt);
        });

        $('#createClientModal .ok').click(function (e) {
            e.preventDefault();
            $remoteIdentificationService.createClient();
        });

        $("#confirmSearchModal .btn-update-client").click(function (e) {
            e.preventDefault();
            $remoteIdentificationService.updateClient();
        });


        $("#profile\\[country_id\\]").change(function () {
            var countryId = $(this).val();
            $remoteIdentificationService.fillRegions(countryId);
        });

        $("#profile\\[region_id\\]").change(function () {
            var regionId = $(this).val();
            $remoteIdentificationService.fillAreas(regionId);
        });

        $("#profile\\[district_id\\]").change(function () {
            var districtId = $(this).val();
            $remoteIdentificationService.fillCities(districtId);
        });

        $(".new-window-img").click(function (e) {
            e.preventDefault();
            if ($('.photoviewer-modal').length==0) {
                var thisImg = {
                    src: $(this).attr('href'),
                    title: $(this).attr('data-title')
                };
                var items = [],
                    options = {
                        index: $(this).index(),
                        headerToolbar: [
                            'minimize',
                            'maximize',
                            'close'
                        ],
                        footerToolbar: [
                            'prev',
                            'next',
                            'zoomIn',
                            'zoomOut',
                            'fullscreen',
                            'actualSize',
                            'rotateLeft',
                            'rotateRight',
                            'save',
                            'mirror'
                        ],
                        customButtons: {
                            mirror: {
                                text: 'Зеркальный!',
                                title: 'Зеркальный!',
                                click: function (context, e) {
                                    if ($(".photoviewer-stage img").hasClass("imgscaleX_1")) {
                                        $(".photoviewer-stage img").removeClass("imgscaleX_1");
                                    } else {
                                        $(".photoviewer-stage img").addClass("imgscaleX_1");
                                    }
                                }
                            },
                            save: {
                                text: '<i class="fa fa-fw fa-save"></i> ',
                                title: 'Сохранить!',
                                click: function (context, e) {
                                    var gradus = context.rotateAngle;
                                    var url = context.$image[0].currentSrc;
                                    var flip = null;

                                    // Хардкод надо подумать
                                    url = url.replace("image", "changeImage");
                                    ajaxLoader.on();
                                    if ($(".photoviewer-modal:eq(" + (context.groupIndex) + ") .photoviewer-image").hasClass("imgscaleX_1")) {
                                        flip = "h";
                                    }
                                    $remoteIdentificationService.saveChangedImg(url, gradus, flip);
                                }
                            }
                        },
                        modalWidth: 120,
                        modalHeight: 120,
                        callbacks: {
                            beforeChange: function (context, index) {
                                console.log(context, index)
                            },
                            changed: function (context, index) {
                                console.log(context, index)
                            }
                        }
                    };

                items.push(thisImg);

                $('.new-window-img').each(function () {
                    if (thisImg.src != $(this).attr('href')) {
                        items.push({
                            src: $(this).attr('href'),
                            title: $(this).attr('data-title')
                        });
                    }
                });

                new PhotoViewer(items, options);
            }
        });

        $('body').on('click', ".photoviewer-button-rotateLeft, .photoviewer-button-rotateRight, .photoviewer-button-mirror", function(){
            $(this).closest(".photoviewer-modal")
                .find(".photoviewer-button-save")
                .addClass("red-tooltip")
                .tooltip("show");
        });

        function isValidatePassport(){
            var birth_date = $("#profile\\[birth_date\\]").val();
            var passport_issue_date = $("#profile\\[passport_issue_date\\]").val();
            var document_expiration_date = $("#profile\\[document_expiration_date\\]").val();
            var passport_years = new Date(new Date(passport_issue_date) - new Date(birth_date)).getFullYear() - 1970;
            var birth_years = new Date(new Date() - new Date(birth_date)).getFullYear() - 1970;
            var document_expiration_date = $("#profile\\[document_expiration_date\\]").val();
            var document_expiration_years = new Date(new Date(document_expiration_date) - new Date(passport_issue_date)).getFullYear() - 1970;
            if(passport_issue_date != "" && birth_date != "" && document_expiration_date=="") {
                if (passport_years < 25 && birth_years >= 25 || passport_years < 45 && birth_years >= 45) {
                    $(".passport-message").addClass("error").removeClass("success").text("Паспорт не действителень");
                } else {
                    $(".passport-message").addClass("success").removeClass("error").text("Паспорт действителень");
                }
            }else if(passport_issue_date == ""){
                $(".passport-message").addClass("error").removeClass("success").text("Поля Дата выдачи не задано!");
            }else if(birth_date == ""){
                $(".passport-message").addClass("error").removeClass("success").text("Поля Дата рождения не задано!");
            }else if (document_expiration_date !="") {
                var diff = new Date(document_expiration_date) - new Date(passport_issue_date);
                var days = Math.ceil(diff/(1000*60*60*24));
                if (document_expiration_years >= 10 && days>3655) {
                    $(".passport-message").addClass("error").removeClass("success").text("Паспорт не действителень");
                } else {
                    $(".passport-message").addClass("success").removeClass("error").text("Паспорт действителень");
                }
            }
        }

        $("#profile\\[birth_date\\]").change(function () {
            isValidatePassport();
        });
        $("#profile\\[passport_issue_date\\]").change(function () {
            isValidatePassport();
        });
        $("#profile\\[document_expiration_date\\]").change(function () {
            isValidatePassport();
        });
        $(document).ready(function () {
            isValidatePassport();
        });

        $("input[name=front_photo\\[status\\]],input[name=back_photo\\[status\\]],input[name=selfie_photo\\[status\\]],input[name=profile\\[status\\]],input[name=additional_photo\\[status\\]]").click(function(){
           if($(this).val() == 1){
               $(this).closest(".section-action").find(".section_comment").hide();
           }else{
               $(this).closest(".section-action").find(".section_comment").show();
           }
        });

        $("input[name=additional_photo\\[include\\]]").click(function(){
            if($(this).val() == 1){
                $(this).closest(".section-action").find(".section_comment").show();
            }else{
                $(this).closest(".section-action").find(".section_comment").hide();
            }
        });
    });
</script>

<style>
    .red-tooltip + .tooltip > .tooltip-inner {background-color: #f00;}
    .red-tooltip + .tooltip.top .tooltip-arrow { border-top-color:#f00; }
</style>