function mobileToggleMenu(){jQuery(window).width()<640?(jQuery("#footer-menu .mobile_togglemenu").remove(),jQuery("#footer-menu .menu .menu-item-has-children").prepend("<a class='mobile_togglemenu'><i class='fa fa-chevron-down' aria-hidden='true'></i></a>"),jQuery("#footer-menu .menu .menu-item-has-children").addClass("toggle"),jQuery("#footer-menu .mobile_togglemenu").click(function(){jQuery(this).parent().toggleClass("active").parent().find("ul.sub-menu").toggle("slow")})):(jQuery("#footer-menu .menu .menu-item-has-children").parent().find("ul.sub-menu").removeAttr("style"),jQuery("#footer-menu .menu .menu-item-has-children").removeClass("active"),jQuery("#footer-menu .menu .menu-item-has-children").removeClass("toggle"),jQuery("#footer-menu .mobile_togglemenu").remove())}jQuery(document).ready(function(t){var i={Android:function(){return navigator.userAgent.match(/Android/i)},BlackBerry:function(){return navigator.userAgent.match(/BlackBerry/i)},iOS:function(){return navigator.userAgent.match(/iPhone|iPad|iPod/i)},Opera:function(){return navigator.userAgent.match(/Opera Mini/i)},Windows:function(){return navigator.userAgent.match(/IEMobile/i)},any:function(){return i.Android()||i.BlackBerry()||i.iOS()||i.Opera()||i.Windows()}};i.any()||t.stellar({horizontalScrolling:!1,responsive:1,verticalOffset:0}),t(document).on("click",".whatsapp",function(){if(i.any()){var e=t(this).attr("data-text"),n=t(this).attr("data-link"),o="whatsapp://send?text="+(encodeURIComponent(e)+" - "+encodeURIComponent(n));window.location.href=o}else alert("Please share this article in mobile device")}),t("a[rel^='prettyPhoto']").prettyPhoto(),t(".wpb_wrapper, #video-section .large-12").fitVids(),t(function(){t("#menu-main-menu-1").slicknav({label:"",prependTo:".mobile-menu"})}),t("#blog-sidebar ul.tweets").slick({infinite:!0,arrows:!1,dots:!1,autoplay:!0,fade:!0,slidesToShow:1,slidesToScroll:1}),t("#main-products .product-slider").slick({infinite:!0,arrows:!1,dots:!1,autoplay:!0,fade:!1,slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:1024,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}}]}),t('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(e){if(location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){var n=t(this.hash);(n=n.length?n:t("[name="+this.hash.slice(1)+"]")).length&&(e.preventDefault(),t("html, body").animate({scrollTop:n.offset().top},1e3,function(){var e=t(n);if(e.focus(),e.is(":focus"))return!1;e.attr("tabindex","-1"),e.focus()}))}})}),jQuery(document).ready(function(){mobileToggleMenu()}),jQuery(window).resize(function(){mobileToggleMenu()});