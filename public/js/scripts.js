$(document).on('click', '.box-t-1', function() {
    $(this).next('.middle-cont').slideToggle("fast", function() {
        // Animation complete.
    });;

});

$(document).on('click', '.box-t-3', function() {
    $(this).parent().children('.middle-1').slideToggle("fast", function() {
        // Animation complete.
    });;

});

$(document).ready(function() {


    $('.middle-1').each(function (item) {
        $('div:contains("/api/v2/")', item).closest('.middle-1').children('.box-t-1').css('color', '#22985d');
    })


    function getJson2($value) {
        if ($value != '') {
            try {
                return JSON.parse($value);
            } catch (ex) {
                //alert('Wrong JSON Format: ' + ex + $($class).val());
            }
        }
    }

    function getJson($class) {
        if ($($class).val() != '') {
            try {
                return JSON.parse($($class).val());
            } catch (ex) {
                alert('Wrong JSON Format: ' + ex + $($class).val());
            }
        }
    }

    $('.middle-1').each(function() {

        try {

            $('.json-display-1', this).jsonViewer(getJson2($('.json-input-1', this).val()), {
                collapsed: false,
                withQuotes: true
            });
            $('.json-display-2', this).jsonViewer(getJson2($('.json-input-2', this).val()), {
                collapsed: false,
                withQuotes: true
            });
            $('.json-display-4', this).jsonViewer(getJson2($('.json-input-4', this).val()), {
                collapsed: false,
                withQuotes: true
            });
            $('.json-display-5', this).jsonViewer(getJson2($('.json-input-5', this).val()), {
                collapsed: false,
                withQuotes: true
            });

            var left = getJson2($('.json-input-1', this).val());
            var right = getJson2($('.json-input-2', this).val());

            var left4 = getJson2($('.json-input-4', this).val());
            var right4 = getJson2($('.json-input-5', this).val());

            var left2 = $('.url-1', this).attr('href');
            var right2 = $('.url-2', this).attr('href');

            var left3 = $('.par-1', this).html();
            var right3 = $('.par-2', this).html();


            var delta = jsondiffpatch.diff(left, right);
            var delta2 = jsondiffpatch.diff(left2, right2);
            var delta3 = jsondiffpatch.diff(left3, right3);
            var delta4 = jsondiffpatch.diff(left4, right4);



            // beautiful html diff
            $('.visual', this).html(jsondiffpatch.formatters.html.format(delta, left));
            $('.visual-2', this).html(jsondiffpatch.formatters.html.format(delta4, left4));
            $('.url-3', this).html(jsondiffpatch.formatters.html.format(delta2, left2));
            $('.par-3', this).html(jsondiffpatch.formatters.html.format(delta3, left3));
        } catch (error) {

        }


    })


    jsondiffpatch.formatters.html.showUnchanged();




    //var editor = new JsonEditor('.json-display-1', getJson('.json-input-1'));





    setTimeout(function() {

        $('.url-3, .par-3, .visual, .visual-2').each(function() {
            if ($(this).text() == '') {
                $(this).text("Нет изменений");
            }
        })

    }, 1000)



});