;(function () {

    'use strict';

    $("a").on('click', function (event) {
        if (this.hash === "") {
            return false;
        }

        var hash = this.hash;
        $('html, body').animate({
            scrollTop: $(hash).offset().top
        }, 800, function () {
            window.location.hash = hash;
        });
    });

    var carousels = function() {
        $('.owl-carousel-fullwidth').owlCarousel({
            items: 1,
            loop: true,
            margin: 0,
            nav: true,
            dots: true,
            smartSpeed: 800,
            autoHeight: true
        });

        $(".owl-carousel1").owlCarousel(
            {
                loop:true,
                center: true,
                margin:0,
                responsiveClass:true,
                nav:false,
                responsive:{
                    0:{
                        items:1,
                        nav:false
                    },
                    600:{
                        items:1,
                        nav:false
                    },
                    1000:{
                        items:3,
                        nav:true,
                        loop:false
                    }
                }
            }
        );

        $(".owl-carousel2").owlCarousel(
            {
                loop:true,
                center: false,
                margin:0,
                responsiveClass:true,
                nav:true,
                responsive:{
                    0:{
                        items:1,
                        nav:false
                    },
                    600:{
                        items:2,
                        nav:false
                    },
                    1000:{
                        items:3,
                        nav:true,
                        loop:true
                    }
                }
            }
        );
    }


    // svg responsive in mobile mode
    var checkPosition = function() {
        if ($(window).width() < 767) {
            $("#bg-services").attr("viewBox", "0 0 1050 800");

        }
    };

    (function($) {
        carousels();
        checkPosition();
        // testimonialCarousel();
    })(jQuery);


// Wrap every letter in a span
    $('.ml3').each(function(){
        $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
    });

    anime.timeline({loop: true})
        .add({
            targets: '.ml3 .letter',
            opacity: [0,1],
            easing: "easeInOutQuad",
            duration: 2250,
            delay: function(el, i) {
                return 150 * (i+1)
            }
        }).add({
        targets: '.ml3',
        opacity: 0,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
    });

    // Wrap every letter in a span
    $('.ml12').each(function(){
        $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
    });

    anime.timeline({loop: true})
        .add({
            targets: '.ml12 .letter',
            translateX: [40,0],
            translateZ: 0,
            opacity: [0,1],
            easing: "easeOutExpo",
            duration: 1200,
            delay: function(el, i) {
                return 500 + 30 * i;
            }
        }).add({
        targets: '.ml12 .letter',
        translateX: [0,-30],
        opacity: [1,0],
        easing: "easeInExpo",
        duration: 1100,
        delay: function(el, i) {
            return 100 + 30 * i;
        }
    });

    anime.timeline({loop: true})
        .add({
            targets: '.ml8 .circle-white',
            scale: [0, 3],
            opacity: [1, 0],
            easing: "easeInOutExpo",
            rotateZ: 360,
            duration: 1100
        }).add({
        targets: '.ml8 .circle-container',
        scale: [0, 1],
        duration: 1100,
        easing: "easeInOutExpo",
        offset: '-=1000'
    }).add({
        targets: '.ml8 .circle-dark',
        scale: [0, 1],
        duration: 1100,
        easing: "easeOutExpo",
        offset: '-=600'
    }).add({
        targets: '.ml8 .letters-left',
        scale: [0, 1],
        duration: 1200,
        offset: '-=550'
    }).add({
        targets: '.ml8 .bang',
        scale: [0, 1],
        rotateZ: [45, 15],
        duration: 1200,
        offset: '-=1000'
    }).add({
        targets: '.ml8',
        opacity: 0,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1400
    });

    anime({
        targets: '.ml8 .circle-dark-dashed',
        rotateZ: 360,
        duration: 8000,
        easing: "linear",
        loop: true
    });

    anime.timeline({loop: true})
        .add({
            targets: '.ml15 .word',
            scale: [14,1],
            opacity: [0,1],
            easing: "easeOutCirc",
            duration: 800,
            delay: function(el, i) {
                return 800 * i;
            }
        }).add({
        targets: '.ml15',
        opacity: 0,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
    });

    $('.ml16').each(function(){
        $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
    });

    anime.timeline({loop: true})
        .add({
            targets: '.ml16 .letter',
            translateY: [-100,0],
            easing: "easeOutExpo",
            duration: 1400,
            delay: function(el, i) {
                return 30 * i;
            }
        }).add({
        targets: '.ml16',
        opacity: 0,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
    });

    var ml4 = {};
    ml4.opacityIn = [0,1];
    ml4.scaleIn = [0.2, 1];
    ml4.scaleOut = 3;
    ml4.durationIn = 800;
    ml4.durationOut = 600;
    ml4.delay = 500;

    anime.timeline({loop: true})
        .add({
            targets: '.ml4 .letters-1',
            opacity: ml4.opacityIn,
            scale: ml4.scaleIn,
            duration: ml4.durationIn
        }).add({
        targets: '.ml4 .letters-1',
        opacity: 0,
        scale: ml4.scaleOut,
        duration: ml4.durationOut,
        easing: "easeInExpo",
        delay: ml4.delay
    }).add({
        targets: '.ml4 .letters-2',
        opacity: ml4.opacityIn,
        scale: ml4.scaleIn,
        duration: ml4.durationIn
    }).add({
        targets: '.ml4 .letters-2',
        opacity: 0,
        scale: ml4.scaleOut,
        duration: ml4.durationOut,
        easing: "easeInExpo",
        delay: ml4.delay
    }).add({
        targets: '.ml4 .letters-3',
        opacity: ml4.opacityIn,
        scale: ml4.scaleIn,
        duration: ml4.durationIn
    }).add({
        targets: '.ml4 .letters-3',
        opacity: 0,
        scale: ml4.scaleOut,
        duration: ml4.durationOut,
        easing: "easeInExpo",
        delay: ml4.delay
    }).add({
        targets: '.ml4',
        opacity: 0,
        duration: 500,
        delay: 500
    });
}());

// menu toggle button
function myFunction(x) {
    x.classList.toggle("change");
}
