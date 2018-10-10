<?php/** * Template Name: Mag Landing Page Template */?><!DOCTYPE html><!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]--><!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]--><!--[if !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>>    <!--<![endif]-->    <head>        <meta charset="<?php bloginfo('charset'); ?>" />        <meta name="viewport" content="width=device-width" />        <title><?php wp_title('|', true, 'right'); ?></title>        <link rel="profile" href="http://gmpg.org/xfn/11" />        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">        <meta name="p:domain_verify" content="8c829ef2898c6d2adab750a716a93fb3"/>        <!--[if lt IE 9]>        <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>        <![endif]-->        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/icons/favicon.ico" type="image/x-icon" />        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-57x57.png">        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-60x60.png">        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-72x72.png">        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-76x76.png">        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-114x114.png">        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-120x120.png">        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-144x144.png">        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-152x152.png">        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/images/icons/apple-touch-icon-180x180.png">        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/icons/favicon-96x96.png" sizes="96x96">        <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/icons/android-chrome-192x192.png" sizes="192x192">        <meta name="msapplication-square70x70logo" content="<?php echo get_template_directory_uri(); ?>/images/icons/smalltile.png" />        <meta name="msapplication-square150x150logo" content="<?php echo get_template_directory_uri(); ?>/images/icons/mediumtile.png" />        <meta name="msapplication-wide310x150logo" content="<?php echo get_template_directory_uri(); ?>/images/icons/widetile.png" />        <meta name="msapplication-square310x310logo" content="<?php echo get_template_directory_uri(); ?>/images/icons/largetile.png" />        <?php gravity_form_enqueue_scripts(2, true); ?>        <!-- Google Tag Manager -->        <script>(function (w, d, s, l, i) {                w[l] = w[l] || [];                w[l].push({'gtm.start':                            new Date().getTime(), event: 'gtm.js'});                var f = d.getElementsByTagName(s)[0],                        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';                j.async = true;                j.src =                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;                f.parentNode.insertBefore(j, f);            })(window, document, 'script', 'dataLayer', 'GTM-MQW5LJ5');</script>        <!-- End Google Tag Manager -->        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js"></script>        <script>            WebFont.load({                google: {                    families: ['Varela+Round', 'Montserrat:300,400,700']                }            });        </script>        <?php wp_head(); ?>    </head>    <body <?php body_class(); ?>>        <!-- Google Tag Manager (noscript) -->        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MQW5LJ5"                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>        <!-- End Google Tag Manager (noscript) -->        <?php        while (have_posts()) : the_post();            $formid = get_field('form_id');            ?>            <div id="primary">                <div class="row">                    <div class="large-12 columns">                        <div id="landing-content">                            <?php the_content(); ?>                        </div>                    </div>                    <div class="large-12 columns bluebdr">                        <div id="footer-main" class="clearfix">                            <div class="footer-logo">                                <a href="<?php bloginfo('url'); ?>">                                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>">                                </a>                            </div>                            <div class="footer-sign-up">                                <?php dynamic_sidebar('mailchimp-widget'); ?>                            </div>                            <div class="footer-social">                                <?php get_template_part('parts/content', 'social'); ?>                            </div>                        </div>                    </div>                </div>            </div><!-- #content -->            <?php        endwhile;        rewind_posts();        ?>        <?php wp_footer(); ?>        <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion_async.js" charset="utf-8"></script>        <script type="text/javascript">            if (jQuery('.gform_confirmation_message_3.gform_confirmation_message').length == 1)            {                google_trackConversion({                    google_conversion_id: 1069999474,                    google_conversion_label: "v9hBCO3PxVkQ8sqb_gM",                    google_remarketing_only: false                });            }        </script>    </body></html>