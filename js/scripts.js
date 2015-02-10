$(document).ready(function() {

    var bool = false,
        $height = $(window).height(),
        $nav = $('nav'),
        $navLink1 = $('nav a span'),
        $navLink2 = $('nav a::before'),
        $header = $('header'),
        $headerStuff = $('#header-stuff'),
        $article = [
            $('#track-info'),
            $('#field-info'),
            $('#news'),
            $('#schedule'),
            $('#records'),
            $('#coaches')
        ],
        $imp = ' !important';

    var setNavLinkPadding = function() {

        var linkNumber = $('nav a').length,
            totalTextHeight = linkNumber * $navLink1.height(),
            paddingSource = $nav.height() - (76 + totalTextHeight),
            paddingSize1 = paddingSource / linkNumber,
            paddingSize2 = paddingSize1 / 2;

        console.log('linkNumber: ' + linkNumber);
        console.log('totalTextHeight: ' + totalTextHeight);
        console.log('paddingSource: ' + paddingSource);
        console.log('paddingSize1: ' + paddingSize1);
        console.log('paddingSize2: ' + paddingSize2);

        console.log($navLink1.height() + 'px');

        $('nav a span').css({
            'padding-top'    : paddingSize2 + 'px !important',
            'padding-bottom' : paddingSize2 + 'px !important'
        });

        $('nav a::before').css({
            'padding-top'    : paddingSize2 + 'px !important',
            'padding-bottom' : paddingSize2 + 'px !important'
        });

    };

    var setHeaderHeight = function() {
        var heightSource = $height;
        $('header').css('min-height', $height);
    };

    var setHeaderPaddingVar = function() {

        paddingSize = ($header.height() - $headerStuff.height()) * 0.5;

    };

    var setHeaderPadding = function() {

        $('header').css({
            'padding-top'    : (paddingSize - 1) + 'px',
            'padding-bottom' : (paddingSize - 1) + 'px'
        });
    };

    /*var setArticleMargin = function() {
        var i = 0;

        for (i; i < 6; i++) {

            if ($article[i].height() <= $height) {
                var marginSize = ($height - $article[i].height()) * 0.5
                $article[i].css({
                    'margin-bottom' : (marginSize - 1) + 'px'
                });
            } else {

            }

        };

    };*/
    
    var setAboutDivHeight = function() {

        if ($(window).width() >= 1080) {
            var heightSource = $(window).width(),
                scaleFactor = 0.3;
            var heightSize = heightSource * scaleFactor;
            $('.about-div').css({
                'height' : heightSize + 'px'
            });
        } else {




            //THIS WAS OUTPUTTING AN ERROR SO I COMMENTED IT OUT. FIX IT IF YOU CAN OR JUST LEAVE IT COMMENTED
            //IF IT DOESN'T DO ANYTHING.
            //var heightSource = $aboutImgs.height()




            //var heightSize = heightSource;
           // $('.about-div').css({
           //     'height' : heightSize + 'px'
           // });





        };

    };

    var hashTagActive = "";
    $(".scroll").click(function (event) {
        
        if ($(window).width() >= 844) {
            var offsetTop = 30;
        } else {
            var offsetTop = 20;
        };

        if (hashTagActive != this.hash) { //this will prevent if the user click several times the same link to freeze the scroll.
            event.preventDefault();
            //calculate destination place
            var dest = 0;
            if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
                dest = $(document).height() - $(window).height() - offsetTop;
            } else {
                dest = $(this.hash).offset().top - offsetTop;
            }
            //go to destination
            $('html,body').animate({
                scrollTop: dest
            }, 500, 'swing');
            hashTagActive = this.hash;
        }
    });

    $('#scroll-down').click(function(event) {
        event.preventDefault();
        var n = $(window).height() + 20;
        $('html, body').animate({ scrollTop: n }, 500);
    });

    $(window).resize(function() {
        //setNavLinkPadding();
        setHeaderHeight();
        // setHeaderPaddingVar();
        // setHeaderPadding();
        //setFooterHeightVar();





        //THIS WAS OUTPUTTING AN ERROR SO I COMMENTED IT OUT. FIX IT IF YOU CAN OR JUST LEAVE IT COMMENTED
        //IF IT DOESN'T DO ANYTHING.
        //setFooterHeight();






        setAboutDivHeight();
    });

    $('#arrow').click(function() {
        slide();
        setFooterHeight();
    });

    //setNavLinkPadding();
    setHeaderHeight();
    // setHeaderPaddingVar();
    // setHeaderPadding();
    //setArticleMargin();
    //setFooterHeightVar();
    setAboutDivHeight();

});