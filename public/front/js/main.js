$(document).ready(function () {

    //navbar toggle
    $('.navbar-toggler').click(function () {
        $(this).toggleClass('active');
        $('header').toggleClass('bg-white');
    });


    // //Menu On Hover
    $('body').on('mouseenter mouseleave', '.nav-item', function (e) {
        if ($(window).width() > 750) {
            var _d = $(e.target).closest('.nav-item');
            _d.addClass('show');
            setTimeout(function () {
                _d[_d.is(':hover') ? 'addClass' : 'removeClass']('show');
            }, 1);
        }
    });
//  //Menu On Hover
    // dropdown
    $('.dropdown-menu a.dropdown-toggle').click(function (e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
            $('.dropdown-submenu .show').removeClass("show");
        });
        return false;
    });
//dropdown


// slider
    $('.slide-ban').owlCarousel({
        loop: true,
        margin: 10,
        dots: false,
        nav: true,
        mouseDrag: false,
        autoplay: true,
        animateOut: 'slideOutUp',
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // isotope active
    if ($('.gallery-wrap').length > 0) {
        var $container = $('.grid');
        // init Isotope
        var $grid = $(".grid").isotope({
            itemSelector: ".grid-item",
            layoutMode: "masonry",
            percentPosition: true
            // masonry: {
            //     columnWidth: '.grid-sizer'
            // }
        });

        // layout Isotope after each image loads
        $grid.imagesLoaded().progress(function () {
            $grid.isotope('layout');
        });
        // filter items when filter link is clicked
        $('.gallery-menu a').on('click', function () {
            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector
            });
            return false;
        });
        $('.gallery-menu a').on('click', function () {
            $('.gallery-menu').find('.current').removeClass('current');
            $(this).parent().addClass('current');
        });
    }
    // isotope active

// latest-collection-carousal
    $('.collect').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

// about-page testimonial

    $('.client').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    // product details page //
    // Similar products //
    $('#product_slider').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        autoplay: 4000,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    // product details page end //



// checkout-page-div-open-on-checkbok-area
    $(function () {
        $("#same_billing_shipping").click(function () {
            //alert('ok');
            if ($(this).is(":checked")) {
                $(".ship-add-div").show();
            } else {
                $(".ship-add-div").hide();
            }
        });
    });

    $(function () {
        $(".open-filter").on("click", function () {
            $(".filter-wrap").addClass("active");
        });
        $(".cancel-button").on("click", function () {
            $(".filter-wrap").removeClass("active");
        });
    });

});

//sticky header
$(window).scroll(function () {

    var ws = $(window).scrollTop();
    var nav_height = $('header').outerHeight();
    var header_top = $('header');
    if (ws >= nav_height) {
        header_top.addClass("fixed");
    } else {
        header_top.removeClass("fixed");
    }
});



// ..........fliter...........//
// ........price-js......//

// var lowerSlider = document.querySelector('#lower');
// var upperSlider = document.querySelector('#upper');

// document.querySelector('#two').value = upperSlider.value;
// document.querySelector('#one').value = lowerSlider.value;

// var lowerVal = parseInt(lowerSlider.value);
// var upperVal = parseInt(upperSlider.value);

// upperSlider.oninput = function () {
//     lowerVal = parseInt(lowerSlider.value);
//     upperVal = parseInt(upperSlider.value);

//     if (upperVal < lowerVal + 4) {
//         lowerSlider.value = upperVal - 4;
//         if (lowerVal == lowerSlider.min) {
//             upperSlider.value = 4;
//         }
//     }
//     document.querySelector('#two').value = this.value
// };

// lowerSlider.oninput = function () {
//     lowerVal = parseInt(lowerSlider.value);
//     upperVal = parseInt(upperSlider.value);
//     if (lowerVal > upperVal - 4) {
//         upperSlider.value = lowerVal + 4;
//         if (upperVal == upperSlider.max) {
//             lowerSlider.value = parseInt(upperSlider.max) - 4;
//         }
//     }
//     document.querySelector('#one').value = this.value
// };

// ........price-js-end......//
// ..........fliter-end...........//

/*..................product details.....................*/

//initiate the plugin and pass the id of the div containing gallery images
// $("#zoom_03").elevateZoom({gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});

// //pass the images to Fancybox
// $("#zoom_03").bind("click", function(e) {
//     var ez =   $('#zoom_03').data('elevateZoom');
//     $.fancybox(ez.getGalleryList());
//     return false;
// });

/*..................product details end......................*/
