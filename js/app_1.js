jQuery(document).ready(function ($) {
    var isMobile = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };
    if (!isMobile.any()) {
        $.stellar({
            horizontalScrolling: false,
            responsive: 1,
            verticalOffset: 0
        });
    }
    $(document).on("click", '.whatsapp', function () {
        if (isMobile.any()) {

            var text = $(this).attr("data-text");
            var url = $(this).attr("data-link");
            var message = encodeURIComponent(text) + " - " + encodeURIComponent(url);
            var whatsapp_url = "whatsapp://send?text=" + message;
            window.location.href = whatsapp_url;
        } else {
            alert("Please share this article in mobile device");
        }

    });
    $("a[rel^='prettyPhoto']").prettyPhoto();
    // Target your .container, .wrapper, .post, etc.
    $(".wpb_wrapper, #video-section .large-12").fitVids();
    $(function () {
        $('#menu-main-menu-1').slicknav({
            label: '',
            prependTo: '.mobile-menu'
        });
    });
        $('#blog-sidebar ul.tweets').slick({
        infinite: true,
        arrows: false,
        dots: false,
        autoplay: true,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $('#main-products .product-slider').slick({
        infinite: true,
        arrows: false,
        dots: false,
        autoplay: true,
        fade: false,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
    });
    $('a[href*="#"]')
            // Remove links that don't actually link to anything
            .not('[href="#"]')
            .not('[href="#0"]')
            .click(function (event) {
                // On-page links
                if (
                        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                        &&
                        location.hostname == this.hostname
                        ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 1000, function () {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            }
                            ;
                        });
                    }
                }
            });
});
function mobileToggleMenu() {

    if (jQuery(window).width() < 640) {
        jQuery("#footer-menu .mobile_togglemenu").remove();
        jQuery("#footer-menu .menu .menu-item-has-children").prepend("<a class='mobile_togglemenu'><i class='fa fa-chevron-down' aria-hidden='true'></i></a>");
        jQuery("#footer-menu .menu .menu-item-has-children").addClass('toggle');
        jQuery("#footer-menu .mobile_togglemenu").click(function () {
            jQuery(this).parent().toggleClass('active').parent().find('ul.sub-menu').toggle('slow');
        });
    } else {
        jQuery("#footer-menu .menu .menu-item-has-children").parent().find('ul.sub-menu').removeAttr('style');
        jQuery("#footer-menu .menu .menu-item-has-children").removeClass('active');
        jQuery("#footer-menu .menu .menu-item-has-children").removeClass('toggle');
        jQuery("#footer-menu .mobile_togglemenu").remove();
    }
}
jQuery(document).ready(function () {
    mobileToggleMenu();
});
jQuery(window).resize(function () {
    mobileToggleMenu();
});