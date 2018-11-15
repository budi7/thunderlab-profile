var $ = jQuery.noConflict();

(function($) {
    "use strict";
    
    var width  =  $(window).width();
    
    /*-------------------------------------------------*/
    /* =  Mobile Hover
    /*-------------------------------------------------*/
    var mobileHover = function () {
        $('*').on('touchstart', function () {
            $(this).trigger('hover');
        }).on('touchend', function () {
            $(this).trigger('hover');
        });
    };

    mobileHover();
    /*-------------------------------------------------*/
    /* =  loader
    /*-------------------------------------------------*/
    Pace.on("done", function(){
        $("#myloader").fadeOut(800);
    });
    /*-------------------------------------------------*/
    /* =  Menu
    /*-------------------------------------------------*/
    try {
        $('.menu-button').on("click",function() {
            
            //menu classic, menu sidemenu, menu basic
            var menu = $('#menu');
            var menuClassic = $('#menu-classic');
            var sidemenu = $('#sidemenu');
            var menuResponsiveSidemenu = $('#menu-responsive-sidemenu');
            var menuResponsiveClassic = $('#menu-responsive-classic');
            
            menu.toggleClass('open');
            menuClassic.toggleClass('open');
            sidemenu.addClass('sidemenu open');
            menuResponsiveSidemenu.toggleClass('open');
            menuResponsiveClassic.toggleClass('open');
            menu.addClass('animated slideInDown');
            $('.submenu', menuClassic).each(function() {
                $('.submenu', menuClassic).removeClass( "open" );
            });
            if ( sidemenu.hasClass( "slideInRight" ) ) {
                sidemenu.removeClass('animated slideInRight'); 
                sidemenu.addClass('animated slideOutRight');
                setTimeout(function(){ 
                    sidemenu.toggleClass('sidemenu open');
                    sidemenu.removeClass('animated slideOutRight');
                },1000);
            } else {
                sidemenu.addClass('animated slideInRight');   
            }
            if(width<991){
                $('body').toggleClass('no-scroll');
            }
        });
        $('.menu-holder ul > li:not(.submenu) > a').on("click",function(){
            $('#menu').removeClass('open');
            $('body').removeClass('no-scroll');
        });
        //basic menu mobile
        $('.close-menu').on("click",function() {
            
            var menu = $('#menu');
            
            menu.removeClass('animated slideInDown');
            menu.addClass('animated fadeOutUp');
            setTimeout(function(){ 
                menu.toggleClass('open');
                menu.removeClass('animated fadeOutUp');
            },1000);
            if(width<991){
                $('body').toggleClass('no-scroll');
            }
        });
        //megamenu mobile
        if(width<991){
            
            var menuClassicSubmenu = $('.submenu', '#menu-classic');
            
            menuClassicSubmenu.on("click",function() {
                var open = false;
                if($(this).hasClass('open')) {
                        open = true;
                }
                menuClassicSubmenu.each(function() {
                    menuClassicSubmenu.removeClass( "open" );
                });
                if(open) {
                    $(this).addClass('open');
                }
                $(this).toggleClass('open');
            });
        }
    } catch(err) {

    };
    /*-------------------------------------------------*/
    /* =  Search Box Menu
    /*-------------------------------------------------*/
    try {
        var formSearch = $('#header-searchform');
        
        $('.secondary-menu .search, .secondary-menu-mobile .search').on("click",function() {
            formSearch.toggleClass('active');
        });
        formSearch.on("click",".form-button-close", function() {
            formSearch.toggleClass('active');
        });
    } catch(err) {

    };
    /*-------------------------------------------------*/
    /* =  Slider
    /*-------------------------------------------------*/
    try {
        $('#flexslider').flexslider({
            animation: "fade",
            controlNav: false,
            directionNav: false,
            useCSS: false
        });
        $('#flexslider-nav').flexslider({
            animation: "slide",
            reverse: true,
            easing: "swing",
            controlNav: false, 
            animationSpeed: 1000,
            controlsContainer: $(".slider-controls-container"),
            customDirectionNav: $(".slider-navigation a"),
            before: function(slider){
                $(slider).find(".flex-animation").each(function(){
                    $(this).removeClass("animated fadeInUp");
                    $(this).addClass("no-opacity");
                });
            },
            after: function(slider){
                $(slider).find(".flex-animation").addClass("animated fadeInUp");
            },
        });
    } catch(err) {

    }
    /*-------------------------------------------------*/
    /* =  Isotope
    /*-------------------------------------------------*/
    try {
        
        var $mainContainerSimple=$('section[data-isotope="load-simple"] .projects-items');
        $mainContainerSimple.imagesLoaded( function(){

            var $container=$('.projects-items').isotope({itemSelector:'.one-item', layoutMode: 'fitRows'});
            var $simpleFilters = $('#projects .filters');

            $simpleFilters.on('click','li',function(){
                var filterValue=$(this).attr('data-filter');$container.isotope({
                    filter:filterValue});
            });
            $simpleFilters.each(function(i,buttonGroup){
                var $buttonGroup=$(buttonGroup);
                $buttonGroup.on('click','li',function(){
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    $(this).addClass('is-checked');
                });
            });
            
        });
    
    } catch(err) {

    }
        
    //blog masonry
    try {
        var $blogContainer = $('.news-items');
        $blogContainer.imagesLoaded( function(){
            $blogContainer.isotope({itemSelector: '.one-item', layoutMode: 'fitRows' });
            $blogContainer.isotope('layout');
        });
    } catch(err) {

    }
    /*-------------------------------------------------*/
    /* =  Responsive
    /*-------------------------------------------------*/
    
    var parentHeightKey = [];
    
    $('div[data-responsive="parent-height"]').each(function() {
        parentHeightKey.push({id:$(this).attr('data-responsive-id'),height:$(this).outerHeight(true)}); 
    });
    $('div[data-responsive="child-height"]').each(function() {
        var childHeight;
        var childId = $(this).attr('data-responsive-id');
        
        for(var i=0;i<parentHeightKey.length;i++){
            if(parentHeightKey[i].id == childId) {
                childHeight = parentHeightKey[i].height;
            }
        }
        $(this).css({'height': childHeight + 'px'})
    });
    $(window).resize(function () {
        
        var currentWidth  =  $(window).width();
        
        if(currentWidth>767){
            $('div[data-responsive="parent-height"]').each(function() {
                parentHeightKey.push({id:$(this).attr('data-responsive-id'),height:$(this).outerHeight(true)}); 
            });
            $('div[data-responsive="child-height"]').each(function() {
                var childHeight;
                var childId = $(this).attr('data-responsive-id');

                for(var i=0;i<parentHeightKey.length;i++){
                    if(parentHeightKey[i].id == childId) {
                        childHeight = parentHeightKey[i].height;
                    }
                }
                $(this).css({'height': childHeight + 'px'})
            });
        }
    });
    /*-------------------------------------------------*/
    /* =  Magnific popup
    /*-------------------------------------------------*/
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        closeBtnInside: false,
        fixedContentPos: true
    });
    $('.project-images').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: '.lightbox',
            type: 'image',
            fixedContentPos: true,
            gallery: {
                enabled:true
            },
            closeBtnInside: false
        });
    });
    $('.lightbox-image').magnificPopup({
        type: 'image',
        gallery: {
            enabled:true
        },
        closeBtnInside: false
    });
    /*-------------------------------------------------*/
    /* =  Menu
    /*-------------------------------------------------*/
    try {
        $('#btn-share').on("click",function() {
            $('.share-box').toggleClass('open');
        });
            
    } catch(err) {

    }                  
    /*-------------------------------------------------*/
    /* =  Count increment
    /*-------------------------------------------------*/
    try {
        $('#counters').appear(function() {
            $('#counters .statistic span').countTo({
                speed: 4000,
                refreshInterval: 60,
                formatter: function (value, options) {
                    return value.toFixed(options.decimals);
                }
            });
        });
    } catch(err) {

    }
    /*-------------------------------------------------*/
    /* =  My color
    /*-------------------------------------------------*/
    try {
        $('span.mycolor').each(function() {
            var bColor = $(this).attr('data-color');

            $(this).css({'background-color': bColor})
        });
    } catch(err) {

    }
    /*-------------------------------------------------*/
    /* =  Contact Form
    /*-------------------------------------------------*/
    var submitContact = $('#submit-contact'),
        message = $('#msg'),
        is_submitting = false;

    submitContact.on('click', function(e){
        e.preventDefault();

        // data ok?
        if (formValidation.validateForm($('#contact-form')) == false) { return false; }

        // lock input
        $(e.target)
            .text('Processing')
            .attr("disabled","disabled")
            .closest('form').find("input").attr("disabled", "disabled");


        var $this = $(this);
        is_submitting == true;

        if(!grecaptcha.getResponse()){
            // draw error
            formValidation.setError($('#contact-form').find("input[name='captcha']") ,"Invalid captcha")

            $(e.target)
                .text('ContactMe')
                .removeAttr("disabled")
                .closest('form').find("input").removeAttr("disabled");
            return;
        }

        var form_data = {
            'token' : $('#contact-form').find("input[name='token']").val(),
            'name' : $('#contact-form').find("input[name='name']").val(),
            'phone' : $('#contact-form').find("input[name='phone']").val(),
            'email' : $('#contact-form').find("input[name='email']").val(),
            'nature' : $('#contact-form').find("input[name='nature']").val(),
            'captcha' :  $('#contact-form').find("input[name='captcha']").val()
        };
        

        // send data
        $.ajax({
            type: "POST",
            url: $('#contact-form').attr("action"),
            dataType: 'json',
            cache: false,
            data: form_data,
            headers: {
                'X-CSRF-TOKEN': $('#contact-form').find("input[name='_token']").val()
            },
            success: function(data) {
                $(e.target)
                    .text('Contact Me')
                    .removeAttr("disabled")
                    .closest('form').find("input").removeAttr("disabled");

                if(data.code !== '500'){
                    // $this.parents('form').find('input[type=text],textarea,select').filter(':visible').val('');
                    // message.hide().removeClass('success').removeClass('error').addClass('success').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
                    resetAll();

                    // toast 
                    if(data.code !== '77'){
                        $('#modelSuccess').modal('show'); 
                    }else{
                        $('#modelFail').find("#error-msg").html(data.message);
                        $('#modelFail').modal('show'); 
                    }
                } else {
                    // toast
                    $('#modelFail').find("#error-msg").html(data.message);
                    $('#modelFail').modal('show'); 

                    if(data.detail){
                        for (var key in data.detail) {
                            if (data.detail.hasOwnProperty(key)) {
                                // set error on form
                                formValidation.setError($('form').find("[name='" + key + "']"), data.detail[key]);
                            }
                        }
                    }
                }
            },
            error: function(data){
                // 419 -> submit form twice
                if(data.status == 419){
                    grecaptcha.reset();

                    // toast
                    $('#modelFail').find("#error-msg").html("We know you can't wait to talk with us, but please give us some time.</br>Sit back and relax, our team member will be in touch with you soon")
                    $('#modelFail').modal('show');
                }else{
                    $('#modelFail').find("#error-msg").html("We are having problem processing your request right now.</br>Please reach us or you can just try again later.")
                    $('#modelFail').modal('show'); 
                }

                $(e.target)
                    .text('Contact Me')
                    .removeAttr("disabled")
                    .closest('form').find("input").removeAttr("disabled");
            }
        });

        function resetAll(){
            // reset reCaptcha
            try{
                grecaptcha.reset();
            }catch(ex){
                console.log(ex);
            }

            // reset form
            $('#contact-form').find("input").val("");
        }
    });
})(jQuery);

