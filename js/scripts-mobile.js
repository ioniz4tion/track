$(document).ready(function() {

    var bool = false,
        $width = $(window).width(),
        $headerBig = $('.header-big'),
        $arrow = $('#arrow'),
        $version = $('#version'),
        $footerLinks = $('.footer-links'),
        $login = $('.login'),
        $copyright = $('.copyright');

    var setHeaderBigSize = function() {

        var sizeSource = $width,
            scaleFactor = 0.115;

        var fontSize = sizeSource * scaleFactor;
        $('.header-big').css({
            'font-size' : fontSize + 'px'
        });

    };

    var setHeaderSmallSize = function() {

        var sizeSource = $width,
            scaleFactor = .03;

        var fontSize = sizeSource * scaleFactor;
        $('.header-small').css({
            'font-size' : fontSize + 'px'
        });
    };

    var setHeaderLinkProps = function() {

        var sizeSource = $width,
            scaleFactor1 = 0.057;

        var fontSize = sizeSource * scaleFactor1;
        $('.header-link').css({
            'font-size' : fontSize + 'px'
        });

        var dimSource = $width,
            scaleFactor2 = 0.7;

        var dimSize = dimSource * scaleFactor2;
        $('.header-link').css({
            'width'  : dimSize + 'px',
            'height' : dimSize + 'px'
        });

    };

    var setFooterHeightVar = function() {
        footerHeight = $arrow.height() + $version.height() + $footerLinks.height() + $login.height() + $copyright.height() + 30;
    };

    var slide = function() {

        if (bool === false) {

            $('footer').css({
                'height' : footerHeight + 'px'
            });

            $('#arrow').css({
                '-ms-transform'     : 'rotate(180deg)',
                '-moz-transform'    : 'rotate(180deg)',
                '-webkit-transform' : 'rotate(180deg)',
                '-o-transform'      : 'rotate(180deg)'
            });

            bool = true;

        } else {

            $('footer').css({
                'height' : '80px'
            });

            $('#arrow').css({
                '-ms-transform'     : 'rotate(0deg)',
                '-moz-transform'    : 'rotate(0deg)',
                '-webkit-transform' : 'rotate(0deg)',
                '-o-transform'      : 'rotate(0deg)'
            });

            bool = false;

        };
    };

    $(window).resize(function() {
        setHeaderBigSize();
        setHeaderSmallSize();
        setHeaderLinkProps();
        setFooterHeightVar();
    });

    $('#arrow').click(function() {
        slide();
    });

    setHeaderBigSize();
    setHeaderSmallSize();
    setHeaderLinkProps();
    setFooterHeightVar();

});