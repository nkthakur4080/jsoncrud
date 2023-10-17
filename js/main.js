(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    // $(window).scroll(function () {
    //     if ($(this).scrollTop() > 300) {
    //         $('.sticky-top').addClass('bg-primary shadow-sm').css('top', '0px');
    //     } else {
    //         $('.sticky-top').removeClass('bg-primary shadow-sm').css('top', '-150px');
    //     }
    // });
    
    
    // Back to top button
    // $(window).scroll(function () {
    //     if ($(this).scrollTop() > 100) {
    //         $('.back-to-top').fadeIn('slow');
    //     } else {
    //         $('.back-to-top').fadeOut('slow');
    //     }
    // });
    // $('.back-to-top').click(function () {
    //     $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
    //     return false;
    // });


    // Countdown Timer
    // function countDownTimer() {	
    //     var endTime = new Date("31 December 2023 10:00:00 GMT+00:00");
    //     endTime = (Date.parse(endTime) / 1000);

    //     var now = new Date();
    //     now = (Date.parse(now) / 1000);

    //     var timeLeft = endTime - now;

    //     var days = Math.floor(timeLeft / 86400);
    //     var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
    //     var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
    //     var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

    //     if (days < "10") {
    //         days = "0" + days;
    //     }
    //     if (hours < "10") {
    //         hours = "0" + hours;
    //     }
    //     if (minutes < "10") {
    //         minutes = "0" + minutes;
    //     }
    //     if (seconds < "10") {
    //         seconds = "0" + seconds;
    //     }

    //     $("#cdt-days").html(days + "<span>-Days-</span>");
    //     $("#cdt-hours").html(hours + "<span>-Hours-</span>");
    //     $("#cdt-minutes").html(minutes + "<span>-Mins-</span>");
    //     $("#cdt-seconds").html(seconds + "<span>-Secs-</span>");

    // }

    // Counter function
    $('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            
            //chnage count up speed here
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

    // setInterval(function () {
    //     countDownTimer();
    // }, 1000);


    // Mobile websites carousel
    $('.websites-carousel').owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 20,
        //stagePadding: 10,
        loop: true,
        nav: false,
        dots: true,
        items: 1,
        dotsData: true,
        // responsive: {
        //     0:{
        //         items:1
        //     },
        //     768:{
        //         items:1
        //     },
        //     992:{
        //         items:3
        //     }
        // }
    });
    
})(jQuery);

