/**
*
* -----------------------------------------------------------------------------
*
* Template : Reobiz – Consulting Business HTML Template
* Author : rs-theme
* Author URI : http://www.rstheme.com/
*
* -----------------------------------------------------------------------------
*
**/
(function($) {
	"use strict";

    // sticky menu
    var header = $('.menu-sticky');
    var win = $(window);

    win.on('scroll', function() {
       var scroll = win.scrollTop();
       if (scroll < 1) {
           header.removeClass("sticky");
       } else {
           header.addClass("sticky");
       }

        $("section").each(function() {
        var elementTop = $(this).offset().top - $('#rs-header').outerHeight();
            if(scroll >= elementTop) {
                $(this).addClass('loaded');
            }
        });

    });
	
    //window load
   $(window).on( 'load', function() {
        $("#loading").delay(1500).fadeOut(500);
        $("#loading-center").on( 'click', function() {
        $("#loading").fadeOut(500);
        })
    })

    //preloader
    $(window).on('load', function() {
       $("#loader").delay(1000).fadeOut(500);
    })

    // Progress Bar Round
    $('.rs-pie').each(function() {
        $(this).pieChart({
            barColor: '#1273eb',
            trackColor: '#eff2f6',
            lineCap: 'round',
            lineWidth: 8,
            size: 161,
            onStep: function (from, to, percent) {
                $(this.element).find('.rspie-value').text(Math.round(percent) + '%');
            }
        });
    });

    // Progress Bar Round 2
    $('.rs-pie2').each(function() {
        $(this).pieChart({
            barColor: '#1273eb',
            trackColor: '#eff2f6',
            lineCap: 'round',
            lineWidth: 8,
            size: 130,
            onStep: function (from, to, percent) {
                $(this.element).find('.rspie-value').text(Math.round(percent) + '%');
            }
        });
    });

    //Hover Parallax movement js
    $.fn.transformHeroes = function() {
        //Variables
        var perspective = '500px',
        delta = -100,
        width = this.width(),
        height = this.height(),
        midWidth = width / 2,
        midHeight = height / 2;
        //Events
        this.on({
            mousemove: function(e) {
                var pos = $(this).offset(),
                cursPosX = e.pageX - pos.left,
                cursPosY = e.pageY - pos.top,
                cursCenterX = midWidth - cursPosX,
                cursCenterY = midHeight - cursPosY;

                $(this).css('transform','perspective(' + perspective + ') rotateX('+ (cursCenterY / delta) +'deg) rotateY('+ -(cursCenterX / delta) +'deg)');
                $(this).removeClass('is-out');
            },
            mouseleave: function() {
                $(this).addClass('is-out');
            }
        });
        //Return
        return this;
    };
    $('.hoverparallax').transformHeroes();

    // onepage nav
    var navclose = $('#onepage-menu');
    if(navclose.length){
       $(".nav-menu li").on("click", function () {
           if ($(".showhide").is(":visible")) {
               $(".showhide").trigger("click");
           }
       });
       
       if ($.fn.onePageNav) {
           $(".nav-menu").onePageNav({
               currentClass: "active-menu"
           });
       }
    }

  
 
    // collapse hidden  
     var navMain = $(".navbar-collapse");
     navMain.on("click", "a:not([data-toggle])", null, function () {
         navMain.collapse('hide');
     });  

    // video 
    if ($('.player').length) {
        $(".player").YTPlayer();
    }

    // wow init
    new WOW().init();
    // AOS init
    AOS.init();

    // Slider Custom jQuery
    var nivo_slider = $('#nivoSlider');
        if(nivo_slider.length){
        $('#nivoSlider').nivoSlider({
            effect: 'random',
            slices: 15,
            boxCols: 8,
            boxRows: 4,
            animSpeed: 600,
            pauseTime: 5000000000,
            startSlide: 0,
            directionNav: true,
            controlNavThumbs: false,
            pauseOnHover: true,
            manualAdvance: false
        });
    } 
    
    // image loaded portfolio init
    var gridfilter = $('.grid');
        if(gridfilter.length){
        $('.grid').imagesLoaded(function() {
            $('.gridFilter').on('click', 'button', function() {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });
            var $grid = $('.grid').isotope({
                itemSelector: '.grid-item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-item',
                }
            });
        });
    }   
            
    // project Filter
    if ($('.gridFilter button').length) {
        var projectfiler = $('.gridFilter button');
            if(projectfiler.length){
            $('.gridFilter button').on('click', function(event) {
                $(this).siblings('.active').removeClass('active');
                $(this).addClass('active');
                event.preventDefault();
            });
        }
    }
 
    //Testimonials Slider
     var sliderfor = $('.slider-for');
     if(sliderfor.length){
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: true,
            asNavFor: '.slider-nav',
            autoplay: false            
        });
     }
     var slidernav = $('.slider-nav');
     if(slidernav.length){
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            arrows: false,
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            responsive: {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    centerMode: false,
                }
            },
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        centerMode: false,
                    }
                },
                
            ]
        });
     }

    //Testimonials Slider2
     var sliderfor2 = $('.slider-for2');
     if(sliderfor2.length){
        $('.slider-for2').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: true,
            dots: true,
            centerMode: true,
            centerPadding: '30px',
            asNavFor: '.slider-nav2',
            autoplay: false,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        centerMode: true,
                    }
                },
                
            ] 
           
        });
    }
     var slidernav2 = $('.slider-nav2');
     if(slidernav2.length){
        $('.slider-nav2').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for2',
            arrows: false,
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        centerMode: true,
                    }
                },
                
            ]
        });
    }

    //Testimonials Slider2
     var sliderimg = $('.single-product-image');
     if(sliderimg.length){
        $('.single-product-image').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            asNavFor: '.single-product-nav',
            autoplay: false,
           
        });
    }
     var sliderimgnav = $('.single-product-nav');
     if(sliderimgnav.length){
        $('.single-product-nav').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            asNavFor: '.single-product-image',
            arrows: false,
            dots: false,
            focusOnSelect: true,
        });
    }
    
    // magnificPopup init
    var imagepopup = $('.image-popup');
    if(imagepopup.length){
        $('.image-popup').magnificPopup({
            type: 'image',
            callbacks: {
                beforeOpen: function() {
                   this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure animated zoomInDown');
                }
            },
            gallery: {
                enabled: true
            }
        });
    }

    //slider
    var slidercarousel = $('.slider-carousel');
    if(slidercarousel.length){
        $(".slider-carousel").owlCarousel({
            margin: 0,
            nav: false,
            navText:[
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            loop: true,
            dots: true,
            mouseDrag: false,
            items: 1,
            autoplay: true,
            animateOut: 'fadeOut',
            autoplayTimeout: 5000,
            autoplayHoverPause: false,
            responsiveClass: true
        });
    }

    var slidercarousel2 = $('.slider-carousel2');
    if(slidercarousel2.length){
        $(".slider-carousel2").owlCarousel({
            margin: 0,
            nav: true,
            navText:[
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            loop: true,
            dots: true,
            mouseDrag: true,
            items: 1,
            autoplay: true,
            animateOut: 'fadeOut',
            autoplayTimeout: 10000,
            autoplayHoverPause: false,
            responsiveClass: true
        });
    }

    var slidercarousel3 = $('.slider-carousel3');
    if(slidercarousel3.length){
        $(".slider-carousel3").owlCarousel({
            margin: 0,
            nav: true,
            navText:[
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            loop: true,
            dots: true,
            mouseDrag: true,
            items: 1,
            autoplay: true,
            animateOut: 'fadeOut',
            autoplayTimeout: 10000,
            autoplayHoverPause: false,
            responsiveClass: true
        });
    }

    var rs_project_style4 = $('#rs-project-style4');
    if(rs_project_style4.length){
        $("#rs-project-style4").owlCarousel({
            margin: 120,
            nav: true,
            navText:[
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            loop: true,
            dots: false,
            items: 1,
            autoplay: true,
            center: true,
            stagePadding: 380,
            responsive : {
                // breakpoint from 0 up
                0 : {
                    margin: 50,
                    stagePadding: 50,
                },
                // breakpoint from 992 up
                992 : {
                    margin: 50,
                    stagePadding: 100,
                },
                // breakpoint from 1200 up
                1200 : {
                    margin: 80,
                    stagePadding: 200,
                },
                // breakpoint from 1366 up
                1366 : {
                    margin: 100,
                    stagePadding: 300,
                },
                // breakpoint from 1500 up
                1500 : {
                    margin: 120,
                    stagePadding: 380,
                },
            }
        });
    }

    // Get a quote popup
    var popupquote = $('.popup-quote');
    if(popupquote.length){
        $('.popup-quote').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#qname',
            removalDelay: 500,
            callbacks: {
                beforeOpen: function() {
                    this.st.mainClass = this.st.el.attr('data-effect');
                    if(win.width() < 800) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#qname';
                    }
                }
            }
        });
    }

    //Videos popup jQuery 
    var popupvideos = $('.popup-videos');
    if(popupvideos.length){
        $('.popup-videos').magnificPopup({
            disableOn: 10,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        }); 
    }
    
    /*-------------------------------------
        OwlCarousel
    -------------------------------------*/
    $('.rs-carousel').each(function() {
        var owlCarousel = $(this),
        loop = owlCarousel.data('loop'),
        items = owlCarousel.data('items'),
        dotsEach = owlCarousel.data('doteach'),
        margin = owlCarousel.data('margin'),
        stagePadding = owlCarousel.data('stage-padding'),
        autoplay = owlCarousel.data('autoplay'),
        autoplayTimeout = owlCarousel.data('autoplay-timeout'),
        smartSpeed = owlCarousel.data('smart-speed'),
        dots = owlCarousel.data('dots'),
        nav = owlCarousel.data('nav'),
        navSpeed = owlCarousel.data('nav-speed'),
        xsDevice = owlCarousel.data('mobile-device'),
        xsDeviceNav = owlCarousel.data('mobile-device-nav'),
        xsDeviceDots = owlCarousel.data('mobile-device-dots'),
        smDevice = owlCarousel.data('ipad-device'),
        smDeviceNav = owlCarousel.data('ipad-device-nav'),
        smDeviceDots = owlCarousel.data('ipad-device-dots'),
        smDevice2 = owlCarousel.data('ipad-device2'),
        smDeviceNav2 = owlCarousel.data('ipad-device-nav2'),
        smDeviceDots2 = owlCarousel.data('ipad-device-dots2'),
        mdDevice = owlCarousel.data('md-device'),
        lgDevice = owlCarousel.data('lg-device'),
        centerMode = owlCarousel.data('center-mode'),
        HoverPause = owlCarousel.data('hoverpause'),
        mdDeviceNav = owlCarousel.data('md-device-nav'),
        mdDeviceDots = owlCarousel.data('md-device-dots');

        owlCarousel.owlCarousel({
            loop: (loop ? true : false),
            dotsEach: (dotsEach ? true : false),
            items: (items ? items : 4),
            lazyLoad: true,
            center: (centerMode ? true : false),
            autoplayHoverPause: (HoverPause ? true : false),
            margin: (margin ? margin : 0),
            //stagePadding: (stagePadding ? stagePadding : 0),
            autoplay: (autoplay ? true : false),
            autoplayTimeout: (autoplayTimeout ? autoplayTimeout : 1000),
            smartSpeed: (smartSpeed ? smartSpeed : 250),
            dots: (dots ? true : false),
            nav: (nav ? true : false),
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            navSpeed: (navSpeed ? true : false),
            responsiveClass: true,
            responsive: {
                0: {
                    items: (xsDevice ? xsDevice : 1),
                    nav: (xsDeviceNav ? true : false),
                    dots: (xsDeviceDots ? true : false),
                    center: false,
                },
                576: {
                    items: (smDevice2 ? smDevice2 : 2),
                    nav: (smDeviceNav2 ? true : false),
                    dots: (smDeviceDots2 ? true : false),
                    center: false,
                },
                768: {
                    items: (smDevice ? smDevice : 3),
                    nav: (smDeviceNav ? true : false),
                    dots: (smDeviceDots ? true : false),
                    center: false,
                },
                992: {
                    items: (mdDevice ? mdDevice : 4),
                    nav: (mdDeviceNav ? true : false),
                    dots: (mdDeviceDots ? true : false),
                },
                1200: {
                    items: (lgDevice ? lgDevice : 4),
                }
            }
        });
    });

    // Slider Pricing Range
    var pricerange = $('#myrange');
    if(pricerange.length) {
        var slider = document.getElementById("myrange");
        var output = document.getElementById("rangevalue");
        output.innerHTML = slider.value;
        slider.oninput = function() {
            output.innerHTML = this.value;
        }
    }

    // Skill bar 
    var skillbar = $('.skillbar');
    if(skillbar.length) {
        $('.skillbar').skillBars({  
            from: 0,    
            speed: 4000,    
            interval: 100,  
            decimals: 0,    
        });
    }
    
	// 3D Slider Carousel
    if ($('.carousel').length) { 
        $('.carousel').carousel({
            autoplay: true,
            duration: 0,
            shift: 5,
            padding: 10,
        });
    }

    // Counter Up
    var counter = $('.rs-count');
    if(counter.length) {  
        $('.rs-count').counterUp({
            delay: 20,
            time: 1500
        });
    }
    
    // scrollTop init	
    var totop = $('#scrollUp');    
    win.on('scroll', function() {
        if (win.scrollTop() > 150) {
            totop.fadeIn();
        } else {
            totop.fadeOut();
        }
    });
    totop.on('click', function() {
        $("html,body").animate({
            scrollTop: 0
        }, 500)
    });

    //canvas menu
    var navexpander = $('#nav-expander');
    if(navexpander.length){
        $('#nav-expander').on('click',function(e){
            e.preventDefault();
            $('body').toggleClass('nav-expanded');
        });
    }
    var navclose = $('#nav-close');
    if(navclose.length){
        $('#nav-close').on('click',function(e){
            e.preventDefault();
            $('body').removeClass('nav-expanded');
        });
    }

    // categories btn
    $('.cat-menu-inner').hide();
    $('.cat-btn').on('click',function(){
        $('.cat-menu-inner').slideToggle();
    })

    // Parallax Stuff
    if ($("#stuff").length) {
        var stuff = $('#stuff').get(0);
        var parallaxInstance = new Parallax(stuff);
    }

    // Parallax Stuff
    if ($("#stuff2").length) {
        var stuff = $('#stuff2').get(0);
        var parallaxInstance = new Parallax(stuff);
    }

    // Sticky Sidebar
    $(function() {
      if ($('#sticky-sidebar').length) {
        var el = $('#sticky-sidebar');
        var stickyTop = $('#sticky-sidebar').offset().top;
        var stickyHeight = $('#sticky-sidebar').height();
        $(window).scroll(function() {
          var limit = $('#sticky-end').offset().top - stickyHeight - 0;
          var windowTop = $(window).scrollTop();
          if (stickyTop < windowTop) {
            el.css({
              position: 'fixed',
              top: -230
            });
          } else {
            el.css('position', 'static');
          }
          if (limit < windowTop) {
            var diff = limit - windowTop;
            el.css({
              top: diff
            });
          }
        });
      }
    });

})(jQuery);