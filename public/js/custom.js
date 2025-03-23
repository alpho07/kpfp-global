(function ($) {
    "use strict";

    var review = $('.player_info_item');
    if (review.length) {
        review.owlCarousel({
            items: 1,
            loop: true,
            dots: false,
            autoplay: true,
            margin: 40,
            autoplayHoverPause: true,
            autoplayTimeout: 5000,
            nav: true,
            navText: [
                '<img src="img/icon/left.svg" alt="">',
                '<img src="img/icon/right.svg" alt="">'

            ],
            responsive: {
                0: {
                    margin: 15,
                },
                600: {
                    margin: 10,
                },
                1000: {
                    margin: 10,
                }
            }
        });
    }
    $('.popup-youtube, .popup-vimeo').magnificPopup({
        // disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });



    var review = $('.textimonial_iner');
    if (review.length) {
        review.owlCarousel({
            items: 1,
            loop: true,
            dots: true,
            autoplay: true,
            autoplayHoverPause: true,
            autoplayTimeout: 5000,
            nav: false,
            responsive: {
                0: {
                    margin: 15,
                },
                600: {
                    margin: 10,
                },
                1000: {
                    margin: 10,
                }
            }
        });
    }
    //   $(document).ready(function() {
    //     $('select').niceSelect();
    //   });
    // menu fixed js code
    $(window).scroll(function () {
        var window_top = $(window).scrollTop() + 1;
        if (window_top > 50) {
            $('.main_menu').addClass('menu_fixed animated fadeInDown');
        } else {
            $('.main_menu').removeClass('menu_fixed animated fadeInDown');
        }
    });

    //   $(document).ready(function(){

    //     var owl_1 = $('#owl-1');
    //     var owl_2 = $('#owl-2');

    //     owl_1.owlCarousel({
    //       loop:true,
    //       margin:10,
    //       nav:false,
    //       items: 1,
    //       dots: false,
    //       navText: false,
    //       autoplay: true,

    //     });
    //  owl_2.find(".item").click(function(){
    //     var slide_index = owl_2.find(".item").index(this);
    //     owl_1.trigger('to.owl.carousel',[slide_index,300]);
    //   });

    //     owl_2.owlCarousel({
    //       margin:50,
    //       nav: true,
    //       items: 3,
    //       dots: false,
    //       center: true,
    //       loop:true,
    //       navText: false,
    //       autoplay: true,
    //       center: true
    //     });

    //   });


    $('.counter').counterUp({
        time: 2000
    });

    $('.slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        speed: 300,
        infinite: true,
        asNavFor: '.slider-nav-thumbnails',
        autoplay: true,
        pauseOnFocus: true,
        dots: true,
    });

    $('.slider-nav-thumbnails').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider',
        focusOnSelect: true,
        infinite: true,
        prevArrow: false,
        nextArrow: false,
        centerMode: true,
        responsive: [{
            breakpoint: 480,
            settings: {
                centerMode: false,
            }
        }]
    });

    //remove active class from all thumbnail slides
    $('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');

    //set active class to first thumbnail slides
    $('.slider-nav-thumbnails .slick-slide').eq(0).addClass('slick-active');

    // On before slide change match active thumbnail to current slide
    $('.slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        var mySlideNumber = nextSlide;
        $('.slider-nav-thumbnails .slick-slide').removeClass('slick-active');
        $('.slider-nav-thumbnails .slick-slide').eq(mySlideNumber).addClass('slick-active');
    });

    //UPDATED

    $('.slider').on('afterChange', function (event, slick, currentSlide) {
        $('.content').hide();
        $('.content[data-id=' + (currentSlide + 1) + ']').show();
    });

    $('.gallery_img').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });


    $(function () {
        $('#smartwizard').smartWizard({
            selected: 0, // Initial selected step, 0 = first step
            theme: 'arrows', // theme for the wizard, related css need to include for other than basic theme
            justified: true, // Nav menu justification. true/false
            autoAdjustHeight: true, // Automatically adjust content height
            backButtonSupport: true, // Enable the back button support
            enableUrlHash: true, // Enable selection of the step based on url hash
            transition: {
                animation: 'none', // Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)
                speed: '400', // Animation speed. Not used if animation is 'css'
                easing: '', // Animation easing. Not supported without a jQuery easing plugin. Not used if animation is 'css'
                prefixCss: '', // Only used if animation is 'css'. Animation CSS prefix
                fwdShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on forward direction
                fwdHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on forward direction
                bckShowCss: '', // Only used if animation is 'css'. Step show Animation CSS on backward direction
                bckHideCss: '', // Only used if animation is 'css'. Step hide Animation CSS on backward direction
            },
            toolbar: {
                position: 'bottom', // none|top|bottom|both
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                extraHtml: '' // Extra html to show on toolbar
            },
            anchor: {
                enableNavigation: true, // Enable/Disable anchor navigation
                enableNavigationAlways: false, // Activates all anchors clickable always
                enableDoneState: true, // Add done state on visited steps
                markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                unDoneOnBackNavigation: false, // While navigate back, done state will be cleared
                enableDoneStateNavigation: true // Enable/Disable the done state navigation
            },
            keyboard: {
                keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                keyLeft: [37], // Left key code
                keyRight: [39] // Right key code
            },
            lang: { // Language variables for button
                next: 'Next',
                previous: 'Previous'
            },
            disabledSteps: [], // Array Steps disabled
            errorSteps: [], // Array Steps error
            warningSteps: [], // Array Steps warning
            hiddenSteps: [], // Hidden steps
            getContent: null // Callback function for content loading
        });
    });


    $(function () {
        $(".datepicker-11").datepicker({
            showWeek: true,
            showAnim: "explode",
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            showOtherMonths: true,
            selectOtherMonths: true,
            maxDate: "-17y",
            onSelect: function (selectedDate) {
                // Calculate age and update a separate element
                calculateAge(selectedDate);
            }
        });


        $(".datepicker-12,#academic_start_date1,#academic_completion1,#academic_start_date7,#academic_completion8,#academic_start_date2,#academic_completion2,#academic_start_date3,#academic_completion3,#qualification_attained1,#qualification_attained2,#qualification_attained3,#qualification_attained4",).datepicker({
            showWeek: true,
            showAnim: "explode",
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            showOtherMonths: true,
            selectOtherMonths: true,

        });
        
     


        function calculateAge(selectedDate) {

            // Convert the selected date to a Date object
            const birthDate = new Date(selectedDate);

            // Get the current date
            const currentDate = new Date();

            // Calculate the age in years
            const age = currentDate.getFullYear() - birthDate.getFullYear();

            // Display the age in a separate element (replace 'your-age-element' with the actual ID or class)
            $("#age_years").val(age);
        }
    });



}(jQuery));
