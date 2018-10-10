<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package Jobify
 * @since Jobify 1.0
 */
?>

</div><!-- #main -->
<?php
if (!is_singular('product')):
    $formid = get_field('form_id');
    ?>
    <section id="quick-contact">
        <div class="row">
    <?php if (!is_page_template('page-templates/template-quotation.php')): ?>
                <div class="medium-6 columns right">
                    <img id="quick-quote-img" src="<?php echo get_template_directory_uri(); ?>/images/get-intouch-with-MAG-Laundry-Equipment-brochures.png" alt="More information">
                </div>
            <?php endif; ?>
                <?php if (!is_page_template('page-templates/template-quotation.php')): ?>
                <div class="medium-6 columns left">
                    <?php else: ?>
                    <div class="medium-12 columns">
                    <?php endif; ?>
                    <img class="quote-logo" src="<?php echo get_template_directory_uri(); ?>/images/logo-blue.png" alt="Get a quote from MAG Laundry Equipment">
                    <?php if (!$formid): ?>
                        <?php echo do_shortcode('[gravityform id=3 title=false description=false ajax=true tabindex=49]'); ?>
                    <?php else: ?>
                        <?php echo do_shortcode('[gravityform id="' . $formid . '" title=false description=false ajax=true]');
                        //print $var;
                        ?>
    <?php endif; ?>
                </div>
            </div>
    </section>
<?php endif; ?>
<?php if (jobify_theme_mod('jobify_cta', 'jobify_cta_display')) : ?>
    <div class="footer-cta">
        <div class="row">
            <div class="large-12 columns">
    <?php echo wpautop(jobify_theme_mod('jobify_cta', 'jobify_cta_text')); ?>
    <?php get_template_part('parts/content', 'share'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<div id="footer-main">
    <div class="row">
        <div class="large-12 columns">
            <div class="footer-logo">
                <a href="<?php bloginfo('url'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>">
                </a>
            </div>
            <div class="footer-sign-up">
                <?php dynamic_sidebar('mailchimp-widget'); ?>
            </div>
            <div class="footer-social">
<?php get_template_part('parts/content', 'social'); ?>
            </div>
        </div>
    </div>
</div>
<?php
$telephone = get_field('telephone', 'options');
$email = get_field('email', 'options');
$address = get_field('address', 'options');
?>
<div id="footer-menu">
    <div class="row">
        <?php wp_nav_menu(array('theme_location' => 'footer_1', 'container_class' => 'footer-menu')); ?>
        <?php wp_nav_menu(array('theme_location' => 'footer_2', 'container_class' => 'footer-menu')); ?>
        <?php wp_nav_menu(array('theme_location' => 'footer_3', 'container_class' => 'footer-menu')); ?>
    <?php wp_nav_menu(array('theme_location' => 'footer_4', 'container_class' => 'footer-menu')); ?>
    <?php //wp_nav_menu(array('theme_location' => 'footer_5', 'container_class' => 'footer-menu'));  ?>
    </div>
<?php if ($address): ?>
        <div class="row">
            <p class="footer-address"><?php echo $address; ?></p>
        </div>
<?php endif; ?>
</div>
<footer id="colophon" class="site-footer">
    <div class="copyright">
        <div class="row">

            <div class="large-12 columns site-info">
<?php echo apply_filters('jobify_footer_copyright', sprintf(__('&copy; %1$s %2$s &mdash; All Rights Reserved', 'jobify'), date('Y'), get_bloginfo('name'))); ?>
            </div><!-- .site-info -->

            <a href="#top" class="btt"><i class="icon-up-circled"></i></a>

            <?php
            if (has_nav_menu('footer-social')) :
                $social = wp_nav_menu(array(
                    'theme_location' => 'footer-social',
                    'container_class' => 'footer-social',
                    'items_wrap' => '%3$s',
                    'depth' => 1,
                    'echo' => false,
                    'link_before' => '<span class="screen-reader-text">',
                    'link_after' => '</span>',
                ));

                echo strip_tags($social, '<a><div><span>');
            endif;
            ?>
        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->
</div>
<?php wp_footer(); ?>
<div id="register-modal-wrap" class="modal-register modal animated fadeIn">
    <h2 class="modal-title">Get a quote</h2>

<?php echo do_shortcode('[gravityform id=2 title=false description=false ajax=true]'); ?>
</div>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion_async.js" charset="utf-8"></script>
<script type="text/javascript">
    if (jQuery('.gform_confirmation_message_3.gform_confirmation_message').length == 1)
    {
        google_trackConversion({
            google_conversion_id: 1069999474,
            google_conversion_label: "v9hBCO3PxVkQ8sqb_gM",
            google_remarketing_only: false
        });
    }
</script>
</body>
</html>