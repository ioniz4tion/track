if (localStorage['desktopClick'] === "true") {
    var desktopClick = true;
} else {
    var desktopClick = false;
};

window.onload = (function() {

    // look for a mobile user agent
    var uA = {

        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },

        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },

        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },

        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },

        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },

        any: function() {
            return (uA.Android() || uA.BlackBerry() || uA.iOS() || uA.Opera() || uA.Windows());
        }

    };

    // do we go to mobile version?
    if (uA.any()) {

        // mobile UA found; decide to go to mobile version
        toMobile = true;
        console.log('toMobile: ' + toMobile);

    } else {

        // mobile UA not found; decide to stick with desktop version
        toMobile = false;
        console.log('toMobile: ' + toMobile);

    };

    // look for 'mobile' in the filename
    var path = location.pathname.substring(location.pathname.lastIndexOf('/')+1),
        name = path.search('mobile');
    console.log('path: ' + path);

    // is the page mobile?
    if (name === -1) {

        // 'mobile' was not found; page is desktop version
        isMobile = false;
        console.log('isMobile: ' + isMobile);

    } else {

        // 'mobile' was found; page is mobile version
        isMobile = true;
        console.log('isMobile: ' + isMobile);

    };

    // if the UA is mobile and the page is not, and #desktop has not been clicked, redirect to mobile
    if (toMobile === true && isMobile === false && desktopClick === false) {

        if (path === 'index.html' || path === '') {

            // redirect index.html to index-mobile.html
            window.location.assign('index-mobile.html');

        } else if (path === 'alt-en.html') {

            // redirect alt-en.html to alt-en-mobile.html
            window.location.assign('alt-en-mobile.html');

        } else if (path === 'diy.html') {

            // redirect diy.html to diy-mobile.html
            window.location.assign('diy-mobile.html');

        } else if (path === 'buying.html') {

            // redirect buying.html to buying-mobile.html
            window.location.assign('buying-mobile.html');

        } else if (path === 'about.html') {

            // redirect about.html to about-mobile.html
            window.location.assign('about-mobile.html');

        };

    };

    // if #mobile is clicked on the desktop version, go to mobile
    $('#mobile').click(function() {

        // store the value 'false' when #mobile is clicked
        var desktopClick = false;
        localStorage['desktopClick'] = "false";

        // find filename and switch to mobile
        if (path === 'index.html' || path === '') {

            // redirect index.html to index-mobile.html
            window.location.assign('index-mobile.html');

        } else if (path === 'alt-en.html') {

            // redirect alt-en.html to alt-en-mobile.html
            window.location.assign('alt-en-mobile.html');

        } else if (path === 'diy.html') {

            // redirect diy.html to diy-mobile.html
            window.location.assign('diy-mobile.html');

        } else if (path === 'buying.html') {

            // redirect buying.html to buying-mobile.html
            window.location.assign('buying-mobile.html');

        } else if (path === 'about.html') {

            // redirect about.html to about-mobile.html
            window.location.assign('about-mobile.html');

        };

        // new page is now mobile
        isMobile = true;

    });

    // if #desktop is clicked on mobile version, go to desktop
    $('#desktop').click(function() {

        // tell the browser that #desktop has been clicked so that page doesn't go back to mobile
        var desktopClick = true;
        localStorage['desktopClick'] = "true";
        console.log('desktopClick: ' + desktopClick);

        // find filename and switch to desktop
        if (path === 'index-mobile.html') {

            // redirect index-mobile.html to index.html
            window.location.assign('index.html');

        } else if (path === 'alt-en-mobile.html') {

            // redirect alt-en-mobile.html to alt-en.html
            window.location.assign('alt-en.html');

        } else if (path === 'diy-mobile.html') {

            // redirect diy-mobile.html to diy.html
            window.location.assign('diy.html');

        } else if (path === 'buying-mobile.html') {

            // redirect buying-mobile.html to buying.html
            window.location.assign('buying.html');

        } else if (path === 'about-mobile.html') {

            // redirect about-mobile.html to about.html
            window.location.assign('about.html');

        };
    });
       
    // console.log('desktopClick: ' + desktopClick);

});