$(document).ready(function($) {
    "use strict";
    
    var is_mobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    
    /*-------------------------------------------------*/
    /* =  Carousel
    /*-------------------------------------------------*/
    try {
        $(".testimonials-carousel-single").owlCarousel({
            loop:true,
            items:1,
            autoplay:true,
            autoplayHoverPause:false,
            dots:false,
            nav:false,
        });
        $(".post-gallery, .project-gallery").owlCarousel({
            center: true,
            items:1,
            loop:true
        });
        $(".image-carousel").owlCarousel({
            loop:true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            items:1,
            autoplay:false,
            autoplayHoverPause:false,
            dots:true,
            nav:true,
            navText: ['<span><i class="icon ion-ios-arrow-left"></i></span>','<span><i class="icon ion-ios-arrow-right"></i></span>']
        });
    } catch(err) {

    }
    /*-------------------------------------------------*/
    /* =  Scroll between sections
    /*-------------------------------------------------*/
    $('a.btn-alt[href*=#], a.btn-pro[href*=#], a.anchor[href*=#], a.btn-down[href*=#] ').on("click",function(event) {
        var $this = $(this);
        var offset = -70;
        $.scrollTo( $this.attr('href') , 850, { easing: 'swing' , offset: offset , 'axis':'y' } );
        event.preventDefault();
    });
    /*-------------------------------------------------*/
    /* =  Skills
    /*-------------------------------------------------*/
    try {
        $('#skills').appear(function() {
            jQuery('.skill-list li span').each(function(){
                jQuery(this).animate({
                    width:jQuery(this).attr('data-percent')
                },2000);
            });
            $('.skill-list li .count').each(function () {
                var number = $(this).attr('data-to');
                $(this).prop('Counter',0).animate({
                    Counter: number
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        });
    } catch(err) {

    }
    /*-------------------------------------------------*/
    /* =  Modaal
    /*-------------------------------------------------*/
    try {
        $(".inline").modaal({
            background:'#fff',
            overlay_opacity: 1
        });
    } catch(err) {

    }
});

var verifyCallback = function(response) {
    $('#contact-form').find("input[name='captcha']").val(response);
};
var onloadCallback = function() {
    grecaptcha.render('html_element', {
        'sitekey'   : '6Lfof3QUAAAAAEVOdqWOXbYK7nu9slQedDlHBFAw',
        'callback' : verifyCallback,
    });
};